<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    backend\models
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace backend\models;

use arter\amos\core\module\BaseAmosModule;
use yii\base\Model;
use arter\amos\admin\AmosAdmin;

/**
 * Class MyUserProfile
 * @package e015\common\models
 */
class MyUserProfile extends Model
{

    public $privacy;

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'privacy' => BaseAmosModule::t('logininforequest', '#privacy'),
        ];
    }

    public function rules()
    {
        return [
            [['privacy'], 'required'],
            ['privacy', 'integer'],
            ['privacy', 'checkPrivacy'],
        ];
    }

    /**
     * Custom validation form "privacy" field
     */
    public function checkPrivacy()
    {
        if (!$this->privacy && !\Yii::$app->user->can('ADMIN')) {
            $this->addError('privacy', AmosAdmin::t('amosadmin', "It's mandatory to accept the privacy notice before save"));
        }
    }
}
