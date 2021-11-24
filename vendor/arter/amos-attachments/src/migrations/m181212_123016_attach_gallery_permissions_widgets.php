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
* Class m181129_105016_attach_gallery_category_permissions*/
class m181212_123016_attach_gallery_permissions_widgets extends AmosMigrationPermissions
{

    /**
    * @inheritdoc
    */
    protected function setRBACConfigurations()
    {
        $prefixStr = '';

        return [
                [
                    'name' => \arter\amos\attachments\widgets\icons\WidgetIconSingleGallery::className(),
                    'type' => Permission::TYPE_PERMISSION,
                    'description' => 'Permesso widget Gallery dashboard',
                    'ruleName' => null,
                    'parent' => ['ATTACH_GALLERY_ADMINISTRATOR']
                ],
                [
                    'name' => \arter\amos\attachments\widgets\icons\WidgetIconGallery::className(),
                    'update' => true,
                    'newValues' => ['removeParents' => ['ATTACH_GALLERY_ADMINISTRATOR']]
                ],
            ];
    }
}
