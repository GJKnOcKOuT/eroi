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

namespace yii\debug\components\search\matchers;

/**
 * MatcherInterface should be implemented by all matchers that are used in a filter.
 *
 * @author Mark Jebri <mark.github@yandex.ru>
 * @since 2.0
 */
interface MatcherInterface
{
    /**
     * Checks if the value passed matches base value.
     *
     * @param mixed $value value to be matched
     * @return bool if there is a match
     */
    public function match($value);

    /**
     * Sets base value to match against
     *
     * @param mixed $value
     */
    public function setValue($value);

    /**
     * Checks if base value is set
     *
     * @return bool if base value is set
     */
    public function hasValue();
}
