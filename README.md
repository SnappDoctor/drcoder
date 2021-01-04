<p align="center"><a href="https://snapp.doctor" target="_blank"><img src="https://snapp.doctor/static/media/snap_header.81dda777.png" width="200"></a></p>
<p align="center">
<a href="https://packagist.org/packages/snappdoctor/drcoder"><img src="https://poser.pugx.org/snappdoctor/drcoder/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/snappdoctor/drcoder"><img src="https://poser.pugx.org/snappdoctor/drcoder/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/snappdoctor/drcoder"><img src="https://poser.pugx.org/snappdoctor/drcoder/license.svg" alt="License"></a>
<a href="https://packagist.org/packages/snappdoctor/drcoder"><img src="https://poser.pugx.org/snappdoctor/drcoder/composerlock" alt="License"></a>
</p>

# SnappDoctor Encoder package

This package handle and encode/decode any data.
The package provide some drivers to encode/decode the data that will explain below.

## Installation.

Before anything, The developer has to know witch Encoder class 
uses the built-in hash functions to do the process, so according
to your PHP version you have to configure appropriate hashing drivers in your setup;
for now we assume that you use version `< 7.0` of PHP, otherwise you have to manually enable the `mcrypt` extension
basic on your current version.

install via composer: 

```bash
$ composer require snappdoctor/drcoder
```


then use this command if needed:

```bash
$ php artisan vendor:publish
```

The package use env variables that encode/decode process need it to work, so you have to add these variables to your `.env` file:

```bash
ENCODER_SERVICE_IV=
ENCODER_SERVICE_KEY=
ENCODER_SERVICE_MODE=
ENCODER_SERVICE_SIGN=
ENCODER_SERVICE_BLOCK_SIZE=
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
