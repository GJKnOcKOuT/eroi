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

namespace Symfony\Component\DomCrawler\Tests\Field;

use Symfony\Component\DomCrawler\Field\InputFormField;

class FormFieldTest extends FormFieldTestCase
{
    public function testGetName()
    {
        $node = $this->createNode('input', '', array('type' => 'text', 'name' => 'name', 'value' => 'value'));
        $field = new InputFormField($node);

        $this->assertEquals('name', $field->getName(), '->getName() returns the name of the field');
    }

    public function testGetSetHasValue()
    {
        $node = $this->createNode('input', '', array('type' => 'text', 'name' => 'name', 'value' => 'value'));
        $field = new InputFormField($node);

        $this->assertEquals('value', $field->getValue(), '->getValue() returns the value of the field');

        $field->setValue('foo');
        $this->assertEquals('foo', $field->getValue(), '->setValue() sets the value of the field');

        $this->assertTrue($field->hasValue(), '->hasValue() always returns true');
    }
}
