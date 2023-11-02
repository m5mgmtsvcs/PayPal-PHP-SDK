<?php

namespace PayPal\Validation;

/**
 * Class JsonValidator
 *
 * @package PayPal\Validation
 */
class JsonValidator
{

    /**
     * Helper method for validating if string provided is a valid json.
     *
     * @param string|null $string String representation of Json object
     * @param bool $silent Flag to not throw \InvalidArgumentException
     * @return bool
     */
    public static function validate(string|null $string, bool $silent = false)
    {
        @json_decode($string, true, 512, 0);
        if (json_last_error() != JSON_ERROR_NONE) {
            if ($string === '' || $string === null) {
                return true;
            }
            if (!$silent) {
                //Throw an Exception for string or array
                throw new \InvalidArgumentException("Invalid JSON String");
            }
            return false;
        }
        return true;
    }
}
