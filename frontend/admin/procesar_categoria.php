<?php
require_once "../../backend/src/config/database.php";
$database = new Database();
$db = $database->getConnection();

$accion = $_GET['accion'];

if ($accion == 'crear') {
    $nombre = $_POST['nombre_cat'];
    $sql = "INSERT INTO categorias (nombre_categoria) VALUES (:nom)";
    $stmt = $db->prepare($sql);
    $stmt->execute([':nom' => $nombre]);

} elseif ($accion == 'eliminar') {
    $id = $_GET['id'];
    // MySQL pondrá en NULL el categoria_id de los shows automáticamente por el ON DELETE SET NULL
    $sql = "DELETE FROM categorias WHERE id = :id";
    $stmt = $db->prepare($sql);
    $stmt->execute([':id' => $id]);
}

header("Location: shows.php");
exit();