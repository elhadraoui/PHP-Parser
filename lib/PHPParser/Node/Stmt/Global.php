<?php

namespace PHPParser\Node;

/**
 * @property \PHPParser\Node\Expr[] $vars Variables
 */
class Stmt_Global extends PHPParser\Node\Stmt
{
    /**
     * Constructs a global variables list node.
     *
     * @param \PHPParser\Node\Expr[] $vars       Variables to unset
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