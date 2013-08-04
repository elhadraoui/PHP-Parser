<?php

namespace Expr;

/**
 * @property \PHPParser\Node\Expr $expr Expression
 */
class UnaryPlus extends PHPParser\Node\Expr
{
    /**
     * Constructs a unary plus node.
     *
     * @param \PHPParser\Node\Expr $expr       Expression
     * @param array               $attributes Additional attributes
     */
    public function __construct(\PHPParser\Node\Expr $expr, array $attributes = array()) {
        parent::__construct(
            array(
                'expr' => $expr
            ),
            $attributes
        );
    }
}