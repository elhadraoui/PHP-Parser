<?php

namespace Expr;

/**
 * @property \PHPParser\Node\Name|\PHPParser\Node\Expr $name Function name
 * @property \PHPParser\Node\Arg[]                    $args Arguments
 */
class FuncCall extends \PHPParser\Node\Expr
{
    /**
     * Constructs a function call node.
     *
     * @param \PHPParser\Node\Name|\PHPParser\Node\Expr $name       Function name
     * @param \PHPParser\Node\Arg[]                    $args       Arguments
     * @param array                                   $attributes Additional attributes
     */
    public function __construct($name, array $args = array(), array $attributes = array()) {
        parent::__construct(
            array(
                'name' => $name,
                'args' => $args
            ),
            $attributes
        );
    }
}