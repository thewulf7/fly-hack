<?php

namespace Sinc\Main;

use Sinc\Main\Entity\Nucleus;

interface NucluesRepositoryInterface
{
    public function register(Nucleus $nucleus);
}
