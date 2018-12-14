<?php

namespace App\Nova\Actions\User;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Laravel\Nova\Fields\Select;

class ChangeUserActivationStatus extends Action
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields $fields
     * @param  \Illuminate\Support\Collection $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $activated = $fields->activation_status == 'active' ? now() : null;

        $models->each(function (User $user) use ($activated) {
            $user->update(['activated_at' => $activated]);
        });
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [
            Select::make('Activation Status')->options([
                'active'   => 'Active',
                'inactive' => 'Inactive'
            ])->displayUsingLabels()
        ];
    }
}
