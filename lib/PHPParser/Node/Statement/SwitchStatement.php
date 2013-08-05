<?php

namespace PHPParser\Node;

/**
 * @property PHPParser\Node\Expr        $cond  Condition
 * @property PHPParser\Node\Statement_Case[] $cases Case list
 */
class Statement_Switch extends PHPParser\Node\Statement
{
    /**
     * Constructs a case node.
     *
     * @param PHPParser\Node\Expr        $cond       Condition
     * @param PHPParser\Node\Statement_Case[] $cases      Case list
     * @param array                      $attributes Additional attributes
     */
    public function __construct(PHPParser\Node\Expr $cond, array $cases, array $attributes = array()) {
        parent::__construct(
            array(
                'cond'  => $cond,
                'cases' => $cases,
            ),
            $attributes
        );
    }
}