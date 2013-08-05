<?php

namespace PHPParser\Node\Statement;

/**
 * @property int                                    $type  Modifiers
 * @property PHPParser\Node\Statement_PropertyStatement[] $props Properties
 */
use PHPParser\Node\Statement\ClassStatement;



class PropertyStatement extends Statement
{
    /**
     * Constructs a class property list node.
     *
     * @param int                                    $type       Modifiers
     * @param PHPParser\Node\Statement_PropertyStatement[] $props      Properties
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
        return (bool) ($this->type & ClassStatement::MODIFIER_PUBLIC);
    }

    public function isProtected() {
        return (bool) ($this->type & ClassStatement::MODIFIER_PROTECTED);
    }

    public function isPrivate() {
        return (bool) ($this->type & ClassStatement::MODIFIER_PRIVATE);
    }

    public function isStatic() {
        return (bool) ($this->type & ClassStatement::MODIFIER_STATIC);
    }
}