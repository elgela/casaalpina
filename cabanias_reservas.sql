-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-03-2026 a las 00:22:46
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cabanias_reservas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cabanias`
--

CREATE TABLE `cabanias` (
  `id_cabania` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `capacidad` int(11) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cabanias`
--

INSERT INTO `cabanias` (`id_cabania`, `nombre`, `capacidad`, `descripcion`, `precio`) VALUES
(1, 'Del Pinar', 4, 'Monoambiente amplio, con capacidad para alojar 2 a 4 personas.\r\n\r\nMuy confortable construcción, con todas sus instalaciones en planta baja, con ladrillo vista exterior e interior.- Tiene 58 mts2 de superficie habitable y todos sus pisos en un mismo nivel. Posee grandes ventanales y puertas-balcón vidriadas, que le otorgan una gran luminosidad interior.\r\n\r\nCochera individual adjunta, con parrilla individual, deck de madera con mesa, sillas y sombrilla con vista a los jardines del predio.\r\n\r\nEn su interior:\r\n\r\nAire Acondicionado frio calor Split.\r\nCama sommiers a resortes de dos plazas y media.\r\nSofacama de una plaza con cama debajo, también de una plaza.\r\nHogar a leña\r\nHeladera familiar - Anafe de 2 hornallas - Microoondas. \r\nVajilla completa.\r\nTv Smart de 40\".\r\nDirecTV.\r\nLuz de emergencia\r\nDisyuntor diferencial.\r\nDucha presurizada.\r\nTermotanque individual', 162423.80),
(2, 'Del Solar', 5, 'Hermosa construcción de dos plantas, con capacidad para alojar 2 a 5 personas.\r\n\r\n \r\n\r\nGran cabaña de 79 mts2 de superficie habitable entre sus dos plantas.\r\n\r\nEn la planta alta tiene un amplio dormitorio, donde se ubican una cama sommiers de 2 plazas y media y una cama de una plaza.\r\n\r\nEn la planta baja : Sala de Estar, donde se ubican un sofacama de una plaza y otra cama desplazable de una plaza. Comedor diario, cocina y baño completo.\r\n\r\nDeck techado de madera, con mesa, sillas y vista panorámica a los jardines del predio.\r\n\r\nCochera techada individual y adjunta a la cabaña. Parrilla individual.\r\n\r\n \r\n\r\nEn su interior :\r\n\r\n \r\n\r\nEquipo de Aire Acondicionado inverter frío-calor en cada planta\r\nHogar a leña\r\nHeladera familiar.\r\nTV Led de 50\"\r\nDirectv \r\nChromecast\r\nAnafe de 2 hornallas.\r\nVajilla completa.\r\nTermotanque individual.\r\nMicroondas.\r\nLuz de emergencia\r\nDisyuntor diferencial.', 177189.60),
(3, 'Del Puente', 2, 'Espléndida y moderna construcción, monoambiente, ideal para 2 personas, o bien para pareja con bebé...\r\n\r\n \r\n\r\nPosee 38 mts2 de superficie habitable, con todas sus instalaciones en planta baja.\r\n\r\nY un hermoso Deck techado, de madera, con un muy pintoresco puente de madera exclusivo para la cabaña, con rosales en su pérgola...\r\n\r\nCochera individual y adjunta, protegida por la frondosa copa de dos acacias.\r\n\r\nParrilla individual.\r\n\r\n \r\n\r\nEn su interior :\r\n\r\n \r\n\r\nEquipo Split de aire acondicionado inverter frío - calor.\r\nCama sommiers de 2 plazas.\r\nSalamandra a leña.\r\nHeladera familiar.\r\nAnafe de 2 hornallas.\r\nTermotanque individual.\r\nMicroondas.\r\nVajilla completa.\r\nTV Led de 32\" \r\nDirectv\r\nChromecast.\r\nLuz de emergencia\r\nDisyuntor diferencial.', 147658.00),
(4, 'Casagrande', 6, 'Tiene capacidad para alojar 3 a 6 personas. Posee dos plantas, ideal para un grupo familiar grande o para dos familias.\r\n\r\n \r\n\r\nEs una magnífica construcción de estilo alpino, con 103 mts2 de superficie habitable, y con finas maderas en su interior.\r\n\r\nTiene dos dormitorios de gran categoría en su planta alta.\r\n\r\nEn planta baja: Sala de Estar con sillones de algarrobo, comedor diario, cocina y baño completo ; deck de madera techado con mesa y sillas... y vista panorámica al jardín del predio y a las serranías cercanas.\r\n\r\nTiene cochera adjunta techada e individual, y parrilla techada familiar, con amplia mesada.\r\n\r\n \r\n\r\n En su interior:\r\n\r\n \r\n\r\n2 equipos Splits de Aire Acondicionado Inverter frio calor (uno en cada planta).\r\nAmplios placares.\r\n3 Camas sommier de 2 plazas\r\nSalamandra de hierro\r\nHeladera con freezer\r\nCocina con horno industrial\r\nMicrooondas \r\nVajilla completa.\r\nTv Led de 32\" en Sala de Estar y Habitación\r\nDirecTV\r\nChromecast\r\nLuz de emergencia\r\nDisyuntor diferencial.\r\nDucha presurizada.\r\nTermotanque individual de 120 ltrs.', 191955.40);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `id_persona` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `apellido` varchar(100) DEFAULT NULL,
  `dni` char(8) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`id_persona`, `nombre`, `apellido`, `dni`, `email`, `telefono`) VALUES
(1, 'Marcelo', 'Gelato', '28178636', 'gelatomarcelo@hotmail.com', '2494357255'),
(2, 'Abby', 'Gelato', '1', 'abby@turesponsive.com.ar', '2494357255'),
(3, 'Luli', 'Coronas', '2', 'luli@turesponsive.com.ar', '2494357255'),
(4, 'Leo', 'Gelato', '26174102', 'lgelato@hotmail.com', '2494656882');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `id_reserva` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `id_cabania` int(11) NOT NULL,
  `adultos` int(11) NOT NULL,
  `menores` int(11) NOT NULL,
  `bebes` tinyint(1) NOT NULL,
  `fecha_ingreso` datetime NOT NULL,
  `fecha_egreso` datetime NOT NULL,
  `valor` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`id_reserva`, `id_persona`, `id_cabania`, `adultos`, `menores`, `bebes`, `fecha_ingreso`, `fecha_egreso`, `valor`) VALUES
(1, 1, 1, 1, 0, 0, '2026-01-20 10:00:00', '2026-01-25 14:00:00', 532698.00),
(2, 2, 4, 0, 0, 0, '2026-01-25 10:00:00', '2026-02-14 14:00:00', 1365247.00),
(3, 1, 2, 0, 0, 0, '2026-03-01 10:00:00', '2026-03-05 14:00:00', 432896.00),
(4, 4, 4, 2, 0, 0, '2026-01-22 10:00:00', '2026-01-23 14:00:00', 210365.00),
(5, 2, 3, 1, 0, 0, '2026-01-21 10:00:00', '2026-01-23 14:00:00', 254698.00),
(6, 4, 2, 2, 0, 1, '2026-01-20 10:00:00', '2026-01-22 14:00:00', 247963.00),
(13, 3, 3, 1, 0, 0, '2026-01-24 10:00:00', '2026-01-26 14:00:00', 254698.00),
(17, 1, 4, 3, 2, 1, '2026-02-15 00:00:00', '2026-02-21 00:00:00', 3875962.00);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cabanias`
--
ALTER TABLE `cabanias`
  ADD PRIMARY KEY (`id_cabania`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`id_persona`),
  ADD UNIQUE KEY `unique_dni` (`dni`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id_reserva`),
  ADD KEY `fk_reservas_personas` (`id_persona`),
  ADD KEY `fk_reservas_cabanas` (`id_cabania`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cabanias`
--
ALTER TABLE `cabanias`
  MODIFY `id_cabania` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id_reserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `fk_reservas_cabanas` FOREIGN KEY (`id_cabania`) REFERENCES `cabanias` (`id_cabania`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_reservas_personas` FOREIGN KEY (`id_persona`) REFERENCES `personas` (`id_persona`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
