<?php

namespace PHPParser\Node\Stmt;

/**
 * @property string                   $name    Name
 * @property null|\PHPParser\Node\Expr $default Default value
 */
class StaticVar extends PHPParser\Node\Stmt
{
    /**
     * Constructs a static variable node.
     *
     * @param string                   $name       Name
     * @param null|\PHPParser\Node\Expr $default    Default value
     * @param array                    $attributes Additional attributes
     */
    public function __construct($name, \PHPParser\Node\Expr $default = null, array $attributes = array()) {
        parent::__construct(
            array(
                'name'    => $name,
                'default' => $default,
            ),
            $attributes
        );
    }
}