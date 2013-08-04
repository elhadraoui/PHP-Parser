<?php

namespace PHPParser\Node\Expr;

use PHPParser\Node\Expr;

/**
 * @property PHPParser\Node\Expr      $value Value
 * @property null|PHPParser\Node\Expr $key   Key
 * @property bool                     $byRef Whether to assign by reference
 */
class ArrayItem extends Expr
{
    /**
     * Constructs an array item node.
     *
     * @param PHPParser\Node\Expr      $value      Value
     * @param null|PHPParser\Node\Expr $key        Key
     * @param bool                     $byRef      Whether to assign by reference
     * @param array                    $attributes Additional attributes
     */
    public function __construct(Expr $value, Expr $key = null, $byRef = false, array $attributes = array()) {
        parent::__construct(
            array(
                'key'   => $key,
                'value' => $value,
                'byRef' => $byRef
            ),
            $attributes
        );
    }
}
