<?php

namespace OldOak\EasyValidator\Rule;


use OldOak\EasyValidator\Common\Constant;
use OldOak\EasyValidator\Common\Helper;
use OldOak\EasyValidator\Common\ValidatorException;
use OldOak\EasyValidator\Translations\AbstractTranslation;

/**
 * Class Registration
 * @package OldOak\EasyValidator\Rules
 */
class Registration
{
    /**
     * Массив уникальных правил, которые были определены ВНЕ библиотеки
     * @var array $customRules
     */
    protected static $customRules = [];

    /**
     * Получение всех уникальных правил
     * @return array
     */
    public static function getCustomRules()
    {
        return self::$customRules;
    }

    /**
     * Установка уникальных правил
     * @param array $custom_rules
     * @throws ValidatorException
     */
    public static function setCustomRules(array $custom_rules)
    {
        foreach ($custom_rules as $name => $class) {
            self::addCustomRule($name, $class);
        }
    }

    /**
     * Получение уникального правила по его названию
     * @param string $name_rule название правила
     * @return AbstractRulebook|null
     */
    public static function getCustomRuleByName($name_rule)
    {
        $customRules = self::getCustomRules();

        //Проверим есть ли правило по его коду, и наследуется ли оно от абстракции
        if(Helper::arrayCheck($customRules, $name_rule)) {
            return $customRules[$name_rule];
        }

        return null;
    }

    /**
     * Добавление уникального правила
     *
     * @param string $name_rule Название правила
     * @param string|AbstractRulebook $class_name Имя класса
     *
     * @throws ValidatorException
     */
    public static function addCustomRule($name_rule, $class_name)
    {
        if(!is_string($name_rule) || !self::checkClassCustomRule($class_name)) {
            $langClass = AbstractTranslation::getLangClass();
            throw new ValidatorException($langClass::geTranslateMessage(Constant::FAIL_ADD_CUSTOM_RULE));
        }

        self::$customRules[$name_rule] = $class_name;
    }

    /**
     * Удаление уникального правила по его названию
     * @param string $name_rule
     * @return true
     */
    public static function deleteCustomRule($name_rule)
    {
        $customRules = self::getCustomRules();
        if(Helper::arrayCheck($customRules, $name_rule)) {
            unset($customRules[$name_rule]);
        }

        return true;
    }

    /**
     * @param $class_name
     * @return bool
     */
    protected static function checkClassCustomRule($class_name)
    {
        return is_subclass_of($class_name, AbstractRulebook::class);
    }

}