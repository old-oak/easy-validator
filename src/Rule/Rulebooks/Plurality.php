<?php

namespace OldOak\EasyValidator\Rule\Rulebooks;


use OldOak\EasyValidator\Common\Constant;
use OldOak\EasyValidator\Rule\AbstractRulebook;

/**
 * Class Plurality
 * @package OldOak\EasyValidator\Rules\Rulebooks
 */
class Plurality extends AbstractRulebook
{

    /**
     * Метод проверяет, является ли значение <b>$this->value</b> массивом или объектом, реализующем интерфейс <b>ArrayAccess</b> <br>
     * Данные проходящие валидацию: array, object implements ArrayAccess
     * <br>
     *
     * Пример:
     * 'Название_ключа_для_проверки' => 'plurality'
     * ['test' => 'plurality']
     *
     * @return bool
     */
    public function validate()
    {
        $isValidate = is_array($this->value);
        if(!$isValidate && is_object($this->value)) {
            $interfaces = class_implements($this->value);
            $isValidate = $interfaces && in_array('ArrayAccess', $interfaces, true);
        }
        $this->codeResult = $isValidate ? Constant::IS_PLURALITY : Constant::NOT_PLURALITY;
        return $isValidate;
    }
}