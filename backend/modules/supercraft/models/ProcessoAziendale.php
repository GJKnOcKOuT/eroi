<?php

namespace backend\modules\supercraft\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "processo_aziendale".
 *
 * @property int $id_processo_aziendale
 * @property int $id_processo_innovativo
 * @property string $nome
 * @property int $id_azienda
 * @property string|null $data_inizio
 * @property string|null $data_fine
 * @property string|null $descrizione
 * @property string|null $copertina
 * @property string $id_fase_attuale
 *
 * @property FaseReale[] $faseReales
 * @property ProcessoInnovativo $processoInnovativo
 */
class ProcessoAziendale extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'processo_aziendale';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_processo_innovativo', 'nome'], 'required'],
            [['id_processo_innovativo', 'id_azienda'], 'integer'],
            [['data_inizio', 'data_fine'], 'safe'],
            [['descrizione'], 'string'],
            [['nome', 'copertina', 'id_fase_attuale'], 'string', 'max' => 45],
            [['id_processo_innovativo'], 'exist', 'skipOnError' => true, 'targetClass' => ProcessoInnovativo::className(), 'targetAttribute' => ['id_processo_innovativo' => 'id_processo_innovativo']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_processo_aziendale' => 'Id Processo Aziendale',
            'id_processo_innovativo' => 'Id Processo Innovativo',
            'nome' => 'Nome',
            'id_azienda' => 'Id Azienda',
            'data_inizio' => 'Data Inizio',
            'data_fine' => 'Data Fine',
            'descrizione' => 'Descrizione',
            'copertina' => 'Copertina',
            'id_fase_attuale' => 'Id Fase Attuale',
        ];
    }

    /**
     * Gets query for [[FaseReales]].
     *
     * @return ActiveQuery
     */
    public function getFaseReales()
    {
        return Yii::$app->db->hasMany(FaseReale::className(), ['id_processo_aziendale' => 'id_processo_aziendale']);
    }

    /**
     * Gets query for [[ProcessoInnovativo]].
     *
     * @return ActiveQuery
     */
    public function getProcessoInnovativo()
    {
        return Yii::$app->db->hasOne(ProcessoInnovativo::className(), ['id_processo_innovativo' => 'id_processo_innovativo']);
    }
}
