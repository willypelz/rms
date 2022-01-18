<?php

namespace App\Helpers;
use App\Models\Job;
use App\Models\JobApplication;

use function PHPUnit\Framework\isNull;

class AlgoliaSearch
{

    public static function search_resume(array $data, array $additional = [])
    {
        extract($data);
        $q = $q == '*' ? '' : $q;
        $pageNumber = $page ?? 1;
        $data = JobApplication::search($q, function ($algolia, $query, $options) use ($pageNumber) {
            $customOptions = [
                'facets' => ['*'],
                // 'paginationLimitedTo' => 100, // pagination count, we could make this a config
                'page' => $pageNumber // used for paginating results
            ];
            $newArray = array_merge($options, $customOptions);
            unset($newArray['numericFilters']);
            // dd(array_merge($options, $customOptions));
            return $algolia->search($query, $newArray);
        });
        if ($additional['job_id'] ?? null) {
            $data = $data->where('job_id', $additional['job_id']);
        }
        if ($additional['job_ids'] ?? null) {
            $data = $data->whereIn('job_id', $additional['job_ids']);
        }
        if ($additional['company_folder_id'] ?? null) {
            $data = $data->where('company_folder_id', $additional['company_folder_id']);
        }
        if ($additional['folder_type'] ?? null) {
            $data = $data->where('folder_type', $additional['folder_type']);
        }
        $filterBys = ['years_of_experience', 'grade', 'age'];
        foreach ($filterBys as $filterBy) {
            $data = AlgoliaSearch::filterBetween($data, $additional, $filterBy);
        }
        //        dd($data->raw());
        $formatted = AlgoliaSearch::createSolrStyleResponse($data->raw());
        //        dd($formatted);
        return $formatted;
    }

    public static function filterBetween($data, array $additionalData, string $field)
    {
        $from = "{$field}_from";
        $to = "{$field}_to";
        if (($additionalData[$from] ?? false) && ($additionalData[$to] ?? false)) {
            $data = $data->whereBetween($field, [$additionalData[$from], $additionalData[$to]]);
        }
        return $data;
    }

    static function get_applicants(
        $data, $job_id, $status = "", $age = null, 
        $exp_years = null, $video_application_score = null, 
        $test_score = null, $graduation_grade = null, 
        $minimium_remuneration = null, $maximium_remuneration = null)
    {
        $extra = [];
        $extra['job_id'] = $job_id;
        if ($status != "") {
            $extra['application_status'] = $status;
        }
        if (!is_null($age)) {
            $extra['dob_from'] = $age[1];
            $extra['dob_to'] = $age[0];
        }
        if (!is_null($exp_years)) {
            $extra['years_of_experience_from'] = $exp_years[0];
            $extra['years_of_experience_to'] = $exp_years[1];
        }
        if (!is_null($graduation_grade)) {
            $extra['grade_from'] = $graduation_grade[0];
            $extra['grade_to'] = $graduation_grade[1];
        }
        if (!is_null($minimium_remuneration)) {
            $extra['minimum_remuneration_from'] = $minimium_remuneration[0];
            $extra['minimum_remuneration_to'] = $minimium_remuneration[1];
        }
        if (!is_null($maximium_remuneration)) {
            $extra['maximum_remuneration_from'] = $maximium_remuneration[0];
            $extra['maximum_remuneration_to'] = $maximium_remuneration[1];
        }
        if (!is_null($video_application_score)) {
            $extra['video_application_score_from'] = $video_application_score[0];
            $extra['video_application_score_to'] = $video_application_score[1];
        }
        if (!is_null($test_score)) {
            $extra['test_score_from'] = $test_score[0];
            $extra['test_score_to'] = $test_score[1];
        }
        return AlgoliaSearch::search_resume($data, $extra);
    }

    public static function createApplicationSchema(array $applications)
    {
        return collect($applications)->transform(function ($application) {
            $application['job_id'] = [$application['job_id']];
            $application['application_id'] = [$application['application_id']];
            return $application;
        })->toArray();
    }

    public static function get_all_my_cvs($data, $age = null, $exp_years = null)
    {
        $job_ids = Job::getMyJobIds();
        $additional = [
            'job_ids' => $job_ids,
            'company_folder_id' => @get_current_company()->id,
            'folder_type' => 'saved'
        ];
        if (!is_null($age)) {
            $additional['age_from'] = $age[0];
            $additional['age_to'] = $age[1];
        }
        if (!is_null($exp_years)) {
            $additional['years_of_experience_from'] = $exp_years[0];
            $additional['years_of_experience_to'] = $exp_years[1];
        }
        return AlgoliaSearch::search_resume($data, $additional);
    }

    public static function get_saved_cvs($data)
    {
        $additional = [
            'company_folder_id' => @get_current_company()->id,
            'folder_type' => 'purchased'
        ];
        return AlgoliaSearch::search_resume($data, $additional);
    }

    public static function get_interview_notes($data)
    {
        $additional = [
            'company_folder_id' => @get_current_company()->id,
            'interview_recommendation' => '*'
        ];
        return AlgoliaSearch::search_resume($data, $additional);
    }

    function get_faceted_values($solr_arr)
    {
        $ret = array();
        for ($i = 0; $i < count($solr_arr); $i = $i + 2) {
            $val = $solr_arr[$i];
            $count = $solr_arr[$i + 1];
            if (empty($val))
                $val = "Not Specified";
            if (
                strtolower($val) == 'choose' ||
                strtolower(preg_replace('|[^a-z]|i', '', $val)) == 'choose' ||
                strtolower($val) == 'select'
            )
                $val = "Not Specified";
            if ($count > 0)
                $ret[$val] = $ret[$val] ? $count : $ret[$val] + $count;
        }
        ksort($ret);
        return $ret;
    }

    function get_faceted_dates($solr_arr)
    {
        $ret = array();
        $index = 0;
        if (empty($solr_arr))
            return $ret;
        foreach ($solr_arr as $key => $value) {
            $index++;
            if ($value > 0 && ($key != 'gap') && ($key != 'start') && ($key != 'end'))
                $ret[$index . ' week(s) '] = $value;
        }
        return $ret;
    }

    public static function createSolrStyleResponse(array $response): array
    {
        $object = [];
        $object['responseHeader'] = [
            "status" => 0,
            "QTime" => 4,
            "params" => [
                "facet.limit" => "-1",
                "q" => "*=>*",
                "facet.field" => "gender",
                "indent" => "true",
                "q.op" => "OR",
                "facet" => "true",
                "_" => "1641369677130",
            ]
        ];
        $object['response'] = [
            "numFound" => count($response['hits']),
            "start" => 0,
            "numFoundExact" => true,
            "docs" => AlgoliaSearch::createApplicationSchema($response['hits'])
        ];
        $object['facet_counts'] = [
            'facet_queries' => [],
            'facet_fields' => AlgoliaSearch::handleFacetSchema($response['facets']),
            'facet_ranges' => [],
            'facet_intervals' => [],
            'facet_heatmaps' => [],
        ];
        return $object;
    }

    public static function handleFacetSchema(array $facets): array
    {
        
        foreach ($facets as $key => $facet) {
            $facets[$key] =AlgoliaSearch::convertFlatArrayToObject($facet);
        }
        return $facets;
    }

    public static function convertFlatArrayToObject(array $array): array
    {
        $converted = [];
        foreach ($array as $key => $item) {
            $converted[$item] =  $key;
        }
        return $converted;
    }
}
