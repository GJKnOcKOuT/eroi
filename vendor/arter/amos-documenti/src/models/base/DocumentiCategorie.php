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
 * @package    arter\amos\documenti\models\base
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\documenti\models\base;

use arter\amos\core\record\Record;
use arter\amos\documenti\AmosDocumenti;

/**
 * This is the base-model class for table "documenti_categorie".
 *
 * @property    integer $id
 * @property    string $titolo
 * @property    string $sottotitolo
 * @property    string $descrizione_breve
 * @property    string $descrizione
 * @property    integer $filemanager_mediafile_id
 * @property    string $created_at
 * @property    string $updated_at
 * @property    string $deleted_at
 * @property    integer $created_by
 * @property    integer $updated_by
 * @property    integer $deleted_by
 *
 * @property \arter\amos\documenti\models\Documenti $documenti
 * @property \arter\amos\documenti\models\DocumentiCategoryCommunityMm[] $documentiCategoryCommunityMms
 * @property \arter\amos\documenti\models\DocumentiCategoryRolesMm[] $documentiCategoryRolesMms
 */
class DocumentiCategorie extends Record
{
    /**
     * @var AmosDocumenti $documentsModule
     */
    protected $documentsModule = null;

    /**
     * @see    \yii\db\ActiveRecord::tableName()    for more info.
     */
    public static function tableName()
    {
        return 'documenti_categorie';
    }

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->documentsModule = \Yii::$app->getModule(AmosDocumenti::getModuleName());
    }

    /**
     * @see    \yii\base\Model::rules()    for more info.
     */
    public function rules()
    {
        return [
            [['titolo'], 'required'],
            [['descrizione'], 'string'],
            [['filemanager_mediafile_id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['titolo', 'sottotitolo', 'descrizione_breve'], 'string', 'max' => 255]
        ];
    }

    /**
     * @see    Record::attributeLabels()    for more info.
     */
    public function attributeLabels()
    {
        return [
            'id' => AmosDocumenti::t('amosdocumenti', 'Id'),
            'titolo' => AmosDocumenti::t('amosdocumenti', 'Titolo'),
            'sottotitolo' => AmosDocumenti::t('amosdocumenti', 'Sottotitolo'),
            'descrizione_breve' => AmosDocumenti::t('amosdocumenti', 'Descrizione breve'),
            'descrizione' => AmosDocumenti::t('amosdocumenti', 'Descrizione'),
            'filemanager_mediafile_id' => AmosDocumenti::t('amosdocumenti', 'Immagine'),
            'created_at' => AmosDocumenti::t('amosdocumenti', 'Creato il'),
            'updated_at' => AmosDocumenti::t('amosdocumenti', 'Aggiornato il'),
            'deleted_at' => AmosDocumenti::t('amosdocumenti', 'Cancellato il'),
            'created_by' => AmosDocumenti::t('amosdocumenti', 'Creato da'),
            'updated_by' => AmosDocumenti::t('amosdocumenti', 'Aggiornato da'),
            'deleted_by' => AmosDocumenti::t('amosdocumenti', 'Cancellato da')
        ];
    }

    /**
     * Metodo che mette in relazione la categoria con le notizie ad essa associata.
     * Ritorna un ActiveQuery relativo al model Documenti.
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocumenti()
    {
        return $this->hasMany($this->documentsModule->model('Documenti'), ['documenti_categorie_id' => 'id']);
    }

    /**
     * Relation between category and category-roles mm table.
     * Returns an ActiveQuery related to model NewsCategoryRolesMm.
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentiCategoryRolesMms()
    {
        return $this->hasMany($this->documentsModule->model('DocumentiCategoryRolesMm'), ['documenti_categorie_id' => 'id']);
    }

    /**
     * Relation between category and category-roles mm table.
     * Returns an ActiveQuery related to model NewsCategoryCommunityMm.
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentiCategoryCommunityMms()
    {
        return $this->hasMany($this->documentsModule->model('DocumentiCategoryCommunityMm'), ['documenti_categorie_id' => 'id']);
    }
}
