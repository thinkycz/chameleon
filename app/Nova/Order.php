<?php

namespace App\Nova;

use App\Nova\Metrics\NumberOfOrders;
use App\Nova\Metrics\OrdersPerDay;
use App\Nova\Metrics\OrdersPerStatus;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\HasMany;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;

class Order extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Order::class;

    public static $group = 'Admin';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'order_number';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'order_number',
        'invoice_number',
        'variable_symbol'
    ];

    public function subtitle()
    {
        return "Customer: {$this->user->name}";
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            Text::make('Order Number'),

            Text::make('Invoice Number')->onlyOnDetail(),

            Text::make('Variable Symbol')->onlyOnDetail(),

            BelongsTo::make('Delivery Method', 'deliveryMethod')->onlyOnDetail(),

            BelongsTo::make('Payment Method', 'paymentMethod')->onlyOnDetail(),

            new Panel('Dates', $this->datesFields()),

            new Panel('Customer Details', $this->customerDetailsFields()),

            BelongsTo::make('Status'),

            Textarea::make('Notes'),

            HasMany::make('Items', 'orderedItems', OrderedItem::class),
        ];
    }

    protected function datesFields()
    {
        return [
            Date::make('Placed At'),

            Date::make('Tax Date')->onlyOnDetail(),

            Date::make('Due Date')->onlyOnDetail(),
        ];
    }

    protected function customerDetailsFields()
    {
        return [
            BelongsTo::make('User')->searchable(),

            Text::make('Email'),

            Text::make('Phone'),

            BelongsTo::make('Shipping Details', 'shippingDetail')->onlyOnDetail(),

            BelongsTo::make('Billing Details', 'billingDetail')->onlyOnDetail(),

            Textarea::make('Customer Note'),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [
            (new NumberOfOrders),
            (new OrdersPerDay),
            (new OrdersPerStatus),
        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
