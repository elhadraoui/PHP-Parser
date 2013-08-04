<?php

namespace Expr;

/**
 * @property \PHPParser\Node\Expr        $var  Variable holding object
 * @property string|\PHPParser\Node\Expr $name Property Name
 */
class PropertyFetch extends \PHPParser\Node\Expr
{
    /**
     * Constructs a function call node.
     *
     * @param \PHPParser\Node\Expr        $var        Variable holding object
     * @param string|\PHPParser\Node\Expr $name       Property name
     * @param array                      $attributes Additional attributes
     */
    public function __construct(\PHPParser\Node\Expr $var, $name, array $attributes = array()) {
        parent::__construct(
            array(
                'var'  => $var,
                'name' => $name
            ),
            $attributes
        );
    }
}