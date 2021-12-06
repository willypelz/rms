<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;


class StreamFilesFromHRMS extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stream:file';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Stream missing or empty Files from HRMS';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
       $lists = [
           //name is filename and url is the path to file on hrms
           ['name'=>"TonyFolamiResume2021(1)_1637924757.docx" , 'url'=>"https://hchub.sterling.ng/uploads/TonyFolamiResume2021(1)_1637924757.docx"],
           ['name'=>"SALAMIRALIATYETUNDERESUME(1)_1637920149.docx" , 'url'=>"https://hchub.sterling.ng/uploads/SALAMIRALIATYETUNDERESUME(1)_1637920149.docx"], 
       ];

       foreach ($lists as $list){
        saveFileFromHrms($list['name'], $list['url']);
       }
    }
}
