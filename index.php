<?php

require_once 'config/DB.php';
require_once 'controllers/StoreController.php';
require_once 'HttpStatus.php';

// Définir les en-têtes
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Obtenir l'URI et la méthode de requête
$requestUri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$requestMethod = $_SERVER["REQUEST_METHOD"];
$storeController = new StoreController();

// Vérifier si l'URI correspond au motif attendu
if (preg_match('/^\/stores\/?$/', $requestUri)) {
    switch ($requestMethod) {
        case 'GET':
            if (isset($_GET['id'])) {
                $storeController->getStore((int)$_GET['id']);
            } else {
                $storeController->getStores($_GET);
            }
            break;
        case 'POST':
            $storeController->createStore();
            break;
        case 'PUT':
            $storeController->updateStore();
            break;
        case 'DELETE':
            $storeController->deleteStore();
            break;
        default:
            http_response_code(HttpStatus::METHOD_NOT_ALLOWED);
            echo json_encode(["message" => "Method not allowed"]);
            break;
    }
} else {
    http_response_code(HttpStatus::NOT_FOUND);
    echo json_encode(["message" => "Route not found"]);
}