<?php

namespace PHPParser\Node;

/**
 * @property PHPParser\Node\Expr      $expr     Expression to iterate
 * @property null|PHPParser\Node\Expr $keyVar   Variable to assign key to
 * @property bool                     $byRef    Whether to assign value by reference
 * @property PHPParser\Node\Expr      $valueVar Variable to assign value to
 * @property PHPParser\Node[]         $Statements    Statements
 */
class Statement_Foreach extends PHPParser\Node\Statement
{
    /**
     * Constructs a foreach node.
     *
     * @param PHPParser\Node\Expr $expr       Expression to iterate
     * @param PHPParser\Node\Expr $valueVar   Variable to assign value to
     * @param array               $subNodes   Array of the following optional subnodes:
     *                                        'keyVar' => null   : Variable to assign key to
     *                                        'byRef'  => false  : Whether to assign value by reference
     *                                        'Statements'  => array(): Statements
     * @param array               $attributes Additional attributes
     */
    public function __construct(PHPParser\Node\Expr $expr, PHPParser\Node\Expr $valueVar, array $subNodes = array(), array $attributes = array()) {
        parent::__construct(
            $subNodes + array(
                'keyVar' => null,
                'byRef'  => false,
                'Statements'  => array(),
            ),
            $attributes
        );
        $this->expr     = $expr;
        $this->valueVar = $valueVar;
    }
}