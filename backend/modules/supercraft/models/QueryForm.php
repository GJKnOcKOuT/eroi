<?php
/**
 * @User GJKnOcKOuT
 * @Project basic
 * @Date 11/01/2022
 */

namespace backend\modules\supercraft\models;

use yii\base\Model;

/**
 * @Class QueryForm
 * @Package app\models
 * @Author Aldini Alessandro <alessandro.aldini@outlook.it>
 */
class QueryForm extends Model
{
    public $id_processo_aziendale;
    public $id_azienda;

    public function rules()
    {
        return [
                [['id_processo_aziendale', 'id_azienda'], 'required']
                ];
    }
}