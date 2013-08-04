<?php

namespace PHPParser\Node;

/**
 * @property \PHPParser\Node\Name $type  Class of exception
 * @property string              $var   Variable for exception
 * @property \PHPParser\Node[]    $stmts Statements
 */
class Stmt_Catch extends PHPParser\Node\Stmt
{
    /**
     * Constructs a catch node.
     *
     * @param \PHPParser\Node\Name $type       Class of exception
     * @param string              $var        Variable for exception
     * @param \PHPParser\Node[]    $stmts      Statements
     * @param array               $attributes Additional attributes
     */
    public function __construct(\PHPParser\Node\Name $type, $var, array $stmts = array(), array $attributes = array()) {
        parent::__construct(
            array(
                'type'  => $type,
                'var'   => $var,
                'stmts' => $stmts,
            ),
            $attributes
        );
    }
}