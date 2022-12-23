<?php

namespace App\Application\Internit\ProjetoBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ApplicationInternitProjetoBundle extends Bundle
{
    /** {@inheritdoc} */
    public function getParent()
    {
        return 'ApplicationInternitProjetoBundle';
    }
}