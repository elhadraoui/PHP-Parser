<?php

namespace PHPParser\Builder;

/**
 * "class", "interface" and "function" are reserved keywords, so the methods are defined as _class(),
 * _interface() and _function() in the class and are made available as class(), interface() and function()
 * through __call() magic.
 *
 * @method PHPParser\Builder_Class     class(string $name)     Creates a class builder.
 * @method PHPParser\Builder_Function  function(string $name)  Creates a function builder
 * @method PHPParser\Builder_Interface interface(string $name) Creates an interface builder.
 */
class Factory
{
    /**
     * Creates a class builder.
     *
     * @param string $name Name of the class
     *
     * @return PHPParser\Builder_Class The created class builder
     */
    protected function _class($name) {
        return new PHPParser\Builder_Class($name);
    }

    /**
     * Creates a interface builder.
     *
     * @param string $name Name of the interface
     *
     * @return PHPParser\Builder_Class The created interface builder
     */
    protected function _interface($name) {
        return new PHPParser\Builder_Interface($name);
    }

    /**
     * Creates a method builder.
     *
     * @param string $name Name of the method
     *
     * @return PHPParser\Builder_Method The created method builder
     */
    public function method($name) {
        return new PHPParser\Builder_Method($name);
    }

    /**
     * Creates a parameter builder.
     *
     * @param string $name Name of the parameter
     *
     * @return PHPParser\Builder_Param The created parameter builder
     */
    public function param($name) {
        return new PHPParser\Builder_Param($name);
    }

    /**
     * Creates a property builder.
     *
     * @param string $name Name of the property
     *
     * @return PHPParser\Builder_Property The created property builder
     */
    public function property($name) {
        return new PHPParser\Builder_Property($name);
    }

    /**
     * Creates a function builder.
     *
     * @param string $name Name of the function
     *
     * @return PHPParser\Builder_Property The created function builder
     */
    protected function _function($name) {
        return new PHPParser\Builder_Function($name);
    }

    public function __call($name, array $args) {
        if (method_exists($this, '_' . $name)) {
            return call_user_func_array(array($this, '_' . $name), $args);
        }

        throw new LogicException(sprintf('Method "%s" does not exist', $name));
    }
}