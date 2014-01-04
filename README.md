[Erebus](http://en.wikipedia.org/wiki/Erebus) [![Build Status](https://travis-ci.org/chr0n1x/erebus.png?branch=master)](https://travis-ci.org/chr0n1x/erebus)
===

Not even close to ready! Use with caution, and no expectations whatsoever.

* A very simple (ie: hacky) web application for STT-to-commands.
* Heavily influenced by [cranklin/Jarvis](https://github.com/cranklin/Jarvis)
* Built, with love, on [Silex](https://github.com/silexphp/Silex)

**Installation**

Via [Composer](http://getcomposer.org/doc/00-intro.md#globally)!
```
composer install
```

**Get a Wolfram Alpha App ID**

- [Obtaining AppID](http://products.wolframalpha.com/api/documentation.html#1)
- create a `wolfram.json` in the `config` directory; format your config to look like [`config/wolfram.json.sample`](https://github.com/chr0n1x/nox/blob/master/config/wolfram.json.sample)

**Running**

You can either have this application get served by Apache, or in `public`
```
php -S localhost:8080
```
