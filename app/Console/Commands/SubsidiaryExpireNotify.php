<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Notifications\Notifiable;

class SubsidiaryExpireNotify extends Command
{    use Notifiable;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subsidiary:notify-admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notify Admin before 14-Day trial expires';

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
        $title = '14-Day Free Trial Expiration';
        $data = Company::where('license_type','TRIAL')->get();

        foreach ($data as $company) {
            $date = Carbon::parse($company->date_added)->addDays(13);
            if(now() > $date ){
            $company_name = $company->name;
            $company_email = $company->email;
            $company->notify(new SubsidiaryExpirationNotification($company_name,$company_email,$title));
            }
            
        }
    }
}
