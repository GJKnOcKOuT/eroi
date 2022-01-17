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
 * @package    arter\amos\bestpractice
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\best\practice\models\BestPractice;
use arter\amos\core\migration\AmosMigrationPermissions;
use yii\rbac\Permission;

/**
 * Class m190109_170607_fix_best_practice_permissions
 */
class m190109_170607_fix_best_practice_permissions extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return [
            [
                'name' =>'BESTPRACTICE_UPDATE',
                'update' => true,
                'newValues' => [
                    'addParents' => [\arter\amos\best\practice\rules\UpdateOwnBestPracticeRule::className()]
                ]
            ],
            [
                'name' => 'BESTPRACTICE_DELETE',
                'update' => true,
                'newValues' => [
                    'addParents' => [\arter\amos\best\practice\rules\DeleteOwnBestPracticeRule::className()]
                ]
            ]
        ];
    }
}
