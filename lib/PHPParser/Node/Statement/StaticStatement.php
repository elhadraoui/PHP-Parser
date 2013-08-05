<?php

namespace PHPParser\Node;

/**
 * @property PHPParser\Node\Statement_StaticVar[] $vars Variable definitions
 */
class Statement_Static extends PHPParser\Node\Statement
{
    /**
     * Constructs a static variables list node.
     *
     * @param PHPParser\Node\Statement_StaticVar[] $vars       Variable definitions
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