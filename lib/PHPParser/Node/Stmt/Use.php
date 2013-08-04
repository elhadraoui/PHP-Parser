<?php

namespace PHPParser\Node;

/**
 * @property PHPParser\Node\Stmt_UseUse[] $uses Aliases
 */
class Stmt_Use extends PHPParser\Node\Stmt
{
    /**
     * Constructs an alias (use) list node.
     *
     * @param PHPParser\Node\Stmt_UseUse[] $uses       Aliases
     * @param array                        $attributes Additional attributes
     */
    public function __construct(array $uses, array $attributes = array()) {
        parent::__construct(
            array(
                'uses' => $uses,
            ),
            $attributes
        );
    }
}