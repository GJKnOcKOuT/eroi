<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fasi_di_processo".
 *
 * @property int $id_fasi_di_processo
 * @property int $id_processo_innovativo
 * @property int $id_fase
 * @property string|null $nome_processo
 *
 * @property Fase $fase
 * @property FaseReale[] $faseReales
 * @property FasiDiProcesso[] $figlios
 * @property PadreDi[] $padreDis
 * @property PadreDi[] $padreDis0
 * @property FasiDiProcesso[] $padres
 * @property ProcessoInnovativo $processoInnovativo
 */
class FasiDiProcesso extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fasi_di_processo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_processo_innovativo', 'id_fase'], 'required'],
            [['id_processo_innovativo', 'id_fase'], 'integer'],
            [['nome_processo'], 'string'],
            [['id_fase'], 'exist', 'skipOnError' => true, 'targetClass' => Fase::className(), 'targetAttribute' => ['id_fase' => 'id_fase']],
            [['id_processo_innovativo'], 'exist', 'skipOnError' => true, 'targetClass' => ProcessoInnovativo::className(), 'targetAttribute' => ['id_processo_innovativo' => 'id_processo_innovativo']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_fasi_di_processo' => 'Id Fasi Di Processo',
            'id_processo_innovativo' => 'Id Processo Innovativo',
            'id_fase' => 'Id Fase',
            'nome_processo' => 'Nome Processo',
        ];
    }

    /**
     * Gets query for [[Fase]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFase()
    {
        return $this->hasOne(Fase::className(), ['id_fase' => 'id_fase']);
    }

    /**
     * Gets query for [[FaseReales]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFaseReales()
    {
        return $this->hasMany(FaseReale::className(), ['id_fasi_di_processo' => 'id_fasi_di_processo']);
    }

    /**
     * Gets query for [[Figlios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFiglios()
    {
        return $this->hasMany(FasiDiProcesso::className(), ['id_fasi_di_processo' => 'id_figlio'])->viaTable('padre_di', ['id_padre' => 'id_fasi_di_processo']);
    }

    /**
     * Gets query for [[PadreDis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPadreDis()
    {
        return $this->hasMany(PadreDi::className(), ['id_padre' => 'id_fasi_di_processo']);
    }

    /**
     * Gets query for [[PadreDis0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPadreDis0()
    {
        return $this->hasMany(PadreDi::className(), ['id_figlio' => 'id_fasi_di_processo']);
    }

    /**
     * Gets query for [[Padres]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPadres()
    {
        return $this->hasMany(FasiDiProcesso::className(), ['id_fasi_di_processo' => 'id_padre'])->viaTable('padre_di', ['id_figlio' => 'id_fasi_di_processo']);
    }

    /**
     * Gets query for [[ProcessoInnovativo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProcessoInnovativo()
    {
        return $this->hasOne(ProcessoInnovativo::className(), ['id_processo_innovativo' => 'id_processo_innovativo']);
    }
}
