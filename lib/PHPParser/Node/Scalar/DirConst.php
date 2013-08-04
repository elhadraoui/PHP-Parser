<?php

namespace PHPParser\Node\Scalar;

class DirConst extends PHPParser\Node\Scalar
{
    /**
     * Constructs a __DIR__ const node
     *
     * @param array $attributes Additional attributes
     */
    public function __construct(array $attributes = array()) {
        parent::__construct(array(), $attributes);
    }
}