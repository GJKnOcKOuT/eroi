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
 * @package    arter\amos\news
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\een\rules;

use arter\amos\core\rules\DefaultOwnContentRule;

class UpdateOwnEenExprOfInterestRule extends DefaultOwnContentRule
{
    public $name = 'UpdateOwnEenExprOfInterest';

    public function execute($user, $item, $params)
    {
        return false;
//        if (isset($params['model'])) {
//            /** @var Record $model */
//            $model = $params['model'];
//            if (!$model->id) {
//                $post = \Yii::$app->getRequest()->post();
//                $get = \Yii::$app->getRequest()->get();
//                if (isset($get['id'])) {
//                    $model = $this->instanceModel($model, $get['id']);
//                } elseif (isset($post['id'])) {
//                    $model = $this->instanceModel($model, $post['id']);
//                }
//            }
//            return ($model->created_by == $user);
//        } else {
//            return false;
//        }
    }
}
