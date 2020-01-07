## Laravel MTM MOMO API Integration

[![Total Downloads](https://poser.pugx.org/bmatovu/laravel-mtn-momo/downloads)](https://packagist.org/packages/bmatovu/laravel-mtn-momo)
[![Latest Stable Version](https://poser.pugx.org/bmatovu/laravel-mtn-momo/v/stable)](https://packagist.org/packages/bmatovu/laravel-mtn-momo)
[![License](https://poser.pugx.org/bmatovu/laravel-mtn-momo/license)](https://packagist.org/packages/bmatovu/laravel-mtn-momo)
[![Build Status](https://travis-ci.org/mtvbrianking/laravel-mtn-momo.svg?branch=master)](https://travis-ci.org/mtvbrianking/laravel-mtn-momo)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/mtvbrianking/laravel-mtn-momo/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/mtvbrianking/laravel-mtn-momo/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/mtvbrianking/laravel-mtn-momo/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/mtvbrianking/laravel-mtn-momo/?branch=master)
[![StyleCI](https://github.styleci.io/repos/175959117/shield?branch=master)](https://github.styleci.io/repos/175959117)
[![Documentation](https://img.shields.io/badge/Documentation-Blue)](https://mtvbrianking.github.io/laravel-mtn-momo/master)

### Introduction

This package helps you integrate the [MTN MOMO API](https://momodeveloper.mtn.com) into your Laravel application. It provides a wrapper around the core MTN Momo API services, leaving you to worry about other parts of your application.

### [Installation](https://packagist.org/packages/bmatovu/laravel-mtn-momo)

To get started, install the package via the Composer package manager:

| Laravel | Package | Installation                                      |
| :-----: | :-----: | ------------------------------------------------- |
|   5.3   |   1.3   | `composer require bmatovu/laravel-mtn-momo 1.3.*` |
|   5.4   |   1.4   | `composer require bmatovu/laravel-mtn-momo 1.4.*` |
|   5.5   |   1.5   | `composer require bmatovu/laravel-mtn-momo 1.5.*` |
|   5.6   |   1.6   | `composer require bmatovu/laravel-mtn-momo 1.6.*` |
|   5.7   |   1.7   | `composer require bmatovu/laravel-mtn-momo 1.7.*` |
|   5.8   |   1.8   | `composer require bmatovu/laravel-mtn-momo 1.8.*` |
|   6.0   | master  | `composer require bmatovu/laravel-mtn-momo`       |

The service provider will be auto-discovered for Laravel 5.5 and above. You may manually register the service provider in your configuration `config/app.php` file:

```php
'providers' => array(
   // ...
   Bmatovu\MtnMomo\MtnMomoServiceProvider::class,
),
```

**Configuration customization**

If you wish to customize the default configurations, you may export the default configuration using

```bash
php artisan vendor:publish --provider="Bmatovu\MtnMomo\MtnMomoServiceProvider" --tag="config"
```

**Database Migration**

The package service provider registers it's own database migrations with the framework, so you should migrate your database after installation. The migration will create a tokens tables your application needs to store access tokens from MTN MOMO API.

```bash
php artisan migrate
```

### Prerequisites

You will need the following to get started with you integration...

1. Create a [**developer account**](https://momodeveloper.mtn.com/signup) with MTN MOMO.
2. Subscribe to a [**product/service**](https://momodeveloper.mtn.com/products) that you wish to consume.

If you already subscribed to a product, the subscription key can be found in your [**profile**](https://momodeveloper.mtn.com/developer).

### Getting started sanbox

Register you client details.

```bash
php artisan mtn-momo:init
```

Next you need to register your client app ID.

```bash
php artisan mtn-momo:register-id
```

You may want to verify your client ID at this stage

```bash
php artisan mtn-momo:validate-id
```

Then request for a client secret (key).

```bash
php artisan mtn-momo:request-secret
```
### Getting started in Production
Once you have applied to go in production ,subscription to the product is done via paper work 
1.Register you client details.

```bash
php artisan mtn-momo:init
```
2.Upon approval of your company documents
Unlike sanbox , creating an API user (Client Id) and Secret (API KEY) in production is already handled for you via the [partner portal](https://mobilemoneyreadonly.mtn.co.ug/).

You will receive an email from the Mobile Money Office in order to access the partner portal with  this [**link
**](https://mobilemoneyreadonly.mtn.co.ug/)

 

Your username and one-time password  are indicated on the simpack picked from the Mtn Mobile Money Offices.
Enter username and select ‘First Login’

Once logged in navigate to the top right corner and create an API User.
Use the Generated APIUSER as the client ID and API_KEY as the secret.

### Usage

Update your Env file with the latest production credentials 
```env
MOMO_APP="Your App Name"

MOMO_ENVIRONMENT="mtnuganda"

MOMO_CURRENCY="UGX"

MOMO_PRODUCT="collection" // can be disbursment or remittence

MOMO_COLLECTION_SUBSCRIPTION_KEY="PRODUCT SUBSCRIPTION KEY"

MOMO_API_BASE_URI = "https://ericssonbasicapi1.azure-api.net/"   // this is the production url

MOMO_COLLECTION_REDIRECT_URI = "https://yourcallbackhost.com"

MOMO_COLLECTION_ID = "APIUSER FROM PARTNER PORTAL"

MOMO_COLLECTION_SECRET= "API KEY FROM PARTNER PORTAL"



```

#### In production ,make sure the phone number to collect funds from starts with international country code other than a leading Zero.

Forexample, in uganada use '2567XXXXXXXX' instead of '07XXXXXXXX'  cameroon use '237XXXXXXXX' instead ot the leading Zero etc..


```php
use Bmatovu\MtnMomo\Products\Collection;

$collection = new Collection();


$momoTransactionId = $collection->transact('transactionId', '07XXXXXXXX', 100);
```

See [test numbers](https://momodeveloper.mtn.com/api-documentation/testing/#test-numbers)

**Exception handling**

```php
use Bmatovu\MtnMomo\Products\Collection;
use Bmatovu\MtnMomo\Exceptions\CollectionRequestException;

try {
    $collection = new Collection();
    
    // Request a user to pay
    $momoTransactionId = $collection->transact('transactionId', '07XXXXXXXX', 100);
} catch(CollectionRequestException $e) {
    do {
        printf("\n\r%s:%d %s (%d) [%s]\n\r", 
            $e->getFile(), $e->getLine(), $e->getMessage(), $e->getCode(), get_class($e));
    } while($e = $e->getPrevious());
}
```

### [Available methods](https://mtvbrianking.github.io/laravel-mtn-momo/master/Bmatovu/MtnMomo/Products.html)

**Collection**

1. [Collect money](https://mtvbrianking.github.io/laravel-mtn-momo/master/Bmatovu/MtnMomo/Products/Collection.html#method_transact)

    ```php
    $collection->transact($transactionId, $partyId, $amount)
    ```

2. [Check transaction status](https://mtvbrianking.github.io/laravel-mtn-momo/master/Bmatovu/MtnMomo/Products/Collection.html#method_getTransactionStatus)

    ```php
    $collection->getTransactionStatus($momoTransactionId)
    ```

3. [Check account balance](https://mtvbrianking.github.io/laravel-mtn-momo/master/Bmatovu/MtnMomo/Products/Collection.html#method_getAccountBalance)

    ```php
    $collection->getAccountBalance()
    ```

4. [Check account status](https://mtvbrianking.github.io/laravel-mtn-momo/master/Bmatovu/MtnMomo/Products/Collection.html#method_isActive)

    ```php
    $collection->isActive($partyId)
    ```

5. [Get OAuth token](https://mtvbrianking.github.io/laravel-mtn-momo/master/Bmatovu/MtnMomo/Products/Collection.html#method_getToken)

    ```php
    $collection->getToken()
    ```

**Disbursement**

1. [Disburse money](https://mtvbrianking.github.io/laravel-mtn-momo/master/Bmatovu/MtnMomo/Products/Disbursement.html#method_transfer)

    ```php
    $disbursement->transfer($transactionId, $partyId, $amount)
    ```

2. [Check transaction status](https://mtvbrianking.github.io/laravel-mtn-momo/master/Bmatovu/MtnMomo/Products/Disbursement.html#method_getTransactionStatus)

    ```php
    $disbursement->getTransactionStatus($momoTransactionId)
    ```

3. [Check account balance](https://mtvbrianking.github.io/laravel-mtn-momo/master/Bmatovu/MtnMomo/Products/Disbursement.html#method_getAccountBalance)

    ```php
    $disbursement->getAccountBalance()
    ```

4. [Check account status](https://mtvbrianking.github.io/laravel-mtn-momo/master/Bmatovu/MtnMomo/Products/Disbursement.html#method_isActive)

    ```php
    $disbursement->isActive($partyId)
    ```

5. [Get OAuth token](https://mtvbrianking.github.io/laravel-mtn-momo/master/Bmatovu/MtnMomo/Products/Disbursement.html#method_getToken)

    ```php
    $disbursement->getToken()
    ```

**Remittance**

1. [Remit money](https://mtvbrianking.github.io/laravel-mtn-momo/master/Bmatovu/MtnMomo/Products/Remittance.html#method_transact)

    ```php
    $remittance->transfer($transactionId, $partyId, $amount)
    ```

2. [Check transaction status](https://mtvbrianking.github.io/laravel-mtn-momo/master/Bmatovu/MtnMomo/Products/Remittance.html#method_getTransactionStatus)

    ```php
    $remittance->getTransactionStatus($momoTransactionId)
    ```

3. [Check account balance](https://mtvbrianking.github.io/laravel-mtn-momo/master/Bmatovu/MtnMomo/Products/Remittance.html#method_getAccountBalance)

    ```php
    $remittance->getAccountBalance()
    ```

4. [Check account status](https://mtvbrianking.github.io/laravel-mtn-momo/master/Bmatovu/MtnMomo/Products/Remittance.html#method_isActive)

    ```php
    $remittance->isActive($partyId)
    ```

5. [Get OAuth token](https://mtvbrianking.github.io/laravel-mtn-momo/master/Bmatovu/MtnMomo/Products/Remittance.html#method_getToken)

    ```php
    $remittance->getToken()
    ```

### Go live

You will need to make some changes to your setup before going live. [Read more](https://github.com/mtvbrianking/laravel-mtn-momo/wiki/Go-Live).

### Reporting bugs

If you've stumbled across a bug, please help us by leaving as much information about the bug as possible, e.g.
- Steps to reproduce
- Expected result
- Actual result

This will help us to fix the bug as quickly as possible, and if you wish to fix it yourself feel free to [fork the package](https://github.com/mtvbrianking/laravel-mtn-momo) and submit a pull request!
