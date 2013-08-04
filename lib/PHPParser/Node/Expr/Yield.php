<?php

namespace Expr;

/**
 * @property null|\PHPParser\Node\Expr $value Value expression
 * @property null|\PHPParser\Node\Expr $key   Key expression
 */
class Yield extends \PHPParser\Node\Expr
{
    /**
     * Constructs a yield expression node.
     *
     * @param null|\PHPParser\Node\Expr $value ´    Value expression
     * @param null|\PHPParser\Node\Expr $key        Key expression
     * @param array                    $attributes Additional attributes
     */
    public function __construct(\PHPParser\Node\Expr $value = null, \PHPParser\Node\Expr $key = null, array $attributes = array()) {
        parent::__construct(
            array(
                'key'   => $key,
                'value' => $value,
            ),
            $attributes
        );
    }
}