<?php

namespace PHPParser\Node\Stmt;

/**
 * @property string              $key   Key
 * @property PHPParser\Node\Expr $value Value
 */
class DeclareDeclare extends PHPParser\Node\Stmt
{
    /**
     * Constructs a declare key=>value pair node.
     *
     * @param string              $key        Key
     * @param PHPParser\Node\Expr $value      Value
     * @param array               $attributes Additional attributes
     */
    public function __construct($key, PHPParser\Node\Expr $value, array $attributes = array()) {
        parent::__construct(
            array(
                'key'   => $key,
                'value' => $value,
            ),
            $attributes
        );
    }
}