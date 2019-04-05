<?php

namespace App\Exports;

use App\Exports\ProfileData\AddressSheet;
use App\Exports\ProfileData\BillingDetailsSheet;
use App\Exports\ProfileData\OrderSheet;
use App\Exports\ProfileData\ShippingDetailsSheet;
use App\Exports\ProfileData\UserSheet;
use App\Models\User;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class ProfileDataExport implements WithMultipleSheets, WithStrictNullComparison
{
    use Exportable;

    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return array
     */
    public function sheets(): array
    {
        $this->user->load('addresses', 'billingDetails', 'orders', 'shippingDetails');

        return [
            new UserSheet($this->user),
            new AddressSheet($this->user->addresses),
            new OrderSheet($this->user->orders),
            new ShippingDetailsSheet($this->user->shippingDetails),
            new BillingDetailsSheet($this->user->billingDetails),
        ];
    }
}
