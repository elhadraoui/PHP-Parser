<?php

namespace PHPParser\Node\Scalar;

class TraitConst extends \PHPParser\Node\Scalar
{
    /**
     * Constructs a __TRAIT__ const node
     *
     * @param array $attributes Additional attributes
     */
    public function __construct(array $attributes = array()) {
        parent::__construct(array(), $attributes);
    }
}