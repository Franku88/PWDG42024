-- phpMyAdmin SQL Dump
-- version 2.8.1
-- http://www.phpmyadmin.net
-- 
-- Servidor: localhost
-- Tiempo de generación: 17-08-2012 a las 00:43:05
-- Versión del servidor: 5.0.21
-- Versión de PHP: 5.1.4
-- 
-- Base de datos: `bdautenticacion`
-- Recordar que si realiza manualmente, crear perimero usuario, luego rol y finalmente usuariorol

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `usuario`
-- 

CREATE TABLE ('usuario') (
  `idusuario` bigint(20) NOT NULL auto_increment,
  `usnombre` varchar(50) NOT NULL,
  `uspass` int(11) NOT NULL,
  `usmail` varchar(50) NOT NULL,
  'usdesabilitado' timestamp,
  PRIMARY KEY  (`idUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `rol`
-- 

CREATE TABLE ('rol') (
    'idrol' bigint(20) NOT NULL auto_increment,
    'roldescripcion' varchar(50) NOT NULL,
)

-- --------------------------------------------------------

CREATE TABLE ('usuariorol') (
    idusuario bigint(20) NOT NULL,
    idrol bigint(20) NOT NULL,
    PRIMARY KEY  (idusuario,idrol)
    FOREIGN KEY (idusuario) REFERENCES usuario(idusuario),
    FOREIGN KEY (idrol) REFERENCES rol(idrol)
)



