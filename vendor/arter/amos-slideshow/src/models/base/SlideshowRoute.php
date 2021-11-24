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
 * Class SlideshowRoute
 * @package arter\amos\slideshow\models\base
 *
 * This is the base-model class for table "slideshow_route".
 *
 * @property integer $id
 * @property string $route
 * @property integer $already_view
 * @property integer $slideshow_id
 * @property string $role
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 *
 * @property \arter\amos\slideshow\models\Slideshow $slideshow
 */
class SlideshowRoute extends \arter\amos\core\record\Record
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'slideshow_route';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['route'], 'required'],
            [['role'], 'string'],
            [['already_view', 'slideshow_id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['route', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['slideshow_id'], 'exist', 'skipOnError' => true, 'targetClass' => \arter\amos\slideshow\models\Slideshow::className(), 'targetAttribute' => ['slideshow_id' => 'id']],
            [['role'], 'uniqueRoleAndRouteCheck'],
        ];
    }

    public function uniqueRoleAndRouteCheck($attribute, $params)
    {
        if ($this->isNewRecord) {
            $slideshows = self::find()->andWhere(['role' => $this->role, 'route' => $this->route])->all();
            if (count($slideshows) > 0) {
                $error = "Esiste già uno slideshow per il ruolo destinatario '" . $this->role . "' e l'indirizzo '" . $this->route . "'";
                $this->addError('role', $error);
                $this->addError('route', $error);
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'id' => AmosSlideshow::t('amosslideshow', 'ID'),
            'route' => AmosSlideshow::t('amosslideshow', 'Indirizzo'),
            'already_view' => AmosSlideshow::t('amosslideshow', 'Apri in automatico'),
            'slideshow_id' => AmosSlideshow::t('amosslideshow', 'Slideshow ID'),
            'role' => AmosSlideshow::t('amosslideshow', 'Ruoli destinatari'),
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
