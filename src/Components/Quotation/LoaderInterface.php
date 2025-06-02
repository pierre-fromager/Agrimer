<?php

declare(strict_types=1);

namespace PierInfor\Agrimer\Components\Quotation;

/**
 * Loader interface
 */
interface LoaderInterface
{
    public function load(): LoaderInterface;
}
