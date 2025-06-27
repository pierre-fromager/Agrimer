<?php

declare(strict_types=1);

namespace PierInfor\Agrimer\Components\Market;

use PierInfor\Agrimer\Components\Compound\Type;
use PierInfor\Agrimer\Components\Compound\TypeInterface;
use PierInfor\Agrimer\Components\Serializer\JsonSerializer;

/**
 * Agrimer market place
 */
class Place implements \JsonSerializable
{
    use JsonSerializer;

    /** @var string $id */
    protected $id;

    /** @var string $label */
    protected $label;

    /** @var Type $types */
    protected $types;

    public function __construct()
    {
        $this->id = $this->label = '';
        $this->types = new Type();
    }

    /**
     * get place id
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * set place id
     * @param string $id
     * @return Place
     */
    public function setId(string $id): Place
    {
        $this->id = $id;
        return $this;
    }

    /**
     * get place label
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * set place label
     * @param string $label
     * @return Place
     */
    public function setLabel(string $label): Place
    {
        $this->label = $label;
        $this->setTypesFromLabel();
        return $this;
    }

    /**
     * get place types
     * @return Type
     */
    public function getTypes(): Type
    {
        return $this->types;
    }

    /**
     * set place types from label
     * @return Place
     */
    protected function setTypesFromLabel(): Place
    {
        foreach (TypeInterface::_LABEL_TYPES as $pattern => $type) {
            if (preg_match_all($pattern, $this->label)) {
                $this->types->flag($type);
            }
        }
        return $this;
    }
}
