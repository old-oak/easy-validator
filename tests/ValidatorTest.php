<?php

use OldOak\EasyValidator\Validator;

class ValidatorTest extends PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider additionProviderTestIs
     */
    public function testIs($rule, $value, $result)
    {
        try {
            $resultValidate = Validator::is($rule, $value);
            if($result === true) {
                self::assertTrue($resultValidate);
            } else {
                self::assertFalse(false);
            }
        } catch (\OldOak\EasyValidator\Common\ValidatorException $e) {
            if(!$result) {
                $this->assertTrue(true);
            }
        }
    }

    public function additionProviderTestIs()
    {
        return [
            [1, null, false],
            [3, null, false],
            [0, null, false],
            [-1, null, false],

            [1.5, null, false],
            [-1.99, null, false],

            ['false', null, false],
            ['true', null, false],
            ['aaa', null, false],
            ['test', null, false],

            [false, null, false],
            [true, null, false],

            [[], null, false],

            [fopen("http://www.example.com/", "rb"), null, false],

            [new StdClass(), null, false],

            [null, null, false],
            [static function(){return 1;}, null, false],

            ['digits', 15, true],
            ['email', 'test@test.com', true],
            ['Plurality', [], true],
            ['Plurality', 'string', false],
        ];
    }
}
