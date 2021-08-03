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

class SendApplicantsCv implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $admin;
    protected $data;


    protected $downloadApplicantCvDto;

    public $timeout = 0;

    /**
     * Create a new job instance.
     * @param App\User $user
     * @param App\Dtos\DownloadApplicantCvDto
     * @return void
     */
    public function __construct(User $admin, $data)
    {
	    $this->admin = $admin;
	    $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
	    $admin = $this->admin;
		$sheetInstance = app()->make(DownloadApplicantCvDto::class)->initialize($this->data);
		$sheetInstance->processApplicantsCvs(function($applicantsResponse, $lastLoop) use ($sheetInstance, $admin){
			$sheetInstance->setAllApplicants($applicantsResponse);
			$cvs = $sheetInstance->initCvsComponents()->getCvs();
            Madzipper::make($sheetInstance->getZipPath())->add( $cvs )->close();
            $file = new \Illuminate\Http\File( $sheetInstance->getStorageRealPath());
            $relative_filename = $sheetInstance->getDownloadLink();
            if( $lastLoop)
                  $admin->notify( new NotifyAdminOfApplicantsCvCompleted($file, "Applicant CV", 'public', $relative_filename)); 
    	});
    }

}
