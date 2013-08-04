<?php

namespace PHPParser\Node;

/**
 * @property PHPParser\Node\Stmt_StaticVar[] $vars Variable definitions
 */
class Stmt_Static extends PHPParser\Node\Stmt
{
    /**
     * Constructs a static variables list node.
     *
     * @param PHPParser\Node\Stmt_StaticVar[] $vars       Variable definitions
     * @param array                           $attributes Additional attributes
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