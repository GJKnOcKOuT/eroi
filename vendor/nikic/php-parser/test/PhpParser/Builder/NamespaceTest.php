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

use PhpParser\Comment\Doc;
use PhpParser\Node;
use PhpParser\Node\Stmt;

class NamespaceTest extends \PHPUnit_Framework_TestCase
{
    protected function createNamespaceBuilder($fqn) {
        return new Namespace_($fqn);
    }

    public function testCreation() {
        $stmt1 = new Stmt\Class_('SomeClass');
        $stmt2 = new Stmt\Interface_('SomeInterface');
        $stmt3 = new Stmt\Function_('someFunction');
        $docComment = new Doc('/** Test */');
        $expected = new Stmt\Namespace_(
            new Node\Name('Name\Space'),
            array($stmt1, $stmt2, $stmt3),
            array('comments' => array($docComment))
        );

        $node = $this->createNamespaceBuilder('Name\Space')
            ->addStmt($stmt1)
            ->addStmts(array($stmt2, $stmt3))
            ->setDocComment($docComment)
            ->getNode()
        ;
        $this->assertEquals($expected, $node);

        $node = $this->createNamespaceBuilder(new Node\Name(array('Name', 'Space')))
            ->setDocComment($docComment)
            ->addStmts(array($stmt1, $stmt2))
            ->addStmt($stmt3)
            ->getNode()
        ;
        $this->assertEquals($expected, $node);

        $node = $this->createNamespaceBuilder(null)->getNode();
        $this->assertNull($node->name);
        $this->assertEmpty($node->stmts);
    }
}
