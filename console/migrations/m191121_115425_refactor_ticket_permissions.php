<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    arter\platform\common\console\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationPermissions;
use arter\amos\core\migration\libs\common\MigrationCommon;

/**
 * Class m191121_115425_refactor_ticket_permissions
 */
class m191121_115425_refactor_ticket_permissions extends AmosMigrationPermissions {

    /**
     * @inheritdoc
     */
    public function safeUp() {
        parent::safeUp();
    }

    /**
     * @inheritdoc
     */
    public function safeDown() {
        MigrationCommon::printConsoleMessage('Migration down for m191121_115425_refactor_ticket_permissions is not allowed');
        return false;
    }

    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations() {
        return [
            [
                'name' => arter\amos\ticket\widgets\icons\WidgetIconTicketWaiting::className(),
                'update' => true,
                'newValues' => [
                    'removeParents' => ['OPERATORE_TICKET']
                ]
            ],
            [
                'name' => arter\amos\ticket\widgets\icons\WidgetIconTicketProcessing::className(),
                'update' => true,
                'newValues' => [
                    'removeParents' => ['OPERATORE_TICKET']
                ]
            ],
            [
                'name' => arter\amos\ticket\widgets\icons\WidgetIconTicketClosed::className(),
                'update' => true,
                'newValues' => [
                    'removeParents' => ['OPERATORE_TICKET']
                ]
            ],
            [
                'name' => arter\amos\ticket\widgets\icons\WidgetIconTicketAll::className(),
                'update' => true,
                'newValues' => [
                    'removeParents' => ['OPERATORE_TICKET']
                ]
            ],
            [
                'name' => arter\amos\ticket\widgets\icons\WidgetIconTicketCategorie::className(),
                'update' => true,
                'newValues' => [
                    'removeParents' => ['OPERATORE_TICKET']
                ],
            ],
            [
                'name' => arter\amos\ticket\widgets\icons\WidgetIconTicketAdminFaq::className(),
                'update' => true,
                'newValues' => [
                    'removeParents' => ['OPERATORE_TICKET']
                ],
            ],
        ];
    }

}
