<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "padre_di".
 *
 * @property int $id_padre
 * @property int $id_figlio
 *
 * @property FasiDiProcesso $figlio
 * @property FasiDiProcesso $padre
 */
class PadreDi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'padre_di';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_padre', 'id_figlio'], 'required'],
            [['id_padre', 'id_figlio'], 'integer'],
            [['id_padre', 'id_figlio'], 'unique', 'targetAttribute' => ['id_padre', 'id_figlio']],
            [['id_padre'], 'exist', 'skipOnError' => true, 'targetClass' => FasiDiProcesso::className(), 'targetAttribute' => ['id_padre' => 'id_fasi_di_processo']],
            [['id_figlio'], 'exist', 'skipOnError' => true, 'targetClass' => FasiDiProcesso::className(), 'targetAttribute' => ['id_figlio' => 'id_fasi_di_processo']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_padre' => 'Id Padre',
            'id_figlio' => 'Id Figlio',
        ];
    }

    /**
     * Gets query for [[Figlio]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFiglio()
    {
        return $this->hasOne(FasiDiProcesso::className(), ['id_fasi_di_processo' => 'id_figlio']);
    }

    /**
     * Gets query for [[Padre]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPadre()
    {
        return $this->hasOne(FasiDiProcesso::className(), ['id_fasi_di_processo' => 'id_padre']);
    }
}
