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

class SaveApplicantCVInBitsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $zipPath, $cvs;
    public $timeout = 2500;

    /**
     * Create a new job instance.
     * @param App\User $user
     * @param App\Dtos\DownloadApplicantCvDto
     * @return void
     */
    public function __construct($zipPath, $cvs)
    {
	    $this->zipPath = $zipPath;
        $this->cvs = $cvs;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
	    $zipper = Madzipper::make($this->zipPath);
                    $zipper->add($this->cvs);
                    $zipper->close();
    }

}
