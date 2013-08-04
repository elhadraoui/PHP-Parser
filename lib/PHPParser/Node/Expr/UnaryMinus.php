<?php

namespace Expr;

/**
 * @property \PHPParser\Node\Expr $expr Expression
 */
class UnaryMinus extends \PHPParser\Node\Expr
{
    /**
     * Constructs a unary minus node.
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