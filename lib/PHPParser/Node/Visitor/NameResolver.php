<?php

namespace PHPParser\Node\Visitor;

use PHPParser\Node\Node;

use PHPParser\Node\Statement_Trait;

use PHPParser\Node\VisitorAbstract;

class NameResolver extends VisitorAbstract
{
    /**
     * @var null|PHPParser\Node\Name Current namespace
     */
    protected $namespace;

    /**
     * @var array Currently defined namespace and class aliases
     */
    protected $aliases;

    public function beforeTraverse(array $nodes) {
        $this->namespace = null;
        $this->aliases   = array();
    }

    public function enterNode(Node $node) {
        if ($node instanceof Statement_Namespace) {
            $this->namespace = $node->name;
            $this->aliases   = array();
        } elseif ($node instanceof UseUse) {
            if (isset($this->aliases[$node->alias])) {
                throw new Error(
                    sprintf(
                        'Cannot use "%s" as "%s" because the name is already in use',
                        $node->name, $node->alias
                    ),
                    $node->getLine()
                );
            }

            $this->aliases[$node->alias] = $node->name;
        } elseif ($node instanceof ClassStatement) {
            if (null !== $node->extends) {
                $node->extends = $this->resolveClassName($node->extends);
            }

            foreach ($node->implements as &$interface) {
                $interface = $this->resolveClassName($interface);
            }

            $this->addNamespacedName($node);
        } elseif ($node instanceof Statement_Interface) {
            foreach ($node->extends as &$interface) {
                $interface = $this->resolveClassName($interface);
            }

            $this->addNamespacedName($node);
        } elseif ($node instanceof Statement_Trait) {
            $this->addNamespacedName($node);
        } elseif ($node instanceof FunctionStatement) {
            $this->addNamespacedName($node);
        } elseif ($node instanceof Statement_Const) {
            foreach ($node->consts as $const) {
                $this->addNamespacedName($const);
            }
        } elseif ($node instanceof StaticCall
                  || $node instanceof StaticPropertyStatementFetch
                  || $node instanceof ClassConstFetch
                  || $node instanceof Expr_New
                  || $node instanceof Expr_Instanceof
        ) {
            if ($node->class instanceof Name) {
                $node->class = $this->resolveClassName($node->class);
            }
        } elseif ($node instanceof Statement_Catch) {
            $node->type = $this->resolveClassName($node->type);
        } elseif ($node instanceof FuncCall
                  || $node instanceof ConstFetch
        ) {
            if ($node->name instanceof Name) {
                $node->name = $this->resolveOtherName($node->name);
            }
        } elseif ($node instanceof TraitUse) {
            foreach ($node->traits as &$trait) {
                $trait = $this->resolveClassName($trait);
            }
        } elseif ($node instanceof Param
                  && $node->type instanceof Name
        ) {
            $node->type = $this->resolveClassName($node->type);
        }
    }

    protected function resolveClassName(Name $name) {
        // don't resolve special class names
        if (in_array((string) $name, array('self', 'parent', 'static'))) {
            return $name;
        }

        // fully qualified names are already resolved
        if ($name->isFullyQualified()) {
            return $name;
        }

        // resolve aliases (for non-relative names)
        if (!$name->isRelative() && isset($this->aliases[$name->getFirst()])) {
            $name->setFirst($this->aliases[$name->getFirst()]);
        // if no alias exists prepend current namespace
        } elseif (null !== $this->namespace) {
            $name->prepend($this->namespace);
        }

        return new Name_FullyQualified($name->parts, $name->getAttributes());
    }

    protected function resolveOtherName(Name $name) {
        // fully qualified names are already resolved and we can't do anything about unqualified
        // ones at compiler-time
        if ($name->isFullyQualified() || $name->isUnqualified()) {
            return $name;
        }

        // resolve aliases for qualified names
        if ($name->isQualified() && isset($this->aliases[$name->getFirst()])) {
            $name->setFirst($this->aliases[$name->getFirst()]);
        // prepend namespace for relative names
        } elseif (null !== $this->namespace) {
            $name->prepend($this->namespace);
        }

        return new FullyQualified($name->parts, $name->getAttributes());
    }

    protected function addNamespacedName(Node $node) {
        if (null !== $this->namespace) {
            $node->namespacedName = clone $this->namespace;
            $node->namespacedName->append($node->name);
        } else {
            $node->namespacedName = new Name($node->name, $node->getAttributes());
        }
    }
}