<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see http://example.com Developers'community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    arter\amos\core\models\base
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\core\models\base;

use arter\amos\core\module\BaseAmosModule;
use arter\amos\core\record\Record;
use yii\helpers\ArrayHelper;

/**
 * Class MapWidgetPlaces
 *
 * This is the base-model class for table "map_widget_places".
 *
 * @property string $place_id
 * @property string $place_response
 * @property string $place_type
 * @property string $country
 * @property string $region
 * @property string $province
 * @property string $postal_code
 * @property string $city
 * @property string $address
 * @property string $street_number
 * @property string $latitude
 * @property string $longitude
 *
 * @package arter\amos\core\models\base
 */
abstract class MapWidgetPlaces extends Record
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'map_widget_places';
    }
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['place_id'], 'required'],
            [['place_response'], 'string'],
            [[
                'place_id',
                'place_type',
                'country',
                'region',
                'province',
                'city',
                'address',
                'latitude',
                'longitude',
                'postal_code',
                'street_number'
            ], 'string', 'max' => 255],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'place_id' => BaseAmosModule::t('amoscore', 'Codice recupero place'),
            'place_response' => BaseAmosModule::t('amoscore', 'Risposta'),
            'place_type' => BaseAmosModule::t('amoscore', 'Tipologia di recupero dati'),
            'country' => BaseAmosModule::t('amoscore', 'Paese'),
            'region' => BaseAmosModule::t('amoscore', 'Regione'),
            'province' => BaseAmosModule::t('amoscore', 'Provincia'),
            'postal_code' => BaseAmosModule::t('amoscore', 'CAP'),
            'city' => BaseAmosModule::t('amoscore', 'Città'),
            'address' => BaseAmosModule::t('amoscore', 'Via/Piazza'),
            'street_number' => BaseAmosModule::t('amoscore', 'Numero civico'),
            'latitude' => BaseAmosModule::t('amoscore', 'Latitudine'),
            'longitude' => BaseAmosModule::t('amoscore', 'Longitudine'),
        ]);
    }
}
