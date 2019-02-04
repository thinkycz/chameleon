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

    public function handle(ActionFields $fields, Collection $models)
    {
        $models->each(function (User $user) use ($fields) {
            $user->update(['locale' => $fields->locale]);
        });
    }

    public function fields()
    {
        return [
            Select::make('Locale')
                ->options(Locale::all())
                ->displayUsingLabels(),
        ];
    }
}
