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
 * This is the base-model class for table "een_expr_of_interest_history".
 *
 * @property integer $id
 * @property integer $een_expr_of_interest_id
 * @property string $start_status
 * @property string $end_status
 * @property string $start_sub_status
 * @property string $end_sub_status
 * @property string $start_in_charge
 * @property string $end_in_charge
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 *
 * @property EenExprOfInterest $eenExprOfInterest
 * @property \arter\amos\core\user\User $startInCharge
 * @property \arter\amos\core\user\User $endInCharge
 */
class EenExprOfInterestHistory extends \arter\amos\core\record\Record
{


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'een_expr_of_interest_history';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['een_expr_of_interest_id'], 'required'],
            [['een_expr_of_interest_id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['start_status', 'end_status'], 'string', 'max' => 255],
            [['een_expr_of_interest_id'], 'exist', 'skipOnError' => true, 'targetClass' => \arter\amos\een\models\EenExprOfInterest::className(), 'targetAttribute' => ['een_expr_of_interest_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('amoseen', 'ID'),
            'een_expr_of_interest_id' => Yii::t('amoseen', 'Een Expr Of Interest ID'),
            'start_status' => Yii::t('amoseen', 'Start status'),
            'end_status' => Yii::t('amoseen', 'End status'),
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
    public function getEenExprOfInterest()
    {
        return $this->hasOne(\arter\amos\een\models\EenExprOfInterest::className(), ['id' => 'een_expr_of_interest_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStartInCharge()
    {
        return $this->hasOne(\arter\amos\core\user\User::className(), ['id' => 'start_in_charge']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEndInCharge()
    {
        return $this->hasOne(\arter\amos\core\user\User::className(), ['id' => 'end_in_charge']);
    }
}
