<?php

namespace App\Nova\Fields;

use App\Models\PropertyValue as PropertyValueModel;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class PropertyValue extends Text
{
    protected function fillAttributeFromRequest(NovaRequest $request, $requestAttribute, $model, $attribute)
    {
        if ($request->exists('propertyValue')) {
            $value = trim($request['propertyValue']);
            $model->property_value_id = PropertyValueModel::firstOrCreate(compact('value'))->id;
        }
    }

    protected function resolveAttribute($resource, $attribute)
    {
        return optional($resource->propertyValue)->value;
    }
}