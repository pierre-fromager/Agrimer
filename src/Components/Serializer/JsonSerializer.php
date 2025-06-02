<?php

declare(strict_types=1);

namespace PierInfor\Agrimer\Components\Serializer;

trait JsonSerializer
{
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}
