<?php

namespace App\Helpers;

use App\SearchEngine\SearchEngine;

class SearchEngineable
{
    protected $searchEngine;

    public function __construct()
    {
        $this->searchEngine = app(SearchEngine::class);
    }
}