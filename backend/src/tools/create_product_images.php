<?php
// Script para generar copias de imágenes con nombre producto_{id}.
// Úsalo desde CLI: php backend/src/tools/create_product_images.php
// O accédelo vía navegador si el servidor tiene acceso al filesystem.

require_once __DIR__ . '/../config/database.php';

$database = new Database();
$conn = $database->getConnection();
if (!$conn) {
    echo "No se pudo conectar a la base de datos.\n";
    exit(1);
}

// Ruta de imágenes (ajusta si tu estructura es distinta)
$imgDir = realpath(__DIR__ . '/../../frontend/assets/img');
if (!$imgDir || !is_dir($imgDir)) {
    echo "No se encontró la carpeta de imágenes: " . __DIR__ . '/../../frontend/assets/img' . "\n";
    exit(1);
}

echo "Directorio de imágenes: $imgDir\n\n";

// Obtener productos
$stmt = $conn->prepare("SELECT id, nombre, imagen FROM productos ORDER BY id ASC");
$stmt->execute();
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!$productos) {
    echo "No se encontraron productos en la base de datos.\n";
    exit(0);
}

$extensions = ['.png', '.jpg', '.jpeg', '.svg'];
$copias = 0;

foreach ($productos as $p) {
    $id = $p['id'];
    $campoImagen = $p['imagen'];
    $nombre = $p['nombre'];

    $found = null;

    // 1) Priorizar si ya existe imagen con patrón por id
    $candidates = [];
    $candidates[] = "producto_{$id}";
    $candidates[] = "producto-{$id}";
    $candidates[] = (string)$id;

    // 2) Campo imagen de la BD
    if (!empty($campoImagen)) $candidates[] = $campoImagen;

    // 3) Variantes del nombre del producto
    $candidates[] = $nombre;
    $candidates[] = str_replace(' ', '_', $nombre);
    $candidates[] = str_replace(' ', '-', $nombre);
    $candidates[] = strtolower($nombre);

    foreach ($candidates as $c) {
        $c = trim($c);
        if ($c === '') continue;

        // Si ya tiene extensión, comprobar directamente
        $ext = pathinfo($c, PATHINFO_EXTENSION);
        if ($ext !== '') {
            $path = $imgDir . DIRECTORY_SEPARATOR . $c;
            if (file_exists($path)) { $found = $path; break; }
        }

        // Probar con extensiones
        foreach ($extensions as $e) {
            $file = $c . $e;
            $path = $imgDir . DIRECTORY_SEPARATOR . $file;
            if (file_exists($path)) { $found = $path; break 2; }
        }
    }

    if ($found) {
        $extFound = '.' . pathinfo($found, PATHINFO_EXTENSION);
        $target = $imgDir . DIRECTORY_SEPARATOR . "producto_{$id}" . $extFound;
        if (!file_exists($target)) {
            if (@copy($found, $target)) {
                echo "Copiado: " . basename($found) . " -> " . basename($target) . "\n";
                $copias++;
            } else {
                echo "Error al copiar " . basename($found) . " -> " . basename($target) . "\n";
            }
        } else {
            echo "Ya existe: " . basename($target) . " (omitido)\n";
        }
    } else {
        echo "No se encontró imagen para producto id={$id}, nombre='" . $nombre . "'\n";
    }
}

echo "\nTotal copias realizadas: $copias\n";

?>