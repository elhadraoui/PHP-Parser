<?php

namespace PHPParserTest\Builder;

use PHPParser\Node\Name;

use PHPParser\Node\Scalar\String;

use PHPParser\Node\Expr_Print;

use PHPParser\Node\Param;

use PHPParser\Node\Stmt_Class;

use PHPParser\Builder\Builder_Method;
use PHPParser\Node\Stmt\ClassMethod;

class MethodTest extends \PHPUnit_Framework_TestCase
{
    public function createMethodBuilder($name) {
        return new Builder_Method($name);
    }

    public function testModifiers() {
        $node = $this->createMethodBuilder('test')
            ->makePublic()
            ->makeAbstract()
            ->makeStatic()
            ->getNode()
        ;

        $this->assertEquals(
            new ClassMethod('test', array(
                'type' => Stmt_Class::MODIFIER_PUBLIC
                        | Stmt_Class::MODIFIER_ABSTRACT
                        | Stmt_Class::MODIFIER_STATIC,
                'stmts' => null,
            )),
            $node
        );

        $node = $this->createMethodBuilder('test')
            ->makeProtected()
            ->makeFinal()
            ->getNode()
        ;

        $this->assertEquals(
            new ClassMethod('test', array(
                'type' => Stmt_Class::MODIFIER_PROTECTED
                        | Stmt_Class::MODIFIER_FINAL
            )),
            $node
        );

        $node = $this->createMethodBuilder('test')
            ->makePrivate()
            ->getNode()
        ;

        $this->assertEquals(
            new ClassMethod('test', array(
                'type' => Stmt_Class::MODIFIER_PRIVATE
            )),
            $node
        );
    }

    public function testReturnByRef() {
        $node = $this->createMethodBuilder('test')
            ->makeReturnByRef()
            ->getNode()
        ;

        $this->assertEquals(
            new ClassMethod('test', array(
                'byRef' => true
            )),
            $node
        );
    }

    public function testParams() {
        $param1 = new Param('test1');
        $param2 = new Param('test2');
        $param3 = new Param('test3');

        $node = $this->createMethodBuilder('test')
            ->addParam($param1)
            ->addParams(array($param2, $param3))
            ->getNode()
        ;

        $this->assertEquals(
            new ClassMethod('test', array(
                'params' => array($param1, $param2, $param3)
            )),
            $node
        );
    }

    public function testStmts() {
        $stmt1 = new Expr_Print(new String('test1'));
        $stmt2 = new Expr_Print(new String('test2'));
        $stmt3 = new Expr_Print(new String('test3'));

        $node = $this->createMethodBuilder('test')
            ->addStmt($stmt1)
            ->addStmts(array($stmt2, $stmt3))
            ->getNode()
        ;

        $this->assertEquals(
            new ClassMethod('test', array(
                'stmts' => array($stmt1, $stmt2, $stmt3)
            )),
            $node
        );
    }

    /**
     * @expectedException LogicException
     * @expectedExceptionMessage Cannot add statements to an abstract method
     */
    public function testAddStmtToAbstractMethodError() {
        $this->createMethodBuilder('test')
            ->makeAbstract()
            ->addStmt(new Expr_Print(new String('test')))
        ;
    }

    /**
     * @expectedException LogicException
     * @expectedExceptionMessage Cannot make method with statements abstract
     */
    public function testMakeMethodWithStmtsAbstractError() {
        $this->createMethodBuilder('test')
            ->addStmt(new Expr_Print(new String('test')))
            ->makeAbstract()
        ;
    }

    /**
     * @expectedException LogicException
     * @expectedExceptionMessage Expected parameter node, got "Name"
     */
    public function testInvalidParamError() {
        $this->createMethodBuilder('test')
            ->addParam(new Name('foo'))
        ;
    }
}
