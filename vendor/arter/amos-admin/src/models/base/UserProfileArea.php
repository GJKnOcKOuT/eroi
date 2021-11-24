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
 * @package    arter\amos\admin\models\base
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\admin\models\base;

use arter\amos\admin\AmosAdmin;
use arter\amos\core\record\Record;

/**
 * Class UserProfileArea
 * This is the base-model class for table "user_profile_area".
 *
 * @property integer $id
 * @property string $name
 * @property integer $enabled
 * @property integer $order
 * @property integer $type_cat
 *
 * @property \arter\amos\admin\models\UserProfile[] $userProfiles
 *
 * @package arter\amos\admin\models\base
 */
class UserProfileArea extends Record
{
    const OTHER = 1;
    const TYPE_CAT_GENERIC = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_profile_area';
    }
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'enabled', 'order'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['enabled', 'order', 'type_cat'], 'integer']
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => AmosAdmin::t('amosadmin', 'ID'),
            'name' => AmosAdmin::t('amosadmin', 'Name'),
            'enabled' => AmosAdmin::t('amosadmin', 'Enabled'),
            'order' => AmosAdmin::t('amosadmin', 'Order'),
            'type_cat' => AmosAdmin::t('amosadmin', 'Type Cat')
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserProfiles()
    {
        $modelClass = \arter\amos\admin\AmosAdmin::instance()->createModel('UserProfile');
        return $this->hasMany($modelClass::className(), ['user_profile_area_id' => 'id']);
    }
}
