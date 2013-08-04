<?php

namespace PHPParser\Node;

/**
 * @property \PHPParser\Node\Expr[] $vars Variables
 */
class Expr_Isset extends PHPParser\Node\Expr
{
    /**
     * Constructs an array node.
     *
     * @param \PHPParser\Node\Expr[] $vars       Variables
     * @param array                 $attributes Additional attributes
     */
    public function __construct(array $vars, array $attributes = array()) {
        parent::__construct(
            array(
                'vars' => $vars
            ),
            $attributes
        );
    }
}