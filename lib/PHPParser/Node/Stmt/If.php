<?php

namespace PHPParser\Node;

/**
 * @property PHPParser\Node\Expr           $cond    Condition expression
 * @property PHPParser\Node[]              $stmts   Statements
 * @property PHPParser\Node\Stmt_ElseIf[]  $elseifs Elseif clauses
 * @property null|PHPParser\Node\Stmt_Else $else    Else clause
 */
class Stmt_If extends PHPParser\Node\Stmt
{

    /**
     * Constructs an if node.
     *
     * @param PHPParser\Node\Expr $cond       Condition
     * @param array               $subNodes   Array of the following optional subnodes:
     *                                        'stmts'   => array(): Statements
     *                                        'elseifs' => array(): Elseif clauses
     *                                        'else'    => null   : Else clause
     * @param array               $attributes Additional attributes
     */
    public function __construct(PHPParser\Node\Expr $cond, array $subNodes = array(), array $attributes = array()) {
        parent::__construct(
            $subNodes + array(
                'stmts'   => array(),
                'elseifs' => array(),
                'else'    => null,
            ),
            $attributes
        );
        $this->cond = $cond;
    }
}