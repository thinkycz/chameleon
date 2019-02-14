<?php

namespace App\Nova;

use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Code;
use Laravel\Nova\Fields\Currency;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;

class OrderedItem extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\OrderedItem::class;

    public static $displayInNavigation = false;

    public static $globallySearchable = false;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = ['name'];

    /**
     * Get the displayable label of the resource.
     *
     * @return string
     */
    public static function label()
    {
        return __('resources.ordered_items');
    }

    /**
     * Get the displayable singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel()
    {
        return __('resources.ordered_item');
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
            Text::make(__('resources.name'), 'name'),

            Textarea::make(__('resources.description'), 'Description'),

            Trix::make(__('resources.details'), 'Details'),

            Number::make(__('resources.quantity_ordered'), 'quantity_ordered'),

            Currency::make(__('resources.price'), 'price'),

            Number::make(__('resources.vat_rate'), 'vatrate'),

            new Panel(__('resources.inventory_options'), $this->inventoryOptionsFields()),

            BelongsTo::make(__('resources.order'), 'order', Order::class)->searchable(),

            BelongsTo::make(__('resources.product'), 'product', Product::class)->searchable(),

            Code::make(__('resources.options'), 'options'),
        ];
    }

    protected function inventoryOptionsFields()
    {
        return [
            Text::make(__('resources.catalogue_number'), 'catalogue_number'),

            Text::make(__('resources.barcode'), 'barcode'),
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
