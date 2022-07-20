<?php

namespace OldOak\EasyValidator\Translations\Languages;


use OldOak\EasyValidator\Common\Constant;
use OldOak\EasyValidator\Translations\AbstractTranslation;

/**
 * Class Ru
 * @package OldOak\EasyValidator\Translations\Languages
 */
class Ru extends AbstractTranslation
{
    protected static $messages = [
        Constant::FATAL => 'Критическая ошибка валидатора.',
        Constant::METHOD_NOT_FOUND => 'Метод валидации %s не найден измените его на допустимый.',
        Constant::TRANSLATE_CLASS_NOT_FOUND => 'Языковой класс %s не найден.',
        Constant::BAD_VALUE => 'Ошибка валидатора. Неверные параметры для проверки значений',
        Constant::FAIL_ADD_CUSTOM_RULE => 'Ошибка в добавлении уникального правила. Убедитесь, что имя правила является строкой и класс вашего правила наследуется от AbstractRulebooks.',
        Constant::NOTICE_NULLABLE => 'Поле разрешено как пустое, но проверка проводилась по правилу - %s.',
        Constant::SUCCESS_RULE_VALIDATE => 'Поле разрешено как пустое, но проверка проводилась по правилу - %s.',
        Constant::VALIDATOR_LOG_MAKE => 'Запуск валидатора. Поля с правилами - %s. Значения для проверки - %s.',
        Constant::VALIDATOR_LOG_RESULT => 'Результат работы валидатора. Успешно - %s. Ошибка - %s. Предупреждение - %s.',
        Constant::BAD_RULE_NAME => 'Название правила должно быть строкой.',
        Constant::BAD_MESSAGE => 'Сообщение должно быть строкой или массивом.',
        Constant::BAD_FIELD_NAME => 'Назваиние поля должно быть строкой.',

        Constant::NOT_DIGIT  => ':attribute должно быть целым числом.',
        Constant::IS_DIGIT=> ':attribute является целым числом.',

        Constant::NOT_REQUIRED => ':attribute должно быть обязательным.',
        Constant::IS_REQUIRED => ':attribute является обязательным.',

        Constant::NOT_DATA => ':attribute должно быть датой.',
        Constant::IS_DATA => ':attribute является датой.',

        Constant::NOT_ONLY_LETTERS => ':attribute должно быть строкой в которой только буквы.',
        Constant::IS_ONLY_LETTERS => ':attribute является строкой в которой только буквы.',

        Constant::NOT_URL => ':attribute должно быть url',
        Constant::IS_URL => ':attribute является url',

        Constant::NOT_CHAR_MAX => ':attribute кол-во символов должно быть не более :value',
        Constant::IS_CHAR_MAX => ':attribute кол-во символов не привышает :value',

        Constant::NOT_CHAR_MIN => ':attribute кол-во символов должно быть не менее :value',
        Constant::IS_CHAR_MIN => ':attribute кол-во символов больше :value',

        Constant::NOT_CHAR => ':attribute не соответствует количеству символов',
        Constant::IS_CHAR => ':attribute соответствует количеству символов',

        Constant::NOT_BOOLEAN => ':attribute должно быть логическим',
        Constant::IS_BOOLEAN => ':attribute логическое',

        Constant::NOT_REGEXP => ':attribute не соответсвует выражению',
        Constant::IS_REGEXP => ':attribute соответсвует выражению',

        Constant::NOT_PHONE => ':attribute должно быть номером телефона',
        Constant::IS_PHONE => ':attribute является номером телефона',

        Constant::NOT_CHOICE => ':attribute должно быть равно выборке',
        Constant::IS_CHOICE => ':attribute равно выборке',

        Constant::NOT_EMAIL => ':attribute должно быть адресом электронной почты',
        Constant::IS_EMAIL => ':attribute является адресом электронной почты',

        Constant::NOT_FLOAT => ':attribute должно быть числом с дробной частью',
        Constant::IS_FLOAT => ':attribute является числом с дробной частью',

        Constant::NOT_MAX => ':attribute должно быть не больше :value',
        Constant::IS_MAX => ':attribute является меньше :value',

        Constant::NOT_MIN => ':attribute должно быть не меньше :value',
        Constant::IS_MIN => ':attribute является больше чем :value',

        Constant::NOT_PLURALITY => ':attribute должно быть массивом',
        Constant::IS_PLURALITY => ':attribute является массивом',

        Constant::NOT_STRING => ':attribute должно быть строкой',
        Constant::IS_STRING => ':attribute является строкой',

        Constant::NOT_NUMERIC => ':attribute должно быть чисдлм',
        Constant::IS_NUMERIC => ':attribute является чисдлм',

        Constant::NOT_FILE => ':attribute должно быть файлом',
        Constant::IS_FILE => ':attribute является вайлом',

        Constant::NOT_OBJECT => ':attribute должно быть объектом',
        Constant::IS_OBJECT => ':attribute является объектом',
    ];
}
