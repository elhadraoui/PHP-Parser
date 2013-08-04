<?php

namespace Expr;

/**
 * @property PHPParser\Node\Expr      $cond Condition
 * @property null|PHPParser\Node\Expr $if   Expression for true
 * @property PHPParser\Node\Expr      $else Expression for false
 */
class Ternary extends PHPParser\Node\Expr
{
    /**
     * Constructs a ternary operator node.
     *
     * @param PHPParser\Node\Expr      $cond       Condition
     * @param null|PHPParser\Node\Expr $if         Expression for true
     * @param PHPParser\Node\Expr      $else       Expression for false
     * @param array                    $attributes Additional attributes
     */
    public function __construct(PHPParser\Node\Expr $cond, $if, PHPParser\Node\Expr $else, array $attributes = array()) {
        parent::__construct(
            array(
                'cond' => $cond,
                'if'   => $if,
                'else' => $else
            ),
            $attributes
        );
    }
}