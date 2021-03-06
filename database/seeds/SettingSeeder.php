<?php

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::updateOrCreate(['code' => 'store_settings'], [
            'schema' => [
                'type'       => 'object',
                'required'   => ['name', 'description', 'keywords'],
                'properties' => [
                    'name'        => ['type' => 'string'],
                    'description' => ['type' => 'string'],
                    'keywords'    => ['type' => 'string'],
                    'logo'        => ['type' => 'image'],
                    'favicon'     => ['type' => 'image'],
                ],
            ],
            'data'   => [
                'name'        => 'Chameleon',
                'description' => 'Chameleon Store',
                'keywords'    => 'store,ecommerce,eshop',
                'logo'        => null,
                'favicon'     => null,
            ],
        ]);

        Setting::updateOrCreate(['code' => 'homepage'], [
            'schema' => [
                'type'       => 'object',
                'required'   => [],
                'properties' => [
                    'banner_heading'     => ['type' => 'string'],
                    'banner_subheading'  => ['type' => 'string'],
                    'banner_action_link' => ['type' => 'string'],
                    'banner_action_text' => ['type' => 'string'],
                ],
            ],
            'data'   => [
                'banner_heading'     => 'Placing your order with us is easy.',
                'banner_subheading'  => 'You can browse products through categories, and you can also use the search bar to look for products using barcodes and SKUs. When you find the goods you need, add them to your basket and complete the checkout process to place your order',
                'banner_action_text' => 'Shop Now',
                'banner_action_link' => '/categories',
            ],
        ]);

        Setting::updateOrCreate(['code' => 'company_details'], [
            'schema' => [
                'type'       => 'object',
                'required'   => ['name'],
                'properties' => [
                    'name'       => ['type' => 'string'],
                    'about'      => ['type' => 'string'],
                    'street'     => ['type' => 'string'],
                    'city'       => ['type' => 'string'],
                    'zipcode'    => ['type' => 'string'],
                    'id'         => ['type' => 'string'],
                    'vatid'      => ['type' => 'string'],
                    'email'      => ['type' => 'string'],
                    'phone'      => ['type' => 'string'],
                    'vat_payer'  => ['type' => 'boolean'],
                    'google_map' => ['type' => 'string'],
                ],
            ],
            'data'   => [
                'name'       => 'Nulisec',
                'about'      => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam at sapien sit amet nunc vulputate sodales. ',
                'street'     => 'V Lužích 6',
                'city'       => 'Prague 4',
                'zipcode'    => '142 00',
                'id'         => '06359621',
                'vatid'      => 'CZ06359621',
                'email'      => 'team@nulisec.com',
                'phone'      => '+420 702 096 113',
                'vat_payer'  => true,
                'google_map' => '',
            ],
        ]);

        Setting::updateOrCreate(['code' => 'business_hours'], [
            'schema' => [
                'type'       => 'object',
                'required'   => [],
                'properties' => [
                    'mo' => ['type' => 'string'],
                    'tu' => ['type' => 'string'],
                    'we' => ['type' => 'string'],
                    'th' => ['type' => 'string'],
                    'fr' => ['type' => 'string'],
                    'sa' => ['type' => 'string'],
                    'su' => ['type' => 'string'],
                ],
            ],
            'data'   => [
                'mo' => '8:00 - 18:00',
                'tu' => '8:00 - 18:00',
                'we' => '8:00 - 18:00',
                'th' => '8:00 - 18:00',
                'fr' => '8:00 - 18:00',
                'sa' => '8:00 - 18:00',
                'su' => 'closed',
            ],
        ]);

        Setting::updateOrCreate(['code' => 'shopping_policy'], [
            'schema' => [
                'type'       => 'object',
                'required'   => [],
                'properties' => [
                    'company_id_required'       => ['type' => 'boolean'],
                    'hide_out_of_stock'         => ['type' => 'boolean'],
                    'hide_prices_for_guests'    => ['type' => 'boolean'],
                    'allow_residual_qty_orders' => ['type' => 'boolean'],
                ],
            ],
            'data'   => [
                'company_id_required'       => true,
                'hide_out_of_stock'         => false,
                'hide_prices_for_guests'    => true,
                'allow_residual_qty_orders' => true,
            ],
        ]);

        Setting::updateOrCreate(['code' => 'verification_policy'], [
            'schema' => [
                'type'       => 'object',
                'required'   => [],
                'properties' => [
                    'require_admin_verification'      => ['type' => 'boolean'],
                    'require_email_verification'      => ['type' => 'boolean'],
                    'require_address_on_registration' => ['type' => 'boolean'],
                ],
            ],
            'data'   => [
                'require_admin_verification'      => true,
                'require_email_verification'      => false,
                'require_address_on_registration' => true,
            ],
        ]);

        Setting::updateOrCreate(['code' => 'watermark_settings'], [
            'schema' => [
                'type'       => 'object',
                'required'   => [],
                'properties' => [
                    'enabled'  => ['type' => 'boolean'],
                    'image'    => ['type' => 'string'],
                    'opacity'  => ['type' => 'number'],
                    'position' => ['type' => 'string'],
                ],
            ],
            'data'   => [
                'enabled'  => false,
                'image'    => '',
                'opacity'  => 50,
                'position' => 'center',
            ],
        ]);

        Setting::updateOrCreate(['code' => 'recaptcha_enabled'], [
            'schema' => [
                'type'       => 'object',
                'required'   => ['value'],
                'properties' => [
                    'value' => ['type' => 'boolean'],
                ],
            ],
            'data'   => [
                'value' => true,
            ],
        ]);

        Setting::updateOrCreate(['code' => 'exchange_rate_multiply'], [
            'schema' => [
                'type'       => 'object',
                'required'   => ['value'],
                'properties' => [
                    'value' => ['type' => 'boolean'],
                ],
            ],
            'data'   => [
                'value' => false,
            ],
        ]);

        Setting::updateOrCreate(['code' => 'custom_footer_link_1'], [
            'schema' => [
                'type'       => 'object',
                'required'   => [],
                'properties' => [
                    'title' => ['type' => 'string'],
                    'link'  => ['type' => 'string'],
                ],
            ],
            'data'   => [
                'title' => null,
                'link'  => null,
            ],
        ]);

        Setting::updateOrCreate(['code' => 'custom_footer_link_2'], [
            'schema' => [
                'type'       => 'object',
                'required'   => [],
                'properties' => [
                    'title' => ['type' => 'string'],
                    'link'  => ['type' => 'string'],
                ],
            ],
            'data'   => [
                'title' => null,
                'link'  => null,
            ],
        ]);

        Setting::updateOrCreate(['code' => 'mail_configuration'], [
            'schema' => [
                'type'       => 'object',
                'required'   => [],
                'properties' => [
                    'host'         => ['type' => 'string'],
                    'port'         => ['type' => 'string'],
                    'from_address' => ['type' => 'string'],
                    'from_name'    => ['type' => 'string'],
                    'username'     => ['type' => 'string'],
                    'password'     => ['type' => 'string'],
                    'encryption'   => ['type' => 'string'],
                ],
            ],
            'data'   => [
                'host'         => 'smtp.mailtrap.io',
                'port'         => '2525',
                'from_address' => 'email@chameleon.com',
                'from_name'    => 'Chameleon',
                'username'     => null,
                'password'     => null,
                'encryption'   => null,
            ],
        ]);

    }
}
