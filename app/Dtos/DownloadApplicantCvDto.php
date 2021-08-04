<?php

namespace App\Dtos;

use App\Models\Job;
use \Carbon\Carbon;
use \SeamlessHR\SolrPackage\Facades\SolrPackage;
use App\Models\JobApplication;
use Madnest\Madzipper\Facades\Madzipper;

class DownloadApplicantCvDto extends DownloadApplicantDto {

    /** 
    * @var int the row to search in solr
    */
    public $search_row = 2147483647;

    /**
    * @var array the applicant cvs to be downloaded
    */
    protected $cvs;

    /** 
    * @var string the applicant cvs ids
    */
    protected $ids;

    /**
     * Initialize dto with the needed datas
    * @param array the data gotten from the request
    */
    public function initialize($data) : object
    {
        parent::initialize($data);
        $this->setPath(time() . ".zip");
        $this->setFilename( date('y-m-d'). $this->getJob()->title .'Cv.zip');
//         $this->initCvsComponents();
        return $this;
    }

    /** 
    * initialize the cvs components suchs as the cv ids and the cvs
    * @return void 
    */
    public function initCvsComponents()
    {
        $cvs = array_pluck($this->getDataFromApplicants("docs"), 'cv_file');
        $ids = array_pluck($this->getDataFromApplicants("docs"), 'id');
        $this->appendPathToSelectedCvs($cvs, $ids);
        return $this;
    }

    /**
    * Get the cvs
    * @param string the filename of the file being store on local machine or storage
    */
    public function getCvs()
    {
        return $this->cvs;
    }

    /**
    * Append the  path info to cvs eligible for zipping
    * @param string the filename of the file being store on local machine or storage
    */
    public function appendPathToSelectedCvs($cvs, $ids)
    {
         //Check for selected cvs to download and append path to it
         $cvs = array_map(function ($cv, $id) {

            if (!empty($cv_ids) && !in_array($id, $cv_ids)) {
                return null;
            }

            if (!file_exists(public_path('uploads/CVs/') . $cv)) {
            // if (!file_exists(static::getStorageRealPathTo('uploads/CVs/') . $cv)) {
                return null;
            }

            if (is_null($cv) or $cv == "") {
                return null;
            }

            return public_path('uploads/CVs/') . $cv;
            // return static::getStorageRealPathTo('uploads/CVs/') . $cv;
        }, $cvs, $ids);

         //Remove nulls
         $cvs = array_filter($cvs, function ($var) {
            return !is_null($var);
        });
  
        $this->cvs = $cvs;
    }
    
    public function processApplicantsCvs(\Closure $next){
	     $this->getAllApplicantsFromSolr($next);
	}


}

?>