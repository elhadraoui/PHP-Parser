<?php

namespace PHPParserTest\Node\Stmt;

class ClassTest extends \PHPUnit_Framework_TestCase
{
    public function testIsAbstract() {
        $class = new \PHPParser\Node\Stmt_Class('Foo', array('type' => \PHPParser\Node\Stmt_Class::MODIFIER_ABSTRACT));
        $this->assertTrue($class->isAbstract());

        $class = new \PHPParser\Node\Stmt_Class('Foo');
        $this->assertFalse($class->isAbstract());
    }

    public function testIsFinal() {
        $class = new \PHPParser\Node\Stmt_Class('Foo', array('type' => \PHPParser\Node\Stmt_Class::MODIFIER_FINAL));
        $this->assertTrue($class->isFinal());

        $class = new \PHPParser\Node\Stmt_Class('Foo');
        $this->assertFalse($class->isFinal());
    }

    public function testGetMethods() {
        $methods = array(
            new \PHPParser\Node\Stmt_ClassMethod('foo'),
            new \PHPParser\Node\Stmt_ClassMethod('bar'),
            new \PHPParser\Node\Stmt_ClassMethod('fooBar'),
        );
        $class = new \PHPParser\Node\Stmt_Class('Foo', array(
            'stmts' => array(
                new \PHPParser\Node\Stmt_TraitUse(array()),
                $methods[0],
                new \PHPParser\Node\Stmt_Const(array()),
                $methods[1],
                new \PHPParser\Node\Stmt_Property(0, array()),
                $methods[2],
            )
        ));

        $this->assertEquals($methods, $class->getMethods());
    }
}
