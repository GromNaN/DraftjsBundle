<?php

namespace M6Web\Bundle\DraftjsBundle\Model;

use M6Web\Bundle\DraftjsBundle\Exception\DraftjsException;

/**
 * Class ContentBlock
 *
 * @package M6Web\Bundle\DraftjsBundle\Model
 */
class ContentBlock
{
    const UNSTYLED = 'unstyled';

    /**
     * @var string $key
     */
    private $key;

    /**
     * @var string $type
     */
    private $type;

    /**
     * @var string $text
     */
    private $text;

    /**
     * @var int $depth
     */
    private $depth;

    /**
     * @var CharacterMetadata[] $characterList
     */
    private $characterList = [];

    /**
     * @var array $data
     */
    private $data = [];

    /**
     * ContentBlock constructor.
     *
     * @param string $key
     * @param string $type
     * @param string $text
     * @param array  $characterList
     * @param int    $depth
     * @param array  $data
     */
    public function __construct($key, $type = self::UNSTYLED, $text = '', array $characterList = [], $depth = 0, array $data = [])
    {
        $this->key = $key;
        $this->type = strtolower($type);
        $this->text = $text;
        $this->characterList = $characterList;
        $this->depth = $depth;
        $this->data = $data;
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param string $key
     *
     * @return $this
     */
    public function setKey($key)
    {
        $this->key = $key;

        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return $this
     *
     * @throws DraftjsException
     */
    public function setType($type)
    {
        $this->type = strtolower($type);

        return $this;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $text
     *
     * @return $this
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @return int
     */
    public function getDepth()
    {
        return $this->depth;
    }

    /**
     * @param int $depth
     *
     * @return $this
     */
    public function setDepth($depth)
    {
        $this->depth = $depth;

        return $this;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param array $data
     *
     * @return $this
     */
    public function setData(array $data = [])
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @return array|CharacterMetadata[]
     */
    public function getCharacterList()
    {
        return $this->characterList;
    }

    /**
     * @param array $characterList
     *
     * @return $this
     */
    public function setCharacterList(array $characterList = [])
    {
        $this->characterList = $characterList;

        return $this;
    }
}
