<?php

namespace App\Nova;

use App\Enums\Locale;
use App\Nova\Actions\User\ChangeUserActivationStatus;
use App\Nova\Actions\User\ChangeUserLocale;
use App\Nova\Actions\User\ChangeUserPriceLevel;
use App\Nova\Filters\UserActive;
use App\Nova\Filters\UserPriceLevel;
use App\Nova\Metrics\NumberOfUsers;
use App\Nova\Metrics\UsersPerDay;
use App\Nova\Metrics\UsersPerPriceLevel;
use Illuminate\Http\Request;
use Inspheric\Fields\Email;
use KABBOUCHI\NovaImpersonate\Impersonate;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;
use Nulisec\PhoneField\PhoneNumber;
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
        'phone',
    ];

    /**
     * Get the displayable label of the resource.
     *
     * @return string
     */
    public static function label()
    {
        return __('resources.users');
    }

    /**
     * Get the displayable singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel()
    {
        return __('resources.user');
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

            Image::make(__('resources.image'), 'image')->hideFromIndex(),

            Text::make(__('resources.name'), 'name')
                ->onlyOnIndex(),

            Text::make(__('resources.first_name'), 'first_name')
                ->sortable()
                ->rules('required', 'max:255')
                ->hideFromIndex(),

            Text::make(__('resources.last_name'), 'last_name')
                ->sortable()
                ->rules('required', 'max:255')
                ->hideFromIndex(),

            Date::make(__('resources.birth_date'), 'birth_date')
                ->format('DD.MM.YYYY')
                ->hideFromIndex(),

            Email::make(__('resources.email'), 'email')
                ->sortable()
                ->clickable()
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}'),

            PhoneNumber::make(__('resources.phone'), 'phone'),

            Select::make(__('resources.locale'), 'locale')
                ->options(Locale::all())
                ->displayUsingLabels()
                ->hideFromIndex(),

            Password::make(__('resources.password'), 'password')
                ->onlyOnForms()
                ->creationRules('required', 'string', 'min:6')
                ->updateRules('nullable', 'string', 'min:6'),

            BelongsTo::make(__('resources.price_level'), 'priceLevel', PriceLevel::class),

            Boolean::make(__('resources.is_active'), 'is_active')->onlyOnIndex(),

            DateTime::make(__('resources.activated_at'), 'activated_at')->hideFromIndex(),

            HasMany::make(__('resources.addresses'), 'addresses', Address::class),

            BelongsToMany::make(__('resources.roles'), 'roles', Role::class),

            Impersonate::make($this),
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
            (new UsersPerPriceLevel),
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
            new UserPriceLevel(),
            new UserActive(),
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
            (new ChangeUserActivationStatus()),
            (new ChangeUserPriceLevel()),
            (new ChangeUserLocale()),
            (new DownloadExcel()),
        ];
    }
}
