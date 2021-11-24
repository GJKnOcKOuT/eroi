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
 * @package    arter\amos\news\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationPermissions;
use arter\amos\news\models\News;

/**
 * Class m170802_103511_add_news_workflow_permissions_to_news_validate
 */
class m170802_103511_add_news_workflow_permissions_to_news_validate extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return [
            [
                'name' => News::NEWS_WORKFLOW_STATUS_BOZZA,
                'update' => true,
                'newValues' => [
                    'addParents' => ['NewsValidate'],
                    'removeParents' => ['NewsValidateOnDomain']
                ]
            ],
            [
                'name' => News::NEWS_WORKFLOW_STATUS_DAVALIDARE,
                'update' => true,
                'newValues' => [
                    'addParents' => ['NewsValidate'],
                    'removeParents' => ['NewsValidateOnDomain']
                ]
            ],
            [
                'name' => News::NEWS_WORKFLOW_STATUS_VALIDATO,
                'update' => true,
                'newValues' => [
                    'addParents' => ['NewsValidate'],
                    'removeParents' => ['NewsValidateOnDomain']
                ]
            ],
            [
                'name' => 'NewsValidateOnDomain',
                'update' => true,
                'newValues' => [
                    'addParents' => ['VALIDATED_BASIC_USER']
                ]
            ],
            [
                'name' => 'NewsValidate',
                'update' => true,
                'newValues' => [
                    'addParents' => ['VALIDATED_BASIC_USER']
                ]
            ]
        ];
    }
}


