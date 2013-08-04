<?php

namespace Expr;

/**
 * @property PHPParser\Node\Expr $var Variable
 */
class PostDec extends PHPParser\Node\Expr
{
    /**
     * Constructs a post decrement node.
     *
     * @param PHPParser\Node\Expr $var        Variable
     * @param array               $attributes Additional attributes
     */
    public function __construct(PHPParser\Node\Expr $var, array $attributes = array()) {
        parent::__construct(
            array(
                'var' => $var
            ),
            $attributes
        );
    }
}