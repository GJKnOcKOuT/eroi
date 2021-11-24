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
 * @package    arter\amos\news\models\base
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\news\models\base;

use arter\amos\news\AmosNews;
use yii\helpers\ArrayHelper;

/**
 * Class NewsCategoryRolesMm
 * @package arter\amos\news\models\base
 *
 * This is the base-model class for table "news_category_roles_mm".
 *
 * @property    integer $id
 * @property    integer $news_category_id
 * @property    string $role
 * @property    string $created_at
 * @property    string $updated_at
 * @property    string $deleted_at
 * @property    integer $created_by
 * @property    integer $updated_by
 * @property    integer $deleted_by
 *
 * @property \arter\amos\news\models\NewsCategorie $newsCategory
 */
class NewsCategoryRolesMm extends \arter\amos\core\record\Record
{
    /**
     * @see    \yii\db\ActiveRecord::tableName()    for more info.
     */
    public static function tableName()
    {
        return 'news_category_roles_mm';
    }

    /**
     * @see    \yii\base\Model::rules()    for more info.
     */
    public function rules()
    {
        return [
            [['news_category_id', 'role'], 'required'],
            [['role'], 'string'],
            [['news_category_id', 'created_by', 'updated_by', 'deleted_by',], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['role'], 'string', 'max' => 255]
        ];
    }

    /**
     * @see    \arter\amos\core\record\Record::attributeLabels()    for more info.
     */
    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'id' => AmosNews::t('amosnews', 'Id'),
            'news_category_id' => AmosNews::t('amosnews', '#news_category_id'),
            'role' => AmosNews::t('amosnews', '#role'),
        ]);
    }

    /**
     * Relation between news category role mm and category.
     * Returns an ActiveQuery related to model NewsCategorie.
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNewsCategory()
    {
        return $this->hasOne(\arter\amos\news\models\NewsCategorie::className(), ['id' => 'news_category_id']);
    }

}