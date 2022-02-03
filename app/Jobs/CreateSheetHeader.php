<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Exports\ApplicantsExportHeader;
use Maatwebsite\Excel\Facades\Excel;
use Storage;

class CreateSheetHeader implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $filename, $data;
    public $timeout = 2500;

    /**
     * Create a new job instance.
     * @param array $data
     * @param $filename
     */
    public function __construct($filename, $data)
    {
      $this->filename = $filename;
      $this->data = $data; 
      $this->queue = "export";
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    { 
        (new ApplicantsExportHeader($this->data, $this->filename))->store($this->filename, \Maatwebsite\Excel\Excel::CSV);
    }
}
