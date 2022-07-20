<?php

namespace OldOak\EasyValidator\Rule\Rulebooks;


use OldOak\EasyValidator\Common\Config;
use OldOak\EasyValidator\Common\Constant;
use OldOak\EasyValidator\Common\Helper;
use OldOak\EasyValidator\Rule\AbstractRulebook;

/**
 * Class Phone
 * @package OldOak\EasyValidator\Rules\Rulebooks
 */
class Phone extends AbstractRulebook
{
    protected $allowedLocationPhone = [

        /*Австралия*/
        'aus' => '/^\({0,1}((0|\+61)(2|4|3|7|8)){0,1}\){0,1}(\ |-){0,1}[0-9]{2}(\ |-){0,1}[0-9]{2}(\ |-){0,1}[0-9]{1}(\ |-){0,1}[0-9]{3}$/',

        /*Бельгия*/
        'bel' => '/^(BE){0,1}[0]{0,1}[0-9]{9}$/',

        //Болгария Тоже попробовать - (/(\+)?(359|0)8[789]\d{1}(|-| )\d{3}(|-| )\d{3}/) //TODO Тестировать
        'bgr' => '/^((?:\+?3|0)6)(?:-|\()?(\d{1,2})(?:-|\))?(\d{3})-?(\d{3,4})|((\+359|0)\s?8(\d{2}\s\d{3}\d{3}|[789]\d{7}))$/',

        /*Великобритания*/
        'gbr' => '/^(((\+44\s?\d{4}|\(?0\d{4}\)?)\s?\d{3}\s?\d{3})|((\+44\s?\d{3}|\(?0\d{3}\)?)\s?\d{3}\s?\d{4})|((\+44\s?\d{2}|\(?0\d{2}\)?)\s?\d{4}\s?\d{4}))(\s?\#(\d{4}|\d{3}))?$/',

        //Россия
        'rus' => '/^(\+7|7|8)?[\s\-]?(\(?([3489][0-9]{3})\)?[\s\-]?([0-9]{2})|\(?([0-9]{3})\)?[\s\-]?([0-9]{3}))[\s\-]?([0-9]{2})[\s\-]?([0-9]{2})$/',

        //Украина TODO Тестировать
        'ukr' => '/^(?<!\w)(?:(?:(?:(?:\+?3)?8\W{0,5})?0\W{0,5})?[34569]\s?\d[^\w,;(\+]{0,5})?\d\W{0,5}\d\W{0,5}\d\W{0,5}\d\W{0,5}\d\W{0,5}\d\W{0,5}\d(?!(\W?\d))/x/',

        //Казахстан
//        'kaz' => '//',

        //Туркмения
//        'tkm' => '//',

        //Узбекистан
//        'uzb' => '//',

        /*США*/
        'usa' => '/^(?:\([2-9]\d{2}\)\ ?|[2-9]\d{2}(?:\-?|\ ?))[2-9]\d{2}[- ]?\d{4}$/',

        /*Израиль*///TODO ПРОТЕСТИРОВАТь
        'isr' => '/^(\+?972(\-)?0?[23489]{1}(\-)?[^0\D]{1}\d{6})|(0?(5[024])(\-)?\d{7})$/',

        /*Индия*/
        'ind' => '/^([+]39)?((38[{8,9}|0])|(34[{7-9}|0])|(36[6|8|0])|(33[{3-9}|0])|(32[{8,9}]))([\d]{7})$/',

        /*Италия*/
        'ita' => '/^([0-9]*\-?\ ?\/?[0-9]*)$/',

        /*Перу*/
        'per' => '/^([2-9])(\d{2})(-?|\040?)(\d{4})( ?|\040?)(\d{1,4}?|\040?)$/',

        /*Южная африка*/
        'caf' => '/[0](\d{9})|([0](\d{2})( |-)((\d{3}))( |-)(\d{4}))|[0](\d{2})( |-)(\d{7})/',

        /*Испания*/
        'esp' => '/^[0-9]{2,3}-? ?[0-9]{6,7}$/',

        /*Швеция*/
        'swe' => '/^(([+]\d{2}[ ][1-9]\d{0,2}[ ])|([0]\d{1,3}[-]))((\d{2}([ ]\d{2}){2})|(\d{3}([ ]\d{3})*([ ]\d{2})+))$/',

        /*Франция*/
        'fra' => '/^0[1-6]{1}(([0-9]{2}){4})|((\s[0-9]{2}){4})|((-[0-9]{2}){4})$/',

        /*Нидерланды (голандия)*/
        'nld' => '/(^\+[0-9]{2}|^\+[0-9]{2}\(0\)|^\(\+[0-9]{2}\)\(0\)|^00[0-9]{2}|^0)([0-9]{9}$|[0-9\-\s]{10}$)/',

        /*Дания*/
        'dnk' => '/^((\(?\+45\)?)?)(\s?\d{2}\s?\d{2}\s?\d{2}\s?\d{2})$/',

    ];

    protected $arRegexLocationPhoneClear = [

        //Россия
        'rus' => '/^(7|8)(\d{10})$/',
    ];

    /**
     * Метод проверяет, является ли значение <b>$this->value</b> номером телефона, если <b>$this->comparison_value</b> не пустой, то будет проверяться именно эти коды страны <br>
     * Данные проходящие валидацию: string
     * <br>
     *
     * Пример:
     * 'Название_ключа_для_проверки' => 'phone(:краткий_код_страны или :[перечисление краткий_код_страны через |(прямая черта)]])'
     * ['test' => 'phone', 'test1' => 'phone:rus', 'test2' => 'phone:[rus|ukr]']
     *
     * @return bool
     */
    public function validate()
    {
        $value = $this->value;
        $firstCheck = is_numeric($value) || is_string($value);
        if(!$firstCheck) {
            $this->codeResult = Constant::NOT_PHONE;
            return false;
        }

        $isValidate = false;

        $isClearPhone = Config::getConfigByCode(Config::RULEBOOK_PHONE_SYSTEM_CODE);
        $allowedPhone = $isClearPhone ? $this->arRegexLocationPhoneClear : $this->allowedLocationPhone;
        if($isClearPhone) {
            $value = preg_replace('/\D/', '', $value);
        }

        $location = $this->comparison_value;
        if ($location !== null) {
            $firstAllowed = '[';
            $lastAllowed = ']';

            $location = trim($location);

            $first = $location[0];
            $last = substr($location, -1);


            if ($first !== false && $first === $firstAllowed && $last !== false && $last === $lastAllowed) {
                $location = substr($location, 1, -1);

                $matchesLocation = preg_split("/[\|]{1}/", $location);

                if (!is_array($matchesLocation) || count($matchesLocation) < 1) {
                    $isValidate = false;
                } else {
                    $isValidate = false;

                    foreach ($matchesLocation as $code) {

                        if (!Helper::arrayCheck($allowedPhone, $code)) {
                            $isValidate = false;
                        }

                        if (preg_match($allowedPhone[$code], $value) === 1) {
                            $isValidate = true;
                            break;
                        }
                    }
                }
            }  else if (preg_match($allowedPhone[$location], $value) === 1) {
                $isValidate = true;
            }

        } else {
            $isValidate = false;

            foreach ($allowedPhone as $code => $pattern) {
                if (is_string($code) && preg_match($pattern, $value) === 1) {
                    $isValidate = true;
                    break;
                }
            }
        }

        $this->codeResult = $isValidate ? Constant::IS_PHONE : Constant::NOT_PHONE;
        return $isValidate;
    }
}