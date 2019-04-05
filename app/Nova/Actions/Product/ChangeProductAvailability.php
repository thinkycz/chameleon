<?php

namespace App\Nova\Actions\Product;

use App\Models\Availability;
use App\Models\Product;
use Illuminate\Bus\Queueable;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Laravel\Nova\Fields\Select;

class ChangeProductAvailability extends Action
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Get the displayable name of the action.
     *
     * @return string
     */
    public function name()
    {
        return __('actions.change_product_availability');
    }

    public function handle(ActionFields $fields, Collection $models)
    {
        $models->each(function (Product $product) use ($fields) {
            $product->update(['availability_id' => $fields->availability]);
        });
    }

    public function fields()
    {
        return [
            Select::make(__('actions.availability'))
                ->options(Availability::pluck('name', 'id')->toArray())
                ->displayUsingLabels(),
        ];
    }
}
