<?php

namespace PHPParser\PrettyPrinter;

use PHPParser\Node\Node_Const;

class PrettyPrinterDefault extends PrettyPrinterAbstract
{
    // Special nodes

    public function pParam(PHPParser\Node\Param $node) {
        return ($node->type ? (is_string($node->type) ? $node->type : $this->p($node->type)) . ' ' : '')
             . ($node->byRef ? '&' : '')
             . '$' . $node->name
             . ($node->default ? ' = ' . $this->p($node->default) : '');
    }

    public function pArg(PHPParser\Node\Arg $node) {
        return ($node->byRef ? '&' : '') . $this->p($node->value);
    }

    public function pConst(Node_Const $node) {
        return $node->name . ' = ' . $this->p($node->value);
    }

    // Names

    public function pName(PHPParser\Node\Name $node) {
        return implode('\\', $node->parts);
    }

    public function pName_FullyQualified(PHPParser\Node\Name_FullyQualified $node) {
        return '\\' . implode('\\', $node->parts);
    }

    public function pName_Relative(PHPParser\Node\Name_Relative $node) {
        return 'namespace\\' . implode('\\', $node->parts);
    }

    // Magic Constants

    public function pScalar_ClassConst(ClassConst $node) {
        return '__CLASS__';
    }

    public function pScalar_TraitConst(TraitConst $node) {
        return '__TRAIT__';
    }

    public function pScalar_DirConst(DirConst $node) {
        return '__DIR__';
    }

    public function pScalar_FileConst(FileConst $node) {
        return '__FILE__';
    }

    public function pScalar_FuncConst(FuncConst $node) {
        return '__FUNCTION__';
    }

    public function pScalar_LineConst(LineConst $node) {
        return '__LINE__';
    }

    public function pScalar_MethodConst(MethodConst $node) {
        return '__METHOD__';
    }

    public function pScalar_NSConst(NSConst $node) {
        return '__NAMESPACE__';
    }

    // Scalars

    public function pScalar_String(String $node) {
        return '\'' . $this->pNoIndent(addcslashes($node->value, '\'\\')) . '\'';
    }

    public function pScalar_Encapsed(Encapsed $node) {
        return '"' . $this->pEncapsList($node->parts, '"') . '"';
    }

    public function pScalar_LNumber(LNumber $node) {
        return (string) $node->value;
    }

    public function pScalar_DNumber(DNumber $node) {
        $stringValue = (string) $node->value;

        // ensure that number is really printed as float
        return ctype_digit($stringValue) ? $stringValue . '.0' : $stringValue;
    }

    // Assignments

    public function pExpr_Assign(Assign $node) {
        return $this->pInfixOp('Expr_Assign', $node->var, ' = ', $node->expr);
    }

    public function pExpr_AssignRef(AssignRef $node) {
        return $this->pInfixOp('Expr_AssignRef', $node->var, ' =& ', $node->expr);
    }

    public function pExpr_AssignPlus(AssignPlus $node) {
        return $this->pInfixOp('Expr_AssignPlus', $node->var, ' += ', $node->expr);
    }

    public function pExpr_AssignMinus(AssignMinus $node) {
        return $this->pInfixOp('Expr_AssignMinus', $node->var, ' -= ', $node->expr);
    }

    public function pExpr_AssignMul(AssignMul $node) {
        return $this->pInfixOp('Expr_AssignMul', $node->var, ' *= ', $node->expr);
    }

    public function pExpr_AssignDiv(AssignDiv $node) {
        return $this->pInfixOp('Expr_AssignDiv', $node->var, ' /= ', $node->expr);
    }

    public function pExpr_AssignConcat(AssignConcat $node) {
        return $this->pInfixOp('Expr_AssignConcat', $node->var, ' .= ', $node->expr);
    }

    public function pExpr_AssignMod(AssignMod $node) {
        return $this->pInfixOp('Expr_AssignMod', $node->var, ' %= ', $node->expr);
    }

    public function pExpr_AssignBitwiseAnd(AssignBitwiseAnd $node) {
        return $this->pInfixOp('Expr_AssignBitwiseAnd', $node->var, ' &= ', $node->expr);
    }

    public function pExpr_AssignBitwiseOr(AssignBitwiseOr $node) {
        return $this->pInfixOp('Expr_AssignBitwiseOr', $node->var, ' |= ', $node->expr);
    }

    public function pExpr_AssignBitwiseXor(AssignBitwiseXor $node) {
        return $this->pInfixOp('Expr_AssignBitwiseXor', $node->var, ' ^= ', $node->expr);
    }

    public function pExpr_AssignShiftLeft(AssignShiftLeft $node) {
        return $this->pInfixOp('Expr_AssignShiftLeft', $node->var, ' <<= ', $node->expr);
    }

    public function pExpr_AssignShiftRight(AssignShiftRight $node) {
        return $this->pInfixOp('Expr_AssignShiftRight', $node->var, ' >>= ', $node->expr);
    }

    // Binary expressions

    public function pExpr_Plus(Plus $node) {
        return $this->pInfixOp('Expr_Plus', $node->left, ' + ', $node->right);
    }

    public function pExpr_Minus(Minus $node) {
        return $this->pInfixOp('Expr_Minus', $node->left, ' - ', $node->right);
    }

    public function pExpr_Mul(Mul $node) {
        return $this->pInfixOp('Expr_Mul', $node->left, ' * ', $node->right);
    }

    public function pExpr_Div(Div $node) {
        return $this->pInfixOp('Expr_Div', $node->left, ' / ', $node->right);
    }

    public function pExpr_Concat(Concat $node) {
        return $this->pInfixOp('Expr_Concat', $node->left, ' . ', $node->right);
    }

    public function pExpr_Mod(Mod $node) {
        return $this->pInfixOp('Expr_Mod', $node->left, ' % ', $node->right);
    }

    public function pExpr_BooleanAnd(BooleanAnd $node) {
        return $this->pInfixOp('Expr_BooleanAnd', $node->left, ' && ', $node->right);
    }

    public function pExpr_BooleanOr(BooleanOr $node) {
        return $this->pInfixOp('Expr_BooleanOr', $node->left, ' || ', $node->right);
    }

    public function pExpr_BitwiseAnd(BitwiseAnd $node) {
        return $this->pInfixOp('Expr_BitwiseAnd', $node->left, ' & ', $node->right);
    }

    public function pExpr_BitwiseOr(BitwiseOr $node) {
        return $this->pInfixOp('Expr_BitwiseOr', $node->left, ' | ', $node->right);
    }

    public function pExpr_BitwiseXor(BitwiseXor $node) {
        return $this->pInfixOp('Expr_BitwiseXor', $node->left, ' ^ ', $node->right);
    }

    public function pExpr_ShiftLeft(ShiftLeft $node) {
        return $this->pInfixOp('Expr_ShiftLeft', $node->left, ' << ', $node->right);
    }

    public function pExpr_ShiftRight(ShiftRight $node) {
        return $this->pInfixOp('Expr_ShiftRight', $node->left, ' >> ', $node->right);
    }

    public function pExpr_LogicalAnd(LogicalAnd $node) {
        return $this->pInfixOp('Expr_LogicalAnd', $node->left, ' and ', $node->right);
    }

    public function pExpr_LogicalOr(LogicalOr $node) {
        return $this->pInfixOp('Expr_LogicalOr', $node->left, ' or ', $node->right);
    }

    public function pExpr_LogicalXor(LogicalXor $node) {
        return $this->pInfixOp('Expr_LogicalXor', $node->left, ' xor ', $node->right);
    }

    public function pExpr_Equal(Equal $node) {
        return $this->pInfixOp('Expr_Equal', $node->left, ' == ', $node->right);
    }

    public function pExpr_NotEqual(NotEqual $node) {
        return $this->pInfixOp('Expr_NotEqual', $node->left, ' != ', $node->right);
    }

    public function pExpr_Identical(Identical $node) {
        return $this->pInfixOp('Expr_Identical', $node->left, ' === ', $node->right);
    }

    public function pExpr_NotIdentical(NotIdentical $node) {
        return $this->pInfixOp('Expr_NotIdentical', $node->left, ' !== ', $node->right);
    }

    public function pExpr_Greater(Greater $node) {
        return $this->pInfixOp('Expr_Greater', $node->left, ' > ', $node->right);
    }

    public function pExpr_GreaterOrEqual(GreaterOrEqual $node) {
        return $this->pInfixOp('Expr_GreaterOrEqual', $node->left, ' >= ', $node->right);
    }

    public function pExpr_Smaller(Smaller $node) {
        return $this->pInfixOp('Expr_Smaller', $node->left, ' < ', $node->right);
    }

    public function pExpr_SmallerOrEqual(SmallerOrEqual $node) {
        return $this->pInfixOp('Expr_SmallerOrEqual', $node->left, ' <= ', $node->right);
    }

    public function pExpr_Instanceof(Expr_Instanceof $node) {
        return $this->pInfixOp('Expr_Instanceof', $node->expr, ' instanceof ', $node->class);
    }

    // Unary expressions

    public function pExpr_BooleanNot(BooleanNot $node) {
        return $this->pPrefixOp('Expr_BooleanNot', '!', $node->expr);
    }

    public function pExpr_BitwiseNot(BitwiseNot $node) {
        return $this->pPrefixOp('Expr_BitwiseNot', '~', $node->expr);
    }

    public function pExpr_UnaryMinus(UnaryMinus $node) {
        return $this->pPrefixOp('Expr_UnaryMinus', '-', $node->expr);
    }

    public function pExpr_UnaryPlus(UnaryPlus $node) {
        return $this->pPrefixOp('Expr_UnaryPlus', '+', $node->expr);
    }

    public function pExpr_PreInc(PreInc $node) {
        return $this->pPrefixOp('Expr_PreInc', '++', $node->var);
    }

    public function pExpr_PreDec(PreDec $node) {
        return $this->pPrefixOp('Expr_PreDec', '--', $node->var);
    }

    public function pExpr_PostInc(PostInc $node) {
        return $this->pPostfixOp('Expr_PostInc', $node->var, '++');
    }

    public function pExpr_PostDec(PostDec $node) {
        return $this->pPostfixOp('Expr_PostDec', $node->var, '--');
    }

    public function pExpr_ErrorSuppress(ErrorSuppress $node) {
        return $this->pPrefixOp('Expr_ErrorSuppress', '@', $node->expr);
    }

    // Casts

    public function pExpr_Cast_Int(Cast_Int $node) {
        return $this->pPrefixOp('Expr_Cast_Int', '(int) ', $node->expr);
    }

    public function pExpr_Cast_Double(Cast_Double $node) {
        return $this->pPrefixOp('Expr_Cast_Double', '(double) ', $node->expr);
    }

    public function pExpr_Cast_String(Cast_String $node) {
        return $this->pPrefixOp('Expr_Cast_String', '(string) ', $node->expr);
    }

    public function pExpr_Cast_Array(Cast_Array $node) {
        return $this->pPrefixOp('Expr_Cast_Array', '(array) ', $node->expr);
    }

    public function pExpr_Cast_Object(Cast_Object $node) {
        return $this->pPrefixOp('Expr_Cast_Object', '(object) ', $node->expr);
    }

    public function pExpr_Cast_Bool(Cast_Bool $node) {
        return $this->pPrefixOp('Expr_Cast_Bool', '(bool) ', $node->expr);
    }

    public function pExpr_Cast_Unset(Cast_Unset $node) {
        return $this->pPrefixOp('Expr_Cast_Unset', '(unset) ', $node->expr);
    }

    // Function calls and similar constructs

    public function pExpr_FuncCall(FuncCall $node) {
        return $this->p($node->name) . '(' . $this->pCommaSeparated($node->args) . ')';
    }

    public function pExpr_MethodCall(MethodCall $node) {
        return $this->pVarOrNewExpr($node->var) . '->' . $this->pObjectPropertyStatement($node->name)
             . '(' . $this->pCommaSeparated($node->args) . ')';
    }

    public function pExpr_StaticCall(StaticCall $node) {
        return $this->p($node->class) . '::'
             . ($node->name instanceof PHPParser\Node\Expr
                ? ($node->name instanceof Variable
                   || $node->name instanceof Expr_ArrayDimFetch
                   ? $this->p($node->name)
                   : '{' . $this->p($node->name) . '}')
                : $node->name)
             . '(' . $this->pCommaSeparated($node->args) . ')';
    }

    public function pExpr_Empty(Expr_Empty $node) {
        return 'empty(' . $this->p($node->expr) . ')';
    }

    public function pExpr_Isset(Expr_Isset $node) {
        return 'isset(' . $this->pCommaSeparated($node->vars) . ')';
    }

    public function pExpr_Print(Expr_Print $node) {
        return 'print ' . $this->p($node->expr);
    }

    public function pExpr_Eval(Expr_Eval $node) {
        return 'eval(' . $this->p($node->expr) . ')';
    }

    public function pExpr_Include(Expr_Include $node) {
        static $map = array(
            Expr_Include::TYPE_INCLUDE      => 'include',
            Expr_Include::TYPE_INCLUDE_ONCE => 'include_once',
            Expr_Include::TYPE_REQUIRE      => 'require',
            Expr_Include::TYPE_REQUIRE_ONCE => 'require_once',
        );

        return $map[$node->type] . ' ' . $this->p($node->expr);
    }

    public function pExpr_List(Expr_List $node) {
        $pList = array();
        foreach ($node->vars as $var) {
            if (null === $var) {
                $pList[] = '';
            } else {
                $pList[] = $this->p($var);
            }
        }

        return 'list(' . implode(', ', $pList) . ')';
    }

    // Other

    public function pExpr_Variable(Variable $node) {
        if ($node->name instanceof PHPParser\Node\Expr) {
            return '${' . $this->p($node->name) . '}';
        } else {
            return '$' . $node->name;
        }
    }

    public function pExpr_Array(Expr_Array $node) {
        return 'array(' . $this->pCommaSeparated($node->items) . ')';
    }

    public function pExpr_ArrayItem(Expr_ArrayItem $node) {
        return (null !== $node->key ? $this->p($node->key) . ' => ' : '')
             . ($node->byRef ? '&' : '') . $this->p($node->value);
    }

    public function pExpr_ArrayDimFetch(Expr_ArrayDimFetch $node) {
        return $this->pVarOrNewExpr($node->var)
             . '[' . (null !== $node->dim ? $this->p($node->dim) : '') . ']';
    }

    public function pExpr_ConstFetch(ConstFetch $node) {
        return $this->p($node->name);
    }

    public function pExpr_ClassConstFetch(ClassConstFetch $node) {
        return $this->p($node->class) . '::' . $node->name;
    }

    public function pExpr_PropertyStatementFetch(PropertyStatementFetch $node) {
        return $this->pVarOrNewExpr($node->var) . '->' . $this->pObjectPropertyStatement($node->name);
    }

    public function pExpr_StaticPropertyStatementFetch(StaticPropertyStatementFetch $node) {
        return $this->p($node->class) . '::$' . $this->pObjectPropertyStatement($node->name);
    }

    public function pExpr_ShellExec(ShellExec $node) {
        return '`' . $this->pEncapsList($node->parts, '`') . '`';
    }

    public function pExpr_Closure(Closure $node) {
        return ($node->static ? 'static ' : '')
             . 'function ' . ($node->byRef ? '&' : '')
             . '(' . $this->pCommaSeparated($node->params) . ')'
             . (!empty($node->uses) ? ' use(' . $this->pCommaSeparated($node->uses) . ')': '')
             . ' {' . "\n" . $this->pStatements($node->Statements) . "\n" . '}';
    }

    public function pExpr_ClosureUse(ClosureUse $node) {
        return ($node->byRef ? '&' : '') . '$' . $node->var;
    }

    public function pExpr_New(Expr_New $node) {
        return 'new ' . $this->p($node->class) . '(' . $this->pCommaSeparated($node->args) . ')';
    }

    public function pExpr_Clone(Expr_Clone $node) {
        return 'clone ' . $this->p($node->expr);
    }

    public function pExpr_Ternary(Ternary $node) {
        // a bit of cheating: we treat the ternary as a binary op where the ?...: part is the operator.
        // this is okay because the part between ? and : never needs parentheses.
        return $this->pInfixOp('Expr_Ternary',
            $node->cond, ' ?' . (null !== $node->if ? ' ' . $this->p($node->if) . ' ' : '') . ': ', $node->else
        );
    }

    public function pExpr_Exit(Expr_Exit $node) {
        return 'die' . (null !== $node->expr ? '(' . $this->p($node->expr) . ')' : '');
    }

    public function pExpr_Yield(Yield $node) {
        if ($node->value === null) {
            return 'yield';
        } else {
            // this is a bit ugly, but currently there is no way to detect whether the parentheses are necessary
            return '(yield '
                 . ($node->key !== null ? $this->p($node->key) . ' => ' : '')
                 . $this->p($node->value)
                 . ')';
        }
    }

    // Declarations

    public function pStatement_Namespace(PHPParser\Node\Statement_Namespace $node) {
        if ($this->canUseSemicolonNamespaces) {
            return 'namespace ' . $this->p($node->name) . ';' . "\n\n" . $this->pStatements($node->Statements, false);
        } else {
            return 'namespace' . (null !== $node->name ? ' ' . $this->p($node->name) : '')
                 . ' {' . "\n" . $this->pStatements($node->Statements) . "\n" . '}';
        }
    }

    public function pStatement_Use(PHPParser\Node\Statement_Use $node) {
        return 'use ' . $this->pCommaSeparated($node->uses) . ';';
    }

    public function pStatement_UseUse(PHPParser\Node\Statement_UseUse $node) {
        return $this->p($node->name)
             . ($node->name->getLast() !== $node->alias ? ' as ' . $node->alias : '');
    }

    public function pStatement_Interface(PHPParser\Node\Statement_Interface $node) {
        return 'interface ' . $node->name
             . (!empty($node->extends) ? ' extends ' . $this->pCommaSeparated($node->extends) : '')
             . "\n" . '{' . "\n" . $this->pStatements($node->Statements) . "\n" . '}';
    }

    public function pClassStatement(PHPParser\Node\Statement\ClassStatement $node) {
        return $this->pModifiers($node->type)
             . 'class ' . $node->name
             . (null !== $node->extends ? ' extends ' . $this->p($node->extends) : '')
             . (!empty($node->implements) ? ' implements ' . $this->pCommaSeparated($node->implements) : '')
             . "\n" . '{' . "\n" . $this->pStatements($node->Statements) . "\n" . '}';
    }

    public function pStatement_Trait(PHPParser\Node\Statement_Trait $node) {
        return 'trait ' . $node->name
             . "\n" . '{' . "\n" . $this->pStatements($node->Statements) . "\n" . '}';
    }

    public function pStatement_TraitUse(PHPParser\Node\Statement_TraitUse $node) {
        return 'use ' . $this->pCommaSeparated($node->traits)
             . (empty($node->adaptations)
                ? ';'
                : ' {' . "\n" . $this->pStatements($node->adaptations) . "\n" . '}');
    }

    public function pStatement_TraitUseAdaptation_Precedence(PHPParser\Node\Statement_TraitUseAdaptation_Precedence $node) {
        return $this->p($node->trait) . '::' . $node->method
             . ' insteadof ' . $this->pCommaSeparated($node->insteadof) . ';';
    }

    public function pStatement_TraitUseAdaptation_Alias(PHPParser\Node\Statement_TraitUseAdaptation_Alias $node) {
        return (null !== $node->trait ? $this->p($node->trait) . '::' : '')
             . $node->method . ' as'
             . (null !== $node->newModifier ? ' ' . $this->pModifiers($node->newModifier) : '')
             . (null !== $node->newName     ? ' ' . $node->newName                        : '')
             . ';';
    }

    public function pStatement_PropertyStatement(PHPParser\Node\Statement_PropertyStatement $node) {
        return $this->pModifiers($node->type) . $this->pCommaSeparated($node->props) . ';';
    }

    public function pStatement_PropertyStatement(PHPParser\Node\Statement_PropertyStatement $node) {
        return '$' . $node->name
             . (null !== $node->default ? ' = ' . $this->p($node->default) : '');
    }

    public function pClassStatementMethod(PHPParser\Node\Statement\ClassStatementMethod $node) {
        return $this->pModifiers($node->type)
             . 'function ' . ($node->byRef ? '&' : '') . $node->name
             . '(' . $this->pCommaSeparated($node->params) . ')'
             . (null !== $node->Statements
                ? "\n" . '{' . "\n" . $this->pStatements($node->Statements) . "\n" . '}'
                : ';');
    }

    public function pClassStatementConst(PHPParser\Node\Statement\ClassStatementConst $node) {
        return 'const ' . $this->pCommaSeparated($node->consts) . ';';
    }

    public function pFunctionStatement(PHPParser\Node\Statement\FunctionStatement $node) {
        return 'function ' . ($node->byRef ? '&' : '') . $node->name
             . '(' . $this->pCommaSeparated($node->params) . ')'
             . "\n" . '{' . "\n" . $this->pStatements($node->Statements) . "\n" . '}';
    }

    public function pStatement_Const(PHPParser\Node\Statement_Const $node) {
        return 'const ' . $this->pCommaSeparated($node->consts) . ';';
    }

    public function pStatement_Declare(PHPParser\Node\Statement_Declare $node) {
        return 'declare (' . $this->pCommaSeparated($node->declares) . ') {'
             . "\n" . $this->pStatements($node->Statements) . "\n" . '}';
    }

    public function pStatement_DeclareDeclare(PHPParser\Node\Statement_DeclareDeclare $node) {
        return $node->key . ' = ' . $this->p($node->value);
    }

    // Control flow

    public function pStatement_If(PHPParser\Node\Statement_If $node) {
        return 'if (' . $this->p($node->cond) . ') {'
             . "\n" . $this->pStatements($node->Statements) . "\n" . '}'
             . $this->pImplode($node->elseifs)
             . (null !== $node->else ? $this->p($node->else) : '');
    }

    public function pStatement_Elseif(PHPParser\Node\Statement_Elseif $node) {
        return ' elseif (' . $this->p($node->cond) . ') {'
             . "\n" . $this->pStatements($node->Statements) . "\n" . '}';
    }

    public function pStatement_Else(PHPParser\Node\Statement_Else $node) {
        return ' else {' . "\n" . $this->pStatements($node->Statements) . "\n" . '}';
    }

    public function pStatement_For(PHPParser\Node\Statement_For $node) {
        return 'for ('
             . $this->pCommaSeparated($node->init) . ';' . (!empty($node->cond) ? ' ' : '')
             . $this->pCommaSeparated($node->cond) . ';' . (!empty($node->loop) ? ' ' : '')
             . $this->pCommaSeparated($node->loop)
             . ') {' . "\n" . $this->pStatements($node->Statements) . "\n" . '}';
    }

    public function pStatement_Foreach(PHPParser\Node\Statement_Foreach $node) {
        return 'foreach (' . $this->p($node->expr) . ' as '
             . (null !== $node->keyVar ? $this->p($node->keyVar) . ' => ' : '')
             . ($node->byRef ? '&' : '') . $this->p($node->valueVar) . ') {'
             . "\n" . $this->pStatements($node->Statements) . "\n" . '}';
    }

    public function pStatement_While(PHPParser\Node\Statement_While $node) {
        return 'while (' . $this->p($node->cond) . ') {'
             . "\n" . $this->pStatements($node->Statements) . "\n" . '}';
    }

    public function pStatement_Do(PHPParser\Node\Statement_Do $node) {
        return 'do {' . "\n" . $this->pStatements($node->Statements) . "\n"
             . '} while (' . $this->p($node->cond) . ');';
    }

    public function pStatement_Switch(PHPParser\Node\Statement_Switch $node) {
        return 'switch (' . $this->p($node->cond) . ') {'
             . "\n" . $this->pStatements($node->cases) . "\n" . '}';
    }

    public function pStatement_Case(PHPParser\Node\Statement_Case $node) {
        return (null !== $node->cond ? 'case ' . $this->p($node->cond) : 'default') . ':'
             . ($node->Statements ? "\n" . $this->pStatements($node->Statements) : '');
    }

    public function pStatement_TryCatch(PHPParser\Node\Statement_TryCatch $node) {
        return 'try {' . "\n" . $this->pStatements($node->Statements) . "\n" . '}'
             . $this->pImplode($node->catches)
             . ($node->finallyStatements !== null
                ? ' finally {' . "\n" . $this->pStatements($node->finallyStatements) . "\n" . '}'
                : '');
    }

    public function pStatement_Catch(PHPParser\Node\Statement_Catch $node) {
        return ' catch (' . $this->p($node->type) . ' $' . $node->var . ') {'
             . "\n" . $this->pStatements($node->Statements) . "\n" . '}';
    }

    public function pStatement_Break(PHPParser\Node\Statement_Break $node) {
        return 'break' . ($node->num !== null ? ' ' . $this->p($node->num) : '') . ';';
    }

    public function pStatement_Continue(PHPParser\Node\Statement_Continue $node) {
        return 'continue' . ($node->num !== null ? ' ' . $this->p($node->num) : '') . ';';
    }

    public function pStatement_Return(PHPParser\Node\Statement_Return $node) {
        return 'return' . (null !== $node->expr ? ' ' . $this->p($node->expr) : '') . ';';
    }

    public function pStatement_Throw(PHPParser\Node\Statement_Throw $node) {
        return 'throw ' . $this->p($node->expr) . ';';
    }

    public function pStatement_Label(PHPParser\Node\Statement_Label $node) {
        return $node->name . ':';
    }

    public function pStatement_Goto(PHPParser\Node\Statement_Goto $node) {
        return 'goto ' . $node->name . ';';
    }

    // Other

    public function pEchoStatement(PHPParser\Node\Statement\EchoStatement $node) {
        return 'echo ' . $this->pCommaSeparated($node->exprs) . ';';
    }

    public function pStatement_Static(PHPParser\Node\Statement_Static $node) {
        return 'static ' . $this->pCommaSeparated($node->vars) . ';';
    }

    public function pStatement_Global(PHPParser\Node\Statement_Global $node) {
        return 'global ' . $this->pCommaSeparated($node->vars) . ';';
    }

    public function pStatement_StaticVar(PHPParser\Node\Statement_StaticVar $node) {
        return '$' . $node->name
             . (null !== $node->default ? ' = ' . $this->p($node->default) : '');
    }

    public function pStatement_Unset(PHPParser\Node\Statement_Unset $node) {
        return 'unset(' . $this->pCommaSeparated($node->vars) . ');';
    }

    public function pStatement_InlineHTML(PHPParser\Node\Statement_InlineHTML $node) {
        return '?>' . $this->pNoIndent("\n" . $node->value) . '<?php ';
    }

    public function pStatement_HaltCompiler(PHPParser\Node\Statement_HaltCompiler $node) {
        return '__halt_compiler();' . $node->remaining;
    }

    // Helpers

    public function pObjectPropertyStatement($node) {
        if ($node instanceof PHPParser\Node\Expr) {
            return '{' . $this->p($node) . '}';
        } else {
            return $node;
        }
    }

    public function pModifiers($modifiers) {
        return ($modifiers & PHPParser\Node\Statement\ClassStatement::MODIFIER_PUBLIC    ? 'public '    : '')
             . ($modifiers & PHPParser\Node\Statement\ClassStatement::MODIFIER_PROTECTED ? 'protected ' : '')
             . ($modifiers & PHPParser\Node\Statement\ClassStatement::MODIFIER_PRIVATE   ? 'private '   : '')
             . ($modifiers & PHPParser\Node\Statement\ClassStatement::MODIFIER_STATIC    ? 'static '    : '')
             . ($modifiers & PHPParser\Node\Statement\ClassStatement::MODIFIER_ABSTRACT  ? 'abstract '  : '')
             . ($modifiers & PHPParser\Node\Statement\ClassStatement::MODIFIER_FINAL     ? 'final '     : '');
    }

    public function pEncapsList(array $encapsList, $quote) {
        $return = '';
        foreach ($encapsList as $element) {
            if (is_string($element)) {
                $return .= addcslashes($element, "\n\r\t\f\v$" . $quote . "\\");
            } else {
                $return .= '{' . $this->p($element) . '}';
            }
        }

        return $return;
    }

    public function pVarOrNewExpr(PHPParser\Node $node) {
        if ($node instanceof Expr_New) {
            return '(' . $this->p($node) . ')';
        } else {
            return $this->p($node);
        }
    }
}