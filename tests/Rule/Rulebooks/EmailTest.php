<?php

use PHPUnit\Framework\TestCase;

class EmailTest extends TestCase
{
    /**
     * @dataProvider additionProviderTestEmail
     */
    public function testEmail($value, $value2)
    {
        $obj = new \OldOak\EasyValidator\Validator(['test' => ["email"]], ['test' => $value]);

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

    public function additionProviderTestEmail()
    {
        return [
            ['1,2', false],
            ['test@mail.ru', true],
            ['Test@mail.ru', true],
            ['test@gkasdakasdk.r', false],
            ['test@aaa,r', false],
            ['тест@тест,ру', false],
            ['-tttasd@mail.ru', true],
            ['t-_\ttasd@mail.ru', true],
            ['t-_ttasd@mail.ru', true],
            ['t-\ttasd@mail.ru', true],
            ['t-\ttasd.ru', false],
            ['t-\ttas@@@@@@d.ru', false],
            ['@@@@@@@@@@asd', false],
            ['99821_@mail.ru', true],
            ['998-_\21@mail.ru', true],
            ['1,2.2', false],
            ['1,2,2', false],
            [2.12, false],
            [222%1, false],
            [0, false],
            [0.0, false],
            [0, false],
            [222233, false],
            [false, false],
            [true, false],
            [array(), false],
            [new \stdClass(), false],
            ['NULL', false],
            [NULL, false],
            ['false', false],
            ['true', false],
            ['<?php 123:22213?>', false],
            ["<?php echo '123:22213' ?>", false],
            [fopen("http://www.example.com/", "r"), false],
        ];
    }
}