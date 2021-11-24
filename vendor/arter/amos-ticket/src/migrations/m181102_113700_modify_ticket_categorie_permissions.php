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
use arter\amos\ticket\rules\TicketCategoriaDeleteRule;
use yii\helpers\ArrayHelper;
use yii\rbac\Permission;

/**
 * Class m181102_113700_modify_ticket_categorie_permissions
 */
class m181102_113700_modify_ticket_categorie_permissions extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return ArrayHelper::merge(
            $this->setTicketCategorieRulePermissions(),
            $this->updateTicketCategorieModelPermissions()
        );
    }

    /**
     *
     * @return array
     */
    private function setTicketCategorieRulePermissions()
    {
        return [
            [
                'name' => TicketCategoriaDeleteRule::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Who can delete',
                'ruleName' => TicketCategoriaDeleteRule::className(),
                'parent' => ['REFERENTE_TICKET']
            ],
        ];
    }

    /**
     * Ticket categories model permissions
     *
     * @return array
     */
    private function updateTicketCategorieModelPermissions()
    {
        return [
            [
                'name' => 'TICKETCATEGORIE_DELETE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di DELETE sul model TicketCategorie',
                //'update' => true,
                'parent' => [TicketCategoriaDeleteRule::className()]
            ],
        ];
    }
}
