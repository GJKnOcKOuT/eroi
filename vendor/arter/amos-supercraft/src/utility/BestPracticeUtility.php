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
 * @package    arter\amos\best\practice\utility
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\best\practice\utility;

use arter\amos\admin\models\UserProfile;
use arter\amos\best\practice\models\BestPractice;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

/**
 * Class BestPracticeUtility
 * @package arter\amos\best\practice\utility
 */
class BestPracticeUtility
{
    /**
     * @return array
     * @throws \yii\base\InvalidConfigException
     */
    public static function getCreatedByUsersReadyForSelect()
    {
        /** @var ActiveQuery $query */
        $query = UserProfile::find();
        $query->innerJoin(BestPractice::tableName(), UserProfile::tableName() . '.user_id = ' . BestPractice::tableName() . '.created_by');
        $query->andWhere([BestPractice::tableName() . '.deleted_at' => null]);
        if (\Yii::$app->controller->id == 'super-craft') {
            if (\Yii::$app->controller->action->id == 'all' || \Yii::$app->controller->action->id == 'own-interest') {
                $query->andWhere([BestPractice::tableName() . '.status' => BestPractice::BESTPRACTICE_WORKFLOW_STATUS_VALIDATED]);
            } elseif (\Yii::$app->controller->action->id == 'to-validate') {
                $query->andWhere([BestPractice::tableName() . '.status' => BestPractice::BESTPRACTICE_WORKFLOW_STATUS_TOVALIDATE]);
            }
        }
        $query->orderBy([
            'cognome' => SORT_ASC,
            'nome' => SORT_ASC,
        ]);
        $query->groupBy(UserProfile::tableName() . '.user_id');
        $users = $query->all();
        return ArrayHelper::map($users, 'user_id', 'surnameName');
    }
}
