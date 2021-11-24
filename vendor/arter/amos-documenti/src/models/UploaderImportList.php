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
 * @package    arter\amos\documenti\models
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\documenti\models;

/**
 * This is the model class for table "uploader_import_list".
 */
class UploaderImportList extends \arter\amos\documenti\models\base\UploaderImportList
{
    /**
     * @return array|null
     */
    public function representingColumn()
    {
        return [
            //inserire il campo o i campi rappresentativi del modulo
        ];
    }

    /**
     * @return array
     */
    public function attributeHints()
    {
        return [
        ];
    }

    /**
     * Returns the text hint for the specified attribute.
     * @param string $attribute the attribute name
     * @return string the attribute hint
     */
    public function getAttributeHint($attribute)
    {
        $hints = $this->attributeHints();

        return isset($hints[$attribute]) ? $hints[$attribute] : null;
    }

    /**
     * @return array
     */
    public static function getEditFields()
    {
        $labels = self::attributeLabels();

        return [
            [
                'slug' => 'name_file',
                'label' => $labels['name_file'],
                'type' => 'string'
            ],
            [
                'slug' => 'path_log',
                'label' => $labels['path_log'],
                'type' => 'string'
            ],
            [
                'slug' => 'successfull',
                'label' => $labels['successfull'],
                'type' => 'integer'
            ],
        ];
    }

    /**
     * @return string
     */
    public function getPathForLog()
    {
        $date = new \DateTime();
        $basePath = \Yii::getAlias('@backend/web/') . '/reports_import/';
        if (!file_exists($basePath)) {
            mkdir($basePath, 0777, true);
        }
        return $basePath . $date->getTimestamp() . '.txt';
    }
}
