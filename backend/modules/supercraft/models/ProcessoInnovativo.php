<?php

namespace backend\modules\supercraft\models;

use Yii;

/**
 * This is the model class for table "processo_innovativo".
 *
 * @property int $id_processo_innovativo
 * @property string|null $nome
 *
 * @property FasiDiProcesso[] $fasiDiProcessos
 * @property ProcessoAziendale[] $processoAziendales
 */
class ProcessoInnovativo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'processo_innovativo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_processo_innovativo' => 'Id Processo Innovativo',
            'nome' => 'Nome',
        ];
    }

    /**
     * Gets query for [[FasiDiProcessos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFasiDiProcessos()
    {
        return $this->hasMany(FasiDiProcesso::className(), ['id_processo_innovativo' => 'id_processo_innovativo']);
    }

    /**
     * Gets query for [[ProcessoAziendales]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProcessoAziendales()
    {
        return $this->hasMany(ProcessoAziendale::className(), ['id_processo_innovativo' => 'id_processo_innovativo']);
    }
}
