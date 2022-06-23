<?php

global $connect;

function getConnection() {

    $connect = mysqli_connect("localhost" , "root" , "password");
    mysqli_select_db($connect, "paginanueva");
    $tildes = $connect->query("SET NAMES 'utf8'"); //Para que se muestren las tildes
    return $connect;
}

function closeConnection() {
    mysqli_close($connect);
}

?>