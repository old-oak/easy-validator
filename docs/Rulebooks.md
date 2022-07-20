# EasyValidator

Документация по сводам правил, которые доступны в библиотеке

## Список правил

### Boolean
Проверка, является ли значение логическим. <br>
Данные, проходящие валидацию:
 - true
 - false
 - 0
 - 1
##### Пример:
```php
$fields = [
  'test_boolean' => ['boolean']
];
$values = [
    'test_boolean' => false
];
$messages = [
  'test_boolean' => 'Ошибка',
];
$validator = Validator::make($fields, $values, $messages);
$res = $validator->validate()->result;

// 0 
print_r(count($res->errors));

$res1 = Validator::isBoolean('test single');

//false
var_dump($res1);
```

### Char
Проверка, является ли значение строкой с определенным кол-вом символов N.
Данные, проходящие валидацию значения:
 - типы данных, которые возможно конвертировать в строку.
 
Данные, проходящие валидацию N:
  - типы данных, которые можно конвертировать в число.
##### Пример:
```php
$fields = [
  'test_char' => ['char:8']
];
$values = [
    'test_char' => 'test all'
];
$messages = [
  'test_char' => 'Ошибка',
];
$validator = Validator::make($fields, $values, $messages);
$res = $validator->validate()->result;

// 0 
print_r(count($res->errors));

$res1 = Validator::isChar('test single', 2);

//false
var_dump($res1);
```

### CharMax
Проверка, является ли значение строкой с определенным кол-вом символов, которое <= N
Данные, проходящие валидацию значения:
 - типы данных, которые возможно конвертировать в строку.
 
Данные, проходящие валидацию N:
 - типы данных, которые можно конвертировать в число.
##### Пример:
```php
$fields = [
  'test_char' => ['charMax:8']
];
$values = [
    'test_char' => 'test'
];
$messages = [
  'test_char' => 'Ошибка',
];
$validator = Validator::make($fields, $values, $messages);
$res = $validator->validate()->result;

// 0 
print_r(count($res->errors));

$res1 = Validator::isCharMax('test', 2);

//false
var_dump($res1);
```

### CharMin
Проверка, является ли значение строкой с определенным кол-вом символов, которое >= N <br>
Данные, проходящие валидацию значения:
  - типы данных, которые возможно конвертировать в строку.
  
Данные, проходящие валидацию N:
  - типы данных, которые можно конвертировать в число.
##### Пример:
```php
$fields = [
  'test_char' => ['charMin:8']
];
$values = [
    'test_char' => 'test world'
];
$messages = [
  'test_char' => 'Ошибка',
];
$validator = Validator::make($fields, $values, $messages);
$res = $validator->validate()->result;

// 0 
print_r(count($res->errors));

$res1 = Validator::isCharMin('test', 3);

//false
var_dump($res1);
```

### Choice
Проверка, есть ли значение, которое строго равно значению из строки с разделителями, в списке, который передан.
Регистр учитывается.<br>
Данные, проходящие валидацию значения:
 - типы данных, которые возможно конвертировать в строку.
 
Данные, проходящие валидацию списка:
 - типы данных, которые можно конвертировать в строку.

Примечания: 
 - Начало диапазона проверки должно начинаться с <b>"\["</b> и заканчиваться <b>"]"</b>,
  допустимые разделители между значениями: <b>|</b> (прямая черта)
 - Если в списке есть <b>false</b> или <b>true</b>, то они будут конвертироваться в тип данных <b>bool</b>
<br>

##### Пример:
```php
$fields = [
  'test_choice' => ['choice:[hi|world]']
];
$values = [
    'test_choice' => 'world'
];
$messages = [
  'test_choice' => 'Ошибка',
];
$validator = Validator::make($fields, $values, $messages);
$res = $validator->validate()->result;

// 0 
print_r(count($res->errors));

$res1 = Validator::isChoice('test', '[yes|no|on|off]');

//false
var_dump($res1);
```

### Date
Проверка, является ли значение датой, которую может понять DateTime::__constructor <br>
##### Пример:
```php
$fields = [
  'test_date' => ['date']
];
$values = [
    'test_date' => '2022-01-01 00:00:00'
];
$messages = [
  'test_date' => 'Ошибка',
];
$validator = Validator::make($fields, $values, $messages);
$res = $validator->validate()->result;

// 0 
print_r(count($res->errors));

$res1 = Validator::isDate([]);

//false
var_dump($res1);
```

### Digits
Проверка, является ли значение целым числом или строкой, в которой содержится целое число.
Можно так-же проверять на строгое равенство с другим числом <br>
Данные проходящие валидацию:
  - int
  - string(но только, если вней все символы являются числами [0-9])
##### Пример:
```php
$fields = [
  'test_digits' => ['digits'],
  'test_digits1' => ['digits:199'],
];
$values = [
    'test_digits' => '123',
    'test_digits1' => '199',
];
$messages = [
  'test_digits' => 'Ошибка',
  'test_digits1' => 'Ошибка',
];
$validator = Validator::make($fields, $values, $messages);
$res = $validator->validate()->result;

// 0 
print_r(count($res->errors));

$res1 = Validator::isDigits('world123');

//false
var_dump($res1);

$res2 = Validator::isDigits('33', 55);

//false
var_dump($res2);
```

### Email
Проверка, является ли значение электронной почтой. <br>
Данные проходящие валидацию:
 - string и валидная электронная почта (простая проверка)
##### Пример:
```php
$fields = [
  'test_email' => ['email']
];
$values = [
    'test_email' => 'test@yandex.com'
];
$messages = [
  'test_email' => 'Ошибка',
];
$validator = Validator::make($fields, $values, $messages);
$res = $validator->validate()->result;

// 0 
print_r(count($res->errors));

$res1 = Validator::isEmail('hi all world @mail');

//false
var_dump($res1);
```

### File
Проверка, является ли значение файлом. <br>
Данные проходящие валидацию:
  - string
  - resource
##### Пример:
```php
$fields = [
  'test_file' => ['file'],
  'test_file1' => ['file:png'],
  'test_file2' => ['file:[jpg|jpeg|bmp|png]'],
];
$values = [
    'test_file' => 'tests/Chrysanthemum.jpg',
    'test_file1' => 'tests/Chrysanthemum.png',
    'test_file2' => fopen('tests/Chrysanthemum.jpg', 'rb'),
];
$messages = [
  'test_file' => 'Ошибка',
  'test_file1' => 'Ошибка',
  'test_file2' => 'Ошибка',
];
$validator = Validator::make($fields, $values, $messages);
$res = $validator->validate()->result;

// 0 
print_r(count($res->errors));

$res1 = Validator::isFile(static function(){return 1;});

//false
var_dump($res1);

$res2 = Validator::isFile('tests/Chrysanthemum.jpg', 'png');

//false
var_dump($res2);

$res3 = Validator::isFile(fopen('tests/Chrysanthemum.jpg', 'rb'), '[bmp|svg]');

//false
var_dump($res3);
```

### Float
Проверка, является ли значение числом с плавающей запятой. <br>
Данные проходящие валидацию:
  - float (с разделителями "."(Точка) или "," (Запятая)
  - string (но если это строка только с числами и/или разделителя)
##### Пример:
```php
$fields = [
  'test_float' => ['float'],
];
$values = [
    'test_float' => 15.5,
];
$messages = [
  'test_float' => 'Ошибка',
];
$validator = Validator::make($fields, $values, $messages);
$res = $validator->validate()->result;

// 0 
print_r(count($res->errors));

$res1 = Validator::isFloat('test float');

//false
var_dump($res1);
```

### Max
Проверка, является ли значение числом, которое больше чем N. <br>
Данные проходящие валидацию:
  - string(если в этой строке есть числа)
  - int
  - float
##### Пример:
```php
$fields = [
  'test_max' => ['max:20'],
];
$values = [
    'test_max' => 99,
];
$messages = [
  'test_max' => 'Ошибка',
];
$validator = Validator::make($fields, $values, $messages);
$res = $validator->validate()->result;

// 0 
print_r(count($res->errors));

$res1 = Validator::isMax(15, 5);

//false
var_dump($res1);
```

### Min
Проверка, является ли значение числом, которое меньше чем N. <br>
Данные проходящие валидацию:
 - string(если в этой строке есть числа)
 - int
 - float
##### Пример:
```php
$fields = [
  'test_min' => ['min:10'],
];
$values = [
    'test_min' => -5.5,
];
$messages = [
  'test_min' => 'Ошибка',
];
$validator = Validator::make($fields, $values, $messages);
$res = $validator->validate()->result;

// 0 
print_r(count($res->errors));

$res1 = Validator::isMin(22, -5.5);

//false
var_dump($res1);
```

### Nullable
Проверка, является ли значение пустым, если да, то пропускается логика. <br>
Уникальный тип, который позволяет варьировать данные, особенно, если какие-то данные могуть быть, а могут и не быть переданы в обработчик валидатора <br>
Данные проходящие валидацию:
 - null
 - '' (пустая строка)
##### Пример:
```php
$fields = [
  'test_nullable' => ['nullable'],
];
$values = [
    'test_nullable' => '',
];
$messages = [
  'test_nullable' => 'Ошибка',
];
$validator = Validator::make($fields, $values, $messages);
$res = $validator->validate()->result;

// 0 
print_r(count($res->notices));

$res1 = Validator::isNullable(125);

//false
var_dump($res1);
```

### Numeric
Проверка, является ли значение числом. Синоним is_numeric() <br>
##### Пример:
```php
$fields = [
  'test_numeric' => ['numeric'],
  'test_numeric1' => ['numeric:55.5'],
];
$values = [
    'test_numeric' => '123',
    'test_numeric1' => 55.5,
];
$messages = [
  'test_numeric' => 'Ошибка',
  'test_numeric1' => 'Ошибка',
];
$validator = Validator::make($fields, $values, $messages);
$res = $validator->validate()->result;

// 0 
print_r(count($res->errors));

$res1 = Validator::isNumeric('world123');

//false
var_dump($res1);

$res2 = Validator::isNumeric('33', 55);

//false
var_dump($res2);
```

### Object
Проверка, является ли значение объектом. Синоним is_object() <br>
##### Пример:
```php
$fields = [
  'test_object' => ['object']
];
$values = [
    'test_object' => static function(){return 1;}
];
$messages = [
  'test_object' => 'Ошибка',
];
$validator = Validator::make($fields, $values, $messages);
$res = $validator->validate()->result;

// 0 
print_r(count($res->errors));

$res1 = Validator::isObject('test');

//false
var_dump($res1);
```

### OnlyLetters
Проверка, является ли значение строкой ТОЛЬКО с буквами или пустой. <br>
Данные проходящие валидацию:
 - string(если в этой строке ТОЛЬКО буквы или пустая)
##### Пример:
```php
$fields = [
  'test_only_letters' => ['onlyLetters'],
];
$values = [
    'test_only_letters' => 'olahey',
];
$messages = [
  'test_only_letters' => 'Ошибка',
];
$validator = Validator::make($fields, $values, $messages);
$res = $validator->validate()->result;

// 0 
print_r(count($res->errors));

$res1 = Validator::isOnlyLetters('Привет мир');

//false
var_dump($res1);
```

### Phone
Проверка, является ли значение номером телефона, если был передан список страк, то будет проверяться именно эти коды страны. <br>
Данные проходящие валидацию:
 - string

Доступные коды стран: aus, bel, bgr, gbr, rus, ukr, usa, isr, ind, ita, per, caf, esp, swe, fra, nld, dnk
##### Пример:
```php
$fields = [
  'test_phone' => ['phone'],
  'test_phone1' => ['phone:rus'],
  'test_phone2' => ['phone:[rus|ukr]'],
];
$values = [
    'test_phone' => '89829998877',
    'test_phone1' => '+79199123456',
    'test_phone2' => '380444618061',
];
$messages = [
  'test_phone' => 'Ошибка',
  'test_phone1' => 'Ошибка',
  'test_phone2' => 'Ошибка',
];
$validator = Validator::make($fields, $values, $messages);
$res = $validator->validate()->result;

// 0 
print_r(count($res->errors));

$res1 = Validator::isPhone([]);

//false
var_dump($res1);

$res2 = Validator::isPhone('hi world', 'rus');

//false
var_dump($res2);

$res3 = Validator::isPhone(12345, [rus|ukr]);

//false
var_dump($res3);
```

### Plurality
Проверка, является ли значение массивом или объектом, реализующем интерфейс <b>ArrayAccess</b>. <br>
Данные проходящие валидацию:
 - array
 - object implements ArrayAccess
##### Пример:
```php
$fields = [
  'test_plurality' => ['plurality'],
];
$values = [
    'test_plurality' => [[[hi]]],
];
$messages = [
  'test_plurality' => 'Ошибка',
];
$validator = Validator::make($fields, $values, $messages);
$res = $validator->validate()->result;

// 0 
print_r(count($res->errors));

$res1 = Validator::isPlurality(new \stdClass());

//false
var_dump($res1);
```

### Regexp
Проверка, является ли значение соответствующем шаблону N. <br>
Данные проходящие валидацию:
 - string (которое соответствует шаблону)
##### Пример:
```php
$fields = [
  'test_regexp' => ['regexp:/^a-zA-Z$/'],
];
$values = [
    'test_regexp' => 'World',
];
$messages = [
  'test_regexp' => 'Ошибка',
];
$validator = Validator::make($fields, $values, $messages);
$res = $validator->validate()->result;

// 0 
print_r(count($res->errors));

$res1 = Validator::isRegexp('test 1234', '/^[\d]$/');

//false
var_dump($res1);
```

### Required
Проверка, является ли значение  заполненное, объекты являются <b>не валидируемые</b>. <br>
Данные проходящие валидацию:
 - array (не empty)
 - object
 - int
 - float
 - bool
 - string (не пустая)
 - resource
##### Пример:
```php
$fields = [
  'test_required' => ['required'],
];
$values = [
    'test_required' => ['HI'],
];
$messages = [
  'test_required' => 'Ошибка',
];
$validator = Validator::make($fields, $values, $messages);
$res = $validator->validate()->result;

// 0 
print_r(count($res->errors));

$res1 = Validator::isRequired(null);

//false
var_dump($res1);
```

### String
Проверка, является ли значение строкой. Синоним is_string() <br>
##### Пример:

```php
$fields = [
  'test_string' => ['string']
];
$values = [
    'test_string' => 'test all'
];
$messages = [
  'test_string' => 'Ошибка',
];
$validator = Validator::make($fields, $values, $messages);
$res = $validator->validate()->result;

// 0 
print_r(count($res->errors));

$res1 = Validator::isString([]);

//false
var_dump($res1);
```

### Url
Проверка, является ли значение url (простая проверка). <br>
Если было передано значение для сравнения, то произойдет строгое сравнение строк <br>
Данные проходящие валидацию:
  - string (валидный url)
  - object (у которого есть метод __toString)
##### Пример:
```php
$fields = [
  'test_url' => ['url'],
  'test_url1' => ['url:google.com'],
];
$values = [
    'test_url' => 'api.test.org.en',
    'test_url1' => 'google.com',
];
$messages = [
  'test_url' => 'Ошибка',
  'test_url1' => 'Ошибка',
];
$validator = Validator::make($fields, $values, $messages);
$res = $validator->validate()->result;

// 0 
print_r(count($res->errors));

$res1 = Validator::isUrl(1234);

//false
var_dump($res1);

$res2 = Validator::isUrl('google.com', 'yandex.ru');

//false
var_dump($res2);
```