<?php

use App\Models\User;

class UserMigrationSeeder extends BaseMigrationSeeder
{
    protected $pairs = [
        'first_name'        => 'firstname',
        'last_name'         => 'lastname',
        'email'             => 'email',
        'email_verified_at' => 'verified',
        'phone'             => 'phone',
        'password'          => 'password',
        'activated_at'      => 'verified',
        'locale'            => 'locale',
        'price_level_id'    => 'price_level_id',
        'currency_id'       => 'currency_id',
        'notes'             => 'notes',
        'birth_date'        => 'birthdate',

        /**
         * Default columns
         */
        'id'                => 'id',
        'created_at'        => 'created_at',
        'updated_at'        => 'updated_at',
    ];

    protected $oldTableName = 'users';

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
                'birth_date'        => $item->get('birth_date') ? $item->get('birth_date') : null,
                'email_verified_at' => $item->get('email_verified_at') ? $item->get('created_at') : null,
                'activated_at'      => $item->get('activated_at') ? $item->get('created_at') : null,
                'locale'            => $item->get('locale') !== 'vi' ?: 'cs',
            ]);
        });

        User::insert($data->toArray());
    }
}
