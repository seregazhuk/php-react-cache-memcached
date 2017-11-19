<?php

namespace seregazhuk\React\Cache;

use React\Cache\CacheInterface;
use React\EventLoop\LoopInterface;
use React\Promise\PromiseInterface;
use seregazhuk\React\Memcached\Client;
use seregazhuk\React\Memcached\Factory as ClientFactory;

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
     * @param LoopInterface $loop
     * @param string $address
     * @param string $prefix
     */
    public function __construct(LoopInterface $loop, $address = '', $prefix = 'reach:cache:')
    {
        $this->client = ClientFactory::createClient($loop, $address);
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
