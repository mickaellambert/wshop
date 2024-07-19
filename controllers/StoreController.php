<?php

require_once 'models/StoreModel.php';
require_once 'HttpStatus.php';

class StoreController
{
    private StoreModel $model;

    public function __construct()
    {
        $this->model = new StoreModel();
    }

    /**
     * Récupérer un magasin par ID
     *
     * @param int $id
     * @return void
     */
    public function getStore(int $id): void
    {
        $store = $this->model->selectOne($id);
        if ($store) {
            http_response_code(HttpStatus::OK);
            echo json_encode($store);
        } else {
            http_response_code(HttpStatus::NOT_FOUND);
            echo json_encode(["message" => "Store not found."]);
        }
    }

    /**
     * Récupérer tous les magasins, avec options de filtrage et tri
     *
     * @param array $params
     * @return void
     */
    public function getStores(array $params): void
    {
        $stores = $this->model->selectAll($params);
        http_response_code(HttpStatus::OK);
        echo json_encode($stores);
    }

    /**
     * Créer un nouveau magasin
     *
     * @return void
     */
    public function createStore(): void
    {
        $data = json_decode(file_get_contents("php://input"), true);
        
        if ($this->model->insert($data)) {
            http_response_code(HttpStatus::CREATED);
            echo json_encode(["message" => "Store created successfully."]);
        } else {
            http_response_code(HttpStatus::BAD_REQUEST);
            echo json_encode(["message" => "Unable to create store."]);
        }
    }

    /**
     * Mettre à jour un magasin
     *
     * @return void
     */
    public function updateStore(): void
    {
        $data = json_decode(file_get_contents("php://input"), true);

        if (!isset($data['id']) || !$this->model->selectOne((int)$data['id'])) {
            http_response_code(HttpStatus::NOT_FOUND);
            echo json_encode(["message" => "Store not found."]);
            return;
        }

        if ($this->model->update($data)) {
            http_response_code(HttpStatus::OK);
            echo json_encode(["message" => "Store updated successfully."]);
        } else {
            http_response_code(HttpStatus::BAD_REQUEST);
            echo json_encode(["message" => "Unable to update store."]);
        }
    }

    /**
     * Supprimer un magasin
     *
     * @return void
     */
    public function deleteStore(): void
    {
        $data = json_decode(file_get_contents("php://input"), true);
        
        if (!isset($data['id']) || !$this->model->selectOne((int)$data['id'])) {
            http_response_code(HttpStatus::NOT_FOUND);
            echo json_encode(["message" => "Store not found."]);
            return;
        }

        if ($this->model->delete((int)$data['id'])) {
            http_response_code(HttpStatus::OK);
            echo json_encode(["message" => "Store deleted successfully."]);
        } else {
            http_response_code(HttpStatus::BAD_REQUEST);
            echo json_encode(["message" => "Unable to delete store."]);
        }
    }
}