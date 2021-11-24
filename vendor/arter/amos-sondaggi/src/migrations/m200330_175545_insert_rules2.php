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
 * Class m200306_075522_insert_rules
 */
class m200330_175545_insert_rules2 extends Migration
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
            'nome' => 'Telefono con prefix internazionale',
            'descrizione' => 'Verifica che sia stato inserito un numero telefonico con prefisso internazionale',
            'standard' => null,
            'custom' => 1,
            'namespace' => null,
            'codice_custom' => '\arter\amos\core\validators\PhoneValidator::className(), \'international\' => true,',
        ]);

        $this->insert(self::TABLE_TIPO,
            [
            'nome' => 'Telefono semplice',
            'descrizione' => 'Verifica che sia stato inserito un numero telefonico',
            'standard' => null,
            'custom' => 1,
            'namespace' => 'arter\amos\core\validators\PhoneValidator',
            'codice_custom' => null,
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