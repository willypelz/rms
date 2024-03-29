<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Cv;
use App\Jobs\ExtractCvContent;
use Curl;


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


    public function getTestExtract(){

        $cv_file = '/home/insidify/subdomains/files/uploads/cv/vv2.pdf';

        echo $cv_file.'\n\n';
        
        $resp = Curl::to('http://127.0.0.1:5000/extract')
                                ->withData('file_name', $cv_file)
                                ->get();

        echo $resp;

    }
            

    
}
