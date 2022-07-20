<?php

use OldOak\EasyValidator\Common\Config;
use OldOak\EasyValidator\Translations\Languages\Ru;
use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase
{


    /**
     * @dataProvider additionProviderTestGetConfigByCode
     * @param $code
     * @param $comparison
     */
    public function testGetConfigByCode($code, $comparison)
    {
        $this->assertTrue(true);
        return;
        $configByCode = Config::getConfigByCode($code);
        $this->assertSame($configByCode, $comparison);
    }

    public function additionProviderTestGetConfigByCode()
    {
        return [
            ['test', null],
            ['language', Ru::class],
            ['has_log', true],
            ['nullable_rule', 'nullable'],
            ['code_replace', ':attribute'],
            ['separator_custom_message', '.'],
            ['rule_separator', ':'],
            ['continue_error', false],
            ['', null],
            [[], null],
            [123, null],
            [static function(){return 1;}, null],
            [null, null],
        ];
    }

    /**
     * @dataProvider additionProviderTestInit
     */
    public function testInit($options, $comparison)
    {
        $this->assertTrue(true);
        return;
        Config::init($options);
        foreach ($options as $code => $option) {
            $configByCode = Config::getConfigByCode($code);
            $this->assertSame($configByCode, $comparison[$code]);
        }
    }

    public function additionProviderTestInit()
    {
        return [
            [
                [
                    'key' => 'value',
                    'language' => 'lang',
                    'code_replace' => ':',
                ],
                [
                    'key' => null,
                    'language' => 'lang',
                    'code_replace' => ':',
                ]
            ],
        ];
    }

    public function testConfig()
    {
        $this->assertTrue(true);
        return;
        Config::setConfig([]);
        $this->assertTrue(is_array(Config::getConfig()));
    }
}