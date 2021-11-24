<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see http://example.com Developers'community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    arter\amos\ticket\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationPermissions;
use yii\rbac\Permission;

/**
 * Class m201028_102641_add_manage_ticket_referees_notifications_permission
 */
class m201028_102641_add_manage_ticket_referees_notifications_permission extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return [
            [
                'name' => 'MANAGE_REFEREE_CATEGORIES_TICKET_NOTIFICATIONS',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso per i referenti di categoria di scegliere se ricevere o meno le notifiche',
                'parent' => ['REFERENTE_TICKET', 'AMMINISTRATORE_TICKET']
            ]
        ];
    }
}
