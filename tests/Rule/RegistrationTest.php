<?php

use OldOak\EasyValidator\Rule\Registration;

class RegistrationTest extends PHPUnit_Framework_TestCase
{

    /**
     * @param $name
     * @param $class
     * @param $result
     *
     * @dataProvider additionProviderTestAddCustomRule
     */
    public function testAddCustomRule($name, $class, $result)
    {
        try {
            Registration::addCustomRule($name, $class);
            $newAddClass = Registration::getCustomRuleByName($name);
            $this->assertNotEmpty($newAddClass);

        } catch (\OldOak\EasyValidator\Common\ValidatorException $e) {
            if (!$result) {
                $this->assertTrue(true);
            }
        }
    }

    public function additionProviderTestAddCustomRule()
    {
        return [
            ['new', 'hi', false],
            ['alarm', [], false],
            ['test', 123, false],
            ['alarmOne', new \StdClass(), false],
            ['alarmTwo', static function() {return false;}, false],
            ['testRule', TestRule::class, true],
            ['testTestRule', TestTestRule::class, true],
        ];
    }

    /**
     * @param $rules
     *
     * @dataProvider additionProviderTestSetCustomRules
     */
    public function testSetCustomRules($name, $class, $result)
    {
        try {
            $setRules = [
                $name => $class,
            ];
            Registration::setCustomRules($setRules);
            $newAddClass = Registration::getCustomRuleByName($name);
            $this->assertNotEmpty($newAddClass);

        } catch (\OldOak\EasyValidator\Common\ValidatorException $e) {
            if (!$result) {
                $this->assertTrue(true);
            }
        }
    }

    public function additionProviderTestSetCustomRules()
    {
        return $this->additionProviderTestAddCustomRule();
    }

    /**
     * @dataProvider additionProviderGetCustomRuleByName
     * @depends testSetCustomRules
     */
    public function testGetCustomRuleByName($name, $result)
    {
        $newAddClass = Registration::getCustomRuleByName($name);
        if($newAddClass === null && $result === false) {
            $this->assertTrue(true);
        } elseif ($newAddClass !== null && $result === true) {
            $this->assertTrue(true);
        }
    }

    public function additionProviderGetCustomRuleByName()
    {
        return [
            ['new', false],
            ['alarm', false],
            ['test', false],
            ['alarmOne', false],
            ['alarmTwo', false],
            ['testRule', true],
            ['testTestRule', true],
        ];
    }
}

class TestRule extends \OldOak\EasyValidator\Rule\AbstractRulebook
{

    /**
     * Метод проверки
     * @return bool
     */
    public function validate()
    {
        return true;
    }
}

class TestTestRule extends TestRule
{
    public function validate()
    {
        return false;
    }
}
