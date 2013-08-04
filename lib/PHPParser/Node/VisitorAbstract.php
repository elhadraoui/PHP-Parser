<?php

namespace PHPParser\Node;

/**
 * @codeCoverageIgnore
 */
class VisitorAbstract implements PHPParser\NodeVisitor
{
    public function beforeTraverse(array $nodes)    { }
    public function enterNode(PHPParser\Node $node) { }
    public function leaveNode(PHPParser\Node $node) { }
    public function afterTraverse(array $nodes)     { }
}