<?php

declare(strict_types=1);

namespace PierInfor\Agrimer\Components\Market;

use PierInfor\Agrimer\Components\Market\Constants;
use PierInfor\Agrimer\Components\Market\Place as MarketPlace;

/**
 * Agrimer market places
 */
class Places extends Constants
{
    /**
     * Places stack
     * @var Array
     */
    protected $stack;

    /**
     * ctor
     */
    public function __construct()
    {
        $this->init();
    }

    /**
     * init stack places
     * @return Places
     */
    protected function init(): Places
    {
        $this->stack = [];
        $this->add(self::M0024_ID, self::M0024_LABEL); // Munich f&l
        $this->add(self::M0026_ID, self::M0026_LABEL); // Strasbourg f&l bio
        $this->add(self::M0030_ID, self::M0030_LABEL); // Avignon-Cavaillon f&l
        $this->add(self::M0031_ID, self::M0031_LABEL); // Nice f&l
        $this->add(self::M0052_ID, self::M0052_LABEL); // Marseille f&l
        $this->add(self::M0066_ID, self::M0066_LABEL); // Toulouse f&l
        $this->add(self::M0071_ID, self::M0071_LABEL); // Bordeaux-Brienne f&l
        // $this->add(self::M0072_ID, self::M0072_LABEL); // Bordeaux-Brienne f&l bio (!ND)
        $this->add(self::M0095_ID, self::M0095_LABEL); // Lyon légumes
        $this->add(self::M0097_ID, self::M0097_LABEL); // Lyon fruits
        $this->add(self::M0108_ID, self::M0108_LABEL); // Lomme Lille f&l
        $this->add(self::M0123_ID, self::M0123_LABEL); // Rungis f&l
        $this->add(self::M0184_ID, self::M0184_LABEL); // Berlin f&l
        $this->add(self::M0201_ID, self::M0201_LABEL); // Rungis f&l bio
        $this->add(self::M0513_ID, self::M0513_LABEL); // Nantes f&l bio
        return $this;
    }

    /**
     * add a place into stack
     * @param string $id
     * @param string $label
     * @return Places
     */
    protected function add($id, $label): Places
    {
        $this->stack[] = (new MarketPlace())->setId($id)->setLabel($label);
        return $this;
    }

    /**
     * list places
     * @return array
     */
    public function list(): array
    {
        return $this->stack;
    }

    /**
     * list places id
     * @return array
     */
    public function listIds(): array
    {
        return array_map(function ($place) {
            return $place->getId();
        }, $this->list());
    }
}
