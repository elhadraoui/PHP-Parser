<?php

namespace PHPParser\Node\Expression;

use PHPParser\Node\Expression;
use PHPParser\Node\Name;

/**
 * @property PHPParser\Node\Name $name Constant name
 */
class ConstFetchExpression extends Expression
{
    /**
     * Constructs a const fetch node.
     *
     * @param PHPParser\Node\Name $name       Constant name
     * @param array               $attributes Additional attributes
     */
    public function __construct(Name $name, array $attributes = array()) {
        parent::__construct(
            array(
                'name'  => $name
            ),
            $attributes
        );
    }
}
