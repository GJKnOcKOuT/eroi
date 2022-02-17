<?php

namespace backend\modules\supercraft\models;

use Yii;

/**
 * This is the model class for table "modulo_eroi".
 *
 * @property int $id_modulo_eroi
 * @property string|null $descrizione
 *
 * @property AttivitaReale[] $attivitaReales
 * @property ConfigurazioneModuliPerFase[] $configurazioneModuliPerFases
 * @property Fase[] $fases
 */
class ModuloEroi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'modulo_eroi';
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
            'id_modulo_eroi' => 'Id Modulo Eroi',
            'descrizione' => 'Descrizione',
        ];
    }

    /**
     * Gets query for [[AttivitaReales]].
     *
     * @return \yii\db\ActiveQuery|AttivitaRealeQuery
     */
    public function getAttivitaReales()
    {
        return $this->hasMany(AttivitaReale::className(), ['id_modulo_eroi' => 'id_modulo_eroi']);
    }

    /**
     * Gets query for [[ConfigurazioneModuliPerFases]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getConfigurazioneModuliPerFases()
    {
        return $this->hasMany(ConfigurazioneModuliPerFase::className(), ['id_modulo_eroi' => 'id_modulo_eroi']);
    }

    /**
     * Gets query for [[Fases]].
     *
     * @return \yii\db\ActiveQuery|FaseQuery
     */
    public function getFases()
    {
        return $this->hasMany(Fase::className(), ['id_fase' => 'id_fase'])->viaTable('configurazione_moduli_per_fase', ['id_modulo_eroi' => 'id_modulo_eroi']);
    }

    /**
     * {@inheritdoc}
     * @return ModuloEroiQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ModuloEroiQuery(get_called_class());
    }
}
