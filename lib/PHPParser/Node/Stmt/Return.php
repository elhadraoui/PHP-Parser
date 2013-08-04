<?php

namespace PHPParser\Node;

/**
 * @property null|\PHPParser\Node\Expr $expr Expression
 */
class Stmt_Return extends \PHPParser\Node\Stmt
{
    /**
     * Constructs a return node.
     *
     * @param null|\PHPParser\Node\Expr $expr       Expression
     * @param array                    $attributes Additional attributes
     */
    public function __construct(\PHPParser\Node\Expr $expr = null, array $attributes = array()) {
        parent::__construct(
            array(
                'expr' => $expr,
            ),
            $attributes
        );
    }
}