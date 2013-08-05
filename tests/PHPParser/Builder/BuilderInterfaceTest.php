<?php

namespace PHPParserTest\Builder;

/**
 * This class unit-tests the interface builder
 */
use PHPParser\Node\Statement\PropertyStatement;

use PHPParser\Node\Scalar\DNumber;

use PHPParser\Node\Statement\ClassConst;

use PHPParser\Node\Node_Const;

use PHPParser\Node\Statement\ClassMethodStatement;

use PHPParser\Node\Name;

use PHPParser\Node\Statement_Interface;

use PHPParser\PrettyPrinter\PrettyPrinterDefault;

use PHPParser\Builder\Builder_Interface;

class BuilderInterfaceTest extends \PHPUnit_Framework_TestCase
{
    /** @var PHPParser\Builder_Interface */
    protected $builder;

    protected function setUp() {
        $this->builder = new Builder_Interface('Contract');
    }

    private function dump($node) {
        $pp = new PrettyPrinterDefault();
        return $pp->prettyPrint(array($node));
    }

    public function testEmpty() {
        $contract = $this->builder->getNode();
        $this->assertInstanceOf('PHPParser\Node\Statement_Interface', $contract);
        $this->assertEquals('Contract', $contract->name);
    }

    public function testExtending() {
        $contract = $this->builder->extend('Space\Root1', 'Root2')->getNode();
        $this->assertEquals(
            new Statement_Interface('Contract', array(
                'extends' => array(
                    new Name('Space\Root1'),
                    new Name('Root2')
                ),
            )), $contract
        );
    }

    public function testAddMethod() {
        $method = new ClassMethodStatement('doSomething');
        $contract = $this->builder->addStatement($method)->getNode();
        $this->assertEquals(array($method), $contract->Statements);
    }

    public function testAddConst() {
        $const = new ClassConst(array(
            new Node_Const('SPEED_OF_LIGHT', new DNumber(299792458))
        ));
        $contract = $this->builder->addStatement($const)->getNode();
        $this->assertEquals(299792458, $contract->Statements[0]->consts[0]->value->value);
    }

    public function testOrder() {
        $const = new ClassConst(array(
            new Node_Const('SPEED_OF_LIGHT', new DNumber(299792458))
        ));
        $method = new ClassMethodStatement('doSomething');
        $contract = $this->builder
            ->addStatement($method)
            ->addStatement($const)
            ->getNode()
        ;

        $this->assertInstanceOf('PHPParser\Node\Statement\ClassStatementConst', $contract->Statements[0]);
        $this->assertInstanceOf('PHPParser\Node\Statement\ClassStatementMethod', $contract->Statements[1]);
    }

    /**
     * @expectedException LogicException
     * @expectedExceptionMessage Unexpected node of type "Statement_PropertyStatement"
     */
    public function testInvalidStatementError() {
        $this->builder->addStatement(new PropertyStatement('invalid'));
    }

    public function testFullFunctional() {
        $const = new ClassConst(array(
            new Node_Const('SPEED_OF_LIGHT', new DNumber(299792458))
        ));
        $method = new ClassMethodStatement('doSomething');
        $contract = $this->builder
            ->addStatement($method)
            ->addStatement($const)
            ->getNode()
        ;

        eval($this->dump($contract));

        $this->assertTrue(interface_exists('Contract', false));
    }
}

