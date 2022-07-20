<?php

namespace OldOak\EasyValidator\Rule\Rulebooks;


use OldOak\EasyValidator\Common\Constant;
use OldOak\EasyValidator\Common\Helper;
use OldOak\EasyValidator\Rule\AbstractRulebook;

/**
 * Class File
 * @package OldOak\EasyValidator\Rules\Rulebooks
 */
class File extends AbstractRulebook
{

    public static $mimeTypes;

    /**
     * Метод проверяет, является ли значение <b>$this->value</b> файлом <br>
     * Данные проходящие валидацию: string, resource
     * <br>
     *
     * Пример:
     * 'Название_ключа_для_проверки' => 'file:расширение(я) файлов'
     * ['test' => 'file', 'test' => 'file:jpg', 'test' => 'file:[png|jpg]']
     *
     * @return bool
     */
    public function validate()
    {
        $isValidate = false;
        if (is_string($this->value) || is_resource($this->value) || is_file($this->value)) {

            $fileExtCompare = $this->comparison_value;
            if ($fileExtCompare !== null) {
                if (is_string($this->value)) {
                    $arFileNameParts = explode('.', $this->value);
                    $fileExt = $arFileNameParts[count($arFileNameParts) - 1];
                } else {

                    //Пытаемся получить ресурс файла для его проверки
                    $fileMime = strtolower(mime_content_type($this->value));
                    if(Helper::arrayCheck($this->getMimeTypes()['extensions'], $fileMime)) {
                        $fileExt = $this->getMimeTypes()['extensions'][$fileMime];
                    }
                }

                if (!empty($fileExt)) {
                    $firstAllowed = '[';
                    $lastAllowed = ']';

                    $fileExtCompare = trim($fileExtCompare);
                    $first = $fileExtCompare[0];
                    $last = mb_substr($fileExtCompare, -1);
                    if ($first !== false && $first === $firstAllowed && $last !== false && $last === $lastAllowed) {
                        $fileExtCompareTmp = substr($fileExtCompare, 1, -1);
                        $matches = preg_split("/[\|]{1}/", $fileExtCompareTmp);
                        if ($matches && is_array($matches)) {
                            foreach ($matches as $ext) {
                                if ($fileExt === $ext || (is_array($fileExt) && in_array($ext, $fileExt, true))) {
                                    $isValidate = true;
                                    break;
                                }
                            }
                        } else if ($fileExt === $fileExtCompareTmp || (is_array($fileExt) && in_array($fileExtCompareTmp, $fileExt, true))) {
                            $isValidate = true;
                        }

                    } else if ($fileExt === $this->comparison_value || (is_array($fileExt) && in_array($this->comparison_value, $fileExt, true))) {
                        $isValidate = true;
                    }
                }
            } else if (is_resource($this->value)) {
                $resourceType = get_resource_type($this->value);
                $isValidate = $resourceType === 'stream';
            } else if (is_file($this->value)) {
                $isValidate = true;
            }
        }

        $this->codeResult = $isValidate ? Constant::IS_FILE : Constant::NOT_FILE;
        return $isValidate;
    }

    /**
     * @return mixed
     */
    public function getMimeTypes()
    {
        if(self::$mimeTypes === null) {
            self::$mimeTypes = require(dirname(dirname(__DIR__)) . '/Common/MimeTypes.php');
        }

        return self::$mimeTypes;
    }
}