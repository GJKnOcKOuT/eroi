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
 * Handles the creation of table `een_partnership_proposal`.
 */
class m181016_101613_modify_network_node extends Migration
{
    const TABLE = "een_expr_of_interest";
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->update('een_network_node', ['name' => 'Lombardia / Emilia Romagna (SIMPLER)'], ['id' => 1]);
        $this->update('een_network_node', ['name' => "Piemonte / Liguria / Val d'Aosta (ALPS)"], ['id' => 2]);
        $this->update('een_network_node', ['name' => "Veneto / Friuli / Trentino (FRIENDEUROPE)"], ['id' => 3]);
        $this->update('een_network_node', ['name' => "Toscana / Umbria / Marche (SME2EU)"], ['id' => 4]);
        $this->update('een_network_node', ['name' => "Lazio / Sardegna (ELSE)"], ['id' => 5]);
        $this->update('een_network_node', ['name' => "Abruzzo / Molise / Puglia / Basilicata / Calabria / Sicilia (BRIDG€CONOMIES)"], ['id' => 6]);
        $this->update('een_network_node', ['name' => "Other Country"], ['id' => 7]);







    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {

        return true;
    }
}
