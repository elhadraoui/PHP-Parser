<?php

namespace PHPParser\Node\Stmt;

/**
 * @property \PHPParser\Node\Name[]                    $traits      Traits
 * @property \PHPParser\Node\Stmt_TraitUseAdaptation[] $adaptations Adaptations
 */
class TraitUse extends \PHPParser\Node\Stmt
{
    /**
     * Constructs a trait use node.
     *
     * @param \PHPParser\Node\Name[]                    $traits      Traits
     * @param \PHPParser\Node\Stmt_TraitUseAdaptation[] $adaptations Adaptations
     * @param array                                    $attributes  Additional attributes
     */
    public function __construct(array $traits, array $adaptations = array(), array $attributes = array()) {
        parent::__construct(
            array(
                'traits'      => $traits,
                'adaptations' => $adaptations,
            ),
            $attributes
        );
    }
}