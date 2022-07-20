<?php

namespace OldOak\EasyValidator\Rule\Rulebooks;


use OldOak\EasyValidator\Common\Constant;
use OldOak\EasyValidator\Rule\AbstractRulebook;

/**
 * Class Plurality
 * @package OldOak\EasyValidator\Rules\Rulebooks
 */
class Object extends AbstractRulebook
{

    /**
     * Метод проверяет, является ли значение <b>$this->value</b> объектом <br>
     * Данные проходящие валидацию: object
     * <br>
     *
     * Пример:
     * 'Название_ключа_для_проверки' => 'object'
     * ['test' => 'object']
     *
     * @return bool
     */
    public function validate()
    {
        $isValidate = is_object($this->value);
        $this->codeResult = $isValidate ? Constant::IS_OBJECT : Constant::NOT_OBJECT;
        return $isValidate;
    }
}