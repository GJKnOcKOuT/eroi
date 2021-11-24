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

namespace yii\helpers;

/**
 * HtmlPurifier provides an ability to clean up HTML from any harmful code.
 *
 * Basic usage is the following:
 *
 * ```php
 * echo HtmlPurifier::process($html);
 * ```
 *
 * If you want to configure it:
 *
 * ```php
 * echo HtmlPurifier::process($html, [
 *     'Attr.EnableID' => true,
 * ]);
 * ```
 *
 * For more details please refer to [HTMLPurifier documentation](http://htmlpurifier.org/).
 *
 * @author Alexander Makarov <sam@rmcreative.ru>
 * @since 2.0
 */
class HtmlPurifier extends BaseHtmlPurifier
{
}
