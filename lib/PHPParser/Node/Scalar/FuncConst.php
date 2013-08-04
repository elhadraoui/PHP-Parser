<?php

namespace PHPParser\Node\Scalar;

class FuncConst extends PHPParser\Node\Scalar
{
    /**
     * Constructs a __FUNCTION__ const node
     *
     * @param array $attributes Additional attributes
     */
    public function __construct(array $attributes = array()) {
        parent::__construct(array(), $attributes);
    }
}