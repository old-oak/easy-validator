<?php

use PHPUnit\Framework\TestCase;

class DigitsTest extends TestCase
{
    /**
     * @dataProvider additionProviderTestDigits
     */
    public function testDigits($value, $value2, $value3 = null)
    {
        if ($value3 === null) {
            $arRules = ['test' => ["digits"]];
        } else {
            $arRules = ['test' => ["digits:{$value3}"]];
        }

        $obj = new \OldOak\EasyValidator\Validator($arRules, ['test' => $value]);

        try {
            $validate = $obj->validate();
            $result = $validate->result;
            if ($value2 === true) {
                self::assertEmpty($result->errors);
            } else {
                self::assertTrue(!empty($result->errors)
                    && isset($result->errors['test'])
                    && array_key_exists('test', $result->errors));
            }

        } catch (\OldOak\EasyValidator\Common\ValidatorException $e) {
            print_r($e->getMessage());
        }
    }

    public function additionProviderTestDigits()
    {
        return [
            [false, false],
            [true, false],

            ['false', false],
            ['true', false],

            ['1,2', false],
            ['<?php 123:22213?>', false],
            ["<?php echo '123:22213' ?>", false],
            [2.12, false],
            [-2.12, false],
            [222%1, true],
            [0, true],
            [55, true],
            [-15, true],
            ['-15', false],
            [[123], false],
            ['0', true],
            ['22', true],

            [array(), false],
            [new \stdClass(), false],
            [null, false],

            ['2.3', false],
            ['28.09.2019', false],
            [static function(){return 1;}, false],
            [fopen("http://www.example.com/", "rb"), false],

            [222%1, false, 111],
            [0, true, 0],
            [55, false, 43],
            [-15, false, '-15'],
            [-15, false, -15],
            ['0', false, '15'],
            ['0', false, 15],
            ['5', true, 5],
        ];
    }
}