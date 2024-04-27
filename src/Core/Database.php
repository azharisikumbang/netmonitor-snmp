<?php

namespace App\Core;

use App\Core\Contract\DatabaseInterface;
use PDO;
use PDOException;

class Database implements DatabaseInterface
{
    public function __construct(private array $config = [], protected ?PDO $instance = null)
    {
    }

    public function getInstance(array $config = []): PDO
    {
        if ($this->instance instanceof PDO)
            return $this->instance;

        if (false === empty($config))
            $this->config = $config;

        $config = $this->config ?? [
            'host' => 'localhost',
            'username' => 'root',
            'password' => '',
            'database' => 'database',
            'port' => '3306'
        ];

        try
        {
            $dsn = sprintf(
                "mysql:host=%s;port=%s;dbname=%s",
                $config['host'],
                $config['port'],
                $config['database']
            );
            $this->instance = new PDO($dsn, $config['username'], $config['password']);
            $this->instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e)
        {
            echo $e->getMessage();
            exit();
        }

        return $this->instance;
    }

    public static function createInstance(
        string $database,
        string $username,
        string $password,
        string $host = 'localhost',
        int $port = 3306,
    ): self {
        $config = [
            'host' => $host,
            'username' => $username,
            'password' => $password,
            'database' => $database,
            'port' => $port
        ];

        return new self($config);
    }
}