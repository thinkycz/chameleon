<?php

namespace Nulisec\DropzoneField;

use Laravel\Nova\Fields\Field;
use Laravel\Nova\Http\Requests\NovaRequest;

class DropzoneField extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'dropzone-field';

    protected function resolveAttribute($resource, $attribute)
    {
        return [
            'resource' => $resource,
            'images'   => $resource->images,
        ];
    }

    protected function fillAttributeFromRequest(NovaRequest $request, $requestAttribute, $model, $attribute)
    {
        //
    }
}
