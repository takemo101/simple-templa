<?php

namespace Test;

use PHPUnit\Framework\TestCase;
use Takemo101\SimpleTempla\Environment\DefaultEnvironmentCreator;

/**
 * template test
 */
class TemplateTest extends TestCase
{
    /**
     * @test
     */
    public function createTemplate__OK()
    {
        // create Environment object
        $environment = DefaultEnvironmentCreator::create();

        // template text
        $text = "
            Hello, i like {{ data.language|strtoupper }}.
            PHP is {{ data.php_is.simple|strtolower }} and {{ data.php_is.nice|strtolower }}.
            {{ data.thank_you.thank|ucfirst }} {{ data.thank_you.you }}
        ";

        // create template object from text
        $template = $environment->createTemplate($text);

        $result = $template->parse([
            'data' => [
                'language' => 'php',
                'php_is' => [
                    'simple' => 'SIMPLE',
                    'nice' => 'NICE',
                ],
                'thank_you' => [
                    'thank' => 'thank',
                    'you' => 'you',
                ],
            ],
        ]);

        $this->assertTrue(strpos($result, 'PHP') !== false);
        $this->assertTrue(strpos($result, 'simple and nice') !== false);
        $this->assertTrue(strpos($result, 'Thank you') !== false);
    }

    /**
     * @test
     */
    public function addFilter__OK()
    {
        $filterText = 'T_E_S_T';

        // create Environment object
        $environment = DefaultEnvironmentCreator::create();

        // template text
        $text = "{{ test|test }}";

        // create template object from text
        $template = $environment->createTemplate($text);

        // add filter
        $template->addFilter();

        $result = $template->parse(['test' => 'test']);

        $this->assertEquals($result, $filterText);
    }
}
