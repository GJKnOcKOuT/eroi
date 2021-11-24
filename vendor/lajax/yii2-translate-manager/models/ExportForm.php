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


namespace lajax\translatemanager\models;

use yii\base\Model;

/**
 * Export Form.
 *
 * @author rhertogh <>
 *
 * @since 1.5.0
 */
class ExportForm extends Model
{
    /**
     * @var string[] The languages to export
     */
    public $exportLanguages;

    /**
     * @var string The file format in which to export the data (json or xml)
     */
    public $format;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['exportLanguages', 'format'], 'required'],
        ];
    }

    /**
     * Find languages matching the minimumStatus
     *
     * @param $minimumStatus int The status of the returned language will be equal or larger than this number.
     *
     * @return Language[]
     */
    public function getDefaultExportLanguages($minimumStatus)
    {
        return Language::find()
            ->select('language_id')
            ->where(['>=', 'status', $minimumStatus])
            ->column();
    }

    /**
     * @return array[] Generate a two dimensional array of the translation data for the exportLanguages:
     *
     * ~~~
     * [
     *  'languages' => [],
     *  'languageSources' => [],
     *  'languageTranslations' => [],
     * ]
     * ~~~
     */
    public function getExportData()
    {
        $languages = Language::findAll($this->exportLanguages);
        $languageSources = LanguageSource::find()->all();
        $languageTranslations = LanguageTranslate::findAll(['language' => $this->exportLanguages]);

        $data = [
            'languages' => $languages,
            'languageSources' => $languageSources,
            'languageTranslations' => $languageTranslations,
        ];

        return $data;
    }
}
