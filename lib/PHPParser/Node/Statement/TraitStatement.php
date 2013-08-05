<?php

namespace PHPParser\Node;

/**
 * @property string           $name  Name
 * @property PHPParser\Node[] $Statements Statements
 */
class Statement_Trait extends Statement
{
    /**
     * Constructs a trait node.
     *
     * @param string           $name       Name
     * @param PHPParser\Node[] $Statements      Statements
     * @param array            $attributes Additional attributes
     */
    public function __construct($name, array $Statements = array(), array $attributes = array()) {
        parent::__construct(
            array(
                'name'  => $name,
                'Statements' => $Statements,
            ),
            $attributes
        );
    }
}