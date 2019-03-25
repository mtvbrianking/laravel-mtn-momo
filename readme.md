## Laravel MTM Momo API Integration

[![Total Downloads](https://poser.pugx.org/bmatovu/laravel-mtn-momo/downloads)](https://packagist.org/packages/bmatovu/laravel-mtn-momo)
[![Latest Stable Version](https://poser.pugx.org/bmatovu/laravel-mtn-momo/v/stable)](https://packagist.org/packages/bmatovu/laravel-mtn-momo)
[![License](https://poser.pugx.org/bmatovu/laravel-mtn-momo/license)](https://packagist.org/packages/bmatovu/laravel-mtn-momo)
[![Build Status](https://travis-ci.org/mtvbrianking/laravel-mtn-momo.svg?branch=master)](https://travis-ci.org/mtvbrianking/laravel-mtn-momo)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/mtvbrianking/laravel-mtn-momo/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/mtvbrianking/laravel-mtn-momo/?branch=master)
[![StyleCI](https://github.styleci.io/repos/175959117/shield?branch=master)](https://github.styleci.io/repos/175959117)

This package offers everything you need to integrate [MTN Momo API](#) in your Laravel application. It wraps the core MTN Momo API requests, leaving you to worry about your payments.

**Caution**: The package is still under active development. Until a stable release is publish, take caution whiling using it in live environments.

### [Installation](https://packagist.org/packages/bmatovu/laravel-mtn-momo)

`composer require bmatovu/laravel-mtn-momo`

### Register package

...


...

1. install package

1.1 MTN MOMO Prerequistes

1.1.1 Create account

1.1.2 Subscribe to service (product) > get subscription key

2. Publish config, migrations

3. Run migrations

4. Bootstrap app

4.1. Generate + register app id

4.2. Request app secret

5. Usage

in code

debugging mw, log file
exception

6. Artisan command utilities

- mtn-momo:init
- mtn-momo:register-id
- mtn-momo:validate-id
- mtn-momo:request-secret

--

Credits

- Guzzle Oauth2 subscriber
