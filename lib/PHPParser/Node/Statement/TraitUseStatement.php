<?php

namespace PHPParser\Node\Statement;

/**
 * @property PHPParser\Node\Name[]                    $traits      Traits
 * @property PHPParser\Node\Statement_TraitUseAdaptation[] $adaptations Adaptations
 */


class TraitUse extends Statement
{
    /**
     * Constructs a trait use node.
     *
     * @param PHPParser\Node\Name[]                    $traits      Traits
     * @param PHPParser\Node\Statement_TraitUseAdaptation[] $adaptations Adaptations
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