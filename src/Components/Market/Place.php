<?php

declare(strict_types=1);

namespace PierInfor\Agrimer\Components\Market;

/**
 * Agrimer market place
 */
class Place
{
    public $id;
    public $label;

    public function __construct($id, $label)
    {
        $this->id = $id;
        $this->label = $label;
    }
}
