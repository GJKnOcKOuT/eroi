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

use Symfony\Component\CssSelector\Node\NodeInterface;

abstract class AbstractNodeTest extends \PHPUnit_Framework_TestCase
{
    /** @dataProvider getToStringConversionTestData */
    public function testToStringConversion(NodeInterface $node, $representation)
    {
        $this->assertEquals($representation, (string) $node);
    }

    /** @dataProvider getSpecificityValueTestData */
    public function testSpecificityValue(NodeInterface $node, $value)
    {
        $this->assertEquals($value, $node->getSpecificity()->getValue());
    }

    abstract public function getToStringConversionTestData();
    abstract public function getSpecificityValueTestData();
}
