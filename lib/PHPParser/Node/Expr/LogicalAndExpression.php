<?php

namespace PHPParser\Node\Expression;

/**
 * @property PHPParser\Node\Expr $left  The left hand side expression
 * @property PHPParser\Node\Expr $right The right hand side expression
 */
class LogicalAndExpression extends Expression
{
    /**
     * Constructs a logical and node.
     *
     * @param PHPParser\Node\Expr $left       The left hand side expression
     * @param PHPParser\Node\Expr $right      The right hand side expression
     * @param array               $attributes Additional attributes
     */
    public function __construct(Expression $left, Expression $right, array $attributes = array()) {
        parent::__construct(
            array(
                'left'  => $left,
                'right' => $right
            ),
            $attributes
        );
    }
}
