<?php

namespace DrCoder\Traits;

/**
 * Trait SignerTrait.
 *
 * @package teleyare\Services\DataAction\Utils\Encoder
 */
trait SignerTrait
{
    /**
     * Assign the sign code to value.
     *
     * @param $value
     *
     * @return string
     */
    private static function sign($value)
    {
        return config('encoder_service.sign') . $value;
    }

    /**
     * unsigned the 'sign code' from value.
     *
     * @param $value
     *
     * @return string
     */
    private static function unsigned($value)
    {
        $sign = config('encoder_service.sign');

        return str_replace($sign, '', $value);
    }
}
