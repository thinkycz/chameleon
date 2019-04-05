<?php

namespace Nulisec\ScoutElastic;

use Nulisec\ScoutElastic\Console\ElasticReindex;
use Nulisec\ScoutElastic\Engine\ElasticEngine;
use Elasticsearch\Client;
use Laravel\Scout\EngineManager;
use Illuminate\Support\ServiceProvider;
use Elasticsearch\ClientBuilder;

class ElasticServiceProvider extends ServiceProvider
{
    public function boot(Client $client)
    {
        $this->app->get(EngineManager::class)->extend('elastic', function () use ($client) {
            return new ElasticEngine($client);
        });
    }

    public function register()
    {
        if ($this->app->runningInConsole()) {
            $this->commands(ElasticReindex::class);
        }

        $this->app->singleton(Client::class, function () {
            return ClientBuilder::create()->setHosts(config('scout.elastic.hosts'))->build();
        });
    }
}
