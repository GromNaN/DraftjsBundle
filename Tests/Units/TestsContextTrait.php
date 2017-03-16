<?php

namespace M6Web\Bundle\DraftjsBundle\Tests\Units;

use M6Web\Bundle\DraftjsBundle\Guesser\BlockGuesserInterface;
use M6Web\Bundle\DraftjsBundle\Model\CharacterMetadata;
use M6Web\Bundle\DraftjsBundle\Model\ContentBlock;
use M6Web\Bundle\DraftjsBundle\Model\ContentState;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

/**
 * Trait TestsContextTrait
 */
trait TestsContextTrait
{
    /**
     * @return \Twig_Environment
     */
    private function getTwig()
    {
        $loader = new \Twig_Loader_Filesystem();
        $loader->addPath(__DIR__.'/../../Resources/views', 'M6WebDraftjs');
        $twig = new \Twig_Environment($loader);

        return $twig;
    }

    /**
     * @return \mock\M6Web\Bundle\DraftjsBundle\Converter\ContentStateConverter
     */
    private function getMockConverter()
    {
        return new \mock\M6Web\Bundle\DraftjsBundle\Converter\ContentStateConverter();
    }

    /**
     * @param BlockGuesserInterface $blockGuesser
     *
     * @return \mock\M6Web\Bundle\DraftjsBundle\Builder\HtmlBuilder
     */
    private function getMockBuilder(BlockGuesserInterface $blockGuesser)
    {
        return new \mock\M6Web\Bundle\DraftjsBundle\Builder\HtmlBuilder($blockGuesser);
    }

    /**
     * @return \mock\M6Web\Bundle\DraftjsBundle\Guesser\BlockGuesser
     */
    private function getMockBlockGuesser(array $inlineClassNames = [])
    {
        $twig = $this->getTwig();

        // inline entity guesser
        $inlineEntityGuesser = new \mock\M6Web\Bundle\DraftjsBundle\Guesser\InlineEntityGuesser();

        // content renderer
        $contentRenderer = new \mock\M6Web\Bundle\DraftjsBundle\Renderer\Content\ContentRenderer($inlineEntityGuesser);

        if (!empty($inlineClassNames)) {
            $contentRenderer->setInlineClassNames($inlineClassNames);
        }

        // block entity guesser
        $blockEntityGuesser = new \mock\M6Web\Bundle\DraftjsBundle\Guesser\BlockEntityGuesser();

        // add block renderer
        $atomicBlockRenderer = new \mock\M6Web\Bundle\DraftjsBundle\Renderer\Block\AtomicBlockRenderer($contentRenderer, $twig);
        $atomicBlockRenderer->setBlockClassName('atomic-block');
        $atomicBlockRenderer->setBlockEntityGuesser($blockEntityGuesser);

        $defaultBlockRenderer = new \mock\M6Web\Bundle\DraftjsBundle\Renderer\Block\DefaultBlockRenderer($contentRenderer, $twig);
        $defaultBlockRenderer->setBlockClassName('default-block');
        $headingBlockRenderer = new \mock\M6Web\Bundle\DraftjsBundle\Renderer\Block\HeadingBlockRenderer($contentRenderer, $twig);
        $headingBlockRenderer->setBlockClassName('heading-block');
        $listBlockRenderer = new \mock\M6Web\Bundle\DraftjsBundle\Renderer\Block\ListBlockRenderer($contentRenderer, $twig);
        $listBlockRenderer->setBlockClassName('list-block');

        $blockGuesser = new \mock\M6Web\Bundle\DraftjsBundle\Guesser\BlockGuesser();

        $blockGuesser->addRenderer($atomicBlockRenderer, 'atomic_block_renderer');
        $blockGuesser->addRenderer($defaultBlockRenderer, 'default_block_renderer');
        $blockGuesser->addRenderer($headingBlockRenderer, 'heading_block_renderer');
        $blockGuesser->addRenderer($listBlockRenderer, 'list_block_renderer');

        return $blockGuesser;
    }

    /**
     * @return \mock\M6Web\Bundle\DraftjsBundle\Model\ContentState
     */
    private function getMockContentState()
    {
        $emptyCharacterMetadata = new \mock\M6Web\Bundle\DraftjsBundle\Model\CharacterMetadata();
        $boldItalicCharacterMetadata = new \mock\M6Web\Bundle\DraftjsBundle\Model\CharacterMetadata(['BOLD', 'ITALIC']);
        $italicCharacterMetadata = new \mock\M6Web\Bundle\DraftjsBundle\Model\CharacterMetadata(['ITALIC']);

        $characterList = [
            $emptyCharacterMetadata,
            $emptyCharacterMetadata,
            $boldItalicCharacterMetadata,
            $boldItalicCharacterMetadata,
            $italicCharacterMetadata,
            $italicCharacterMetadata,
            $italicCharacterMetadata,
            $italicCharacterMetadata,
            $emptyCharacterMetadata,
            $emptyCharacterMetadata,
            $emptyCharacterMetadata,
            $emptyCharacterMetadata,
        ];

        $contentBlock = new \mock\M6Web\Bundle\DraftjsBundle\Model\ContentBlock('e0vbh', 'unstyled', 'Hello world!', $characterList, 0, []);

        return new \mock\M6Web\Bundle\DraftjsBundle\Model\ContentState([$contentBlock]);
    }

    /**
     * @param string $json
     *
     * @return mixed
     */
    private function getRawState($json)
    {
        return json_decode($json, true);
    }
}