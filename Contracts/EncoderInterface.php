<?php

namespace DrCoder\Contracts;

interface EncoderInterface
{
    public static function encode(array $data, $keys = null, $sign = true);
    public static function decode(array $data, $keys = null, $unsigned = true);
}
