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
 * ReCaptcha widget validator.
 *
 * @author HimikLab
 * @package himiklab\yii2\recaptcha
 * @deprecated
 */
class ReCaptchaValidator extends ReCaptchaValidator2
{
    const SITE_VERIFY_URL_DEFAULT = 'https://www.google.com/recaptcha/api/siteverify';
    const SITE_VERIFY_URL_ALTERNATIVE = 'https://www.recaptcha.net/recaptcha/api/siteverify';

    public function init()
    {
        /** @var ReCaptcha $reCaptchaConfig */
        $reCaptchaConfig = Yii::$app->get('reCaptcha', false);

        if (!$this->secret) {
            if ($reCaptchaConfig && $reCaptchaConfig->secret) {
                $this->secret = $reCaptchaConfig->secret;
            } else {
                throw new InvalidConfigException('Required `secret` param isn\'t set.');
            }
        }
        if (!$this->siteVerifyUrl) {
            if ($reCaptchaConfig && $reCaptchaConfig->siteVerifyUrl) {
                $this->siteVerifyUrl = $reCaptchaConfig->siteVerifyUrl;
            } else {
                $this->siteVerifyUrl = self::SITE_VERIFY_URL_DEFAULT;
            }
        }

        parent::init();
    }
}
