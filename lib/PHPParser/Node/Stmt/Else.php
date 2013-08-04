<?php

namespace PHPParser\Node;

/**
 * @property \PHPParser\Node[] $stmts Statements
 */
class Stmt_Else extends \PHPParser\Node\Stmt
{
    /**
     * Constructs an else node.
     *
     * @param \PHPParser\Node[] $stmts      Statements
     * @param array            $attributes Additional attributes
     */
    public function __construct(array $stmts = array(), array $attributes = array()) {
        parent::__construct(
            array(
                'stmts' => $stmts,
            ),
            $attributes
        );
    }
}