<?php

namespace PHPParser\Node;

/**
 * @property null|\PHPParser\Node\Expr $cond  Condition (null for default)
 * @property \PHPParser\Node[]         $stmts Statements
 */
class Stmt_Case extends \PHPParser\Node\Stmt
{
    /**
     * Constructs a case node.
     *
     * @param null|\PHPParser\Node\Expr $cond       Condition (null for default)
     * @param \PHPParser\Node[]         $stmts      Statements
     * @param array                    $attributes Additional attributes
     */
    public function __construct($cond, array $stmts = array(), array $attributes = array()) {
        parent::__construct(
            array(
                'cond'  => $cond,
                'stmts' => $stmts,
            ),
            $attributes
        );
    }
}