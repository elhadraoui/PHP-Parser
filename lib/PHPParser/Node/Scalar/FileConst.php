<?php

namespace PHPParser\Node\Scalar;

class FileConst extends PHPParser\Node\Scalar
{
    /**
     * Constructs a __FILE__ const node
     *
     * @param array $attributes Additional attributes
     */
    public function __construct(array $attributes = array()) {
        parent::__construct(array(), $attributes);
    }
}