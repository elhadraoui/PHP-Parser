<?php

namespace PHPParserTest\NodeVisitor;

use PHPParser\PrettyPrinter\PrettyPrinterDefault;

use PHPParser\Node\Statement_Use;

use PHPParser\Node\Statement_Trait;

use PHPParser\Node\Statement_Namespace;

use PHPParser\Node\Scalar\String;

use PHPParser\Node\Node_Const;

use PHPParser\Node\Statement\ClassStatement;
use PHPParser\Node\Statement_Interface;
use PHPParser\Node\Statement\FunctionStatement;
use PHPParser\Node\Statement_Const;

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
        $prettyPrinter = new PrettyPrinterDefault;
        $traverser     = new Traverser;
        $traverser->addVisitor(new NameResolver);

        $Statements = $parser->parse($code);
        $Statements = $traverser->traverse($Statements);

        $this->assertEquals($expectedCode, $prettyPrinter->prettyPrint($Statements));
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
        $prettyPrinter = new PrettyPrinterDefault;
        $traverser     = new Traverser;
        $traverser->addVisitor(new NameResolver);

        $Statements = $parser->parse($code);
        $Statements = $traverser->traverse($Statements);

        $this->assertEquals($expectedCode, $prettyPrinter->prettyPrint($Statements));
    }

    public function testNoResolveSpecialName() {
        $Statements = array(new Expr_New(new Name('self')));

        $traverser = new Traverser;
        $traverser->addVisitor(new NameResolver);

        $this->assertEquals($Statements, $traverser->traverse($Statements));
    }

    protected function createNamespacedAndNonNamespaced(array $Statements) {
        return array(
            new Statement_Namespace(new Name('NS'), $Statements),
            new Statement_Namespace(null,                          $Statements),
        );
    }

    public function testAddNamespacedName() {
        $Statements = $this->createNamespacedAndNonNamespaced(array(
            new ClassStatement('A'),
            new Statement_Interface('B'),
            new FunctionStatement('C'),
            new Statement_Const(array(
                new Node_Const('D', new String('E'))
            )),
        ));

        $traverser = new Traverser;
        $traverser->addVisitor(new NameResolver);

        $Statements = $traverser->traverse($Statements);

        $this->assertEquals('NS\\A', (string) $Statements[0]->Statements[0]->namespacedName);
        $this->assertEquals('NS\\B', (string) $Statements[0]->Statements[1]->namespacedName);
        $this->assertEquals('NS\\C', (string) $Statements[0]->Statements[2]->namespacedName);
        $this->assertEquals('NS\\D', (string) $Statements[0]->Statements[3]->consts[0]->namespacedName);
        $this->assertEquals('A',     (string) $Statements[1]->Statements[0]->namespacedName);
        $this->assertEquals('B',     (string) $Statements[1]->Statements[1]->namespacedName);
        $this->assertEquals('C',     (string) $Statements[1]->Statements[2]->namespacedName);
        $this->assertEquals('D',     (string) $Statements[1]->Statements[3]->consts[0]->namespacedName);
    }

    public function testAddTraitNamespacedName() {
        $Statements = $this->createNamespacedAndNonNamespaced(array(
            new Statement_Trait('A')
        ));

        $traverser = new Traverser;
        $traverser->addVisitor(new NameResolver);

        $Statements = $traverser->traverse($Statements);

        $this->assertEquals('NS\\A', (string) $Statements[0]->Statements[0]->namespacedName);
        $this->assertEquals('A',     (string) $Statements[1]->Statements[0]->namespacedName);
    }

    /**
     * @expectedException        PHPParser\Error
     * @expectedExceptionMessage Cannot use "C" as "B" because the name is already in use on line 2
     */
    public function testAlreadyInUseError() {
        $Statements = array(
            new Statement_Use(array(
                new Statement_Use(new Name('A\B'), 'B', array('startLine' => 1)),
                new Statement_Use(new Name('C'),   'B', array('startLine' => 2)),
            ))
        );

        $traverser = new NodeTraverser;
        $traverser->addVisitor(new NodeVisitor_NameResolver);
        $traverser->traverse($Statements);
    }
}
