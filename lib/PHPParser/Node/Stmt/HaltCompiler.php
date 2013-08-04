<?php

namespace PHPParser\Node\Stmt;

/**
 * @property string $remaining Remaining text after halt compiler statement.
 */
class HaltCompiler extends \PHPParser\Node\Stmt
{
    /**
     * Constructs a __halt_compiler node.
     *
     * @param string $remaining  Remaining text after halt compiler statement.
     * @param array  $attributes Additional attributes
     */
    public function __construct($remaining, array $attributes = array()) {
        parent::__construct(
            array(
                'remaining' => $remaining,
            ),
            $attributes
        );
    }
}