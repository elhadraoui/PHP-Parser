<?php

namespace PHPParserTest\Builder;

class PropertyTest extends \PHPUnit_Framework_TestCase
{
    public function createPropertyBuilder($name) {
        return new PHPParser_Builder_Property($name);
    }

    public function testModifiers() {
        $node = $this->createPropertyBuilder('test')
            ->makePrivate()
            ->makeStatic()
            ->getNode()
        ;

        $this->assertEquals(
            new PHPParser_Node_Stmt_Property(
                PHPParser_Node_Stmt_Class::MODIFIER_PRIVATE
              | PHPParser_Node_Stmt_Class::MODIFIER_STATIC,
                array(
                    new PHPParser_Node_Stmt_PropertyProperty('test')
                )
            ),
            $node
        );

        $node = $this->createPropertyBuilder('test')
            ->makeProtected()
            ->getNode()
        ;

        $this->assertEquals(
            new PHPParser_Node_Stmt_Property(
                PHPParser_Node_Stmt_Class::MODIFIER_PROTECTED,
                array(
                    new PHPParser_Node_Stmt_PropertyProperty('test')
                )
            ),
            $node
        );

        $node = $this->createPropertyBuilder('test')
            ->makePublic()
            ->getNode()
        ;

        $this->assertEquals(
            new PHPParser_Node_Stmt_Property(
                PHPParser_Node_Stmt_Class::MODIFIER_PUBLIC,
                array(
                    new PHPParser_Node_Stmt_PropertyProperty('test')
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
                new ConstFetch(new PHPParser_Node_Name('null'))
            ),
            array(
                true,
                new ConstFetch(new PHPParser_Node_Name('true'))
            ),
            array(
                false,
                new ConstFetch(new PHPParser_Node_Name('false'))
            ),
            array(
                31415,
                new PHPParser_Node_Scalar_LNumber(31415)
            ),
            array(
                3.1415,
                new PHPParser_Node_Scalar_DNumber(3.1415)
            ),
            array(
                'Hallo World',
                new PHPParser_Node_Scalar_String('Hallo World')
            ),
            array(
                array(1, 2, 3),
                new Expr_Array(array(
                    new Expr_ArrayItem(new PHPParser_Node_Scalar_LNumber(1)),
                    new Expr_ArrayItem(new PHPParser_Node_Scalar_LNumber(2)),
                    new Expr_ArrayItem(new PHPParser_Node_Scalar_LNumber(3)),
                ))
            ),
            array(
                array('foo' => 'bar', 'bar' => 'foo'),
                new Expr_Array(array(
                    new Expr_ArrayItem(
                        new PHPParser_Node_Scalar_String('bar'),
                        new PHPParser_Node_Scalar_String('foo')
                    ),
                    new Expr_ArrayItem(
                        new PHPParser_Node_Scalar_String('foo'),
                        new PHPParser_Node_Scalar_String('bar')
                    ),
                ))
            ),
            array(
                new PHPParser_Node_Scalar_DirConst,
                new PHPParser_Node_Scalar_DirConst
            )
        );
    }
}
