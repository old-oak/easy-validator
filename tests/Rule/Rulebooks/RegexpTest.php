<?php

use PHPUnit\Framework\TestCase;

class RegexpTest extends TestCase
{
    /**
     * @dataProvider additionProviderPrimitive
     * @dataProvider additionProviderValidRegexp
     */
    public function testRegexp($value, $value2, $value3)
    {
        $obj = new \OldOak\EasyValidator\Validator(['test' => ["regexp:{$value2}"]], ['test' => $value]);

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

    public function additionProviderPrimitive()
    {
        return [
            ['2.3','/^$/', false],
            ['1,2','/^$/', false],
            [2.12,'/^$/', false],
            [0.0,'/^$/', false],
            ['0,0','/^$/', false],
            ['0.0','/^$/', false],

            ['1,2.2','/^$/',false],
            ['1,2,2','/^$/',false],
            ['1.2.2','/^$/',false],
            ['1.2,2','/^$/',false],
            [222 % 1,'/^$/', false],
            [0,'/^$/', false],
            [0,'/^$/', false],
            [222233,'/^$/', false],
            ['0,0.0','/^$/', false],
            [false,'/^$/', false],
            [true,'/^$/', false],
            [array(),'/^$/', false],
            [new \stdClass(),'/^$/', false],
            [static function () {
                return 1;
            },'/^$/', false],
            ['NULL','/^$/', false],
            [NULL,'/^$/', false],
            ['false','/^$/', false],
            ['true','/^$/', false],
            ['<?php 123:22213?>','/^$/', false],
            ["<?php echo '123:22213' ?>",'/^$/', false],
            [fopen("http://www.example.com/", "r"),'/^$/', false],
        ];
    }

    public function additionProviderValidRegexp()
    {
        return [
            [123, '/^[\d]*$/', true],
            ['123', '/^[\d]*$/', true],
            [123.4, '/^[\d\.]*$/', true],
            [-123, '/^[\d-]*$/', true],
            ['-123', '/^[\d-]*$/', true],
            [-123.4, '/^[\d\.-]*$/', true],

            ['Testing', '/^[\D]*$/', true],
            ['Testing_123_44', '/^([\D]*)_([\d]*)_([\d]+)$/', true],
        ];
    }
}