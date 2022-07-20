<?php

use PHPUnit\Framework\TestCase;

class CharMaxTest extends TestCase
{
    /**
     * @dataProvider additionProviderTestCharMax
     */
    public function testCharMax($value1, $value2, $value3)
    {
        $is_object = is_object($value1);
        if(!$is_object) {
            $obj = new \OldOak\EasyValidator\Validator(['test_char_max' => ["char_max:{$value1}"]], ['test_char_max' => $value2]);
            try {
                $validate = $obj->validate();
                $result = $validate->result;
                if($value3 === true) {
                    self::assertEmpty($result->errors);
                } else {
                    self::assertTrue(!empty($result->errors)
                        && isset($result->errors['test_char_max'])
                        &&  array_key_exists('test_char_max', $result->errors));
                }

            } catch (\OldOak\EasyValidator\Common\ValidatorException $e) {
                print_r($e->getMessage());
            }
        } else {
            self::assertTrue(true);
        }
    }

    public function additionProviderTestCharMax()
    {
        return [
            [false, false, true],
            [true, false, true],
            [true, true, true],

            [null, 15, false],
            [null, 0, false],

            [true, 1, true],
            [true, 2.5, false],
            [true, 'test', false],
            [true, [[['test']]], false],
            [true, new StdClass(), false],
            [false, new StdClass(), false],
            [false, fopen("http://www.example.com/", "r") , false],

            [1, 90, false],
            [100, 5, true],
            [100, 5, true],
            [100, 125, true],
            [3, 125, true],
            [3, ";sa", true],
            ['3', "444", true],
            ['3', "44", true],
            ['21', "4sssad4", true],
        ];
    }
}