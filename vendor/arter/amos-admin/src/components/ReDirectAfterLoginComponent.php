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
 * @package    arter\amos\admin\components
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\admin\components;

use arter\amos\admin\AmosAdmin;
use arter\amos\admin\models\UserProfile;
//use yii\base\BootstrapInterface;
use yii\base\Component;
//use yii\base\Event;

/**
 * Class FirstAccessWizardComponent
 * @package arter\amos\admin\components
 */
class ReDirectAfterLoginComponent extends Component /*implements BootstrapInterface*/
{

    /**
     * @param $url
     * @return \yii\web\Response
     */
    public function redirectToUrl($url){
        return \Yii::$app->controller->redirect([$url]);

    }
}
