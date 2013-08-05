<?php

namespace PHPParser\Node\Expression;

/**
 * @property null|PHPParser\Node\Expr $value Value expression
 * @property null|PHPParser\Node\Expr $key   Key expression
 */
class YieldExpression extends Expression
{
    /**
     * Constructs a yield expression node.
     *
     * @param null|PHPParser\Node\Expr $value ´    Value expression
     * @param null|PHPParser\Node\Expr $key        Key expression
     * @param array                    $attributes Additional attributes
     */
    public function __construct(Expression  $value = null, Expression $key = null, array $attributes = array()) {
        parent::__construct(
            array(
                'key'   => $key,
                'value' => $value,
            ),
            $attributes
        );
    }
}
