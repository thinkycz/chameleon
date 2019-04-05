<?php

namespace App\Nova;

use App\Nova\Actions\Order\ChangeOrderStatus;
use App\Nova\Actions\Order\ExportOrder;
use App\Nova\Actions\Order\PrintInvoice;
use App\Nova\Filters\OrderDeliveryMethod;
use App\Nova\Filters\OrderPaymentMethod;
use App\Nova\Filters\OrderPlacedStatus;
use App\Nova\Filters\OrderStatus;
use App\Nova\Metrics\NumberOfOrders;
use App\Nova\Metrics\OrdersPerDay;
use App\Nova\Metrics\OrdersPerStatus;
use Illuminate\Http\Request;
use Inspheric\Fields\Email;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Nulisec\PhoneField\PhoneNumber;

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
        'variable_symbol',
    ];

    public function subtitle()
    {
        return __('resources.customer') . ": {$this->user->name}";
    }

    /**
     * Get the displayable label of the resource.
     *
     * @return string
     */
    public static function label()
    {
        return __('resources.orders');
    }

    /**
     * Get the displayable singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel()
    {
        return __('resources.order');
    }

    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query->whereNotNull('placed_at');
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
            Text::make(__('resources.order_number'), 'order_number'),

            Text::make(__('resources.invoice_number'), 'invoice_number')->onlyOnDetail(),

            Text::make(__('resources.variable_symbol'), 'variable_symbol')->onlyOnDetail(),

            BelongsTo::make(__('resources.delivery_method'), 'deliveryMethod', DeliveryMethod::class)->onlyOnDetail(),

            BelongsTo::make(__('resources.payment_method'), 'paymentMethod', PaymentMethod::class)->onlyOnDetail(),

            new Panel(__('resources.dates'), $this->datesFields()),

            new Panel(__('resources.customer_details'), $this->customerDetailsFields()),

            BelongsTo::make(__('resources.status'), 'status', Status::class),

            Textarea::make(__('resources.notes'), 'notes'),

            HasMany::make(__('resources.ordered_items'), 'orderedItems', OrderedItem::class),
        ];
    }

    protected function datesFields()
    {
        return [
            Date::make(__('resources.placed_at'), 'placed_at'),

            Date::make(__('resources.tax_date'), 'tax_date')->onlyOnDetail(),

            Date::make(__('resources.due_date'), 'due_date')->onlyOnDetail(),
        ];
    }

    protected function customerDetailsFields()
    {
        return [
            BelongsTo::make(__('resources.user'), 'user', User::class)->searchable(),

            Email::make(__('resources.email'), 'email')->clickable(),

            PhoneNumber::make(__('resources.phone'), 'phone'),

            BelongsTo::make(__('resources.shipping_details'), 'shippingDetail', ShippingDetail::class)->onlyOnDetail(),

            BelongsTo::make(__('resources.billing_details'), 'billingDetail', BillingDetail::class)->onlyOnDetail(),

            Textarea::make(__('resources.customer_note'), 'customer_note'),
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
            (new NumberOfOrders()),
            (new OrdersPerDay()),
            (new OrdersPerStatus()),
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
        return [
            new OrderPlacedStatus(),
            new OrderStatus(),
            new OrderDeliveryMethod(),
            new OrderPaymentMethod(),
        ];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [
            new ChangeOrderStatus(),
            new ExportOrder(),
            new PrintInvoice(),
        ];
    }
}
