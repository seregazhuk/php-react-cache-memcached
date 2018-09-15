<?php

namespace seregazhuk\React\Cache\Memcached\tests;

use seregazhuk\React\Cache\Memcached\Memcached;
use seregazhuk\React\Memcached\Exception\Exception;
use seregazhuk\React\PromiseTesting\TestCase;

class CacheTest extends TestCase
{
    private $cache;

    protected function setUp()
    {
        parent::setUp();
        $this->cache = new Memcached($this->loop);
    }

    /** @test */
    public function it_stores_and_retrieves_values(): void
    {
        $this->waitForPromise($this->cache->set('key', 'test'));

        $this->assertPromiseFulfillsWith($this->cache->get('key'), 'test');
    }

    /** @test */
    public function it_rejects_promise_when_retrieving_non_existing_key(): void
    {
        $this->assertPromiseRejectsWith($this->cache->get('non-existing-key'), Exception::class);
    }

    /** @test */
    public function it_removes_value_by_key(): void
    {
        $this->waitForPromise($this->cache->set('key-to-remove', 'test'));
        $this->cache->delete('key-to-remove');
        $this->assertPromiseRejectsWith($this->cache->get('key-to-remove'), Exception::class);
    }
}
