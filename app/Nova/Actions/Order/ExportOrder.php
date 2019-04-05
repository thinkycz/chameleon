<?php

namespace App\Nova\Actions\Order;

use App\Exports\OrderExport;
use App\Models\Order;
use Excel;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Storage;
use ZanySoft\Zip\Zip;

class ExportOrder extends Action
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Get the displayable name of the action.
     *
     * @return string
     */
    public function name()
    {
        return __('actions.export_order');
    }

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields $fields
     * @param  \Illuminate\Support\Collection $models
     * @return mixed
     * @throws \Exception
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $files = collect([]);

        $models->each(function (Order $order) use ($files) {
            $files->push($this->handleOrder($order));
        });

        $zip = $this->zipFiles($files);

        return Action::download($zip->get('path'), $zip->get('name'));
    }

    private function handleOrder(Order $order)
    {
        $fileName = "exports/order-{$order->order_number}.xlsx";

        Excel::store(new OrderExport($order), $fileName, 'public');

        return Storage::disk('public')->path($fileName);
    }

    /**
     * First we create a blank zip file, and add all the exported excel
     * files from the orders. Then we delete the files, and return the
     * path to the zip file.
     *
     * @param \Illuminate\Support\Collection $files
     * @return \Illuminate\Support\Collection
     * @throws \Exception
     */
    private function zipFiles($files)
    {
        $time = time();
        $zipFileName = "exports/orders-{$time}.zip";
        Storage::disk('public')->put($zipFileName, '');

        $zip = Zip::create(Storage::disk('public')->path($zipFileName));
        $zip->add($files->toArray());
        $zip->close();

        $files->each(function ($file) {
            File::delete($file);
        });

        return collect([
            'path' => Storage::disk('public')->url($zipFileName),
            'name' => last(explode('/', $zipFileName)),
        ]);
    }
}
