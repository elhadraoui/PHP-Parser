<?php

namespace PHPParser\Node;

/**
 * @property PHPParser\Node\Expr $cond  Condition
 * @property PHPParser\Node[]    $Statements Statements
 */
class Statement_Do extends PHPParser\Node\Statement
{
    /**
     * Constructs a do while node.
     *
     * @param PHPParser\Node\Expr $cond       Condition
     * @param PHPParser\Node[]    $Statements      Statements
     * @param array               $attributes Additional attributes
     */
    public function __construct(PHPParser\Node\Expr $cond, array $Statements = array(), array $attributes = array()) {
        parent::__construct(
            array(
                'cond'  => $cond,
                'Statements' => $Statements,
            ),
            $attributes
        );
    }
}