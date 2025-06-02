<?php

declare(strict_types=1);

namespace PierInfor\Agrimer\Components\Quotation;

/**
 * Parser interface
 */
interface ParserInterface
{
    public function parse(): ParserInterface;
}
