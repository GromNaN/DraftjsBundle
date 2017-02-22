<?php

namespace M6Web\Bundle\DraftjsBundle\Renderer\Inline;

use M6Web\Bundle\DraftjsBundle\Model\DraftEntity;

/**
 * Class InlineLinkRenderer
 *
 * @package M6Web\Bundle\DraftjsBundle\Renderer\Inline
 */
class InlineLinkRenderer extends AbstractInlineEntityRenderer
{
    const TYPE = 'link';

    /**
     * @param DraftEntity $entity
     *
     * @return string
     */
    public function openTag(DraftEntity $entity)
    {
        $data = $entity->getData();

        return $this->openNode('a', [
            'href' => $data['url'],
        ]);
    }

    /**
     * @return string
     */
    public function closeTag()
    {
        return $this->closeNode('a');
    }

    /**
     * @param string $type
     *
     * @return bool
     */
    public function supports($type)
    {
        return self::TYPE === $type;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return self::TYPE;
    }
}
