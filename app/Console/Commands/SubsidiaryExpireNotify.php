<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

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
        //
        $days = 13;
        $title = '14-Day Free Trial Expiration';
        $data= Company::where('license_type','TRIAL')->whereRaw('DATEDIFF(now(),date_added) = ?')
            ->setBindings([$days])
            ->get();

        foreach ($data as $company) {
            Mail::send('emails.subsidiary.expire-notify',['subsidiary'=> $company->name, 'email_title' => $title], function ($m) use ($company) {
                $m->from(env('COMPANY_EMAIL'));
                $m->to($company->email)
                    ->subject($title);
            });
        }
    }
}
