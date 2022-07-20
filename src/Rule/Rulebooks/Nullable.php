<?php

namespace OldOak\EasyValidator\Rule\Rulebooks;


use OldOak\EasyValidator\Common\Constant;
use OldOak\EasyValidator\Rule\AbstractRulebook;

/**
 * Class Nullable
 * @package EasyValidator\Rules
 */
class Nullable extends AbstractRulebook
{
    /**
     * Пропускаем значение, т.к. оно может быть пустое
     */
    public function validate()
    {
        $isValidate = !($this->value === null || (is_string($this->value) && mb_strlen(trim($this->value)) <= 0));
        $this->codeResult = $isValidate ? Constant::IS_NULLABLE : Constant::NOT_NULLABLE;
        return $isValidate;
    }
}