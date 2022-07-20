<?php

use OldOak\EasyValidator\Common\Config;
use OldOak\EasyValidator\Common\Helper;
use OldOak\EasyValidator\Translations\Languages\Ru;
use PHPUnit\Framework\TestCase;

class HelperTest extends TestCase
{


    /**
     * @dataProvider additionProviderTestArrayCheck
     */
    public function testArrayCheck($array, $key, $all_matches, $comparison)
    {
        $this->assertSame(Helper::arrayCheck($array, $key, $all_matches), $comparison);
    }

    public function additionProviderTestArrayCheck()
    {
        return [
            [['method'], null, true, false],
            [['method' => '', 'test' => '', 123 => ''], 123, true, true],
            [['method' => '', 'test' => '', 000 => ''], 123, true, false],

            [['method' => '', 'test' => '', 000 => ''], ['test', 'method'], false, true],
            [['method' => '', 'test' => '', 000 => ''], ['test', 'method'], true, true],

            [['method' => '', 'test' => '', 000 => ''], ['test', '000'], true, false],
            [['method' => '', 'test' => '', 000 => ''], ['od'], true, false],
            [['method' => '', 'test' => '', 000 => ''], ['od', null], false, false],
        ];
    }

    /**
     * @dataProvider additionProviderTestInit
     */
    public function testToCamelCase($value, $comparison)
    {
        $this->assertSame(Helper::toCamelCase($value), $comparison);
    }

    public function additionProviderTestInit()
    {
        return [
            ['method', 'method'],
            ['test_method', 'testMethod'],
            ['test_method123', 'testMethod123'],
            ['test-method', 'testMethod'],
            ['T-E-Asmkad-method', 'tEAsmkadMethod'],
            ['Tes_tme-thod', 'tesTmeThod'],
            [['test','method'], ''],
            [static function(){}, ''],
        ];
    }

    /**
     * @dataProvider additionProviderStudly
     */
    public function testStudly($value, $comparison)
    {
        $this->assertSame(Helper::studly($value), $comparison);
    }

    public function additionProviderStudly()
    {
        return [
            ['method', 'Method'],
            ['test_method', 'TestMethod'],
            ['test_method123', 'TestMethod123'],
            ['test-method', 'TestMethod'],
            ['T-E-Asmkad-method', 'TEAsmkadMethod'],
            ['Tes_tme-thod', 'TesTmeThod'],
            [['test','method'], ''],
            [static function(){}, ''],
        ];
    }
}