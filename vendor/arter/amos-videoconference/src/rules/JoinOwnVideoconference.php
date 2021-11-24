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
 * @package    arter\amos\videoconference
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\videoconference\rules;

use arter\amos\videoconference\AmosVideoconference;
use arter\amos\admin\models\UserProfile;
use yii\rbac\Item;
use yii\rbac\Rule;
use arter\amos\videoconference\models\Videoconf;
use arter\amos\videoconference\models\VideoconfUsersMm;
use arter\amos\admin\AmosAdmin;

/**
 * Class JoinOwnVideoconference
 * @package arter\amos\admin\rbac
 */
class JoinOwnVideoconference extends Rule
{
    public $name        = 'joinYourVideoconference';
    public $description = '';

    /**
     * @param string|integer $user the user ID.
     * @param Item $item the role or permission that this rule is associated with
     * @param array $params parameters passed to ManagerInterface::checkAccess().
     * @return boolean a value indicating whether the rule permits the role or permission it is associated with.
     */
    public function execute($user, $item, $params)
    {
        $model = ((isset($params['model']) && $params['model']) ? $params['model'] : new VideoconfUsersMm());
if(!($model instanceof VideoconfUsersMm)){
    $model = new VideoconfUsersMm();
}
        if (!$model->videoconf_id) {
            $post = \Yii::$app->getRequest()->post();
            $get  = \Yii::$app->getRequest()->get();

            if (isset($get['id'])) {
                $model = $this->instanceModel($model, $get['id']);
            } elseif (isset($post['id'])) {
                $model = $this->instanceModel($model, $post['id']);
            }
        }

        if (isset($model->user_profile_id)) {
            $userProfile = AmosAdmin::instance()->createModel('UserProfile');
            $profile     = $userProfile::findOne($model->user_profile_id);
            return ($profile->user_id == $user);
        }
        return false;
    }

    /**
     * @param Videoconf $model
     * @param int $modelId
     * @return mixed
     */
    private function instanceModel($model, $modelId)
    {
        /** @var Videoconf $videconfInstance */
        $videconfInstance = new VideoconfUsersMm;
        $instancedModel   = $videconfInstance::findOne(['videoconf_id' => $modelId]);
        if (!is_null($instancedModel)) {
            $model = $instancedModel;
        }
        return $model;
    }
}