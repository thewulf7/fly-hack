<?php

namespace Sinc\Test;

use PHPUnit_Extensions_Database_DataSet_IDataSet;
use PHPUnit_Extensions_Database_DB_IDatabaseConnection;
use Sinc\Main\NucleusManager;
use Sinc\Main\Entity\NucleusRepository;
use Sinc\Main\Entity\Nucleus;

class NucleusManagerTest extends \PHPUnit_Extensions_Database_TestCase
{
    private $pdo;

    public function testRegisterNewAssociation()
    {
        $nucleusRepository = new NucleusRepository($this->pdo);
        $nucleusManager = new NucleusManager($nucleusRepository);

        $nucleus = new Nucleus();
        $nucleus->setName('Divino Manto');
        $nucleusManager->register($nucleus);

        $this->assertEquals(1, $this->getConnection()->getRowCount('nucleus'));
    }

    /**
     * Returns the test database connection.
     *
     * @return PHPUnit_Extensions_Database_DB_IDatabaseConnection
     */
    protected function getConnection()
    {
        $pdo = new \PDO('sqlite::memory:');
        $pdo->exec("
            CREATE TABLE IF NOT EXISTS nucleus (
              id INTEGER PRIMARY KEY,
              name TEXT
            )
        ");
        $this->pdo = $pdo;

        return  $this->createDefaultDBConnection($pdo, ':memory:');
    }

    /**
     * Returns the test dataset.
     *
     * @return PHPUnit_Extensions_Database_DataSet_IDataSet
     */
    protected function getDataSet()
    {
        return new \PHPUnit_Extensions_Database_DataSet_YamlDataSet(
            dirname(__FILE__).'/nucleus.yml'
        );
    }
}
