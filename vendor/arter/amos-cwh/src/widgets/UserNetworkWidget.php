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
 * @package    arter\amos\cwh
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\cwh\widgets;

use arter\amos\core\module\BaseAmosModule;
use arter\amos\cwh\models\CwhConfig;
use yii\base\Widget;

/**
 * Class UserNetworkWidget
 * @package arter\amos\cwh\widgets
 *
 * Get User networks as table list
 * Foreach network type configured in cwh_config (except user), prints the list of networks of which the user is member
 */
class UserNetworkWidget extends Widget
{
    /**
     * @var int $userId - if null, logged user Id is considered
     */
    public $userId = null;

    /** @var bool|false $isUpdate - true if it edit mode, false otherwise */
    public $isUpdate = false;

    /**
     * widget initialization
     */
    public function init()
    {
        parent::init();

        if (is_null($this->userId)) {
            $this->userId = \Yii::$app->user->id;
        }

        if (is_null($this->userId)) {
            throw new \Exception(BaseAmosModule::t('amoscwh', 'Missing user id'));
        }
    }

    /**
     * @return string
     * @throws \yii\base\InvalidConfigException
     */
    public function run()
    {
        $networks = CwhConfig::find()->andWhere(['<>', 'tablename', 'user'])->all();

        $html = '';
        //foreach enabled network (cwhConfig) except user
        foreach ($networks as $network) {
            $networkClassname = $network->classname;
            $networkObject = \Yii::createObject($networkClassname);
            //find network widget printing the list of user networks (of which user is member of)
            if ($networkObject->hasMethod('getUserNetworkWidget')) {
                $html .= $networkObject->getUserNetworkWidget($this->userId, $this->isUpdate);
            }
        }
        return $html;
    }
}
