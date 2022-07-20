<?php

namespace OldOak\EasyValidator\Rule;


use OldOak\EasyValidator\Common\Config;
use OldOak\EasyValidator\Common\Constant;
use OldOak\EasyValidator\Common\Helper;
use OldOak\EasyValidator\Common\ValidatorException;
use OldOak\EasyValidator\Translations\AbstractTranslation;

/**
 * Class Rule
 * @package OldOak\EasyValidator\Rules
 */
class Rule
{

    /**
     * Полное название правила с учетом параметров
     * @var string $rule
     */
    public $rule;

    /**
     * Имя правила, которое олицетворяет логику проверки
     * @var string $name
     */
    public $name;

    /**
     * Параметры для проверки
     * @var mixed $params
     */
    public $params;

    /**
     * Rule constructor.
     * @param $rule
     * @throws ValidatorException
     */
    public function __construct($rule)
    {
        if(!is_string($rule)) {
            $lang = AbstractTranslation::getLangClass();
            throw new ValidatorException($lang::geTranslateMessage(Constant::BAD_RULE_NAME));
        }

        $this->rule = $rule;

        $split = $this->splitRuleBySeparator();
        $this->name = array_shift($split);
        $this->params = array_shift($split);
    }

    /**
     * Разбиение правила на название правила и его параметры с уетом специального разделителя, который заявлен в настройках
     * @return array
     */
    public function splitRuleBySeparator()
    {
        return explode(Config::getConfigByCode(Config::RULE_SEPARATOR_SYSTEM_CODE), $this->rule, 2);
    }

    /**
     * Получаем название класса для проверки в camelCase
     * @return string
     */
    public function getRulebookClass()
    {
        return Helper::toCamelCase($this->name);
    }
}