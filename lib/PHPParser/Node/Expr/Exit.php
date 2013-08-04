<?php

namespace PHPParser\Node;

/**
 * @property null|\PHPParser\Node\Expr $expr Expression
 */
class Expr_Exit extends \PHPParser\Node\Expr
{
    /**
     * Constructs an exit() node.
     *
     * @param null|\PHPParser\Node\Expr $expr       Expression
     * @param array                    $attributes Additional attributes
     */
    public function __construct(\PHPParser\Node\Expr $expr = null, array $attributes = array()) {
        parent::__construct(
            array(
                'expr' => $expr
            ),
            $attributes
        );
    }
}