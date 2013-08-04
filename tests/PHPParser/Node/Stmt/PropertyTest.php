<?php

namespace PHPParserTest\Node\Stmt;

use PHPParser\Node\Stmt\Property;

class PropertyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provideModifiers
     */
    public function testModifiers($modifier) {
        $node = new Property(
            constant('PHPParser\Node\Stmt_Class::MODIFIER_' . strtoupper($modifier)),
            array() // invalid
        );

        $this->assertTrue($node->{'is' . $modifier}());
    }

    /**
     * @dataProvider provideModifiers
     */
    public function testNoModifiers($modifier) {
        $node = new Property(0, array());

        $this->assertFalse($node->{'is' . $modifier}());
    }

    public function provideModifiers() {
        return array(
            array('public'),
            array('protected'),
            array('private'),
            array('static'),
        );
    }
}
