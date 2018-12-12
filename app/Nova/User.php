<?php

namespace App\Nova;

use App\Enums\Locale;
use App\Nova\Metrics\NumberOfUsers;
use App\Nova\Metrics\UsersPerDay;
use App\Nova\Metrics\UsersPerPriceLevel;
use Bissolli\NovaPhoneField\PhoneNumber;
use Inspheric\Fields\Email;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Gravatar;
use Laravel\Nova\Fields\Password;
use Silvanite\NovaToolPermissions\Role;

class User extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\User::class;

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
        'first_name',
        'last_name',
        'email',
        'phone'
    ];

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

            Gravatar::make(),

            Text::make('Name')
                ->onlyOnIndex(),

            Text::make('First Name')
                ->sortable()
                ->rules('required', 'max:255')
                ->hideFromIndex(),

            Text::make('Last Name')
                ->sortable()
                ->rules('required', 'max:255')
                ->hideFromIndex(),

            Date::make('Birth Date')
                ->format('DD.MM.YYYY')
                ->hideFromIndex(),

            Email::make('Email')
                ->sortable()
                ->clickable()
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}'),

            PhoneNumber::make('Phone'),

            Select::make('Locale')
                ->options(Locale::all())
                ->displayUsingLabels()
                ->hideFromIndex(),

            Password::make('Password')
                ->onlyOnForms()
                ->creationRules('required', 'string', 'min:6')
                ->updateRules('nullable', 'string', 'min:6'),

            BelongsTo::make('Price Level', 'priceLevel'),

            Boolean::make('Is Active')->onlyOnIndex(),

            DateTime::make('Activated At')->hideFromIndex(),

            Boolean::make('Pending Activation')->hideFromIndex(),

            HasMany::make('Addresses'),

            BelongsToMany::make('Roles', 'roles', Role::class),
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
            (new NumberOfUsers),
            (new UsersPerDay),
            (new UsersPerPriceLevel)
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
