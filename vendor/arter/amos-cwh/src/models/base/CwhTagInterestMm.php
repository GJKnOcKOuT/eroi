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

use arter\amos\cwh\AmosCwh;
use mdm\admin\models\AuthItem;
use yii\helpers\ArrayHelper;

/**
 * This is the base-model class for table "cwh_tag_interest_mm".
 *
 * @property integer $tag_id
 * @property string $classname
 * @property string $auth_item
 *
 * @property AuthItem $authItem
 * @property \arter\amos\tag\models\Tag $tag
 */
class CwhTagInterestMm extends \arter\amos\core\record\AmosRecordAudit
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cwh_tag_interest_mm';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tag_id', 'classname', 'auth_item'], 'required'],
            [['tag_id'], 'integer'],
            [['classname', 'auth_item'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'tag_id' => AmosCwh::t('amoscwh', 'Root'),
            'classname' => AmosCwh::t('amoscwh', 'Model'),
            'auth_item' => AmosCwh::t('amoscwh', 'Item'),
        ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTag()
    {
        $moduleTag = \Yii::$app->getModule('tag');
        if (isset($moduleTag)) {
            return $this->hasOne(\arter\amos\tag\models\Tag::className(),
                ['id' => 'tag_id'])->inverseOf('tagModelsAuthItemsMms');
        }
        return null;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthItem()
    {
        return $this->hasOne(AuthItem::className(), ['name' => 'auth_item'])->inverseOf('tagModelsAuthItemsMms');
    }
}
