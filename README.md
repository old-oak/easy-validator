# EasyValidator

Простая, независимавая библиотека для валидации данных с удобным синтаксисом и применением.

## Приемущества

 - Независиммая, нет внутренних зависимостей других библиотек.
 - Простая в использовании.
 - Просто расширяется.


## Установка

Через Composer

``` bash
$ composer require old-oak/easy-validator
```

Или просто скачав архив и добавив подключение файла автозагрузки.

```php
require_once 'autoload.php';
```

## Использование

Множественная проверка на несколько правил:

```php
use OldOak\EasyValidator\Validator;

//Поля для проверки со сводами правил
$fields = [
  'login' => ['required', 'email']
];

//Значение, для проверки
$values = [
    'login' => 'test@test.com'
];

//Сообщения об ошибках исходя из правила
$messages = [
  'login.required' => 'Введите Ваш логин',
  'login.email' => 'Ваш логин должен быть электронной почтой',
];

//Или так
$messages1 = [
  'login' => 'Логин обязателен и должен быть электронной почтой.',
];

//Получаем экземпляр валидатора
$validator = Validator::make($fields, $values, $messages);

//Валидируем данные и получаем результат валидации
$res = $validator->validate()->result;
```

Одиночная проверка

```php
use OldOak\EasyValidator\Validator;

//Проверяем, является ли данные электронной почтой
$isEmail = Validator::isEmail('test@test.com');
```

Добавление кастом правил для валидации

```php
use OldOak\EasyValidator\Rule\AbstractRulebook;
use OldOak\EasyValidator\Rule\Registration;

//Создаем класс, которые будет валидировать новое правило
class KnockRule extends AbstractRulebook {

    /**
     * Метод проверки
     * @return bool
     */
    public function validate()
    {
        return $this->value === 'knock';
    }
}

//Регистрируем правило в библиотеке
Registration::addCustomRule('knock', KnockRule::class);

//Используем проверку
$isKnock = Validator::isKnock('knock');
```

## Таблица свода правил, которые доступны по умолчанию

<table>
    <thead>
    <td>Название правила</td>
    <td>Описание</td>
    <td>Использование</td>
    </thead>
    <tbody>
        <tr>
            <td>
                <a href="https://github.com/old-oak/easy-validator/blob/master/docs/Rulebooks.md#Boolean">Boolean</a>
            </td>
            <td>
                Проверка на логический тип
            </td>
            <td>
                boolean
            </td>
        </tr>
        <tr>
            <td>
                <a href="https://github.com/old-oak/easy-validator/blob/master/docs/Rulebooks.md#Char">Char</a>
            </td>
            <td>
                Проверка строки с определенным кол-вом символов N
            </td>
            <td>
                char:5
            </td>
        </tr>
        <tr>
            <td>
                <a href="https://github.com/old-oak/easy-validator/blob/master/docs/Rulebooks.md#CharMax">CharMax</a>
            </td>
            <td>
                Проверка строки с определенным кол-вом символов, которое меньше или равно N
            </td>
            <td>
                charMax:5
            </td>
        </tr>
        <tr>
            <td>
                <a href="https://github.com/old-oak/easy-validator/blob/master/docs/Rulebooks.md#CharMin">CharMin</a>
            </td>
            <td>
                Проверка строки с определенным кол-вом символов, которое больше или равно N
            </td>
            <td>
                charMin:5
            </td>
        </tr>
        <tr>
            <td>
                <a href="https://github.com/old-oak/easy-validator/blob/master/docs/Rulebooks.md#Choice">Choice</a>
            </td>
            <td>
                Проверка наличия значение в списке
            </td>
            <td>
                choice:[test|123]
            </td>
        </tr>
        <tr>
            <td>
                <a href="https://github.com/old-oak/easy-validator/blob/master/docs/Rulebooks.md#Date">Date</a>
            </td>
            <td>
                Проверка, является ли значение датой
            </td>
            <td>
                date
            </td>
        </tr>
        <tr>
            <td>
                <a href="https://github.com/old-oak/easy-validator/blob/master/docs/Rulebooks.md#Digits">Digits</a>
            </td>
            <td>
                Проверка, является ли значение целым числом
            </td>
            <td>
                digits, digits:5
            </td>
        </tr>
        <tr>
            <td>
                <a href="https://github.com/old-oak/easy-validator/blob/master/docs/Rulebooks.md#Email">Email</a>
            </td>
            <td>
                Проверка, является ли значение электронной почтой
            </td>
            <td>
                email
            </td>
        </tr>
        <tr>
            <td>
                <a href="https://github.com/old-oak/easy-validator/blob/master/docs/Rulebooks.md#File">File</a>
            </td>
            <td>
                Проверка, является ли значение файлом и расширением
            </td>
            <td>
                file, file:jpg, file:[png|jpg]
            </td>
        </tr>
        <tr>
            <td>
                <a href="https://github.com/old-oak/easy-validator/blob/master/docs/Rulebooks.md#Float">Float</a>
            </td>
            <td>
                Проверка, является ли значение с плавающей запятой
            </td>
            <td>
                float
            </td>
        </tr>
        <tr>
            <td>
                <a href="https://github.com/old-oak/easy-validator/blob/master/docs/Rulebooks.md#Max">Max</a>
            </td>
            <td>
                Проверка, является ли значение числом, которое больше чем N
            </td>
            <td>
                max:5
            </td>
        </tr>
        <tr>
            <td>
                <a href="https://github.com/old-oak/easy-validator/blob/master/docs/Rulebooks.md#Min">Min</a>
            </td>
            <td>
                Проверка, является ли значение числом, которое меньше чем N
            </td>
            <td>
                min:5
            </td>
        </tr>
        <tr>
            <td>
                <a href="https://github.com/old-oak/easy-validator/blob/master/docs/Rulebooks.md#Nullable">Nullable</a>
            </td>
            <td>
                Пропуск пустого значения
            </td>
            <td>
                nullable
            </td>
        </tr>
        <tr>
            <td>
                <a href="https://github.com/old-oak/easy-validator/blob/master/docs/Rulebooks.md#Numeric">Numeric</a>
            </td>
            <td>
                Проверка, является ли значение числом
            </td>
            <td>
                numeric, numeric:123, numeric:3,5
            </td>
        </tr>
        <tr>
            <td>
                <a href="https://github.com/old-oak/easy-validator/blob/master/docs/Rulebooks.md#Object">Object</a>
            </td>
            <td>
                Проверка, является ли значение объектом
            </td>
            <td>
                object
            </td>
        </tr>
        <tr>
            <td>
                <a href="https://github.com/old-oak/easy-validator/blob/master/docs/Rulebooks.md#OnlyLetters">OnlyLetters</a>
            </td>
            <td>
                Проверка, является ли значение строкой только с буквами или пустой
            </td>
            <td>
                onlyLetters
            </td>
        </tr>
        <tr>
            <td>
                <a href="https://github.com/old-oak/easy-validator/blob/master/docs/Rulebooks.md#Phone">Phone</a>
            </td>
            <td>
                Проверка, является ли значение номером телефона из определенной страны
            </td>
            <td>
                phone, phone:rus, phone:[rus|ukr]
            </td>
        </tr>
        <tr>
            <td>
                <a href="https://github.com/old-oak/easy-validator/blob/master/docs/Rulebooks.md#Plurality">Plurality</a>
            </td>
            <td>
                Проверка, является ли значение массивом или объектом, который реализует интерфейс ArrayAccess
            </td>
            <td>
                plurality
            </td>
        </tr>
        <tr>
            <td>
                <a href="https://github.com/old-oak/easy-validator/blob/master/docs/Rulebooks.md#Regexp">Regexp</a>
            </td>
            <td>
                Проверка, значения по шаблону регулярного выражения
            </td>
            <td>
                regexp:/^a-zA-Z$/
            </td>
        </tr>
        <tr>
            <td>
                <a href="https://github.com/old-oak/easy-validator/blob/master/docs/Rulebooks.md#Required">Required</a>
            </td>
            <td>
                Проверка, является ли значение заполненным
            </td>
            <td>
                required
            </td>
        </tr>
        <tr>
            <td>
                <a href="https://github.com/old-oak/easy-validator/blob/master/docs/Rulebooks.md#String">String</a>
            </td>
            <td>
                Проверка, является ли значение строкой
            </td>
            <td>
                string
            </td>
        </tr>
        <tr>
            <td>
                <a href="https://github.com/old-oak/easy-validator/blob/master/docs/Rulebooks.md#Url">Url</a>
            </td>
            <td>
                Проверка, является ли значение url
            </td>
            <td>
                url, url:google.com
            </td>
        </tr>
    </tbody>
</table>


## Содействие разработки

Спасибо, что решили внести свой вклад в разработку данной библиотеки.

## Лицензия

Библиотека использует [GNU GPLv3](https://opensource.org/licenses/GPL-3.0). Дополненеие к данной лицензии служит то, что ЛЮБОЙ разработчик может ее использовать вне зависимсоти от политической обстановки.