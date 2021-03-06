<?php

namespace App\Models;

use App\Notifications\AccountActivated;
use App\Traits\ModelHasDateFormatted;
use App\Traits\User\UserHasGetters;
use App\Traits\User\UserHasMedia;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Nova\Actions\Actionable;
use Laravel\Passport\HasApiTokens;
use Silvanite\Brandenburg\Traits\HasRoles;
use Spatie\MediaLibrary\HasMedia\HasMedia;

class User extends Authenticatable implements MustVerifyEmail, HasMedia
{
    use HasApiTokens;
    use HasRoles;
    use Notifiable;
    use Actionable;

    use UserHasMedia;
    use UserHasGetters;
    use ModelHasDateFormatted;

    protected $appends = [
        'name',
    ];

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'company_id',
        'password',
        'activated_at',
        'locale',
        'price_level_id',
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

    public function setDefaultAddress(Address $address)
    {
        $this->addresses()->update([
            'is_default' => false,
        ]);

        return $address->update([
            'is_default' => true,
        ]);
    }

    public function activate($activated)
    {
        $this->update(['activated_at' => $activated]);

        return $this->notify(new AccountActivated());
    }

    public function canImpersonate()
    {
        return $this->hasRoleWithPermission('viewNova');
    }

    public function priceLevel()
    {
        return $this->belongsTo(PriceLevel::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
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
