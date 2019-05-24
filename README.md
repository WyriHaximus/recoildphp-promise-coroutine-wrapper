# Pool wyrihaximus/recoil-queue-caller

[![Build Status](https://travis-ci.com/WyriHaximus/recoilphp-promise-coroutine-wrapper.svg?branch=master)](https://travis-ci.com/WyriHaximus/recoilphp-promise-coroutine-wrapper)
[![Latest Stable Version](https://poser.pugx.org/WyriHaximus/recoil-promise-coroutine-wrapper/v/stable.png)](https://packagist.org/packages/WyriHaximus/recoil-promise-coroutine-wrapper)
[![Total Downloads](https://poser.pugx.org/WyriHaximus/recoil-promise-coroutine-wrapper/downloads.png)](https://packagist.org/packages/WyriHaximus/recoil-promise-coroutine-wrapper)
[![Code Coverage](https://scrutinizer-ci.com/g/WyriHaximus/recoilphp-promise-coroutine-wrapper/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/WyriHaximus/recoilphp-promise-coroutine-wrapper/?branch=master)
[![License](https://poser.pugx.org/WyriHaximus/recoil-promise-coroutine-wrapper/license.png)](https://packagist.org/packages/WyriHaximus/recoil-promise-coroutine-wrapper)
[![PHP 7 ready](http://php7ready.timesplinter.ch/WyriHaximus/reactphp-http-middleware-clear-body/badge.svg)](https://travis-ci.org/WyriHaximus/reactphp-http-middleware-clear-body)

A simple API around WyriHaximus/recoil-queue-caller(-pool).

# Install

To install via [Composer](http://getcomposer.org/), use the command below, it will automatically detect the latest version and bind it with `^`.

```
composer require WyriHaximus/recoil-promise-coroutine-wrapper
```

# Usage

```php
// Have the event loop ready
$loop = Factory::create();

// Create the wrapper from the event loop, internally this will set up all the required comonents
$wrapper = PromiseCoroutineWrapper::createFromLoop($loop);

// Execute a coroutine and get the result through a promise (the irony)
$result = $wrapper->call(function (LoopInterface $loop, int $wait) {
    yield timedPromise($loop, $wait);
    
    return $wait;
}, $loop, $wait)
```

# License

The MIT License (MIT)

Copyright (c) 2019 Cees-Jan Kiewiet

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
