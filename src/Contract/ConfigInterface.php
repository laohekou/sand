<?php

namespace Xyu\Sand\Contract;

interface ConfigInterface
{
    /**
     * @param mixed $default default value of the entry when does not found
     *
     * @return mixed
     */
    public function get(string $key, $default = null);

    public function has(string $key): bool;

    /**
     * @param mixed $value
     */
    public function set(string $key, $value);
}