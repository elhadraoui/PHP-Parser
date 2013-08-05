<?php

namespace PHPParser\Node;

/**
 * @property null|PHPParser\Node\Expr $cond  Condition (null for default)
 * @property PHPParser\Node[]         $Statements Statements
 */
class Statement_Case extends PHPParser\Node\Statement
{
    /**
     * Constructs a case node.
     *
     * @param null|PHPParser\Node\Expr $cond       Condition (null for default)
     * @param PHPParser\Node[]         $Statements      Statements
     * @param array                    $attributes Additional attributes
     */
    public function __construct($cond, array $Statements = array(), array $attributes = array()) {
        parent::__construct(
            array(
                'cond'  => $cond,
                'Statements' => $Statements,
            ),
            $attributes
        );
    }
}