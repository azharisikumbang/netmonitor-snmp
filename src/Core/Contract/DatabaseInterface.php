<?php

namespace App\Core\Contract;

use PDO;

interface DatabaseInterface
{
    public function getInstance(array $config = []): PDO;
}