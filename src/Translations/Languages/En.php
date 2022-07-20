<?php

namespace OldOak\EasyValidator\Translations\Languages;


use OldOak\EasyValidator\Common\Constant;
use OldOak\EasyValidator\Translations\AbstractTranslation;

/**
 * Class En
 * @package OldOak\EasyValidator\Translations\Languages
 */
class En extends AbstractTranslation
{
    protected static $messages = [
        Constant::FATAL => 'Critical validator error.',
        Constant::METHOD_NOT_FOUND => 'Validation method %s not found, change it to a valid one.',
        Constant::TRANSLATE_CLASS_NOT_FOUND => 'Language class %s not found.',
        Constant::BAD_VALUE => 'Validator error. Invalid parameters to validate values.',
        Constant::FAIL_ADD_CUSTOM_RULE => 'Error adding a custom rule. Make sure the name rule is a string and your rule class extend from AbstractRulebooks::class.',
        Constant::NOTICE_NULLABLE => 'The field is allowed as null, but validation was done according to the rules - %s.',
        Constant::SUCCESS_RULE_VALIDATE => 'The field is allowed as empty, but the validation was done according to the rules - %s.',
        Constant::VALIDATOR_LOG_MAKE => 'Run validator. Fields with rules - %s. The values ​​to check are %s.',
        Constant::VALIDATOR_LOG_RESULT => 'The result of the validator. Success - %s. The error is %s. Warning - %s.',
        Constant::BAD_RULE_NAME => 'The name of the rule must be a string.',
        Constant::BAD_MESSAGE => 'The message must be a string or an array.',
        Constant::BAD_FIELD_NAME => 'The field name must be a string.',

        Constant::NOT_DIGIT => ':attribute must be a large number.',
        Constant::IS_DIGIT=> ':attribute is an incremented number.',

        Constant::NOT_REQUIRED => ':attribute must be required.',
        Constant::IS_REQUIRED => ':attribute is required.',

        Constant::NOT_DATA => ':attribute must be a date.',
        Constant::IS_DATA => ':attribute is a date.',

        Constant::NOT_ONLY_LETTERS => ':attribute must be a letter-only string.',
        Constant::IS_ONLY_LETTERS => ':attribute is a string with only letters.',

        Constant::NOT_URL => ':attribute must be url',
        Constant::IS_URL => ':attribute is url',

        Constant::NOT_CHAR_MAX => ':attribute number of characters must be no more than :value',
        Constant::IS_CHAR_MAX => ':attribute character count does not exceed :value',

        Constant::NOT_CHAR_MIN => ':attribute number of characters must be at least :value',
        Constant::IS_CHAR_MIN => ':attribute char count greater than :value',

        Constant::NOT_CHAR => ':attribute does not match the number of characters',
        Constant::IS_CHAR => ':attribute matches number of characters',

        Constant::NOT_BOOLEAN => ':attribute must be bound',
        Constant::IS_BOOLEAN => ':attribute boolean',

        Constant::NOT_REGEXP => ':attribute does not match expression',
        Constant::IS_REGEXP => ':attribute matches expression',

        Constant::NOT_PHONE => ':attribute must be a phone number',
        Constant::IS_PHONE => ':attribute is a phone number',

        Constant::NOT_CHOICE => ':attribute must be equal to choice',
        Constant::IS_CHOICE => ':attribute equals choice',

        Constant::NOT_EMAIL => ':attribute must be an email address',
        Constant::IS_EMAIL => ':attribute is an email address',

        Constant::NOT_FLOAT => ':attribute must be a number with a fraction',
        Constant::IS_FLOAT => ':attribute is a number with a fractional part',

        Constant::NOT_MAX => ':attribute must be no greater than :value',
        Constant::IS_MAX => ':attribute is less than :value',

        Constant::NOT_MIN => ':attribute must be at least :value',
        Constant::IS_MIN => ':attribute is greater than :value',

        Constant::NOT_PLURALITY => ':attribute must be an array',
        Constant::IS_PLURALITY => ':attribute is an array',

        Constant::NOT_STRING => ':attribute must be a string',
        Constant::IS_STRING => ':attribute is a string',

        Constant::NOT_NUMERIC => ':attribute must be number',
        Constant::IS_NUMERIC => ':attribute is number',

        Constant::NOT_FILE => ':attribute must be a file',
        Constant::IS_FILE => ':attribute is a Vile',
    ];
}
