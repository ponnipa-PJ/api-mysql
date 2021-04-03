<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    header('Access-Control-Allow-Credentials', true);
    header('Access-Control-Allow-Methods', 'GET,PUT,POST,DELETE');
    
    include_once '../config/connect.php';
    include_once '../class/user.php';
    
    $database = new Database();
    $db = $database->getConnection();
    
    $item = new User($db);
    
    $data = json_decode(file_get_contents("php://input"));
    
    $item->id = isset($_GET['id']) ? $_GET['id'] : die();

    // $item->id = $data->id;
    
    if($item->deleteUser()){
        echo 0;
    } else{
        echo json_encode("Data could not deleted");
    }
?>