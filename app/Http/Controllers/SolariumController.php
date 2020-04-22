<?php

namespace App\Http\Controllers;

class SolariumController extends Controller
{
    protected $client;

    public function __construct(\Solarium\Client $client)
    {
        $this->client = $client;
    }

    public function ping()
    {

    	// dd('STOP');
        // create a ping query
        $ping = $this->client->createPing();

        // dd($ping);

        // execute the ping query
        try {
            $this->client->ping($ping);
            return response()->json('OK');
        } catch (\Solarium\Exception $e) {
        	dd($e);
            return response()->json('ERROR', 500);
        }
    }
}