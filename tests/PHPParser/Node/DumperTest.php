<?php

namespace PHPParserTest\Node;

use PHPParser\Node\Scalar\String;
use PHPParser\Node\Dumper;
use PHPParser\Node\Expr\ArrayItem;
use PHPParser\Node\Expr_Array;
use PHPParser\Node\Name;

class DumperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provideTestDump
     * @covers PHPParser\NodeDumper::dump
     */
    public function testDump($node, $dump) {
        $dumper = new Dumper;

        $this->assertEquals($dump, $dumper->dump($node));
    }

    public function provideTestDump() {
        return array(
            array(
                array(),
'array(
)'
            ),
            array(
                array('Foo', 'Bar', 'Key' => 'FooBar'),
'array(
    0: Foo
    1: Bar
    Key: FooBar
)'
            ),
            array(
                new Name(array('Hallo', 'World')),
'Name(
    parts: array(
        0: Hallo
        1: World
    )
)'
            ),
            array(
                new Expr_Array(array(
                    new ArrayItem(new String('Foo'))
                )),
'Expr_Array(
    items: array(
        0: Expr_ArrayItem(
            key: null
            value: Scalar_String(
                value: Foo
            )
            byRef: false
        )
    )
)'
            ),
        );
    }

    /**
     * @expectedException        InvalidArgumentException
     * @expectedExceptionMessage Can only dump nodes and arrays.
     */
    public function testError() {
        $dumper = new Dumper;
        $dumper->dump(new \stdClass);
    }
}
