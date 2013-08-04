<?php

namespace PHPParser\Node;

/**
 * @property PHPParser\Node\Expr[] $exprs Expressions
 */
class Stmt_Echo extends PHPParser\Node\Stmt
{
    /**
     * Constructs an echo node.
     *
     * @param PHPParser\Node\Expr[] $exprs      Expressions
     * @param array                 $attributes Additional attributes
     */
    public function __construct(array $exprs, array $attributes = array()) {
        parent::__construct(
            array(
                'exprs' => $exprs,
            ),
            $attributes
        );
    }
}