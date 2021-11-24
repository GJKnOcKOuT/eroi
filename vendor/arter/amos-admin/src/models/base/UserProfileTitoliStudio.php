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
use arter\amos\core\record\AmosRecordAudit;
use Yii;

/**
 * This is the base-model class for table "user_profile_titoli_studio".
 *
 * @property integer $id
 * @property string $denominazione
 * @property string $descrizione
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 *
 * @property \arter\amos\admin\models\UserProfile[] $userProfiles
 */
class UserProfileTitoliStudio extends AmosRecordAudit
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_profile_titoli_studio';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['descrizione'], 'string'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['denominazione'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => AmosAdmin::t('amosadmin', 'ID'),
            'denominazione' => AmosAdmin::t('amosadmin', 'Denominazione'),
            'descrizione' => AmosAdmin::t('amosadmin', 'Descrizione'),
            'created_at' => AmosAdmin::t('amosadmin', 'Creato il'),
            'updated_at' => AmosAdmin::t('amosadmin', 'Aggiornato il'),
            'deleted_at' => AmosAdmin::t('amosadmin', 'Cancellato il'),
            'created_by' => AmosAdmin::t('amosadmin', 'Creato da'),
            'updated_by' => AmosAdmin::t('amosadmin', 'Aggiornato da'),
            'deleted_by' => AmosAdmin::t('amosadmin', 'Cancellato da'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserProfiles()
    {
        return $this->hasMany(AmosAdmin::instance()->createModel('UserProfile')->className(), ['user_profile_titoli_studio_id' => 'id'])->inverseOf('userProfileTitoliStudio');
    }
}
