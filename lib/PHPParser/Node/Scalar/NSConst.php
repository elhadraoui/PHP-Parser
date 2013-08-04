<?php

namespace PHPParser\Node\Scalar;

use PHPParser\Node\Scalar;

class NSConst extends Scalar
{
    /**
     * Constructs a __NAMESPACE__ const node
     *
     * @param array $attributes Additional attributes
     */
    public function __construct(array $attributes = array()) {
        parent::__construct(array(), $attributes);
    }
}
