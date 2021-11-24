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
 * Class m191106_172322_add_fields_sondaggi7
 */
class m191106_172322_add_fields_sondaggi7 extends Migration
{
    const TABLE         = '{{%sondaggi}}';
    const TABLE_DOMANDE = '{{%sondaggi_domande}}';
    const TABLE_MAP     = '{{%sondaggi_map}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(self::TABLE, 'abilita_criteri_valutazione', $this->integer()->defaultValue(0)->after('status'));
        $this->addColumn(self::TABLE, 'n_max_valutatori',
            $this->integer()->defaultValue(0)->after('abilita_criteri_valutazione'));       
        $this->addColumn(self::TABLE_DOMANDE, 'punteggio_max',
            $this->integer()->defaultValue(0)->after('sondaggi_domande_tipologie_id'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn(self::TABLE, 'abilita_criteri_valutazione');
        $this->dropColumn(self::TABLE, 'n_max_valutatori');      
        $this->dropColumn(self::TABLE_DOMANDE, 'punteggio_max');
    }
}