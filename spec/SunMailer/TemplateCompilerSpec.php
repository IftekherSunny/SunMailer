<?php

namespace spec\SunMailer;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TemplateCompilerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('SunMailer\TemplateCompiler');
    }

    function it_compiles_the_template_using_the_given_data()
    {
        $this->compile(
                    '@package-name developed by @package-author',
                    [
                        'package-name'      => 'SunMailer',
                        'package-author'    => 'Iftekher Sunny'
                    ]
                )
            ->shouldReturn('SunMailer developed by Iftekher Sunny');
    }

    function it_generates_array_to_string()
    {
        $this->arrayToString(
                    [
                        'packageName'   =>  'SunMailer',
                        'author'        =>  'Iftekher Sunny'
                    ]
                )
            ->shouldReturn(
                "[ 'packageName'=>'SunMailer','author'=>'Iftekher Sunny' ]"
            );
    }
}
