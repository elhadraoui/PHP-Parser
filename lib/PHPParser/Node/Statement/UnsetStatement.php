<?php

namespace PHPParser\Node;

/**
 * @property PHPParser\Node\Expr[] $vars Variables to unset
 */
class Statement_Unset extends PHPParser\Node\Statement
{
    /**
     * Constructs an unset node.
     *
     * @param PHPParser\Node\Expr[] $vars       Variables to unset
     * @param array                 $attributes Additional attributes
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