<?php

namespace PHPParser\Node\Expr;

use PHPParser\Node\Expr;

/**
 * @property PHPParser\Node\Name $name Constant name
 */
class ConstFetch extends Expr
{
    /**
     * Constructs a const fetch node.
     *
     * @param PHPParser\Node\Name $name       Constant name
     * @param array               $attributes Additional attributes
     */
    public function __construct(PHPParser\Node\Name $name, array $attributes = array()) {
        parent::__construct(
            array(
                'name'  => $name
            ),
            $attributes
        );
    }
}
