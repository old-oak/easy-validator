<?php

use PHPUnit\Framework\TestCase;

class StringTest extends TestCase
{
    /**
     * @dataProvider additionProviderTestString
     */
    public function testString($value1, $value2)
    {
        $is_object = is_object($value1);
        if(!$is_object) {
            $obj = new \OldOak\EasyValidator\Validator(['test' => ["string"]], ['test' => $value1]);
            try {
                $validate = $obj->validate();
                $result = $validate->result;
                if($value2 === true) {
                    self::assertEmpty($result->errors);
                } else {
                    self::assertTrue(!empty($result->errors)
                        && isset($result->errors['test'])
                        &&  array_key_exists('test', $result->errors));
                }

            } catch (\OldOak\EasyValidator\Common\ValidatorException $e) {
                print_r($e->getMessage());
            }
        } else {
            self::assertTrue(true);
        }
    }

    public function additionProviderTestString()
    {
        return [
            ['1,2', true],
            ['<?php 123:22213?>', true],
            ["<?php echo '123:22213' ?>", true],
            [2.12, false],
            [222%1, false],
            [0, false],
            [-5, false],
            [-5.5, false],
            [-0, false],
            [123, false],
            ['0', true],
            [true, false],
            [new \stdClass(), false],
            [static function() {return false;}, false],
            ['NULL', true],
            ['false', true],
            ['true', true],
            ['2.3', true],
            [fopen("http://www.example.com/", "r"), false],
            ['-----', true],

            [false, false],
            ['', true],
            [array(), false],
            [null, false],
        ];
    }
}