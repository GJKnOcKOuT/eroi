<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see https://repo.art-er.it Developers' community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    arter
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */


use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m200615_160624_add_tipologia_domanda
 */
class m200615_160624_add_tipologia_domanda extends Migration
{
    const TABLE = '{{%sondaggi_domande_tipologie}}';
    
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('sondaggi_domande_tipologie', ['tipologia' => 'Modello', 'descrizione' => "Sarà visualizzato un menu a tendina contenente i modelli disponibili, di cui si potrà effettuare una selezione singola", 'attivo' => 1, 'html_type' =>'select']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('sondaggi_domande_tipologie', ['tipologia' => 'Modello', 'descrizione' => "Sarà visualizzato un menu a tendina contenente i modelli disponibili, di cui si potrà effettuare una selezione singola", 'attivo' => 1, 'html_type' =>'select']);
    }

}
