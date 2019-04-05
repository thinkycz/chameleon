<?php

namespace App\Models;

use App\Traits\ModelHasDateFormatted;
use App\Traits\Order\OrderHasProcessors;
use App\Traits\Order\OrderHasProducts;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Actions\Actionable;

class Order extends Model
{
    use Actionable;
    use ModelHasDateFormatted;
    use OrderHasProducts;
    use OrderHasProcessors;

    protected $appends = [
        'formatted_created_at',
        'formatted_total_price',
        'formatted_total_price_excl_vat',
    ];

    protected $fillable = [
        'placed_at',
        'order_number',
        'invoice_number',
        'variable_symbol',
        'tax_date',
        'due_date',
        'email',
        'phone',
        'notes',
        'customer_note',
        'status_id',
        'delivery_method_id',
        'payment_method_id',
    ];

    protected $dates = [
        'placed_at',
        'tax_date',
        'due_date',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setAttribute('order_number', generator()->orderNumber());
        $this->setAttribute('invoice_number', generator()->invoiceNumber());
        $this->setAttribute('variable_symbol', generator()->variableSymbol());
        $this->setAttribute('tax_date', Carbon::now());
        $this->setAttribute('due_date', Carbon::now()->addDays(7));
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function shippingDetail()
    {
        return $this->belongsTo(ShippingDetail::class);
    }

    public function billingDetail()
    {
        return $this->belongsTo(BillingDetail::class);
    }

    public function deliveryMethod()
    {
        return $this->belongsTo(DeliveryMethod::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function orderedItems()
    {
        return $this->hasMany(OrderedItem::class);
    }

    public function getTotalPriceAttribute()
    {
        return $this->orderedItems->sum(function ($item) {
            return $item->total_price;
        });
    }

    public function getFormattedTotalPriceAttribute()
    {
        return showPriceWithCurrency($this->total_price, currentCurrency());
    }

    public function getTotalPriceExclVatAttribute()
    {
        return $this->orderedItems->sum(function ($item) {
            return $item->total_price_excl_vat;
        });
    }

    public function getFormattedTotalPriceExclVatAttribute()
    {
        return showPriceWithCurrency($this->total_price_excl_vat, currentCurrency());
    }

    public function hasOrderedItems()
    {
        return $this->orderedItems()->count();
    }

    public function setStatus(Status $status)
    {
        if ($this->status && $this->status->is($status)) {
            return false;
        }

        return $this->update(['status_id' => $status->id]);
    }

    public function complete()
    {
        $this->setStatus(preferenceRepository()->getCreatedOrderStatus());
        $this->update(['placed_at' => Carbon::now()]);

        return $this->fresh()->load('orderedItems.product', 'status', 'deliveryMethod', 'billingDetail', 'paymentMethod', 'shippingDetail');
    }
}
