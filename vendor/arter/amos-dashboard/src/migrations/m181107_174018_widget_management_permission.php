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
 * @package    arter\amos\basic\template
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use yii\db\Schema;

/**
 * Default migration for the relations of the Application Project
 */
class m181107_174018_widget_management_permission extends \arter\amos\core\migration\AmosMigrationPermissions {

    protected function setAuthorizations()
    {
        $this->authorizations = [
            [
                'name' => \arter\amos\dashboard\widgets\icons\WidgetIconManagement::className(),
                'type' => \yii\rbac\Permission::TYPE_PERMISSION,
                'description' => 'Permission invitation frontend',
                'ruleName' => null,
                'parent' => ['ADMIN']
            ],
        ];
    }

}
