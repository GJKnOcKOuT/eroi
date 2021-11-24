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
* Class m180116_103825_add_auth_item_latest_partnership_profiles*/
class m180116_104025_add_auth_item_latest_partnership_profiles extends AmosMigrationPermissions
{

    /**
    * @inheritdoc
    */
    protected function setRBACConfigurations()
    {
        $prefixStr = 'Permissions for the dashboard for the widget ';

        return [
                [
                    'name' =>  \arter\amos\partnershipprofiles\widgets\graphics\WidgetGraphicsLatestPartnershipProfiles::className(),
                    'type' => Permission::TYPE_PERMISSION,
                    'description' => $prefixStr . 'WidgetGraphicsLatestPartnershipProfiles',
                    'ruleName' => null,
                    'parent' => ['ADMIN','VALIDATED_BASIC_USER']
                ]

            ];
    }
}
