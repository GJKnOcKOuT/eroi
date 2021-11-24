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
 * @package    arter\amos\news
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationPermissions;
use yii\rbac\Permission;

/**
 * Class m170330_080532_add_allnews_permission_all_plugin_roles
 */
class m170330_080532_add_allnews_permission_all_plugin_roles extends AmosMigrationPermissions
{
    protected function setAuthorizations()
    {
        $this->authorizations = [
            [
                'name' => \arter\amos\news\widgets\icons\WidgetIconAllNews::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permission description',
                'ruleName' => null,
                'parent' => ['LETTORE_NEWS', 'CREATORE_NEWS', 'FACILITATORE_NEWS', 'AMMINISTRATORE_NEWS' ],
                'dontRemove' => true
            ],
            [
                'name' => \arter\amos\news\widgets\icons\WidgetIconNews::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permission description',
                'ruleName' => null,
                'parent' => ['LETTORE_NEWS', 'CREATORE_NEWS', 'FACILITATORE_NEWS', 'AMMINISTRATORE_NEWS' ],
                'dontRemove' => true
            ]
        ];
    }
}
