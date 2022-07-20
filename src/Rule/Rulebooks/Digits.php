<?php

namespace OldOak\EasyValidator\Rule\Rulebooks;


use OldOak\EasyValidator\Common\Constant;
use OldOak\EasyValidator\Rule\AbstractRulebook;

/**
 * Class Digit
 * @package EasyValidator\Rules
 */
class Digits extends AbstractRulebook
{

    /**
     * Метод проверяет, является ли значение в <b>$this->value</b> целым числом <br>
     * Данные проходящие валидацию: int, string(но только, если вней все символы являются числами [0-9])
     * <br>
     *
     * Пример:
     * 'Название_ключа_для_проверки' => 'digits(:число_для_проверки)'
     * ['test' => 'digits', 'test1' => 'digits:123']
     *
     * @return bool
     */
    public function validate()
    {
        $firstCheck = is_int($this->value) || (ctype_digit($this->value) && $this->value !== '');
        if ($this->comparison_value === null) {
            $this->codeResult = $firstCheck ? Constant::IS_DIGIT : Constant::NOT_DIGIT;
            return $firstCheck;
        }

        if(!(is_int($this->comparison_value) || (ctype_digit($this->comparison_value) && $this->comparison_value !== ''))) {
            $this->codeResult = Constant::NOT_DIGIT;
            return false;
        }

        $isValidate = (int)$this->value === (int)$this->comparison_value;
        $this->codeResult = $isValidate ? Constant::IS_DIGIT : Constant::NOT_DIGIT;
        return $isValidate;
    }
}