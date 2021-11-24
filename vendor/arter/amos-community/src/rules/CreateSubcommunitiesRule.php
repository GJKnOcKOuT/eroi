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

use arter\amos\community\models\Community;
use arter\amos\core\rules\DefaultOwnContentRule;

/**
 * Class CreateSubcommunitiesRule
 * @package arter\amos\community\rules
 */
class CreateSubcommunitiesRule extends DefaultOwnContentRule
{
    /**
     * @inheritdoc
     */
    public $name = 'createSubcommunities';

    /**
     * @inheritdoc
     */
    public function execute($user, $item, $params)
    {
        $cwhModule = \Yii::$app->getModule('cwh');
        if (isset($params['model'])) {
            /** @var Community $model */
            $model = $params['model'];
            if (!isset($model->id)) {
                $post = \Yii::$app->getRequest()->post();
                $get = \Yii::$app->getRequest()->get();
                if (isset($get['id'])) {
                    $model = $this->instanceModel($model, $get['id']);
                } elseif (isset($post['id'])) {
                    $model = $this->instanceModel($model, $post['id']);
                }
            }
            if (isset($cwhModule) && $model instanceof Community) {
                if (!is_null($model->id)) {
                    return ($model->isCommunityManager($user));
                } else {
                    $parentId = \Yii::$app->request->getQueryParam('parentId');
                    if($parentId){
                       $parent = Community::findOne($parentId);
                       if($parent){
                           return $parent->isCommunityManager($user);
                       }
                   }
                }
            }
        }
        return false;
    }
}
