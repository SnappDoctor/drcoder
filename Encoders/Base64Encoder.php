<?php

namespace DrCoder\Encoders;

use DrCoder\Traits\SignerTrait;
use DrCoder\Contracts\EncoderInterface;

/**
 * Class Encoder
 *
 * @package teleyare\Services\DataAction\Utils\Signer
 */
class Base64Encoder extends BaseEncoder implements EncoderInterface
{
    use SignerTrait;

    /**
     * Encode data using php built-in base64_encode().
     *
     * @param $data
     * @param null $keys
     * @param bool $sign
     *
     * @return array
     */
    public static function encode(array $data, $keys = null, $sign = true)
    {
        // Validate Data.
        self::dataValidator($data, $keys);

        $result = [];

        foreach (self::handleData($data) as $item => $value) {

            $result[$item] = $value;

            if (is_array($keys)) {

                foreach ($keys as $key) {
                    $result[$item][$key] = $sign
                        ? self::sign(base64_encode($result[$item][$key]))
                        : base64_encode($result[$item][$key]);
                }

                continue;
            }

            $result[$item] = $sign
                ? self::sign(base64_encode($value))
                : base64_encode($value);
        }

        return $result;
    }

    /**
     * Decode data using php built-in base64_decode().
     *
     * @param $data
     * @param null $keys
     * @param bool $unsigned
     *
     * @return array
     */
    public static function decode(array $data, $keys = null, $unsigned = true)
    {
        // Validate Data.
        self::dataValidator($data, $keys);

        $result = [];

        foreach (self::handleData($data) as $item => $value) {

            $result[$item] = $value;

            if (is_array($keys)) {

                foreach ($keys as $key) {
                    $result[$item][$key] = $unsigned
                        ? base64_decode(self::unsigned($result[$item][$key]))
                        : self::sign(base64_decode(self::unsigned($result[$item][$key])));
                }

                continue;
            }

            $result[$item] = $unsigned
                ? base64_decode(self::unsigned($value))
                : self::sign(base64_decode(self::unsigned($value)));
        }

        return $result;
    }
}
