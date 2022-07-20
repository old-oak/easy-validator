<?php

namespace OldOak\EasyValidator\Common;


/**
 * Class Constant
 * @package OldOak\EasyValidator\Common
 */
class Constant
{
    const FATAL = 100;
    const METHOD_NOT_FOUND = 200;
    const TRANSLATE_CLASS_NOT_FOUND = 300;
    const BAD_VALUE = 400;
    const FAIL_ADD_CUSTOM_RULE = 401;
    const NOTICE_NULLABLE = 402;
    const SUCCESS_RULE_VALIDATE = 403;
    const VALIDATOR_LOG_MAKE = 404;
    const VALIDATOR_LOG_RESULT = 405;
    const BAD_RULE_NAME = 406;
    const BAD_MESSAGE = 407;
    const BAD_FIELD_NAME = 408;

    const NOT_DIGIT = 500;
    const IS_DIGIT = 501;

    const NOT_NULLABLE = 510;
    const IS_NULLABLE = 511;

    const NOT_REQUIRED = 520;
    const IS_REQUIRED = 521;

    const NOT_DATA = 530;
    const IS_DATA = 531;

    const NOT_ONLY_LETTERS = 540;
    const IS_ONLY_LETTERS = 541;

    const NOT_URL = 550;
    const IS_URL = 551;

    const NOT_CHAR_MAX = 560;
    const IS_CHAR_MAX = 561;

    const NOT_CHAR_MIN = 570;
    const IS_CHAR_MIN = 571;

    const NOT_CHAR = 580;
    const IS_CHAR = 581;

    const NOT_BOOLEAN = 590;
    const IS_BOOLEAN = 591;

    const NOT_REGEXP = 600;
    const IS_REGEXP = 601;

    const NOT_PHONE = 610;
    const IS_PHONE = 611;

    const NOT_CHOICE = 620;
    const IS_CHOICE = 621;

    const NOT_EMAIL = 630;
    const IS_EMAIL = 631;

    const NOT_FLOAT = 640;
    const IS_FLOAT = 641;

    const NOT_MAX = 650;
    const IS_MAX = 651;

    const NOT_MIN = 660;
    const IS_MIN = 661;

    const NOT_PLURALITY = 670;
    const IS_PLURALITY = 671;

    const NOT_STRING = 680;
    const IS_STRING = 681;

    const NOT_NUMERIC = 690;
    const IS_NUMERIC = 691;

    const NOT_FILE = 700;
    const IS_FILE = 701;

    const NOT_OBJECT = 710;
    const IS_OBJECT = 711;

    /**
     * @var array $validatorMatchCodes
     */
    public static $validatorMatchCodes = [
        self::FATAL => 'error.validator.fatal',
        self::METHOD_NOT_FOUND => 'error.validator.method_not_found',
        self::TRANSLATE_CLASS_NOT_FOUND => 'error.validator.translate_not_found',
        self::BAD_VALUE => 'error.validator.bad_value',
        self::BAD_RULE_NAME => 'error.validator.bad_rule_name',
        self::BAD_MESSAGE => 'error.validator.bad_message',
        self::BAD_FIELD_NAME => 'error.validator.bad_field_name',

        self::NOT_DIGIT => 'validate.digit.fail',
        self::IS_DIGIT => 'validate.digit.success',

        self::NOT_NULLABLE => 'validate.nullable.fail',
        self::IS_NULLABLE => 'validate.nullable.success',

        self::NOT_REQUIRED => 'validate.required.fail',
        self::IS_REQUIRED => 'validate.required.success',

        self::NOT_DATA => 'validate.data.fail',
        self::IS_DATA => 'validate.data.success',

        self::NOT_ONLY_LETTERS => 'validate.only_letters.success',
        self::IS_ONLY_LETTERS => 'validate.only_letters.fail',

        self::NOT_URL => 'validate.url.success',
        self::IS_URL => 'validate.url.fail',

        self::NOT_CHAR_MAX => 'validate.char_max.success',
        self::IS_CHAR_MAX => 'validate.char_max.fail',

        self::NOT_CHAR_MIN => 'validate.char_min.success',
        self::IS_CHAR_MIN => 'validate.char_min.fail',

        self::NOT_CHAR => 'validate.char.success',
        self::IS_CHAR => 'validate.char.fail',

        self::NOT_BOOLEAN => 'validate.boolean.success',
        self::IS_BOOLEAN => 'validate.boolean.fail',

        self::NOT_REGEXP => 'validate.regexp.success',
        self::IS_REGEXP => 'validate.regexp.fail',

        self::NOT_PHONE => 'validate.phone.success',
        self::IS_PHONE => 'validate.phone.fail',

        self::NOT_CHOICE => 'validate.choice.success',
        self::IS_CHOICE => 'validate.choice.fail',

        self::NOT_EMAIL => 'validate.email.success',
        self::IS_EMAIL => 'validate.email.fail',

        self::NOT_FLOAT => 'validate.float.success',
        self::IS_FLOAT => 'validate.float.fail',

        self::NOT_MAX => 'validate.max.success',
        self::IS_MAX => 'validate.max.fail',

        self::NOT_MIN => 'validate.min.success',
        self::IS_MIN => 'validate.min.fail',

        self::NOT_PLURALITY => 'validate.plurality.success',
        self::IS_PLURALITY => 'validate.plurality.fail',

        self::NOT_STRING => 'validate.string.success',
        self::IS_STRING => 'validate.string.fail',

        self::NOT_NUMERIC => 'validate.numeric.success',
        self::IS_NUMERIC => 'validate.numeric.fail',

        self::NOT_FILE => 'validate.file.success',
        self::IS_FILE => 'validate.file.fail',

        self::NOT_OBJECT => 'validate.object.success',
        self::IS_OBJECT => 'validate.object.fail',
    ];
}