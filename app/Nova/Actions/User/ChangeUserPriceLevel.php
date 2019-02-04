<?php

namespace App\Nova\Actions\User;

use App\Models\PriceLevel;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Select;

class ChangeUserPriceLevel extends Action
{
    use InteractsWithQueue, Queueable, SerializesModels;

    public function handle(ActionFields $fields, Collection $models)
    {
        $models->each(function (User $user) use ($fields) {
            $user->update(['price_level_id' => $fields->price_level]);
        });
    }

    public function fields()
    {
        return [
            Select::make('Price Level')
                ->options(PriceLevel::pluck('name', 'id')->toArray())
                ->displayUsingLabels(),
        ];
    }
}
