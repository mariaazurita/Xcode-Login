<?php
require_once('Login.php');
include ('ContactTable.php');
include ('UpdateStatus.php');
include ('Comments.php');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER['REQUEST_METHOD'];
if($method == "OPTIONS") {
    die();
}
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );

 
if ((isset($uri[1]) && $uri[1] != 'Xcode-Login') || !isset($uri[3])) {
    header("HTTP/1.1 404 Not Found");
    exit();
}

$stringCheck = $uri[3];

if($stringCheck == 'login'){
    $_POST = json_decode(array_keys($_POST)[0], true);
    $arreglousuarios = ['user' => $_POST["user"], 'password'=> $_POST["password"] ];
    if ( ($arreglousuarios['user'])== '' || ($arreglousuarios['password']) == '' )
    {
        $msg = "Usuario o contraseña faltante"; 
        $data = ['message' => $msg];
        echo json_encode($data);
    } else {
        $loggedIn = validateLogin($arreglousuarios['user'], $arreglousuarios['password']);
        
        if($loggedIn) {
            $JWT = setToken($arreglousuarios['user']);
            $data=['token' => $JWT];
            echo json_encode($data);
        } else {
            $msg = "Usuario o contraseña incorrecta";
            $data = ['message' => $msg];
            echo json_encode($data);
        }
    }
} elseif($uri[3] == 'table') {
    getTable();

} elseif($uri[3] == 'status') {

    $_POST = json_decode(array_keys($_POST)[0], true);
    $arregloPatch = ['ID' => $_POST["ID"], 'state'=> $_POST["ESTATUS"] ];
    updateStatus( $arregloPatch['state'], $arregloPatch['ID']);

} elseif($uri[3] == 'comment') {

    $_POST = json_decode(array_keys($_POST)[0], true);
    $arregloComments = ['ID' => $_POST["ID"], 'TASK' => $_POST["TASK"]];
    if($arregloComments['TASK']) {
        addComment($arregloComments['ID'], $_POST["MESSAGE"] );
    } else {
        deleteComment($arregloComments['ID']);
    }
}

?>