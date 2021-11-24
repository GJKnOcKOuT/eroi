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

class m190116_091755_add_permission_sondaggi_validate extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return [
            [
                'name' => 'SONDAGGI_VALIDATOR',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permission to validate a news with cwh query',
                'parent' => ['AMMINISTRAZIONE_SONDAGGI']
            ],
            [
                'name' => 'SondaggiValidate',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permission to validate a news with cwh query',
                'ruleName' => \arter\amos\core\rules\ValidatorUpdateContentRule::className(),
                'parent' => ['VALIDATED_BASIC_USER','SONDAGGI_VALIDATOR'],
                'children' => [
                    'SONDAGGI_UPDATE',
                    'SONDAGGI_CREATE',
                    'SONDAGGIDOMANDE_CREATE',
                    'SONDAGGIDOMANDE_UPDATE',
                    'SONDAGGIDOMANDEPAGINE_CREATE',
                    'SONDAGGIDOMANDEPAGINE_UPDATE',
                    'arter\amos\sondaggi\widgets\icons\WidgetIconSondaggi',
                    'arter\amos\sondaggi\widgets\icons\WidgetIconPubblicaSondaggi',
                    'SondaggiWorkflow/VALIDATO',
                    'SondaggiWorkflow/BOZZA'
                ],
            ],
        ];
    }
}
