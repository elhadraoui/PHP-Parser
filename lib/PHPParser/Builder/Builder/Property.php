<?php

namespace PHPParser\Builder;

use PHPParser\Node\Statement\PropertyStatement;

use PHPParser\Node\Statement\PropertyStatement;

use PHPParser\Node\Statement\ClassStatement;

class Builder_PropertyStatement extends BuilderAbstract
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
     * @return PHPParser\Builder_PropertyStatement The builder instance (for fluid interface)
     */
    public function makePublic() {
        $this->setModifier(ClassStatement::MODIFIER_PUBLIC);

        return $this;
    }

    /**
     * Makes the property protected.
     *
     * @return PHPParser\Builder_PropertyStatement The builder instance (for fluid interface)
     */
    public function makeProtected() {
        $this->setModifier(ClassStatement::MODIFIER_PROTECTED);

        return $this;
    }

    /**
     * Makes the property private.
     *
     * @return PHPParser\Builder_PropertyStatement The builder instance (for fluid interface)
     */
    public function makePrivate() {
        $this->setModifier(ClassStatement::MODIFIER_PRIVATE);

        return $this;
    }

    /**
     * Makes the property static.
     *
     * @return PHPParser\Builder_PropertyStatement The builder instance (for fluid interface)
     */
    public function makeStatic() {
        $this->setModifier(ClassStatement::MODIFIER_STATIC);

        return $this;
    }

    /**
     * Sets default value for the property.
     *
     * @param mixed $value Default value to use
     *
     * @return PHPParser\Builder_PropertyStatement The builder instance (for fluid interface)
     */
    public function setDefault($value) {
        $this->default = $this->normalizeValue($value);

        return $this;
    }

    /**
     * Returns the built class node.
     *
     * @return PHPParser\Node\Statement_PropertyStatement The built property node
     */
    public function getNode() {
        return new PropertyStatement(
            $this->type !== 0 ? $this->type : ClassStatement::MODIFIER_PUBLIC,
            array(
                new PropertyStatement($this->name, $this->default)
            )
        );
    }
}
