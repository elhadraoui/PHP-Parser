<?php

namespace PHPParser\Node\Stmt;

/**
 * @property int                                    $type  Modifiers
 * @property PHPParser\Node\Stmt_PropertyProperty[] $props Properties
 */
class Property extends PHPParser\Node\Stmt
{
    /**
     * Constructs a class property list node.
     *
     * @param int                                    $type       Modifiers
     * @param PHPParser\Node\Stmt_PropertyProperty[] $props      Properties
     * @param array                                  $attributes Additional attributes
     */
    public function __construct($type, array $props, array $attributes = array()) {
        parent::__construct(
            array(
                'type'  => $type,
                'props' => $props,
            ),
            $attributes
        );
    }

    public function isPublic() {
        return (bool) ($this->type & PHPParser\Node\Stmt_Class::MODIFIER_PUBLIC);
    }

    public function isProtected() {
        return (bool) ($this->type & PHPParser\Node\Stmt_Class::MODIFIER_PROTECTED);
    }

    public function isPrivate() {
        return (bool) ($this->type & PHPParser\Node\Stmt_Class::MODIFIER_PRIVATE);
    }

    public function isStatic() {
        return (bool) ($this->type & PHPParser\Node\Stmt_Class::MODIFIER_STATIC);
    }
}