<?php

namespace Expr;

/**
 * @property PHPParser\Node\Expr $expr Expression
 */
class BitwiseNot extends PHPParser\Node\Expr
{
    /**
     * Constructs a bitwise not node.
     *
     * @param PHPParser\Node\Expr $expr       Expression
     * @param array               $attributes Additional attributes
     */
    public function __construct(PHPParser\Node\Expr $expr, array $attributes = array()) {
        parent::__construct(
            array(
                'expr' => $expr
            ),
            $attributes
        );
    }
}