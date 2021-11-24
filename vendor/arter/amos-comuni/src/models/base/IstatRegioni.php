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
 * @package    arter\amos\comuni
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\comuni\models\base;

use Yii;
use arter\amos\comuni\AmosComuni;

/**
 * This is the base-model class for table "istat_regioni".
 *
 * @property integer $id
 * @property string $nome
 * @property integer $istat_nazioni_id
 *
 * @property \arter\amos\comuni\models\IstatComuni[] $istatComunis
 * @property \arter\amos\comuni\models\IstatProvince[] $istatProvinces
 * @property \arter\amos\comuni\models\IstatNazioni $istatNazioni
 */
class IstatRegioni extends \arter\amos\core\record\Record
{


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'istat_regioni';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'nome'], 'required'],
            [['id', 'istat_nazioni_id'], 'integer'],
            [['nome'], 'string', 'max' => 255],
            [['istat_nazioni_id'], 'exist', 'skipOnError' => true, 'targetClass' => IstatNazioni::className(), 'targetAttribute' => ['istat_nazioni_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => AmosComuni::t('amoscomuni', 'Codice Istat'),
            'nome' => AmosComuni::t('amoscomuni', 'Regione'),
            'istat_nazioni_id' => AmosComuni::t('amoscomuni', 'Istat Nazioni ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIstatComunis()
    {
        return $this->hasMany(\arter\amos\comuni\models\IstatComuni::className(), ['istat_regioni_id' => 'id'])->inverseOf('istatRegioni');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIstatProvinces()
    {
        return $this->hasMany(\arter\amos\comuni\models\IstatProvince::className(), ['istat_regioni_id' => 'id'])->inverseOf('istatRegioni');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIstatNazioni()
    {
        return $this->hasOne(\arter\amos\comuni\models\IstatNazioni::className(), ['id' => 'istat_nazioni_id'])->inverseOf('istatRegionis');
    }
}
