<?php

declare(strict_types=1);

namespace PierInfor\Agrimer\Components\Compound;

/**
 * 32 bits compound type
 */
class Type implements TypeInterface
{
    /** @var integer $type */
    protected $type;

    /**
     * ctor
     */
    public function __construct()
    {
        $this->reset();
    }

    /**
     * flag a bit at position to 1
     * @param integer $rank
     * @return TypeInterface
     */
    public function flag(int $bitpos = 0): TypeInterface
    {
        $this->setFlag($this->getMask($bitpos), true);
        return $this;
    }

    /**
     * flag a bit at position to 0
     * @param integer $bitpos
     * @return TypeInterface
     */
    public function unflag(int $bitpos = 0): TypeInterface
    {
        $this->setFlag($this->getMask($bitpos), false);
        return $this;
    }

    /**
     * check if a single bit is equal to 1 for a given bit position
     * @param integer $bitpos
     * @return boolean
     */
    public function check(int $bitpos = 0): bool
    {
        return (($this->type & $this->getMask($bitpos)) != 0);
    }

    /**
     * check if a mask is contained in type
     * @param integer $bitpos
     * @return boolean
     */
    public function match(int $mask = 0): bool
    {
        return (($this->type & $mask) != 0);
    }

    /**
     * get $type value
     * @return integer
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * get bitmask value from bit position applying shift left
     * @param integer $bitpos
     * @return integer
     */
    protected function getMask(int $bitpos = 0): int
    {
        return 1 << $bitpos;
    }

    /**
     * set a flag
     * @param integer $flag
     * @param boolean $state
     * @return integer
     */
    protected function setFlag(int $flag, bool $state): int
    {
        return $state
            ? $this->type |= $flag
            : $this->type &= ~$flag;
    }

    /**
     * reset type
     * @return TypeInterface
     */
    protected function reset(): TypeInterface
    {
        $this->type = 0;
        return $this;
    }
}
