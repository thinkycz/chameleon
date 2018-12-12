<?php

namespace Nulisec\XmlParser;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class XmlParserServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(Reader::class, function () {
            return new Reader();
        });
    }
}
