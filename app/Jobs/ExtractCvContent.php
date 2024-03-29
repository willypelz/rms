<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\Models\Cv;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Curl;

class ExtractCvContent extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $cv;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Cv $cv)
    {
        $this->cv = $cv;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        
        // $cv_file = '/home/insidify/subdomains/files/uploads/cv/'.$this->cv->cv_file;

        // echo $cv_file.'\n\n';
        
        // $this->cv->extracted_content = Curl::to('http://localhost:5000/extract')
        //                         ->withData('file_name', urlencode( $cv_file ))
        //                         ->get();

                               // file_get_contents("http://50.28.104.199:5000/extract?file_name=".urlencode( $cv_file ) );
        // echo 'done: '.$this->cv->id.': '.$cv_file.': '.$this->cv->extracted_content;                        

        // $this->cv->save();


        $filepath = public_path( 'uploads/CVs/'. $this->cv->cv_file );

        try {

            $this->cv->extracted_content = @file_get_contents("http://127.0.0.1:5000/extract?file_name=".urlencode( $filepath ) );

            echo 'DONE: '.$this->cv->id.': '.$filepath.': '.$this->cv->extracted_content;
            $this->cv->save();
            
        } catch (Exception $e) {
             echo 'ERROR: '.$filepath.': '. $e->getMessage();
        }
        
        
        // $this->cv->update(['extracted_content' => $extracted_content]);


    }
}
