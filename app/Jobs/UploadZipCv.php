<?php

namespace App\Jobs;

use Alchemy\Zippy\Zippy;
use App\Http\Controllers\JobsController;
use App\Jobs\Job;
use App\Models\Settings;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use VIPSoft\Unzip\Unzip;

class UploadZipCv extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    private $filename;

    private $randomName;

    private $additional_data;

    private $request;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($filename, $randomName, $additional_data, $request_data)
    {
        $this->filename = $filename;
        $this->randomName = $randomName;
        $this->additional_data = $additional_data;
        $this->request = json_decode($request_data);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $zippy = Zippy::load();
        $tempDir = public_path('uploads/CVs/') . $this->randomName . '/';


        $unzipper  = new Unzip();
        $filenames = $unzipper->extract(public_path('uploads/CVs/') . $this->filename, $tempDir);


        //Open File
        // $archive = $zippy->open(public_path('uploads/CVs/') . $this->filename);

        // //Create temporary directory
        // $tempDir = public_path('uploads/CVs/') . $this->randomName . '/';
        // mkdir($tempDir);

        // //Extract zip contents to temporary directory
        // $archive->extract($tempDir);

        // //Delete Zip file
        // unlink(public_path('uploads/CVs/') . $this->filename);

        //Instantiate Cv files array
        $cvs = [];

        

        $settings = new Settings();
        $last_cv_upload_index = intval($settings->get('LAST_CV_UPLOAD_INDEX'));

        // dd('Stop', $filenames, $last_cv_upload_index);

        $files = scandir($tempDir);
        // dd($files);
        foreach ($files as $key => $file) {
            if (is_file($tempDir . $file)) {
                // $last_cv_upload_index++;
                $cv = $key . "_" . $this->randomName . $file;
                $cvs[$file] = $cv;
                // $cvs[] = [ 'first_name' => 'Cv ' . $last_cv_upload_index, 'cv_file' => $cv ] ;

                rename($tempDir . $file, public_path('uploads/CVs/') . $cv);

            }
        }

        //Delete Temporary directory
        rrmdir($tempDir);

        // dd('GOT HERE');

        saveCompanyUploadedCv($cvs, $this->additional_data, $this->request);


    }
}
