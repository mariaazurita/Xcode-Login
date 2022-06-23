<?php
require_once('Login.php');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER['REQUEST_METHOD'];
if($method == "OPTIONS") {
    die();
}

static $loggedIn = false;

if(true){

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

}

?>