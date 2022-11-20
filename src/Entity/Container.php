<?php

use Freshchat\Exceptions\NotFoundException;
use Psr\Container\ContainerInterface;

class Container implements ContainerInterface
{

    private array $entries = [];

    public function get(string $id)
    {
        if (!$this->entries[$id]) {
            throw new NotFoundException("class " . $id . " has no binding");
        }
        return $this->entries[$id];
    }

    public function has(string $id):bool
    {
        return  isset($this->entries[$id]);
    }

    public function set(string $id, callable $concret)
    {
        $this->entries[$id] =  $concret;
    }
}
