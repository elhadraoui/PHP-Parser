<?php

namespace Expr;

/**
 * @property \PHPParser\Node\Expr $expr Expression
 */
class BooleanNot extends \PHPParser\Node\Expr
{
    /**
     * Constructs a boolean not node.
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