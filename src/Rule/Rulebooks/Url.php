<?php

namespace OldOak\EasyValidator\Rule\Rulebooks;


use OldOak\EasyValidator\Common\Constant;
use OldOak\EasyValidator\Rule\AbstractRulebook;

/**
 * Class Url
 * @package OldOak\EasyValidator\Rules\Rulebooks
 */
class Url extends AbstractRulebook
{

    /**
     * Метод проверяет, является ли значение <b>$this->value</b> url (простая проверка) <br>
     * Если было передано значение для сравнения в <b>$this->comparison_value</b>, то произойдет строгое сравнение <br>
     * Данные проходящие валидацию: string (валидный url), object (у которого есть метод __toString)
     * <br>
     *
     * Пример:
     * 'Название_ключа_для_проверки' => 'url'
     * ['test' => 'url', 'test1' => 'url:google.com']
     *
     * @return bool
     */
    public function validate()
    {
        if(!is_string($this->value) || (is_object($this->value) && !method_exists($this->value, '__toString'))) {
            $this->codeResult = Constant::NOT_URL;
            return false;
        }

        $firstCheck = (bool)preg_match('/^(((http|https):\/\/(www\.|))|www\.|)([a-zA-Zёа-яЁА-Я-0-9_\.~]+)\.([a-zA-Zёа-яЁА-Я]+)([a-zA-Z\/ЁА-Яёа-я]+|)/iu', $this->value, $matches);
        if ($this->comparison_value === null) {
            $this->codeResult = $firstCheck ? Constant::IS_URL : Constant::NOT_URL;
            return $firstCheck;
        }

        $isValidate = $firstCheck && $this->value === $this->comparison_value;
        $this->codeResult = $isValidate ? Constant::IS_URL : Constant::NOT_URL;
        return $isValidate;
    }
}