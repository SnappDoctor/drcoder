# Encoder package

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
use DrCoder\EncoderService\EncoderService;
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
                               ->encode([data, data]);
$first_aes_encoded =  $aes_encoded_array[0];
$second_aes_encoded =  $aes_encoded_array[1];
```

for decoding:

```php
$base64_decoded_array = EncoderService::driver(EncoderService::DRIVER_BASE64)
                               ->decode([encoded data, encoded data]);
$aes_decoded_array = EncoderService::driver(EncoderService::DRIVER_BASE64)
                               ->decode([encoded data, encoded data]);
echo $decodedData[0]; // your encoded data.
```

you can also use associative arrays and get the response with same index keys.
More example file placed in [here](./Examples) to get better details of this package.
