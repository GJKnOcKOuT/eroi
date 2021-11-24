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
 * @package    arter\amos\community\rules
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\community\rules;

use arter\amos\core\rules\DefaultOwnContentRule;
use arter\amos\projectmanagement\utility\ProjectManagementUtility;
use yii\rbac\Rule;

/**
 * Class DeleteOwnCommunitiesRule
 * @package arter\amos\community\rules
 */
class DeleteOwnCommunityRelationRule extends Rule
{
    public $name = 'deleteOwnCommunityRelation';

    /**
     * @inheritdoc
     */
    public function execute($user, $item, $params)
    {
        $modulePm = \Yii::$app->getModule('project_management');
        if(!empty($modulePm) && !empty($params['model'])){
            return \Yii::$app->user->can('arter\amos\projectmanagement\rules\PmDeleteOwnCommunityRelationRule', ['model' => $params['model']]) ;
        }
        else
            return true;
    }
}
