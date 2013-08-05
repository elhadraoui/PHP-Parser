<?php

namespace PHPParser\Node\Expression;

/**
 * @property PHPParser\Node\Expr $var  Variable
 * @property PHPParser\Node\Expr $expr Expression
 */
class AssignBitwiseOrExpression extends Expression
{
    /**
     * Constructs an assignment with bitwise or node.
     *
     * @param PHPParser\Node\Expr $var        Variable
     * @param PHPParser\Node\Expr $expr       Expression
     * @param array               $attributes Additional attributes
     */
    public function __construct(Expression $var, Expression $expr, array $attributes = array()) {
        parent::__construct(
            array(
                'var'  => $var,
                'expr' => $expr
            ),
            $attributes
        );
    }
}