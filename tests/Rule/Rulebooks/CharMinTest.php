<?php

use PHPUnit\Framework\TestCase;

class CharMinTest extends TestCase
{
    /**
     * @dataProvider additionProviderTestCharMin
     */
    public function testCharMin($value1, $value2, $value3)
    {
        $is_object = is_object($value1);
        if(!$is_object) {
            $obj = new \OldOak\EasyValidator\Validator(['test_char_min' => ["char_min:{$value1}"]], ['test_char_min' => $value2]);
            try {
                $validate = $obj->validate();
                $result = $validate->result;
                if($value3 === true) {
                    self::assertEmpty($result->errors);
                } else {
                    self::assertTrue(!empty($result->errors)
                        && isset($result->errors['test_char_min'])
                        &&  array_key_exists('test_char_min', $result->errors));
                }

            } catch (\OldOak\EasyValidator\Common\ValidatorException $e) {
                print_r($e->getMessage());
            }
        } else {
            self::assertTrue(true);
        }
    }

    public function additionProviderTestCharMin()
    {
        return [
            [false, false, true],
            [true, false, false],
            [true, true, true],

            [true, 1, true],
            [true, 2.5, true],
            [true, 'test', true],
            [true, [[['test']]], false],
            [true, new StdClass(), false],
            [false, new StdClass(), false],
            [false, fopen("http://www.example.com/", "r") , true],

            [1, 90, true],
            [100, 5, false],
            [4, 125, false],
            [3, 125, true],
            [3, ";sa", true],
        ];
    }
}