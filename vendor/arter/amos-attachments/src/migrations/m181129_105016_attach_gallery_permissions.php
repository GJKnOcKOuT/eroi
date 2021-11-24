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
class m181129_105016_attach_gallery_permissions extends AmosMigrationPermissions
{

    /**
    * @inheritdoc
    */
    protected function setRBACConfigurations()
    {
        $prefixStr = '';

        return [
                [
                    'name' =>  'ATTACH_GALLERY_ADMINISTRATOR',
                    'type' => Permission::TYPE_PERMISSION,
                    'description' => 'Permesso di CREATE sul model AttachGalleryCategory',
                    'ruleName' => null,
                    'parent' => ['ADMIN']
                ],
                [
                    'name' =>  'ATTACH_GALLERY_READER',
                    'type' => Permission::TYPE_PERMISSION,
                    'description' => 'Permesso di CREATE sul model AttachGalleryCategory',
                    'ruleName' => null,
                    'parent' => ['BASIC_USER']
                ],
                [
                    'name' =>  'ATTACHGALLERYCATEGORY_CREATE',
                    'type' => Permission::TYPE_PERMISSION,
                    'description' => 'Permesso di CREATE sul model AttachGalleryCategory',
                    'ruleName' => null,
                    'parent' => ['ATTACH_GALLERY_ADMINISTRATOR']
                ],
                [
                    'name' =>  'ATTACHGALLERYCATEGORY_READ',
                    'type' => Permission::TYPE_PERMISSION,
                    'description' => 'Permesso di READ sul model AttachGalleryCategory',
                    'ruleName' => null,
                    'parent' => ['ATTACH_GALLERY_ADMINISTRATOR','ATTACH_GALLERY_READER']
                    ],
                [
                    'name' =>  'ATTACHGALLERYCATEGORY_UPDATE',
                    'type' => Permission::TYPE_PERMISSION,
                    'description' => 'Permesso di UPDATE sul model AttachGalleryCategory',
                    'ruleName' => null,
                    'parent' => ['ATTACH_GALLERY_ADMINISTRATOR']
                ],
                [
                    'name' =>  'ATTACHGALLERYCATEGORY_DELETE',
                    'type' => Permission::TYPE_PERMISSION,
                    'description' => 'Permesso di DELETE sul model AttachGalleryCategory',
                    'ruleName' => null,
                    'parent' => ['ATTACH_GALLERY_ADMINISTRATOR']
                ],
            // ----------------
            [
                'name' =>  'ATTACHGALLERY_CREATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di CREATE sul model AttachGallery',
                'ruleName' => null,
                'parent' => ['ATTACH_GALLERY_ADMINISTRATOR']
            ],
            [
                'name' =>  'ATTACHGALLERY_READ',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di READ sul model AttachGallery',
                'ruleName' => null,
                'parent' => ['ATTACH_GALLERY_ADMINISTRATOR', 'ATTACH_GALLERY_READER']
            ],
            [
                'name' =>  'ATTACHGALLERY_UPDATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di UPDATE sul model AttachGallery',
                'ruleName' => null,
                'parent' => ['ATTACH_GALLERY_ADMINISTRATOR']
            ],
            [
                'name' =>  'ATTACHGALLERY_DELETE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di DELETE sul model AttachGallery',
                'ruleName' => null,
                'parent' => ['ATTACH_GALLERY_ADMINISTRATOR']
            ],
            // -----------------
            [
                'name' =>  'ATTACHGALLERYIMAGE_CREATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di CREATE sul model AttachGalleryImage',
                'ruleName' => null,
                'parent' => ['ATTACH_GALLERY_ADMINISTRATOR']
            ],
            [
                'name' =>  'ATTACHGALLERYIMAGE_READ',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di READ sul model AttachGalleryImage',
                'ruleName' => null,
                'parent' => ['ATTACH_GALLERY_ADMINISTRATOR','ATTACH_GALLERY_READER']
            ],
            [
                'name' =>  'ATTACHGALLERYIMAGE_UPDATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di UPDATE sul model AttachGalleryImage',
                'ruleName' => null,
                'parent' => ['ATTACH_GALLERY_ADMINISTRATOR']
            ],
            [
                'name' =>  'ATTACHGALLERYIMAGE_DELETE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di DELETE sul model AttachGalleryImage',
                'ruleName' => null,
                'parent' => ['ATTACH_GALLERY_ADMINISTRATOR']
            ],

            ];
    }
}
