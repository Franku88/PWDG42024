CREATE DATABASE bd_prueba;

-- Seleccionar la base de datos para usarla
USE bd_prueba;

-- Crear la tabla 'menu'
CREATE TABLE menu (
    idmenu INT AUTO_INCREMENT PRIMARY KEY,
    menombre VARCHAR(100) NOT NULL,
    medescripcion TEXT,
    ObjMenu VARCHAR(100),
    medeshabilitado BOOLEAN DEFAULT FALSE,
    mensajeoperacion TEXT,
    idpadre INT
);