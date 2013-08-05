<?php

namespace PHPParser\Node\Expression;

/**
 * @property PHPParser\Node\Expr $expr Expression
 */
class ErrorSuppressExpression extends Expression
{
    /**
     * Constructs an error suppress node.
     *
     * @param PHPParser\Node\Expr $expr       Expression
     * @param array               $attributes Additional attributes
     */
    public function __construct(Expression $expr, array $attributes = array()) {
        parent::__construct(
            array(
                'expr' => $expr
            ),
            $attributes
        );
    }
}
