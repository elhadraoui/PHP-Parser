<?php

namespace Expr;

/**
 * @property string|\PHPParser\Node\Expr $name Name
 */
class Variable extends \PHPParser\Node\Expr
{
    /**
     * Constructs a variable node.
     *
     * @param string|\PHPParser\Node\Expr $name       Name
     * @param array                      $attributes Additional attributes
     */
    public function __construct($name, array $attributes = array()) {
        parent::__construct(
            array(
                 'name' => $name
            ),
            $attributes
        );
    }
}