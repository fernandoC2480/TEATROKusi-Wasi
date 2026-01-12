<?php
// Devuelve la ruta relativa (desde pages/) a la imagen del producto si existe
function getProductImagePath($imagenCampo, $id, $nombre = '') {
    $imgDir = realpath(__DIR__ . '/../assets/img');
    $relPrefix = '../assets/img/';
    $extensions = array('png','jpg','jpeg','svg','gif','webp');

    if (!$imgDir || !is_dir($imgDir)) {
        return $relPrefix . 'placeholder.png';
    }

    $candidates = array();

    // Helper para eliminar acentos (si está disponible)
    $removeAccents = function($str) {
        if (function_exists('transliterator_transliterate')) {
            return transliterator_transliterate('Any-Latin; Latin-ASCII;', $str);
        }
        $s = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $str);
        return $s === false ? $str : $s;
    };

    if (!empty($imagenCampo)) {
        $base = basename($imagenCampo);
        $candidates[] = $base;
        $candidates[] = trim($imagenCampo);
        $ext = pathinfo($base, PATHINFO_EXTENSION);
        if ($ext === '') {
            foreach ($extensions as $e) $candidates[] = $imagenCampo . '.' . $e;
        }

        // variantes comunes: underscores, hyphens, lowercase, sin acentos
        $noAcc = $removeAccents($base);
        $candidates[] = str_replace(' ', '_', $base);
        $candidates[] = str_replace(' ', '-', $base);
        $candidates[] = strtolower($base);
        if ($noAcc !== $base) {
            $candidates[] = $noAcc;
            $candidates[] = str_replace(' ', '_', $noAcc);
            $candidates[] = str_replace(' ', '-', $noAcc);
            $candidates[] = strtolower($noAcc);
        }
    }

    // Probar variantes basadas en el nombre del producto (ej: "Chuyo Andino Tradicional")
    if (!empty($nombre)) {
        $baseName = trim($nombre);
        $noAccName = $removeAccents($baseName);
        $candidates[] = $baseName;
        $candidates[] = str_replace(' ', '_', $baseName);
        $candidates[] = str_replace(' ', '-', $baseName);
        $candidates[] = strtolower($baseName);
        if ($noAccName !== $baseName) {
            $candidates[] = $noAccName;
            $candidates[] = str_replace(' ', '_', $noAccName);
            $candidates[] = str_replace(' ', '-', $noAccName);
            $candidates[] = strtolower($noAccName);
        }
        // también probar quitar palabras comunes y solo conservar la primera o dos palabras
        $parts = preg_split('/\s+/', $noAccName);
        if (count($parts) > 0) {
            $first = $parts[0];
            $candidates[] = $first;
            $candidates[] = strtolower($first);
        }
        if (count($parts) > 1) {
            $firstTwo = $parts[0] . '_' . $parts[1];
            $candidates[] = $firstTwo;
            $candidates[] = strtolower($firstTwo);
        }
    }

    $candidates[] = "producto_{$id}";
    $candidates[] = "producto-{$id}";
    $candidates[] = (string)$id;

    // Probar cada candidato con y sin extensiones
    foreach ($candidates as $c) {
        $c = trim($c);
        if ($c === '') continue;

        if (pathinfo($c, PATHINFO_EXTENSION) !== '') {
            $path = $imgDir . DIRECTORY_SEPARATOR . $c;
            if (file_exists($path)) return $relPrefix . rawurlencode(basename($path));
        } else {
            foreach ($extensions as $e) {
                $file = $c . '.' . $e;
                $path = $imgDir . DIRECTORY_SEPARATOR . $file;
                if (file_exists($path)) return $relPrefix . rawurlencode($file);
            }
        }
    }

    // buscar cualquier archivo que empiece con producto_{id}
    $glob = glob($imgDir . DIRECTORY_SEPARATOR . "producto_{$id}.*");
    if ($glob && count($glob) > 0) {
        return $relPrefix . rawurlencode(basename($glob[0]));
    }

    return $relPrefix . rawurlencode('placeholder.png');
}
