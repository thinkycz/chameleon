<?php

namespace Nulisec\XmlParser;

use Nulisec\XmlParser\Concerns\SupportMultiLevel;
use Nulisec\XmlParser\Tools\ArrayHelpers;
use Tightenco\Collect\Support\Arr;

class Document
{
    use SupportMultiLevel;

    /**
     * The content.
     *
     * @var mixed
     */
    protected $content;

    /**
     * The original content.
     *
     * @var mixed
     */
    protected $originalContent;

    /**
     * Available namespaces.
     *
     * @var array|null
     */
    protected $namespaces;

    /**
     * @var ArrayHelpers
     */
    protected $helpers;

    /**
     * Document constructor.
     */
    public function __construct()
    {
        $this->helpers = new ArrayHelpers();
    }

    /**
     * Parse document.
     *
     * @param  array $schema
     * @param  array $config
     * @return array
     */
    public function parse(array $schema, array $config = []): array
    {
        $output = [];
        $ignore = $config['ignore'] ?? false;

        foreach ($schema as $key => $data) {
            $value = $this->parseData($data);

            if (!$ignore) {
                $output[$key] = $value;
            }
        }

        return $output;
    }

    /**
     * Set the content.
     *
     * @param  mixed $content
     * @return $this
     */
    public function setContent($content)
    {
        $this->content = $content;
        $this->originalContent = $content;

        return $this;
    }

    /**
     * Get the content.
     *
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Get original content.
     *
     * @return mixed
     */
    public function getOriginalContent()
    {
        return $this->originalContent;
    }

    /**
     * Rebase document node.
     *
     * @param  string|null $base
     * @return $this
     */
    public function rebase(string $base = null): self
    {
        $this->content = $this->helpers->data_get($this->content, $base);

        return $this;
    }

    /**
     * Parse and set namespaces
     *
     * @param $namespaces
     * @return $this
     */
    public function namespaces(...$namespaces): self
    {
        $namespaces = is_array($namespaces) ? $namespaces : func_get_args();

        collect($namespaces)->each(function ($namespace) {
            $this->namespace($namespace);
        });

        return $this;
    }

    /**
     * Set document namespace
     *
     * @param $namespace
     * @return $this
     */
    function namespace (string $namespace) {
        $document = $this->getContent();
        $namespaces = $this->getAvailableNamespaces();

        if (!is_null($namespace) && isset($namespaces[$namespace])) {
            $document = $document->children($namespaces[$namespace]);
        }

        $this->content = $document;

        return $this;
    }

    /**
     * Filter value.
     *
     * @param  mixed $value
     * @param  string|null $filter
     * @return mixed
     */
    protected function filterValue($value, ?string $filter = null)
    {
        $resolver = $this->getFilterResolver($filter);

        if (method_exists($resolver[0], $resolver[1])) {
            return $this->callFilterResolver($resolver, $value);
        }

        return $value;
    }

    /**
     * Resolve value from content.
     *
     * @param  array $config
     * @param  string $hash
     * @return mixed
     */
    protected function resolveValue(array $config, string $hash)
    {
        if (!isset($config['uses'])) {
            return $config['default'] ?? null;
        }

        if (!is_array($config['uses'])) {
            return $this->getValue($this->getContent(), $config['uses'], $hash);
        }

        $values = [];

        foreach ($config['uses'] as $use) {
            $values[] = $this->getValue($this->getContent(), $use, $hash);
        }

        return $values;
    }

    /**
     * Get filter resolver.
     *
     * @param  string|null $filter
     * @return array
     */
    protected function getFilterResolver(string $filter): array
    {
        $class = $filter;
        $method = 'filter';

        $position = strpos($filter, '@');

        if ($position === 0) {
            $method = 'filter' . ucwords(substr($filter, 1));

            return [$this, $method];
        }

        if ($position !== false) {
            list($class, $method) = explode('@', $filter, 2);
        }

        return $this->makeFilterResolver($class, $method);
    }

    /**
     * Parse single data.
     *
     * @param  mixed $data
     * @return mixed
     */
    protected function parseData($data)
    {
        $hash = hash('sha256', microtime(true));
        $value = $data;
        $filter = null;

        if (is_array($data)) {
            $value = $this->resolveValue($data, $hash);
            $filter = $data['filter'] ?? null;
        }

        if ($value === $hash) {
            $value = $data['default'] ?? null;
        }

        if (!is_null($filter)) {
            $value = $this->filterValue($value, $filter);
        }

        return $value;
    }

    /**
     * Make filter resolver.
     *
     * @param  string $class
     * @param  string $method
     * @return array
     */
    protected function makeFilterResolver(string $class, string $method): array
    {
        $class = new $class();

        return [$class, $method];
    }

    /**
     * Call filter to parse the value.
     *
     * @param  callable $resolver
     * @param  mixed $value
     * @return mixed
     */
    protected function callFilterResolver(callable $resolver, $value)
    {
        return call_user_func($resolver, $value);
    }

    /**
     * Resolve value from uses filter.
     *
     * @param  mixed $content
     * @param  string|null $use
     * @param  string|null $default
     * @return mixed
     */
    protected function getValue($content, ?string $use, ?string $default = null)
    {
        if (preg_match('/^(.*)\[(.*)\]$/', $use, $matches) && $content instanceof SimpleXMLElement) {
            return $this->getValueCollection($content, $matches, $default);
        } elseif (strpos($use, '::') !== false && $content instanceof SimpleXMLElement) {
            return $this->getValueAttribute($content, $use, $default);
        }

        return $this->getValueData($content, $use, $default);
    }

    /**
     * Cast value to string only when it is an instance of SimpleXMLElement.
     *
     * @param  mixed $value
     * @return mixed
     */
    protected function castValue($value)
    {
        if ($value instanceof SimpleXMLElement) {
            $value = (string) $value;
        }

        return $value;
    }

    /**
     * Resolve value by uses as attribute.
     *
     * @param  SimpleXMLElement $content
     * @param  string $use
     * @param  mixed $default
     * @return mixed
     */
    protected function getValueAttribute(SimpleXMLElement $content, string $use, $default = null)
    {
        return $this->castValue($this->getRawValueAttribute($content, $use, $default));
    }

    /**
     * Resolve value by uses as attribute as raw.
     *
     * @param  SimpleXMLElement $content
     * @param  string|null $use
     * @param  mixed $default
     * @return mixed
     */
    protected function getRawValueAttribute(SimpleXMLElement $content, ?string $use, $default = null)
    {
        list($value, $attribute) = explode('::', $use, 2);

        if (!empty($value)) {
            if (is_null($parent = $this->helpers->object_get($content, $value))) {
                return $default;
            }
        } else {
            $parent = $content;
        }

        $attributes = $parent->attributes();

        return $this->helpers->data_get($attributes, $attribute, $default);
    }

    /**
     * Resolve value by uses as data.
     *
     * @param  mixed $content
     * @param  string|null $use
     * @param  mixed $default
     * @return mixed
     */
    protected function getValueData($content, ?string $use, $default = null)
    {
        $value = $this->castValue($this->helpers->data_get($content, $use));

        if (empty($value) && !in_array($value, ['0'])) {
            return $default;
        }

        return $value;
    }

    /**
     * Resolve values by collection.
     *
     * @param  SimpleXMLElement $content
     * @param  array $matches
     * @param  mixed $default
     * @return mixed
     */
    protected function getValueCollection(SimpleXMLElement $content, array $matches, $default = null)
    {
        $parent = $matches[1];
        $namespace = null;

        if (strpos($parent, '/') !== false) {
            list($parent, $namespace) = explode('/', $parent, 2);
        }

        $collection = $this->helpers->data_get($content, $parent);
        $namespaces = $this->getAvailableNamespaces();

        $uses = $this->parseBasicUses($matches[2]);

        $values = [];

        if (!$collection instanceof SimpleXMLElement) {
            return $default;
        }

        foreach ($collection as $content) {
            if (empty($content)) {
                continue;
            }

            if (!is_null($namespace) && isset($namespaces[$namespace])) {
                $content = $content->children($namespaces[$namespace]);
            }

            $values[] = $this->parseValueCollection($content, $uses);
        }

        return $values;
    }

    /**
     * Resolve values by collection.
     *
     * @param  SimpleXMLElement $content
     * @param  array $uses
     * @return array
     */
    protected function parseValueCollection(SimpleXMLElement $content, array $uses): array
    {
        $value = [];
        $result = [];

        foreach ($uses as $use) {
            $primary = $this->resolveUses($use);

            if ($primary instanceof MultiLevel) {
                $result[$primary->getKey()] = $this->parseMultiLevelsValueCollection($content, $primary);
            } else {
                list($name, $as) = strpos($use, '>') !== false ? explode('>', $use, 2) : [$use, $use];

                if (preg_match('/^([A-Za-z0-9_\-\.]+)\((.*)\=(.*)\)$/', $name, $matches)) {
                    $as = $this->helpers->alias_get($as, $name);

                    $item = $this->getSelfMatchingValue($content, $matches, $as);

                    if (is_null($as)) {
                        $value = array_merge($value, $item);
                    } else {
                        Arr::set($value, $as, $item);
                    }
                } else {
                    $name = $this->helpers->alias_get($name, '@');

                    Arr::set($value, $as, $this->getValue($content, $name));
                }
                $result = $value;
            }
        }

        return $result;
    }

    /**
     * Get self matching value.
     *
     * @param  SimpleXMLElement $content
     * @param  array $matches
     * @param  string|null $alias
     * @return array
     */
    protected function getSelfMatchingValue(SimpleXMLElement $content, array $matches = [], ?string $alias = null): array
    {
        $name = $matches[1];
        $key = $matches[2];
        $meta = $matches[3];

        $item = [];
        $uses = ($key == '@' ? $meta : "{$key},{$meta}");

        if (is_null($alias)) {
            $alias = $name;
        }

        $collection = $this->getValue($content, sprintf('%s[%s]', $name, $uses));

        foreach ((array) $collection as $collect) {
            $v = $collect[$meta];

            if ($key == '@') {
                $item[$alias][] = $v;
            } else {
                $item[$collect[$key]] = $v;
            }
        }

        return $item;
    }

    /**
     * Get available namespaces, and cached it during runtime to avoid
     * overhead.
     *
     * @return array|null
     */
    protected function getAvailableNamespaces(): ?array
    {
        if (is_null($this->namespaces)) {
            $this->namespaces = $this->getOriginalContent()->getNameSpaces(true);
        }

        return $this->namespaces;
    }
}
