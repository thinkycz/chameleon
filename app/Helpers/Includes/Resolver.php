<?php

/*
 * @return \App\Helpers\Tools\Snackbar
 */
if (!function_exists('snackbar')) {
    function snackbar()
    {
        return App::make('Snackbar');
    }
}

/*
 * @return \App\Helpers\Tools\Generator
 */
if (!function_exists('generator')) {
    function generator()
    {
        return App::make('Generator');
    }
}

/*
 * @return \App\Services\InstanceCache
 */
if (!function_exists('instanceCache')) {
    function instanceCache()
    {
        return App::make('InstanceCache');
    }
}

/*
 * @return \App\Repositories\PreferenceRepository
 */
if (!function_exists('preferenceRepository')) {
    function preferenceRepository()
    {
        return App::make('PreferenceRepository');
    }
}

/*
 * @return \App\Repositories\SettingsRepository
 */
if (!function_exists('settingsRepository')) {
    function settingsRepository()
    {
        return App::make('SettingsRepository');
    }
}
