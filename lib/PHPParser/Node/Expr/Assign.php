<?php

namespace Expr;

/**
 * @property PHPParser\Node\Expr $var  Variable
 * @property PHPParser\Node\Expr $expr Expression
 */
class Assign extends Expr
{
    /**
     * Constructs an assignment node.
     *
     * @param PHPParser\Node\Expr $var        Variable
     * @param PHPParser\Node\Expr $expr       Expression
     * @param array               $attributes Additional attributes
     */
    public function __construct(PHPParser\Node\Expr $var, PHPParser\Node\Expr $expr, array $attributes = array()) {
        parent::__construct(
            array(
                'var'  => $var,
                'expr' => $expr
            ),
            $attributes
        );
    }
}
