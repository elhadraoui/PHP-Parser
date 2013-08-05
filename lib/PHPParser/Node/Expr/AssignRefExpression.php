<?php

namespace Expression;

/**
 * @property PHPParser\Node\Expr $var  Variable reference is assigned to
 * @property PHPParser\Node\Expr $expr Variable which is referenced
 */
class AssignRefExpression extends Expression
{
    /**
     * Constructs an assignment node.
     *
     * @param PHPParser\Node\Expr $var        Variable
     * @param PHPParser\Node\Expr $expr       Expression
     * @param array               $attributes Additional attributes
     */
    public function __construct(Expression $var, Expression $expr, array $attributes = array()) {
        parent::__construct(
            array(
                'var'  => $var,
                'expr' => $expr
            ),
            $attributes
        );
    }
}
