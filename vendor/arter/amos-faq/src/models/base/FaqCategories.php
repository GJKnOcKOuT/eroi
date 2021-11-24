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
 * @package    arter\amos\faq
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\faq\models\base;

use arter\amos\core\record\Record;
use arter\amos\faq\AmosFaq;
use yii\helpers\ArrayHelper;

/**
 * This is the base-model class for table "faq_categories".
 *
 * @property integer $id
 * @property string $titolo
 * @property string $descrizione
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property integer $version
 */
class FaqCategories extends Record
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'faq_categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descrizione'], 'string'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['created_by', 'updated_by', 'deleted_by', 'version'], 'integer'],
            [['titolo'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'id' => AmosFaq::t('amosfaq', 'ID'),
            'titolo' => AmosFaq::t('amosfaq', 'Titolo'),
            'descrizione' => AmosFaq::t('amosfaq', 'Descrizione'),
            'created_at' => AmosFaq::t('amosfaq', 'Creato il'),
            'updated_at' => AmosFaq::t('amosfaq', 'Aggiornato il'),
            'deleted_at' => AmosFaq::t('amosfaq', 'Cancellato il'),
            'created_by' => AmosFaq::t('amosfaq', 'Creato da'),
            'updated_by' => AmosFaq::t('amosfaq', 'Aggiornato da'),
            'deleted_by' => AmosFaq::t('amosfaq', 'Cancellato da'),
            'version' => AmosFaq::t('amosfaq', 'Versione numero'),
        ]);
    }
}
