<?php

namespace DrCoder;

use InvalidArgumentException;

use DrCoder\Encoders\AesSslEncoder;
use DrCoder\Encoders\Base64Encoder;

/**
 * Class EncoderService.
 *
 * @package teleyare\Services\EncoderService
 */
class EncoderService
{
    /**
     * @var string DRIVER_BASE64
     * @var string DRIVER_AES_SSL
     */
    const DRIVER_BASE64 = 'base64';
    const DRIVER_AES_SSL = 'aes-ssl';

    /**
     * Return selected encoder class via driver parameter.
     *
     * @param string $driver
     *
     * @return mixed
     */
    public static function driver($driver = self::DRIVER_AES_SSL)
    {
        switch ($driver) {
            case self::DRIVER_BASE64:
                return new Base64Encoder();

            case self::DRIVER_AES_SSL:
                return new AesSslEncoder();

            default:
                throw new InvalidArgumentException('driver not found');
        }
    }

    /**
     * Decode the incoming data.
     *
     * @param string $data
     *
     * @return false|string
     */
    public static function base64Decode($data)
    {
        return base64_decode($data);
    }

    /**
     * Encode the incoming data.
     *
     * @param string $data
     *
     * @return string
     */
    public static function base64Encode($data)
    {
        return base64_encode($data);
    }

    /**
     * Check the argument that is encoded or not.
     *
     * @param $message
     * @return bool
     */
    public static function isEncoded($message)
    {
        return (strpos($message, env('ENCODER_SERVICE_SIGN')) !== false);
    }
}
