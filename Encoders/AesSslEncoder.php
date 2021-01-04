<?php

namespace DrCoder\Encoders;

use DrCoder\Traits\SignerTrait;
use DrCoder\Contracts\EncoderInterface;

class AesSslEncoder extends BaseEncoder implements EncoderInterface
{
    use SignerTrait;

    protected static $key;
    protected static $cipher;
    protected static $mode;
    protected static $IV;

    public function __construct() {
        static::setKey(config('encoder_service.key'));
        static::setBlockSize(config('encoder_service.blockSize'));
        static::setMode(config('encoder_service.mode'));
        static::setIV(config('encoder_service.iv'));
    }

    /**
     *
     * @param string $key
     *
     * @return void
     */
    public static function setKey(string $key) {
        static::$key = $key;
    }

    /**
     * @param string $blockSize
     *
     * @return void
     */
    public static function setBlockSize(string $blockSize) {
        static::$cipher = $blockSize;
    }

    /**
     * @param string $mode
     *
     * @return void
     */
    public static function setMode(string $mode) {
        static::$mode = constant("MCRYPT_MODE_{$mode}");
    }

    /**
     * @param $IV
     *
     * @return void
     */
    public static function setIV($IV) {
        static::$IV = $IV;
    }

    /**
     * @return mixed
     */
    protected static function getIV() {

        if (static::$IV == "") {
            static::$IV = mcrypt_create_iv(mcrypt_get_iv_size(static::$cipher, static::$mode), MCRYPT_RAND);
        }

        return static::$IV;
    }

    /**
     * @param array $data
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
            // Validate Data.
            $result[$item] = $value;

            if (is_array($keys)) {

                foreach ($keys as $key) {
                    $result[$item][$key] = $sign
                        ? self::sign(trim(base64_encode(
                            mcrypt_encrypt(
                                static::$cipher, static::$key, $result[$item][$key], static::$mode, static::getIV()))))
                        : trim(base64_encode(
                            mcrypt_encrypt(
                                static::$cipher, static::$key, $result[$item][$key], static::$mode, static::getIV())));
                }

                continue;
            }

            $result[$item] = $sign
                ? self::sign(trim(base64_encode(
                    mcrypt_encrypt(
                        static::$cipher, static::$key, $value, static::$mode, static::getIV()))))
                : trim(base64_encode(
                    mcrypt_encrypt(
                        static::$cipher, static::$key, $value, static::$mode, static::getIV())));
        }

        return $result;
    }

    /**
     * @param array $data
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
                        ? trim(mcrypt_decrypt(
                            static::$cipher, static::$key, base64_decode(self::unsigned($result[$item][$key])), static::$mode, static::getIV()
                        ))
                        : self::sign(trim(mcrypt_decrypt(
                            static::$cipher, static::$key, base64_decode(self::unsigned($result[$item][$key])), static::$mode, static::getIV())
                        ));
                }

                continue;
            }

            $result[$item] = $unsigned
                ? trim(mcrypt_decrypt(
                    static::$cipher, static::$key, base64_decode(self::unsigned($value)), static::$mode, static::getIV()
                ))
                : self::sign(trim(mcrypt_decrypt(
                    static::$cipher, static::$key, base64_decode(self::unsigned($value)), static::$mode, static::getIV())
                ));
        }

        return $result;
    }
}
