<?php

namespace OldOak\EasyValidator\Translations;

use OldOak\EasyValidator\Common\Config;
use OldOak\EasyValidator\Common\Helper;

/**
 * Class AbstractTranslation
 * @package OldOak\EasyValidator\Common\Translations
 */
abstract class AbstractTranslation
{
    /**
     * Сообщения
     * @var array $messages
     */
    protected static $messages = [];

    /**
     * Языковой класс
     * @var AbstractTranslation $langClass
     */
    protected static $langClass;

    /**
     * Получаем сообщение с учетом языка
     * @param string $code
     * @return mixed|null
     */
    public static function geTranslateMessage($code)
    {
        return Helper::arrayCheck(static::$messages, $code) === true ? static::$messages[$code] : null;
    }

    /**
     * Получение массива сообщений
     * @return array
     */
    public static function getMessages()
    {
        return self::$messages;
    }

    /**
     * Установка массива сообщений
     * @param array $messages
     */
    public static function setMessages($messages)
    {
        self::$messages = $messages;
    }

    /**
     * Добавление сообщения в массив сообщений
     * @param string $code
     * @param string $message
     */
    public static function addMessage($code, $message)
    {
        self::$messages[$code] = $message;
    }

    /**
     * Получаем языковой класс
     * @return mixed
     */
    public static function getLangClass()
    {
        if (self::$langClass !== null) {
            return self::$langClass;
        }

        self::$langClass = Config::getConfigByCode(Config::LANG_CLASS_SYSTEM_CODE);
        return self::$langClass;
    }

    public static function checkClassLang($class_name)
    {
        return is_subclass_of($class_name, self::class);
    }
}