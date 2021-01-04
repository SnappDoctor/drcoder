# Encoder package

This package handle and encode/decode any data;
The package provide some drivers to encode/decode the data that will explain below.

## Installation.

install via composer: 

``composer require snappdoctor/drcoder``


then use this command if needed:

``
php artisan vendor:publish
``

finall, register your package service provider into ``app/condig`` providers array.

## How it works?

first , call the service:

``
use DrCoder\EncoderService;
``

for encoding:

``
$encodedData = EncoderService::driver(EncoderService::DRIVER_BASE64)->encode([data, data])
echo $encodedData[0] // your encoded data.
``

for decoding:

``
$decodedData = EncoderService::driver(EncoderService::DRIVER_BASE64)->decode([encoded data, encoded data])
echo $decodedData[0] // your encoded data.
``

you can also use associative arrays and get the response with same index keys.
