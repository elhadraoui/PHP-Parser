<?php

namespace PHPParser\Node\Arg;

use PHPParser\Node\NodeAbstract;

/**
 * @property PHPParser\Node\Expr $value Value to pass
 * @property bool                $byRef Whether to pass by ref
 */

class Arg extends NodeAbstract
{
    /**
     * Constructs a function call argument node.
     *
     * @param PHPParser\Node\Expr $value      Value to pass
     * @param bool                $byRef      Whether to pass by ref
     * @param array               $attributes Additional attributes
     */
    public function __construct(PHPParser\Node\Expr $value, $byRef = false, array $attributes = array()) {
        parent::__construct(
            array(
                'value' => $value,
                'byRef' => $byRef
            ),
            $attributes
        );
    }
}