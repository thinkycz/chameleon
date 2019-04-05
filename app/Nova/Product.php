<?php

namespace App\Nova;

use App\Nova\Actions\Product\ChangeProductAvailability;
use App\Nova\Actions\Product\ChangeProductEnabledStatus;
use App\Nova\Actions\Product\ChangeProductUnit;
use App\Nova\Actions\Product\SetMinimumOrderQuantity;
use App\Nova\Actions\Product\SetMultiplyOfMoqOnly;
use App\Nova\Actions\Product\SetStockQuantity;
use App\Nova\Actions\Product\SetVatRate;
use App\Nova\Filters\ProductAvailability;
use App\Nova\Filters\ProductEnabled;
use App\Nova\Filters\ProductHasImages;
use App\Nova\Filters\ProductUnit;
use App\Nova\Metrics\NumberOfProducts;
use App\Nova\Metrics\ProductsPerAvailability;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Panel;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;
use Nulisec\DropzoneField\DropzoneField;
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
        'catalogue_number',
    ];

    /**
     * Get the displayable label of the resource.
     *
     * @return string
     */
    public static function label()
    {
        return __('resources.products');
    }

    /**
     * Get the displayable singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel()
    {
        return __('resources.product');
    }

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

            Text::make(__('resources.name'), 'name'),

            Text::make(__('resources.slug'), 'slug')->onlyOnDetail(),

            Textarea::make(__('resources.description'), 'description'),

            Trix::make(__('resources.details'), 'details'),

            Number::make(__('resources.vat_rate'), 'vatrate')->hideFromIndex(),

            BelongsTo::make(__('resources.parent'), 'parent', Product::class)->nullable()->searchable()->hideFromIndex(),

            new Panel(__('resources.images'), $this->images()),

            new Panel(__('resources.inventory_options'), $this->inventoryOptionsFields()),

            new Panel(__('resources.stock_options'), $this->stockOptionsFields()),

            Boolean::make(__('resources.enabled'), 'enabled'),

            BelongsToMany::make(__('resources.categories'), 'categories', Category::class),

            HasMany::make(__('resources.prices'), 'prices', Price::class),

            HasMany::make(__('resources.properties'), 'properties', Property::class),

//            HasMany::make(__('resources.subproducts'), 'children', Product::class),

//            HasMany::make(__('resources.comments'), 'comments', Comment::class),
        ];
    }

    protected function images()
    {
        return [
            DropzoneField::make(__('resources.images'))->onlyOnDetail(),
        ];
    }

    protected function stockOptionsFields()
    {
        return [
            Number::make(__('resources.quantity_in_stock'), 'quantity_in_stock'),

            Number::make(__('resources.minimum_order_quantity'), 'minimum_order_quantity')->hideFromIndex(),

            Boolean::make(__('resources.multiply_of_moq_only'), 'multiply_of_moq_only'),

            BelongsTo::make(__('resources.availability'), 'availability', Availability::class),

            BelongsTo::make(__('resources.unit'), 'unit', Unit::class)->hideFromIndex(),
        ];
    }

    protected function inventoryOptionsFields()
    {
        return [
            Text::make(__('resources.catalogue_number'), 'catalogue_number'),

            Text::make(__('resources.barcode'), 'barcode'),

            Tags::make(__('resources.tags'), 'tags')->hideFromIndex(),
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
        return [
            (new NumberOfProducts),
            (new ProductsPerAvailability)->width('2/3'),
        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [
            new ProductAvailability(),
            new ProductUnit(),
            new ProductEnabled(),
            new ProductHasImages(),
        ];
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
        return [
            (new ChangeProductAvailability()),
            (new ChangeProductUnit()),
            (new ChangeProductEnabledStatus()),
            (new SetMinimumOrderQuantity()),
            (new SetMultiplyOfMoqOnly()),
            (new SetStockQuantity()),
            (new SetVatRate()),
            (new DownloadExcel()),
        ];
    }
}
