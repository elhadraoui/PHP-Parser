<?php

namespace PHPParser\Node\Scalar;

class LineConst extends PHPParser\Node\Scalar
{
    /**
     * Constructs a __LINE__ const node
     *
     * @param array $attributes Additional attributes
     */
    public function __construct(array $attributes = array()) {
        parent::__construct(array(), $attributes);
    }
}