<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Dtos\DownloadApplicantCvDto;
use App\User;
use App\Notifications\NotifyAdminOfApplicantsCvCompleted;
use Madnest\Madzipper\Facades\Madzipper;

class SaveApplicantNotesInBitsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $zipPath, $files;
    public $timeout = 2500;

    /**
     * Create a new job instance.
     * @param $zipPath
     * @param $files
     * 
     */
    public function __construct($zipPath, $files)
    {
	    $this->zipPath = $zipPath;
        $this->files = $files;
        $this->queue = "export";
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
	    $zipper = Madzipper::make($this->zipPath);
                    $zipper->add($this->files);
                    $zipper->close();
    }

}
