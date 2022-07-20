<?php

use PHPUnit\Framework\TestCase;

class PluralityTest extends TestCase
{
    /**
     * @dataProvider additionProviderPrimitive
     */
    public function testPlurality($value, $value2)
    {
        $obj = new \OldOak\EasyValidator\Validator(['test' => ["plurality"]], ['test' => $value]);

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

    public function additionProviderPrimitive()
    {
        return [
            ['1,2', false],
            ['<?php 123:22213?>', false],
            ["<?php echo '123:22213' ?>", false],
            [2.12, false],
            [222%1, false],
            [0, false],
            [-5, false],
            [-5.5, false],
            [-0, false],
            [123, false],
            ['0', false],
            [true, false],
            [new \stdClass(), false],
            [new CheckPlurality(), true],
            [static function() {return false;}, false],
            ['NULL', false],
            ['false', false],
            ['true', false],
            ['2.3', false],
            [fopen("http://www.example.com/", "r"), false],
            ['-----', false],

            [false, false],
            ['', false],
            [array(), true],
            [array(123), true],
            [array('test' => 'test'), true],
            [null, false],
        ];
    }
}

class CheckPlurality implements ArrayAccess{

    /**
     * Whether a offset exists
     * @link https://php.net/manual/en/arrayaccess.offsetexists.php
     * @param mixed $offset <p>
     * An offset to check for.
     * </p>
     * @return boolean true on success or false on failure.
     * </p>
     * <p>
     * The return value will be casted to boolean if non-boolean was returned.
     * @since 5.0.0
     */
    public function offsetExists($offset)
    {
        // TODO: Implement offsetExists() method.
    }

    /**
     * Offset to retrieve
     * @link https://php.net/manual/en/arrayaccess.offsetget.php
     * @param mixed $offset <p>
     * The offset to retrieve.
     * </p>
     * @return mixed Can return all value types.
     * @since 5.0.0
     */
    public function offsetGet($offset)
    {
        // TODO: Implement offsetGet() method.
    }

    /**
     * Offset to set
     * @link https://php.net/manual/en/arrayaccess.offsetset.php
     * @param mixed $offset <p>
     * The offset to assign the value to.
     * </p>
     * @param mixed $value <p>
     * The value to set.
     * </p>
     * @return void
     * @since 5.0.0
     */
    public function offsetSet($offset, $value)
    {
        // TODO: Implement offsetSet() method.
    }

    /**
     * Offset to unset
     * @link https://php.net/manual/en/arrayaccess.offsetunset.php
     * @param mixed $offset <p>
     * The offset to unset.
     * </p>
     * @return void
     * @since 5.0.0
     */
    public function offsetUnset($offset)
    {
        // TODO: Implement offsetUnset() method.
    }
}