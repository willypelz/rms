<?php

namespace App\Console\Commands;

use App\Jobs\NotifyAdminOfCompletedExportJob;
use App\Models\SpreadSheetDoneExporting;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Bus;

class SendExportDoneNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:spreadsheet-is-done-exporting';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {
        SpreadSheetDoneExporting::whereStatus('pending')->get()->map(function ($sheet) {

            $admin = User::find($sheet->admin_id);
            $type = $sheet->data['type'];
            $filename = $sheet->data['filename'];
            $jobId = $sheet->data['jobId'];
            $batch = Bus::findBatch($sheet->batch_id);

            if ($batch && $batch->finished()) {
                NotifyAdminOfCompletedExportJob::dispatch($filename,$admin,$type,$jobId, $sheet->id);
            }

        });

    }
}
