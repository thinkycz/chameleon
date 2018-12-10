<?php

namespace Nulisec\TranslatableTextarea;

use Laravel\Nova\Fields\Field;

class TranslatableTextarea extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'translatable-textarea';

    protected function resolveAttribute($resource, $attribute)
    {
        return $resource->getTranslations($attribute);
    }
}
