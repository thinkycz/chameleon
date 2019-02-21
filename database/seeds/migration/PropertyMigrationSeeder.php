<?php

use App\Models\Property;
use App\Models\PropertyType;
use App\Models\PropertyValue;

class PropertyMigrationSeeder extends BaseMigrationSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->propertyTypes();
        $this->propertyValues();
        $this->properties();
    }

    private function propertyTypes()
    {
        $propertyTypes = DB::connection('old_mysql')->table('property_types')->get();

        $propertyTypes->each(function ($propertyType) {
            PropertyType::insert([
                'name'        => $propertyType->name,
                'is_hidden'   => $propertyType->is_hidden,
                'is_sortable' => $propertyType->is_sortable,
            ]);
        });

    }

    private function propertyValues()
    {
        $propertyValue = DB::connection('old_mysql')->table('properties')->get();

        $propertyValue->each(function ($propertyValue) {
            PropertyValue::insert([
                'value' => $propertyValue->value,
            ]);
        });

    }

    private function properties()
    {
        $properties = DB::connection('old_mysql')->table('product_property')->get();

        $properties->each(function ($property) {
            $oldProperty = DB::connection('old_mysql')->table('properties')->find($property->property_id);
            if ($oldProperty) {
                $data = [
                    'property_value_id' => $oldProperty->id,
                    'property_type_id'  => $oldProperty->property_type_id,
                    'product_id'        => $property->product_id,
                    'is_option'         => false,
                ];

                try {
                    Property::insert($data);
                } catch (\Exception $e) {
                    //
                }
            }
        });
    }
}
