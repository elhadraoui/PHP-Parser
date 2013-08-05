<?php

namespace PHPParser\Node\Expression;

/**
 * @property PHPParser\Node\Expr $expr Expression
 */
abstract class CastExpression extends Expression
{
    /**
     * Constructs a cast node.
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
