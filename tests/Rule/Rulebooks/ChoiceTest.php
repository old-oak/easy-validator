<?php

use PHPUnit\Framework\TestCase;

class ChoiceTest extends TestCase
{
    /**
     * @dataProvider additionProviderTestChoice
     */
    public function testChoice($value1, $value2, $value3)
    {
        $obj = new \OldOak\EasyValidator\Validator(['test' => ["choice:{$value2}"]], ['test' => $value1]);

        try {
            $validate = $obj->validate();
            $result = $validate->result;
            if($value3 === true) {
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

    public function additionProviderTestChoice()
    {
        return [
            ['1,2', '[1|2]', false],
            ['1,2.2', '[hi|lll]', false],
            ['1,2.2', 'hi|lll', false],
            ['2.3', '[2.3|4]', true],
            ['33', '[test|asd', false],
            ['test', 'test|asd', false],
            ['33', 'test|asd]', false],
            ['testasd', 'testasd]', false],
            ['33', '[testasd]', false],
            ['33', '[testasd|]', false],
            ['testasd', '[testasd', false],
            ['testasd', '[testasd]', true],
            ['-223', '[-2|-223]', true],
            ['-223-22', '[2+2|3]', false],
            ['+223-22', '[2+2|+223-22]', true],
            ['+22322', '[p|s]', false],
            [-0, '[-0]', false],
            [+0, '+2]', false],
            [+0, null, false],
            [44, null, false],
            [44, array(), false],
            [6, false, false],
            [5, true, false],
            [3, array(), false],
            [false, '[false|true]', true],
            [true, '[yes|no]', false],
            [false, '[yes|no]', false],
            [array(), 'array()', false],
            ['NULL', 'NULL', false],
            ['NULL', '[NULL]', true],
            ['NULL', '[' . null . ']', false],
            [NULL, '[NULL]', true],
            [NULL, 'NULL', false],
            ['no', '[yes;no]', false],
            ['no', '[yes|noaaaa]', false],
            [fopen("http://www.example.com/", "r"), 'res*', false],
        ];
    }
}