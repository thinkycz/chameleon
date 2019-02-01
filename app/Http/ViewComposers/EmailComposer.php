<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

class EmailComposer
{
    public function compose(View $view)
    {
        $view->with('companyDetails', settingsRepository()->configuration('company_details'));
    }
}
