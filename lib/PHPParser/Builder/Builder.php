<?php

namespace PHPParser\Builder;

interface Builder
{
    /**
     * Returns the built node.
     *
     * @return PHPParser\Node The built node
     */
    public function getNode();
}
