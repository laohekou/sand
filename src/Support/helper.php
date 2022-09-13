<?php

if (!function_exists('sand')) {
    /**
     * 杉德支付
     * @param array $config
     * @return \Xyu\Sand\SandApp
     */
    function sand(array $config)
    {
        return (new \Xyu\Sand\SandApp($config));
    }
}

if (!function_exists('sand_pay')) {
    /**
     * 杉德支付
     * @param string $name
     * @return mixed|\Xyu\Sand\SandApp
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    function sand_pay(string $name = 'default')
    {
        return \Hyperf\Utils\ApplicationContext::getContainer()->get(\Xyu\Sand\Hyperf\Factory::class)->make($name);
    }
}