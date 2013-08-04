<?php

namespace PHPParser\Node;

/**
 * @property string              $name  Name
 * @property \PHPParser\Node\Expr $value Value
 */
class Node_Const extends NodeAbstract
{
    /**
     * Constructs a const node for use in class const and const statements.
     *
     * @param string              $name       Name
     * @param \PHPParser\Node\Expr $value      Value
     * @param array               $attributes Additional attributes
     */
    public function __construct($name, \PHPParser\Node\Expr $value, array $attributes = array()) {
        parent::__construct(
            array(
                'name'  => $name,
                'value' => $value,
            ),
            $attributes
        );
    }
}