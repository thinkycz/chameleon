<?php

namespace App\Nova;

use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Spatie\TagsField\Tags;

class Product extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Product::class;

    public static $group = 'Admin';

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
    public static $search = [
        'name',
        'barcode',
        'catalogue_number'
    ];

    public function subtitle()
    {
        if ($this->barcode) {
            return "EAN: {$this->barcode}";
        } elseif ($this->catalogue_number) {
            return "CAT: {$this->catalogue_number}";
        } else {
            return null;
        }
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Name'),

            Text::make('Slug')->onlyOnDetail(),

            Textarea::make('Description'),

            Trix::make('Details'),

            Number::make('VAT Rate', 'vatrate')->hideFromIndex(),

            BelongsTo::make('Parent', 'parent', static::class)->nullable()->searchable()->hideFromIndex(),

            new Panel('Inventory Options', $this->inventoryOptionsFields()),

            new Panel('Stock Options', $this->stockOptionsFields()),

            Boolean::make('Enabled'),

            HasMany::make('Subproducts', 'children', static::class),

            HasMany::make('Prices'),

            HasMany::make('Comments'),
        ];
    }

    protected function stockOptionsFields()
    {
        return [
            Number::make('Quantity In Stock'),

            Number::make('Minimum Order Quantity')->hideFromIndex(),

            BelongsTo::make('Availability'),

            BelongsTo::make('Unit')->hideFromIndex(),
        ];
    }

    protected function inventoryOptionsFields()
    {
        return [
            Text::make('Catalogue Number'),

            Text::make('Barcode'),

            Tags::make('Tags')->hideFromIndex(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
