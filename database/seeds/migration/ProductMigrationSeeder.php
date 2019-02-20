<?php

use App\Models\Price;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductMigrationSeeder extends BaseMigrationSeeder
{
    protected $pairs = [
        'name'                   => 'name',
        'description'            => 'description',
        'details'                => 'details',
        'slug'                   => 'slug',
        'catalogue_number'       => 'catalogueNumber',
        'barcode'                => 'barcode',
        'minimum_order_quantity' => 'minimumOrderQuantity',
        'quantity_in_stock'      => 'quantityInStock',
        'multiply_of_moq_only'   => 'multiply_of_moq_only',
        'availability_id'        => 'availability_id',
        'unit_id'                => 'unit_id',
        'vatrate'                => 'vatrate',
        'parent_id'              => 'parent_id',
        '_lft'                   => '_lft',
        '_rgt'                   => '_rgt',

        /**
         * Default columns
         */
        'id'                     => 'id',
        'created_at'             => 'created_at',
        'updated_at'             => 'updated_at',
    ];

    protected $oldTableName = 'products';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = $this->prepare($array = false);
        $data = $data->map(function ($item) {
            $name = json_decode($item->get('name'));
            $details = json_decode($item->get('details'));
            $description = json_decode($item->get('description'));

            return $item->merge([
                'name'                 => property_exists($name, 'cs') ? $name->cs : $name->en,
                'details'              => property_exists($details, 'cs') ? $details->cs : $details->en,
                'description'          => property_exists($description, 'cs') ? $description->cs : $description->en,
                'multiply_of_moq_only' => $item->get('multiply_of_moq_only') ?: false,
                'quantity_in_stock'    => $item->get('quantity_in_stock') ?: 0,
            ]);
        });

        Product::insert($data->toArray());

        $this->prices();
        $this->categories();
        $this->properties();
    }

    private function prices()
    {
        $prices = Price::hydrate(DB::connection('old_mysql')->table('prices')->get()->toArray());

        $prices->each(function ($price) {
            DB::table('prices')->insert([
                'price'          => $price->price,
                'old_price'      => $price->old_price,
                'price_level_id' => $price->price_level_id,
                'product_id'     => $price->product_id,
            ]);
        });
    }

    private function categories()
    {
        $categories = DB::connection('old_mysql')->table('category_product')->get();

        $categories->each(function ($category) {
            DB::table('category_product')->insert([
                'category_id' => $category->category_id,
                'product_id'  => $category->product_id,
            ]);
        });
    }

    private function properties()
    {
        //
    }
}
