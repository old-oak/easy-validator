<?php

namespace OldOak\EasyValidator\Rule;

use OldOak\EasyValidator\Rule\Rulebooks\Boolean;
use OldOak\EasyValidator\Rule\Rulebooks\Char;
use OldOak\EasyValidator\Rule\Rulebooks\CharMax;
use OldOak\EasyValidator\Rule\Rulebooks\CharMin;
use OldOak\EasyValidator\Rule\Rulebooks\Choice;
use OldOak\EasyValidator\Rule\Rulebooks\Date;
use OldOak\EasyValidator\Rule\Rulebooks\Digits;
use OldOak\EasyValidator\Rule\Rulebooks\Email;
use OldOak\EasyValidator\Rule\Rulebooks\File;
use OldOak\EasyValidator\Rule\Rulebooks\Float;
use OldOak\EasyValidator\Rule\Rulebooks\Max;
use OldOak\EasyValidator\Rule\Rulebooks\Min;
use OldOak\EasyValidator\Rule\Rulebooks\Nullable;
use OldOak\EasyValidator\Rule\Rulebooks\Numeric;
use OldOak\EasyValidator\Rule\Rulebooks\Object;
use OldOak\EasyValidator\Rule\Rulebooks\OnlyLetters;
use OldOak\EasyValidator\Rule\Rulebooks\Phone;
use OldOak\EasyValidator\Rule\Rulebooks\Plurality;
use OldOak\EasyValidator\Rule\Rulebooks\Regexp;
use OldOak\EasyValidator\Rule\Rulebooks\Required;
use OldOak\EasyValidator\Rule\Rulebooks\String;
use OldOak\EasyValidator\Rule\Rulebooks\Url;

/**
 * Class DefaultRule
 * В классе хранятся все правила, которые поставляются с библиотекой. Добавленные программно правила тут отсутствуют
 * @package OldOak\EasyValidator\Rules
 */
final class DefaultRulebooks
{
    const BOOLEAN = Boolean::class;
    const CHAR = Char::class;
    const CHAR_MAX = CharMax::class;
    const CHAR_MIN = CharMin::class;
    const CHOICE = Choice::class;
    const DATE = Date::class;
    const DIGITS = Digits::class;
    const EMAIL = Email::class;
    const FILE = File::class;
    const FLOAT = Float::class;
    const MAX = Max::class;
    const MIN = Min::class;
    const NULLABLE = Nullable::class;
    const NUMERIC = Numeric::class;
    const OBJECT = Object::class;
    const ONLY_LETTERS = OnlyLetters::class;
    const PHONE = Phone::class;
    const PLURALITY = Plurality::class;
    const REGEXP = Regexp::class;
    const REQUIRED = Required::class;
    const STRING = String::class;
    const URL = Url::class;

    /**
     * Получаем массив правил где ключ - это название правила в camelCase значение - это класс, который обрабатывает правило
     * @return array
     */
    public static function getRules()
    {
        return [
            'boolean' => self::BOOLEAN,
            'char' => self::CHAR,
            'charMax' => self::CHAR_MAX,
            'charMin' => self::CHAR_MIN,
            'choice' => self::CHOICE,
            'date' => self::DATE,
            'digits' => self::DIGITS,
            'email' => self::EMAIL,
            'file' => self::FILE,
            'float' => self::FLOAT,
            'max' => self::MAX,
            'min' => self::MIN,
            'nullable' => self::NULLABLE,
            'numeric' => self::NUMERIC,
            'object' => self::OBJECT,
            'onlyLetters' => self::ONLY_LETTERS,
            'phone' => self::PHONE,
            'plurality' => self::PLURALITY,
            'regexp' => self::REGEXP,
            'required' => self::REQUIRED,
            'string' => self::STRING,
            'url' => self::URL,
        ];
    }
}