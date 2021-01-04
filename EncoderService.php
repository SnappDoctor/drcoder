<?php

namespace DrCoder\EncoderService;

use InvalidArgumentException;
use DrCoder\Traits\SignerTrait;
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
    public const DRIVER_BASE64 = 'base64';
    public const DRIVER_AES_SSL = 'aes-ssl';

    /**
     * Return selected encoder class via driver parameter.
     *
     * @param string $driver
     *
     * @return mixed
     */
    public static function driver(string $driver = self::DRIVER_AES_SSL)
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
     * Check the argument that is encoded or not.
     *
     * @param $message
     * @return bool
     */
    public static function isEncoded($message)
    {
        return (strpos($message, SignerTrait::$sign) !== false);
    }
}
