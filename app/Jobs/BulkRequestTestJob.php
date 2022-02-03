<?php

namespace App\Jobs;

use Curl;
use App\Models\OrderItem;
use App\Models\TestRequest;
use Illuminate\Bus\Queueable;
use App\Models\JobApplication;
use App\Jobs\BulkRequestTestJob;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use App\Jobs\BulkRequestTestJobSmallerBits;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;


class BulkRequestTestJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $key, $test, $order, $request, $current_company;
    public function __construct($key, $test, $order, $request, $current_company)
    {
        $this->key = $key;
        $this->test = $test;
        $this->order = $order;
        $this->request = (object) $request;
        $this->current_company = $current_company;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $key = $this->key;
        $test = $this->test;
        $order = $this->order;
        $request = $this->request;
        $current_company = $this->current_company;
        $test_ids = [];
        try{
            $orderItems = OrderItem::firstOrCreate([
                'order_id' => $order->id,
                'itemId' => $test['id'],
                'type' => $request->type,
                'name' => $test['name'],
                'price' => $test['cost']
            ]);

            $chunked_data = collect($request->app_ids)->chunk(100)->toArray();
            foreach($chunked_data as $idBatch){
                BulkRequestTestJobSmallerBits::dispatch($key, $test, $order, $request, $current_company,$idBatch); 
            }
        }catch(\Exception $e){
            info($e);
        }
    }
    
}
