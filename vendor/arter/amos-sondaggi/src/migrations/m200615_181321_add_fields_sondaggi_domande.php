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
 * Class m200615_181321_add_fields_sondaggi_domande
 */
class m200615_181321_add_fields_sondaggi_domande extends Migration {

    const TABLE_DOMANDE = '{{%sondaggi_domande}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->addColumn(self::TABLE_DOMANDE, 'modello_risposte_id',
                $this->integer()->defaultValue(null)->after('nome_classe_validazione'));

        $this->addForeignKey('fk_modelli_predef_sondaggi_domande', self::TABLE_DOMANDE, 'modello_risposte_id', 'sondaggi_modelli_predefiniti', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropColumn(self::TABLE_DOMANDE, 'modello_risposte_id');

        $this->dropForeignKey('fk_modelli_predef_sondaggi_domande', self::TABLE_DOMANDE);
    }

}
