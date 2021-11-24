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
 * @package    arter\amos\cwh
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\cwh\models\base;

use arter\amos\core\record\AmosRecordAudit;
use arter\amos\cwh\AmosCwh;
use yii\helpers\ArrayHelper;

/**
 * This is the base-model class for table "cwh_auth_assignment".
 *
 * @property integer $id
 * @property string $item_name
 * @property string $user_id
 * @property string $cwh_nodi_id
 * @property integer $cwh_config_id
 * @property integer $cwh_network_id
 *
 * @property \yii\rbac\Item $itemName
 * @property \arter\amos\core\user\User $user
 * @property \arter\amos\cwh\models\CwhNodi $cwhNodi
 */
class CwhAuthAssignment extends AmosRecordAudit
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cwh_auth_assignment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_name', 'user_id', 'cwh_nodi_id'], 'required'],
            [['cwh_config_id', 'cwh_network_id'], 'integer'],
            [['item_name', 'user_id', 'cwh_nodi_id'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'item_name' => AmosCwh::t('amoscwh', 'Permesso'),
            'user_id' => AmosCwh::t('amoscwh', 'Utente'),
            'cwh_config_id' => AmosCwh::t('amoscwh', 'Cwh Config ID'),
            'cwh_network_id' => AmosCwh::t('amoscwh', 'Cwh Network ID'),
            'cwh_nodi_id' => AmosCwh::t('amoscwh', 'Dominio'),
            'created_at' => AmosCwh::t('amoscwh', 'Created At'),
        ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemName()
    {
        return $this->hasOne(\yii\rbac\Item::className(), ['name' => 'item_name']);
    }


    public function getAuthItemDescription()
    {
        $listaPermessiRuoli = \Yii::$app->authManager->getPermissions();
        if (isset($listaPermessiRuoli[$this->item_name])) {
            return $listaPermessiRuoli[$this->item_name]->description;
        }
        return null;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(\arter\amos\core\user\User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCwhNodi()
    {
        return $this->hasOne(\arter\amos\cwh\models\CwhNodi::className(), ['id' => 'cwh_nodi_id', 'cwh_config_id' => 'cwh_config_id', 'record_id' => 'cwh_network_id']);
    }
}
