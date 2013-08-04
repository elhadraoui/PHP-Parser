<?php

namespace PHPParser\Node;

/**
 * @property \PHPParser\Node\Expr $expr  Expression
 * @property \PHPParser\Node\Name|\PHPParser\Node\Expr $class Class name
 */
class Expr_Instanceof extends PHPParser\Node\Expr
{
    /**
     * Constructs an instanceof check node.
     *
     * @param \PHPParser\Node\Expr                     $expr       Expression
     * @param \PHPParser\Node\Name|\PHPParser\Node\Expr $class      Class name
     * @param array                                   $attributes Additional attributes
     */
    public function __construct(\PHPParser\Node\Expr $expr, $class, array $attributes = array()) {
        parent::__construct(
            array(
                'expr'  => $expr,
                'class' => $class
            ),
            $attributes
        );
    }
}