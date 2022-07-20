<?php

namespace OldOak\EasyValidator\Rule\Rulebooks;


use OldOak\EasyValidator\Common\Constant;
use OldOak\EasyValidator\Rule\AbstractRulebook;

/**
 * Class Boolean
 * @package OldOak\EasyValidator\Rules\Rulebooks
 */
class Boolean extends AbstractRulebook
{

    /**
     * Метод проверяет, является ли значение <b>$this->value</b> логическим <br>
     * Данные проходящие валидацию: true, false, 0, 1
     * <br>
     *
     * Пример:
     * 'Название_ключа_для_проверки' => 'boolean';
     * ['test' => 'boolean']
     *
     * @return bool
     */
    public function validate()
    {
        $isValidate = true;
        if (!((ctype_digit($this->value) && ((int)$this->value === 1 || (int)$this->value === 0))
            || is_bool($this->value)
            || (is_int($this->value) && ((int)$this->value === 1 || (int)$this->value === 0)))) {

            $isValidate = false;
        }

        $this->codeResult = $isValidate ? Constant::IS_BOOLEAN : Constant::NOT_BOOLEAN;
        return $isValidate;
    }
}