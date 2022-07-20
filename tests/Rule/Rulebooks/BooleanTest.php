<?php

use PHPUnit\Framework\TestCase;

class BooleanTest extends TestCase
{
    /**
     * @dataProvider additionProviderTestBoolean
     */
    public function testBoolean($value1, $value2)
    {
        $is_object = is_object($value1);
        if(!$is_object) {
            $obj = new \OldOak\EasyValidator\Validator(['test_boolean' => ["boolean"]], ['test_boolean' => $value1]);
            try {
                $validate = $obj->validate();
                $result = $validate->result;
                if($value2 === true) {
                    self::assertEmpty($result->errors);
                } else {
                    self::assertTrue(!empty($result->errors)
                        && isset($result->errors['test_boolean'])
                        &&  array_key_exists('test_boolean', $result->errors));
                }

            } catch (\OldOak\EasyValidator\Common\ValidatorException $e) {
                print_r($e->getMessage());
            }
        } else {
            self::assertTrue(true);
        }
    }

    public function additionProviderTestBoolean()
    {
        return [
            [1, true],
            [3, false],
            [0, true],
            [-1, false],

            [1.5, false],
            [-1.99, false],

            ['false', false],
            ['true', false],
            ['aaa', false],
            ['test', false],

            [false, true],
            [true, true],

            [[], false],

            [fopen("http://www.example.com/", "rb"), false],

            [new StdClass(), false],

            [null, false],
            [static function(){return 1;}, false],
        ];
    }
}