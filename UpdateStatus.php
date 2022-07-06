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

function updateStatus($data, $name) {
    $db = getConnection();
    $sql = "UPDATE formulario SET ESTATUS_CONTACTO = $data WHERE Nombre = $name";
    $result = mysqli_query($db, $sql);
    return
}