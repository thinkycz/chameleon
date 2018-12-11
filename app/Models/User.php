<?php

namespace App\Models;

use App\Traits\ModelHasDateFormatted;
use App\Traits\User\UserHasMedia;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia\HasMedia;

class User extends Authenticatable implements MustVerifyEmail, HasMedia
{
    use Notifiable;
    use UserHasMedia;
    use ModelHasDateFormatted;

    protected $fillable = [
        'first_name', 'last_name', 'email', 'phone', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = [
        'birth_date',
    ];

    public static function getAuthenticatedUser()
    {
        return auth()->user();
    }

    public function changePassword($newPassword)
    {
        if (!empty($newPassword)) {
            $this->update([
                'password' => bcrypt($newPassword),
            ]);
        }
    }

    public function priceLevel()
    {
        return $this->belongsTo(PriceLevel::class);
    }

    public function billingDetails()
    {
        return $this->hasMany(BillingDetail::class);
    }

    public function shippingDetails()
    {
        return $this->hasMany(ShippingDetail::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class)->whereNotNull('placed_at');
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function getNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public static function getActiveBasket()
    {
        return auth()->check() ? static::getAuthenticatedUser()->getBasket() : null;
    }

    public function getBasket()
    {
        return $this->orders()
            ->with('orderedItems.product')
            ->whereNull('placed_at')
            ->firstOrCreate([
                'email' => $this->email,
                'phone' => $this->phone,
            ]);
    }
}
