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

class ClassTest extends \PHPUnit_Framework_TestCase
{
    public function testIsAbstract() {
        $class = new Class_('Foo', array('type' => Class_::MODIFIER_ABSTRACT));
        $this->assertTrue($class->isAbstract());

        $class = new Class_('Foo');
        $this->assertFalse($class->isAbstract());
    }

    public function testIsFinal() {
        $class = new Class_('Foo', array('type' => Class_::MODIFIER_FINAL));
        $this->assertTrue($class->isFinal());

        $class = new Class_('Foo');
        $this->assertFalse($class->isFinal());
    }

    public function testGetMethods() {
        $methods = array(
            new ClassMethod('foo'),
            new ClassMethod('bar'),
            new ClassMethod('fooBar'),
        );
        $class = new Class_('Foo', array(
            'stmts' => array(
                new TraitUse(array()),
                $methods[0],
                new ClassConst(array()),
                $methods[1],
                new Property(0, array()),
                $methods[2],
            )
        ));

        $this->assertSame($methods, $class->getMethods());
    }

    public function testGetMethod() {
        $methodConstruct = new ClassMethod('__CONSTRUCT');
        $methodTest = new ClassMethod('test');
        $class = new Class_('Foo', array(
            'stmts' => array(
                new ClassConst(array()),
                $methodConstruct,
                new Property(0, array()),
                $methodTest,
            )
        ));

        $this->assertSame($methodConstruct, $class->getMethod('__construct'));
        $this->assertSame($methodTest, $class->getMethod('test'));
        $this->assertNull($class->getMethod('nonExisting'));
    }

    public function testDeprecatedTypeNode() {
        $class = new Class_('Foo', array('type' => Class_::MODIFIER_ABSTRACT));
        $this->assertTrue($class->isAbstract());
        $this->assertSame(Class_::MODIFIER_ABSTRACT, $class->flags);
        $this->assertSame(Class_::MODIFIER_ABSTRACT, $class->type);
    }
}
