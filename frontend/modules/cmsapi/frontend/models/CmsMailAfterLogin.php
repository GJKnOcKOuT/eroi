<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    arter
 * @category   CategoryName
 */

namespace app\modules\cmsapi\frontend\models;

use yii\db\ActiveRecord;

class CmsMailAfterLogin extends ActiveRecord
{


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['id', 'integer'],
            // name, email, subject and body are required
            [[ 'subject', 'body', 'layout_email'], 'string'],
            // email has to be a valid email address
            ['email_from', 'string'],
            ['email_to', 'string'],
            ['email_cc', 'string'],
        ];
    }

    /**
     * @see    ActiveRecord::tableName()    for more info.
     */
    public static function tableName()
    {
        return '{{%cms_mail_after_login}}';
    }

    
}