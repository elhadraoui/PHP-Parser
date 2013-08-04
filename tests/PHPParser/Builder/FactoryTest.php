<?php

namespace PHPParserTest\Builder;

use PHPParser\Builder\Factory;

class FactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provideTestFactory
     */
    public function testFactory($methodName, $className) {
        $factory = new Factory;
        $this->assertInstanceOf($className, $factory->$methodName('test'));
    }

    public function provideTestFactory() {
        return array(
            array('class',     'PHPParser\Builder_Class'),
            array('interface', 'PHPParser\Builder_Interface'),
            array('method',    'PHPParser\Builder_Method'),
            array('function',  'PHPParser\Builder_Function'),
            array('property',  'PHPParser\Builder_Property'),
            array('param',     'PHPParser\Builder_Param'),
        );
    }
}
