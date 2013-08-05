<?php

namespace PHPParser\Node\Expression;

/**
 * @property PHPParser\Node\Expr $var Variable
 */
class PreDecExpression extends Expression
{
    /**
     * Constructs a pre decrement node.
     *
     * @param PHPParser\Node\Expr $var        Variable
     * @param array               $attributes Additional attributes
     */
    public function __construct(Expression $var, array $attributes = array()) {
        parent::__construct(
            array(
                'var' => $var
            ),
            $attributes
        );
    }
}
