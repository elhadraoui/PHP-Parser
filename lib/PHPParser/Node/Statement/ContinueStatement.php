<?php

namespace PHPParser\Node;

/**
 * @property null|PHPParser\Node\Expr $num Number of loops to continue
 */
class Statement_Continue extends PHPParser\Node\Statement
{
    /**
     * Constructs a continue node.
     *
     * @param null|PHPParser\Node\Expr $num        Number of loops to continue
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