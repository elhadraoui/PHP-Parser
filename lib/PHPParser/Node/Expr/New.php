<?php

namespace PHPParser\Node;

/**
 * @property \PHPParser\Node\Name|\PHPParser\Node\Expr $class Class name
 * @property \PHPParser\Node\Arg[]                    $args  Arguments
 */
class Expr_New extends \PHPParser\Node\Expr
{
    /**
     * Constructs a function call node.
     *
     * @param \PHPParser\Node\Name|\PHPParser\Node\Expr $class      Class name
     * @param \PHPParser\Node\Arg[]                    $args       Arguments
     * @param array                                   $attributes Additional attributes
     */
    public function __construct($class, array $args = array(), array $attributes = array()) {
        parent::__construct(
            array(
                'class' => $class,
                'args'  => $args
            ),
            $attributes
        );
    }
}