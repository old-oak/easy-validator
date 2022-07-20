<?php

namespace OldOak\EasyValidator\Rule\Rulebooks;


use OldOak\EasyValidator\Common\Constant;
use OldOak\EasyValidator\Rule\AbstractRulebook;

/**
 * Class Required
 * @package OldOak\EasyValidator\Rules\Rulebooks
 */
class Required extends AbstractRulebook
{

    /**
     * Метод проверяет, является ли значение <b>$this->value</b> заполненное <br>
     * Данные проходящие валидацию: array (не empty), object, int, float, bool, string (не пустая), resource
     * <br>
     *
     * Пример:
     * 'Название_ключа_для_проверки' => 'required'
     * ['test' => 'required']
     *
     * @return bool
     */
    public function validate()
    {
        $isValidate = (
                is_scalar($this->value)
                && iconv_strlen($this->value)
            )
            || is_bool($this->value)
            || (is_array($this->value) && !empty($this->value))
            || is_object($this->value)
            || is_resource($this->value);

        $this->codeResult = $isValidate ? Constant::IS_REQUIRED : Constant::NOT_REQUIRED;
        return $isValidate;
    }
}