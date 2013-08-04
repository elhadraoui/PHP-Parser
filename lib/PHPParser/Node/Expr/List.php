<?php

namespace PHPParser\Node;

/**
 * @property array $vars List of variables to assign to
 */
class Expr_List extends PHPParser\Node\Expr
{
    /**
     * Constructs a list() destructuring node.
     *
     * @param array $vars       List of variables to assign to
     * @param array $attributes Additional attributes
     */
    public function __construct(array $vars, array $attributes = array()) {
        parent::__construct(
            array(
                'vars' => $vars,
            ),
            $attributes
        );
    }
}