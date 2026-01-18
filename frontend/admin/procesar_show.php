<?php
// 1. Usar ruta absoluta para evitar errores de archivos no encontrados

require_once "../backend/src/config/database.php";
$database = new Database();
$db = $database->getConnection();

$accion = isset($_GET['accion']) ? $_GET['accion'] : '';

if ($accion == 'crear') {
    $nombre = $_POST['nombre'];
    $categoria_id = $_POST['categoria_id'];
    $sinopsis = $_POST['sinopsis'];
    $especificaciones = $_POST['especificaciones'];
    $duracion = $_POST['duracion'];
    $video_url = $_POST['video_url'];

    // --- CONFIGURACIÓN DE CARPETA SEGÚN TU IMAGEN ---
    $uploadDir = "../../assets/img/img_shows/";
    
    // Crear la carpeta si no existe por algún motivo
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $fotos = [1 => "", 2 => "", 3 => ""];

    for ($i = 1; $i <= 3; $i++) {
        $inputName = "foto" . $i;
        if (!empty($_FILES[$inputName]["name"])) {
            // Nombre único: tiempo + nombre original limpio
            $fileName = time() . "_" . preg_replace("/[^a-zA-Z0-9.]/", "_", $_FILES[$inputName]["name"]);
            $targetPath = $uploadDir . $fileName;

            if (move_uploaded_file($_FILES[$inputName]["tmp_name"], $targetPath)) {
                $fotos[$i] = $fileName;
            }
        }
    }

    // --- INSERCIÓN EN BD ---
    $sql = "INSERT INTO shows (nombre_show, categoria_id, especificaciones, video_url, sinopsis, duracion, foto1, foto2, foto3, estado) 
            VALUES (:n, :cat_id, :e, :v, :s, :d, :f1, :f2, :f3, 1)";

    $stmt = $db->prepare($sql);
    $stmt->execute([
        ':n'      => $nombre, 
        ':cat_id' => $categoria_id,
        ':e'      => $especificaciones, 
        ':v'      => $video_url, 
        ':s'      => $sinopsis, 
        ':d'      => $duracion, 
        ':f1'     => $fotos[1], 
        ':f2'     => $fotos[2], 
        ':f3'     => $fotos[3]
    ]);

} elseif ($accion == 'toggle') {
    $id = $_GET['id'];
    $nuevoEstado = ($_GET['estado'] == 1) ? 0 : 1;
    $stmt = $db->prepare("UPDATE shows SET estado = :est WHERE id = :id");
    $stmt->execute([':est' => $nuevoEstado, ':id' => $id]);

} elseif ($accion == 'eliminar') {
    $id = $_GET['id'];
    $stmt = $db->prepare("DELETE FROM shows WHERE id = :id");
    $stmt->execute([':id' => $id]);
}

header("Location: shows.php");
exit();