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
 * @package    arter\amos\admin\widgets
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\admin\widgets;

use arter\amos\admin\AmosAdmin;
use arter\amos\admin\models\UserProfile;
use arter\amos\core\icons\AmosIcons;
use yii\base\Widget;

/**
 * Class GoogleContactWidget
 * @package arter\amos\admin\widgets
 */
class GoogleContactWidget extends Widget
{
    /** @var  UserProfile $model */
    public $model;

    /**
     * widget initialization
     */
    public function init()
    {
        parent::init();

        if (is_null($this->model)) {
            throw new \Exception(AmosAdmin::t('amosadmin', 'Missing model'));
        }
    }

    /**
     * @inheritdoc
     */
    public function run()
    {

        if($this->model->isGoogleContact()) {
            $googleContactIcon = AmosIcons::show('google', [
                'class' => 'am-2',
                'title' => AmosAdmin::t('amosadmin', 'Google Contact')
            ]);
            return $googleContactIcon;
        }else{
            return '';
        }
    }


}