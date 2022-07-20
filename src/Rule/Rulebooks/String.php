<?php

namespace OldOak\EasyValidator\Rule\Rulebooks;


use OldOak\EasyValidator\Common\Constant;
use OldOak\EasyValidator\Rule\AbstractRulebook;

/**
 * Class String
 * @package OldOak\EasyValidator\Rules\Rulebooks
 */
class String extends AbstractRulebook
{

    /**
     * Метод проверяет, является ли значение <b>$this->value</b> строкой <br>
     * Данные проходящие валидацию: string
     * <br>
     *
     * Пример:
     * 'Название_ключа_для_проверки' => 'string'
     * ['test' => 'string']
     *
     * @return bool
     */
    public function validate()
    {
        $isValidate = is_string($this->value);
        $this->codeResult = $isValidate ? Constant::IS_STRING : Constant::NOT_STRING;
        return $isValidate;
    }
}