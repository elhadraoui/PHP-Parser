<?php

namespace PHPParser\Node;

/**
 * @property PHPParser\Node\Expr $expr Expression
 */
class Expr_Print extends Expr
{
    /**
     * Constructs an print() node.
     *
     * @param PHPParser\Node\Expr $expr       Expression
     * @param array               $attributes Additional attributes
     */
    public function __construct(Expr $expr, array $attributes = array()) {
        parent::__construct(
            array(
                'expr' => $expr
            ),
            $attributes
        );
    }
}