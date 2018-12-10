<?php

namespace App\Helpers\Tags;

use BeyondCode\TagHelper\Helper;
use BeyondCode\TagHelper\Html\HtmlElement;

class FormFiles extends Helper
{
    protected $targetAttribute = 'files';

    protected $targetElement = 'form';

    public function process(HtmlElement $element)
    {
        $element->setAttribute('enctype', "multipart/form-data");
        $element->removeAttribute('files');
    }
}
