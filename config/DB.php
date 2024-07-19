<?php

class DB
{
    private string $host;
    private string $dbName;
    private string $username;
    private string $password;
    private ?PDO $conn = null;

    public function __construct()
    {
        $this->loadEnv();

        $this->host = getenv('DB_HOST');
        $this->dbName = getenv('DB_NAME');
        $this->username = getenv('DB_USER');
        $this->password = getenv('DB_PASS');
    }

    /**
     * Charger les variables d'environnement à partir du fichier .env
     *
     * @return void
     */
    private function loadEnv(): void
    {
        if (file_exists(__DIR__ . '/../.env')) {
            $lines = file(__DIR__ . '/../.env');
            foreach ($lines as $line) {
                if (trim($line) !== '') {
                    putenv(trim($line));
                }
            }
        }
    }

    /**
     * Connexion à la base de données
     *
     * @return PDO|null
     */
    public function getConnection(): ?PDO
    {
        if ($this->conn === null) {
            try {
                $dsn = "mysql:host={$this->host};dbname={$this->dbName}";
                $this->conn = new PDO($dsn, $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo 'Connection Error: ' . $e->getMessage();
            }
        }
        
        return $this->conn;
    }
}
