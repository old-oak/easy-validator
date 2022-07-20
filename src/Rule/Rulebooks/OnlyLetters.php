<?php

namespace OldOak\EasyValidator\Rule\Rulebooks;


use OldOak\EasyValidator\Common\Constant;
use OldOak\EasyValidator\Rule\AbstractRulebook;

/**
 * Class OnlyLetters
 * @package OldOak\EasyValidator\Rules\Rulebooks
 */
class OnlyLetters extends AbstractRulebook
{

    /**
     * Метод проверяет, является ли значение <b>$this->value</b> строкой ТОЛЬКО с буквами или пустой <br>
     * Данные проходящие валидацию: string(если в этой строке ТОЛЬКО буквы или пустая)
     * <br>
     *
     * Пример:
     * 'Название_ключа_для_проверки' => 'onlyLetters'
     * ['test' => 'onlyLetters']
     *
     * @return bool
     */
    public function validate()
    {
        if(is_string($this->value) && $this->value === '') {
            $isValidate = true;
        } elseif (is_int($this->value)) {
            $isValidate = false;
        } elseif((is_string($this->value) || is_numeric($this->value)) && preg_match('/^\p{L}+$/u', $this->value)) {
            $isValidate = true;
        } else {
            $isValidate = ctype_alpha($this->value);
        }
        $this->codeResult = $isValidate ? Constant::IS_ONLY_LETTERS : Constant::NOT_ONLY_LETTERS;
        return $isValidate;
    }
}