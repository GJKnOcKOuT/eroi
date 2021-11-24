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
 * Class m190921_161322_add_fields_sondaggi_1
 */
class m190921_161322_add_fields_sondaggi_1 extends Migration
{
    const TABLE         = '{{%sondaggi}}';
    const TABLE_DOMANDE = '{{%sondaggi_domande}}';
    const TABLE_MAP     = '{{%sondaggi_map}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(self::TABLE, 'frontend', $this->integer()->defaultValue(0)->after('sondaggi_temi_id'));
        $this->addColumn(self::TABLE, 'thank_you_page', $this->text()->defaultValue(null)->after('frontend'));
        $this->addColumn(self::TABLE, 'abilita_registrazione',
            $this->integer()->defaultValue(0)->after('thank_you_page'));
        $this->addColumn(self::TABLE_DOMANDE, 'introduzione', $this->text()->defaultValue(null)->after('id'));
        $this->addColumn(self::TABLE_DOMANDE, 'sondaggi_map_id', $this->integer()->defaultValue(null)->after('id'));

        $this->addForeignKey(
            'fk-sondaggi_domande-map_id', self::TABLE_DOMANDE, 'sondaggi_map_id', self::TABLE_MAP, 'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-sondaggi_domande-map_id', self::TABLE_DOMANDE);
        $this->dropColumn(self::TABLE_DOMANDE, 'sondaggi_map_id');
        $this->dropColumn(self::TABLE_DOMANDE, 'introduzione');
        $this->dropColumn(self::TABLE, 'abilita_registrazione');
        $this->dropColumn(self::TABLE, 'thank_you_page');
        $this->dropColumn(self::TABLE, 'frontend');
    }
}