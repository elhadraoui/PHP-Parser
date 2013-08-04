<?php

namespace PHPParserTest\Builder;

/**
 * This class unit-tests the interface builder
 */
class BuilderInterfaceTest extends \PHPUnit_Framework_TestCase
{
    /** @var \PHPParser\Builder_Interface */
    protected $builder;

    protected function setUp() {
        $this->builder = new \PHPParser\Builder_Interface('Contract');
    }

    private function dump($node) {
        $pp = new \PHPParser\PrettyPrinter_Default();
        return $pp->prettyPrint(array($node));
    }

    public function testEmpty() {
        $contract = $this->builder->getNode();
        $this->assertInstanceOf('\PHPParser\Node\Stmt_Interface', $contract);
        $this->assertEquals('Contract', $contract->name);
    }

    public function testExtending() {
        $contract = $this->builder->extend('Space\Root1', 'Root2')->getNode();
        $this->assertEquals(
            new \PHPParser\Node\Stmt_Interface('Contract', array(
                'extends' => array(
                    new \PHPParser\Node\Name('Space\Root1'),
                    new \PHPParser\Node\Name('Root2')
                ),
            )), $contract
        );
    }

    public function testAddMethod() {
        $method = new \PHPParser\Node\Stmt_ClassMethod('doSomething');
        $contract = $this->builder->addStmt($method)->getNode();
        $this->assertEquals(array($method), $contract->stmts);
    }

    public function testAddConst() {
        $const = new \PHPParser\Node\Stmt_ClassConst(array(
            new \PHPParser\Node_Const('SPEED_OF_LIGHT', new DNumber(299792458))
        ));
        $contract = $this->builder->addStmt($const)->getNode();
        $this->assertEquals(299792458, $contract->stmts[0]->consts[0]->value->value);
    }

    public function testOrder() {
        $const = new \PHPParser\Node\Stmt_ClassConst(array(
            new \PHPParser\Node_Const('SPEED_OF_LIGHT', new DNumber(299792458))
        ));
        $method = new \PHPParser\Node\Stmt_ClassMethod('doSomething');
        $contract = $this->builder
            ->addStmt($method)
            ->addStmt($const)
            ->getNode()
        ;

        $this->assertInstanceOf('\PHPParser\Node\Stmt_ClassConst', $contract->stmts[0]);
        $this->assertInstanceOf('\PHPParser\Node\Stmt_ClassMethod', $contract->stmts[1]);
    }

    /**
     * @expectedException LogicException
     * @expectedExceptionMessage Unexpected node of type "Stmt_PropertyProperty"
     */
    public function testInvalidStmtError() {
        $this->builder->addStmt(new \PHPParser\Node\Stmt_PropertyProperty('invalid'));
    }

    public function testFullFunctional() {
        $const = new \PHPParser\Node\Stmt_ClassConst(array(
            new \PHPParser\Node_Const('SPEED_OF_LIGHT', new DNumber(299792458))
        ));
        $method = new \PHPParser\Node\Stmt_ClassMethod('doSomething');
        $contract = $this->builder
            ->addStmt($method)
            ->addStmt($const)
            ->getNode()
        ;

        eval($this->dump($contract));

        $this->assertTrue(interface_exists('Contract', false));
    }
}

