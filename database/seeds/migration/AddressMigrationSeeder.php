<?php

use App\Models\Address;
use App\Models\User;

class AddressMigrationSeeder extends BaseMigrationSeeder
{
    protected $pairs = [
        'first_name'   => 'firstname',
        'last_name'    => 'lastname',
        'city'         => 'city',
        'street'       => 'street',
        'zipcode'      => 'zipcode',
        'country_id'   => 'country_id',
        'phone'        => 'phone',
        'company_id'   => 'companyregnumber',
        'vat_id'       => 'vatnumber',
        'is_default'   => 'default',
        'company_name' => 'companyname',
        'user_id'      => 'user_id',

        /**
         * Default columns
         */
        'id'           => 'id',
        'created_at'   => 'created_at',
        'updated_at'   => 'updated_at',
    ];

    protected $oldTableName = 'addresses';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->execute(function ($item) {
            $item = $item->merge([
                'is_default' => $item->get('is_default') ?: false,
            ]);

            if (User::find($item->get('user_id'))) {
                Address::insert($item->toArray());
            }
        });
    }
}
