<?php

namespace OldOak\EasyValidator\Rule;


/**
 * Class AbstractRule
 * @package EasyValidator\Rules
 */
abstract class AbstractRulebook
{
    /**
     * Значение, которое будет проверятся на валидность
     * @var mixed $value
     */
    public $value;

    /**
     * Значение, с которым может быть произведено сравнение с $this->value
     * @var null $comparison_value
     */
    public $comparison_value;

    /**
     * Код результата проверки
     * @var int|string $codeResult
     */
    public $codeResult;

    /**
     * AbstractRule constructor.
     * @param mixed $value Значение, которое будет проверятся на валидность
     * @param null|mixed $comparison_value Значение, с которым может быть произведено сравнение с $value
     */
    public function __construct($value, $comparison_value = null)
    {
        $this->value = $value;
        $this->comparison_value = $comparison_value;
    }

    /**
     * Метод проверки
     * @return bool
     */
    abstract public function validate();
}