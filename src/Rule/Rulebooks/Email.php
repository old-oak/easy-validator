<?php

namespace OldOak\EasyValidator\Rule\Rulebooks;


use OldOak\EasyValidator\Common\Constant;
use OldOak\EasyValidator\Rule\AbstractRulebook;

/**
 * Class Email
 * @package OldOak\EasyValidator\Rules\Rulebooks
 */
class Email extends AbstractRulebook
{

    /**
     * Метод проверяет, является ли значение <b>$this->value</b> электронной почтой <br>
     * Данные проходящие валидацию: string и валидная электронная почта (простая проверка)
     * <br>
     *
     * Пример:
     * 'Название_ключа_для_проверки' => 'email'
     * ['test' => 'email']
     *
     * @return bool
     */
    public function validate()
    {
        $pattern = '/^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/u';
        $isValidate = !(!is_string($this->value) || preg_match($pattern, $this->value) !== 1);
        $this->codeResult = $isValidate ? Constant::IS_EMAIL : Constant::NOT_EMAIL;
        return $isValidate;
    }
}