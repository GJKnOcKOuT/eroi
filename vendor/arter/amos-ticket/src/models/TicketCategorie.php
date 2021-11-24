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
 * @package    arter\amos\ticket\models
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\ticket\models;

use arter\amos\attachments\behaviors\FileBehavior;
use arter\amos\attachments\models\File;
use arter\amos\community\models\Community;
use arter\amos\ticket\AmosTicket;
use yii\helpers\ArrayHelper;

/**
 * Class TicketCategorie
 * This is the model class for table "ticket_categorie".
 *
 * @method \yii\db\ActiveQuery hasOneFile($attribute = 'file', $sort = 'id')
 *
 * @package arter\amos\ticket\models
 */
class TicketCategorie extends \arter\amos\ticket\models\base\TicketCategorie
{
    /**
     * @var File $categoryIcon
     */
    public $categoryIcon;
    public $selected = 0;

    public function init()
    {
        parent::init();

        if ($this->isNewRecord) {
            $this->enable_dossier_id = 0;
            $this->enable_phone = 0;
            $this->attiva = 1;
            $this->tecnica = 0;
        }
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['categoryIcon'], 'file', 'maxFiles' => 1, 'extensions' => 'jpeg, jpg, png, gif'],
            [['selected'], 'integer'],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'categoryIcon' => AmosTicket::t('amosticket', 'Icona')
        ]);
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'fileBehavior' => [
                'class' => FileBehavior::className()
            ]
        ]);
    }

    /**
     * Ritorna l'url dell'avatar.
     *
     * @param string $size Dimensione. Default = original.
     * @return string Ritorna l'url.
     */
    public function getAvatarUrl($size = 'original')
    {
        return $this->getCategoryIconUrl($size);
    }

    /**
     * Getter for $this->categoryIcon;
     * @return File
     */
    public function getCategoryIcon()
    {
        if (empty($this->categoryIcon)) {
            $this->categoryIcon = $this->hasOneFile('categoryIcon')->one();
        }
        return $this->categoryIcon;
    }

    /**
     * @param $categoryIcon
     */
    public function setCategoryIcon($categoryIcon)
    {
        $this->categoryIcon = $categoryIcon;
    }

    /**
     * @return string
     */
    public function getCategoryIconUrl($size = 'original', $protected = true, $url = '/img/img_default.jpg')
    {
        $categoryIcon = $this->getCategoryIcon();
        if (!is_null($categoryIcon)) {
            if ($protected) {
                $url = $categoryIcon->getUrl($size);
            } else {
                $url = $categoryIcon->getWebUrl($size);
            }
        }
        return $url;
    }

    /**
     * This is the relation between the category and the parent category.
     * Return an ActiveQuery related to TicketCategorie model.
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategoriaPadre()
    {
        return $this->hasOne(\arter\amos\ticket\models\TicketCategorie::className(), ['id' => 'categoria_padre_id']);
    }

    public function getCommunity()
    {
        return $this->hasOne(Community::className(), ['id' => 'community_id']);
    }

}
