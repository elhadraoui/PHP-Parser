<?php

namespace PHPParser\Node;

/**
 * @property \PHPParser\Node\Expr $expr Expression
 */
class Stmt_Throw extends PHPParser\Node\Stmt
{
    /**
     * Constructs a throw node.
     *
     * @param \PHPParser\Node\Expr $expr       Expression
     * @param array               $attributes Additional attributes
     */
    public function __construct(\PHPParser\Node\Expr $expr, array $attributes = array()) {
        parent::__construct(
            array(
                'expr' => $expr,
            ),
            $attributes
        );
    }
}