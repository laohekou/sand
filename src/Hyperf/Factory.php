<?php

namespace Xyu\Sand\Hyperf;

use Hyperf\Contract\ConfigInterface;
use Xyu\Sand\SandApp;
use Xyu\Sand\Factory as BaseFactory;

/**
 * Class Factory
 * @package Xyu\SandApp
 * @mixin SandApp
 */
class Factory extends BaseFactory
{
    protected $config;

    protected $drivers;

    public function __construct(ConfigInterface $config)
    {
        parent::__construct($config->get('sand-pay', []));
    }

    public function make(string $name = null, array $config = null)
    {

        $app = parent::make($name);

        // 协程环境下，支持自定义 guzzle handler
        $app->rebind('guzzle_handler', 'Hyperf\Guzzle\CoroutineHandler');

        return $app;
    }
}