<?php

namespace PHPParserTest\Node\Stmt;

class ClassMethodTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provideModifiers
     */
    public function testModifiers($modifier) {
        $node = new PHPParser\Node\Stmt_ClassMethod('foo', array(
            'type' => constant('PHPParser\Node\Stmt_Class::MODIFIER_' . strtoupper($modifier))
        ));

        $this->assertTrue($node->{'is' . $modifier}());
    }

    /**
     * @dataProvider provideModifiers
     */
    public function testNoModifiers($modifier) {
        $node = new PHPParser\Node\Stmt_ClassMethod('foo', array('type' => 0));

        $this->assertFalse($node->{'is' . $modifier}());
    }

    public function provideModifiers() {
        return array(
            array('public'),
            array('protected'),
            array('private'),
            array('abstract'),
            array('final'),
            array('static'),
        );
    }
}
