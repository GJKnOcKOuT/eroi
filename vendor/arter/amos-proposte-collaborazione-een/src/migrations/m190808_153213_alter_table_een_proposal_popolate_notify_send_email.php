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
class m190808_153213_alter_table_een_proposal_popolate_notify_send_email extends Migration
{
    const TABLE = "notification_send_email";
    /**
     * @inheritdoc
     */
    public function up()
    {
       $p = new \arter\amos\een\models\base\EenPartnershipProposal();
       $classname = addslashes($p->classname());
       $eenProposal =  \arter\amos\een\models\EenPartnershipProposal::find()
            ->leftJoin('notification_send_email', "notification_send_email.classname = '$classname'")
            ->andWhere(['IS', 'notification_send_email.id', null])
			->andWhere(['>=', 'een_partnership_proposal.created_at', '2019-03-06'])
            ->all();
       foreach ($eenProposal as $proposal){
           echo $proposal->id ." , ";
           $proposal->saveNotificationSendEmail($proposal->classname(), \arter\amos\notificationmanager\models\NotificationChannels::CHANNEL_MAIL, $proposal->id, true);
       }
        return true;

    }

    /**
     * @inheritdoc
     */
    public function down()
    {

        return true;

    }
}
