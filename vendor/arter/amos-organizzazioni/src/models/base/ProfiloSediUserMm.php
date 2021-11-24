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
 * @package    arter\amos\organizzazioni\models\base
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\organizzazioni\models\base;

use arter\amos\core\record\Record;
use arter\amos\organizzazioni\Module;
use yii\helpers\ArrayHelper;

/**
 * Class ProfiloSediUserMm
 *
 * This is the base-model class for table "profilo_sedi_user_mm".
 *
 * @property integer $id
 * @property integer $profilo_sedi_id
 * @property integer $user_id
 * @property string $status
 * @property string $role
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 *
 * @property \arter\amos\organizzazioni\models\ProfiloSedi $profiloSedi
 * @property \arter\amos\core\user\User $user
 *
 * @package arter\amos\organizzazioni\models\base
 */
abstract class ProfiloSediUserMm extends Record
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'profilo_sedi_user_mm';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['profilo_sedi_id', 'user_id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['status', 'role'], 'string', 'max' => 255],
            [['profilo_sedi_id'], 'exist', 'skipOnError' => true, 'targetClass' => Module::instance()->createModel('ProfiloSedi')->className(), 'targetAttribute' => ['profilo_sedi_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => \arter\amos\core\user\User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'id' => Module::t('amosorganizzazioni', 'ID'),
            'profilo_sedi_id' => Module::t('amosorganizzazioni', 'Sede'),
            'user_id' => Module::t('amosorganizzazioni', 'Utente'),
            'status' => Module::t('amosorganizzazioni', 'Stato'),
            'role' => Module::t('amosorganizzazioni', 'Ruolo'),
            'created_at' => Module::t('amosorganizzazioni', 'Creato il'),
            'updated_at' => Module::t('amosorganizzazioni', 'Aggiornato il'),
            'deleted_at' => Module::t('amosorganizzazioni', 'Cancellato il'),
            'created_by' => Module::t('amosorganizzazioni', 'Creato da'),
            'updated_by' => Module::t('amosorganizzazioni', 'Aggiornato da'),
            'deleted_by' => Module::t('amosorganizzazioni', 'Cancellato da'),
        ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfiloSedi()
    {
        return $this->hasOne(Module::instance()->createModel('ProfiloSedi')->className(), ['id' => 'profilo_sedi_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(\arter\amos\core\user\User::className(), ['id' => 'user_id']);
    }
}
