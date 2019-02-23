<?php

use App\Models\Address;
use App\Models\Availability;
use App\Models\BillingDetail;
use App\Models\Category;
use App\Models\Country;
use App\Models\Currency;
use App\Models\DeliveryMethod;
use App\Models\Media;
use App\Models\Order;
use App\Models\OrderedItem;
use App\Models\Page;
use App\Models\PaymentMethod;
use App\Models\Price;
use App\Models\PriceLevel;
use App\Models\Product;
use App\Models\Property;
use App\Models\ShippingDetail;
use App\Models\Status;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Tags\Tag;

class MigrationSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /*
         ** Testing purposes only. Comment when done.
         ** $this->truncateExistingData();
         **
         */

        $this->call(CurrencyMigrationSeeder::class);
        $this->call(PriceLevelMigrationSeeder::class);
        $this->call(UserMigrationSeeder::class);
        $this->call(CountryMigrationSeeder::class);
        $this->call(AddressMigrationSeeder::class);
        $this->call(AvailabilityMigrationSeeder::class);
        $this->call(BillingDetailMigrationSeeder::class);
        $this->call(ShippingDetailMigrationSeeder::class);
        $this->call(StatusMigrationSeeder::class);
        $this->call(DeliveryMethodMigrationSeeder::class);
        $this->call(PaymentMethodMigrationSeeder::class);
        $this->call(OrderMigrationSeeder::class);
        $this->call(PageMigrationSeeder::class);
        $this->call(TagMigrationSeeder::class);
        $this->call(UnitMigrationSeeder::class);
        $this->call(MediaMigrationSeeder::class);
        $this->call(CategoryMigrationSeeder::class);
        $this->call(ProductMigrationSeeder::class);
        $this->call(PropertyMigrationSeeder::class);
        $this->call(OrderedItemMigrationSeeder::class);
    }

    private function truncateExistingData()
    {
        Country::query()->delete();
        Address::query()->delete();
        User::query()->delete();
        Currency::query()->delete();
        PriceLevel::query()->delete();
        Availability::query()->delete();
        BillingDetail::query()->delete();
        ShippingDetail::query()->delete();
        Status::query()->delete();
        DeliveryMethod::query()->delete();
        PaymentMethod::query()->delete();
        Order::query()->delete();
        Page::query()->delete();
        Unit::query()->delete();
        Price::query()->delete();
        Product::query()->delete();
        Category::query()->delete();
        Media::query()->delete();
        Tag::query()->delete();
        Property::query()->delete();
        OrderedItem::query()->delete();
    }
}
