<?php

namespace App\Nova;

use App\Nova\Fields\CenteredText;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Code;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Nulisec\JsonSchema\JsonSchema;

class Setting extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Setting::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            Text::make('Name', function () { return $this->name; }),

            JsonSchema::make('Data', $this->schema),

            Code::make('RAW Data', 'data')->json()
                ->rules('json')
                ->onlyOnDetail(),

//            Code::make('Schema')->json()
//                ->rules('json')
//                ->hideWhenUpdating(),

            $this->getValue()->onlyOnIndex(),
        ];
    }

    public function getValue()
    {
        if (is_bool($this->value)) {
            return Boolean::make('Value', function () { return $this->value; });
        } else {
            return CenteredText::make('Value', function () { return $this->value; });
        }
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
