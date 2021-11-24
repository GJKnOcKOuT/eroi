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


namespace PhpParser\Builder;

use PhpParser\Comment;
use PhpParser\Node\Expr;
use PhpParser\Node\Name;
use PhpParser\Node\Scalar;
use PhpParser\Node\Stmt;

class PropertyTest extends \PHPUnit_Framework_TestCase
{
    public function createPropertyBuilder($name) {
        return new Property($name);
    }

    public function testModifiers() {
        $node = $this->createPropertyBuilder('test')
            ->makePrivate()
            ->makeStatic()
            ->getNode()
        ;

        $this->assertEquals(
            new Stmt\Property(
                Stmt\Class_::MODIFIER_PRIVATE
              | Stmt\Class_::MODIFIER_STATIC,
                array(
                    new Stmt\PropertyProperty('test')
                )
            ),
            $node
        );

        $node = $this->createPropertyBuilder('test')
            ->makeProtected()
            ->getNode()
        ;

        $this->assertEquals(
            new Stmt\Property(
                Stmt\Class_::MODIFIER_PROTECTED,
                array(
                    new Stmt\PropertyProperty('test')
                )
            ),
            $node
        );

        $node = $this->createPropertyBuilder('test')
            ->makePublic()
            ->getNode()
        ;

        $this->assertEquals(
            new Stmt\Property(
                Stmt\Class_::MODIFIER_PUBLIC,
                array(
                    new Stmt\PropertyProperty('test')
                )
            ),
            $node
        );
    }

    public function testDocComment() {
        $node = $this->createPropertyBuilder('test')
            ->setDocComment('/** Test */')
            ->getNode();

        $this->assertEquals(new Stmt\Property(
            Stmt\Class_::MODIFIER_PUBLIC,
            array(
                new Stmt\PropertyProperty('test')
            ),
            array(
                'comments' => array(new Comment\Doc('/** Test */'))
            )
        ), $node);
    }

    /**
     * @dataProvider provideTestDefaultValues
     */
    public function testDefaultValues($value, $expectedValueNode) {
        $node = $this->createPropertyBuilder('test')
            ->setDefault($value)
            ->getNode()
        ;

        $this->assertEquals($expectedValueNode, $node->props[0]->default);
    }

    public function provideTestDefaultValues() {
        return array(
            array(
                null,
                new Expr\ConstFetch(new Name('null'))
            ),
            array(
                true,
                new Expr\ConstFetch(new Name('true'))
            ),
            array(
                false,
                new Expr\ConstFetch(new Name('false'))
            ),
            array(
                31415,
                new Scalar\LNumber(31415)
            ),
            array(
                3.1415,
                new Scalar\DNumber(3.1415)
            ),
            array(
                'Hallo World',
                new Scalar\String_('Hallo World')
            ),
            array(
                array(1, 2, 3),
                new Expr\Array_(array(
                    new Expr\ArrayItem(new Scalar\LNumber(1)),
                    new Expr\ArrayItem(new Scalar\LNumber(2)),
                    new Expr\ArrayItem(new Scalar\LNumber(3)),
                ))
            ),
            array(
                array('foo' => 'bar', 'bar' => 'foo'),
                new Expr\Array_(array(
                    new Expr\ArrayItem(
                        new Scalar\String_('bar'),
                        new Scalar\String_('foo')
                    ),
                    new Expr\ArrayItem(
                        new Scalar\String_('foo'),
                        new Scalar\String_('bar')
                    ),
                ))
            ),
            array(
                new Scalar\MagicConst\Dir,
                new Scalar\MagicConst\Dir
            )
        );
    }
}
