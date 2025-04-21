CREATE SCHEMA IF NOT EXISTS catalogo_digital_tiendita_pm;
USE catalogo_digital_tiendita_pm;

CREATE TABLE IF NOT EXISTS accion (
    id_accion INT UNSIGNED NOT NULL AUTO_INCREMENT,
    nombre_accion INT UNSIGNED NOT NULL,
    PRIMARY KEY (id_accion)
);

CREATE TABLE IF NOT EXISTS administrador (
    id_admin INT UNSIGNED NOT NULL AUTO_INCREMENT,
    nombre_admin VARCHAR(50) NOT NULL,
    correo_admin VARCHAR(100) NOT NULL,
    pwd VARCHAR(255) NOT NULL,
    activo BOOLEAN NULL DEFAULT 0,
    PRIMARY KEY (id_admin)
);

CREATE TABLE IF NOT EXISTS categoria (
    id_categoria INT UNSIGNED NOT NULL AUTO_INCREMENT,
    nombre_categoria VARCHAR(250) NOT NULL,
    descripcion_categoria TEXT,
    PRIMARY KEY (id_categoria)
);

CREATE TABLE IF NOT EXISTS configuracion (
    id_config INT UNSIGNED NOT NULL,
    numero_whatsapp VARCHAR(20) NOT NULL,
    nombre_tienda VARCHAR(100) NOT NULL,
    seo_keywords VARCHAR(250) NULL,
    seo_descriptions TEXT,
    PRIMARY KEY (id_config)
);

CREATE TABLE IF NOT EXISTS estado (
    id_estado INT UNSIGNED NOT NULL AUTO_INCREMENT,
    nombre_estado VARCHAR(250) NOT NULL,
    PRIMARY KEY (id_estado)
);

CREATE TABLE IF NOT EXISTS producto (
    id_producto INT UNSIGNED NOT NULL AUTO_INCREMENT,
    nombre_producto VARCHAR(250) NOT NULL,
    descripcion TEXT,
    stock_actual INT UNSIGNED NULL DEFAULT '0',
    precio DECIMAL(12,2) NOT NULL DEFAULT '0.00',
    imagen_url VARCHAR(500) NULL,
    id_estado INT UNSIGNED NOT NULL,
    id_categoria INT UNSIGNED NOT NULL,
    PRIMARY KEY (id_producto),
    CONSTRAINT producto_ibfk_1
        FOREIGN KEY (id_estado)
        REFERENCES estado(id_estado),
    CONSTRAINT producto_ibfk_2
        FOREIGN KEY (id_categoria)
        REFERENCES categoria(id_categoria)
);

CREATE TABLE IF NOT EXISTS registro (
    id_registro INT UNSIGNED NOT NULL AUTO_INCREMENT,
    fecha_hora DATETIME NOT NULL,
    id_accion INT UNSIGNED NOT NULL,
    id_producto INT UNSIGNED NOT NULL,
    id_admin INT UNSIGNED NOT NULL,
    PRIMARY KEY (id_registro),
    CONSTRAINT registro_ibfk_1
        FOREIGN KEY (id_accion)
        REFERENCES accion(id_accion),
    CONSTRAINT registro_ibfk_2
        FOREIGN KEY (id_producto)
        REFERENCES producto(id_producto),
    CONSTRAINT registro_ibfk_3
        FOREIGN KEY (id_admin)
        REFERENCES administrador(id_admin)
);
