# Memcached cache implementation for react/cache

[![Build Status](https://travis-ci.org/seregazhuk/php-react-cache-memcached.svg?branch=master)](https://travis-ci.org/seregazhuk/php-react-cache-memcached)

Implementation of [react/cache interface](https://github.com/reactphp/cache) that uses Memcached as a storage.

**Table of Contents**
- [Installation](#installation)
- [Quick Start](#quick-start)

## Installation

Library requires PHP 5.6.0 or above.

The recommended way to install this library is via [Composer](https://getcomposer.org). 
[New to Composer?](https://getcomposer.org/doc/00-intro.md)

See also the [CHANGELOG](CHANGELOG.md) for details about version upgrades.

```
composer require seregazhuk/react-cache-memcached
```

## Quick Start

`React\Cache\CacheInterface` has three simple methods to store, retrieve and remove data: 

```php
use React\EventLoop\Factory;
use seregazhuk\React\Cache\Memcached\Memcached;

$loop = Factory::create();
$cache = new Memcached($loop);

// store
$cache->set('key', 12345);

// retrieve
$cache->get('key')->then(function($value){
    // handle data
});

// ...

// remove
$cache->remove('key');

$loop->run();
```
