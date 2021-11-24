<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see https://repo.art-er.it Developers' community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    arter
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

/**
 * @link https://github.com/himiklab/yii2-recaptcha-widget
 * @copyright Copyright (c) 2014-2019 HimikLab
 * @license http://opensource.org/licenses/MIT MIT
 */

namespace himiklab\yii2\recaptcha;

use Yii;
use yii\base\InvalidConfigException;

/**
 * Yii2 Google reCAPTCHA widget.
 *
 * For example:
 *
 * ```php
 * <?= $form->field($model, 'reCaptcha')->widget(
 *  ReCaptcha::className(),
 *  ['siteKey' => 'your siteKey']
 * ) ?>
 * ```
 *
 * or
 *
 * ```php
 * <?= ReCaptcha::widget([
 *  'name' => 'reCaptcha',
 *  'siteKey' => 'your siteKey',
 *  'widgetOptions' => ['class' => 'col-sm-offset-3']
 * ]) ?>
 * ```
 *
 * @see https://developers.google.com/recaptcha
 * @author HimikLab
 * @package himiklab\yii2\recaptcha
 * @deprecated
 */
class ReCaptcha extends ReCaptcha2
{
    const JS_API_URL_DEFAULT = '//www.google.com/recaptcha/api.js';
    const JS_API_URL_ALTERNATIVE = '//www.recaptcha.net/recaptcha/api.js';

    const SIZE_INVISIBLE = 'invisible';

    /** @var string Your secret. */
    public $secret;

    /** @var string Use [[SITE_VERIFY_URL_ALTERNATIVE]] when [[SITE_VERIFY_URL_DEFAULT]] is not accessible. */
    public $siteVerifyUrl;

    /** @var boolean */
    public $checkHostName = false;

    /** @var \yii\httpclient\Request */
    public $httpClientRequest;

    public function init()
    {
    }

    public function run()
    {
        /** @var self $reCaptchaConfig */
        $reCaptchaConfig = Yii::$app->get('reCaptcha', false);

        if (!$this->siteKey) {
            if ($reCaptchaConfig && $reCaptchaConfig->siteKey) {
                $this->siteKey = $reCaptchaConfig->siteKey;
            } else {
                throw new InvalidConfigException('Required `siteKey` param isn\'t set.');
            }
        }
        if (!$this->jsApiUrl) {
            if ($reCaptchaConfig && $reCaptchaConfig->jsApiUrl) {
                $this->jsApiUrl = $reCaptchaConfig->jsApiUrl;
            } else {
                $this->jsApiUrl = self::JS_API_URL_DEFAULT;
            }
        }

        parent::run();
    }
}
