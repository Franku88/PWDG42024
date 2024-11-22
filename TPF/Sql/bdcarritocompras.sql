-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-11-2024 a las 22:24:31
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "-03:00";

-- Base de datos: `bdcarritocompras`
CREATE DATABASE `bdcarritocompras`;
-- --------------------------------------------------------

-- Selecciona la base de datos a usar:
USE `bdcarritocompras`;
-- --------------------------------------------------------

-- Estructura de tabla para la tabla `usuario`
CREATE TABLE `usuario` (
  `idusuario` bigint(20) NOT NULL AUTO_INCREMENT,
  `usnombre` varchar(50) NOT NULL,
  `uspass` varchar(32) NOT NULL,
  `usmail` varchar(256) NOT NULL,
  `usdeshabilitado` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idusuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
-- --------------------------------------------------------

-- Estructura de tabla para la tabla `producto`
CREATE TABLE `producto` (
  `idproducto` bigint(20) NOT NULL AUTO_INCREMENT,
  `pronombre` varchar(50) NOT NULL,
  `prodetalle` varchar(1024) NOT NULL,
  `procantstock` int(11) NOT NULL,
  `proprecio` DECIMAL(10, 2) NOT NULL,
  `prodeshabilitado` timestamp NULL DEFAULT NULL,
  `idvideoyt` varchar(11) NOT NULL DEFAULT 'dQw4w9WgXcQ',
  PRIMARY KEY (`idproducto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
-- --------------------------------------------------------

-- Estructura de tabla para la tabla `rol`
CREATE TABLE `rol` (
  `idrol` bigint(20) NOT NULL AUTO_INCREMENT,
  `rodescripcion` varchar(50) NOT NULL,
  PRIMARY KEY (`idrol`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
-- --------------------------------------------------------

-- Estructura de tabla para la tabla `compraestadotipo`
CREATE TABLE `compraestadotipo` (
  `idcompraestadotipo` int(11) NOT NULL AUTO_INCREMENT,
  `cetdescripcion` varchar(50) NOT NULL,
  `cetdetalle` varchar(256) NOT NULL,
  PRIMARY KEY (`idcompraestadotipo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
-- --------------------------------------------------------

-- Estructura de tabla para la tabla `compra`
CREATE TABLE `compra` (
  `idcompra` bigint(20) NOT NULL AUTO_INCREMENT,
  `cofecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `idusuario` bigint(20) NOT NULL,
  PRIMARY KEY(`idcompra`),
  FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
-- --------------------------------------------------------

-- Estructura de tabla para la tabla `compraestado`
CREATE TABLE `compraestado` (
  `idcompraestado` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `idcompra` bigint(11) NOT NULL,
  `idcompraestadotipo` int(11) NOT NULL,
  `cefechaini` timestamp NOT NULL DEFAULT current_timestamp(),
  `cefechafin` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idcompraestado`),
  FOREIGN KEY (`idcompra`) REFERENCES `compra` (`idcompra`) ON UPDATE CASCADE,
  FOREIGN KEY (`idcompraestadotipo`) REFERENCES `compraestadotipo` (`idcompraestadotipo`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
-- --------------------------------------------------------

-- Estructura de tabla para la tabla `compraitem`
CREATE TABLE `compraitem` (
  `idcompraitem` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `idproducto` bigint(20) NOT NULL,
  `idcompra` bigint(20) NOT NULL,
  `cicantidad` int(11) NOT NULL,
  PRIMARY KEY (`idcompraitem`),
  FOREIGN KEY (`idcompra`) REFERENCES `compra` (`idcompra`) ON UPDATE CASCADE,
  FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
-- --------------------------------------------------------

-- Estructura de tabla para la tabla `menu`
CREATE TABLE `menu` (
  `idmenu` bigint(20) NOT NULL AUTO_INCREMENT,
  `menombre` varchar(50) NOT NULL COMMENT 'Nombre del item del menu',
  `medescripcion` varchar(128) NOT NULL COMMENT 'Descripcion mas detallada del item del menu',
  `idpadre` bigint(20) DEFAULT NULL COMMENT 'Referencia al id del menu que es subitem',
  `medeshabilitado` timestamp NULL DEFAULT NULL COMMENT 'Fecha en la que el menu fue deshabilitado por ultima vez',
  PRIMARY KEY (`idmenu`),
  FOREIGN KEY (`idpadre`) REFERENCES `menu` (`idmenu`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
-- --------------------------------------------------------

-- Estructura de tabla para la tabla `menurol`
CREATE TABLE `menurol` (
  `idmenu` bigint(20) NOT NULL,
  `idrol` bigint(20) NOT NULL,
  PRIMARY KEY (`idmenu`,`idrol`),
  FOREIGN KEY (`idmenu`) REFERENCES `menu` (`idmenu`) ON UPDATE CASCADE,
  FOREIGN KEY (`idrol`) REFERENCES `rol` (`idrol`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
-- --------------------------------------------------------

-- Estructura de tabla para la tabla `usuariorol`
CREATE TABLE `usuariorol` (
  `idusuario` bigint(20) NOT NULL,
  `idrol` bigint(20) NOT NULL,
  PRIMARY KEY (`idusuario`,`idrol`),
  FOREIGN KEY (`idrol`) REFERENCES `rol` (`idrol`) ON UPDATE CASCADE,
  FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
-- --------------------------------------------------------

-- Volcado de datos para la tabla `compraestadotipo`
INSERT INTO `compraestadotipo` (`idcompraestadotipo`, `cetdescripcion`, `cetdetalle`) VALUES
(1, 'iniciada', 'cuando el usuario : cliente inicia la compra de uno o mas productos del carrito'),
(2, 'aceptada', 'cuando el usuario administrador da ingreso a uno de las compras en estado = 1 '),
(3, 'enviada', 'cuando el usuario administrador envia a uno de las compras en estado =2 '),
(4, 'cancelada', 'un usuario administrador podra cancelar una compra en cualquier estado y un usuario cliente solo en estado=1');
-- --------------------------------------------------------

-- Volcado de datos para la tabla `rol`
INSERT INTO `rol` (`idrol`, `rodescripcion`) VALUES
(1, 'Administrador'),
(2, 'Deposito'),
(3, 'Cliente');
-- --------------------------------------------------------

-- Volcado de datos para la tabla `menu`
INSERT INTO `menu` (`idmenu`, `menombre`, `medescripcion`, `idpadre`) VALUES
(1, 'Administrador', '#', NULL),
(2, 'Deposito', '#', NULL),
(3, 'Cliente', '#', NULL),
(4, 'Administrar Usuarios', 'administrarUsuarios', 1),
(5, 'Administrar Productos', 'administrarProductos', 2),
(6, 'Administrar Compras', 'administrarCompras', 2),
(7, 'Carrito', 'carrito', 3);
-- --------------------------------------------------------

-- Volcado de datos para la tabla `usuario`
INSERT INTO `usuario` (`idusuario`, `usnombre`, `uspass`, `usmail`, `usdeshabilitado`) VALUES
(1, 'admin', MD5('password'), 'admin@example.com', NULL),
(2, 'cliente1', MD5('password'), 'cliente1@example.com', NULL),
(3, 'deposito1', MD5('password'), 'deposito1@example.com', NULL);

-- Volcado de datos para la tabla `producto`
INSERT INTO `producto` (`idproducto`, `pronombre`, `prodetalle`, `procantstock`, `proprecio`, `prodeshabilitado`, `idvideoyt`) VALUES
(1, 'Counter Strike', 'Durante las dos últimas décadas, Counter-Strike ha proporcionado una experiencia competitiva de primer nivel para los millones de jugadores de todo el mundo que contribuyeron a darle forma. Ahora el próximo capítulo en la historia de CS está a punto de comenzar. Hablamos de Counter-Strike 2.',
10, 250.00, NULL, 'c80dVYcL69E'),
(2, 'Fallout 4', 'Bethesda Game Studios, el galardonado creador de Fallout 3 y The Elder Scrolls V: Skyrim, os da la bienvenida al mundo de Fallout 4, su juego más ambicioso hasta la fecha y la siguiente generación de mundos abiertos.', 
20, 45.00, NULL, 'XW7Of3g2JME'),
(3, 'Minecraft', 'Explora mundos generados al azar y construye cosas increíbles, desde las casas más sencillas hasta los castillos más grandiosos. Juega en modo creativo con recursos ilimitados o excava hasta las profundidades del mundo en el modo supervivencia, donde deberás fabricar armas y armaduras para defenderte de las criaturas peligrosas. Escala montañas escarpadas, explora cuevas complejas y extrae grandes vetas de minerales. Descubre los biomas de cuevas y espeleotemas fascinantes. ¡Ilumina tu mundo con velas para presumir tus habilidades de espeleología y montañismo!', 
30, 130.00, NULL, 'MmB9b5njVbA'),
(4, 'GTA VI', 'Grand Theft Auto VI pone rumbo al estado de Leonida, hogar de las calles rebosantes de neones de Vice City y sus alrededores, en la evolución más grande e inmersiva de la serie Grand Theft Auto hasta la fecha. Disponible en 2025 para PlayStation®5 y Xbox Series X|S.', 
0, 200.00, '2024-10-15 18:30:00', 'QdBZY2fkU-0'),
(5, 'Cruelty Squad', 'Un simulador de fantasía de poder inmersivo con elementos de sigilo táctico ambientado en un mundo de basura lleno de aguas residuales.', 
10, 19.99, NULL, 'CHm2d3wf8EU'),
(6, 'Dark Souls: Prepare To Die Edition', 'Dark Souls pondrá a prueba tu habilidad como pocos juegos este año: te pasarás días jugando ya que el nivel de dificultad es muy elevado.', 
5, 29.99, NULL, 'JUuljyLtA68'),
(7, 'Death Stranding Director''s Cut', 'El legendario creador de videojuegos Hideo Kojima nos ofrece una experiencia que desafía a todos los géneros y que, ahora, se amplía con este DIRECTOR’S CUT definitivo. En el futuro, un misterioso evento conocido como Death Stranding ha abierto una puerta entre los vivos y los muertos, lo que lleva a grotescas criaturas del otro mundo deambulen por un planeta en ruinas habitado por una sociedad desolada. En el papel de Sam Bridges, tendrás la misión de llevar esperanza a la humanidad conectando a los últimos supervivientes de unos Estados Unidos arrasados. ¿Podrás volver a unir, paso a paso, un mundo hecho añicos?', 
2, 39.99, NULL, 's2GUQcbz_8Q'),
(8, 'Dota 2', 'Cada día, millones de jugadores de todo el mundo entran en batalla como uno de los más de cien héroes de Dota. Y no importa si es su décima hora de juego o la milésima, siempre hay algo nuevo que descubrir.', 
5, 6.66, NULL, '-cSFPIwMEq4'),
(9, 'Garry''s Mod', 'Garry''s Mod es un sandbox de fisicas. No hay metas predefinidas. Nosotros te damos las herramientas y te dejamos jugar.', 
3, 9.99, NULL, 'kgXVLw6qpFM&t'),
(10, 'Hotline Miami', 'Hotline Miami es un juego de acción de alto octanaje que rebosa brutalidad es estado puro, violentos tiroteos y demoledores combates cuerpo a cuerpo.', 
2, 9.99, NULL, 'mg5s5Dq50Rg&t'),
(11, 'JoJo''s Bizarre Adventure: All-Star Battle R', 'La obra maestra de Hirohiko Araki cobra vida en este juego de lucha! ¡Combate contra 50 pintorescos luchadores usando Stands, Hamon y mucho más! ¡Descubre cómo interactúan personajes que no coinciden en la historia cuando se encuentran cara a cara!', 
8, 49.99, NULL, 'kikKUtGCEsg&t'),
(12, 'Mortal Kombat 11', 'Mortal Kombat ha regresado mejor que nunca en esta entrega de la icónica saga.', 
10, 49.99, NULL, 'UoTams2yc0s&t'),
(13, 'Portal 2', '¡La «Iniciativa de Prueba Perpetua» se ha ampliado, permitiéndote ahora diseñar puzles cooperativos para ti y tus amigos!', 
11, 9.99, NULL, 'tax4e4hBBZc'),
(14, 'Hatsune Miku: Project DIVA Mega Mix+', '¡Súbete al escenario del primer juego rítmico de Hatsune Miku protagonizado por la estrella pop virtual más famosa del mundo! Disfruta de la gira definitiva de Hatsune Miku. ¡Solo faltas tú!', 
3, 39.39, NULL, '7IqkUsbXdGA'),
(15, 'The Elder Scrolls V: Skyrim', 'El nuevo capítulo de la esperadísima saga Elder Scrolls llega de la mano de los creadores de los Juegos del Año 2006 y 2008, Bethesda Game Studios. Skyrim reinventa y el revoluciona el épico universo de fantasía, dando vida a un completo mundo virtual para que puedas explorarlo de la forma que quieras.', 
5, 19.99, NULL, 'JSRtYpNRoN0'),
(16, 'The Binding of Isaac: Rebirth', 'Cuando la madre de Isaac comienza a escuchar la voz de Dios exiguiendole que haga un sacrificio para probar su fe, Isaac escapa al sótano y se enfrenta a multitudes de enemigos trastornados, hermanos y hermanas perdidos, sus miedos y, finalmente, a su madre.', 
6, 14.99, NULL, 'j7yPmbNCP4I');

-- Volcado de datos para la tabla `compra`
INSERT INTO `compra` (`idcompra`, `cofecha`, `idusuario`) VALUES
(1, NOW(), 2),
(2, NOW(), 3);

-- Volcado de datos para la tabla `compraestado`
INSERT INTO `compraestado` (`idcompraestado`, `idcompra`, `idcompraestadotipo`, `cefechaini`, `cefechafin`) VALUES
(1, 1, 1, NOW(), NULL),
(2, 2, 1, NOW(), NULL);

-- Volcado de datos para la tabla `compraitem`
INSERT INTO `compraitem` (`idcompraitem`, `idproducto`, `idcompra`, `cicantidad`) VALUES
(1, 1, 1, 2),
(2, 2, 2, 1),
(3, 3, 2, 5);

-- Volcado de datos para la tabla `menurol`
INSERT INTO `menurol` (`idmenu`, `idrol`) VALUES
(1, 1), -- Administrador
(2, 2), -- Depósito
(3, 3); -- Cliente

-- Volcado de datos para la tabla `usuariorol`
INSERT INTO `usuariorol` (`idusuario`, `idrol`) VALUES
(1, 1), -- Admin
(2, 3), -- Cliente 1
(3, 2); -- Depósito 1