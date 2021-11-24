<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see http://example.com Developers'community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    arter\amos\notify
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */


namespace  arter\amos\notificationmanager\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "notificationread".
 *
 * @author -
 * @property integer $id
 * @property integer $user_id
 * @property integer notification_id
 * @property integer $created_at
 * @property integer $updated_at
 */

class NotificationsRead extends \arter\amos\core\record\Record
{
    
    
    public static function tableName() {
        return 'notificationread';
    }
    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'class' =>  TimestampBehavior::className(),
        ];
    }
    
}
