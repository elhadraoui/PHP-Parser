<?php

namespace PHPParser\Node\Expression;

/**
 * @property PHPParser\Node\Expr $expr Expression
 */
class EvalExpression extends Expression
{
    /**
     * Constructs an eval() node.
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
