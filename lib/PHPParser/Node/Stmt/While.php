<?php

namespace PHPParser\Node;

/**
 * @property \PHPParser\Node\Expr $cond  Condition
 * @property \PHPParser\Node[]    $stmts Statements
 */
class Stmt_While extends \PHPParser\Node\Stmt
{
    /**
     * Constructs a while node.
     *
     * @param \PHPParser\Node\Expr $cond       Condition
     * @param \PHPParser\Node[]    $stmts      Statements
     * @param array               $attributes Additional attributes
     */
    public function __construct(\PHPParser\Node\Expr $cond, array $stmts = array(), array $attributes = array()) {
        parent::__construct(
            array(
                'cond'  => $cond,
                'stmts' => $stmts,
            ),
            $attributes
        );
    }
}