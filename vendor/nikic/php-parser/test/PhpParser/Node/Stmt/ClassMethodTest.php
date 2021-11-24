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


namespace PhpParser\Node\Stmt;

class ClassMethodTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provideModifiers
     */
    public function testModifiers($modifier) {
        $node = new ClassMethod('foo', array(
            'type' => constant('PhpParser\Node\Stmt\Class_::MODIFIER_' . strtoupper($modifier))
        ));

        $this->assertTrue($node->{'is' . $modifier}());
    }

    public function testNoModifiers() {
        $node = new ClassMethod('foo', array('type' => 0));

        $this->assertTrue($node->isPublic());
        $this->assertFalse($node->isProtected());
        $this->assertFalse($node->isPrivate());
        $this->assertFalse($node->isAbstract());
        $this->assertFalse($node->isFinal());
        $this->assertFalse($node->isStatic());
    }

    public function provideModifiers() {
        return array(
            array('public'),
            array('protected'),
            array('private'),
            array('abstract'),
            array('final'),
            array('static'),
        );
    }

    /**
     * Checks that implicit public modifier detection for method is working
     *
     * @dataProvider implicitPublicModifiers
     *
     * @param integer $modifier Node type modifier
     */
    public function testImplicitPublic($modifier)
    {
        $node = new ClassMethod('foo', array(
            'type' => constant('PhpParser\Node\Stmt\Class_::MODIFIER_' . strtoupper($modifier))
        ));

        $this->assertTrue($node->isPublic(), 'Node should be implicitly public');
    }

    public function implicitPublicModifiers() {
        return array(
            array('abstract'),
            array('final'),
            array('static'),
        );
    }
}
