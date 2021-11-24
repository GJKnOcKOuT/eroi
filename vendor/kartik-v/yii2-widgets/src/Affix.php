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
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2018
 * @package yii2-widgets
 * @version 3.4.1
 */

namespace kartik\widgets;

/**
 * A scrollspy and affixed enhanced navigation to highlight sections and secondary
 * sections in each page
 *
 * For example:
 *
 * ```php
 * echo Affix::widget([
 *     'items' => [
 *         [
 *             'url' => '#section-1',
 *             'label' => 'Section 1',
 *             'icon' => 'asterisk'
 *         ],
 *         [
 *             'url' => '#section-2',
 *             'label' => 'Section 2',
 *             'icon' => 'asterisk'
 *             'items' => [
 *                  ['url' => '#section-2-1', 'label' => 'Section 2.1'],
 *                  ['url' => '#section-2-2', 'label' => 'Section 2.2'],
 *             ],
 *         ],
 *     ],
 * ]);
 * ```
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 */
class Affix extends \kartik\affix\Affix
{
}
