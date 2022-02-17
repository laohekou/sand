<?php

namespace Xyu\Sand;

use Xyu\Sand\Exception\SandAppException;

class Factory
{
    protected $config;

    protected $drivers;

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function make(string $name = null, array $config = null)
    {
        $name = $name ?? 'default';

        if (empty($this->config[$name])) {
            throw new SandAppException("Undefined {$name} configuration");
        }

        $config = $config ?? $this->config[$name];

        if (!isset($config['debug'])) {
            $config['debug'] = $this->config['debug'] ?? false;
        }

        return $this->drivers[$name] ?? $this->drivers[$name] = new SandApp($config);
    }

    public function __call($name, $arguments)
    {
        $app = $this->make();

        if (method_exists($app, $name)) {
            return call_user_func_array([$app, $name], $arguments);
        }

        throw new SandAppException("Undefined {$name} method!");
    }
}