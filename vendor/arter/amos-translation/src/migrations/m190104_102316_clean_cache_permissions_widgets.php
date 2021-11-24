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
* Class m190104_102316_clean_cache_permissions_widgets*/
class m190104_102316_clean_cache_permissions_widgets extends AmosMigrationPermissions
{

    /**
    * @inheritdoc
    */
    protected function setRBACConfigurations()
    {
        $prefixStr = '';

        return [
                [
                    'name' => \arter\amos\translation\widgets\icons\WidgetIconTrCleanCache::className(),
                    'type' => Permission::TYPE_PERMISSION,
                    'description' => 'Permission widget clean cache',
                    'ruleName' => null,
                    'parent' => ['CONTENT_TRANSLATOR','TRANSLATION_ADMINISTRATOR']
                ],
            ];
    }
}
