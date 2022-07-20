<?php

namespace OldOak\EasyValidator\Rule\Rulebooks;


use OldOak\EasyValidator\Common\Constant;
use OldOak\EasyValidator\Rule\AbstractRulebook;

/**
 * Class CharMax
 * @package OldOak\EasyValidator\Rules\Rulebooks
 */
class CharMax extends AbstractRulebook
{

    /**
     * Метод проверяет, является ли значение <b>$this->value</b> строкой с определенным кол-вом символов, которое <= <b>$this->comparison_value</b><br>
     * Данные проходящие валидацию: <b>$this->value</b> - типы данных, которые возможно конвертировать в строку; <b>$this->comparison_value</b> - типы данных, которые можно конвертировать в число
     * Кол-во символов <b>$this->value</b> <= <b>$this->comparison_value</b>
     * <br>
     *
     * Пример:
     * 'Название_ключа_для_проверки' => 'char:количество_символов'
     * ['test' => 'charMax:5']
     *
     * @return bool
     */
    public function validate()
    {
        $isValidate = !is_object($this->value)
            && !is_object($this->comparison_value)
            && !is_callable($this->value)
            && !is_array($this->value)
            && mb_strlen((string)$this->value) <= (int)$this->comparison_value;
        $this->codeResult = $isValidate ? Constant::IS_CHAR_MAX : Constant::NOT_CHAR_MAX;
        return $isValidate;
    }
}