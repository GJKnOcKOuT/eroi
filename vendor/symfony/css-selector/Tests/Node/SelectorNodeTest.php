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

namespace Symfony\Component\CssSelector\Tests\Node;

use Symfony\Component\CssSelector\Node\ElementNode;
use Symfony\Component\CssSelector\Node\SelectorNode;

class SelectorNodeTest extends AbstractNodeTest
{
    public function getToStringConversionTestData()
    {
        return array(
            array(new SelectorNode(new ElementNode()), 'Selector[Element[*]]'),
            array(new SelectorNode(new ElementNode(), 'pseudo'), 'Selector[Element[*]::pseudo]'),
        );
    }

    public function getSpecificityValueTestData()
    {
        return array(
            array(new SelectorNode(new ElementNode()), 0),
            array(new SelectorNode(new ElementNode(), 'pseudo'), 1),
        );
    }
}
