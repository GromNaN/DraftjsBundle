<?php

namespace M6Web\Bundle\DraftjsBundle\Tests\Units\Renderer;

use M6Web\Bundle\DraftjsBundle\Renderer\HtmlRenderer as TestedClass;
use M6Web\Bundle\DraftjsBundle\Tests\Units\TestsContextTrait;
use mageekguy\atoum;

/**
 * HtmlRenderer
 */
class HtmlRenderer extends atoum
{
    use TestsContextTrait;

    /**
     * Test exception undefined entityMap
     *
     * @dataProvider renderDataProvider
     */
    public function testRender($json, $html)
    {
        $rawState = $this->getRawState($json);

        $blockGuesser = $this->getMockBlockGuesser();
        $converter = $this->getMockConverter();
        $builder = $this->getMockBuilder($blockGuesser);

        $this
            ->if($renderer = new TestedClass($converter, $builder))
            ->then
                ->string($renderer->render($rawState))
                ->isEqualTo($html)
            ->then
                ->mock($converter)->call('convertFromRaw')->withArguments($rawState)->once()
                ->mock($builder)->call('build')->once()
        ;
    }

    public function renderDataProvider()
    {
        return [
            [
                '{"entityMap":{},"blocks":[{"key":"e0vbh","text":"Hello world!","type":"unstyled","depth":0,"inlineStyleRanges":[{"offset":2,"length":2,"style":"BOLD"}],"entityRanges":[],"data":{}}]}',
                '<default>He<span class="bold">ll</span>o world!</default>'
            ],
            [
                '{"entityMap":{"0":{"type":"LINK","mutability":"MUTABLE","data":{"url":"http://tech.m6web.fr/"}},"1":{"type":"image","mutability":"IMMUTABLE","data":{"src":"http://lorempixel.com/400/200/"}},"2":{"type":"LINK","mutability":"MUTABLE","data":{"url":"https://facebook.github.io/draft-js/"}},"3":{"type":"image","mutability":"IMMUTABLE","data":{"src":"http://www.sample-videos.com/video/mp4/720/big_buck_bunny_720p_1mb.mp4"}}},"blocks":[{"key":"a34sd","text":"Hello, there. This is an export from Draft.js","type":"unstyled","depth":0,"inlineStyleRanges":[{"offset":0,"length":5,"style":"BOLD"},{"offset":37,"length":8,"style":"ITALIC"}],"entityRanges":[{"offset":0,"length":5,"key":0}]},{"key":"55vrh","text":"🍺","type":"atomic","depth":0,"inlineStyleRanges":[],"entityRanges":[{"offset":0,"length":1,"key":1}]},{"key":"dodnk","text":"You can have content in lists.","type":"unordered-list-item","depth":0,"inlineStyleRanges":[{"offset":13,"length":7,"style":"BOLD"}],"entityRanges":[{"offset":24,"length":5,"key":2}]},{"key":"1h6g8","text":"","type":"unstyled","depth":0,"inlineStyleRanges":[],"entityRanges":[]},{"key":"9m6lk","text":"🍺","type":"atomic","depth":0,"inlineStyleRanges":[],"entityRanges":[{"offset":0,"length":1,"key":3}]},{"key":"cp3a7","text":"","type":"unstyled","depth":0,"inlineStyleRanges":[],"entityRanges":[]}]}',
                '<default><a href="http://tech.m6web.fr/"><span class="bold">Hello</span></a>, there. This is an export from <span class="italic">Draft.js</default><default><image></image></default><ul><li>You can have <span class="bold">content</span> in <a href="https://facebook.github.io/draft-js/">lists</a>.</ul><default></default><default><image></image></default><default></default>'
            ]
        ];
    }
}
