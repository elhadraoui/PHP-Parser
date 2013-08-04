<?php

namespace PHPParserTest;

require_once dirname(__FILE__) . '/CodeTestAbstract.php';

class ParserTest extends CodeTestAbstract
{
    /**
     * @dataProvider provideTestParse
     */
    public function testParse($name, $code, $dump) {
        $parser = new PHPParser\Parser(new PHPParser\Lexer_Emulative);
        $dumper = new PHPParser\NodeDumper;

        $stmts = $parser->parse($code);
        $this->assertEquals(
            $this->canonicalize($dump),
            $this->canonicalize($dumper->dump($stmts)),
            $name
        );
    }

    public function provideTestParse() {
        return $this->getTests(dirname(__FILE__) . '/../../code/parser', 'test');
    }

    /**
     * @dataProvider provideTestParseFail
     */
    public function testParseFail($name, $code, $msg) {
        $parser = new PHPParser\Parser(new PHPParser\Lexer_Emulative);

        try {
            $parser->parse($code);

            $this->fail(sprintf('"%s": Expected PHPParser\Error', $name));
        } catch (PHPParser\Error $e) {
            $this->assertEquals($msg, $e->getMessage(), $name);
        }
    }

    public function provideTestParseFail() {
        return $this->getTests(dirname(__FILE__) . '/../../code/parser', 'test-fail');
    }
}
