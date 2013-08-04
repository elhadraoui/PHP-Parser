<?php

namespace Expr;

/**
 * @property array $parts Encapsed string array
 */
class ShellExec extends PHPParser\Node\Expr
{
    /**
     * Constructs a shell exec (backtick) node.
     *
     * @param array       $parts      Encapsed string array
     * @param array       $attributes Additional attributes
     */
    public function __construct($parts, array $attributes = array()) {
        parent::__construct(
            array(
                'parts' => $parts
            ),
            $attributes
        );
    }
}