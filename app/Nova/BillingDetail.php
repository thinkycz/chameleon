<?php

namespace App\Nova;

use Nulisec\PhoneField\PhoneNumber;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Place;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class BillingDetail extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\BillingDetail::class;

    public static $displayInNavigation = false;

    public static $globallySearchable = false;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'company_name',
        'first_name',
        'last_name',
    ];

    /**
     * Get the displayable label of the resource.
     *
     * @return string
     */
    public static function label()
    {
        return __('resources.billing_details');
    }

    /**
     * Get the displayable singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel()
    {
        return __('resources.billing_detail');
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            Text::make(__('resources.company_name'), 'Company Name'),

            Text::make(__('resources.first_name'), 'First Name'),

            Text::make(__('resources.last_name'), 'Last Name'),

            Place::make(__('resources.street'), 'Street')
                ->city('city')
                ->postalCode('zipcode'),

            Text::make(__('resources.city'), 'City'),

            Text::make(__('resources.zipcode'), 'Zipcode'),

            PhoneNumber::make(__('resources.phone'), 'Phone'),

            Text::make(__('resources.company_id'), 'Company ID'),

            Text::make(__('resources.vat_id'), 'VAT ID'),

            BelongsTo::make(__('resources.country'), 'country', Country::class)->searchable(),

            BelongsTo::make(__('resources.user'), 'user', User::class)->searchable()
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
