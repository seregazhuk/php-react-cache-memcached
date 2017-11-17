<?php

namespace seregazhuk\React\Cache;

use React\Cache\CacheInterface;
use React\Promise\PromiseInterface;
use seregazhuk\React\Memcached\Client;

class Memcached implements CacheInterface
{
    /**
     * @var Client
     */
    protected $client;
    /**
     * @var string
     */
    protected $prefix;
    /**
     * Redis constructor.
     * @param Client $client
     * @param string $prefix
     */
    public function __construct(Client $client, $prefix = 'reach:cache:')
    {
        $this->client = $client;
        $this->prefix = $prefix;
    }

    /**
     * @param string $key
     * @return PromiseInterface
     */
    public function get($key)
    {
        return $this->client->get($this->prefix);
    }


    /**
     * @param string $key
     * @param mixed $value
     * @return PromiseInterface
     */
    public function set($key, $value)
    {
        return $this->client->set($this->prefix . $key, $value);
    }

    /**
     * @param string $key
     * @return PromiseInterface
     */
    public function remove($key)
    {
        return $this->client->delete($this->prefix . $key);
    }
}
