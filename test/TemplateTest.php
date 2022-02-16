<?php

namespace Test;

use PHPUnit\Framework\TestCase;
use Takemo101\SimpleTempla\Environment\DefaultEnvironmentCreator;
use Takemo101\SimpleTempla\Filter\{
    FilterProcessInterface,
    FilterName,
    Filter,
};
use Takemo101\SimpleTempla\Template\{
    TemplateValueCollection,
    StringTransformerInterface,
    StringTransformer,
    ValueName,
};

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
            PHP is {{ data.php_is.simple|strtolower|ucfirst }} and {{ data.php_is.nice|strtolower }}.
            {{ data.thank_you.thank|ucfirst }} {{ data.thank_you.you }}

            {{ data }}
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
        $this->assertTrue(strpos($result, 'Simple and nice') !== false);
        $this->assertTrue(strpos($result, 'Thank you') !== false);
    }

    /**
     * @test
     */
    public function addTemplateFilter__OK()
    {
        $filterText = 'T_E_S_T';

        // create Environment object
        $environment = DefaultEnvironmentCreator::create();

        // template text
        $text = "{{ test|test_filter }}";

        // create template object from text
        $template = $environment->createTemplate($text);

        // add filter
        $template->addFilter(new Filter(
            new FilterName('test_filter'),
            new TestFilter($filterText),
        ));

        $result = $template->parse(['test' => 'test']);

        $this->assertEquals($result, $filterText);
    }

    /**
     * @test
     */
    public function setTemplateStringTransformer__OK()
    {
        $testData = [
            'a' => 'b',
        ];

        // create Environment object
        $environment = DefaultEnvironmentCreator::create();

        // template text
        $text = "{{ array }}";

        // create template object from text
        $template = $environment->createTemplate($text);

        // add filter
        $template->setStringTransformer(new TestStringTransformer);

        $result = $template->parse(['array' => $testData]);

        $this->assertEquals($result, json_encode($testData));
    }

    /**
     * @test
     */
    public function createStringTransformer__OK()
    {
        $transformer = new StringTransformer;
        $boolean = $transformer->transform(true);
        $array = $transformer->transform([]);
        $object = $transformer->transform(new class
        {
            public $a = 'a';
            public function __toString()
            {
                return 'object';
            }
        });

        $this->assertEquals($boolean, 'true');
        $this->assertEquals($array, '[]');
        $this->assertEquals($object, 'object');
    }

    /**
     * @test
     */
    public function createTemplateValueCollection__OK()
    {
        $data = 'hello';

        $collection = new TemplateValueCollection([
            'data' => $data,
        ]);

        $result = $collection->findByValueNames([new ValueName('data')]);

        $this->assertEquals($result, $data);
    }
}

/**
 * create test filter class
 */
final class TestFilter implements FilterProcessInterface
{
    public function __construct(
        private string $replaceText,
    ) {
        //
    }

    // processing that returns only a specific character string
    public function execute(string $value): string
    {
        return $this->replaceText;
    }
}

/**
 * create test filter class
 */
final class TestStringTransformer implements StringTransformerInterface
{
    /**
     * type transform
     *
     * @param mixed $value
     * @return string
     */
    public function transform(mixed $value): string
    {
        if (is_array($value)) {
            return json_encode($value);
        }
        return (string)$value;
    }
}
