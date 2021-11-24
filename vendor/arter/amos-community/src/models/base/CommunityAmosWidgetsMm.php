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


namespace arter\amos\community\models\base;

use Yii;

/**
 * This is the base-model class for table "community_amos_widgets_mm".
 *
 * @property integer $id
 * @property integer $community_id
 * @property integer $amos_widgets_id
 * @property string $widget_label
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 *
 * @property \arter\amos\community\models\Community $community
 * @property \arter\amos\dashboard\models\AmosWidgets $amosWidgets
 */
class  CommunityAmosWidgetsMm extends \arter\amos\core\record\Record
{


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'community_amos_widgets_mm';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['community_id', 'amos_widgets_id'], 'required'],
            [['community_id', 'amos_widgets_id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['widget_label'], 'string', 'max' => 255],
            [['community_id'], 'exist', 'skipOnError' => true, 'targetClass' => \arter\amos\community\models\Community::className(), 'targetAttribute' => ['community_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('amoscommunity', 'ID'),
            'community_id' => Yii::t('amoscommunity', 'Community'),
            'amos_widgets_id' => Yii::t('amoscommunity', 'Widget'),
            'widget_label' => Yii::t('amoscommunity', 'Label widget'),
            'created_at' => Yii::t('amoscommunity', 'Created at'),
            'updated_at' => Yii::t('amoscommunity', 'Updated at'),
            'deleted_at' => Yii::t('amoscommunity', 'Deleted at'),
            'created_by' => Yii::t('amoscommunity', 'Created by'),
            'updated_by' => Yii::t('amoscommunity', 'Updated by'),
            'deleted_by' => Yii::t('amoscommunity', 'Deleted by'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCommunity()
    {
        return $this->hasOne(\arter\amos\community\models\Community::className(), ['id' => 'community_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAmosWidgets()
    {
        return $this->hasOne(\arter\amos\dashboard\models\AmosWidgets::className(), ['id' => 'amos_widgets_id']);
    }
}
