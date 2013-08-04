<?php

namespace PHPParser\Node;

/**
 * @property \PHPParser\Node\Name $name  Namespace/Class to alias
 * @property string              $alias Alias
 */
class Stmt_UseUse extends PHPParser\Node\Stmt
{
    /**
     * Constructs an alias (use) node.
     *
     * @param \PHPParser\Node\Name $name       Namespace/Class to alias
     * @param null|string         $alias      Alias
     * @param array               $attributes Additional attributes
     */
    public function __construct(\PHPParser\Node\Name $name, $alias = null, array $attributes = array()) {
        if (null === $alias) {
            $alias = $name->getLast();
        }

        if ('self' == $alias || 'parent' == $alias) {
            throw new \PHPParser\Error(sprintf(
                'Cannot use "%s" as "%s" because "%2$s" is a special class name',
                $name, $alias
            ));
        }

        parent::__construct(
            array(
                'name'  => $name,
                'alias' => $alias,
            ),
            $attributes
        );
    }
}