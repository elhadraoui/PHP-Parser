<?php

namespace PHPParser\Node;

/**
 * @property string                $name    Name
 * @property PHPParser\Node\Name[] $extends Extended interfaces
 * @property PHPParser\Node[]      $stmts   Statements
 */
class Stmt_Interface extends PHPParser\Node\Stmt
{
    protected static $specialNames = array(
        'self'   => true,
        'parent' => true,
        'static' => true,
    );

    /**
     * Constructs a class node.
     *
     * @param string $name       Name
     * @param array  $subNodes   Array of the following optional subnodes:
     *                           'extends' => array(): Name of extended interfaces
     *                           'stmts'   => array(): Statements
     * @param array  $attributes Additional attributes
     */
    public function __construct($name, array $subNodes = array(), array $attributes = array()) {
        parent::__construct(
            $subNodes + array(
                'extends' => array(),
                'stmts'   => array(),
            ),
            $attributes
        );
        $this->name = $name;

        if (isset(self::$specialNames[(string) $this->name])) {
            throw new PHPParser\Error(sprintf('Cannot use "%s" as interface name as it is reserved', $this->name));
        }

        foreach ($this->extends as $interface) {
            if (isset(self::$specialNames[(string) $interface])) {
                throw new PHPParser\Error(sprintf('Cannot use "%s" as interface name as it is reserved', $interface));
            }
        }
    }
}