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
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace yii\i18n;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;

/**
 * Locale provides various locale information via convenient methods.
 *
 * The class requires [PHP intl extension](https://secure.php.net/manual/en/book.intl.php) to be installed.
 *
 * @property string $currencySymbol This property is read-only.
 *
 * @since 2.0.14
 */
class Locale extends Component
{
    /**
     * @var string the locale ID.
     * If not set, [[\yii\base\Application::language]] will be used.
     */
    public $locale;


    /**
     * {@inheritdoc}
     */
    public function init()
    {
        if (!extension_loaded('intl')) {
            throw new InvalidConfigException('Locale component requires PHP intl extension to be installed.');
        }

        if ($this->locale === null) {
            $this->locale = Yii::$app->language;
        }
    }

    /**
     * Returns a currency symbol
     *
     * @param string $currencyCode the 3-letter ISO 4217 currency code to get symbol for. If null,
     * method will attempt using currency code from [[locale]].
     * @return string
     */
    public function getCurrencySymbol($currencyCode = null)
    {
        $locale = $this->locale;

        if ($currencyCode !== null) {
            $locale .= '@currency=' . $currencyCode;
        }

        $formatter = new \NumberFormatter($locale, \NumberFormatter::CURRENCY);
        return $formatter->getSymbol(\NumberFormatter::CURRENCY_SYMBOL);
    }
}
