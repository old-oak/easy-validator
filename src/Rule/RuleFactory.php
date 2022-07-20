<?php

namespace OldOak\EasyValidator\Rule;


use OldOak\EasyValidator\Common\Constant;
use OldOak\EasyValidator\Common\Helper;
use OldOak\EasyValidator\Common\ValidatorException;
use OldOak\EasyValidator\Translations\AbstractTranslation;

/**
 * Class RuleFactory
 * @package OldOak\EasyValidator\Rules
 */
class RuleFactory
{
    /**
     * Фабрика правил
     *
     * @param Rule $rule Класс правила
     * @param mixed $value Значение для проверки
     *
     * @return AbstractRulebook Экземпляр-наследник класса свода правил
     *
     * @throws ValidatorException
     */
    final public static function factory(Rule $rule, $value)
    {
        //Получаем все доступные своды правил, которые заявляны в библиотеке
        $allowedRuleMethods = DefaultRulebooks::getRules();

        //Проверим, может было объявлено какое-то кастом правило, если оно есть, то запустим его
        $customRule = Registration::getCustomRuleByName($rule->name);
        if($customRule !== null) {
            return new $customRule($value, $rule->params);
        }

        //Получим класс свода правил, исходя из правила, которое сейчас выполняется
        $className = $rule->getRulebookClass();

        //Класса проверки не существует, выдаем исключение
        if(!Helper::arrayCheck($allowedRuleMethods, $className)) {
            $lang = AbstractTranslation::getLangClass();
            throw new ValidatorException(sprintf($lang::geTranslateMessage(Constant::METHOD_NOT_FOUND), $rule->name));
        }

        //Получаем класс правила и возвращаем его
        $classRule = $allowedRuleMethods[$className];
        return new $classRule($value, $rule->params);
    }
}