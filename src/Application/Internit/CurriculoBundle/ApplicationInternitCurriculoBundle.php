<?php

namespace App\Application\Internit\CurriculoBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ApplicationInternitCurriculoBundle extends Bundle
{
    /** {@inheritdoc} */
    public function getParent()
    {
        return 'ApplicationInternitCurriculoBundle';
    }
}