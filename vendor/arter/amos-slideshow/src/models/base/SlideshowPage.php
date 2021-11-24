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
 * @package    arter\amos\slideshow
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\slideshow\models\base;

use arter\amos\slideshow\AmosSlideshow;
use yii\helpers\ArrayHelper;

/**
 * Class SlideshowPage
 * @package arter\amos\slideshow\models\base
 *
 * This is the base-model class for table "slideshow_pages".
 *
 * @property integer $id
 * @property string $name
 * @property string $pageContent
 * @property integer $ordinal
 * @property integer $slideshow_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 *
 * @property \arter\amos\slideshow\models\Slideshow $slideshow
 */
class SlideshowPage extends \arter\amos\core\record\Record
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'slideshow_pages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'pageContent', 'ordinal', 'slideshow_id'], 'required'],
            [['pageContent'], 'string'],
            [['ordinal', 'slideshow_id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['slideshow_id'], 'exist', 'skipOnError' => true, 'targetClass' => \arter\amos\slideshow\models\Slideshow::className(), 'targetAttribute' => ['slideshow_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'id' => AmosSlideshow::t('amosslideshow', 'ID'),
            'name' => AmosSlideshow::t('amosslideshow', 'Titolo'),
            'pageContent' => AmosSlideshow::t('amosslideshow', 'Contenuto pagina'),
            'ordinal' => AmosSlideshow::t('amosslideshow', 'Ordine'),
            'slideshow_id' => AmosSlideshow::t('amosslideshow', 'Slideshow'),
            'created_at' => AmosSlideshow::t('amosslideshow', 'Created At'),
            'updated_at' => AmosSlideshow::t('amosslideshow', 'Updated At'),
            'deleted_at' => AmosSlideshow::t('amosslideshow', 'Deleted At'),
            'created_by' => AmosSlideshow::t('amosslideshow', 'Created By'),
            'updated_by' => AmosSlideshow::t('amosslideshow', 'Updated By'),
            'deleted_by' => AmosSlideshow::t('amosslideshow', 'Deleted By'),
        ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSlideshow()
    {
        return $this->hasOne(\arter\amos\slideshow\models\Slideshow::className(), ['id' => 'slideshow_id']);
    }
}
