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


namespace arter\amos\emailmanager\models;

use lajax\translatemanager\models\LanguageSource;
use Yii;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "email_view".
 */
class EmailView extends \arter\amos\emailmanager\models\base\EmailView
{

    /**
     * @inheritdoc
     */
    public function representingColumn()
    {
        return array(
            'view',
        );
    }

    /**
     * Returns the text hint for the specified attribute.
     * @param string $attribute the attribute name
     * @return string the attribute hint
     * @see attributeHints
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
                'slug' => 'module',
                'label' => $labels['module'],
                'type' => 'string'
            ],
            [
                'slug' => 'view',
                'label' => $labels['view'],
                'type' => 'string'
            ],
            [
                'slug' => 'params',
                'label' => $labels['params'],
                'type' => 'string'
            ],
        ];
    }

    public function getTraduzione() {
        $category = "emailview[{$this->module}][{$this->view}]";

        $traduzione = LanguageSource::findOne(['category' => $category]);

        if(!$traduzione || !$traduzione->id) {
            $traduzione = new LanguageSource();
            $traduzione->category = $category;
            $traduzione->message = '{original}';
            $traduzione->save(false);
        }

        return $traduzione;
    }
}
