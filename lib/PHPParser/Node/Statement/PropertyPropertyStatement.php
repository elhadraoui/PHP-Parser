<?php

namespace PHPParser\Node\Statement;

/**
 * @property string                   $name    Name
 * @property null|PHPParser\Node\Expr $default Default
 */

use PHPParser\Node\Expr;

class PropertyStatement extends Statement
{
    /**
     * Constructs a class property node.
     *
     * @param string                   $name       Name
     * @param null|PHPParser\Node\Expr $default    Default value
     * @param array                    $attributes Additional attributes
     */
    public function __construct($name, Expr $default = null, array $attributes = array()) {
        parent::__construct(
            array(
                'name'    => $name,
                'default' => $default,
            ),
            $attributes
        );
    }
}