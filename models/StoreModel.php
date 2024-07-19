<?php

require_once 'config/DB.php';

class StoreModel
{
    private PDO $conn;
    private string $table = 'stores';

    public function __construct()
    {
        $this->conn = (new DB())->getConnection();
    }

    /**
     * Trouver un magasin par ID
     *
     * @param int $id
     * @return array|null
     */
    public function selectOne(int $id): ?array
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    /**
     * Récupérer tous les magasins, avec options de filtrage et tri
     *
     * @param array $params
     * @return array
     */
    public function selectAll(array $params): array
    {
        $query = "SELECT * FROM " . $this->table;
        $filters = [];
        $bindings = [];

        if (!empty($params['name'])) {
            $filters[] = 'name LIKE :name';
            $bindings[':name'] = '%' . $params['name'] . '%';
        }

        if (!empty($params['city'])) {
            $filters[] = 'city LIKE :city';
            $bindings[':city'] = '%' . $params['city'] . '%';
        }

        if ($filters) {
            $query .= ' WHERE ' . implode(' AND ', $filters);
        }

        if (!empty($params['sort'])) {
            $sort = $params['sort'];
            $order = !empty($params['order']) && strtoupper($params['order']) === 'DESC' ? 'DESC' : 'ASC';
            $query .= ' ORDER BY ' . $sort . ' ' . $order;
        }

        $stmt = $this->conn->prepare($query);

        foreach ($bindings as $key => $value) {
            $stmt->bindValue($key, $value);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Créer un nouveau magasin
     *
     * @param array $data
     * @return bool
     */
    public function insert(array $data): bool
    {
        $query = "INSERT INTO " . $this->table . " (name, city) VALUES (:name, :city)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $data['name'], PDO::PARAM_STR);
        $stmt->bindParam(':city', $data['city'], PDO::PARAM_STR);
        return $stmt->execute();
    }

    /**
     * Mettre à jour un magasin
     *
     * @param array $data
     * @return bool
     */
    public function update(array $data): bool
    {
        $query = "UPDATE " . $this->table . " SET name = :name, city = :city WHERE id = :id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $data['name'], PDO::PARAM_STR);
        $stmt->bindParam(':city', $data['city'], PDO::PARAM_STR);
        $stmt->bindParam(':id', $data['id'], PDO::PARAM_INT);
        
        return $stmt->execute();
    }

    /**
     * Supprimer un magasin
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}