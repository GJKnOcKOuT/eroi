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
 * @package    arter\amos\tag
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\tag\models\base;

use arter\amos\core\record\AmosRecordAudit;
use arter\amos\tag\models\Tag;
use mdm\admin\models\AuthItem;
use Yii;
use arter\amos\tag\AmosTag;

/**
 * This is the base-model class for table "tag_models_auth_items_mm".
 *
 * @property integer $tag_id
 * @property string $classname
 * @property string $auth_item
 *
 * @property Tag $tag
 * @property AuthItem $authItem
 */
class TagModelsAuthItemsMm extends AmosRecordAudit
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tag_models_auth_items_mm';
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
        return [
            'tag_id' => AmosTag::t('amostag', 'Root'),
            'classname' => AmosTag::t('amostag', 'Model'),
            'auth_item' => AmosTag::t('amostag', 'Ruolo'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTag()
    {
        return $this->hasOne(Tag::className(), ['id' => 'tag_id'])->inverseOf('tagModelsAuthItemsMms');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthItem()
    {
        return $this->hasOne(AuthItem::className(), ['name' => 'auth_item'])->inverseOf('tagModelsAuthItemsMms');
    }
}