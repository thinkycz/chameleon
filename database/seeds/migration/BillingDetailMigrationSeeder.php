<?php

use App\Models\BillingDetail;
use App\Models\Country;

class BillingDetailMigrationSeeder extends BaseMigrationSeeder
{
    protected $pairs = [
        'company_name' => 'companyname',
        'company_id'   => 'companyregnumber',
        'vat_id'       => 'vatnumber',
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

    protected $oldTableName = 'billing_informations';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->execute(function ($item) {
            $item = $item->merge([
                'country_id' => Country::whereIsocode3($item->get('country_id'))->first()->id,
            ]);

            BillingDetail::insert($item->toArray());
        });
    }
}
