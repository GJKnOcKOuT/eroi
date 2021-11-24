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

use PhpParser\Node;

class InterfaceTest extends \PHPUnit_Framework_TestCase
{
    public function testGetMethods() {
        $methods = array(
            new ClassMethod('foo'),
            new ClassMethod('bar'),
        );
        $interface = new Class_('Foo', array(
            'stmts' => array(
                new Node\Stmt\ClassConst(array(new Node\Const_('C1', new Node\Scalar\String_('C1')))),
                $methods[0],
                new Node\Stmt\ClassConst(array(new Node\Const_('C2', new Node\Scalar\String_('C2')))),
                $methods[1],
                new Node\Stmt\ClassConst(array(new Node\Const_('C3', new Node\Scalar\String_('C3')))),
            )
        ));

        $this->assertSame($methods, $interface->getMethods());
    }
}
