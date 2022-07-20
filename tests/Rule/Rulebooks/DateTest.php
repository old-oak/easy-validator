<?php

use PHPUnit\Framework\TestCase;

class DateTest extends TestCase
{
    /**
     * @dataProvider additionProviderTestDate
     */
    public function testDate($value, $value2)
    {
        $obj = new \OldOak\EasyValidator\Validator(['test' => ["date"]], ['test' => $value]);

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

    public function additionProviderTestDate()
    {
        return [
            ['1,2', false],
            ['<?php 123:22213?>', false],
            ["<?php echo '123:22213' ?>", false],
            [2.12, false],
            [222%1, false],
            [0, false],
            [55, false],
            [[123], false],
            ['0', false],
            [false, false],
            [true, false],
            [array(), false],
            [new \stdClass(), false],
            'date_obj' => [new \DateTime(), true],
            'date_obj1' => [DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s')), true],
            [null, false],
            ['NULL', false],
            ['false', false],
            ['true', false],
            ['2.3', true],
            ['28.09.2019', true],
            ['28.09.20193', false],
            ['28.09.20', true],
            ['28.09.95', true],
            ['28.09.05', true],
            ['333.09.05', false],
            ['333.22.05', false],
            ['333.22.0505', false],
            ['00.00.00', true],
            ['00.00.0000', true],
            ['30.09.1996', true],
            ['30.09.1996 21:0:1', true],
            [fopen("http://www.example.com/", "rb"), false],
        ];
    }
}