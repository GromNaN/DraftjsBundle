<?php

namespace M6Web\Bundle\DraftjsBundle\Renderer\Entity;

use M6Web\Bundle\DraftjsBundle\Model\DraftEntity;

/**
 * Class ImageBlockRenderer
 *
 * @package M6Web\Bundle\DraftjsBundle\Renderer\Entity
 */
class ImageEntityRenderer extends AbstractBlockEntityRenderer
{
    const TYPE = 'image';

    /**
     * @param DraftEntity $entity
     *
     * @return string
     */
    public function render(DraftEntity $entity)
    {
        $data = array_replace([
            'src' => null,
            'alt' => null,
            'className' => null,
        ], $entity->getData());

        return $this->templating->render('M6WebDraftjsBundle:Entity:image.html.twig', $data);
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
