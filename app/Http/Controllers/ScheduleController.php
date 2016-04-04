<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Cv;
use App\Jobs\ExtractCvContent;


class ScheduleController extends Controller
{
    

    public function getExtractCvs(){

        $cvs = Cv::whereNotNull('cv_file')->where('uploaded_date', '>', date('Y-m-d H:i:s', strtotime('- 1 month')))->get();
        foreach ($cvs as $cv) {
             
            //adding to jobs queue...
            $this->dispatch(new ExtractCvContent($cv));

                echo 'Queued: '.$cv->cv_file.'<br/>';

        }


    }


    public function test_extract(){

        $cv_file = '/home/insidify/subdomains/files/uploads/cv/Resume-_VALENTINE.doc_2_.doc';

        echo $cv_file.'\n\n';
        
        $resp = Curl::to('http://localhost:5000/extract')
                                ->withData('file_name', urlencode( $cv_file ))
                                ->get();

        echo $resp;

    }
            

    
}
