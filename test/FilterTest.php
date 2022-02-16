<?php

namespace Test;

use PHPUnit\Framework\TestCase;
use Takemo101\SimpleTempla\Environment\DefaultEnvironmentCreator;
use Takemo101\SimpleTempla\Filter\Preset\{
    LowerCaseFirst,
    StrToLower,
    StrToUpper,
    UpperCaseFirst,
    UpperCaseWords,
};
use Takemo101\SimpleTempla\Filter\{
    FilterCollection,
    FilterName,
    Filter,
};

/**
 * filter test
 */
class FilterTest extends TestCase
{
    /**
     * @test
     */
    public function createPresetFilter__OK()
    {
        $filter = new LowerCaseFirst;
        $result = $filter->execute('HELLO');

        $this->assertEquals($result, 'hELLO');

        $filter = new StrToLower;
        $result = $filter->execute('HELLO');

        $this->assertEquals($result, 'hello');

        foreach ([
            LowerCaseFirst::class => [
                'HELLO',
                'hELLO',
            ],
            StrToLower::class => [
                'HELLO',
                'hello',
            ],
            StrToUpper::class => [
                'hello',
                'HELLO',
            ],
            UpperCaseFirst::class => [
                'hello',
                'Hello',
            ],
            UpperCaseWords::class => [
                'hello world',
                'Hello World',
            ],
        ] as $class => $check) {
            $filter = new $class;
            $result = $filter->execute($check[0]);

            $this->assertEquals($result, $check[1]);
        }
    }

    /**
     * @test
     */
    public function createFilterCollection__OK()
    {
        $collection = FilterCollection::fromArray([
            new Filter(
                new FilterName('tolower'),
                new StrToLower,
            )
        ]);

        $collection->add(
            new Filter(
                new FilterName('toupper'),
                new StrToUpper,
            )
        );

        $result = $collection->filtering('hello', [new FilterName('toupper')]);

        $this->assertEquals($result, 'HELLO');

        $result = $collection->filtering('hello', [
            new FilterName('hoge'),
            new FilterName('tolower'),
        ]);

        $this->assertEquals($result, 'hello');
    }
}
