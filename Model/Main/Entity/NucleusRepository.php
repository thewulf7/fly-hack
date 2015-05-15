<?php

namespace Sinc\Main\Entity;

use Sinc\Main\NucluesRepositoryInterface;

class NucleusRepository implements NucluesRepositoryInterface
{
    private $connection;

    public function __construct($connection)
    {
        $connection->exec("
            CREATE TABLE IF NOT EXISTS nucleus (
              id INTEGER PRIMARY KEY,
              name TEXT
            )
        ");
        $this->connection = $connection;
    }

    public function register(Nucleus $nucleus)
    {
        $this->connection->exec(
            "INSERT INTO nucleus (name) VALUES ('{$nucleus->getName()}')"
        );
    }
}
