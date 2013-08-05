<?php

namespace PHPParser\Node\Expression;

/**
 * @property PHPParser\Node\Expr $expr  Expression
 * @property PHPParser\Node\Name|PHPParser\Node\Expr $class Class name
 */
class InstanceofExpression extends Expression
{
    /**
     * Constructs an instanceof check node.
     *
     * @param PHPParser\Node\Expr                     $expr       Expression
     * @param PHPParser\Node\Name|PHPParser\Node\Expr $class      Class name
     * @param array                                   $attributes Additional attributes
     */
    public function __construct(Expression $expr, $class, array $attributes = array()) {
        parent::__construct(
            array(
                'expr'  => $expr,
                'class' => $class
            ),
            $attributes
        );
    }
}
