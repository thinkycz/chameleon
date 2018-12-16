<?php

namespace Nulisec\JsonSchema;

use Laravel\Nova\Fields\Code;

class JsonSchema extends Code
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'json-schema';

    public function __construct($name, array $schema = null, $attribute = null, $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);

        $this->loadSchema($schema);
    }

    public function loadSchema(array $schema = null): JsonSchema
    {
        return $this->options(compact('schema'));
    }
}
