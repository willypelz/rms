<?php

namespace App\Providers;

use App\SearchEngine\AlgoliaSearch;
use App\SearchEngine\SearchEngine;
use App\SearchEngine\SolrSearch;
use Illuminate\Support\ServiceProvider;

class SearchEngineServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(
            SearchEngine::class,
            function ($app) {
                if (config('app.searcher') == 'solr') {
                    return new SolrSearch;
                }

                return new AlgoliaSearch;
            }

        );
    }
}
