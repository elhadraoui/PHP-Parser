<?php

namespace PHPParserTest;

use PHPParser\Lexer\Lexer;

use PHPParser\Parser\Parser;

class TemplateTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provideTestPlaceholderReplacement
     * @covers PHPParser\Template
     */
    public function testPlaceholderReplacement($templateCode, $placeholders, $expectedPrettyPrint) {
        $parser = new Parser(new Lexer);
        $prettyPrinter = new PrettyPrinter_Default;

        $template = new Template($parser, $templateCode);
        $this->assertEquals(
            $expectedPrettyPrint,
            $prettyPrinter->prettyPrint($template->getStmts($placeholders))
        );
    }

    public function provideTestPlaceholderReplacement() {
        return array(
            array(
                '<?php $__name__ + $__Name__;',
                array('name' => 'foo'),
                '$foo + $Foo;'
            ),
            array(
                '<?php $__name__ + $__Name__;',
                array('Name' => 'Foo'),
                '$foo + $Foo;'
            ),
            array(
                '<?php $__name__ + $__Name__;',
                array('name' => 'foo', 'Name' => 'Bar'),
                '$foo + $Bar;'
            ),
            array(
                '<?php $__name__ + $__Name__;',
                array('Name' => 'Bar', 'name' => 'foo'),
                '$foo + $Bar;'
            ),
            array(
                '<?php $prefix__Name__Suffix;',
                array('name' => 'infix'),
                '$prefixInfixSuffix;'
            ),
            array(
                '<?php $___name___;',
                array('name' => 'foo'),
                '$_foo_;'
            ),
            array(
                '<?php $foobar;',
                array(),
                '$foobar;'
            ),
        );
    }
}
