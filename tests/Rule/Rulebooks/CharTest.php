<?php

use PHPUnit\Framework\TestCase;

class CharTest extends TestCase
{
    /**
     * @dataProvider additionProviderTestChar
     */
    public function testChar($value1, $value2, $value3)
    {
        $is_object = is_object($value1);
        if(!$is_object) {
            $obj = new \OldOak\EasyValidator\Validator(['test_char' => ["char:{$value1}"]], ['test_char' => $value2]);
            try {
                $validate = $obj->validate();
                $result = $validate->result;
                if($value3 === true) {
                    self::assertEmpty($result->errors);
                } else {
                    self::assertTrue(!empty($result->errors)
                        && isset($result->errors['test_char'])
                        &&  array_key_exists('test_char', $result->errors));
                }

            } catch (\OldOak\EasyValidator\Common\ValidatorException $e) {
                print_r($e->getMessage());
            }
        } else {
            self::assertTrue(true);
        }
    }

    public function additionProviderTestChar()
    {
        return [
            [false, false, true],
            [true, false, false],
            [true, true, true],

            [true, 1, true],
            [true, 2.5, false],
            [true, 'test', false],
            [true, [[['test']]], false],
            [true, new StdClass(), false],
            [false, new StdClass(), false],
            [false, fopen("http://www.example.com/", "r") , false],

            [1, 90, false],
            [1, 0.1, false],
            [1, '1', true],
            [1, '2', true],
            [1, '9', true],
            [1, '900', false],
            [5, [], false],
            [1, [], false],
            [59, new \stdClass(), false],
            [0, new \stdClass(), false],
            [1, new \stdClass(), false],
            [1, null, false],
            [4, null, false],
            [0, null, true],


            [1, '1', true],
            ['5', 'Pda8@', true],
            ['5(0)3', 'Pda8@', true],
            ['2', '{\\', true],
            [null, null, true],
            [0, null, true],
            ['0', null, true],
            ['4', 'null', true],
            ['5', 'false', true],
            ['4', 'true', true],
            ['2', '[]', true],
            [true, true, true],
            [fopen("http://www.example.com/", "r"), false, true],

            [new \stdClass(), '0', true],

            ['Jdas3(0)3', 'P8@', false],
            ['56', '2', false],
            [1, '1aaa1', false],
            ['56', '-2', false],
            ['----', '-2', false],
            [[], '0', false],
            [0, new \stdClass(), false],
            [new \stdClass(), new \stdClass(), false],
            [[], [], false],
            [null, [], false],
            ['null', [], false],
            ['031', null, false],
            ['-5', null, false],
            [-2.5, null, false],
            ['-2.5', 'null', false],
            [true, false, false],
            [fopen("http://www.example.com/", "r"), 1, false],
        ];
    }
}