<?php

use App\Enums\Locale;
use App\Models\Availability;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Page;
use App\Models\Preference;
use App\Models\PriceLevel;
use App\Models\Status;
use App\Models\StoreStatus;
use App\Models\Unit;
use Illuminate\Database\Seeder;

class PreferenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Preference::updateOrCreate(['code' => 'default_country'], [
            'name' => [
                Locale::ENGLISH => 'Default Country',
                Locale::CZECH => 'Výchozí země',
                Locale::VIETNAMESE => 'Chọn quốc gia',
            ],
            'description' => [
                Locale::ENGLISH => 'Set the default country for this store.',
                Locale::CZECH => 'Nastavit zemi jako výchozí',
                Locale::VIETNAMESE => 'Đặt quốc gia được mặc định cho cửa hàng này.',
            ],
            'preferable_id' => Country::whereIsocode3('CZE')->first()->id,
            'preferable_type' => Country::class
        ]);

        Preference::updateOrCreate(['code' => 'default_currency'], [
            'name' => [
                Locale::ENGLISH => 'Default Currency',
                Locale::CZECH => 'Výchozí měna',
                Locale::VIETNAMESE => 'Chọn Tiền tệ',
            ],
            'description' => [
                Locale::ENGLISH => 'Set the default currency for this store.',
                Locale::CZECH => 'Nastavit měnu jako výchozí.',
                Locale::VIETNAMESE => 'Đặt đơn vị tiền tệ mặc định cho cửa hàng này.',
            ],
            'preferable_id' => Currency::whereIsocode('CZK')->first()->id,
            'preferable_type' => Currency::class
        ]);

        Preference::updateOrCreate(['code' => 'default_price_level'], [
            'name' => [
                Locale::ENGLISH => 'Default Price Level',
                Locale::CZECH => 'Výchozí cenová úroveň',
                Locale::VIETNAMESE => 'Chọn mức giá thường',
            ],
            'description' => [
                Locale::ENGLISH => 'Set the default price level for customers of this store.',
                Locale::CZECH => 'Nastavit cenovou úroveň jako výchozí.',
                Locale::VIETNAMESE => 'Đặt mức giá mặc định cho khách hàng của cửa hàng này.',
            ],
            'preferable_id' => PriceLevel::where('name->en', 'Regular')->first()->id,
            'preferable_type' => PriceLevel::class
        ]);

        Preference::updateOrCreate(['code' => 'default_availability_in_stock'], [
            'name' => [
                Locale::ENGLISH => 'In Stock Availability',
                Locale::CZECH => 'Skladová dostupnost při naskladnění',
                Locale::VIETNAMESE => 'Tình trạng của sản phẩm trong kho',
            ],
            'description' => [
                Locale::ENGLISH => 'Set the default availability option when the product is in stock. This option will be set automatically when creating a new product.',
                Locale::CZECH => 'Nastavte výchozí možnost dostupnosti, pokud je produkt na skladě. Tato možnost bude automaticky nastavena při vytváření nového produktu.',
                Locale::VIETNAMESE => 'Đặt tuỳ chọn tình trạng: còn hàng mặc định khi sản phẩm có trong kho. Tùy chọn này sẽ được đặt tự động khi tạo một sản phẩm mới.',
            ],
            'preferable_id' => Availability::whereCode('in-stock')->first()->id,
            'preferable_type' => Availability::class
        ]);

        Preference::updateOrCreate(['code' => 'default_availability_out_of_stock'], [
            'name' => [
                Locale::ENGLISH => 'Out Of Stock Availability',
                Locale::CZECH => 'Skladová dostupnost při vyprodání',
                Locale::VIETNAMESE => 'Tình trạng của sản phẩm đã hết',
            ],
            'description' => [
                Locale::ENGLISH => 'Set the default availability option when the product is not in stock. This option will be set automatically when quantity in stock becomes less than minimum order quantity, and product\'s availability does not allow negative quantity.',
                Locale::CZECH => 'Nastavte výchozí možnost dostupnosti, pokud produkt není na skladě. Tato možnost bude automaticky nastavena, pokud bude množství na skladě nižší než minimální objednané množství a dostupnost produktu neumožňuje záporné množství',
                Locale::VIETNAMESE => 'Đặt tuỳ chọn tình trạng: hết hàng mặc định khi sản phẩm không có trong kho. Tùy chọn này sẽ được đặt tự động khi số lượng hàng tồn kho ít hơn số lượng đặt hàng tối thiểu.',
            ],
            'preferable_id' => Availability::whereCode('out-of-stock')->first()->id,
            'preferable_type' => Availability::class
        ]);

        Preference::updateOrCreate(['code' => 'default_quantitative_unit'], [
            'name' => [
                Locale::ENGLISH => 'Default Quantitative Unit',
                Locale::CZECH => 'Výchozí množstevní jednotka',
                Locale::VIETNAMESE => 'Đơn vị định lượng',
            ],
            'description' => [
                Locale::ENGLISH => 'This unit will be set when the product is created.',
                Locale::CZECH => 'Tato množstevní jednotka bude použita při vytváření nového produktu',
                Locale::VIETNAMESE => 'Đơn vị định lượng này sẽ được dùng lúc tạo mặt hàng mới.',
            ],
            'preferable_id' => Unit::whereCode('piece')->first()->id,
            'preferable_type' => Unit::class
        ]);

        Preference::updateOrCreate(['code' => 'created_order_status'], [
            'name' => [
                Locale::ENGLISH => 'Created Order Status',
                Locale::CZECH => 'Stav objednávky při založení',
                Locale::VIETNAMESE => 'Trạng thái đơn đặt hàng đã tạo',
            ],
            'description' => [
                Locale::ENGLISH => 'This order status will be set automatically when order is created.',
                Locale::CZECH => 'Tento stav objednávky bude automaticky nastaven při vytvoření objednávky.',
                Locale::VIETNAMESE => 'Trạng thái đơn đặt hàng này sẽ được đặt tự động khi quý khách đặt hàng.',
            ],
            'preferable_id' => Status::whereCode('waiting-for-confirmation')->first()->id,
            'preferable_type' => Status::class
        ]);

        Preference::updateOrCreate(['code' => 'confirmed_order_status'], [
            'name' => [
                Locale::ENGLISH => 'Confirmed Order Status',
                Locale::CZECH => 'Stav objednávky při potvrzení',
                Locale::VIETNAMESE => 'Trạng thái đơn đặt hàng được xác nhận',
            ],
            'description' => [
                Locale::ENGLISH => 'This order status will be set automatically when order is confirmed.',
                Locale::CZECH => 'Tento stav objednávky bude automaticky nastaven při potvrzení objednávky.',
                Locale::VIETNAMESE => 'Trạng thái đơn đặt hàng này sẽ được đặt tự động khi đơn đặt hàng được xác nhận.',
            ],
            'preferable_id' => Status::whereCode('confirmed')->first()->id,
            'preferable_type' => Status::class
        ]);

        Preference::updateOrCreate(['code' => 'cancelled_order_status'], [
            'name' => [
                Locale::ENGLISH => 'Cancelled Order Status',
                Locale::CZECH => 'Stav objednávky při zrušení',
                Locale::VIETNAMESE => 'Trạng thái đơn đặt hàng đã hủy',
            ],
            'description' => [
                Locale::ENGLISH => 'This order status will be set automatically when order is cancelled.',
                Locale::CZECH => 'Tento stav objednávky bude automaticky nastaven při zrušení objednávky.',
                Locale::VIETNAMESE => 'Trạng thái đơn đặt hàng này sẽ được đặt tự động khi đơn đặt hàng bị hủy.',
            ],
            'preferable_id' => Status::whereCode('cancelled')->first()->id,
            'preferable_type' => Status::class
        ]);

        Preference::updateOrCreate(['code' => 'completed_order_status'], [
            'name' => [
                Locale::ENGLISH => 'Completed Order Status',
                Locale::CZECH => 'Stav objednávky při úspěšném dokončení',
                Locale::VIETNAMESE => 'Trạng thái đơn đặt hàng hoàn thành',
            ],
            'description' => [
                Locale::ENGLISH => 'This order status will be set automatically when order is completed.',
                Locale::CZECH => 'Tento stav objednávky bude nastaven automaticky po úspěšné objednávce.',
                Locale::VIETNAMESE => 'Trạng thái đơn đặt hàng này sẽ được đặt tự động khi đặt hàng hoàn thành.',
            ],
            'preferable_id' => Status::whereCode('completed')->first()->id,
            'preferable_type' => Status::class
        ]);

        Preference::create([
            'code' => 'terms_conditions_page',
            'name' => [
                Locale::ENGLISH => 'Terms and Conditions Page',
                Locale::CZECH => 'Stránka obchodních podmínek',
                Locale::VIETNAMESE => 'Trang điều khoản sử dụng cho cửa hàng',
            ],
            'description' => [
                Locale::ENGLISH => 'This is the default Terms and Conditions Page',
                Locale::CZECH => 'Tato stránka obchodních podmínek je nastavena jako výchozí',
                Locale::VIETNAMESE => 'Đây là trang Điều khoản Sử dụng mặc định cho cửa hàng này',
            ],
            'preferable_id' => Page::where('title', 'Obchodní Podmínky')->first()->id,
            'preferable_type' => Page::class
        ]);

        Preference::create([
            'code' => 'privacy_policy_page',
            'name' => [
                Locale::ENGLISH => 'Privacy Policy Page',
                Locale::CZECH => 'Stránka ochrany osobních údajů',
                Locale::VIETNAMESE => 'Trang Chính sách Bảo mật',
            ],
            'description' => [
                Locale::ENGLISH => 'This is the default Privacy Policy Page',
                Locale::CZECH => 'Tato stránka ochrany osobních údajů je nastavena jako výchozí',
                Locale::VIETNAMESE => 'Đây là trang Chính sách Bảo mật mặc định',
            ],
            'preferable_id' => Page::where('title', 'Ochrana osobních údajů')->first()->id,
            'preferable_type' => Page::class
        ]);

        Preference::create([
            'code' => 'return_refund_page',
            'name' => [
                Locale::ENGLISH => 'Returns and Refunds Page',
                Locale::CZECH => 'Stránka reklamačního řádu',
                Locale::VIETNAMESE => 'Trang Hoàn lại và Hoàn phí',
            ],
            'description' => [
                Locale::ENGLISH => 'This is the default Returns and Refunds Page',
                Locale::CZECH => 'Tato stránka reklamace je nastavena jako výchozí',
                Locale::VIETNAMESE => 'Đây là trang Hoàn lại tiền và Trả lại hàng mặc định',
            ],
            'preferable_id' => Page::where('title', 'Reklamační řád')->first()->id,
            'preferable_type' => Page::class
        ]);

        Preference::create([
            'code' => 'frequently_asked_questions_page',
            'name' => [
                Locale::ENGLISH => 'FAQ Page',
                Locale::CZECH => 'Stránka často kladených otázek',
                Locale::VIETNAMESE => 'Trang câu hỏi thường gặp',
            ],
            'description' => [
                Locale::ENGLISH => 'This is the default FAQ Page',
                Locale::CZECH => 'Tato stránka často kladených otázkek je nastavena jako výchozí',
                Locale::VIETNAMESE => 'Đây là trang Câu hỏi Thường gặp mặc định',
            ],
            'preferable_id' => Page::where('title', 'Často kladené otázky')->first()->id,
            'preferable_type' => Page::class
        ]);
    }
}
