<?php
/**
 * @User GJKnOcKOuT
 * @Project basic
 * @Date 22/12/2021
 */

namespace backend\modules\supercraft\models;

/**
 * @Class UploadImageForm
 * @Package app\models
 * @Author Aldini Alessandro <alessandro.aldini@outlook.it>
 */

use yii\base\model;
class UploadImageForm extends Model{
    public $image;
    public function rules()
    {
        return[
        [['image'], 'file', 'skipOnEmpty' => false, 'extensions' => 'jpg, png'],
            ];
    }
    public function upload() {
        if ($this->validate()) {
            $this->image->saveAs('../uploads/' . $this->image->baseName . '.' . $this->image->extension);
            return true;
        }else {
            return false;
        }
    }

}