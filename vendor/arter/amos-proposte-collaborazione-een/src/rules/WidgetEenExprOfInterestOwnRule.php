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
use arter\amos\news\models\News;
use Yii;

class WidgetEenExprOfInterestOwnRule extends DefaultOwnContentRule
{
    public $name = 'widgetEenExprOfInterestOwn';

    /**
     * @inheritdoc
     */
    public function execute($user, $item, $params)
    {
        $controllerId = \Yii::$app->controller->id;
//        if($controllerId != 'dashboard'){
            if(\Yii::$app->user->can('STAFF_EEN')){
                return false;
            }
            else {
                return true;
            }
//        }

//      return true;
    }

}
