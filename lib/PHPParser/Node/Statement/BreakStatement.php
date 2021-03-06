<?php

namespace PHPParser\Node;

/**
 * @property null|PHPParser\Node\Expr $num Number of loops to break
 */
class BreakStatement extends PHPParser\Node\Statement
{
    /**
     * Constructs a break node.
     *
     * @param null|PHPParser\Node\Expr $num        Number of loops to break
     * @param array                    $attributes Additional attributes
     */
    public function __construct(PHPParser\Node\Expr $num = null, array $attributes = array()) {
        parent::__construct(
            array(
                'num' => $num,
            ),
            $attributes
        );
    }
}