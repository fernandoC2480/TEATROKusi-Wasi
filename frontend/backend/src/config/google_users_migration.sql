-- Script para asegurar que la tabla usuarios tiene las columnas necesarias
-- Ejecutar si la tabla usuarios ya existe pero falta alguna columna

-- Verificar y agregar columnas si no existen
-- Esta es la estructura correcta para soportar OAuth con Google

ALTER TABLE usuarios 
ADD COLUMN IF NOT EXISTS google_id VARCHAR(255) UNIQUE COMMENT 'ID único de Google';

-- Hacer que la contraseña sea nullable para usuarios que se registran solo con OAuth
-- Descomentar la siguiente línea si necesitas permitir contraseña nula:
-- ALTER TABLE usuarios MODIFY COLUMN contraseña VARCHAR(255) NULL;

-- Crear índice en email para búsquedas más rápidas
ALTER TABLE usuarios ADD INDEX IF NOT EXISTS idx_email (email);

-- Ver la estructura actual (para verificar)
DESCRIBE usuarios;
