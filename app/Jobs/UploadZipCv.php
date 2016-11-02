<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Bus\SelfHandling;

use Alchemy\Zippy\Zippy;

class UploadZipCv extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    private $filename;

    private $randomName;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($filename,$randomName)
    {
        $this->filename = $filename;
        $this->randomName = $randomName;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {   
        dd("fam");
        /*$zippy = Zippy::load();
        
        //Open File
          $archive = $zippy->open( public_path('uploads/CVs/') .$this->filename);

          //Create temporary directory
          $tempDir = public_path('uploads/CVs/').$this->randomName. '/';
          mkdir( $tempDir );

          //Extract zip contents to temporary directory
          $archive->extract( $tempDir );

          //Delete Zip file
          unlink(public_path('uploads/CVs/') .$this->filename);

          //Instantiate Cv files array
          $cvs = [];

          $files = scandir($tempDir);
        foreach($files as $key => $file) {
           if(is_file( $tempDir . $file ))
           {
                $cv = $key."_".$this->randomName.$file;
                $cvs[] = $cv;
                // move_uploaded_file($tempDir . $file, $cv);
                rename($tempDir . $file, public_path('uploads/CVs/').$cv);
                echo $tempDir . $file. " is a file <br/>";
           }
           else
           {
            echo $tempDir . $file." is not a file <br/>";
           }
        }

        //Delete Temporary directory
        rrmdir($tempDir);
         var_dump($event->exception);
        var_dump($event->data);
        dd($cvs);*/

    }
}
