# Encoder package

This package handle and encode/decode any data;
The package provide some drivers to encode/decode the data that will explain below.

## Installation.

install via composer: 

```bash
composer require snappdoctor/drcoder
```


then use this command if needed:

```bash
php artisan vendor:publish
```

finall, register your package service provider into ```config/app.php``` providers array.

## How it works?

first , call the service:

```php
use DrCoder\EncoderService\EncoderService;
```

for encoding:

```php
$encodedData = EncoderService::driver(EncoderService::DRIVER_BASE64)
                               ->encode([data, data]);
echo $encodedData[0]; // your encoded data.
```

for decoding:

```php
$decodedData = EncoderService::driver(EncoderService::DRIVER_BASE64)
                               ->decode([encoded data, encoded data]);
echo $decodedData[0]; // your encoded data.
```

you can also use associative arrays and get the response with same index keys.
More example file placed in [here](./Examples) to get better details of this package.
