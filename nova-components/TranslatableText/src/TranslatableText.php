<?php

namespace Nulisec\TranslatableText;

use Laravel\Nova\Fields\Field;

class TranslatableText extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'translatable-text';

    protected function resolveAttribute($resource, $attribute)
    {
        return $resource->getTranslations($attribute);
    }
}
