<?php

namespace App\Nova;

use App\Nova\Actions\Category\ChangeCategoryEnabledStatus;
use App\Nova\Filters\CategoryEnabled;
use App\Nova\Filters\CategoryShowSubcategories;
use App\Nova\Metrics\NumberOfCategories;
use App\Nova\Metrics\ProductsPerCategory;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\HasMany;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Nulisec\TranslatableText\TranslatableText;

class Category extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Category::class;

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
    public static $search = ['name'];

    /**
     * Get the displayable label of the resource.
     *
     * @return string
     */
    public static function label()
    {
        return __('resources.categories');
    }

    /**
     * Get the displayable singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel()
    {
        return __('resources.category');
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
            TranslatableText::make(__('resources.name'), 'name'),

            Text::make(__('resources.slug'), 'slug')->onlyOnDetail(),

            Number::make(__('resources.position'), 'position'),

            Number::make(__('resources.products_count'), function () {
                return $this->products->count();
            }),

            Boolean::make(__('resources.enabled'), 'enabled'),

            BelongsTo::make(__('resources.parent'), 'parent', Category::class)->nullable()->searchable()->hideFromIndex(),

            HasMany::make(__('resources.subcategories'), 'children', Category::class),

            BelongsToMany::make(__('resources.products'), 'products', Product::class)
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
        return [
            (new NumberOfCategories),
            (new ProductsPerCategory)->width('2/3'),
        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [
            new CategoryShowSubcategories(),
            new CategoryEnabled(),
        ];
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
        return [
            (new ChangeCategoryEnabledStatus()),
        ];
    }
}
