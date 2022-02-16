<?php

namespace Test;

use PHPUnit\Framework\TestCase;
use Takemo101\SimpleTempla\Environment\{
    SyntaxConfig,
    DefaultEnvironmentCreator,
};
use Takemo101\SimpleTempla\Environment\Analyze\SyntaxAnalyzer;
use InvalidArgumentException;

/**
 * environment test
 */
class EnvironmentTest extends TestCase
{
    /**
     * @test
     */
    public function createSyntaxConfig__OK()
    {
        $prefix = '{{';
        $suffix = '}}';
        $filterSeparator = '|';
        $valueSeparator = '.';

        $config = new SyntaxConfig(
            $prefix,
            $suffix,
            $filterSeparator,
            $valueSeparator,
        );

        $this->assertEquals(
            $config->getBlockPair()->getBlockPrefix()->value(),
            $prefix,
        );
        $this->assertEquals(
            $config->getBlockPair()->getBlockSuffix()->value(),
            $suffix,
        );
        $this->assertEquals(
            $config->getSeparatorPair()->getFilterSeparator()->value(),
            $filterSeparator,
        );
        $this->assertEquals(
            $config->getSeparatorPair()->getValueSeparator()->value(),
            $valueSeparator,
        );
    }

    /**
     * @test
     */
    public function createSyntaxConfig__NG()
    {
        $this->expectException(InvalidArgumentException::class);

        $prefix = '|A';
        $suffix = ' }}';
        $filterSeparator = '|-';
        $valueSeparator = 'a';

        $config = new SyntaxConfig(
            $prefix,
            $suffix,
            $filterSeparator,
            $valueSeparator,
        );
    }

    /**
     * @test
     */
    public function createSyntaxAnalyzer__OK()
    {
        $config = new SyntaxConfig(
            '{{',
            '}}',
            '|',
            '.',
        );

        $analyzer = new SyntaxAnalyzer($config);

        $analyzeData = $analyzer->analyze(
            'dddd{{ a }}aaa{{ b|strtolower }}bbbb{{ c }}cccc'
        );

        $this->assertEquals(
            count($analyzeData->getReplaceBlockIterator()->iterator()),
            3,
        );

        $analyzeData = $analyzer->analyze(
            'dddd{{ a }}aaa{{ a }}bbbb{{ c.d }}cccc'
        );

        $this->assertEquals(
            count($analyzeData->getReplaceBlockIterator()->iterator()),
            2,
        );
    }

    /**
     * @test
     */
    public function createDefaultEnvironment__OK()
    {
        $env = DefaultEnvironmentCreator::create();
        $template = $env->createTemplate("
            class {{ name }} {
                const {{ data.constant|strtoupper }}
            }
        ");

        $result = $template->parse([
            'name' => 'Hello',
            'data' => [
                'constant' => 'World',
            ],
        ]);

        $this->assertTrue(strpos($result, 'class Hello') !== false);
        $this->assertTrue(strpos($result, 'const WORLD') !== false);

        $result = $template->parse([
            'name' => 'True',
            'data' => [
                'constant' => 'False',
            ],
        ]);

        $this->assertTrue(strpos($result, 'class True') !== false);
        $this->assertTrue(strpos($result, 'const FALSE') !== false);
    }
}
