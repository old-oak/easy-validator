<?php

use OldOak\EasyValidator\Common\Config;
use PHPUnit\Framework\TestCase;

class PhoneTest extends TestCase
{
    /**
     * @dataProvider additionProviderTestPhoneRus
     */
    public function testPhone($value, $result_test, $location = null)
    {
        Config::init([Config::RULEBOOK_PHONE_SYSTEM_CODE => false]);
        if ($location === null) {
            $arRules = ['test' => ["phone"]];
        } else {
            $arRules = ['test' => ["phone:{$location}"]];
        }
        $obj = new \OldOak\EasyValidator\Validator($arRules, ['test' => $value]);

        try {
            $result = $obj->validate()->result;
            if ($result_test === true) {
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

    /**
     * @dataProvider additionProviderTestPhoneRusClear
     */
    public function testPhoneClear($value, $result_test, $location = null)
    {
        Config::init([Config::RULEBOOK_PHONE_SYSTEM_CODE => true]);
        if ($location === null) {
            $arRules = ['test' => ["phone"]];
        } else {
            $arRules = ['test' => ["phone:{$location}"]];
        }
        $obj = new \OldOak\EasyValidator\Validator($arRules, ['test' => $value]);

        try {
            $result = $obj->validate()->result;
            if ($result_test === true) {
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

    public function additionProviderTestPhoneRus()
    {
        return [
            ['+7 926 123 45 67', true, 'rus'],
            ['+7 (926) 123 45 67', true, 'rus'],
            ['+7 (926)-123 45 67', true, 'rus'],
            ['+7 (926)-123-45 67', true, 'rus'],
            ['+7 (926)-123-45-67', true, 'rus'],
            ['+7 (926)-123-4567', true, 'rus'],
            ['+7 (926)-12345-67', true, 'rus'],
            ['+7 (926)-1234567', true, 'rus'],
            ['+7 (926)1234567', true, 'rus'],
            ['+7926-123-4567', true, 'rus'],
            ['+7-926-123-45-67', true, 'rus'],
            ['+7(926)-123-45-67', true, 'rus'],
            ['+7(926)123-45-67', true, 'rus'],
            ['+7 (926)-123-45 67', true, 'rus'],
            ['+79261234567', true, 'rus'],
            ['8(926)123-45-67', true, 'rus'],
            ['+7(3452)32-62-10', true, 'rus'],

            ['+7(926)123-45   67', false, 'rus'],
            ['87(926)123-45   67', false, 'rus'],
            ['-1(926)123-45 67', false, 'rus'],
            ['-5(926)123-45 67', false, 'rus'],
            ['-5.5(926)123-45 67', false, 'rus'],
            ['-8(926)123-45 67', false, 'rus'],
            ['+8(926)123-45 67', false, 'rus'],
            ['+66(926)123-45 67', false, 'rus'],

            ['1,2', false, 'rus'],
            ['+22322', false, 'rus'],
            [89091823202, true, 'rus'],
            [+89091823202, true, 'rus'],
            [+79091823202, true, 'rus'],
            [+7909182320299999, false, 'rus'],
            ['+7909182320299999asda', false, 'rus'],
            ['+790918232asd0299999asda', false, 'rus'],
            ['+790918232', false, 'rus'],
            ['+79091823202', true, 'rus'],
            ['+34529391039', false, 'rus'],
            ['+79261234567', true, 'rus'],
            ['89261234567', true, 'rus'],
            ['79261234567', true, 'rus'],

            ['123-45-67', false, 'rus'],
            ['9261234567', true, 'rus'],
            ['79261234567', true, 'rus'],
            ['(495)1234567', true, 'rus'],
            ['(495) 123 45 67', true, 'rus'],
            ['89261234567', true, 'rus'],
            ['8-926-123-45-67', true, 'rus'],
            ['8 927 1234 234', false, 'rus'],
            ['8 927 12 12 888', false, 'rus'],
        ];
    }

    public function additionProviderTestPhoneRusClear()
    {
        return [
            ['+7 926 123 45 67', true, 'rus'],
            ['+7 (926) 123 45 67', true, 'rus'],
            ['+7 (926)-123 45 67', true, 'rus'],
            ['+7 (926)-123-45 67', true, 'rus'],
            ['+7 (926)-123-45-67', true, 'rus'],
            ['+7 (926)-123-4567', true, 'rus'],
            ['+7 (926)-12345-67', true, 'rus'],
            ['+7 (926)-1234567', true, 'rus'],
            ['+7 (926)1234567', true, 'rus'],
            ['+7926-123-4567', true, 'rus'],
            ['+7-926-123-45-67', true, 'rus'],
            ['+7(926)-123-45-67', true, 'rus'],
            ['+7(926)123-45-67', true, 'rus'],
            ['+7 (926)-123-45 67', true, 'rus'],
            ['+79261234567', true, 'rus'],
            ['8(926)123-45-67', true, 'rus'],
            ['+7(3452)32-62-10', true, 'rus'],

            ['+7(926)123-45   67', true, 'rus'],
            ['87(926)123-45   67', false, 'rus'],
            ['-1(926)123-45 67', false, 'rus'],
            ['-5(926)123-45 67', false, 'rus'],
            ['-5.5(926)123-45 67', false, 'rus'],
            ['-8(926)123-45 67', true, 'rus'],
            ['+8(926)123-45 67', true, 'rus'],
            ['+66(926)123-45 67', false, 'rus'],

            ['1,2', false, 'rus'],
            ['+22322', false, 'rus'],
            [89091823202, true, 'rus'],
            [+89091823202, true, 'rus'],
            [+79091823202, true, 'rus'],
            [+7909182320299999, false, 'rus'],
            ['+7909182320299999asda', false, 'rus'],
            ['+790918232asd0299999asda', false, 'rus'],
            ['+790918232', false, 'rus'],
            ['+79091823202', true, 'rus'],
            ['+34529391039', false, 'rus'],
            ['+79261234567', true, 'rus'],
            ['89261234567', true, 'rus'],
            ['79261234567', true, 'rus'],

            ['123-45-67', false, 'rus'],
            ['9261234567', false, 'rus'],
            ['79261234567', true, 'rus'],
            ['(495)1234567', false, 'rus'],
            ['(495) 123 45 67', false, 'rus'],
            ['89261234567', true, 'rus'],
            ['8-926-123-45-67', true, 'rus'],
            ['8 927 1234 234', true, 'rus'],
            ['8 927 12 12 888', true, 'rus'],
        ];
    }
}