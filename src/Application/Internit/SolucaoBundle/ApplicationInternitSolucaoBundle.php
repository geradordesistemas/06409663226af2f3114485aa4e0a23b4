<?php

namespace App\Application\Internit\SolucaoBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ApplicationInternitSolucaoBundle extends Bundle
{
    /** {@inheritdoc} */
    public function getParent()
    {
        return 'ApplicationInternitSolucaoBundle';
    }
}