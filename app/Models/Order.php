<?php

namespace App\Models;

use App\Traits\ModelHasDateFormatted;
use App\Traits\Order\OrderHasProducts;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use ModelHasDateFormatted;
    use OrderHasProducts;

    protected $appends = [
        'formatted_created_at',
        'formatted_total_price',
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
        'noted',
        'customer_note',
        'status_id'
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
        return showPriceWithCurrency($this->total_price);
    }
}
