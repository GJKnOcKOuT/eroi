<?php

namespace backend\modules\supercraft\models;

use Yii;

/**
 * This is the model class for table "configurazione_moduli_per_fase".
 *
 * @property int $id_fase
 * @property int $id_modulo_eroi
 * @property int|null $opzionale
 * @property int|null $ripetibile
 *
 * @property Fase $fase
 * @property ModuloEroi $moduloEroi
 */
class ConfigurazioneModuliPerFase extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'configurazione_moduli_per_fase';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_fase', 'id_modulo_eroi'], 'required'],
            [['id_fase', 'id_modulo_eroi', 'opzionale', 'ripetibile'], 'integer'],
            [['id_fase', 'id_modulo_eroi'], 'unique', 'targetAttribute' => ['id_fase', 'id_modulo_eroi']],
            [['id_fase'], 'exist', 'skipOnError' => true, 'targetClass' => Fase::className(), 'targetAttribute' => ['id_fase' => 'id_fase']],
            [['id_modulo_eroi'], 'exist', 'skipOnError' => true, 'targetClass' => ModuloEroi::className(), 'targetAttribute' => ['id_modulo_eroi' => 'id_modulo_eroi']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_fase' => 'Id Fase',
            'id_modulo_eroi' => 'Id Modulo Eroi',
            'opzionale' => 'Opzionale',
            'ripetibile' => 'Ripetibile',
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
     * Gets query for [[ModuloEroi]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getModuloEroi()
    {
        return $this->hasOne(ModuloEroi::className(), ['id_modulo_eroi' => 'id_modulo_eroi']);
    }
}
