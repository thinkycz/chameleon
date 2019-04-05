<?php

namespace App\Helpers\Tags;

use BeyondCode\TagHelper\Helper;
use BeyondCode\TagHelper\Html\HtmlElement;

class ImageSource extends Helper
{
    protected $targetAttribute = 'img-src';

    protected $targetElement = 'img';

    public function process(HtmlElement $element)
    {
        $src = $element->getAttribute('img-src');
        $element->setAttribute('src', asset($src));
        $element->removeAttribute('img-src');
    }
}
