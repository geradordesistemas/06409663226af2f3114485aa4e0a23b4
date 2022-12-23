<?php

namespace App\Application\Internit\CargoBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ApplicationInternitCargoBundle extends Bundle
{
    /** {@inheritdoc} */
    public function getParent()
    {
        return 'ApplicationInternitCargoBundle';
    }
}