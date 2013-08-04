<?php

namespace PHPParser\Node\Scalar;

use PHPParser\Node\Scalar;

class FuncConst extends Scalar
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
