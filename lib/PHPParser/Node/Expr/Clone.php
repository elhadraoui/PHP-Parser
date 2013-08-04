<?php

namespace PHPParser\Node;

/**
 * @property \PHPParser\Node\Expr $expr Expression
 */
class Expr_Clone extends \PHPParser\Node\Expr
{
    /**
     * Constructs a clone node.
     *
     * @param \PHPParser\Node\Expr $expr       Expression
     * @param array               $attributes Additional attributes
     */
    public function __construct(\PHPParser\Node\Expr $expr, array $attributes = array()) {
        parent::__construct(
            array(
                'expr' => $expr
            ),
            $attributes
        );
    }
}