<?php
require_once('index.php');
require_once('DataBase.php');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER['REQUEST_METHOD'];
if($method == "OPTIONS") {
    die();
}


function getTable() {

    $db = getConnection();
    $sql = "SELECT * FROM formulario";
    $result = mysqli_query($db, $sql);
    $num = mysqli_num_rows($result);
    $res = [];

    for ($i=0; $i < $num; $i++) { 
        $data = mysqli_fetch_assoc($result);
        array_push($res, $data);
    }

    echo json_encode($res);
}




?>