<?php

namespace App\Nova\Actions\User;

use App\Enums\Locale;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Select;

class ChangeUserLocale extends Action
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Get the displayable name of the action.
     *
     * @return string
     */
    public function name()
    {
        return __('actions.change_user_locale');
    }

    public function handle(ActionFields $fields, Collection $models)
    {
        $models->each(function (User $user) use ($fields) {
            $user->update(['locale' => $fields->locale]);
        });
    }

    public function fields()
    {
        return [
            Select::make(__('actions.locale'))
                ->options(Locale::all())
                ->displayUsingLabels(),
        ];
    }
}
