<?php

use PHPUnit\Framework\TestCase;

class UrlTest extends TestCase
{
    /**
     * @dataProvider additionProviderPrimitive
     * @dataProvider additionProviderInvalidUrl
     * @dataProvider additionProviderValidUrl
     */
    public function testUrl($value, $value2, $value3 = null)
    {
        if ($value3 === null) {
            $arRules = ['test' => ["url"]];
        } else {
            $arRules = ['test' => ["url:{$value3}"]];
        }

        $obj = new \OldOak\EasyValidator\Validator($arRules, ['test' => $value]);

        try {
            $result = $obj->validate()->result;
            if ($value2 === true) {
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

    public function additionProviderPrimitive()
    {
        return [
            [false, false],
            [true, false],

            ['false', false],
            ['true', false],

            ['1,2', false],
            ['<?php 123:22213?>', false],
            ["<?php echo '123:22213' ?>", false],
            [2.12, false],
            [-2.12, false],
            [222%1, false],
            [0, false],
            [55, false],
            [-15, false],
            ['-15', false],
            [[123], false],
            ['0', false],
            ['22', false],

            [array(), false],
            [new \stdClass(), false],
            [null, false],

            ['2.3', false],
            ['28.09.2019', false],
            [static function(){return 1;}, false],
            [fopen("http://www.example.com/", "rb"), false],

            [222%1, false, 111],
            [0, false, 0],
            [55, false, 43],
            [-15, false, '-15'],
            [-15, false, -15],
            ['0', false, '15'],
            ['0', false, 15],
            ['5', false, 5],
        ];
    }

    public function additionProviderInvalidUrl()
    {
        return [
            ['test,com', false],
            ['test;com,ru', false],
            ['test;api,domain.com', false],
            ['test-api,domain_uk.org', false],

        ];
    }

    public function additionProviderValidUrl()
    {
        return [
            ['test.com', true],
            ['test.com.ru', true],
            ['test.uk.org', true],
            ['test.api.domain.com', true],
            ['test.api.domain.uk.org', true],
            ['тестовый.рф', true],
            ['тестовый.ru', true],

            'valid_http1' => ['http://test.com', true],
            'valid_http2' => ['http://test.com.ru', true],
            'valid_http3' => ['http://test.uk.org', true],
            'valid_http4' => ['http://test.api.domain.com', true],
            'valid_http5' => ['http://test.api.domain.uk.org', true],
            'valid_http6' => ['http://тестовый.рф', true],
            'valid_http7' => ['http://тестовый.тестовый.ru', true],

            'valid_https1' => ['https://test.com', true],
            'valid_https2' => ['https://test.com.ru', true],
            'valid_https3' => ['https://test.uk.org', true],
            'valid_https4' => ['https://test.api.domain.com', true],
            'valid_https5' => ['https://test.api.domain.uk.org', true],
            'valid_https6' => ['https://тестовый.рф', true],
            'valid_https7' => ['https://тестовый.тестовый.ru', true],

            'valid_http_www1' => ['http://www.test.com', true],
            'valid_http_www2' => ['http://www.test.com.ru', true],
            'valid_http_www3' => ['http://www.test.uk.org', true],
            'valid_http_www4' => ['http://www.test.api.domain.com', true],
            'valid_http_www5' => ['http://www.test.api.domain.uk.org', true],
            'valid_http_www6' => ['http://www.тестовый.рф', true],
            'valid_http_www7' => ['http://www.тестовый.тестовый.ru', true],

            'valid_https1_www' => ['https://www.test.com', true],
            'valid_https2_www' => ['https://www.test.com.ru', true],
            'valid_https3_www' => ['https://www.test.uk.org', true],
            'valid_https4_www' => ['https://www.test.api.domain.com', true],
            'valid_https5_www' => ['https://www.test.api.domain.uk.org', true],
            'valid_https6_www' => ['https://www.тестовый.рф', true],
            'valid_https7_www' => ['https://www.тестовый.тестовый.ru', true],

            'valid_http_api1' => ['http://api.test.com', true],
            'valid_http_api2' => ['http://api.test.com.ru', true],
            'valid_http_api3' => ['http://api.test.uk.org', true],
            'valid_http_api4' => ['http://api.test.api.domain.com', true],
            'valid_http_api5' => ['http://api.test.api.domain.uk.org', true],
            'valid_http_api6' => ['http://апи.тестовый.рф', true],
            'valid_http_api7' => ['http://апи.тестовый.тестовый.ru', true],

            'valid_https_api1' => ['https://api.test.com', true],
            'valid_https_api2' => ['https://api.test.com.ru', true],
            'valid_https_api3' => ['https://api.test.uk.org', true],
            'valid_https_api4' => ['https://api.test.api.domain.com', true],
            'valid_https_api5' => ['https://api.test.api.domain.uk.org', true],
            'valid_https_api6' => ['https://апи.тестовый.рф', true],
            'valid_https_api7' => ['https://апи.тестовый.тестовый.ru', true],

            'valid_http_www_api1' => ['http://www.api.test.com', true],
            'valid_http_www_api2' => ['http://www.api.test.com.ru', true],
            'valid_http_www_api3' => ['http://www.api.test.uk.org', true],
            'valid_http_www_api4' => ['http://www.api.test.api.domain.com', true],
            'valid_http_www_api5' => ['http://www.api.test.api.domain.uk.org', true],
            'valid_http_www_api6' => ['http://www.апи.тестовый.рф', true],
            'valid_http_www_api7' => ['http://www.апи.тестовый.тестовый.ru', true],

            'valid_https_www_api1' => ['https://www.api.test.com', true],
            'valid_https_www_api2' => ['https://www.api.test.com.ru', true],
            'valid_https_www_api3' => ['https://www.api.test.uk.org', true],
            'valid_https_www_api4' => ['https://www.api.test.api.domain.com', true],
            'valid_https_www_api5' => ['https://www.api.test.api.domain.uk.org', true],
            'valid_https_www_api6' => ['https://www.апи.тестовый.рф', true],
            'valid_https_www_api7' => ['https://www.апи.тестовый.тестовый.ru', true],

            'valid_http_sub1' => ['http://test.com/sub/page', true],
            'valid_http_sub2' => ['http://test.com.ru/sub/page', true],
            'valid_http_sub3' => ['http://test.uk.org/sub/page', true],
            'valid_http_sub4' => ['http://test.api.domain.com/sub/page', true],
            'valid_http_sub5' => ['http://test.api.domain.uk.org/sub/page', true],
            'valid_http_sub6' => ['http://тестовый.рф/sub/page', true],
            'valid_http_sub7' => ['http://тестовый.тестовый.ru/sub/page', true],

            'valid_https_sub1' => ['https://test.com/sub/page', true],
            'valid_https_sub2' => ['https://test.com.ru/sub/page', true],
            'valid_https_sub3' => ['https://test.uk.org/sub/page', true],
            'valid_https_sub4' => ['https://test.api.domain.com/sub/page', true],
            'valid_https_sub5' => ['https://test.api.domain.uk.org/sub/page', true],
            'valid_https_sub6' => ['https://тестовый.рф/sub/page', true],
            'valid_https_sub7' => ['https://тестовый.тестовый.ru/sub/page', true],

            'valid_http_www_sub1' => ['http://www.test.com/sub/page', true],
            'valid_http_www_sub2' => ['http://www.test.com.ru/sub/page', true],
            'valid_http_www_sub3' => ['http://www.test.uk.org/sub/page', true],
            'valid_http_www_sub4' => ['http://www.test.api.domain.com/sub/page', true],
            'valid_http_www_sub5' => ['http://www.test.api.domain.uk.org/sub/page', true],
            'valid_http_www_sub6' => ['http://www.тестовый.рф/sub/page', true],
            'valid_http_www_sub7' => ['http://www.тестовый.тестовый.ru/sub/page', true],

            'valid_https_www_sub1' => ['https://www.test.com/sub/page', true],
            'valid_https_www_sub2' => ['https://www.test.com.ru/sub/page', true],
            'valid_https_www_sub3' => ['https://www.test.uk.org/sub/page', true],
            'valid_https_www_sub4' => ['https://www.test.api.domain.com/sub/page', true],
            'valid_https_www_sub5' => ['https://www.test.api.domain.uk.org/sub/page', true],
            'valid_https_www_sub6' => ['https://www.тестовый.рф/sub/page', true],
            'valid_https_www_sub7' => ['https://www.тестовый.тестовый.ru/sub/page', true],

            'valid_http_api_sub1' => ['http://api.test.com/sub/page', true],
            'valid_http_api_sub2' => ['http://api.test.com.ru/sub/page', true],
            'valid_http_api_sub3' => ['http://api.test.uk.org/sub/page', true],
            'valid_http_api_sub4' => ['http://api.test.api.domain.com/sub/page', true],
            'valid_http_api_sub5' => ['http://api.test.api.domain.uk.org/sub/page', true],
            'valid_http_api_sub6' => ['http://апи.тестовый.рф/sub/page', true],
            'valid_http_api_sub7' => ['http://апи.тестовый.тестовый.ru/sub/page', true],

            'valid_https_api_sub1' => ['https://api.test.com/sub/page', true],
            'valid_https_api_sub2' => ['https://api.test.com.ru/sub/page', true],
            'valid_https_api_sub3' => ['https://api.test.uk.org/sub/page', true],
            'valid_https_api_sub4' => ['https://api.test.api.domain.com/sub/page', true],
            'valid_https_api_sub5' => ['https://api.test.api.domain.uk.org/sub/page', true],
            'valid_https_api_sub6' => ['https://апи.тестовый.рф/sub/page', true],
            'valid_https_api_sub7' => ['https://апи.тестовый.тестовый.ru/sub/page', true],

            'valid_http_www_api_sub1' => ['http://www.api.test.com/sub/page', true],
            'valid_http_www_api_sub2' => ['http://www.api.test.com.ru/sub/page', true],
            'valid_http_www_api_sub3' => ['http://www.api.test.uk.org/sub/page', true],
            'valid_http_www_api_sub4' => ['http://www.api.test.api.domain.com/sub/page', true],
            'valid_http_www_api_sub5' => ['http://www.api.test.api.domain.uk.org/sub/page', true],
            'valid_http_www_api_sub6' => ['http://www.апи.тестовый.рф/sub/page', true],
            'valid_http_www_api_sub7' => ['http://www.апи.тестовый.тестовый.ru/sub/page', true],

            'valid_https_www_api_sub1' => ['https://www.api.test.com/sub/page', true],
            'valid_https_www_api_sub2' => ['https://www.api.test.com.ru/sub/page', true],
            'valid_https_www_api_sub3' => ['https://www.api.test.uk.org/sub/page', true],
            'valid_https_www_api_sub4' => ['https://www.api.test.api.domain.com/sub/page', true],
            'valid_https_www_api_sub5' => ['https://www.api.test.api.domain.uk.org/sub/page', true],
            'valid_https_www_api_sub6' => ['https://www.апи.тестовый.рф/sub/page', true],
            'valid_https_www_api_sub7' => ['https://www.апи.тестовый.тестовый.ru/sub/page', true],

            'valid_http1_get' => ['http://test.com/?test=hi', true],
            'valid_http2_get' => ['http://test.com.ru?test=hi#sharp', true],
            'valid_http3_get' => ['http://test.uk.org?test=hi&new=yes', true],
            'valid_http4_get' => ['http://test.api.domain.com?test=hi', true],
            'valid_http5_get' => ['http://test.api.domain.uk.org?test=hi', true],
            'valid_http6_get' => ['http://тестовый.рф?test=hi', true],
            'valid_http7_get' => ['http://тестовый.тестовый.ru?test=hi&new=1', true],

            'valid_https_get1' => ['https://test.com/?test=hi', true],
            'valid_https_get2' => ['https://test.com.ru?test=hi#sharp', true],
            'valid_https_get3' => ['https://test.uk.org?test=hi&new=yes', true],
            'valid_https_get4' => ['https://test.api.domain.com?test=hi', true],
            'valid_https_get5' => ['https://test.api.domain.uk.org?test=hi', true],
            'valid_https_get6' => ['https://тестовый.рф?test=hi', true],
            'valid_https_get7' => ['https://тестовый.тестовый.ru?test=hi&new=1', true],

            'valid_http_www_get1' => ['http://www.test.com/?test=hi', true],
            'valid_http_www_get2' => ['http://www.test.com.ru?test=hi#sharp', true],
            'valid_http_www_get3' => ['http://www.test.uk.org?test=hi&new=yes', true],
            'valid_http_www_get4' => ['http://www.test.api.domain.com?test=hi', true],
            'valid_http_www_get5' => ['http://www.test.api.domain.uk.org?test=hi', true],
            'valid_http_www_get6' => ['http://www.тестовый.рф?test=hi', true],
            'valid_http_www_get7' => ['http://www.тестовый.тестовый.ru?test=hi&new=1', true],

            'valid_https_www_get1' => ['https://www.test.com/?test=hi', true],
            'valid_https_www_get2' => ['https://www.test.com.ru?test=hi#sharp', true],
            'valid_https_www_get3' => ['https://www.test.uk.org?test=hi&new=yes', true],
            'valid_https_www_get4' => ['https://www.test.api.domain.com?test=hi', true],
            'valid_https_www_get5' => ['https://www.test.api.domain.uk.org?test=hi', true],
            'valid_https_www_get6' => ['https://www.тестовый.рф?test=hi', true],
            'valid_https_www_get7' => ['https://www.тестовый.тестовый.ru?test=hi&new=1', true],

            'valid_http_api_get1' => ['http://api.test.com/?test=hi', true],
            'valid_http_api_get2' => ['http://api.test.com.ru?test=hi#sharp', true],
            'valid_http_api_get3' => ['http://api.test.uk.org?test=hi&new=yes', true],
            'valid_http_api_get4' => ['http://api.test.api.domain.com?test=hi', true],
            'valid_http_api_get5' => ['http://api.test.api.domain.uk.org?test=hi', true],
            'valid_http_api_get6' => ['http://апи.тестовый.рф?test=hi', true],
            'valid_http_api_get7' => ['http://апи.тестовый.тестовый.ru?test=hi&new=1', true],

            'valid_https_api_get1' => ['https://api.test.com/?test=hi', true],
            'valid_https_api_get2' => ['https://api.test.com.ru?test=hi#sharp', true],
            'valid_https_api_get3' => ['https://api.test.uk.org?test=hi&new=yes', true],
            'valid_https_api_get4' => ['https://api.test.api.domain.com?test=hi', true],
            'valid_https_api_get5' => ['https://api.test.api.domain.uk.org?test=hi', true],
            'valid_https_api_get6' => ['https://апи.тестовый.рф?test=hi', true],
            'valid_https_api_get7' => ['https://апи.тестовый.тестовый.ru?test=hi&new=1', true],

            'valid_http_www_api_get1' => ['http://www.api.test.com/?test=hi', true],
            'valid_http_www_api_get2' => ['http://www.api.test.com.ru?test=hi#sharp', true],
            'valid_http_www_api_get3' => ['http://www.api.test.uk.org?test=hi&new=yes', true],
            'valid_http_www_api_get4' => ['http://www.api.test.api.domain.com?test=hi', true],
            'valid_http_www_api_get5' => ['http://www.api.test.api.domain.uk.org?test=hi', true],
            'valid_http_www_api_get6' => ['http://www.апи.тестовый.рф?test=hi', true],
            'valid_http_www_api_get7' => ['http://www.апи.тестовый.тестовый.ru?test=hi&new=1', true],

            'valid_https_www_api_get1' => ['https://www.api.test.com/?test=hi', true],
            'valid_https_www_api_get2' => ['https://www.api.test.com.ru?test=hi#sharp', true],
            'valid_https_www_api_get3' => ['https://www.api.test.uk.org?test=hi&new=yes', true],
            'valid_https_www_api_get4' => ['https://www.api.test.api.domain.com?test=hi', true],
            'valid_https_www_api_get5' => ['https://www.api.test.api.domain.uk.org?test=hi', true],
            'valid_https_www_api_get6' => ['https://www.апи.тестовый.рф?test=hi', true],
            'valid_https_www_api_get7' => ['https://www.апи.тестовый.тестовый.ru?test=hi&new=1', true],

            'valid_http_sub_get1' => ['http://test.com/sub/page/?test=hi', true],
            'valid_http_sub_get2' => ['http://test.com.ru/sub/page?test=hi#sharp', true],
            'valid_http_sub_get3' => ['http://test.uk.org/sub/page?test=hi&new=yes', true],
            'valid_http_sub_get4' => ['http://test.api.domain.com/sub/page?test=hi', true],
            'valid_http_sub_get5' => ['http://test.api.domain.uk.org/sub/page?test=hi', true],
            'valid_http_sub_get6' => ['http://тестовый.рф/sub/page?test=hi', true],
            'valid_http_sub_get7' => ['http://тестовый.тестовый.ru/sub/page?test=hi&new=1', true],

            'valid_https_sub_get1' => ['https://test.com/sub/page/?test=hi', true],
            'valid_https_sub_get2' => ['https://test.com.ru/sub/page?test=hi#sharp', true],
            'valid_https_sub_get3' => ['https://test.uk.org/sub/page?test=hi&new=yes', true],
            'valid_https_sub_get4' => ['https://test.api.domain.com/sub/page?test=hi', true],
            'valid_https_sub_get5' => ['https://test.api.domain.uk.org/sub/page?test=hi', true],
            'valid_https_sub_get6' => ['https://тестовый.рф/sub/page?test=hi', true],
            'valid_https_sub_get7' => ['https://тестовый.тестовый.ru/sub/page?test=hi&new=1', true],

            'valid_http_www_sub_get1' => ['http://www.test.com/sub/page/?test=hi', true],
            'valid_http_www_sub_get2' => ['http://www.test.com.ru/sub/page?test=hi#sharp', true],
            'valid_http_www_sub_get3' => ['http://www.test.uk.org/sub/page?test=hi&new=yes', true],
            'valid_http_www_sub_get4' => ['http://www.test.api.domain.com/sub/page?test=hi', true],
            'valid_http_www_sub_get5' => ['http://www.test.api.domain.uk.org/sub/page?test=hi', true],
            'valid_http_www_sub_get6' => ['http://www.тестовый.рф/sub/page?test=hi', true],
            'valid_http_www_sub_get7' => ['http://www.тестовый.тестовый.ru/sub/page?test=hi&new=1', true],

            'valid_https_www_sub_get1' => ['https://www.test.com/sub/page/?test=hi', true],
            'valid_https_www_sub_get2' => ['https://www.test.com.ru/sub/page?test=hi#sharp', true],
            'valid_https_www_sub_get3' => ['https://www.test.uk.org/sub/page?test=hi&new=yes', true],
            'valid_https_www_sub_get4' => ['https://www.test.api.domain.com/sub/page?test=hi', true],
            'valid_https_www_sub_get5' => ['https://www.test.api.domain.uk.org/sub/page?test=hi', true],
            'valid_https_www_sub_get6' => ['https://www.тестовый.рф/sub/page?test=hi', true],
            'valid_https_www_sub_get7' => ['https://www.тестовый.тестовый.ru/sub/page?test=hi&new=1', true],

            'valid_http_api_sub_get1' => ['http://api.test.com/sub/page/?test=hi', true],
            'valid_http_api_sub_get2' => ['http://api.test.com.ru/sub/page?test=hi#sharp', true],
            'valid_http_api_sub_get3' => ['http://api.test.uk.org/sub/page?test=hi&new=yes', true],
            'valid_http_api_sub_get4' => ['http://api.test.api.domain.com/sub/page?test=hi', true],
            'valid_http_api_sub_get5' => ['http://api.test.api.domain.uk.org/sub/page?test=hi', true],
            'valid_http_api_sub_get6' => ['http://апи.тестовый.рф/sub/page?test=hi', true],
            'valid_http_api_sub_get7' => ['http://апи.тестовый.тестовый.ru/sub/page?test=hi&new=1', true],

            'valid_https_api_sub_get1' => ['https://api.test.com/sub/page/?test=hi', true],
            'valid_https_api_sub_get2' => ['https://api.test.com.ru/sub/page?test=hi#sharp', true],
            'valid_https_api_sub_get3' => ['https://api.test.uk.org/sub/page?test=hi&new=yes', true],
            'valid_https_api_sub_get4' => ['https://api.test.api.domain.com/sub/page?test=hi', true],
            'valid_https_api_sub_get5' => ['https://api.test.api.domain.uk.org/sub/page?test=hi', true],
            'valid_https_api_sub_get6' => ['https://апи.тестовый.рф/sub/page?test=hi', true],
            'valid_https_api_sub_get7' => ['https://апи.тестовый.тестовый.ru/sub/page?test=hi&new=1', true],

            'valid_http_www_api_sub_get1' => ['http://www.api.test.com/sub/page/?test=hi', true],
            'valid_http_www_api_sub_get2' => ['http://www.api.test.com.ru/sub/page?test=hi#sharp', true],
            'valid_http_www_api_sub_get3' => ['http://www.api.test.uk.org/sub/page?test=hi&new=yes', true],
            'valid_http_www_api_sub_get4' => ['http://www.api.test.api.domain.com/sub/page?test=hi', true],
            'valid_http_www_api_sub_get5' => ['http://www.api.test.api.domain.uk.org/sub/page?test=hi', true],
            'valid_http_www_api_sub_get6' => ['http://www.апи.тестовый.рф/sub/page?test=hi', true],
            'valid_http_www_api_sub_get7' => ['http://www.апи.тестовый.тестовый.ru/sub/page?test=hi&new=1', true],

            'valid_https_www_api_sub_get1' => ['https://www.api.test.com/sub/page/?test=hi', true],
            'valid_https_www_api_sub_get2' => ['https://www.api.test.com.ru/sub/page?test=hi#sharp', true],
            'valid_https_www_api_sub_get3' => ['https://www.api.test.uk.org/sub/page?test=hi&new=yes', true],
            'valid_https_www_api_sub_get4' => ['https://www.api.test.api.domain.com/sub/page?test=hi', true],
            'valid_https_www_api_sub_get5' => ['https://www.api.test.api.domain.uk.org/sub/page?test=hi', true],
            'valid_https_www_api_sub_get6' => ['https://www.апи.тестовый.рф/sub/page?test=hi', true],
            'valid_https_www_api_sub_get7' => ['https://www.апи.тестовый.тестовый.ru/sub/page?test=hi&new=1', true],
        ];
    }
}