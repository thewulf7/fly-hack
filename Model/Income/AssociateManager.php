<?php

namespace Sinc\Income;


use Sinc\Main\Entity\Nucleus;
use Sinc\Income\Entity\Associate;

class AssociateManager
{
    /** @var  Nucleus */
    private $nucleus;

    /**
     * @param Nucleus $nucleus
     */
    public function __construct(Nucleus $nucleus)
    {
        $this->nucleus = $nucleus;
    }

    /**
     * @param Associate $associate
     */
    public function register(Associate $associate)
    {
        $associate->setNucleus($this->nucleus);
    }
}
