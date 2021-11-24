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

use arter\amos\core\migration\AmosMigrationPermissions;
use yii\rbac\Permission;


/**
* Class m180327_162827_add_auth_item_een_archived*/
class m190712_095527_permission_published_sondaggi extends AmosMigrationPermissions
{

    /**
    * @inheritdoc
    */
    protected function setRBACConfigurations()
    {
        $prefixStr = 'Permissions for publication';

        return [
            [
                'name' =>  \arter\amos\sondaggi\rules\SondaggiWorkflowPublishedRule::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => $prefixStr . 'permission publish sondaggi',
                'ruleName' => \arter\amos\sondaggi\rules\SondaggiWorkflowPublishedRule::className(),
                'parent' => ['AMMINISTRAZIONE_SONDAGGI','SondaggiValidate'],
                'children' => ['SondaggiWorkflow/VALIDATO']
           ],

            [
            'name' =>  'SondaggiWorkflow/VALIDATO',
            'update' => true,
            'newValues' => [
                'removeParents' => ['AMMINISTRAZIONE_SONDAGGI','SondaggiValidate']
                ],
            ]
        ];
    }
}
