<?php

namespace App\SearchEngine;

use App\Models\JobApplication;
use App\SearchEngine\SearchEngine;
use App\Models\Job;

class AlgoliaSearch implements SearchEngine
{
    public function search_resume($data, $additional = [])
    {
        extract($data);

        $q = $q == '*' ? '' : $q;

        $pageNumber = (($start ?? 0) / ($paginationCount ?? 20));

        if (is_null($additional['job_id'] ?? null) && empty($additional['job_ids'] ?? [])) {
            return $this->createSolrStyleResponse([]);
        }

        $data = JobApplication::search(
            $q, function ($algolia, $query, $options) use ($pageNumber, $additional, $data) {

                $customOptions = [
                    'facets' => ['*'],
                    'page' => $pageNumber,
                    'hitsPerPage' => ($paginationCount ?? 20),
                ];

     	        $searchContent  = "";
                if (!is_null($additional['job_id'] ?? null)) {
	                $searchContent .= "job_id = {$additional['job_id']}";
                }

                if (!is_null($additional['job_ids'] ?? null)) {
                    foreach ($additional['job_ids'] as $key => $id) {
                        if ($key == 0) {
                            $searchContent .= "job_id = {$id}";
                        } else {
                            $searchContent .= " OR job_id = {$id}";
                        }
                    }
                }

		        if ($additional['application_status'] ?? null) {
		        	$searchContent .= "  AND application_status:{$additional['application_status']}";
		        }

                $filterBys = ['years_of_experience', 'grade', 'age'];

                foreach ($filterBys as $filterBy) {
                    $searchContent .= $this->filterBetween($additional, $filterBy);
                }

                $filterTracker = [];
                foreach (($data['filter_query'] ?? []) as $item) {
                	$searchKey = explode(':',$item)[0];
	                $defaultOperation =	(in_array($searchKey, $filterTracker)) ? 'OR' : 'AND';
                    $searchContent .= " {$defaultOperation} {$item}";
	                $filterTracker[] = $searchKey;
                }


                if ($query !== '') {
                    $customOptions['query'] = $query;
                }

                $customOptions['filters'] = $searchContent;

                $newArray = array_merge($options, $customOptions);

                return $algolia->search($query, $newArray);
            }
        );

        $formatted = $this->createSolrStyleResponse($data->raw());

        return $formatted;
    }

    public function filterBetween(array $additional, string $field) : string
    {
        $from = $additional["{$field}_from"] ?? null;
        $to = $additional["{$field}_to"] ?? null;

        return (!is_null($from) && !is_null($to)) ? "  AND years_of_experience:{$from} TO {$to}" : "";
    }

    public function get_applicants(
        $data,
        $job_id,
        $status,
        $clientId,
        $age = null,
        $exp_years = null,
        $video_application_score = null,
        $test_score = null,
        $graduation_grade = null,
        $minimium_remuneration = null,
        $maximium_remuneration = null
    ) {

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

        return $this->search_resume($data, $extra);
    }

    public function createApplicationSchema(array $applications)
    {
        return collect($applications)->transform(
            function ($application) {
                $application['job_id'] = [$application['job_id']];
                $application['application_id'] = [$application['application_id']];
                return $application;
            }
        )->toArray();
    }

    public function get_all_my_cvs($data, $age = null, $exp_years = null)
    {
        $job_ids = Job::getMyJobIds(true);
        $filterQuery = $data['filter_query'] ?? '';
        $filterQuery = str_replace('"', '', str_replace('text:"', '', $filterQuery));
        unset($data['filter_query']);

        $additional = [
            'job_ids' => $job_ids,
            'company_folder_id' => @get_current_company()->id,
            'folder_type' => 'saved',
        ];

        $data['q'] = $filterQuery[0] ?? '';

        if (!is_null($age)) {
            $additional['age_from'] = $age[0];
            $additional['age_to'] = $age[1];
        }
        if (!is_null($exp_years)) {
            $additional['years_of_experience_from'] = $exp_years[0];
            $additional['years_of_experience_to'] = $exp_years[1];
        }
        return $this->search_resume($data, $additional);
    }

    public function get_saved_cvs($data)
    {
        $additional = [
            'company_folder_id' => @get_current_company()->id,
            'folder_type' => 'purchased'
        ];
        return $this->search_resume($data, $additional);
    }

    public function get_interview_notes($data)
    {
        $additional = [
            'company_folder_id' => @get_current_company()->id,
            'interview_recommendation' => '*'
        ];
        return $this->search_resume($data, $additional);
    }

    public function get_faceted_values($solr_arr)
    {
        $ret = array();
        for ($i = 0; $i < count($solr_arr); $i = $i + 2) {
            $val = $solr_arr[$i];
            $count = $solr_arr[$i + 1];
            if (empty($val)) {
                $val = "Not Specified";
            }
            if (strtolower($val) == 'choose' || strtolower(preg_replace('|[^a-z]|i', '', $val)) == 'choose'
                || strtolower($val) == 'select'
            ) {
                $val = "Not Specified";
            }
            if ($count > 0) {
                $ret[$val] = $ret[$val] ? $count : $ret[$val] + $count;
            }
        }
        ksort($ret);
        return $ret;
    }

    public function get_faceted_dates($solr_arr)
    {
        $ret = array();
        $index = 0;
        if (empty($solr_arr)) {
            return $ret;
        }
        foreach ($solr_arr as $key => $value) {
            $index++;
            if ($value > 0 && ($key != 'gap') && ($key != 'start') && ($key != 'end')) {
                $ret[$index . ' week(s) '] = $value;
            }
        }
        return $ret;
    }

    public function createSolrStyleResponse(array $response): array
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
            "numFound" => empty($response) ? 0 : count($response['hits']),
            "start" => 0,
            "numFoundExact" => true,
            "docs" => empty($response) ? [] : $this->createApplicationSchema($response['hits'])
        ];

        $object['facet_counts'] = [
            'facet_queries' => [],
            'facet_fields' => $this->handleFacetSchema($response['facets'] ?? []),
            'facet_ranges' => [],
            'facet_intervals' => [],
            'facet_heatmaps' => [],
        ];
        return $object;
    }

    public function handleFacetSchema(array $facets): array
    {
        $allFacets = config('scout-job-applications.attributesForFaceting');
        foreach ($allFacets as $key => $facet) {
            $facets[$facet] = isset($facets[$facet]) ? $this->convertFlatArrayToObject($facets[$facet] ) : [];
        }

        return $facets;
    }

    public function convertFlatArrayToObject(array $array): array
    {
        $converted = [];
        foreach ($array as $key => $item) {
            $converted[] = $key;
            $converted[] = $item;
        }
        return $converted;
    }

    /**
     * This function is not needed for algolia so we return void
     *
     * @param $in_data
     *
     * @return void
     */
    public function create_new_document($in_data)
    {
        return [];
    }

    /**
     * This function is not needed for algolia so we return void
     *
     * @param $core
     * @param $command
     *
     * @return void
     */
    public function update_core($core = null, $command = "delta-import")
    {
        return [];
    }
}
