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
 * This is the base-model class for table "istat_province".
 *
 * @property integer $id
 * @property string $nome
 * @property string $sigla
 * @property integer $capoluogo
 * @property integer $soppressa
 * @property integer $istat_citta_metropolitane_id
 * @property integer $istat_regioni_id
 *
 * @property \arter\amos\comuni\models\IstatComuni[] $istatComunis
 * @property \arter\amos\comuni\models\IstatCittaMetropolitane $istatCittaMetropolitane
 * @property \arter\amos\comuni\models\IstatRegioni $istatRegioni
 * @property \arter\amos\comuni\models\IstatUnioneDeiComuni[] $istatUnioneDeiComunis
 */
class IstatProvince extends \arter\amos\core\record\Record
{


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'istat_province';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'nome'], 'required'],
            [['id', 'capoluogo', 'soppressa', 'istat_citta_metropolitane_id', 'istat_regioni_id'], 'integer'],
            [['nome', 'sigla'], 'string', 'max' => 255],
            [['istat_citta_metropolitane_id'], 'exist', 'skipOnError' => true, 'targetClass' => IstatCittaMetropolitane::className(), 'targetAttribute' => ['istat_citta_metropolitane_id' => 'id']],
            [['istat_regioni_id'], 'exist', 'skipOnError' => true, 'targetClass' => IstatRegioni::className(), 'targetAttribute' => ['istat_regioni_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => AmosComuni::t('amoscomuni', 'Codice Istat'),
            'nome' => AmosComuni::t('amoscomuni', 'Provincia'),
            'sigla' => AmosComuni::t('amoscomuni', 'Sigla'),
            'capoluogo' => AmosComuni::t('amoscomuni', 'Capoluogo'),
            'soppressa' => AmosComuni::t('amoscomuni', 'Soppressa'),
            'istat_citta_metropolitane_id' => AmosComuni::t('amoscomuni', 'Città Metropolitana'),
            'istat_regioni_id' => AmosComuni::t('amoscomuni', 'Regione'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIstatComunis()
    {
        return $this->hasMany(\arter\amos\comuni\models\IstatComuni::className(), ['istat_province_id' => 'id'])->inverseOf('istatProvince');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIstatCittaMetropolitane()
    {
        return $this->hasOne(\arter\amos\comuni\models\IstatCittaMetropolitane::className(), ['id' => 'istat_citta_metropolitane_id'])->inverseOf('istatProvinces');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIstatRegioni()
    {
        return $this->hasOne(\arter\amos\comuni\models\IstatRegioni::className(), ['id' => 'istat_regioni_id'])->inverseOf('istatProvinces');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIstatUnioneDeiComunis()
    {
        return $this->hasMany(\arter\amos\comuni\models\IstatUnioneDeiComuni::className(), ['istat_province_id' => 'id'])->inverseOf('istatProvince');
    }
}
