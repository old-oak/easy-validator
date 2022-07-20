<?php

namespace OldOak\EasyValidator\Rule\Rulebooks;


use OldOak\EasyValidator\Common\Constant;
use OldOak\EasyValidator\Rule\AbstractRulebook;

/**
 * Class Min
 * @package OldOak\EasyValidator\Rules\Rulebooks
 */
class Min extends AbstractRulebook
{

    /**
     * Метод проверяет, является ли значение <b>$this->value</b> числом, которое меньше чем <b>$this->comparison_value</b><br>
     * Данные проходящие валидацию: string(если в этой строке есть числа), int, float
     * <br>
     *
     * Пример:
     * 'Название_ключа_для_проверки' => 'min:число'
     * ['test' => 'min:15']
     *
     * @return bool
     */
    public function validate()
    {
        $isValidate = is_numeric($this->value) && is_numeric($this->comparison_value)
            && (float)$this->value < (float) $this->comparison_value;
        $this->codeResult = $isValidate ? Constant::IS_MIN : Constant::NOT_MIN;
        return $isValidate;
    }
}