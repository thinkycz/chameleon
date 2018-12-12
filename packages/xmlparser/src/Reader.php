<?php

namespace Nulisec\XmlParser;

use Nulisec\XmlParser\Exceptions\FileNotFoundException;
use Nulisec\XmlParser\Exceptions\InvalidContentException;

class Reader
{
    /**
     * Extract content from string.
     *
     * @param  string $content
     * @return Document
     */
    public function extract(string $content): Document
    {
        $xml = @simplexml_load_string($content);

        return $this->resolveXmlObject($xml);
    }

    /**
     * Load content from file.
     *
     * @param  string $filename
     * @return Document
     */
    public function load(string $filename): Document
    {
        $xml = @simplexml_load_file($filename);

        return $this->resolveXmlObject($xml);
    }

    /**
     * Load content from local file.
     *
     * @param  string $filename
     * @return Document
     */
    public function local(string $filename): Document
    {
        if (!file_exists($filename)) {
            throw new FileNotFoundException('Could not find the file: ' . $filename);
        }

        return $this->load($filename);
    }

    /**
     * Load content from remote file.
     *
     * @param  string $filename
     * @return Document
     */
    public function remote(string $filename): Document
    {
        return $this->load($filename);
    }

    /**
     * Validate given XML.
     *
     * @param  object $xml
     * @return Document
     */
    protected function resolveXmlObject($xml): Document
    {
        if (!$xml) {
            throw new InvalidContentException('Unable to parse XML from string.');
        }

        return (new Document())->setContent($xml);
    }
}
