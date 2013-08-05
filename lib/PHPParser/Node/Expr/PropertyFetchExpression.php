<?php

namespace PHPParser\Node\Expression;

/**
 * @property PHPParser\Node\Expr        $var  Variable holding object
 * @property string|PHPParser\Node\Expr $name PropertyStatement Name
 */
class PropertyStatementFetchExpression extends Expression
{
    /**
     * Constructs a function call node.
     *
     * @param PHPParser\Node\Expr        $var        Variable holding object
     * @param string|PHPParser\Node\Expr $name       PropertyStatement name
     * @param array                      $attributes Additional attributes
     */
    public function __construct(Expression $var, $name, array $attributes = array()) {
        parent::__construct(
            array(
                'var'  => $var,
                'name' => $name
            ),
            $attributes
        );
    }
}
