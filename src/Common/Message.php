<?php

namespace OldOak\EasyValidator\Common;


use OldOak\EasyValidator\Rule\AbstractRulebook;
use OldOak\EasyValidator\Rule\Rule;
use OldOak\EasyValidator\Translations\AbstractTranslation;
use OldOak\EasyValidator\Validator;

/**
 * Class Message сообщения о результатах проверки правила с учетом языка
 * @package OldOak\EasyValidator\Common
 */
class Message implements \Iterator, \Serializable, \JsonSerializable
{
    /**
     * Сообщение или массив сообщений, которые могут быть использованы
     * @var array|string $message
     */
    public $message;

    /**
     * Message constructor.
     * @param array|string $message
     * @throws ValidatorException
     */
    public function __construct($message)
    {
        if(!$message === null && !is_string($message) && !is_array($message)) {
            $lang = AbstractTranslation::getLangClass();
            throw new ValidatorException($lang::geTranslateMessage(Constant::BAD_MESSAGE));
        }

        $this->message = $message;
    }

    /**
     * Получение сообщения по полю и правилу
     * Для начала, будет поиск сообщения по правилу, например: test_field.digits,
     * если не удалось найти такое сообщение, то поиск только по полю $field
     *
     * @param string $field Имя поля
     * @param null|Rule $rule Правило
     *
     * @return array|null
     */
    public function getMessage($field, Rule $rule = null)
    {
        if($rule !== null) {
            $keySingleRule = $this->getSingleMessageKey($field, $rule);
            if ($keySingleRule && Helper::arrayCheck($this->message, $keySingleRule)) {
                return [$keySingleRule => $this->message[$keySingleRule]];
            }
        }

        if (Helper::arrayCheck($this->message, $field)) {
            return [$field => $this->message[$field]];
        }

        return null;
    }

    /**
     * Получение ключа для поиска сообщения по правилу $rule
     *
     * @param string $field Имя поля
     * @param Rule $rule Правило
     *
     * @return string
     */
    public function getSingleMessageKey($field, Rule $rule)
    {
        return $field . $this->getSeparatorSingleRule() . $rule->name;
    }

    /**
     * Получаем разделитель для сообщения из конфига
     * @return mixed|null
     */
    public function getSeparatorSingleRule()
    {
        return Config::getConfigByCode(Config::SEPARATOR_CUSTOM_MESSAGE_SYSTEM_CODE);
    }

    /**
     * Получение сообщения по умолчанию, с учетом языка
     *
     * @param string $field Имя поля
     * @param AbstractTranslation $langClass
     * @param AbstractRulebook $abstractRule
     *
     * @return mixed
     */
    public function getDefaultMessage($field, $abstractRule, $langClass)
    {
        return [$field => str_ireplace(':attribute', $field, $langClass::geTranslateMessage($abstractRule->codeResult))];
    }

    /**
     * Return the current element
     * @link https://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     * @since 5.0.0
     */
    public function current()
    {
        return current($this->message);
    }

    /**
     * Move forward to next element
     * @link https://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function next()
    {
        next($this->message);
    }

    /**
     * Return the key of the current element
     * @link https://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     * @since 5.0.0
     */
    public function key()
    {
        return key($this->message);
    }

    /**
     * Checks if current position is valid
     * @link https://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     * @since 5.0.0
     */
    public function valid()
    {
        return key($this->message) !== null;
    }

    /**
     * Rewind the Iterator to the first element
     * @link https://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function rewind()
    {
        reset($this->message);
    }

    /**
     * String representation of object
     * @link https://php.net/manual/en/serializable.serialize.php
     * @return string the string representation of the object or null
     * @since 5.1.0
     */
    public function serialize()
    {
        return serialize($this->message);
    }

    /**
     * Constructs the object
     * @link https://php.net/manual/en/serializable.unserialize.php
     * @param string $serialized <p>
     * The string representation of the object.
     * </p>
     * @return void
     * @since 5.1.0
     */
    public function unserialize($serialized)
    {
        $this->message = unserialize($serialized);
    }

    /**
     * Specify data which should be serialized to JSON
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return $this->message;
    }

    public function __toString()
    {
        return implode(' ', $this->message);
    }
}