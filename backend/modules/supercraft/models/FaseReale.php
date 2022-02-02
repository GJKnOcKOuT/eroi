<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fase_reale".
 *
 * @property int $id_fase_reale
 * @property string|null $data_inizio
 * @property string|null $data_fine
 * @property string|null $descrizione
 * @property int $id_processo_aziendale
 * @property int $id_fasi_di_processo
 *
 * @property AttivitaReale[] $attivitaReales
 * @property FasiDiProcesso $fasiDiProcesso
 * @property ProcessoAziendale $processoAziendale
 */
class FaseReale extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fase_reale';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['data_inizio', 'data_fine'], 'safe'],
            [['id_processo_aziendale', 'id_fasi_di_processo'], 'required'],
            [['id_processo_aziendale', 'id_fasi_di_processo'], 'integer'],
            [['descrizione'], 'string', 'max' => 1000],
            [['descrizione'], 'unique'],
            [['id_fasi_di_processo'], 'exist', 'skipOnError' => true, 'targetClass' => FasiDiProcesso::className(), 'targetAttribute' => ['id_fasi_di_processo' => 'id_fasi_di_processo']],
            [['id_processo_aziendale'], 'exist', 'skipOnError' => true, 'targetClass' => ProcessoAziendale::className(), 'targetAttribute' => ['id_processo_aziendale' => 'id_processo_aziendale']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_fase_reale' => 'Id Fase Reale',
            'data_inizio' => 'Data Inizio',
            'data_fine' => 'Data Fine',
            'descrizione' => 'Descrizione',
            'id_processo_aziendale' => 'Id Processo Aziendale',
            'id_fasi_di_processo' => 'Id Fasi Di Processo',
        ];
    }

    /**
     * Gets query for [[AttivitaReales]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAttivitaReales()
    {
        return $this->hasMany(AttivitaReale::className(), ['fase_reale_id_fase_reale' => 'id_fase_reale']);
    }

    /**
     * Gets query for [[FasiDiProcesso]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFasiDiProcesso()
    {
        return $this->hasOne(FasiDiProcesso::className(), ['id_fasi_di_processo' => 'id_fasi_di_processo']);
    }

    /**
     * Gets query for [[Pa]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProcessoAziendale()
    {
        return $this->hasOne(ProcessoAziendale::className(), ['id_processo_aziendale' => 'id_processo_aziendale']);
    }
}
