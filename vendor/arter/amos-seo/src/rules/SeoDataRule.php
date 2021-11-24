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
 * @package    arter\amos\moodle\rules
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\seo\rules;

use arter\amos\seo\models\SeoData;
use Yii;
use yii\log\Logger;
use yii\rbac\Rule;

/**
 * Class ShowWidgetIconMoodleRankingRule
 * @package arter\amos\moodle\rules
 */
class SeoDataRule extends Rule
{
    public $name = 'SeoDataRule';
    
    /**
     * @inheritdoc
     */
    public function execute($user, $item, $params)
    {
        /**
         * @var $model SeoData
         */
        $model = $params['model'];

        //The base class name
        $baseClassName = \yii\helpers\StringHelper::basename($model->classname);
        
        $permissionType = $item->name;
        switch ($permissionType) {
            case 'SEODATA_READ':
                $modulePremission = strtoupper($baseClassName . '_READ');
                break;

            case 'SEODATA_CREATE':
                $modulePremission = strtoupper($baseClassName . '_CREATE');
                break;

            case 'SEODATA_UPDATE':
                $modulePremission = strtoupper($baseClassName . '_UPDATE');
                break;

            case 'SEODATA_DELETE':
                $modulePremission = strtoupper($baseClassName . '_DELETE');
                break;

            default:
                $modulePremission = null;
        }

        if (!is_null($modulePremission)) {
            $retVal = \Yii::$app->user->can($modulePremission, ['model' => $model->owner]);
        } else {
            $retVal = false;
        }

        return $retVal;
    }
}
