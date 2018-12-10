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
