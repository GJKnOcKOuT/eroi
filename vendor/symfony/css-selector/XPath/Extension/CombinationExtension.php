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


/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\CssSelector\XPath\Extension;

use Symfony\Component\CssSelector\XPath\XPathExpr;

/**
 * XPath expression translator combination extension.
 *
 * This component is a port of the Python cssselect library,
 * which is copyright Ian Bicking, @see https://github.com/SimonSapin/cssselect.
 *
 * @author Jean-François Simon <jeanfrancois.simon@sensiolabs.com>
 *
 * @internal
 */
class CombinationExtension extends AbstractExtension
{
    /**
     * {@inheritdoc}
     */
    public function getCombinationTranslators()
    {
        return array(
            ' ' => array($this, 'translateDescendant'),
            '>' => array($this, 'translateChild'),
            '+' => array($this, 'translateDirectAdjacent'),
            '~' => array($this, 'translateIndirectAdjacent'),
        );
    }

    /**
     * @param XPathExpr $xpath
     * @param XPathExpr $combinedXpath
     *
     * @return XPathExpr
     */
    public function translateDescendant(XPathExpr $xpath, XPathExpr $combinedXpath)
    {
        return $xpath->join('/descendant-or-self::*/', $combinedXpath);
    }

    /**
     * @param XPathExpr $xpath
     * @param XPathExpr $combinedXpath
     *
     * @return XPathExpr
     */
    public function translateChild(XPathExpr $xpath, XPathExpr $combinedXpath)
    {
        return $xpath->join('/', $combinedXpath);
    }

    /**
     * @param XPathExpr $xpath
     * @param XPathExpr $combinedXpath
     *
     * @return XPathExpr
     */
    public function translateDirectAdjacent(XPathExpr $xpath, XPathExpr $combinedXpath)
    {
        return $xpath
            ->join('/following-sibling::', $combinedXpath)
            ->addNameTest()
            ->addCondition('position() = 1');
    }

    /**
     * @param XPathExpr $xpath
     * @param XPathExpr $combinedXpath
     *
     * @return XPathExpr
     */
    public function translateIndirectAdjacent(XPathExpr $xpath, XPathExpr $combinedXpath)
    {
        return $xpath->join('/following-sibling::', $combinedXpath);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'combination';
    }
}
