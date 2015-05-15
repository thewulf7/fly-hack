<?php

namespace Sinc\Test\Income;

use Sinc\Main\Entity\Nucleus;
use Sinc\Income\Entity\Associate;
use Sinc\Income\AssociateManager;

class AssociateManagerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Member registration
     */
    public function testWhenRegisteringNewAssociateItMustBeRelatedToAnAssociation()
    {
        $association = new Nucleus();
        $associate = new Associate();

        $associateManager = new AssociateManager($association);
        $associateManager->register($associate);

        $this->assertInstanceOf('Sinc\Main\Entity\Association', $associate->getAssociation());
    }
}
