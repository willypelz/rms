<?php

namespace App\Dtos;

use App\Models\Job;
use \Carbon\Carbon;
use \SeamlessHR\SolrPackage\Facades\SolrPackage;
use App\Models\JobApplication;
use \Maatwebsite\Excel\Excel as ConcreteExcel;

class DownloadApplicantDto  {
   
    /**
    * @var string the default storage disk
    */
    protected $disk = "public";

    /**
    * @var string the default storage disk
    */
    protected $storage_folder =  "uploads/tmp/";

     /**
    * @var int the path to save the file
    */
    protected $path;

    /**
    * @var string the filename of the file being downloaded as seen by client
    */
    protected $filename;

    /**
    * @var string the temp filename of the file being downloaded saved on the machine
    */
    protected $tmp_filename;

    /** 
    * @var string the row to search in solr
    */
    protected $search_row;

    /** 
    * @var App\Models\Job the job to which applicant applied
    */
    protected $job;

    /** 
    * @var array the search params specified in the request
    */
    protected $search_params; //array

    /** 
    * @var int the specified age range from solr
    */
    protected $solr_age;

    /** 
    * @var int the specified expiry date  from solr
    */
    protected $solr_exp_years;

    /** 
    * @var int the specified test score  from solr
    */
    protected $solr_test_score;

    /** 
    * @var int the specified video application score from solr
    */
    protected $solr_video_application_score; //array

    /** 
    * @var string the specified status  from solr
    */
    protected $status;

    /** 
    * @var string the specified job title from solr
    */
    protected $job_title;
    
    /** 
    * @var array the specified applicants ids  to download
    */
    protected $all_applicants;

     /** 
    * @var array the data from request
    */
    protected $data;

    /**
    * Get Disk
    * The Storage disk where applicants data files/exports are stored
    * @return string 
    */
    public function getDisk()
    {
        return $this->disk;
    }

    /**
     * Initialize dto with the needed datas
    * @param array $data the data gotten from the request
    */
    protected function initialize($data) : object
    {
        $this->initializeData($data);
        $this->initializeJob();
        $this->initializeSearchParams();
        $this->initializeSolrAge();
        $this->initializeSolrExpYears();
        $this->initializeTestScores();
        $this->initializeVideoApplicationScores();

//         $this->getAllApplicantsFromSolr();

        return $this;
    }

    /**
     * Persist the data gottent from request
    * @param array the data gotten from the request
    * @return void
    */
    protected function initializeData($data)
    {
        $this->data = $data;
    }

    /**
    * Get the data gottent from request
    * @return array the data gotten from the request
    */
    protected function getData():array
    {
        return $this->data;
    }

    /**
     * Set the jon the applicants applied for
    * @return void 
    */
    protected function initializeJob()
    {
        $this->job = Job::find($this->getData()["jobId"]);
    }

    /**
     * set the search params 
    * @return void 
    */
    protected function initializeSearchParams()
    {
        $this->search_params = isset($this->getData()["search_params"]) ? $this->getData()["search_params"] : null;
        $this->search_params['filter_query'] = isset($this->getData()["filter_query"]) ? $this->getData()["filter_query"] : null;
        $this->search_params['row'] = $this->search_row;   
    }

    /**
    * set the solr age 
    * @return void 
    */
    protected function initializeSolrAge()
    {
        // if (isset($data["age"]) && is_array($data["age"]) && count($data["age"]) > 2) {
        if ($this->isArrayTypesInDataContains("age", 2)) {
            $date = Carbon::now();
            $start_dob = explode(' ', $date->subYears( $this->getData()["age"][0] ))[0] . 'T23:59:59Z';
            $end_dob = explode(' ', $date->subYears( $this->getData()["age"][1] ))[0] . 'T00:00:00Z';
            $this->solr_age = [$start_dob, $end_dob];

        } else {
            $data["age"] = [15, 65];
            $solr_age = null;
        }
    }

    /**
     * set the solr expiriy years 
    * @return void 
    */
    protected function initializeSolrExpYears()
    {
        //If years of experience is available
        if ($this->isArrayTypesInDataContains("exp_years", 1)) {
            //2015-09-16T00:00:00Z
            $solr_exp_years = [$this->getData()["exp_years"][0], $this->getData()["exp_years"][1]];
        } else {
            $this->data["exp_years"] = [0, 40];
            $solr_exp_years = null;
        } 
    }

    /**
     * set the test scores 
    * @return void 
    */
    protected function initializeTestScores()
    {
        //If test score is available
        if ($this->isArrayTypesInDataContains("test_score", 2)) {
            //2015-09-16T00:00:00Z
            $solr_test_score = [$this->getData()["test_score"][0], $this->getData()["test_score"][1]];
        } else {
            $this->data["test_score"] = [40, 160];
            $solr_test_score = null;
        }
    }
    /**
     * set the video application scores 
    * @return void 
    */
    protected function initializeVideoApplicationScores()
    {
        //If video application score is available
        if ($this->isArrayTypesInDataContains("video_application_score", 2) ) {
        //2015-09-16T00:00:00Z
            $solr_video_application_score = [
                $this->getData()["video_application_score"][0],
                $this->getData()["video_application_score"][1]
            ];
        } else {
            // $data["video_application_score"][0] =  env('VIDEO_APPLICATION_START');
            // $data["video_application_score"][1] =  env('VIDEO_APPLICATION_END');
            $solr_video_application_score = null;
        }
    }

    /**
     * Get the Job
    * @return App\Models\Job  
    */
    public function getJob()
    {
        return $this->job;
    }

    /**
     * Get All Applicants from Solr
    * @return array | null 
    */

    protected function getAllApplicantsFromSolr($next)
    {
	    $default_solr_row_size = 2000;
	    $applicants = $this->getApplicantsByPagination(0, $default_solr_row_size);
	    $total_count = $applicants["response"]["numFound"];
	    \Log::info("Retrieving Applicants From Solr...");
	    if( $total_count > $default_solr_row_size  ){
		    $current_count = 0;
		    while( ($start = $current_count * $default_solr_row_size )  < $total_count){
			    ++$current_count;
			    $this->all_applicants = $this->getApplicantsByPagination($start, $default_solr_row_size - 1);
			    $next( ($this->all_applicants ? $this->all_applicants["response"] : null) , ( ( ($start +  $default_solr_row_size) > $total_count) ? true : false ) );
		    }
		    \Log::info("Applicants Retrieved Successfully from Solr.");
		    return;
	    }
	    $next( $this->all_applicants ? $this->all_applicants["response"] : null, true );
	    \Log::info("Applicants Retrieved Successfully from Solr.");
	}
    
    protected function getApplicantsByPagination($start, $size){
	    $this->search_params["start"] = $start;
	    $this->search_params["rows"] = $size;
	    return SolrPackage::get_applicants( $this->search_params,
                                            $this->getData()["jobId"],
                                            $this->getData()["status"],
                                            $this->solr_age,
                                            $this->solr_exp_years,
                                            $this->solr_video_application_score, 
                                            $this->solr_test_score
                                        );
    }

    /**
     * Get All Applicants
    * @return array | null 
    */
    public function getAllApplicants()
    {
        return $this->all_applicants;
    }
    
    /**
    * Set All Applicants
    * @return array | null 
    */
    // public function setAllApplicants($all_applicants)
    // {
    //     $this->all_applicants = $all_applicants;
    // }

    
    /**
    * Set All Applicants
    * @return array | null 
    */
    public function setAllApplicants($all_applicants)
    {
        $this->all_applicants = $all_applicants;
    }

     /**
     * Get value from Applicants data 
     * @param string key the key mapped to the value on the applicants data
    * @return array | null 
    */
    public function getDataFromApplicants(string $key) {
          return $this->getAllApplicants()[$key] ?? [];
    }

    /**
     * Check if array value in Applicants is set and of required size
     * @param $key the key in the applicants data array
     * @param $count the required minimuim array size
    * @return bool 
    */
    private function isArrayTypesInDataContains($key, $count) : bool
    {
        return isset($this->getData()[$key]) && is_array($this->getData()[$key]) && (count($this->getData()[$key]) > $count ) ;
    }

    /**
     * Set path to file
    * @return string
    */
    public function setPath(string $filename)
    {
        $this->tmp_filename = $filename;
        $this->path = \Storage::disk($this->disk)->path($this->storage_folder . $filename);
    }


    /**
    * Get the temp file name to the stored file 
    * @param string the temporary filename of the file being store on local machine or storage
    */
    public function getTmpFilename() :string
    {
        return $this->tmp_filename;
    }

    /**
    * Get the storage folder eg "uploads/tmp"
    * @return string the storage folder relative path 
    */
    public function getStorageFolder() :string
    {
        return $this->storage_folder;
    }
    

        /**
    * Get the path to the stored file 
    * @param string the path to the of the file  stored on local machine or storage
    */
    public function getPath()
    {
        return $this->path;
    }

    /**
    * Get file name
    * @return string
    */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
    * Get the zipped file absolute path 
    * @param string the path to the zipped file
    */
    public function getZipPath()
    {
        return $this->getPath() ;
    }

    /**
    * Set the  file name to the stored file 
    * @param string the filename of the file stored  on local machine or storage
    */
    public function setFilename(string $filename)
    {
        $this->filename = $filename;
    }

    /**
    * Get download link
    * the relative path of file from default storage disk
    * @param string the filename of the file stored  on local machine or storage
    */
    public function getDownloadLink(){
        return $this->getStorageFolder() . $this->getTmpFilename();
    }

    /**
    * Get Absolute file path
    * @return string 
    */
    public function getStorageRealPath(){
        return \Storage::disk($this->disk)->path($this->getStorageFolder() . $this->getTmpFilename());
    }

    /**
     * The default storage disk
     * @return string the storage disk
     */
    function getStorageDisk(){
        return $this->disk;
    }

    /**
     * Format file name per specific use case
     * @return string $filename the filename to format
     */
    protected function formatFilename(string $filename){
        return $filename;
    }

}


?>