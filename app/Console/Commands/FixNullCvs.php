<?php

namespace App\Console\Commands;

use App\Jobs\UploadSolrFromCode;
use App\Models\CV;
use Illuminate\Console\Command;

class FixNullCvs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fix:cvs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix all null or wrongly named cvs and then update solr';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $cvs = Cv::where('cv_file', 'not like', "%-%" )
                ->whereBetween('last_modified',['2021-07-31','2021-09-02']); //only dates between Aug 1 and Sep 1
        if($cvs->count()){
            foreach ($cvs->get() as $cv) { 
                if(!isset($cv->email)){
                    continue;
                }
                $email_slug = str_slug($cv->email);
                $get_file = glob("public_html/uploads/CVs/*$email_slug*"); //get the file that matches the email slug
                if(count($get_file)){
                    $get_file = substr(strrchr($get_file[0], "/"), 1); //strip all the file paths before the actual file name
                    $cv->update(['cv_file' => $get_file]);
                }
                continue;               
            }
            dump('CV Fix is done');
              UploadSolrFromCode::dispatch();
        }else{
            dump('No CV to fix');
        }
        
      
        
            
        
        
    }
}
