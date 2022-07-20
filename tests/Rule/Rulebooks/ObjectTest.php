<?php

use PHPUnit\Framework\TestCase;

class ObjectTest extends TestCase
{
    /**
     * @dataProvider additionProviderPrimitive
     */
    public function testObject($value, $value2)
    {
        $obj = new \OldOak\EasyValidator\Validator(['test' => ["object"]], ['test' => $value]);

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
            [new \stdClass(), true],
            [static function() {return false;}, true],
            ['NULL', false],
            ['false', false],
            ['true', false],
            ['2.3', false],
            [fopen("http://www.example.com/", "r"), false],
            ['-----', false],

            [false, false],
            ['', false],
            [array(), false],
            [array(123), false],
            [array('test' => 'test'), false],
            [null, false],
        ];
    }
}
