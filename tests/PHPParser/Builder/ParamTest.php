<?php

namespace PHPParserTest\Builder;

use Expr\ConstFetch;

class ParamTest extends \PHPUnit_Framework_TestCase
{
    public function createParamBuilder($name) {
        return new \PHPParser\Builder_Param($name);
    }

    /**
     * @dataProvider provideTestDefaultValues
     */
    public function testDefaultValues($value, $expectedValueNode) {
        $node = $this->createParamBuilder('test')
            ->setDefault($value)
            ->getNode()
        ;

        $this->assertEquals($expectedValueNode, $node->default);
    }

    public function provideTestDefaultValues() {
        return array(
            array(
                null,
                new ConstFetch(new \PHPParser\Node\Name('null'))
            ),
            array(
                true,
                new ConstFetch(new \PHPParser\Node\Name('true'))
            ),
            array(
                false,
                new ConstFetch(new \PHPParser\Node\Name('false'))
            ),
            array(
                31415,
                new \LNumber(31415)
            ),
            array(
                3.1415,
                new DNumber(3.1415)
            ),
            array(
                'Hallo World',
                new String('Hallo World')
            ),
            array(
                array(1, 2, 3),
                new Expr_Array(array(
                    new Expr_ArrayItem(new LNumber(1)),
                    new Expr_ArrayItem(new LNumber(2)),
                    new Expr_ArrayItem(new LNumber(3)),
                ))
            ),
            array(
                array('foo' => 'bar', 'bar' => 'foo'),
                new Expr_Array(array(
                    new Expr_ArrayItem(
                        new String('bar'),
                        new String('foo')
                    ),
                    new Expr_ArrayItem(
                        new String('foo'),
                        new String('bar')
                    ),
                ))
            ),
            array(
                new DirConst,
                new DirConst
            )
        );
    }

    public function testTypeHints() {
        $node = $this->createParamBuilder('test')
            ->setTypeHint('array')
            ->getNode()
        ;

        $this->assertEquals(
            new \PHPParser\Node\Param('test', null, 'array'),
            $node
        );

        $node = $this->createParamBuilder('test')
            ->setTypeHint('callable')
            ->getNode()
        ;

        $this->assertEquals(
            new \PHPParser\Node\Param('test', null, 'callable'),
            $node
        );

        $node = $this->createParamBuilder('test')
            ->setTypeHint('Some\Class')
            ->getNode()
        ;

        $this->assertEquals(
            new \PHPParser\Node\Param('test', null, new \PHPParser\Node\Name('Some\Class')),
            $node
        );
    }

    public function testByRef() {
        $node = $this->createParamBuilder('test')
            ->makeByRef()
            ->getNode()
        ;

        $this->assertEquals(
            new \PHPParser\Node\Param('test', null, null, true),
            $node
        );
    }
}
