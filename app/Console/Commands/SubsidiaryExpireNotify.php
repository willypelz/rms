<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Company;
use carbon\Carbon;
use App\Notifications\SubsidiaryExpirationNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use App\User;

class SubsidiaryExpireNotify extends Command
{
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
    protected $description = 'Notify Admin before 28-Day trial expires';

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
        $title = '28-Day Free Trial Expiration';
        $data = Company::where('license_type', 'TRIAL')->get();
        foreach ($data as $company) {
            $user = DB::table('users')
                ->join('company_users', 'users.id', '=', 'company_users.user_id')
                ->select('users.*')
                ->where('company_id', $company->id)->first();
        
            $user_name = $user->name;
            $user_email = $user->email;
            $user = User::where('email', $user->email)->get();
            $date = Carbon::parse($company->date_added)->addDays(25);
            $twoWeeksDate = Carbon::parse($company->date_added)->addWeek(2);
            $oneWeekDate = Carbon::parse($company->date_added)->addWeek(3);
            if ((now() == $date) || (now() == $twoWeeksDate) || ( now() == $oneWeekDate)) {
                $company_name = $company->name;
                $company_email = $company->email;
                $date = isset($date) ? "1 day" : (isset($twoWeeksDate) ? "2 weeks" 
                    : "1 week");
                Notification::send(
                    $user, new SubsidiaryExpirationNotification(
                        $company_name,
                        $company_email,
                        $title,
                        $user_name,
                        $user_email,
                        $date
                    )
                );
            } 
            
        }
    }
}
