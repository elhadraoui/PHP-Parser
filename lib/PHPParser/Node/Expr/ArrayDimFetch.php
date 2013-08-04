<?php

namespace Expr;

/**
 * @property PHPParser\Node\Expr      $var Variable
 * @property null|PHPParser\Node\Expr $dim Array index / dim
 */
class ArrayDimFetch extends Expr
{
    /**
     * Constructs an array index fetch node.
     *
     * @param PHPParser\Node\Expr      $var        Variable
     * @param null|PHPParser\Node\Expr $dim        Array index / dim
     * @param array                    $attributes Additional attributes
     */
    public function __construct(PHPParser\Node\Expr $var, PHPParser\Node\Expr $dim = null, array $attributes = array()) {
        parent::__construct(
            array(
                'var' => $var,
                'dim' => $dim
            ),
            $attributes
        );
    }
}
