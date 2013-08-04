<?php

namespace Expr;

/**
 * @property \PHPParser\Node\Expr        $var  Variable holding object
 * @property string|\PHPParser\Node\Expr $name Method name
 * @property \PHPParser\Node\Arg[]       $args Arguments
 */
class MethodCall extends \PHPParser\Node\Expr
{
    /**
     * Constructs a function call node.
     *
     * @param \PHPParser\Node\Expr        $var        Variable holding object
     * @param string|\PHPParser\Node\Expr $name       Method name
     * @param \PHPParser\Node\Arg[]       $args       Arguments
     * @param array                      $attributes Additional attributes
     */
    public function __construct(\PHPParser\Node\Expr $var, $name, array $args = array(), array $attributes = array()) {
        parent::__construct(
            array(
                'var'  => $var,
                'name' => $name,
                'args' => $args
            ),
            $attributes
        );
    }
}