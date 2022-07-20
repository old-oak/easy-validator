<?php

namespace OldOak\EasyValidator\Rule\Rulebooks;

use DateTime;
use OldOak\EasyValidator\Common\Constant;
use OldOak\EasyValidator\Rule\AbstractRulebook;

/**
 * Class Date
 * @package EasyValidator\Rules
 */
class Date extends AbstractRulebook
{

    /**
     * Метод проверяет, является ли значение <b>$this->value</b> датой <br>
     * Данные проходящие валидацию: string (формата, который распознает \DateTime @see \DateTime), Экземпляр \DateTime
     * <br>
     *
     * Пример:
     * 'Название_ключа_для_проверки' => 'date'
     * ['test' => 'date']
     *
     * @return bool
     */
    public function validate()
    {
        $isValidate = false;
        if (is_string($this->value)) {
            try {
                $isValidate = is_object(new DateTime($this->value));
            } catch (\Exception $exception) {
            }
        } elseif ((is_object($this->value)) && is_a($this->value, DateTime::class)) {
            $isValidate = true;
        }

        $this->codeResult = $isValidate ? Constant::IS_DATA : Constant::NOT_DATA;
        return $isValidate;
    }
}