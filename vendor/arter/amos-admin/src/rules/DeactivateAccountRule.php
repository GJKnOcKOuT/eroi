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
 * @package    arter\amos\admin\rules
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\admin\rules;

use arter\amos\admin\models\UserProfile;
use arter\amos\core\rules\BasicContentRule;

/**
 * Class DeactivateAccountRule
 * @package arter\amos\admin\rules
 */
class DeactivateAccountRule extends BasicContentRule
{
    public $name = 'deactivateAccount';

    /**
     * @inheritdoc
     */
    public function ruleLogic($user, $item, $params, $model)
    {
        if (!\Yii::$app->user->can('ADMIN') && !\Yii::$app->user->can('AMMINISTRATORE_UTENTI')) {
            return true;
        }
        if (is_null($model) || (!($model instanceof UserProfile))) {
            return false;
        }
        return ($user != $model->user_id);
    }
}
