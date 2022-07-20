<?php

namespace OldOak\EasyValidator\Common;

if(!function_exists('mb_str_replace')) {
    function mb_str_replace($needle, $replacement, $haystack) {
        return implode($replacement, mb_split($needle, $haystack));
    }
}

if (!function_exists('array_key_first')) {
    function array_key_first(array $array, $default = null)
    {
        foreach ($array as $key => $value) {
            return $key;
        }

        return $default;
    }
}

if (!function_exists('array_first')) {
    function array_first(array $array, $default = null)
    {
        foreach ($array as $item) {
            return $item;
        }
        return $default;
    }
}

/**
 * Class Helper
 *
 * @package OldOak\EasyValidator\Common
 */
class Helper
{
    /**
     * Адекватная и быстрая проверка на наличии ключа в массиве
     *
     * @param array $array
     * @param array|string|int $key
     * @param bool $all_matches используется только если <b>$key</b> array
     *
     * @return bool
     */
    public static function arrayCheck($array, $key, $all_matches = true)
    {
        if (is_array($key)) {
            $return = true;

            if ($all_matches) {
                foreach ($key as $key_array => $key_value) {
                    if (!(isset($array[$key_value]) || array_key_exists($key_value, $array))) {
                        $return = false;
                        break;
                    }
                }
            } else {
                $return = false;
                foreach ($key as $key_array => $key_value) {
                    if (isset($array[$key_value]) || array_key_exists($key_value, $array)) {
                        $return = true;
                        break;
                    }
                }
            }

            return $return;
        }

        return $key && is_array($array) && (isset($array[$key]) || array_key_exists($key, $array));
    }

    /**
     * @param $value
     * @return string
     */
    public static function toCamelCase($value)
    {
        return lcfirst(self::studly($value));
    }

    /**
     * @param $value
     * @return mixed
     */
    public static function studly($value)
    {
        if(is_string($value)) {
            $value = ucwords(str_replace(array('-', '_'), ' ', $value));
            return str_replace(' ', '', $value);
        }

        return '';
    }
}