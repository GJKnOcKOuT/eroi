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


namespace dmstr\helpers;

/*
 * @link http://www.diemeisterei.de/
 * @copyright Copyright (c) 2015 diemeisterei GmbH, Stuttgart
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Class Html.
 *
 * @author Sergej Kunz <s.kunz@herzogkommunikation.de>
 */
class Html extends \yii\helpers\Html
{
    /**
     * Use case:
     * \dmstr\helpers\Html::a("test link", ['create']).
     *
     * @param string $text
     * @param null   $url
     * @param array  $options
     *
     * @return string|null
     */
    public static function a($text, $url = null, $options = [])
    {
        return RouteAccess::can($url, function () use ($text, $url, $options) {
            return parent::a($text, $url, $options);
        }, function () {
            return;
        }, [
            $text,
            $options,
        ]);
    }
}
