<?php

use PHPUnit\Framework\TestCase;

class FloatTest extends TestCase
{
    /**
     * @dataProvider additionProviderTestFloat
     */
    public function testFloat($value, $value2)
    {
        $obj = new \OldOak\EasyValidator\Validator(['test' => ["float"]], ['test' => $value]);

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

    public function additionProviderTestFloat()
    {
        return [
            ['2.3', true],
            ['1,2', true],
            [2.12, true],
            [0.0, true],
            ['0,0',true],
            ['0.0',true],

            ['1,2.2', false],
            ['1,2,2', false],
            ['1.2.2', false],
            ['1.2,2', false],
            [222 % 1, false],
            [0, false],
            [0, false],
            [222233, false],
            ['0,0.0',false],
            [false,false],
            [true,false],
            [array(),false],
            [array('125.5'),false],
            [new \stdClass(), false],
            [static function(){return 1;}, false],
            ['NULL',false],
            [NULL, false],
            ['false',false],
            ['true', false],
            ['<?php 123:22213?>', false],
            ["<?php echo '123:22213' ?>", false],
            [fopen("http://www.example.com/", "r"), false],
        ];
    }
}