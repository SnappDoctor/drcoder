<p align="center"><a href="https://snapp.doctor" target="_blank"><img src="https://snapp.doctor/static/media/snap_header.81dda777.png" width="200"></a></p>
<p align="center">
<a href="https://packagist.org/packages/snappmarket/smnotif-php-bridge"><img src="https://poser.pugx.org/snappmarket/smnotif-php-bridge/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/snappmarket/smnotif-php-bridge"><img src="https://poser.pugx.org/snappmarket/smnotif-php-bridge/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/snappmarket/smnotif-php-bridge"><img src="https://poser.pugx.org/snappmarket/smnotif-php-bridge/license.svg" alt="License"></a>
<a href="https://packagist.org/packages/snappmarket/smnotif-php-bridge"><img src="https://poser.pugx.org/snappmarket/smnotif-php-bridge/composerlock" alt="License"></a>
</p># SnappDoctor Encoder package

This package handle and encode/decode any data;
The package provide some drivers to encode/decode the data that will explain below.

## Installation.

install via composer: 

```bash
$ composer require snappdoctor/drcoder
```


then use this command if needed:

```bash
$ php artisan vendor:publish
```

finall, register your package service provider into ```config/app.php``` providers array.

## How it works?

first , call the service:

```php
use DrCoder\EncoderService;
```

for encoding:

```php
$first = "encode_me_1";
$second = "encode_me_2";

$base64_encoded_array = EncoderService::driver(EncoderService::DRIVER_BASE64)
                               ->encode([$first, $second]);
                               
$first_base64_encoded =  $base64_encoded_array[0];
$second_base64_encoded =  $base64_encoded_array[1];

$aes_encoded_array = EncoderService::driver(EncoderService::DRIVER_AES_SSL)
                               ->encode([$first, $second]);
                               
$first_aes_encoded =  $aes_encoded_array[0];
$second_aes_encoded =  $aes_encoded_array[1];
```

for decoding:

```php
$first = "decode_me_1";
$second = "decode_me_2";

$base64_decoded_array = EncoderService::driver(EncoderService::DRIVER_BASE64)
                               ->decode([$first, $second]);
                               
$first_base64_decoded =  $base64_decoded_array[0];
$second_base64_decoded =  $base64_decoded_array[1];

$aes_decoded_array = EncoderService::driver(EncoderService::DRIVER_BASE64)
                               ->decode([$first, $second]);

$first_aes_decoded =  $aes_decoded_array[0];
$second_aes_decoded =  $aes_decoded_array[1];
```

you can also use associative arrays and get the response with same index keys.
More example file placed in [here](./Examples) to get better details of this package.
