<?php

namespace PHPParser\Node\Stmt;

use PHPParser\Node\Stmt;

/**
 * @property PHPParser\Node\Const[] $consts Constant declarations
 */
class ClassConst extends Stmt
{
    /**
     * Constructs a class const list node.
     *
     * @param PHPParser\Node\Const[] $consts     Constant declarations
     * @param array                  $attributes Additional attributes
     */
    public function __construct(array $consts, array $attributes = array()) {
        parent::__construct(
            array(
                'consts' => $consts,
            ),
            $attributes
        );
    }
}