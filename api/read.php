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

    $items = new User($db);

    $stmt = $items->getUsers();
    $itemCount = $stmt->rowCount();


    // echo json_encode($itemCount);

    if($itemCount > 0){
        
        $employeeArr = array();
        $employeeArr["body"] = array();
        $employeeArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id" => $id,
                "name" => $name,
                "email" => $email,
                "age" => $age,
                "created" => $created
            );

            array_push($employeeArr["body"], $e);
        }
        echo json_encode($employeeArr["body"]);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "Data No record.")
        );
    }
?>