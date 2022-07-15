<?php
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

function deleteComment($ID) {
    
    $db = getConnection();
    $sql = "UPDATE formulario 
            SET COMENTARIO = NULL 
            WHERE idFormulario = $ID";
    $result = mysqli_query($db, $sql);

}

function addComment($ID, $comment) {

    $db = getConnection();
    $sql = "UPDATE formulario 
            SET COMENTARIO = $comment 
            WHERE idFormulario = $ID";
    $result = mysqli_query($db, $sql);
    
    }

?>