<?php

declare(strict_types=1);

namespace PierInfor\Agrimer\Components\Serializer;

/**
 *  Serializer trait
 */
trait JsonSerializer
{
    /**
     * return object props values as array 
     * @return array
     */
    public function jsonSerialize():array
    {
        return get_object_vars($this);
    }
}
