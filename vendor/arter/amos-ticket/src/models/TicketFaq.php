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

use arter\amos\core\interfaces\ContentModelInterface;
use arter\amos\seo\behaviors\SeoContentBehavior;
use arter\amos\seo\interfaces\SeoModelInterface;
use yii\helpers\ArrayHelper;

/**
 * Class TicketFaq
 * This is the model class for table "ticket_faq".
 * @package arter\amos\ticket\models
 */
class TicketFaq extends \arter\amos\ticket\models\base\TicketFaq implements ContentModelInterface, SeoModelInterface
{
    /**
     * @inheritdoc
     */
    public function representingColumn()
    {
        return [
            'domanda'
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'SeoContentBehavior' => [
                'class' => SeoContentBehavior::className(),
                'titleAttribute' => 'domanda',
                'descriptionAttribute' => 'risposta',
                'imageAttribute' => null,
                'defaultOgType' => 'article',
                'schema' => null
            ]
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return [
        ];
    }

    /**
     * @inheritdoc
     */
    public function getAttributeHint($attribute)
    {
        $hints = $this->attributeHints();
        return isset($hints[$attribute]) ? $hints[$attribute] : null;
    }

    public static function getEditFields()
    {
        $labels = self::attributeLabels();

        return [
            [
                'slug' => 'domanda',
                'label' => $labels['domanda'],
                'type' => 'text'
            ],
            [
                'slug' => 'risposta',
                'label' => $labels['risposta'],
                'type' => 'text'
            ],
            [
                'slug' => 'ticket_categoria_id',
                'label' => $labels['ticket_categoria_id'],
                'type' => 'integer'
            ],
            [
                'slug' => 'version',
                'label' => $labels['version'],
                'type' => 'integer'
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function getSchema()
    {

    }

    /**
     * @inheritdoc
     */
    public function getPublicatedFrom()
    {
        return $this->publication_startdate;
    }

    /**
     * @inheritdoc
     */
    public function getPublicatedAt()
    {
        return $this->publication_enddate;
    }

    /**
     * @inheritdoc
     */
    public function getCategory()
    {
        return null;
    }

    /**
     * @inheritdoc
     */
    public function getCwhValidationStatuses()
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public function getTitle()
    {
        return $this->domanda;
    }

    /**
     * @inheritdoc
     */
    public function getShortDescription()
    {
        return $this->domanda;
    }

    /**
     * @inheritdoc
     */
    public function getDescription($truncate)
    {
        return $this->title;
    }

    /**
     * @inheritdoc
     */
    public function getDraftStatus()
    {
        return null;
    }

    /**
     * @inheritdoc
     */
    public function getGrammar()
    {
        return null;
    }

    /**
     * @inheritdoc
     */
    public function getGridViewColumns()
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public function getPluginWidgetClassname()
    {
        return WidgetIconPrintareaDashboard::className();
    }

    /**
     * @inheritdoc
     */
    public function getToValidateStatus()
    {
        return null;
    }

    /**
     * @inheritdoc
     */
    public function getValidatedStatus()
    {
        return null;
    }

    /**
     * @inheritdoc
     */
    public function getValidatorRole()
    {
        return null;
    }
}
