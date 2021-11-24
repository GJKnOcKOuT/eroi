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

namespace yii\base;

/**
 * DynamicContentAwareInterface is the interface that should be implemented by classes
 * which support a [[View]] dynamic content feature.
 *
 * @author Sergey Makinen <sergey@makinen.ru>
 * @since 2.0.14
 */
interface DynamicContentAwareInterface
{
    /**
     * Returns a list of placeholders for dynamic content. This method
     * is used internally to implement the content caching feature.
     * @return array a list of placeholders.
     */
    public function getDynamicPlaceholders();

    /**
     * Sets a list of placeholders for dynamic content. This method
     * is used internally to implement the content caching feature.
     * @param array $placeholders a list of placeholders.
     */
    public function setDynamicPlaceholders($placeholders);

    /**
     * Adds a placeholder for dynamic content.
     * This method is used internally to implement the content caching feature.
     * @param string $name the placeholder name.
     * @param string $statements the PHP statements for generating the dynamic content.
     */
    public function addDynamicPlaceholder($name, $statements);
}
