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
 * @package    arter\amos\myactivities\widgets
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\myactivities\widgets;

use arter\amos\admin\models\UserProfile;
use arter\amos\core\record\Record;

/**
 * Class ExpressionOfInterestToTakeover
 * @package arter\amos\myactivities\widgets
 */
class ExpressionOfInterestToTakeover extends \yii\base\Widget
{
    /** @var  Record $model */
    public $model;

    /** @var string $labelKey - label for activity title translation */
    public $labelKey;

    /**
     * @inheritdoc
     */
    public function run()
    {
        $model = $this->model->getWrappedObject();
        $userId = $model->updated_by;
        if (is_null($userId)) {
            $userId = $model->created_by;
        }
        $validationRequestTime = $model->updated_at;
        if (is_null($validationRequestTime)) {
            $validationRequestTime = $model->created_at;
        }
        if (!is_null($userId)) {
            $userProfile = UserProfile::find()->andWhere(['user_id' => $userId])->one();
            if (!is_null($userProfile)) {
                return $this->render('expression_of_interest_to_takeover', [
                    'userProfile' => $userProfile,
                    'model' => $this->model,
                    'validationRequestTime' => $validationRequestTime,
                    'labelKey' => $this->labelKey
                ]);
            }
        }
        return '';
    }
}
