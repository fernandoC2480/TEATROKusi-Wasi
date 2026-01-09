-- Base de datos para Teatro Andino Kusi-Wasi
-- Crear base de datos
CREATE DATABASE IF NOT EXISTS bdkusiwasi;
USE bdkusiwasi;

-- Tabla de usuarios (administradores)
CREATE TABLE usuarios (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    contraseña VARCHAR(255) NOT NULL,
    rol ENUM('admin', 'moderador') DEFAULT 'moderador',
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    estado BOOLEAN DEFAULT TRUE
);

-- Tabla de categorías de productos
CREATE TABLE categorias_tienda (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de productos (tienda)
CREATE TABLE productos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(150) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10, 2) NOT NULL,
    categoria_id INT NOT NULL,
    imagen VARCHAR(255),
    stock INT DEFAULT 0,
    estado BOOLEAN DEFAULT TRUE,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (categoria_id) REFERENCES categorias_tienda(id)
);

-- Tabla de eventos/cartelera
CREATE TABLE eventos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    titulo VARCHAR(200) NOT NULL,
    descripcion TEXT,
    fecha_evento DATETIME NOT NULL,
    lugar VARCHAR(200),
    precio DECIMAL(10, 2),
    imagen VARCHAR(255),
    aforo INT,
    entradas_disponibles INT,
    estado BOOLEAN DEFAULT TRUE,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de reservas/entradas
CREATE TABLE reservas (
    id INT PRIMARY KEY AUTO_INCREMENT,
    evento_id INT NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    telefono VARCHAR(20),
    cantidad_entradas INT NOT NULL,
    total DECIMAL(10, 2),
    estado ENUM('pendiente', 'confirmada', 'cancelada') DEFAULT 'pendiente',
    fecha_reserva TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (evento_id) REFERENCES eventos(id)
);

-- Tabla de talleres
CREATE TABLE talleres (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(150) NOT NULL,
    descripcion TEXT,
    tipo ENUM('música', 'teatro', 'otros') NOT NULL,
    instructor VARCHAR(100),
    horario VARCHAR(100),
    duracion VARCHAR(50),
    precio DECIMAL(10, 2),
    imagen VARCHAR(255),
    aforo INT,
    estado BOOLEAN DEFAULT TRUE,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de inscripciones a talleres
CREATE TABLE inscripciones_talleres (
    id INT PRIMARY KEY AUTO_INCREMENT,
    taller_id INT NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    telefono VARCHAR(20),
    estado ENUM('pendiente', 'confirmada', 'cancelada') DEFAULT 'pendiente',
    fecha_inscripcion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (taller_id) REFERENCES talleres(id)
);

-- Tabla de galería de imágenes
CREATE TABLE galeria (
    id INT PRIMARY KEY AUTO_INCREMENT,
    titulo VARCHAR(150),
    descripcion TEXT,
    imagen VARCHAR(255) NOT NULL,
    categoria VARCHAR(100),
    fecha_carga TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de contactos
CREATE TABLE contactos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    telefono VARCHAR(20),
    asunto VARCHAR(200),
    mensaje TEXT NOT NULL,
    leido BOOLEAN DEFAULT FALSE,
    fecha_envio TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de información general (misión, visión, etc)
CREATE TABLE informacion_general (
    id INT PRIMARY KEY AUTO_INCREMENT,
    tipo VARCHAR(50) NOT NULL,
    contenido TEXT NOT NULL,
    fecha_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabla de carrito de compras
CREATE TABLE carrito (
    id INT PRIMARY KEY AUTO_INCREMENT,
    sesion_id VARCHAR(255) NOT NULL,
    producto_id INT NOT NULL,
    cantidad INT NOT NULL DEFAULT 1,
    fecha_agregado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (producto_id) REFERENCES productos(id)
);

-- Tabla de pedidos
CREATE TABLE pedidos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre_cliente VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    telefono VARCHAR(20),
    direccion TEXT,
    total DECIMAL(10, 2) NOT NULL,
    estado ENUM('pendiente', 'pagado', 'enviado', 'entregado', 'cancelado') DEFAULT 'pendiente',
    fecha_pedido TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de detalles de pedidos
CREATE TABLE detalles_pedido (
    id INT PRIMARY KEY AUTO_INCREMENT,
    pedido_id INT NOT NULL,
    producto_id INT NOT NULL,
    cantidad INT NOT NULL,
    precio_unitario DECIMAL(10, 2) NOT NULL,
    subtotal DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (pedido_id) REFERENCES pedidos(id),
    FOREIGN KEY (producto_id) REFERENCES productos(id)
);

-- Índices para mejorar rendimiento
CREATE INDEX idx_eventos_fecha ON eventos(fecha_evento);
CREATE INDEX idx_productos_categoria ON productos(categoria_id);
CREATE INDEX idx_reservas_evento ON reservas(evento_id);
CREATE INDEX idx_reservas_email ON reservas(email);
CREATE INDEX idx_contactos_leido ON contactos(leido);
CREATE INDEX idx_usuarios_email ON usuarios(email);

-- Insertar categorías de tienda por defecto
INSERT INTO categorias_tienda (nombre, descripcion) VALUES
('Vestuario', 'Trajes y ropa del teatro'),
('Accesorios', 'Accesorios varios del teatro'),
('Libros y Programas', 'Libros, programas de funciones'),
('Souvenirs', 'Recuerdos y souvenirs');

-- Insertar información general por defecto
INSERT INTO informacion_general (tipo, contenido) VALUES
('mision', 'Difundir la cultura teatral andina a través de funciones de calidad'),
('vision', 'Ser referente cultural del teatro andino en la región'),
('telefono', '+51 XXXXXXXXX'),
('email', 'info@teatroandino.com'),
('direccion', 'Dirección del teatro');

-- Asignar nombres de archivo de imagen a los productos de ejemplo (si ya fueron insertados)
UPDATE productos SET imagen = 'chuyo_andino.svg' WHERE nombre = 'Chuyo Andino Tradicional';
UPDATE productos SET imagen = 'camisa_andina.svg' WHERE nombre = 'Camisa Andina Tejida';
UPDATE productos SET imagen = 'poncho_tradicional.svg' WHERE nombre = 'Poncho Tradicional';
UPDATE productos SET imagen = 'faja_andina.svg' WHERE nombre = 'Faja Andina Bordada';
UPDATE productos SET imagen = 'cinturon_cuero.svg' WHERE nombre = 'Cinturón de Cuero Andino';

-- Insertar productos de ejemplo
INSERT INTO productos (nombre, descripcion, precio, categoria_id, stock, estado) VALUES
('Chuyo Andino Tradicional', 'Gorro de lana tradicional andino, tejido a mano con diseños autóctonos. Mantiene el calor y es perfecto como recuerdo de la cultura andina.', 45.00, 1, 15, TRUE),
('Camisa Andina Tejida', 'Camisa tradicional andina con bordados y diseños típicos de la región. Confeccionada en algodón de alta calidad.', 89.99, 1, 12, TRUE),
('Poncho Tradicional', 'Poncho de lana pura, tejido artesanalmente. Ideal para eventos especiales y como prenda representativa de la cultura andina.', 150.00, 1, 8, TRUE),
('Faja Andina Bordada', 'Faja tradicional con bordados característicos andinos. Se usa junto con trajes típicos para eventos culturales.', 35.50, 2, 20, TRUE),
('Cinturón de Cuero Andino', 'Cinturón de cuero trabajado con elementos andinos y acabados artesanales. Complemeto perfecto para cualquier atuendo tradicional.', 55.00, 2, 10, TRUE);
