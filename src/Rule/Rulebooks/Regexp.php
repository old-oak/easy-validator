<?php

namespace OldOak\EasyValidator\Rule\Rulebooks;


use OldOak\EasyValidator\Common\Constant;
use OldOak\EasyValidator\Rule\AbstractRulebook;

/**
 * Class Regexp
 * @package OldOak\EasyValidator\Rules\Rulebooks
 */
class Regexp extends AbstractRulebook
{

    /**
     * Метод проверяет, является ли значение <b>$this->value</b> соответствующем шаблону <b>$this->comparison_value</b> <br>
     * Данные проходящие валидацию: string (которое соответствует шаблону)
     * <br>
     *
     * Пример:
     * 'Название_ключа_для_проверки' => 'regexp:шаблон_регулярного_вырачения'
     * ['test' => 'regexp:/^a-zA-Z$/']
     *
     * @return bool
     */
    public function validate()
    {
        if(!is_string($this->comparison_value) || !(is_string($this->value) || is_numeric($this->value))) {
            $this->codeResult = Constant::NOT_REGEXP;
            return false;
        }

        $isValidate = preg_match($this->comparison_value, $this->value);
        $this->codeResult = $isValidate ? Constant::IS_REGEXP : Constant::NOT_REGEXP;
        return $isValidate;
    }
}