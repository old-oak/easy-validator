<?php

use PHPUnit\Framework\TestCase;

class NullableTest extends TestCase
{
    /**
     * @dataProvider additionProviderPrimitive
     */
    public function testNullable($value, $value2)
    {
        $obj = new \OldOak\EasyValidator\Validator(['test' => ["nullable"]], ['test' => $value]);

        try {
            $validate = $obj->validate();
            $result = $validate->result;
            if($value2 === true) {
                self::assertTrue(!empty($result->notices)
                    && isset($result->notices['test'])
                    &&  array_key_exists('test', $result->notices));
            } else {
                self::assertEmpty($result->notices);
            }

        } catch (\OldOak\EasyValidator\Common\ValidatorException $e) {
            print_r($e->getMessage());
        }
    }

    public function additionProviderPrimitive()
    {
        return [
            ['1,2', false],
            ['<?php 123:22213?>', false],
            ["<?php echo '123:22213' ?>", false],
            [2.12, false],
            [222%1, false],
            [0, false],
            [-5, false],
            [-5.5, false],
            [-0, false],
            [123, false],
            ['0', false],
            [true, false],
            [new \stdClass(), false],
            [static function() {return false;}, false],
            ['NULL', false],
            ['false', false],
            ['true', false],
            ['2.3', false],
            [fopen("http://www.example.com/", "r"), false],
            ['-----', false],

            [false, false],
            ['', true],
            [array(), false],
            [array(123), false],
            [array('test' => 'test'), false],
            [null, true],
        ];
    }
}
