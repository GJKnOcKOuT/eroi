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
use arter\amos\community\models\CommunityInterface;
use arter\amos\core\record\Record;
use arter\amos\core\rules\DefaultOwnContentRule;

/**
 * Class UpdateOwnWorkgroupsRule
 * @package arter\amos\community\rules
 */
class UpdateOwnWorkgroupsRule extends DefaultOwnContentRule
{
    /**
     * @inheritdoc
     */
    public $name = 'updateOwnWorkgroups';
    
    /**
     * @inheritdoc
     */
    public function execute($user, $item, $params)
    {
        if (isset($params['model'])) {
            /** @var Record $model */
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
            
            if ($model instanceof CommunityInterface) {
                // The model isn't an instance of Community. It checks immediately
                // if the model community creator is the same as the logged user.
                return ($model->community->created_by == $user);
            } elseif (($model instanceof Community) && ($model->context != Community::className())) {
                // The model is an instance of Community. It checks the community context.
                // If the community context is not equal to the community classname it checks
                // if the model community creator is the same as the logged user.
                return ($model->created_by == $user);
            }
        }
        
        return false;
    }
}
