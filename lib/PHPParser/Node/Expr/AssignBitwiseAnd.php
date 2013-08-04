<?php

namespace Expr;

/**
 * @property PHPParser\Node\Expr $var  Variable
 * @property PHPParser\Node\Expr $expr Expression
 */
class AssignBitwiseAnd extends Expr
{
    /**
     * Constructs an assignment with bitwise and node.
     *
     * @param PHPParser\Node\Expr $var        Variable
     * @param PHPParser\Node\Expr $expr       Expression
     * @param array               $attributes Additional attributes
     */
    public function __construct(Expr $var, Expr $expr, array $attributes = array()) {
        parent::__construct(
            array(
                'var'  => $var,
                'expr' => $expr
            ),
            $attributes
        );
    }
}
