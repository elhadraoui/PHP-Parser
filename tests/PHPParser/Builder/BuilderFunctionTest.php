<?php

namespace PHPParserTest\Builder;

class BuilderFunctionTest extends \PHPUnit_Framework_TestCase
{
    public function createFunctionBuilder($name) {
        return new PHPParser\Builder_Function($name);
    }

    public function testReturnByRef() {
        $node = $this->createFunctionBuilder('test')
            ->makeReturnByRef()
            ->getNode()
        ;

        $this->assertEquals(
            new PHPParser\Node\Stmt_Function('test', array(
                'byRef' => true
            )),
            $node
        );
    }

    public function testParams() {
        $param1 = new PHPParser\Node\Param('test1');
        $param2 = new PHPParser\Node\Param('test2');
        $param3 = new PHPParser\Node\Param('test3');

        $node = $this->createFunctionBuilder('test')
            ->addParam($param1)
            ->addParams(array($param2, $param3))
            ->getNode()
        ;

        $this->assertEquals(
            new PHPParser\Node\Stmt_Function('test', array(
                'params' => array($param1, $param2, $param3)
            )),
            $node
        );
    }

    public function testStmts() {
        $stmt1 = new Expr_Print(new String('test1'));
        $stmt2 = new Expr_Print(new String('test2'));
        $stmt3 = new Expr_Print(new String('test3'));

        $node = $this->createFunctionBuilder('test')
            ->addStmt($stmt1)
            ->addStmts(array($stmt2, $stmt3))
            ->getNode()
        ;

        $this->assertEquals(
            new PHPParser\Node\Stmt_Function('test', array(
                'stmts' => array($stmt1, $stmt2, $stmt3)
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
            ->addParam(new PHPParser\Node\Name('foo'))
        ;
    }
}
