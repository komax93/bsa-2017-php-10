<?php

namespace App\Request;

abstract class AbstractRequest
{
    /**
     * @var array
     */
    private $options;

    public function __construct(array $options = [])
    {
        $this->options = $options;
    }

    /**
     * @param string $key
     * @param null $default
     * @return mixed|null
     */
    public function get(string $key, $default = null)
    {
        return isset($this->options[$key]) ? $this->options[$key] : $default;
    }

    /**
     * @param string $key
     * @param $value
     * @return AbstractRequest
     */
    public function set(string $key, $value): AbstractRequest
    {
        $this->options[$key] = $value;
        return $this;
    }
}