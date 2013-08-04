<?php

namespace PHPParserTest\Builder;

class BuilderClassTest extends \PHPUnit_Framework_TestCase
{
    protected function createClassBuilder($class) {
        return new \PHPParser\Builder_Class($class);
    }

    public function testExtendsImplements() {
        $node = $this->createClassBuilder('SomeLogger')
            ->extend('BaseLogger')
            ->implement('Namespaced\Logger', new \PHPParser\Node\Name('SomeInterface'))
            ->getNode()
        ;

        $this->assertEquals(
            new \PHPParser\Node\Stmt_Class('SomeLogger', array(
                'extends' => new \PHPParser\Node\Name('BaseLogger'),
                'implements' => array(
                    new \PHPParser\Node\Name('Namespaced\Logger'),
                    new \PHPParser\Node\Name('SomeInterface')
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
            new \PHPParser\Node\Stmt_Class('Test', array(
                'type' => \PHPParser\Node\Stmt_Class::MODIFIER_ABSTRACT
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
            new \PHPParser\Node\Stmt_Class('Test', array(
                'type' => \PHPParser\Node\Stmt_Class::MODIFIER_FINAL
            )),
            $node
        );
    }

    public function testStatementOrder() {
        $method = new \PHPParser\Node\Stmt_ClassMethod('testMethod');
        $property = new \PHPParser\Node\Stmt_Property(
            \PHPParser\Node\Stmt_Class::MODIFIER_PUBLIC,
            array(new \PHPParser\Node\Stmt_PropertyProperty('testProperty'))
        );
        $const = new \PHPParser\Node\Stmt_ClassConst(array(
            new \PHPParser\Node\Const('TEST_CONST', new String('ABC'))
        ));
        $use = new \PHPParser\Node\Stmt_TraitUse(array(new \PHPParser\Node\Name('SomeTrait')));

        $node = $this->createClassBuilder('Test')
            ->addStmt($method)
            ->addStmt($property)
            ->addStmts(array($const, $use))
            ->getNode()
        ;

        $this->assertEquals(
            new \PHPParser\Node\Stmt_Class('Test', array(
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
            ->addStmt(new \PHPParser\Node\Stmt_Echo(array()))
        ;
    }
}
