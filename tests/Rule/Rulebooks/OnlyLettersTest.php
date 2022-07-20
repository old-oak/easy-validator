<?php

use PHPUnit\Framework\TestCase;

class OnlyLettersTest extends TestCase
{
    /**
     * @dataProvider additionProviderTestOnlyLetters
     */
    public function testOnlyLetters($value1, $value2)
    {
        $is_object = is_object($value1);
        if(!$is_object) {
            $obj = new \OldOak\EasyValidator\Validator(['test' => ["onlyLetters"]], ['test' => $value1]);
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

    public function additionProviderTestOnlyLetters()
    {
        return [
            ['1,2', false],
            ['<?php 123:22213?>', false],
            ["<?php echo '123:22213' ?>", false],
            [2.12, false],
            [222%1, false],
            [0, false],
            [-5, false],
            [-55, false],
            [5, false],
            [-5.5, false],
            [-0, false],
            [123, false],
            ['0', false],
            [true, false],
            [new \stdClass(), false],
            [static function() {return false;}, false],
            ['NULL', true],
            ['false', true],
            ['true', true],
            ['2.3', false],
            [fopen("http://www.example.com/", "r"), false],
            ['-----', false],

            [false, false],
            ['', true],
            ['HelloWorld', true],
            ['Helloworld', true],
            ['ПриветМир', true],
            ['Приветмир', true],
            [array(), false],
            [null, false],
        ];
    }
}