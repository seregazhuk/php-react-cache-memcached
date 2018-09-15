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
     * @param null|mixed $default
     * @return PromiseInterface
     */
    public function get($key, $default = null): PromiseInterface
    {
        return $this->client->get($this->prefix . $key);
    }

    /**
     * @param string $key
     * @param mixed $value
     * @param null|int $ttl
     * @return PromiseInterface
     */
    public function set($key, $value, $ttl = null): PromiseInterface
    {
        return $this->client->set($this->prefix . $key, $value, 0, $ttl ?: 0);
    }

    /**
     * @param string $key
     * @return PromiseInterface
     */
    public function delete($key): PromiseInterface
    {
        return $this->client->delete($this->prefix . $key);
    }
}
