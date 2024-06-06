# Peak WMS PHP SDK

[![Latest Version][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE)
[![Build Status][ico-github-actions]][link-github-actions]
[![Code Coverage][ico-code-coverage]][link-code-coverage]
[![Mutation testing][ico-infection]][link-infection]

Consume the [Peak WMS API](https://api.peakwms.com/api/documentation/index.html) in PHP.

## Installation

```bash
composer require setono/peak-wms-php-sdk
```

## Usage

### Create sales order

```php
<?php
use Setono\PeakWMS\Client\Client;
use Setono\PeakWMS\DataTransferObject\Address;
use Setono\PeakWMS\DataTransferObject\SalesOrder\OrderLine\SalesOrderLine;
use Setono\PeakWMS\DataTransferObject\SalesOrder\SalesOrder;

$client = new Client('your_api_key');

$salesOrder = new SalesOrder(
    orderId: 'order_in_your_store',
    forwarderProductId: 'usually_your_shipping_method_id',
    orderNumber: 'order_number_in_your_store',
    billingAddress: new Address(
        customerName: 'John Doe',
        address1: 'Hobrovej 1',
        postalCode: '9000',
        city: 'Aalborg',
        country: 'DK',
        email: 'johndoe@google.com',
        phone: '33762234',
    ),
);

$salesOrder->orderLines[] = new SalesOrderLine(
    orderLineId: 'order_line_id_in_your_store',
    quantityRequested: 1,
    productId: 'BLUE_TSHIRT-L',
);
$client->salesOrder()->create($salesOrder);
```

## Production usage

Internally this library uses the [CuyZ/Valinor](https://github.com/CuyZ/Valinor) library which is particularly well suited
for turning API responses into DTOs. However, this library has some overhead and works best with a cache enabled.

When you instantiate the `Client` use the opportunity to set a cache:

```php
<?php

use CuyZ\Valinor\Cache\FileSystemCache;
use Setono\PeakWMS\Client\Client;

require_once '../vendor/autoload.php';

$cache = new FileSystemCache('path/to/cache-directory');
$client = new Client('API_KEY');
$client->getMapperBuilder()->withCache($cache);
```

You can read more about it here: [Valinor: Performance and caching](https://valinor.cuyz.io/1.3/other/performance-and-caching/).

[ico-version]: https://poser.pugx.org/setono/peak-wms-php-sdk/v/stable
[ico-license]: https://poser.pugx.org/setono/peak-wms-php-sdk/license
[ico-github-actions]: https://github.com/Setono/peak-wms-php-sdk/actions/workflows/build.yaml/badge.svg
[ico-code-coverage]: https://codecov.io/gh/Setono/peak-wms-php-sdk/graph/badge.svg
[ico-infection]: https://img.shields.io/endpoint?style=flat&url=https%3A%2F%2Fbadge-api.stryker-mutator.io%2Fgithub.com%2FSetono%2Fpeak-wms-php-sdk%2Fmaster

[link-packagist]: https://packagist.org/packages/setono/peak-wms-php-sdk
[link-github-actions]: https://github.com/Setono/peak-wms-php-sdk/actions
[link-code-coverage]: https://codecov.io/gh/Setono/peak-wms-php-sdk
[link-infection]: https://dashboard.stryker-mutator.io/reports/github.com/Setono/peak-wms-php-sdk/master
