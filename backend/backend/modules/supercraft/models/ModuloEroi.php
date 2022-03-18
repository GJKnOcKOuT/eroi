<?php

namespace app\backend\modules\supercraft\models;

use Yii;

/**
 * This is the model class for table "modulo_eroi".
 *
 * @property int $id_modulo_eroi
 * @property string|null $descrizione
 * @property string $url
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
            [['url'], 'required'],
            [['url'], 'string', 'max' => 2000],
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
            'url' => 'Url',
        ];
    }

    /**
     * Gets query for [[AttivitaReales]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAttivitaReales()
    {
        return $this->hasMany(AttivitaReale::className(), ['id_modulo_eroi' => 'id_modulo_eroi']);
    }

    /**
     * Gets query for [[ConfigurazioneModuliPerFases]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getConfigurazioneModuliPerFases()
    {
        return $this->hasMany(ConfigurazioneModuliPerFase::className(), ['id_modulo_eroi' => 'id_modulo_eroi']);
    }

    /**
     * Gets query for [[Fases]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFases()
    {
        return $this->hasMany(Fase::className(), ['id_fase' => 'id_fase'])->viaTable('configurazione_moduli_per_fase', ['id_modulo_eroi' => 'id_modulo_eroi']);
    }
}
