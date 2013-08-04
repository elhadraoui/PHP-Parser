<?php

namespace PHPParser\Node;

/**
 * @property Expr_ArrayItem[] $items Items
 */
class Expr_Array extends Expr
{
    /**
     * Constructs an array node.
     *
     * @param Expr_ArrayItem[] $items      Items of the array
     * @param array                           $attributes Additional attributes
     */
    public function __construct(array $items = array(), array $attributes = array()) {
        parent::__construct(
            array(
                'items' => $items
            ),
            $attributes
        );
    }
}
