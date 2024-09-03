## TNT ExpressConnect

### Client version for myTNT Italy APIs

## Original upstream repository documentation

PHP client which helps developers integrate TNT EC with their application.
This package supports following services:
1. [Shipping](https://github.com/200MPH/tnt/blob/develop/docs/Shipping/howTo.md)
2. [Tracking](https://github.com/200MPH/tnt/blob/develop/docs/Tracking/howTo.md)

## Forked repository documentation

This package is an unofficial PHP client for myTNT Italy Express Connect APIs.

## Installing
Install with composer
```shell
composer require dinja/mytnt-express-connect-italy
```

## Usage
### Shipping

1. Minimal request to create shipment

```php
use thm\tnt_ec\service\ShippingService\ShippingService;

$timestamp = new \DateTime();
$timezone = new \DateTimeZone('Europe/Rome');
$timestamp->setTimezone($timezone);

$shipping = new ShippingService('User ID', 'Password');

$shipping->setAccountNumber('') // will be provided by your TNT representative.
         ->setSenderAccId(''); // will be provided by your TNT representative.

$c1 = $shipping->addConsignment()->setConReference('')
                                 ->setContype('T')
                                 ->setPaymentind('S') // who pays for shipping S-sender, R-receiver
                                 ->setItems(1)
                                 ->setTotalWeight("00001000")
                                 ->setTotalVolume(0.00)
                                 ->setPackagetype('C')
                                 ->setDivision('D')
                                 ->setCollectionDate($timestamp->format('Ymd'))
                                 ->setService('N'); // will be provided by your TNT representative.

$c1->setSender()->setCompanyName('Your company')
                ->setAddressLine('Address 1')
                ->setCity('')
                ->setPostcode('')
                ->setProvince('')
                ->setCountry('')
                ->setContactDialCode('')
                ->setContactPhone('')
                ->setContactEmail('');

$c1->setReceiver()->setCompanyName('Receiver address. NOT DELIVERY!')
                  ->setAddressLine('')
                  ->setCity('')
                  ->setPostcode('')
                  ->setProvince('')
                  ->setCountry('')
                  ->setContactDialCode('')
                  ->setContactPhone('')
                  ->setContactEmail('');

$response = $shipping->send();
```

2. Delete Shipment

```php
use thm\tnt_ec\service\ShippingService\ShippingService;

$timestamp = new \DateTime();
$timezone = new \DateTimeZone('Europe/Rome');
$timestamp->setTimezone($timezone);

$shipping = new ShippingService('User ID', 'Password');

$shipping->setAccountNumber('') // will be provided by your TNT representative.
         ->setSenderAccId(''); // will be provided by your TNT representative.

$c1 = $shipping->addConsignment()->setConAction("D")
               ->setConNumber('tracking_number'); // Shipment Number to delete

$response = $shipping->send();
```

### Tracking
```php
use thm\tnt_ec\service\TrackingService\TrackingService;

$ts = new TrackingService('User ID', 'Password');
$ts->setAccountNumber('');  // will be provided by your TNT representative.

$response = $ts->searchByConsignment(array('tracking_number')); // Shipment Number to search
```
