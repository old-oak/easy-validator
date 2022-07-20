<?php

namespace OldOak\EasyValidator\Common;


use OldOak\EasyValidator\Translations\AbstractTranslation;
use OldOak\EasyValidator\Translations\Languages\Ru;

/**
 * Class Config настройка валидатора
 * @package OldOak\EasyValidator\Common
 */
class Config
{
    /**
     * Константа с кодом настройки языка, по умолчанию OldOak\EasyValidator\Translations\Languages\Ru
     */
    const LANG_CLASS_SYSTEM_CODE = 'language';

    /**
     * Константа с кодом настройки необходимости логированя каждой попытки валидации, по умолчанию <b>TRUE</b>
     */
    const HAS_LOG_SYSTEM_CODE = 'has_log';

    /**
     * Константа с кодом настройки класса логирования, который должен реализовывать интерфейс \Psr\Log\LoggerInterface или иметь внутри public function info по умолчанию <b>''</b>
     */
    const LOG_CLASS_SYSTEM_CODE = 'class_log';

    /**
     * Константа с кодом настройки специального типа проверки - nullable
     */
    const NULLABLE_RULE_SYSTEM_CODE = 'nullable_rule';

    /**
     * Константа с кодом настройки слова-заменителя в сообщении, по умолчанию ":attribute"
     */
    const CODE_REPLACE_SYSTEM_CODE = 'code_replace';

    /**
     * Константа с кодом настройки разделитебя сообщения для определенного типа проверки, например: test.message, test.url и подобные, по умолчанию "."
     */
    const SEPARATOR_CUSTOM_MESSAGE_SYSTEM_CODE = 'separator_custom_message';

    /**
     * Константа с кодом настройки разделителя у правила, например: file:img, choice:[0|5], по умолчанию ":"
     */
    const RULE_SEPARATOR_SYSTEM_CODE = 'rule_separator';

    /**
     * Константа с кодом настройки для остановки работы валидатора, в случе, если при проверки правила оно вернулось с ошибкой, то другие правила не будут проверяться, по умолчанию <b>FALSE</b>
     */
    const CONTINUE_ERROR_SYSTEM_CODE = 'continue_error';

    /**
     * Константа с кодом настройки для валидации номеров телефона, в случае, если указан как <b>TRUE</b>, то будет удаление всех символов из проверяемого значения КРОМЕ цифр, иначе, символы не удаляются и проверяется на более сложное регулярное выражеение, по умолчанию <b>TRUE</b>
     */
    const RULEBOOK_PHONE_SYSTEM_CODE = 'rulebook_phone';

    /**
     * @var array $config
     */
    public static $config = [
        self::LANG_CLASS_SYSTEM_CODE                => Ru::class,
        self::HAS_LOG_SYSTEM_CODE                   => true,
        self::LOG_CLASS_SYSTEM_CODE                 => '',
        self::NULLABLE_RULE_SYSTEM_CODE             => 'nullable',
        self::CODE_REPLACE_SYSTEM_CODE              => ':attribute',
        self::SEPARATOR_CUSTOM_MESSAGE_SYSTEM_CODE  => '.',
        self::RULE_SEPARATOR_SYSTEM_CODE            => ':',
        self::CONTINUE_ERROR_SYSTEM_CODE            => false,
        self::RULEBOOK_PHONE_SYSTEM_CODE            => true,
    ];

    /**
     * Получение массива настроек валидатора
     * @return array
     */
    public static function getConfig()
    {
        return self::$config;
    }

    /**
     * Установка массива настроек валидатора
     * @param array $config
     */
    public static function setConfig(array $config)
    {
        self::$config = $config;
    }

    /**
     * Инициализация настроек валидатора
     * @param array $options массив с настройками, где ключ это специальный код настройки, а значение - значение настройки
     */
    public static function init(array $options)
    {
        foreach ($options as $code => $option) {
            if (Helper::arrayCheck(self::$config, $code)) {
                self::$config[$code] = $option;
            }
        }
    }

    /**
     * Получение настройки по коду, если она сущетсвует
     * @param string|int $code код, по которому можно получить настройку
     * @return mixed|null Если настройка не существует, то вернется <b>NULL</b>, иначе, значение конфигурация
     */
    public static function getConfigByCode($code)
    {
        $config = self::getConfig();
        if ((is_int($code) || is_string($code)) && Helper::arrayCheck($config, $code)) {
            return $config[$code];
        }
    }

    /**
     * Установка класса переводов
     * @param $lang_class
     * @return bool
     */
    public static function setLangClass($lang_class)
    {
        if(AbstractTranslation::checkClassLang($lang_class)) {
            self::$config[self::LANG_CLASS_SYSTEM_CODE] = $lang_class;
            return true;
        }

        return false;
    }

    /**
     * Установка необходимости логирования проверяеммых данных
     * @param $has_log
     * @return bool
     */
    public static function setHasLog($has_log)
    {
        self::$config[self::HAS_LOG_SYSTEM_CODE] = (bool)$has_log;
        return true;
    }

    /**
     * Установка необходимости логирования проверяеммых данных
     * @param $class_log
     * @return bool
     */
    public static function setClassLog($class_log)
    {
        if(method_exists($class_log, 'info')) {
            self::$config[self::LOG_CLASS_SYSTEM_CODE] = $class_log;
            return true;
        }

        return false;
    }

    /**
     * Установка nullable правила
     * @param $nullable_rule
     * @return bool
     */
    public static function setNullableRule($nullable_rule)
    {
        self::$config[self::NULLABLE_RULE_SYSTEM_CODE] = (string)$nullable_rule;
        return true;
    }

    /**
     * Установка слова-заменителя
     * @param $code_replace
     * @return bool
     */
    public static function setCodeReplace($code_replace)
    {
        self::$config[self::CODE_REPLACE_SYSTEM_CODE] = (string)$code_replace;
        return true;
    }

    /**
     * Установка разделителя сообщения
     * @param $separator_custom_message
     * @return bool
     */
    public static function setSeparatorCustomMessage($separator_custom_message)
    {
        self::$config[self::SEPARATOR_CUSTOM_MESSAGE_SYSTEM_CODE] = (string)$separator_custom_message;
        return true;
    }

    /**
     * Установка разделителя у правила, например: file:img, choice:[0|5]
     * @param $rule_separator
     * @return bool
     */
    public static function setRuleSeparator($rule_separator)
    {
        self::$config[self::RULE_SEPARATOR_SYSTEM_CODE] = (string)$rule_separator;
        return true;
    }

    /**
     * Установка флага о том, нужно ли продолжать валидацию данных, есть где-то вернулась обишка
     * @param $continue_error
     * @return bool
     */
    public static function setContinueError($continue_error)
    {
        self::$config[self::CONTINUE_ERROR_SYSTEM_CODE] = (bool)$continue_error;
        return true;
    }

    /**
     * Установка флага о том, как нужно проверять номер телефона (с очищением всех символов кроме цифр или нет)
     * @param $rulebook_phone
     * @return bool
     */
    public static function setRulebookPhone($rulebook_phone)
    {
        self::$config[self::RULEBOOK_PHONE_SYSTEM_CODE] = (bool)$rulebook_phone;
        return true;
    }
}