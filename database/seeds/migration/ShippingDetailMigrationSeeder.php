<?php

use App\Models\Country;
use App\Models\ShippingDetail;

class ShippingDetailMigrationSeeder extends BaseMigrationSeeder
{
    protected $pairs = [
        'company_name' => 'companyname',
        'first_name'   => 'firstname',
        'last_name'    => 'lastname',
        'city'         => 'city',
        'street'       => 'street',
        'zipcode'      => 'zipcode',
        'phone'        => 'phone',
        'country_id'   => 'country_isocode',
        'user_id'      => 'user_id',

        /**
         * Default columns
         */
        'id'           => 'id',
        'created_at'   => 'created_at',
        'updated_at'   => 'updated_at',
    ];

    protected $oldTableName = 'shipping_informations';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = $this->prepare($array = false);
        $data = $data->map(function ($item) {
            return $item->merge([
                'country_id' => Country::whereIsocode3($item->get('country_id'))->first()->id,
            ]);;
        });

        ShippingDetail::insert($data->toArray());
    }
}
