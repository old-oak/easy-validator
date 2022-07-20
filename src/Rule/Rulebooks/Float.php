<?php

namespace OldOak\EasyValidator\Rule\Rulebooks;


use OldOak\EasyValidator\Common\Constant;
use OldOak\EasyValidator\Common\Helper;
use OldOak\EasyValidator\Rule\AbstractRulebook;

/**
 * Class Float
 * @package OldOak\EasyValidator\Rules\Rulebooks
 */
class Float extends AbstractRulebook
{
    private $separators = ['.', ','];

    /**
     * Метод проверяет, является ли значение <b>$this->value</b> числом с плавающей запятой <br>
     * Данные проходящие валидацию: float (с разделителями "."(Точка) или "," (Запятая), string (но если это строка только с числами и/или разделителя)
     * <br>
     *
     * Пример:
     * 'Название_ключа_для_проверки' => 'float'
     * ['test_char' => 'float']
     *
     * @return bool
     */
    public function validate()
    {
        $isValidate = false;
        do {

            if(is_float($this->value)) {
                $isValidate = true;
                break;
            }

            if (!is_string($this->value)) {
                break;
            }

            $this->value = str_replace($this->separators, '.', $this->value);
            if (substr_count($this->value, '.') > 1) {
                break;
            }

            $secondCheck = (float)$this->value;
            $isFloat = is_float($secondCheck) && is_numeric($this->value) ? $secondCheck : false;
            if ($isFloat) {
                $isValidate = true;
                break;
            }

            if (!is_numeric($this->value) || (is_bool($isFloat) && !$isFloat)) {
                break;
            }

            $isValidate = true;

            break;
        } while(true);

        $this->codeResult = $isValidate ? Constant::IS_FLOAT : Constant::NOT_FLOAT;
        return $isValidate;
    }
}