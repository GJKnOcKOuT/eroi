<?php

namespace backend\modules\supercraft\models;

use Yii;

/**
 * This is the model class for table "fase".
 *
 * @property int $id_fase
 * @property string|null $descrizione
 *
 * @property ConfigurazioneModuliPerFase[] $configurazioneModuliPerFases
 * @property FasiDiProcesso[] $fasiDiProcessos
 * @property ModuloEroi[] $moduloErois
 */
class Fase extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fase';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descrizione'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_fase' => 'Id Fase',
            'descrizione' => 'Descrizione',
        ];
    }

    /**
     * Gets query for [[ConfigurazioneModuliPerFases]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getConfigurazioneModuliPerFases()
    {
        return $this->hasMany(ConfigurazioneModuliPerFase::className(), ['id_fase' => 'id_fase']);
    }

    /**
     * Gets query for [[FasiDiProcessos]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getFasiDiProcessos()
    {
        return $this->hasMany(FasiDiProcesso::className(), ['id_fase' => 'id_fase']);
    }

    /**
     * Gets query for [[ModuloErois]].
     *
     * @return \yii\db\ActiveQuery|ModuloEroiQuery
     */
    public function getModuloErois()
    {
        return $this->hasMany(ModuloEroi::className(), ['id_modulo_eroi' => 'id_modulo_eroi'])->viaTable('configurazione_moduli_per_fase', ['id_fase' => 'id_fase']);
    }

    /**
     * {@inheritdoc}
     * @return FaseQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FaseQuery(get_called_class());
    }
}
