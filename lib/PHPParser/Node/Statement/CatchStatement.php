<?php

namespace PHPParser\Node;

/**
 * @property PHPParser\Node\Name $type  Class of exception
 * @property string              $var   Variable for exception
 * @property PHPParser\Node[]    $Statements Statements
 */
class Statement_Catch extends PHPParser\Node\Statement
{
    /**
     * Constructs a catch node.
     *
     * @param PHPParser\Node\Name $type       Class of exception
     * @param string              $var        Variable for exception
     * @param PHPParser\Node[]    $Statements      Statements
     * @param array               $attributes Additional attributes
     */
    public function __construct(PHPParser\Node\Name $type, $var, array $Statements = array(), array $attributes = array()) {
        parent::__construct(
            array(
                'type'  => $type,
                'var'   => $var,
                'Statements' => $Statements,
            ),
            $attributes
        );
    }
}