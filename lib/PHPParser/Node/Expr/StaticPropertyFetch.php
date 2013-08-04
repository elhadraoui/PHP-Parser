<?php

namespace Expr;

/**
 * @property PHPParser\Node\Name|PHPParser\Node\Expr $class Class name
 * @property string|PHPParser\Node\Expr              $name  Property name
 */
class StaticPropertyFetch extends PHPParser\Node\Expr
{
    /**
     * Constructs a static property fetch node.
     *
     * @param PHPParser\Node\Name|PHPParser\Node\Expr $class      Class name
     * @param string|PHPParser\Node\Expr              $name       Property name
     * @param array                                   $attributes Additional attributes
     */
    public function __construct($class, $name, array $attributes = array()) {
        parent::__construct(
            array(
                'class' => $class,
                'name'  => $name
            ),
            $attributes
        );
    }
}