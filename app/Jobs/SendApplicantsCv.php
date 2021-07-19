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

    protected $downloadApplicantCvDto;

    public $timeout = 0;

    /**
     * Create a new job instance.
     * @param App\User $user
     * @param App\Dtos\DownloadApplicantCvDto
     * @return void
     */
    public function __construct(User $admin, $downloadApplicantCvDto)
    {
        $this->admin = $admin;
        $this->downloadApplicantCvDto = $downloadApplicantCvDto;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $cvChunked = collect($this->downloadApplicantCvDto->getCvs())->chunk(1000)->toArray();
        if(count($cvChunked)){
            $zipper =  Madzipper::make($this->downloadApplicantCvDto->getZipPath());
            foreach($cvChunked as $chunk){
                $zipper->add( $chunk );
            }
            $zipper->close();
            $file = new \Illuminate\Http\File( $this->downloadApplicantCvDto->getStorageRealPath());
            $this->admin->notify( new NotifyAdminOfApplicantsCvCompleted( "Applicant CVs", $this->downloadApplicantCvDto->getDisk(), 
                                                                $this->downloadApplicantCvDto->getDownloadLink()));
            return true;
        }
        $this->admin->notify( new NotifyAdminOfApplicantsCvCompleted( null, null,  null));
    }

}
