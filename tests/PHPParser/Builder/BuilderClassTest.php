<?php

namespace PHPParserTest\Builder;

use PHPParser\Node\Scalar\String;

use PHPParser\Node\Stmt_Echo;
use PHPParser\Node\Stmt\TraitUse;
use PHPParser\Node\Node_Const;
use PHPParser\Node\Scalar\ClassConst;
use PHPParser\Node\Stmt\PropertyProperty;
use PHPParser\Node\Stmt\Property;
use PHPParser\Node\Stmt\ClassMethod;
use PHPParser\Node\Stmt_Class;
use PHPParser\Node\Name;
use PHPParser\Builder\BuilderClass;

class BuilderClassTest extends \PHPUnit_Framework_TestCase
{
    protected function createClassBuilder($class) {
        return new BuilderClass($class);
    }

    public function testExtendsImplements() {
        $node = $this->createClassBuilder('SomeLogger')
            ->extend('BaseLogger')
            ->implement('Namespaced\Logger', new Name('SomeInterface'))
            ->getNode()
        ;

        $this->assertEquals(
            new Stmt_Class('SomeLogger', array(
                'extends' => new Name('BaseLogger'),
                'implements' => array(
                    new Name('Namespaced\Logger'),
                    new Name('SomeInterface')
                ),
            )),
            $node
        );
    }

    public function testAbstract() {
        $node = $this->createClassBuilder('Test')
            ->makeAbstract()
            ->getNode()
        ;

        $this->assertEquals(
            new Stmt_Class('Test', array(
                'type' => Stmt_Class::MODIFIER_ABSTRACT
            )),
            $node
        );
    }

    public function testFinal() {
        $node = $this->createClassBuilder('Test')
            ->makeFinal()
            ->getNode()
        ;

        $this->assertEquals(
            new Stmt_Class('Test', array(
                'type' => Stmt_Class::MODIFIER_FINAL
            )),
            $node
        );
    }

    public function testStatementOrder() {
        $method = new ClassMethod('testMethod');
        $property = new Property(
            Stmt_Class::MODIFIER_PUBLIC,
            array(new PropertyProperty('testProperty'))
        );
        $const = new ClassConst(array(
            new Node_Const('TEST_CONST', new String('ABC'))
        ));
        $use = new TraitUse(array(new Name('SomeTrait')));

        $node = $this->createClassBuilder('Test')
            ->addStmt($method)
            ->addStmt($property)
            ->addStmts(array($const, $use))
            ->getNode()
        ;

        $this->assertEquals(
            new Stmt_Class('Test', array(
                'stmts' => array($use, $const, $property, $method)
            )),
            $node
        );
    }

    /**
     * @expectedException LogicException
     * @expectedExceptionMessage Unexpected node of type "Stmt_Echo"
     */
    public function testInvalidStmtError() {
        $this->createClassBuilder('Test')
            ->addStmt(new Stmt_Echo(array()))
        ;
    }
}
