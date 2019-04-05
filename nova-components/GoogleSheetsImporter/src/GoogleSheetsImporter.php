<?php

namespace Nulisec\GoogleSheetsImporter;

use Laravel\Nova\Nova;
use Laravel\Nova\Tool;

class GoogleSheetsImporter extends Tool
{
    /**
     * Perform any tasks that need to happen when the tool is booted.
     *
     * @return void
     */
    public function boot()
    {
        Nova::script('google-sheets-importer', __DIR__.'/../dist/js/tool.js');
        Nova::style('google-sheets-importer', __DIR__.'/../dist/css/tool.css');
    }

    /**
     * Build the view that renders the navigation links for the tool.
     *
     * @return \Illuminate\View\View
     */
    public function renderNavigation()
    {
        return view('google-sheets-importer::navigation');
    }
}
