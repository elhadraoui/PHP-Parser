<?php

namespace PHPParserTest\Template;

class LoaderTest extends \PHPUnit_Framework_TestCase
{
    public function testLoadWithoutSuffix() {
        $templateLoader = new PHPParser\TemplateLoader(
            new PHPParser\Parser(new PHPParser\Lexer),
            dirname(__FILE__)
        );

        // load this file as a template, as we don't really care about the contents
        $template = $templateLoader->load('TemplateLoaderTest.php');
        $this->assertInstanceOf('PHPParser\Template', $template);
    }

    public function testLoadWithSuffix() {
        $templateLoader = new PHPParser\TemplateLoader(
            new PHPParser\Parser(new PHPParser\Lexer),
            dirname(__FILE__), '.php'
        );

        // load this file as a template, as we don't really care about the contents
        $template = $templateLoader->load('TemplateLoaderTest');
        $this->assertInstanceOf('PHPParser\Template', $template);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testNonexistentBaseDirectoryError() {
        new PHPParser\TemplateLoader(
            new PHPParser\Parser(new PHPParser\Lexer),
            dirname(__FILE__) . '/someDirectoryThatDoesNotExist'
        );
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testNonexistentFileError() {
        $templateLoader = new PHPParser\TemplateLoader(
            new PHPParser\Parser(new PHPParser\Lexer),
            dirname(__FILE__)
        );

        $templateLoader->load('SomeTemplateThatDoesNotExist');
    }
}
