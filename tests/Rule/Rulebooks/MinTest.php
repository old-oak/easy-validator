<?php

use PHPUnit\Framework\TestCase;

class MinTest extends TestCase
{
    /**
     * @dataProvider additionProviderTestMin
     */
    public function testMin($value, $value2, $value3)
    {
        $obj = new \OldOak\EasyValidator\Validator(['test' => ["min:{$value2}"]], ['test' => $value]);

        try {
            $result = $obj->validate()->result;
            if ($value3 === true) {
                self::assertEmpty($result->errors);
            } else {
                self::assertTrue(!empty($result->errors)
                    && isset($result->errors['test'])
                    && array_key_exists('test', $result->errors));
            }

        } catch (\OldOak\EasyValidator\Common\ValidatorException $e) {
            print_r($e->getMessage());
        }
    }

    public function additionProviderTestMin()
    {
        return [
            [-5, -1, true],
            [-5.5, -1, true],
            [1.5, '15', true],
            [1.5, '14.5', true],
            [-25.5, '-15', true],
            [-45.5, '-15.5', true],
            [-15.9, '-15.5', true],
            [-15.9999, '-15.5', true],
            [-1.555, '-1', true],
            ['1', '2', true],
            ['-10.0', -1, true],
            ['-10.5', -1, true],
            ['-15.5', '122.5', true],
            ['-15', '122.5', true],
            ['-15.5', '122', true],
            ['-15', '122', true],
            ['1.2', '5.2', true],
            ['1.2', '7', true],
            ['2', '8', true],
            ['-15', -1, true],
            [-12, -2, true],
            [222 % 1, 2, true],

            ['7', '1.2', false],
            ['0,0', +2, false],
            ['1,2', '4', false],
            [-15, '-15.5aaaa', false],
            ['-15.5', '-15.5', false],
            ['10,5', -1, false],
            [0, 0, false],
            [222233, 'rrr', false],
            ['0,0.0', 0, false],
            ['1,2', '4,2', false],
            [false,true, false],
            [true,false, false],
            [array(), 0, false],
            [array(), 1, false],
            [new \stdClass(), 'test', false],
            [static function () {return 1;}, false, false],
            ['NULL', NULL, false],
            [NULL, 222, false],
            ['false', 'true', false],
            ['true', 'false', false],
            ['<?php 123:22213?>', 2131, false],
            ["<?php echo '123:22213'; ?>", 222133, false],
            [fopen("http://www.example.com/", "r"), 213, false],
        ];
    }
}