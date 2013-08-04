<?php

namespace PHPParserTest\Builder;

use PHPParser\Node\Expr\ArrayItem;

use PHPParser\Node\Expr_Array;

use PHPParser\Node\Expr\ConstFetch;

use PHPParser\Node\Scalar\DirConst;

use PHPParser\Node\Scalar\String;

use PHPParser\Node\Scalar\DNumber;

use PHPParser\Node\Scalar\LNumber;

use PHPParser\Node\Name;

class PropertyTest extends \PHPUnit_Framework_TestCase
{
    public function createPropertyBuilder($name) {
        return new PHPParser\Builder_Property($name);
    }

    public function testModifiers() {
        $node = $this->createPropertyBuilder('test')
            ->makePrivate()
            ->makeStatic()
            ->getNode()
        ;

        $this->assertEquals(
            new PHPParser\Node\Stmt_Property(
                PHPParser\Node\Stmt_Class::MODIFIER_PRIVATE
              | PHPParser\Node\Stmt_Class::MODIFIER_STATIC,
                array(
                    new PHPParser\Node\Stmt_PropertyProperty('test')
                )
            ),
            $node
        );

        $node = $this->createPropertyBuilder('test')
            ->makeProtected()
            ->getNode()
        ;

        $this->assertEquals(
            new PHPParser\Node\Stmt_Property(
                PHPParser\Node\Stmt_Class::MODIFIER_PROTECTED,
                array(
                    new PHPParser\Node\Stmt_PropertyProperty('test')
                )
            ),
            $node
        );

        $node = $this->createPropertyBuilder('test')
            ->makePublic()
            ->getNode()
        ;

        $this->assertEquals(
            new PHPParser\Node\Stmt_Property(
                PHPParser\Node\Stmt_Class::MODIFIER_PUBLIC,
                array(
                    new PHPParser\Node\Stmt_PropertyProperty('test')
                )
            ),
            $node
        );
    }

    /**
     * @dataProvider provideTestDefaultValues
     */
    public function testDefaultValues($value, $expectedValueNode) {
        $node = $this->createPropertyBuilder('test')
            ->setDefault($value)
            ->getNode()
        ;

        $this->assertEquals($expectedValueNode, $node->props[0]->default);
    }

    public function provideTestDefaultValues() {
        return array(
            array(
                null,
                new ConstFetch(new Name('null'))
            ),
            array(
                true,
                new ConstFetch(new Name('true'))
            ),
            array(
                false,
                new ConstFetch(new Name('false'))
            ),
            array(
                31415,
                new LNumber(31415)
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
                    new ArrayItem(new LNumber(1)),
                    new ArrayItem(new LNumber(2)),
                    new ArrayItem(new LNumber(3)),
                ))
            ),
            array(
                array('foo' => 'bar', 'bar' => 'foo'),
                new Expr_Array(array(
                    new ArrayItem(
                        new String('bar'),
                        new String('foo')
                    ),
                    new ArrayItem(
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
}
