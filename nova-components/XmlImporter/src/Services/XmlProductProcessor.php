<?php

namespace Nulisec\XmlImporter\Services;

use Nulisec\XmlParser\Reader;

class XmlProductProcessor
{
    public static function processNode(string $node, array $config)
    {
        $xml = app(Reader::class)->extract($node);
        $product = $xml->parse($config);
        return $product;
    }

    public static function convertToUtf8($fromEncoding, $contents)
    {
        return iconv($fromEncoding, "UTF-8", $contents);
    }

    public static function validateElement($content, $element)
    {
        return str_contains($content, "<{$element}>");
    }

    public static function detectFileEncoding(string $filePath)
    {
        $file = fopen($filePath, 'r');
        $node = fgets($file);
        $matches = [];

        if (preg_match('/encoding="([^\"])+"/', $node, $matches)) {
            preg_match('/"[^\"]+"/', $matches[0], $matches);
            return str_replace('"', '', $matches[0]);
        } else {
            return mb_detect_encoding($node);
        }
    }
}