<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
require_once('DataBase.php');

require_once('./vendor/autoload.php');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER['REQUEST_METHOD'];
if($method == "OPTIONS") {
    die();
}

//DataBase Verification

function validateLogin($user, $password):bool {

    
    $db = getConnection();
    $sql = "SELECT PASSWORD FROM usuarios WHERE NOMBRE='$user'";
    $result = mysqli_query($db, $sql);
    $found = mysqli_num_rows($result);
    $hashpassword = mysqli_fetch_assoc($result);
    if($found == 1) {
        $correct = password_verify($password, $hashpassword['PASSWORD']);
        return $correct;
    }
    return false;
    
}

function setToken($user) {
    //AUTH token
$secretKey  = 'mariamariamariamariamariamaria';
$issuedAt   = new DateTimeImmutable();
$expire     = $issuedAt->modify('+6 minutes')->getTimestamp();    // Add 60 seconds
$serverName = "localhost";
$username   = $user;                   // Retrieved from filtered POST data

$data = [
    'iat'  => $issuedAt->getTimestamp(),         // Issued at: time when the token was generated
    'iss'  => $serverName,                       // Issuer
    'nbf'  => $issuedAt->getTimestamp(),         // Not before
    'exp'  => $expire,                           // Expire
    'userName' => $username,                     // User name
];

$JWT = JWT::encode(
    $data,
    $secretKey,
    'HS512'
);

return $JWT;

}


?>