<?php

namespace PHPParserTest\Builder;

use PHPParser\Node\Name;

use PHPParser\Node\Scalar\String;

use PHPParser\Node\Expr_Print;

use PHPParser\Node\Param;

use PHPParser\Node\Statement\ClassStatement;

use PHPParser\Builder\Builder_Method;
use PHPParser\Node\Statement\ClassMethodStatement;

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
            new ClassMethodStatement('test', array(
                'type' => ClassStatement::MODIFIER_PUBLIC
                        | ClassStatement::MODIFIER_ABSTRACT
                        | ClassStatement::MODIFIER_STATIC,
                'Statements' => null,
            )),
            $node
        );

        $node = $this->createMethodBuilder('test')
            ->makeProtected()
            ->makeFinal()
            ->getNode()
        ;

        $this->assertEquals(
            new ClassMethodStatement('test', array(
                'type' => ClassStatement::MODIFIER_PROTECTED
                        | ClassStatement::MODIFIER_FINAL
            )),
            $node
        );

        $node = $this->createMethodBuilder('test')
            ->makePrivate()
            ->getNode()
        ;

        $this->assertEquals(
            new ClassMethodStatement('test', array(
                'type' => ClassStatement::MODIFIER_PRIVATE
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
            new ClassMethodStatement('test', array(
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
            new ClassMethodStatement('test', array(
                'params' => array($param1, $param2, $param3)
            )),
            $node
        );
    }

    public function testStatements() {
        $Statement1 = new Expr_Print(new String('test1'));
        $Statement2 = new Expr_Print(new String('test2'));
        $Statement3 = new Expr_Print(new String('test3'));

        $node = $this->createMethodBuilder('test')
            ->addStatement($Statement1)
            ->addStatements(array($Statement2, $Statement3))
            ->getNode()
        ;

        $this->assertEquals(
            new ClassMethodStatement('test', array(
                'Statements' => array($Statement1, $Statement2, $Statement3)
            )),
            $node
        );
    }

    /**
     * @expectedException LogicException
     * @expectedExceptionMessage Cannot add statements to an abstract method
     */
    public function testAddStatementToAbstractMethodError() {
        $this->createMethodBuilder('test')
            ->makeAbstract()
            ->addStatement(new Expr_Print(new String('test')))
        ;
    }

    /**
     * @expectedException LogicException
     * @expectedExceptionMessage Cannot make method with statements abstract
     */
    public function testMakeMethodWithStatementsAbstractError() {
        $this->createMethodBuilder('test')
            ->addStatement(new Expr_Print(new String('test')))
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
