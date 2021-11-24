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
 * @package    arter\amos\core\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationTableCreation;

/**
 * Class m201113_142318_create_table_map_widget_places
 */
class m201113_142318_create_table_map_widget_places extends AmosMigrationTableCreation
{
    /**
     * @inheritdoc
     */
    protected function setTableName()
    {
        $this->tableName = '{{%map_widget_places}}';
    }
    
    /**
     * @inheritdoc
     */
    protected function setTableFields()
    {
        $this->tableFields = [
            'place_id' => $this->string(255)->null()->comment('Codice recupero place'),
            'place_response' => $this->text()->null()->comment('Risposta'),
            'place_type' => $this->string(255)->null()->comment('Tipologia di recupero dati'),
            'country' => $this->string(255)->null()->comment('Paese'),
            'region' => $this->string(255)->null()->comment('Regione'),
            'province' => $this->string(255)->null()->comment('Provincia'),
            'postal_code' => $this->string(255)->null()->comment('CAP'),
            'city' => $this->string(255)->null()->comment('Città'),
            'address' => $this->string(255)->null()->comment('Via/Piazza'),
            'street_number' => $this->string(255)->null()->comment('Numero civico'),
            'latitude' => $this->string(255)->null()->comment('Latitudine'),
            'longitude' => $this->string(255)->null()->comment('Longitudine'),
        ];
    }
    
    /**
     * @inheritdoc
     */
    protected function afterTableCreation()
    {
        $this->addPrimaryKey('pk_map_widget_places_place_id', 'map_widget_places', 'place_id');
    }
}
