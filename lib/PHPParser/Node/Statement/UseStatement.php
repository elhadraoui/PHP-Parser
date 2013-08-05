<?php

namespace PHPParser\Node;

/**
 * @property PHPParser\Node\Statement_UseUse[] $uses Aliases
 */
class Statement_Use extends Statement
{
    /**
     * Constructs an alias (use) list node.
     *
     * @param PHPParser\Node\Statement_UseUse[] $uses       Aliases
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