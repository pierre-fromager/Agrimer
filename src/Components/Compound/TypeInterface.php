<?php

declare(strict_types=1);

namespace PierInfor\Agrimer\Components\Compound;

interface TypeInterface
{
    const _TYPE_BIO = 0;
    const _TYPE_FRUIT = 1;
    const _TYPE_VEGETABLE = 2;
    const _TYPE_MEAT_PORC = 3;
    const _TYPE_MEAT_BEEF = 4;
    const _TYPE_MEAT_POULTRY = 5;
    const _TYPE_MEAT_SHEEP = 6;
    const _TYPE_SEA = 7;

    const _TYPE_REX_BIO = '/bio/im';
    const _TYPE_REX_FRUIT = '/fruit/im';
    const _TYPE_REX_VEGETABLE = '/légume/im';

    const _LABEL_TYPES = [
        TypeInterface::_TYPE_REX_BIO => TypeInterface::_TYPE_BIO,
        TypeInterface::_TYPE_REX_FRUIT => TypeInterface::_TYPE_FRUIT,
        TypeInterface::_TYPE_REX_VEGETABLE => TypeInterface::_TYPE_VEGETABLE,
    ];

    /**
     * flag a bit at position to 1
     * @param integer $bitpos
     * @return TypeInterface
     */
    public function flag(int $bitpos): TypeInterface;

    /**
     * flag a bit at position to 0
     * @param integer $bitpos
     * @return TypeInterface
     */
    public function unflag(int $bitpos): TypeInterface;

    /**
     * check if a single bit is equal to 1 for a given bit position
     * @param integer $bitpos
     * @return boolean
     */
    public function check(int $bitpos): bool;

    /**
     * check if a mask is contained in type
     * @param integer $bitpos
     * @return boolean
     */
    public function match(int $bitpos): bool;

    /**
     * get $type value
     * @return integer
     */
    public function getType(): int;
}
