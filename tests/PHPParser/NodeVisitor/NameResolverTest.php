<?php

namespace PHPParserTest\NodeVisitor;

use PHPParser\Node\Stmt_Use;

use PHPParser\Node\Stmt_Trait;

use PHPParser\Node\Stmt_Namespace;

use PHPParser\Node\Scalar\String;

use PHPParser\Node\Node_Const;

use PHPParser\Node\Stmt_Class;
use PHPParser\Node\Stmt_Interface;
use PHPParser\Node\Stmt_Function;
use PHPParser\Node\Stmt_Const;

use PHPParser\Node\Traverser;

use PHPParser\Node\Visitor\NameResolver;

use PHPParser\Node\Name;

use PHPParser\Node\Expr_New;

use PHPParser\Lexer\Emulative;

use PHPParser\Parser\Parser;

class NameResolverTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PHPParser\NodeVisitor_NameResolver
     */
    public function testResolveNames() {
        $code = <<<EOC
<?php

namespace Foo {
    use Hallo as Hi;

    new Bar();
    new Hi();
    new Hi\\Bar();
    new \\Bar();
    new namespace\\Bar();

    bar();
    hi();
    Hi\\bar();
    foo\\bar();
    \\bar();
    namespace\\bar();
}
namespace {
    use Hallo as Hi;

    new Bar();
    new Hi();
    new Hi\\Bar();
    new \\Bar();
    new namespace\\Bar();

    bar();
    hi();
    Hi\\bar();
    foo\\bar();
    \\bar();
    namespace\\bar();
}
EOC;
        $expectedCode = <<<EOC
namespace Foo {
    use Hallo as Hi;
    new \\Foo\\Bar();
    new \\Hallo();
    new \\Hallo\\Bar();
    new \\Bar();
    new \\Foo\\Bar();
    bar();
    hi();
    \\Hallo\\bar();
    \\Foo\\foo\\bar();
    \\bar();
    \\Foo\\bar();
}
namespace {
    use Hallo as Hi;
    new \\Bar();
    new \\Hallo();
    new \\Hallo\\Bar();
    new \\Bar();
    new \\Bar();
    bar();
    hi();
    \\Hallo\\bar();
    \\foo\\bar();
    \\bar();
    \\bar();
}
EOC;

        $parser        = new Parser(new Emulative);
        $prettyPrinter = new PrettyPrinter_Default;
        $traverser     = new NodeTraverser;
        $traverser->addVisitor(new NodeVisitor_NameResolver);

        $stmts = $parser->parse($code);
        $stmts = $traverser->traverse($stmts);

        $this->assertEquals($expectedCode, $prettyPrinter->prettyPrint($stmts));
    }

    /**
     * @covers PHPParser\NodeVisitor_NameResolver
     */
    public function testResolveLocations() {
        $code = <<<EOC
<?php
namespace NS;

class A extends B implements C {
    use A;
}

interface A extends C {
    public function a(A \$a);
}

A::b();
A::\$b;
A::B;
new A;
\$a instanceof A;

namespace\a();
namespace\A;

try {
    \$someThing;
} catch (A \$a) {
    \$someThingElse;
}
EOC;
        $expectedCode = <<<EOC
namespace NS;

class A extends \\NS\\B implements \\NS\\C
{
    use \\NS\\A;
}
interface A extends \\NS\\C
{
    public function a(\\NS\\A \$a);
}
\\NS\\A::b();
\\NS\\A::\$b;
\\NS\\A::B;
new \\NS\\A();
\$a instanceof \\NS\\A;
\\NS\\a();
\\NS\\A;
try {
    \$someThing;
} catch (\\NS\\A \$a) {
    \$someThingElse;
}
EOC;

        $parser        = new Parser(new Emulative);
        $prettyPrinter = new PrettyPrinter_Default;
        $traverser     = new NodeTraverser;
        $traverser->addVisitor(new NodeVisitor_NameResolver);

        $stmts = $parser->parse($code);
        $stmts = $traverser->traverse($stmts);

        $this->assertEquals($expectedCode, $prettyPrinter->prettyPrint($stmts));
    }

    public function testNoResolveSpecialName() {
        $stmts = array(new Expr_New(new Name('self')));

        $traverser = new Traverser;
        $traverser->addVisitor(new NameResolver);

        $this->assertEquals($stmts, $traverser->traverse($stmts));
    }

    protected function createNamespacedAndNonNamespaced(array $stmts) {
        return array(
            new Stmt_Namespace(new Name('NS'), $stmts),
            new Stmt_Namespace(null,                          $stmts),
        );
    }

    public function testAddNamespacedName() {
        $stmts = $this->createNamespacedAndNonNamespaced(array(
            new Stmt_Class('A'),
            new Stmt_Interface('B'),
            new Stmt_Function('C'),
            new Stmt_Const(array(
                new Node_Const('D', new String('E'))
            )),
        ));

        $traverser = new Traverser;
        $traverser->addVisitor(new NameResolver);

        $stmts = $traverser->traverse($stmts);

        $this->assertEquals('NS\\A', (string) $stmts[0]->stmts[0]->namespacedName);
        $this->assertEquals('NS\\B', (string) $stmts[0]->stmts[1]->namespacedName);
        $this->assertEquals('NS\\C', (string) $stmts[0]->stmts[2]->namespacedName);
        $this->assertEquals('NS\\D', (string) $stmts[0]->stmts[3]->consts[0]->namespacedName);
        $this->assertEquals('A',     (string) $stmts[1]->stmts[0]->namespacedName);
        $this->assertEquals('B',     (string) $stmts[1]->stmts[1]->namespacedName);
        $this->assertEquals('C',     (string) $stmts[1]->stmts[2]->namespacedName);
        $this->assertEquals('D',     (string) $stmts[1]->stmts[3]->consts[0]->namespacedName);
    }

    public function testAddTraitNamespacedName() {
        $stmts = $this->createNamespacedAndNonNamespaced(array(
            new Stmt_Trait('A')
        ));

        $traverser = new Traverser;
        $traverser->addVisitor(new NameResolver);

        $stmts = $traverser->traverse($stmts);

        $this->assertEquals('NS\\A', (string) $stmts[0]->stmts[0]->namespacedName);
        $this->assertEquals('A',     (string) $stmts[1]->stmts[0]->namespacedName);
    }

    /**
     * @expectedException        PHPParser\Error
     * @expectedExceptionMessage Cannot use "C" as "B" because the name is already in use on line 2
     */
    public function testAlreadyInUseError() {
        $stmts = array(
            new Stmt_Use(array(
                new Stmt_Use(new Name('A\B'), 'B', array('startLine' => 1)),
                new Stmt_Use(new Name('C'),   'B', array('startLine' => 2)),
            ))
        );

        $traverser = new NodeTraverser;
        $traverser->addVisitor(new NodeVisitor_NameResolver);
        $traverser->traverse($stmts);
    }
}
