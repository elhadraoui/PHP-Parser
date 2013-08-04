<?php

namespace PHPParser\Node;

/**
 * @property \PHPParser\Node\Stmt_DeclareDeclare[] $declares List of declares
 * @property \PHPParser\Node[]                     $stmts    Statements
 */
class Stmt_Declare extends PHPParser\Node\Stmt
{
    /**
     * Constructs a declare node.
     *
     * @param \PHPParser\Node\Stmt_DeclareDeclare[] $declares   List of declares
     * @param \PHPParser\Node[]                     $stmts      Statements
     * @param array                                $attributes Additional attributes
     */
    public function __construct(array $declares, array $stmts, array $attributes = array()) {
        parent::__construct(
            array(
                'declares' => $declares,
                'stmts'    => $stmts,
            ),
            $attributes
        );
    }
}