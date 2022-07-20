<?php

namespace OldOak\EasyValidator;


/**
 * Class Result
 * @package OldOak\EasyValidator
 */
class Result
{
    public $errors;
    public $notices;
    public $success;

    public function __construct($success = [], $notices = [], $errors = [])
    {
        $this->success = $success;
        $this->notices = $notices;
        $this->errors = $errors;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param $errors
     */
    public function setErrors($errors)
    {
        $this->errors = $errors;
    }

    public function addErrors($key, $value)
    {
        $this->errors[$key] = $value;
    }

    /**
     */
    public function getNotices()
    {
        return $this->notices;
    }

    /**
     * @param $notices
     */
    public function setNotices($notices)
    {
        $this->notices = $notices;
    }

    public function addNotice($key, $value)
    {
        $this->notices[$key] = $value;
    }

    public function getSuccess()
    {
        return $this->success;
    }

    /**
     * @param $success
     */
    public function setSuccess($success)
    {
        $this->success = $success;
    }

    public function addSuccess($key, $value)
    {
        $this->success[$key] = $value;
    }
}