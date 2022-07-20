<?php

namespace OldOak\EasyValidator\Rule\Rulebooks;


use OldOak\EasyValidator\Common\Constant;
use OldOak\EasyValidator\Rule\AbstractRulebook;

/**
 * Class Max
 * @package OldOak\EasyValidator\Rules\Rulebooks
 */
class Max extends AbstractRulebook
{

    /**
     * Метод проверяет, является ли значение <b>$this->value</b> числом, которое больше чем <b>$this->comparison_value</b> <br>
     * Данные проходящие валидацию: string(если в этой строке есть числа), int, float
     * <br>
     *
     * Пример:
     * 'Название_ключа_для_проверки' => 'max:число'
     * ['test' => 'max:15']
     *
     * @return bool
     */
    public function validate()
    {
        $isValidate = is_numeric($this->value) && is_numeric($this->comparison_value)
            && (float)$this->value > (float)$this->comparison_value;
        $this->codeResult = $isValidate ? Constant::IS_MAX : Constant::NOT_MAX;
        return $isValidate;
    }
}