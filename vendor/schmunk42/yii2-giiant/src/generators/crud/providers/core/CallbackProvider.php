<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see https://repo.art-er.it Developers' community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    arter
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

/**
 */
namespace schmunk42\giiant\generators\crud\providers\core;

class CallbackProvider extends \schmunk42\giiant\base\Provider
{
    public $activeFields = [];
    public $prependActiveFields = [];
    public $appendActiveFields = [];
    public $attributeFormats = [];
    public $columnFormats = [];
    public $partialViews = [];

    public function activeField($attribute, $model, $generator)
    {
        $key = $this->findValue($this->getModelKey($attribute, $model), $this->activeFields);
        if ($key) {
            return $this->activeFields[$key]($attribute, $model, $generator);
        }
    }

    public function prependActiveField($attribute, $model, $generator)
    {
        $key = $this->findValue($this->getModelKey($attribute, $model), $this->prependActiveFields);
        if ($key) {
            return $this->prependActiveFields[$key]($attribute, $model, $generator);
        }
    }

    public function appendActiveField($attribute, $model, $generator)
    {
        $key = $this->findValue($this->getModelKey($attribute, $model), $this->appendActiveFields);
        if ($key) {
            return $this->appendActiveFields[$key]($attribute, $model, $generator);
        }
    }

    public function attributeFormat($attribute, $model, $generator)
    {
        $key = $this->findValue($this->getModelKey($attribute, $model), $this->attributeFormats);
        if ($key) {
            return $this->attributeFormats[$key]($attribute, $model, $generator);
        }
    }

    public function columnFormat($attribute, $model, $generator)
    {
        $key = $this->findValue($this->getModelKey($attribute, $model), $this->columnFormats);
        if ($key) {
            return $this->columnFormats[$key]($attribute, $model, $generator);
        }
    }

    public function partialView($name, $model, $generator)
    {
        $key = $this->findValue($this->getModelKey($name, $model), $this->partialViews);
        if ($key) {
            return $this->partialViews[$key]($name, $model, $generator);
        }
    }

    private function getModelKey($attribute, $model)
    {
        return $model::className().'.'.$attribute;
    }

    private function findValue($subject, $array)
    {
        foreach ($array as $key => $value) {
            if (preg_match('/'.$key.'/', $subject)) {
                return $key;
            }
        }
    }
}
