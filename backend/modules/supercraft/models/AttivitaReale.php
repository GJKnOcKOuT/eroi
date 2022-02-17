<?php

namespace backend\modules\supercraft\models;

use Yii;

/**
 * This is the model class for table "attivita_reale".
 *
 * @property int $id_attivita_reale
 * @property int $id_modulo_eroi
 * @property string|null $descrizione
 * @property string|null $data_inizio
 * @property string|null $data_fine
 * @property int $fase_reale_id_fase_reale
 *
 * @property FaseReale $faseRealeIdFaseReale
 * @property ModuloEroi $moduloEroi
 */
class AttivitaReale extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'attivita_reale';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_modulo_eroi', 'fase_reale_id_fase_reale'], 'required'],
            [['id_modulo_eroi', 'fase_reale_id_fase_reale'], 'integer'],
            [['data_inizio', 'data_fine'], 'safe'],
            [['descrizione'], 'string', 'max' => 1000],
            [['fase_reale_id_fase_reale'], 'exist', 'skipOnError' => true, 'targetClass' => FaseReale::className(), 'targetAttribute' => ['fase_reale_id_fase_reale' => 'id_fase_reale']],
            [['id_modulo_eroi'], 'exist', 'skipOnError' => true, 'targetClass' => ModuloEroi::className(), 'targetAttribute' => ['id_modulo_eroi' => 'id_modulo_eroi']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_attivita_reale' => 'Id Attivita Reale',
            'id_modulo_eroi' => 'Id Modulo Eroi',
            'descrizione' => 'Descrizione',
            'data_inizio' => 'Data Inizio',
            'data_fine' => 'Data Fine',
            'fase_reale_id_fase_reale' => 'Fase Reale Id Fase Reale',
        ];
    }

    /**
     * Gets query for [[FaseRealeIdFaseReale]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getFaseRealeIdFaseReale()
    {
        return $this->hasOne(FaseReale::className(), ['id_fase_reale' => 'fase_reale_id_fase_reale']);
    }

    /**
     * Gets query for [[ModuloEroi]].
     *
     * @return \yii\db\ActiveQuery|ModuloEroiQuery
     */
    public function getModuloEroi()
    {
        return $this->hasOne(ModuloEroi::className(), ['id_modulo_eroi' => 'id_modulo_eroi']);
    }

    /**
     * {@inheritdoc}
     * @return AttivitaRealeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AttivitaRealeQuery(get_called_class());
    }
}
