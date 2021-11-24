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
 * @package    arter\amos\socialauth
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\socialauth\components;

use arter\amos\core\icons\AmosIcons;
use arter\amos\socialauth\Module;
use Yii;
use yii\base\Component;
use yii\base\Widget;
use yii\db\ActiveRecord;
use yii\helpers\Html;

/**
 * Class FileImport
 * @package arter\amos\socialauth\components
 */
class SocialSignUpBar extends Widget
{
    public function run()
    {
        parent::run();

        /**
         * Return string
         */
        $result = '';

        /**
         * @var $module Module
         */
        $module = Yii::$app->getModule('socialauth');

        /**
         * List of providers configured
         */
        $providers = $module->providers;

        return $this->render('social-sign-up-bar', [
            'providers' => $providers
        ]);
    }
}
