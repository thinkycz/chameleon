<?php

namespace App\Models;

use App\Traits\ModelHasDateFormatted;
use App\Traits\User\UserHasGetters;
use App\Traits\User\UserHasMedia;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Silvanite\Brandenburg\Traits\HasRoles;
use Spatie\MediaLibrary\HasMedia\HasMedia;

class User extends Authenticatable implements MustVerifyEmail, HasMedia
{
    use HasApiTokens;
    use HasRoles;
    use Notifiable;

    use UserHasMedia;
    use UserHasGetters;
    use ModelHasDateFormatted;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'password',
        'activated_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $dates = [
        'birth_date',
        'activated_at',
    ];

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

    public function allOrders()
    {
        return $this->hasMany(Order::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
