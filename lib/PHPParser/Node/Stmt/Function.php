<?php

namespace PHPParser\Node;

/**
 * @property bool                   $byRef  Whether returns by reference
 * @property string                 $name   Name
 * @property PHPParser\Node\Param[] $params Parameters
 * @property PHPParser\Node[]       $stmts  Statements
 */
class Stmt_Function extends PHPParser\Node\Stmt
{
    /**
     * Constructs a function node.
     *
     * @param string $name       Name
     * @param array  $subNodes   Array of the following optional subnodes:
     *                           'byRef'  => false  : Whether to return by reference
     *                           'params' => array(): Parameters
     *                           'stmts'  => array(): Statements
     * @param array  $attributes Additional attributes
     */
    public function __construct($name, array $subNodes = array(), array $attributes = array()) {
        parent::__construct(
            $subNodes + array(
                'byRef'  => false,
                'params' => array(),
                'stmts'  => array(),
            ),
            $attributes
        );
        $this->name = $name;
    }
}