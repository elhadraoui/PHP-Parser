<?php

namespace PHPParser\Node\Expression;

/**
 * @property PHPParser\Node\Expr $expr Expression
 * @property int                 $type Type of include
 */
class IncludeExpression extends Expression
    const TYPE_INCLUDE      = 1;
    const TYPE_INCLUDE_ONCE = 2;
    const TYPE_REQUIRE      = 3;
    const TYPE_REQUIRE_ONCE = 4;

    /**
     * Constructs an include node.
     *
     * @param PHPParser\Node\Expr $expr       Expression
     * @param int                 $type       Type of include
     * @param array               $attributes Additional attributes
     */
    public function __construct(Expression $expr, $type, array $attributes = array()) {
        parent::__construct(
            array(
                'expr' => $expr,
                'type' => $type
            ),
            $attributes
        );
    }
}