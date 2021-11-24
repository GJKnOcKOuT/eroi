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

class m191014_110000_add_more_fields_notification_conf extends Migration
{
    const TABLE = 'notificationconf';

    public function safeUp()
    {
       $defaultValueEmail = arter\amos\notificationmanager\widgets\NotifyFrequencyAdvancedWidget::DEFAULT_EMAIL_FREQUENCY;
       $this->addColumn(self::TABLE, 'profilo_successo_email' ,$this->integer(1)->defaultValue($defaultValueEmail)->after('sms'));
       $this->addColumn(self::TABLE, 'contenuti_successo_email' ,$this->integer(1)->defaultValue($defaultValueEmail)->after('sms'));
       $this->addColumn(self::TABLE, 'periodo_inattivita_flag' ,$this->integer(1)->defaultValue(1)->after('sms'));
       $this->addColumn(self::TABLE, 'contatti_suggeriti_email' ,$this->integer(1)->defaultValue($defaultValueEmail)->after('sms'));
       $this->addColumn(self::TABLE, 'contatto_accettato_flag' ,$this->integer(1)->defaultValue(1)->after('sms'));
    }

    public function safeDown()
    {
        $this->dropColumn(self::TABLE, 'contatto_accettato_flag');
        $this->dropColumn(self::TABLE, 'contatti_suggeriti_email');
        $this->dropColumn(self::TABLE, 'periodo_inattivita_flag');
        $this->dropColumn(self::TABLE, 'contenuti_successo_email');
        $this->dropColumn(self::TABLE, 'profilo_successo_email');
    }
}
