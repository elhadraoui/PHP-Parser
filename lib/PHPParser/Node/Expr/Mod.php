<?php

namespace Expr;

/**
 * @property \PHPParser\Node\Expr $left  The left hand side expression
 * @property \PHPParser\Node\Expr $right The right hand side expression
 */
class Mod extends \PHPParser\Node\Expr
{
    /**
     * Constructs a modulo node.
     *
     * @param \PHPParser\Node\Expr $left       The left hand side expression
     * @param \PHPParser\Node\Expr $right      The right hand side expression
     * @param array               $attributes Additional attributes
     */
    public function __construct(\PHPParser\Node\Expr $left, \PHPParser\Node\Expr $right, array $attributes = array()) {
        parent::__construct(
            array(
                'left'  => $left,
                'right' => $right
            ),
            $attributes
        );
    }
}