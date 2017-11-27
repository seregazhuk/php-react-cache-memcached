<?php

namespace seregazhuk\React\Cache\Memcached;

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
     * @param LoopInterface $loop
     * @param string $address
     * @param string $prefix
     */
    public function __construct(LoopInterface $loop, $address = 'localhost:11211', $prefix = 'react:cache:')
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
        return $this->client->get($this->prefix . $key);
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
