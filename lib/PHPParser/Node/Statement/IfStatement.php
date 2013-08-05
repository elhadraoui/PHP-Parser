<?php

namespace PHPParser\Node;

/**
 * @property PHPParser\Node\Expr           $cond    Condition expression
 * @property PHPParser\Node[]              $Statements   Statements
 * @property PHPParser\Node\Statement_ElseIf[]  $elseifs Elseif clauses
 * @property null|PHPParser\Node\Statement_Else $else    Else clause
 */
class Statement_If extends PHPParser\Node\Statement
{

    /**
     * Constructs an if node.
     *
     * @param PHPParser\Node\Expr $cond       Condition
     * @param array               $subNodes   Array of the following optional subnodes:
     *                                        'Statements'   => array(): Statements
     *                                        'elseifs' => array(): Elseif clauses
     *                                        'else'    => null   : Else clause
     * @param array               $attributes Additional attributes
     */
    public function __construct(PHPParser\Node\Expr $cond, array $subNodes = array(), array $attributes = array()) {
        parent::__construct(
            $subNodes + array(
                'Statements'   => array(),
                'elseifs' => array(),
                'else'    => null,
            ),
            $attributes
        );
        $this->cond = $cond;
    }
}