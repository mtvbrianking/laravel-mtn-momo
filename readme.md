## Laravel MTM MOMO API Integration

[![Total Downloads](https://poser.pugx.org/bmatovu/laravel-mtn-momo/downloads)](https://packagist.org/packages/bmatovu/laravel-mtn-momo)
[![Latest Stable Version](https://poser.pugx.org/bmatovu/laravel-mtn-momo/v/stable)](https://packagist.org/packages/bmatovu/laravel-mtn-momo)
[![License](https://poser.pugx.org/bmatovu/laravel-mtn-momo/license)](https://packagist.org/packages/bmatovu/laravel-mtn-momo)
[![Code Quality](https://scrutinizer-ci.com/g/mtvbrianking/laravel-mtn-momo/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/mtvbrianking/laravel-mtn-momo/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/mtvbrianking/laravel-mtn-momo/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/mtvbrianking/laravel-mtn-momo/?branch=master)
[![Tests](https://github.com/mtvbrianking/laravel-mtn-momo/workflows/run-tests/badge.svg)](https://github.com/mtvbrianking/laravel-mtn-momo/actions?query=workflow:run-tests)
[![Documentation](https://github.com/mtvbrianking/laravel-mtn-momo/workflows/gen-docs/badge.svg)](https://mtvbrianking.github.io/laravel-mtn-momo/master)

### Introduction

This package helps you integrate the [MTN MOMO API](https://momodeveloper.mtn.com) into your Laravel application. It provides a wrapper around the core MTN MOMO API services, leaving you to worry about other parts of your application.

### [Installation](https://packagist.org/packages/bmatovu/laravel-mtn-momo)

To get started, install the package via the Composer package manager:

| Laravel      | Package | Installation                                      |
| :----------: | :-----: | ------------------------------------------------- |
| ^6.0         | 2.0     | `composer require bmatovu/laravel-mtn-momo ^2.0`  |
| ^7.0         | 3.0     | `composer require bmatovu/laravel-mtn-momo ^3.0`  |
| ^8.0 \| ^9.0 | master  | `composer require bmatovu/laravel-mtn-momo`       |

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

### Getting started (Sandbox)

Register your client details.

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

### Usage

```php
use Bmatovu\MtnMomo\Products\Collection;

$collection = new Collection();

$momoTransactionId = $collection->requestToPay('transactionId', '46733123454', 100);
```

See [test numbers](https://momodeveloper.mtn.com/api-documentation/testing/#test-numbers)

**Exception handling**

```php
use Bmatovu\MtnMomo\Products\Collection;
use Bmatovu\MtnMomo\Exceptions\CollectionRequestException;

try {
    $collection = new Collection();
    
    $momoTransactionId = $collection->requestToPay('transactionId', '46733123453', 100);
} catch(CollectionRequestException $e) {
    do {
        printf("\n\r%s:%d %s (%d) [%s]\n\r", 
            $e->getFile(), $e->getLine(), $e->getMessage(), $e->getCode(), get_class($e));
    } while($e = $e->getPrevious());
}
```

### [Available methods](https://mtvbrianking.github.io/laravel-mtn-momo/master/Bmatovu/MtnMomo/Products.html)

**Collection**

1. [Collect money](https://mtvbrianking.github.io/laravel-mtn-momo/master/Bmatovu/MtnMomo/Products/Collection.html#method_requestToPay)

    ```php
    $collection->requestToPay($transactionId, $partyId, $amount)
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

6. [Get Account Holder Info](https://mtvbrianking.github.io/laravel-mtn-momo/master/Bmatovu/MtnMomo/Products/Collection.html#method_getAccountHolderBasicInfo)

    ```php
    $collection->getAccountHolderBasicInfo($partyId)
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

6. [Get Account Holder Info](https://mtvbrianking.github.io/laravel-mtn-momo/master/Bmatovu/MtnMomo/Products/Collection.html#method_getAccountHolderBasicInfo)

    ```php
    $disbursement->getAccountHolderBasicInfo($partyId)
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

6. [Get Account Holder Info](https://mtvbrianking.github.io/laravel-mtn-momo/master/Bmatovu/MtnMomo/Products/Collection.html#method_getAccountHolderBasicInfo)

    ```php
    $remittance->getAccountHolderBasicInfo($partyId)
    ```
    
### Go live

You will need to make some changes to your setup before going live. [Read more](https://github.com/mtvbrianking/laravel-mtn-momo/wiki/Go-Live).

### Reporting bugs

If you've stumbled across a bug, please help us by leaving as much information about the bug as possible, e.g.
- Steps to reproduce
- Expected result
- Actual result

This will help us to fix the bug as quickly as possible, and if you wish to fix it yourself feel free to [fork the package](https://github.com/mtvbrianking/laravel-mtn-momo) and submit a pull request!
