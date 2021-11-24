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
use arter\amos\seo\rules\SeoDataRule;
use yii\rbac\Permission;


/**
* Class m180703_152225_seo_data_permissions*/
class m180703_152225_seo_data_permissions extends AmosMigrationPermissions
{

    /**
    * @inheritdoc
    */
    protected function setRBACConfigurations()
    {
        $prefixStr = '';

        return [
                [
                    'name' => 'SEO_USER',
                    'type' => Permission::TYPE_ROLE,
                    'description' => 'An user in seo plugin',
                    'ruleName' => null,
                    'parent' => ['BASIC_USER','ADMIN']
                ],
                [
                    'name' =>  'SEODATA_CREATE',
                    'type' => Permission::TYPE_PERMISSION,
                    'description' => 'Permesso di CREATE sul model SeoData',
                    'ruleName' => SeoDataRule::className(),
                    'parent' => ['SEO_USER']
                ],
                [
                    'name' =>  'SEODATA_READ',
                    'type' => Permission::TYPE_PERMISSION,
                    'description' => 'Permesso di READ sul model SeoData',
                    'ruleName' => SeoDataRule::className(),
                    'parent' => ['SEO_USER']
                    ],
                [
                    'name' =>  'SEODATA_UPDATE',
                    'type' => Permission::TYPE_PERMISSION,
                    'description' => 'Permesso di UPDATE sul model SeoData',
                    'ruleName' => SeoDataRule::className(),
                    'parent' => ['SEO_USER']
                ],
                [
                    'name' =>  'SEODATA_DELETE',
                    'type' => Permission::TYPE_PERMISSION,
                    'description' => 'Permesso di DELETE sul model SeoData',
                    'ruleName' => SeoDataRule::className(),
                    'parent' => ['SEO_USER']
                ],

            ];
    }
}
