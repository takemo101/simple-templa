# Simple Template Parser

[![Testing](https://github.com/takemo101/simple-templa/actions/workflows/testing.yml/badge.svg)](https://github.com/takemo101/simple-templa/actions/workflows/testing.yml)
[![PHPStan](https://github.com/takemo101/simple-templa/actions/workflows/phpstan.yml/badge.svg)](https://github.com/takemo101/simple-templa/actions/workflows/phpstan.yml)
[![Validate Composer](https://github.com/takemo101/simple-templa/actions/workflows/composer.yml/badge.svg)](https://github.com/takemo101/simple-templa/actions/workflows/composer.yml)

The Simple Templa is a simple template parser.  
Enjoy!  

## How to use
Please use as follows

### Basic
```php
use Takemo101\SimpleTempla\Environment\DefaultEnvironmentCreator;

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

// pass the data as an array
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

echo $result;
//    Hello, i like PHP.
//    PHP is Simple and nice.
//    Thank you.
//
//    {"language":"php","php_is":{"simple":"SIMPLE","nice":"NICE"},"thank_you":{"thank":"thank","you":"you"}}
```

### Filter
You can add filters to the Enviroment Object
```php
use Takemo101\SimpleTempla\Environment\DefaultEnvironmentCreator;
use Takemo101\SimpleTempla\Filter\ {
    FilterProcessInterface,
    FilterName,
    Filter,
};

/**
 * create test filter class
 */
final class TestFilter implements FilterProcessInterface
{
    public function __construct(
        private string $replaceText,
    )
    {
        //
    }

    // processing that returns only a specific character string
    public function execute(string $value): string
    {
        return $this->replaceText;
    }
}

// create Environment object
$environment = DefaultEnvironmentCreator::create();

// add preset filter
$environment->addPresetFilter(
    new Filter(
        new FilterName('test_filter'),
        new TestFilter('TEST'),
    ),
);

// template text
$text = "{{ test|test_filter }}";

// create template object from text
$template = $environment->createTemplate($text);

$result = $template->parse(['test' => '____']);

echo $result;
// TEST

$result = $template->parse(['test' => 'ABCD']);

echo $result;
// TEST
```

### Value processing
You can process the value passed to the template with a function. 
```php
use Takemo101\SimpleTempla\Environment\DefaultEnvironmentCreator;
use Takemo101\SimpleTempla\Template\Value\Call;

// create Environment object
$environment = DefaultEnvironmentCreator::create();

// template text
$text = "{{ data }}";

// create template object from text
$template = $environment->createTemplate($text);

// create Call object
$call = new Call(fn ($v) => strtoupper($v));

// set the function to the value in the Call object
$result = $template->parse(['data' => $call->of('hello')]);

echo $result;
// HELLO

$result = $template->parse(['data' => $call->of('world')]);

echo $result;
// WORLD
```

### Template language
Only filters and variables are available in this template language.

| expression | example |
| -- | -- |
| variables | {{ data.first }} {{ data.second }} |
| filters | {{ data.first\|strtolower }} {{ data.second\|strtoupper }} |
