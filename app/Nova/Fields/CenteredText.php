<?php

namespace App\Nova\Fields;

use Laravel\Nova\Fields\Field;

class CenteredText extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'text-field';

    public $textAlign = 'center';

    public function jsonSerialize()
    {
        return array_merge([
            'component' => $this->component(),
            'prefixComponent' => true,
            'indexName' => $this->name,
            'name' => $this->name,
            'attribute' => $this->attribute,
            'value' => $this->value,
            'panel' => $this->panel,
            'sortable' => $this->sortable,
            'textAlign' => $this->textAlign,
            'asHtml' => true
        ], $this->meta());
    }
}
