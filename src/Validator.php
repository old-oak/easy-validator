<?php

namespace OldOak\EasyValidator;

use function OldOak\EasyValidator\Common\array_first;
use OldOak\EasyValidator\Common\Config;
use OldOak\EasyValidator\Common\Constant;
use OldOak\EasyValidator\Common\Helper;
use OldOak\EasyValidator\Common\Message;
use OldOak\EasyValidator\Common\ValidatorException;
use OldOak\EasyValidator\Rule\Rule;
use OldOak\EasyValidator\Rule\RuleFactory;
use OldOak\EasyValidator\Translations\AbstractTranslation;

/**
 * Class Validator
 * @package OldOak\EasyValidator
 * @method static isRequired($value) Метод проверяет на заполненость поле, объекты являются не валидируемые. Данные проходящие валидацию: array, NULL, int, float, bool, string, resource,
 * @method static isNullable($value) Пропускаем значение, т.к. оно может быть пустое.
 * @method static isDigits($value, $comparison_value) Метод проверяет, является ли значение в <b>$value</b> целым числом Данные проходящие валидацию: int, string(но только, если вней все символы являются числами [0-9])
 * @method static isMin($value, $comparison_value) Метод проверяет, является ли значение <b>$value</b> числом, которое меньше чем <b>$comparison_value</b> если да, то вернет <b>FALSE</b>. Данные проходящие валидацию: string(если в этой строке есть числа), int, float
 * @method static isMax($value, $comparison_value) Метод проверяет, является ли значение <b>$value</b> числом, которое больше чем <b>$comparison_value</b> если да, то вернет <b>FALSE</b>. Данные проходящие валидацию: string(если в этой строке есть числа), int, float
 * @method static isChar($value, $comparison_value) Метод проверяет, является ли значение <b>$value</b> строкой с определенным кол-вом символов <b>$comparison_value</b><br> Данные проходящие валидацию: <b>$value</b> - типы данных, которые возможно конвертировать в строку; <b>$comparison_value</b> - типы данных, которые можно конвертировать в число Кол-во символов <b>$value</b> = <b>$comparison_value</b> <br>Пример: 'Название_ключа_для_проверки' => 'char:количество_символов'; ['test' => 'char:5']
 * @method static isCharMax($value, $comparison_value) Метод проверяет, является ли значение <b>$value</b> строкой с определенным кол-вом символов, которое <= <b>$comparison_value</b><br> Данные проходящие валидацию: <b>$value</b> - типы данных, которые возможно конвертировать в строку; <b>$comparison_value</b> - типы данных, которые можно конвертировать в число Кол-во символов <b>$value</b> <= <b>$comparison_value</b> <br> Пример: 'Название_ключа_для_проверки' => 'char:количество_символов' ['test' => 'charMax:5']
 * @method static isCharMin($value, $comparison_value) Метод проверяет, является ли значение <b>$value</b> строкой с определенным кол-вом символов, которое >= <b>$comparison_value</b><br> Данные проходящие валидацию: <b>$value</b> - типы данных, которые возможно конвертировать в строку; <b>$comparison_value</b> - типы данных, которые можно конвертировать в число Кол-во символов <b>$value</b> >= <b>$comparison_value</b> <br> Пример: 'Название_ключа_для_проверки' => 'char:количество_символов' ['test' => 'charMin:5']
 * @method static isPhone($value, $comparison_value) Метод проверяет, является ли значение <b>$value</b> номером телефона<br> Пример:<br> ['Название_ключа_для_проверки' => 'phone:[перечисление кодов городов, которые доступны для валидации через |(прямая черта)]']<br> ['user_phone' => 'phone:[rus|ukr]'
 * @method static isRegexp($value, $comparison_value) Метод для проверки по регулярному выражению, которое было вписано после двоеточия. Можно передавать как одно значение, например: name => 'regexp:/^a-zA-Z$/', тогда будет проверка проходить только 1 раз<br>
 * @method static isUrl($value) Метод проверяет, является ли значение <b>$value</b> url
 * @method static isNumeric($value, $comparison_value) Метод проверяет, является ли значение <b>$value</b> числом или строкой с числом (но без букв). Данные проходящие валидацию: string(если в этой строке есть только числа типа float), int, float
 * @method static isObject($value) Метод проверяет, является ли значение <b>$value</b> объектом <br> Данные проходящие валидацию: object <br> Пример: 'Название_ключа_для_проверки' => 'object' ['test' => 'object']
 * @method static isFloat($value) Метод проверяет, является ли значение <b>$value</b> числом с плавающей запятой Данные проходящие валидацию: float (с разделителями "."(Точка) или "," (Запятая), string (но если это строка только с числами и/или разделителя)
 * @method static isString($value) Метод проверяет, является ли значение <b>$value</b> строкой
 * @method static isOnlyLetters($value) Метод проверяет, является ли значение <b>$value</b> строкой без цифр
 * @method static isEmail($value) Метод проверяет, является ли значение <b>$value</b> электронной почтой
 * @method static isDate($value) Метод проверяет, является ли значение <b>$value</b> датой Данные проходящие валидацию: string (формата, который распознает \DateTime @see \DateTime), Экземпляр \DateTime
 * @method static isPlurality($value) Проверка, является ли значение <b>$value</b> массивом
 * @method static isBoolean($value) Метод проверяет, является ли значение <b>$value</b> логическим <br> Данные проходящие валидацию: true, false, 0, 1 <br> Пример: 'Название_ключа_для_проверки' => 'boolean'; ['test' => 'boolean']
 * @method static isChoice($value, $comparison_value) Метод проверяет, является ли значение <b>$value</b> строго равно значению из строки с разделителями <b>$value</b> Метод для выборки из двух или более значений С УЧЕТОМ РЕГИСТРА<br> Начало диапазона проверки должно начинаться с "[" и заканчиваться "]", допустимые разделители между значениями: | (прямая черта)
 * @method static isFile($value, $comparison_value) Метод проверяет, является ли значение <b>$value</b> файлом, может передаваться как resource так и путь к файлу
 */
class Validator
{

    /**
     * Поля для проверки с правилами
     * @var mixed $fields
     */
    protected $fields;

    /**
     * Значения для проверки
     * @var mixed $values
     */
    protected $values;

    /**
     * Класс сообщений
     * @var Message $messages
     */
    protected $messages;

    /**
     * Класс результата проверки
     * @var Result $result
     */
    public $result;

    /**
     * Класс переводов
     * @var AbstractTranslation|null $lang
     */
    protected $lang;

    /**
     * Класс логирования
     * @var null|object $logger
     */
    protected $logger;

    /**
     * Конструктор валидатора
     * Установить в доступные для видимости правила, которые будут использоваться для текущей валидации,
     * сообщения, с помощью которых можно поменять оповещения валидатора, если они были указаны и
     * значения, на которые будут проверяться правила
     *
     * @param array $fields Поля со сводом(ами) правил. Пример:<br>
     * test => ['required','digits', 'max:4']
     * В примере будет проверяно, указан ли ключ в массиве для проверки (required), значение является целым числом,
     * либо строкой с целом числом (digits) и максимальное значение может быть 4.
     * Ключ, должен совпадать с ключем для проверки в <b>$value</b>
     *
     * @param array $values Массив типа ключ => значение, в котором ключ должен совпадать с ключем,
     * указанным в <b>$rule</b>, а значение будет проверяно с помощью своду правил, или просто значение, которое нужно проверить
     *
     * @param null|string|array $messages Сообщение или массив сообщений типа ключ => значение, в котором ключ является полем,
     * к которому относиться сообщение и варианту проверки (через точку), а значение является текстом, которое валидатор отправит обратно
     * Пример:
     * <ul>
     * <li>'test.required' => 'Номер автомобиля должен быть обязательным',</li>
     * <li>'test.digits' => 'Номер автомобиля должен быть числом',</li>
     * </ul>
     * @throws Common\ValidatorException
     */
    public function __construct(array $fields, array $values, $messages = null)
    {
        $this->fields = $fields;
        $this->values = $values;
        $this->messages = new Message($messages);
        $this->result = new Result();

        if(Config::getConfigByCode(Config::HAS_LOG_SYSTEM_CODE)
            && !empty(Config::getConfigByCode(Config::LOG_CLASS_SYSTEM_CODE))) {
            $this->logger = Config::getConfigByCode(Config::LOG_CLASS_SYSTEM_CODE);
        }
        $this->lang = AbstractTranslation::getLangClass();
    }

    /**
     * Синоним конструктора
     * Установить в доступные для видимости правила, которые будут использоваться для текущей валидации,
     * сообщения, с помощью которых можно поменять оповещения валидатора, если они были указаны и
     * значения, на которые будут проверяться правила
     *
     * @param array $fields Поля со сводом(ами) правил. Пример:<br>
     * test => ['required','digits', 'max:4']
     * В примере будет проверяно, указан ли ключ в массиве для проверки (required), значение является целым числом,
     * либо строкой с целом числом (digits) и максимальное значение может быть 4.
     * Ключ, должен совпадать с ключем для проверки в <b>$value</b>
     *
     * @param array $values Массив типа ключ => значение, в котором ключ должен совпадать с ключем,
     * указанным в <b>$rule</b>, а значение будет проверяно с помощью своду правил, или просто значение, которое нужно проверить
     *
     * @param null|string|array $messages Сообщение или массив сообщений типа ключ => значение, в котором ключ является полем,
     * к которому относиться сообщение и варианту проверки (через точку), а значение является текстом, которое валидатор отправит обратно
     * Пример:
     * <ul>
     * <li>'test.required' => 'Номер автомобиля должен быть обязательным',</li>
     * <li>'test.digits' => 'Номер автомобиля должен быть числом',</li>
     * </ul>
     *
     * @return Validator
     * @throws Common\ValidatorException
     */
    public static function make($fields, $values, $messages = null)
    {
        return new Validator($fields, $values, $messages);
    }

    /**
     * Запуск проверки правил и значений
     * @throws Common\ValidatorException
     * @return Validator
     */
    public function validate()
    {
        //Логирование запуска правил
        if($this->logger !== null) {
            $langClass = $this->lang;
            $this->logger->info(
                sprintf($langClass::geTranslateMessage(Constant::VALIDATOR_LOG_MAKE),
                    json_encode($this->fields, JSON_UNESCAPED_UNICODE),
                    json_encode($this->values, JSON_UNESCAPED_UNICODE)
                )
            );
        }

        if ($this->fields && is_array($this->fields) && count($this->fields) > 0) {
            foreach ($this->fields as $field => $rules) {
                $this->validateValue($field);
            }
        }

        //Логирование результата работы правил
        if($this->logger !== null) {
            $langClass = $this->lang;
            $this->logger->info(
                sprintf($langClass::geTranslateMessage(Constant::VALIDATOR_LOG_RESULT),
                    json_encode($this->result->success, JSON_UNESCAPED_UNICODE),
                    json_encode($this->result->errors, JSON_UNESCAPED_UNICODE),
                    json_encode($this->result->notices, JSON_UNESCAPED_UNICODE)
                )
            );
        }

        return $this;
    }

    /**
     * @param string $field Поле для проверки
     * @throws Common\ValidatorException
     */
    protected function validateValue($field)
    {
        $langClass = $this->lang;

        if(!is_string($field)) {
            throw new ValidatorException($langClass::geTranslateMessage(Constant::BAD_FIELD_NAME));
        }

        //Ищем правила валидации для этого поля
        $rules = $this->fields[$field];
        if (!empty($rules)) {

            $nullableNameRule = Config::getConfigByCode(Config::NULLABLE_RULE_SYSTEM_CODE);

            //Правила существуют и их множество
            if ($rules && is_array($rules) && count($rules) > 0) {

                //Значение, с которым будет проверяться правило
                $validateValue = null;
                if(Helper::arrayCheck($this->values, $field)) {
                    $validateValue = $this->values[$field];
                }

                //Флаг-константа для проверки поля по правилам, которые могут быть пустыми
                //Т.е. если указано, что поле может быть nullable, и значение пустое, то правила будет проверяться,
                // но не будут заканчиваться ошибкой
                $hasNullable = in_array($nullableNameRule, $rules, true);
                foreach ($rules as $rule) {

                    //Получаем объект правила
                    $objRule = new Rule($rule);

                    //Получаем объект свода правила
                    $abstractRule = RuleFactory::factory($objRule, $validateValue);
                    $isValidate = $abstractRule->validate();

                    //Текущее правило является nullable?
                    $nullableCurrentRule = $objRule->name === $nullableNameRule && $isValidate;

                    //Есть правило nullable и валидация не прошла, запишем в замечания
                    if ($hasNullable && !$isValidate) {
                        $this->result->addNotice($field, sprintf($langClass::geTranslateMessage(Constant::NOTICE_NULLABLE), $objRule->name));
                    } elseif (!$isValidate) {

                        $message = $this->messages->getMessage($field, $objRule)
                            ?: $this->messages->getDefaultMessage($field, $abstractRule, $langClass);
                        $this->result->addErrors(key($message), current($message));

                        //Заканчиваем проверку, если это необходимо
                        if (Config::getConfigByCode(Config::CONTINUE_ERROR_SYSTEM_CODE)) {
                            break;
                        }
                    } else if (!$nullableCurrentRule) {
                        $this->result->addSuccess($field, sprintf($langClass::geTranslateMessage(Constant::SUCCESS_RULE_VALIDATE), $objRule->name));
                    }
                }
            } else {
                $hasNullable = false;
                $objRule = new Rule($rules);
                $abstractRule = RuleFactory::factory($objRule, Helper::arrayCheck($this->values, $field) ? $this->values[$field] : null);
                $isValidate = $abstractRule->validate();

                $nullableCurrentRule = $objRule->name === $nullableNameRule && $isValidate;
                if ($nullableCurrentRule) {
                    $hasNullable = true;
                }

                if ($isValidate) {
                    $this->result->addSuccess($field, str_ireplace(':attribute', $field, $langClass::geTranslateMessage($abstractRule->codeResult)));
                } else if ($hasNullable) {
                    $this->result->addNotice($field, sprintf($langClass::geTranslateMessage(Constant::NOTICE_NULLABLE), $objRule->name));
                } else {
                    $message = $this->messages->getMessage($field, $objRule)
                        ?: $this->messages->getDefaultMessage($field, $abstractRule, $langClass);
                    $this->result->addErrors(key($message), current($message));
                }
            }
        }
    }

    /**
     * Перегрузка статичного вызова, для быстрой проверки
     *
     * @param string $name
     * @param array $arguments
     *
     * @return bool
     *
     * @throws Common\ValidatorException
     */
    public static function __callStatic($name, array $arguments)
    {
        if (strpos($name, 'is') === 0) {
            return self::is(substr($name, 2), array_first($arguments));
        }
    }

    /**
     * Бытрая проверка
     *
     * @param string $rule Правило, которое будет проверяться, список правил хранится тут - DefaultRulebooks
     * @param mixed $value Значение, которое будет проверяться по определенному правилу
     *
     * @return bool
     *
     * @throws Common\ValidatorException
     */
    public static function is($rule, $value)
    {
        return RuleFactory::factory(new Rule($rule), $value)->validate();
    }

    /**
     * Получение результатов проверки
     * @return Result
     */
    public function getResult()
    {
        return $this->result;
    }
}