<?php

namespace PHPParser\Node;

/**
 * @property \PHPParser\Node[]            $stmts        Statements
 * @property \PHPParser\Node\Stmt_Catch[] $catches      Catches
 * @property \PHPParser\Node[]            $finallyStmts Finally statements
 */
class Stmt_TryCatch extends PHPParser\Node\Stmt
{
    /**
     * Constructs a try catch node.
     *
     * @param \PHPParser\Node[]            $stmts        Statements
     * @param \PHPParser\Node\Stmt_Catch[] $catches      Catches
     * @param \PHPParser\Node[]            $finallyStmts Finally statements (null means no finally clause)
     * @param array|null                  $attributes   Additional attributes
     */
    public function __construct(array $stmts, array $catches, array $finallyStmts = null, array $attributes = array()) {
        if (empty($catches) && null === $finallyStmts) {
            throw new \PHPParser\Error('Cannot use try without catch or finally');
        }

        parent::__construct(
            array(
                'stmts'        => $stmts,
                'catches'      => $catches,
                'finallyStmts' => $finallyStmts,
            ),
            $attributes
        );
    }
}