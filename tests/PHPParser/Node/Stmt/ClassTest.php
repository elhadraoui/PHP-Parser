<?php

namespace PHPParserTest\Node\Stmt;

use PHPParser\Node\Stmt\Property;

use PHPParser\Node\Stmt_Const;

use PHPParser\Node\Stmt\TraitUse;

use PHPParser\Node\Stmt\ClassMethod;

use PHPParser\Node\Stmt_Class;

class ClassTest extends \PHPUnit_Framework_TestCase
{
    public function testIsAbstract() {
        $class = new Stmt_Class('Foo', array('type' => Stmt_Class::MODIFIER_ABSTRACT));
        $this->assertTrue($class->isAbstract());

        $class = new Stmt_Class('Foo');
        $this->assertFalse($class->isAbstract());
    }

    public function testIsFinal() {
        $class = new Stmt_Class('Foo', array('type' => Stmt_Class::MODIFIER_FINAL));
        $this->assertTrue($class->isFinal());

        $class = new Stmt_Class('Foo');
        $this->assertFalse($class->isFinal());
    }

    public function testGetMethods() {
        $methods = array(
            new ClassMethod('foo'),
            new ClassMethod('bar'),
            new ClassMethod('fooBar'),
        );
        $class = new Stmt_Class('Foo', array(
            'stmts' => array(
                new TraitUse(array()),
                $methods[0],
                new Stmt_Const(array()),
                $methods[1],
                new Property(0, array()),
                $methods[2],
            )
        ));

        $this->assertEquals($methods, $class->getMethods());
    }
}
