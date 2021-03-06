<?php

namespace PHPParser\Builder;

use PHPParser\Node\Expr_Array;

use PHPParser\Node\Expr\ArrayItem;

use PHPParser\Node\Scalar\String;

use PHPParser\Node\Scalar\DNumber;

use PHPParser\Node\Scalar\LNumber;

use PHPParser\Node\Expr\ConstFetch;

use PHPParser\Node\Statement\ClassStatement;

use PHPParser\Node\Name;

abstract class BuilderAbstract implements Builder {
    /**
     * Normalizes a node: Converts builder objects to nodes.
     *
     * @param PHPParser\Node|PHPParser\Builder $node The node to normalize
     *
     * @return PHPParser\Node The normalized node
     */
    protected function normalizeNode($node) {
        if ($node instanceof PHPParser\Builder) {
            return $node->getNode();
        } elseif ($node instanceof PHPParser\Node) {
            return $node;
        }

        throw new \LogicException('Expected node or builder object');
    }

    /**
     * Normalizes a name: Converts plain string names to Name.
     *
     * @param Name|string $name The name to normalize
     *
     * @return Name The normalized name
     */
    protected function normalizeName($name) {
        if ($name instanceof Name) {
            return $name;
        } else {
            return new Name($name);
        }
    }

    /**
     * Normalizes a value: Converts nulls, booleans, integers,
     * floats, strings and arrays into their respective nodes
     *
     * @param mixed $value The value to normalize
     *
     * @return Expr The normalized value
     */
    protected function normalizeValue($value) {
        if ($value instanceof PHPParser\Node) {
            return $value;
        } elseif (is_null($value)) {
            return new ConstFetch(
                new Name('null')
            );
        } elseif (is_bool($value)) {
            return new ConstFetch(
                new Name($value ? 'true' : 'false')
            );
        } elseif (is_int($value)) {
            return new LNumber($value);
        } elseif (is_float($value)) {
            return new DNumber($value);
        } elseif (is_string($value)) {
            return new String($value);
        } elseif (is_array($value)) {
            $items = array();
            $lastKey = -1;
            foreach ($value as $itemKey => $itemValue) {
                // for consecutive, numeric keys don't generate keys
                if (null !== $lastKey && ++$lastKey === $itemKey) {
                    $items[] = new ArrayItem(
                        $this->normalizeValue($itemValue)
                    );
                } else {
                    $lastKey = null;
                    $items[] = new ArrayItem(
                        $this->normalizeValue($itemValue),
                        $this->normalizeValue($itemKey)
                    );
                }
            }

            return new Expr_Array($items);
        } else {
            throw new \LogicException('Invalid value');
        }
    }

    /**
     * Sets a modifier in the $this->type property.
     *
     * @param int $modifier Modifier to set
     */
    protected function setModifier($modifier) {
        ClassStatement::verifyModifier($this->type, $modifier);
        $this->type |= $modifier;
    }
}
