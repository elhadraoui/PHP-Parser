<?php

namespace PHPParser\Node\Stmt;

/**
 * @property string           $name  Name
 * @property \PHPParser\Node[] $stmts Statements
 */
class Trait extends PHPParser\Node\Stmt
{
    /**
     * Constructs a trait node.
     *
     * @param string           $name       Name
     * @param \PHPParser\Node[] $stmts      Statements
     * @param array            $attributes Additional attributes
     */
    public function __construct($name, array $stmts = array(), array $attributes = array()) {
        parent::__construct(
            array(
                'name'  => $name,
                'stmts' => $stmts,
            ),
            $attributes
        );
    }
}