<?php

namespace PHPParser\Node\Stmt;

/**
 * @property string $value String
 */
class InlineHTML extends \PHPParser\Node\Stmt
{
    /**
     * Constructs an inline HTML node.
     *
     * @param string $value      String
     * @param array  $attributes Additional attributes
     */
    public function __construct($value, array $attributes = array()) {
        parent::__construct(
            array(
                'value' => $value,
            ),
            $attributes
        );
    }
}