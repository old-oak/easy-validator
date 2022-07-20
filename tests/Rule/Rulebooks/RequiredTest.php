<?php

use PHPUnit\Framework\TestCase;

class RequiredTest extends TestCase
{
    /**
     * @dataProvider additionProviderTestRequired
     */
    public function testRequired($value1, $value2)
    {
        $is_object = is_object($value1);
        if(!$is_object) {
            $obj = new \OldOak\EasyValidator\Validator(['test' => ["required"]], ['test' => $value1]);
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

    public function additionProviderTestRequired()
    {
        return [
            ['1,2', true],
            ['<?php 123:22213?>', true],
            ["<?php echo '123:22213' ?>", true],
            [2.12, true],
            [222%1, true],
            [0, true],
            [-5, true],
            [-5.5, true],
            [-0, true],
            [123, true],
            ['0', true],
            [true, true],
            [new \stdClass(), true],
            [static function() {return false;}, true],
            ['NULL', true],
            ['false', true],
            ['true', true],
            ['2.3', true],
            [fopen("http://www.example.com/", "r"), true],
            ['-----', true],
            [[['hi']], true],
            [false, true],

            [array(), false],
            ['', false],
            [null, false],
        ];
    }
}