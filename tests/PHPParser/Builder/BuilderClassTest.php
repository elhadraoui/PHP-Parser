<?php

namespace PHPParserTest\Builder;

use PHPParser\Node\Scalar\String;
use PHPParser\Node\Statement\EchoStatement;
use PHPParser\Node\Statement\TraitUse;
use PHPParser\Node\Node_Const;
use PHPParser\Node\Scalar\ClassConst;
use PHPParser\Node\Statement\PropertyStatement;
use PHPParser\Node\Statement\ClassMethodStatement;
use PHPParser\Node\Statement\ClassStatement;
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
            new ClassStatement('SomeLogger', array(
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
            new ClassStatement('Test', array(
                'type' => ClassStatement::MODIFIER_ABSTRACT
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
            new ClassStatement('Test', array(
                'type' => ClassStatement::MODIFIER_FINAL
            )),
            $node
        );
    }

    public function testStatementOrder() {
        $method = new ClassMethodStatement('testMethod');
        $property = new PropertyStatement(
            ClassStatement::MODIFIER_PUBLIC,
            array(new PropertyStatement('testPropertyStatement'))
        );
        $const = new ClassConst(array(
            new Node_Const('TEST_CONST', new String('ABC'))
        ));
        $use = new TraitUse(array(new Name('SomeTrait')));

        $node = $this->createClassBuilder('Test')
            ->addStatement($method)
            ->addStatement($property)
            ->addStatements(array($const, $use))
            ->getNode()
        ;

        $this->assertEquals(
            new ClassStatement('Test', array(
                'Statements' => array($use, $const, $property, $method)
            )),
            $node
        );
    }

    /**
     * @expectedException LogicException
     * @expectedExceptionMessage Unexpected node of type "EchoStatement"
     */
    public function testInvalidStatementError() {
        $this->createClassBuilder('Test')
            ->addStatement(new EchoStatement(array()))
        ;
    }
}
