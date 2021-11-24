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
 * Class m200402_173332_insert_rules_majority
 */
class m200402_173332_insert_rules_majority extends Migration
{
    const TABLE         = '{{%sondaggi_domande_rule_mm}}';
    const TABLE_TIPO    = '{{%sondaggi_domande_rule}}';
    const TABLE_DOMANDE = '{{%sondaggi_domande}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->insert(self::TABLE_TIPO,
            [
            'nome' => 'Maggiore età',
            'descrizione' => 'Verifica che sia stata inserita una data di nascita di un maggiorenne (ad oggi)',
            'standard' => null,
            'custom' => 1,
            'namespace' => null,
            'codice_custom' => '\arter\amos\sondaggi\validators\DateDiff::className(), \'value\' => 18,',
        ]);
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return true;
    }
}