<?php

namespace PHPParser\Node;

/**
 * @codeCoverageIgnore
 */
class VisitorAbstract implements Visitor
{
    public function beforeTraverse(array $nodes)    { }
    public function enterNode(Node $node) { }
    public function leaveNode(Node $node) { }
    public function afterTraverse(array $nodes)     { }
}