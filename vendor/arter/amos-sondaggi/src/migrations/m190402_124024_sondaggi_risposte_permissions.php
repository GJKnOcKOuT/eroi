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
 * @package    arter\amos\sondaggi\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationPermissions;
use yii\rbac\Permission;

/**
 * Class m180911_081424_new_compila_sondaggi_widgets_permissions
 */
class m190402_124024_sondaggi_risposte_permissions extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        $prefixStr = 'Permissions for the dashboard for the widget ';
        return [
            [
                'name' => 'readOwnSondaggiRisposte',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Check if read sondaggi risposte',
                'ruleName' => \arter\amos\core\rules\DefaultOwnContentRule::className(),
                'parent' => ['COMPILATORE_SONDAGGI'],
                'children' => ['SONDAGGIRISPOSTE_READ']
            ],
            [
                'name' => 'updateOwnSondaggiRisposte',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Check if read sondaggi risposte',
                'ruleName' => \arter\amos\core\rules\DefaultOwnContentRule::className(),
                'parent' => ['COMPILATORE_SONDAGGI'],
                'children' => ['SONDAGGIRISPOSTE_UPDATE']
            ],
            [
                'name' => 'deleteOwnSondaggiRisposte',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Check if read sondaggi risposte',
                'ruleName' => \arter\amos\core\rules\DefaultOwnContentRule::className(),
                'parent' => ['COMPILATORE_SONDAGGI'],
                'children' => ['SONDAGGIRISPOSTE_DELETE']
            ],
           [
                'name' => 'SONDAGGIRISPOSTE_READ',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Check if read sondaggi risposte',
                'parent' => ['AMMINISTRAZIONE_SONDAGGI']
            ],
            [
                'name' => 'SONDAGGIRISPOSTE_DELETE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Check if delete sondaggi risposte',
                'parent' => ['AMMINISTRAZIONE_SONDAGGI']
            ],
            [
                'name' => 'SONDAGGIRISPOSTE_UPDATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Check if update sondaggi risposte',
                'parent' => ['AMMINISTRAZIONE_SONDAGGI']
            ],


        ];
    }
}
