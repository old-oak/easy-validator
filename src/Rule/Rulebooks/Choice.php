<?php

namespace OldOak\EasyValidator\Rule\Rulebooks;


use OldOak\EasyValidator\Common\Constant;
use OldOak\EasyValidator\Rule\AbstractRulebook;

/**
 * Class Choice
 * @package OldOak\EasyValidator\Rules\Rulebooks
 */
class Choice extends AbstractRulebook
{

    /**
     * Метод проверяет, является ли значение <b>$this->value</b> строго равно значению из строки с разделителями <b>$this->comparison_value</b>
     * Метод для выборки из двух или более значений с учетом регистра<br>
     * Данные проходящие валидацию: <b>$this->value</b> - типы данных, которые возможно конвертировать в строку; <b>$this->comparison_value</b> - типы данных, которые можно конвертировать в строку
     * одно значение из списка <b>$this->comparison_value</b> должно быть строго равно <b>$this->value</b>
     * Начало диапазона проверки должно начинаться с "[" и заканчиваться "]", допустимые разделители между значениями: | (прямая черта)
     * Если в <b>$this->comparison_value</b> есть false или true, то они будут конвертироваться в тип данных bool,
     * могут быть так-же тип данных int, float, string(с числами)
     * <br>
     *
     * Пример:
     * 'Название_ключа_для_проверки' => 'choice:[первое_значение|второе_значение]';
     * ['test' => 'choice:[test|123]'
     *
     * @return bool
     */
    public function validate()
    {
        if ($this->value === null) {
            $this->value = 'NULL';
        }

        if (is_bool($this->value)) {
            $this->value = $this->value === false ? 'false' : 'true';
        }

        $isValidate = true;

        if (!is_string($this->comparison_value) || !(is_numeric($this->value) || is_string($this->value))) {
            $isValidate = false;
        } else {
            $firstAllowed = '[';
            $lastAllowed = ']';

            $this->comparison_value = trim($this->comparison_value);

            $first = $this->comparison_value[0];
            $last = mb_substr($this->comparison_value, -1);


            if (($first === false || $first !== $firstAllowed) || ($last === false || $last !== $lastAllowed)) {
                $isValidate = false;
            } else {
                $this->comparison_value = mb_substr($this->comparison_value, 1, -1);

                $matchesValue = preg_split("/[\|]{1}/", $this->comparison_value);

                if (!is_array($matchesValue) || count($matchesValue) < 1) {
                    $isValidate = false;
                } else if (!in_array($this->value, $matchesValue, true)) {
                    $isValidate = false;
                }
            }
        }

        $this->codeResult = $isValidate ? Constant::IS_CHOICE : Constant::NOT_CHOICE;
        return $isValidate;
    }
}