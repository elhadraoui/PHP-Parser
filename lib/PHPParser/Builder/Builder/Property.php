<?php

namespace PHPParser\Builder;

use PHPParser\Node\Stmt\PropertyProperty;

use PHPParser\Node\Stmt\Property;

use PHPParser\Node\Stmt_Class;

class Builder_Property extends BuilderAbstract
{
    protected $name;

    protected $type;
    protected $default;

    /**
     * Creates a property builder.
     *
     * @param string $name Name of the property
     */
    public function __construct($name) {
        $this->name = $name;

        $this->type = 0;
        $this->default = null;
    }

    /**
     * Makes the property public.
     *
     * @return PHPParser\Builder_Property The builder instance (for fluid interface)
     */
    public function makePublic() {
        $this->setModifier(Stmt_Class::MODIFIER_PUBLIC);

        return $this;
    }

    /**
     * Makes the property protected.
     *
     * @return PHPParser\Builder_Property The builder instance (for fluid interface)
     */
    public function makeProtected() {
        $this->setModifier(Stmt_Class::MODIFIER_PROTECTED);

        return $this;
    }

    /**
     * Makes the property private.
     *
     * @return PHPParser\Builder_Property The builder instance (for fluid interface)
     */
    public function makePrivate() {
        $this->setModifier(Stmt_Class::MODIFIER_PRIVATE);

        return $this;
    }

    /**
     * Makes the property static.
     *
     * @return PHPParser\Builder_Property The builder instance (for fluid interface)
     */
    public function makeStatic() {
        $this->setModifier(Stmt_Class::MODIFIER_STATIC);

        return $this;
    }

    /**
     * Sets default value for the property.
     *
     * @param mixed $value Default value to use
     *
     * @return PHPParser\Builder_Property The builder instance (for fluid interface)
     */
    public function setDefault($value) {
        $this->default = $this->normalizeValue($value);

        return $this;
    }

    /**
     * Returns the built class node.
     *
     * @return PHPParser\Node\Stmt_Property The built property node
     */
    public function getNode() {
        return new Property(
            $this->type !== 0 ? $this->type : Stmt_Class::MODIFIER_PUBLIC,
            array(
                new PropertyProperty($this->name, $this->default)
            )
        );
    }
}
