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
 * @package   yii2-dynagrid
 * @author    Kartik Visweswaran <kartikv2@gmail.com>
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2015 - 2019
 * @version   1.5.1
 */

namespace kartik\dynagrid;

use Yii;

/**
 * Trait for dynagrid widgets
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 */
trait DynaGridTrait
{
    /**
     * Gets the category translated description
     *
     * @param string  $cat the category 'grid', 'filter', or 'sort'
     * @param boolean $initCap whether to capitalize first letter.
     *
     * @return string
     */
    public static function getCat($cat, $initCap = false)
    {
        if ($initCap) {
            return ucfirst(static::getCat($cat, false));
        }
        switch ($cat) {
            case DynaGridStore::STORE_GRID:
                return Yii::t('kvdynagrid', 'grid');
            case DynaGridStore::STORE_SORT:
                return Yii::t('kvdynagrid', 'sort');
            case DynaGridStore::STORE_FILTER:
                return Yii::t('kvdynagrid', 'filter');
            default:
                return Yii::t('kvdynagrid', $cat);
        }
    }
}
