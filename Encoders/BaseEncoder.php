<?php

namespace DrCoder\Encoders;

use Generator;
use RuntimeException;

/**
 * Class BaseEncoder
 * @package teleyare\Services\EncoderService\Encoders
 */
abstract class BaseEncoder
{
    /**
     * Validate incoming data and related stuff,
     * return boolean in result.
     *
     * @param array $data
     * @param $keys
     *
     * @return bool
     */
    protected static function dataValidator(array $data, $keys)
    {
        $arrayKeys = array_keys($data);

        if (! is_array($data[$arrayKeys[0]]) && ! is_null($keys)) {
            throw new RuntimeException('Invalid array structure, selected keys not found.');
        }

        if (! is_null($keys)) {

            foreach ($keys as $key) {

                if (! array_key_exists($key, $data[$arrayKeys[0]])) {
                    throw new RuntimeException("Invalid array structure, key {$key} not found.");
                }
            }
        }

        return true;
    }

    /**
     * Yield the array.
     *
     * @param array $data
     *
     * @return Generator
     */
    protected static function handleData(array $data)
    {
        foreach ($data as $key => $value) {
            yield $key => $value;
        }
    }
}
