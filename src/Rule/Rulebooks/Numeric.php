<?php

namespace OldOak\EasyValidator\Rule\Rulebooks;


use OldOak\EasyValidator\Common\Constant;
use OldOak\EasyValidator\Rule\AbstractRulebook;

/**
 * Class Numeric
 * @package OldOak\EasyValidator\Rules\Rulebooks
 */
class Numeric extends AbstractRulebook
{
    /**
     * Метод проверяет, является ли значение <b>$this->value</b> числом или строкой с числом (но без букв) <br>
     * Данные проходящие валидацию: int, float, string(если в этой строке есть только числа типа float)
     * <br>
     *
     * Пример:
     * 'Название_ключа_для_проверки' => 'numeric(:число_для_проверки)'
     * ['test' => 'numeric', 'test1' => 'numeric:123', 'test3' => 'numeric:3,5']
     *
     * @return bool
     */
    public function validate()
    {
        $firstCheck = is_numeric($this->value);
        if ($this->comparison_value === null) {
            $this->codeResult = $firstCheck ? Constant::IS_NUMERIC : Constant::NOT_NUMERIC;
            return $firstCheck;
        }

        if(!is_numeric($this->comparison_value)) {
            $this->codeResult = Constant::NOT_NUMERIC;
            return false;
        }

        $isValidate = $this->value == $this->comparison_value;
        $this->codeResult = $isValidate ? Constant::IS_NUMERIC : Constant::NOT_NUMERIC;
        return $isValidate;
    }
}