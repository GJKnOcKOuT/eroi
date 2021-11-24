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


use arter\amos\events\models\Event;
use yii\db\Migration;

/**
 * Class m181106_150933_alter_table_event
 */
class m190508_161230_alter_table_event extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(Event::tableName(), 'has_tickets', $this->boolean()->notNull()->defaultValue(0)->comment('Gestione biglietti?')->after('show_on_frontend'));
        $this->addColumn(Event::tableName(), 'has_qr_code', $this->boolean()->notNull()->defaultValue(0)->comment('Gestione QR code?')->after('has_tickets'));
        $this->addColumn(Event::tableName(), 'gdpr_question_1', $this->text()->null()->after('community_id'));
        $this->addColumn(Event::tableName(), 'gdpr_question_2', $this->text()->null()->after('gdpr_question_1'));
        $this->addColumn(Event::tableName(), 'gdpr_question_3', $this->text()->null()->after('gdpr_question_2'));
        $this->addColumn(Event::tableName(), 'gdpr_question_4', $this->text()->null()->after('gdpr_question_3'));
        $this->addColumn(Event::tableName(), 'gdpr_question_5', $this->text()->null()->after('gdpr_question_4'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn(Event::tableName(), 'has_tickets');
        $this->dropColumn(Event::tableName(), 'has_qr_code');
        $this->dropColumn(Event::tableName(), 'gdpr_question_1');
        $this->dropColumn(Event::tableName(), 'gdpr_question_2');
        $this->dropColumn(Event::tableName(), 'gdpr_question_3');
        $this->dropColumn(Event::tableName(), 'gdpr_question_4');
        $this->dropColumn(Event::tableName(), 'gdpr_question_5');
    }

}
