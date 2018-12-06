<?php

namespace App\Providers;

use App\Helpers\Tags\FormAction;
use App\Helpers\Tags\ImageSource;
use BeyondCode\TagHelper\Facades\TagHelper;
use Illuminate\Support\ServiceProvider;

class TagHelperServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        TagHelper::helper(FormAction::class);
        TagHelper::helper(ImageSource::class);
    }
}
