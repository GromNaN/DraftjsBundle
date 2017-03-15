<?php

namespace M6Web\Bundle\DraftjsBundle\Renderer\Entity;

use Twig_Environment;

/**
 * Class AbstractBlockEntityRenderer
 *
 * @package M6Web\Bundle\DraftjsBundle\Renderer\Entity
 */
abstract class AbstractBlockEntityRenderer implements BlockEntityRendererInterface
{
    /**
     * @var Twig_Environment
     */
    protected $twig;

    /**
     * @var string
     */
    protected $className;

    /**
     * AbstractEntityRenderer constructor.
     *
     * @param Twig_Environment $twig
     */
    public function __construct(Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @param string $className
     *
     * @return $this
     */
    public function setClassName($className)
    {
        $this->className = $className;

        return $this;
    }

    /**
     * @return string
     */
    public function getClassName()
    {
        return $this->className;
    }
}
