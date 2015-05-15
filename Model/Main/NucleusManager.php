<?php

namespace Sinc\Main;

use Sinc\Main\Entity\Nucleus;

class NucleusManager
{
    private $nucleusRepository;

    public function __construct(NucluesRepositoryInterface $nucleusRepository)
    {
        $this->nucleusRepository = $nucleusRepository;
    }

    public function register(Nucleus $nucleus)
    {
        $this->nucleusRepository->register($nucleus);
    }
}
