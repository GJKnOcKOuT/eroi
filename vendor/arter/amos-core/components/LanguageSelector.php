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
 * @package    arter\amos\core\components
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\core\components;

use yii\base\BootstrapInterface;

/**
 * Class LanguageSelector
 * @package arter\amos\core\components
 */
class LanguageSelector implements BootstrapInterface
{
    /**
     * @var array $supportedLanguages
     */
    public $supportedLanguages = [];

    /**
     * @inheritdoc
     */
    public function bootstrap($app)
    {
        $preferredLanguage = isset($app->request->cookies['language']) ? (string)$app->request->cookies['language'] : null;
        // or in case of database:
        // $preferredLanguage = $app->user->language;

        if (empty($preferredLanguage)) {
            $preferredLanguage = $app->request->getPreferredLanguage($this->supportedLanguages);
        }

        $app->language = $preferredLanguage;
    }
}
