<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_completed_at',
        'order_number',
        'invoice_number',
        'variable_symbol',
        'tax_date',
        'due_date',
        'email',
        'phone',
        'noted',
        'customer_note',
    ];

    protected $dates = [
        'order_completed_at',
        'issue_date',
        'tax_date',
        'due_date',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setAttribute('order_number', generator()->orderNumber());
        $this->setAttribute('invoice_number', generator()->invoiceNumber());
        $this->setAttribute('variable_symbol', generator()->variableSymbol());
        $this->setAttribute('issue_date', Carbon::now());
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
}
