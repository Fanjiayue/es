<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Elasticsearch\ClientBuilder as ElasticBuilder;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('es',function()
        {
            $client=ElasticBuilder::create()->setHosts(config('database.elasticsearch.hosts'))->build();

            return $client;
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
