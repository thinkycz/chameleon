<?php

namespace App\Helpers\Tags;

use BeyondCode\TagHelper\Helper;
use BeyondCode\TagHelper\Html\HtmlElement;

class FormAction extends Helper
{
    protected $targetAttribute = 'form-action';

    protected $targetElement = 'form';

    public function process(HtmlElement $element)
    {
        $params = $element->getAttribute('params');
        $action = $element->getAttribute('form-action');

        $element->setAttribute('action', "{{ route('{$action}', [{$params}]) }}");
        $element->removeAttribute('form-action');
        $element->removeAttribute('params');
    }
}
