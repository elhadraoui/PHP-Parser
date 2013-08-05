<?php

namespace PHPParserTest\Builder;

use PHPParser\Node\Name;

use PHPParser\Node\Scalar\String;

use PHPParser\Node\Expr_Print;
use PHPParser\Node\Statement\FunctionStatement;
use PHPParser\Node\Param;
use PHPParser\Builder\BuilderFunction;

class BuilderFunctionTest extends \PHPUnit_Framework_TestCase
{
    public function createFunctionBuilder($name) {
        return new BuilderFunction($name);
    }

    public function testReturnByRef() {
        $node = $this->createFunctionBuilder('test')
            ->makeReturnByRef()
            ->getNode()
        ;

        $this->assertEquals(
            new FunctionStatement('test', array(
                'byRef' => true
            )),
            $node
        );
    }

    public function testParams() {
        $param1 = new Param('test1');
        $param2 = new Param('test2');
        $param3 = new Param('test3');

        $node = $this->createFunctionBuilder('test')
            ->addParam($param1)
            ->addParams(array($param2, $param3))
            ->getNode()
        ;

        $this->assertEquals(
            new FunctionStatement('test', array(
                'params' => array($param1, $param2, $param3)
            )),
            $node
        );
    }

    public function testStatements() {
        $Statement1 = new Expr_Print(new String('test1'));
        $Statement2 = new Expr_Print(new String('test2'));
        $Statement3 = new Expr_Print(new String('test3'));

        $node = $this->createFunctionBuilder('test')
            ->addStatement($Statement1)
            ->addStatements(array($Statement2, $Statement3))
            ->getNode()
        ;

        $this->assertEquals(
            new FunctionStatement('test', array(
                'Statements' => array($Statement1, $Statement2, $Statement3)
            )),
            $node
        );
    }

    /**
     * @expectedException LogicException
     * @expectedExceptionMessage Expected parameter node, got "Name"
     */
    public function testInvalidParamError() {
        $this->createFunctionBuilder('test')
            ->addParam(new Name('foo'))
        ;
    }
}
