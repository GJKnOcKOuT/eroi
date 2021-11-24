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


namespace arter\amos\een\models\base;

use Yii;

/**
 * This is the base-model class for table "een_staff".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $een_network_node_id
 * @property integer $staff_default
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 *
 * @property \backend\modules\pateradmin\models\EenNetworkNode $eenNetworkNode
 * @property \backend\modules\pateradmin\models\User $user
 */
class EenStaff extends \arter\amos\core\record\Record
{


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'een_staff';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'een_network_node_id'], 'required'],
            [['user_id', 'een_network_node_id', 'staff_default', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['een_network_node_id'], 'exist', 'skipOnError' => true, 'targetClass' => EenNetworkNode::className(), 'targetAttribute' => ['een_network_node_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => \arter\amos\core\user\User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('amoseen', 'ID'),
            'user_id' => Yii::t('amoseen', 'User'),
            'een_network_node_id' => Yii::t('amoseen', 'Network node'),
            'staff_default' => Yii::t('amoseen', 'Staff default'),
            'created_at' => Yii::t('amoseen', 'Created at'),
            'updated_at' => Yii::t('amoseen', 'Updated at'),
            'deleted_at' => Yii::t('amoseen', 'Deleted at'),
            'created_by' => Yii::t('amoseen', 'Created by'),
            'updated_by' => Yii::t('amoseen', 'Updated at'),
            'deleted_by' => Yii::t('amoseen', 'Deleted at'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEenNetworkNode()
    {
        return $this->hasOne(\arter\amos\een\models\EenNetworkNode::className(), ['id' => 'een_network_node_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(\arter\amos\core\user\User::className(), ['id' => 'user_id']);
    }
}
