<?php

namespace Expr;

/**
 * @property \PHPParser\Node\Expr $expr Expression
 */
abstract class Cast extends \PHPParser\Node\Expr
{
    /**
     * Constructs a cast node.
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