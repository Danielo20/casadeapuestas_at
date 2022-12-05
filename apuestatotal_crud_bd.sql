-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2022 at 07:51 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apuestatotal_crud_bd`
--

-- --------------------------------------------------------

--
-- Table structure for table `billetera`
--

CREATE TABLE `billetera` (
  `idbilletera` int(11) NOT NULL,
  `monto` decimal(6,0) NOT NULL DEFAULT 0,
  `idusuario` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `billetera`
--

INSERT INTO `billetera` (`idbilletera`, `monto`, `idusuario`, `created_at`) VALUES
(6, '300', 12, '2022-12-04 23:02:51'),
(7, '150', 13, '2022-12-05 06:36:18');

-- --------------------------------------------------------

--
-- Table structure for table `interaccion`
--

CREATE TABLE `interaccion` (
  `idinteraccion` int(11) NOT NULL,
  `idelemento` int(11) DEFAULT NULL,
  `idinteractuador` int(11) NOT NULL,
  `tipo` varchar(255) DEFAULT NULL,
  `motivo` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `interaccion`
--

INSERT INTO `interaccion` (`idinteraccion`, `idelemento`, `idinteractuador`, `tipo`, `motivo`, `fecha`) VALUES
(1, 2, 3, NULL, 'No se mostraba el medio bancario', '2022-12-05 02:58:40'),
(2, 3, 3, NULL, 'No se continuó con la operación', '2022-12-05 03:25:24'),
(3, 2, 3, 'Edicion de recarga', 'Error en el monto', '2022-12-05 03:28:44'),
(4, 2, 3, 'Edicion de recarga', 'Error en el banco', '2022-12-05 03:28:55'),
(5, 5, 3, 'Eliminacion de recarga', 'Borrado por vacio', '2022-12-05 03:29:14'),
(6, 2, 3, 'Edicion de recarga', 'ioioio', '2022-12-05 03:30:58'),
(7, 4, 3, 'Edicion de recarga', '6786', '2022-12-05 03:31:09'),
(8, 2, 3, 'Edicion de recarga', 'Ingreso de monto en la cuenta', '2022-12-05 03:53:17'),
(9, 2, 3, 'Edicion de recarga', 'asdasd', '2022-12-05 03:54:59'),
(10, 4, 3, 'Eliminacion de recarga', 'Borrar', '2022-12-05 04:01:17'),
(11, 2, 3, 'Edicion de recarga', '', '2022-12-05 06:06:20'),
(12, 6, 3, 'Edicion de recarga', 'Me equivoque, no era 250, era 150', '2022-12-05 06:07:51'),
(13, 7, 3, 'Edicion de recarga', 'Me equivoque', '2022-12-05 06:39:28');

-- --------------------------------------------------------

--
-- Table structure for table `recarga`
--

CREATE TABLE `recarga` (
  `idrecarga` int(11) NOT NULL,
  `monto` decimal(4,0) DEFAULT NULL,
  `mediobancario` varchar(255) DEFAULT NULL,
  `medioatencion` varchar(255) NOT NULL,
  `idbilletera` int(11) NOT NULL,
  `idpromotor` int(11) NOT NULL,
  `estado` int(1) NOT NULL DEFAULT 1 COMMENT '1=SOLICITADO,2=ATENDIDO,3=CANCELADO',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `recarga`
--

INSERT INTO `recarga` (`idrecarga`, `monto`, `mediobancario`, `medioatencion`, `idbilletera`, `idpromotor`, `estado`, `created_at`) VALUES
(1, NULL, NULL, 'WhatsApp', 6, 3, 1, '2022-12-05 01:09:48'),
(2, '150', 'Interbank', 'Telegram', 6, 3, 2, '2022-12-05 02:34:42'),
(3, NULL, NULL, 'WhatsApp', 6, 3, 3, '2022-12-05 02:34:50'),
(4, '678', 'Interbank', 'WhatsApp', 6, 3, 3, '2022-12-05 02:36:04'),
(5, NULL, NULL, 'Telegram', 6, 3, 3, '2022-12-05 02:36:09'),
(6, '150', 'Banco de Crédito del Perú (BCP)', 'WhatsApp', 6, 3, 2, '2022-12-05 06:06:51'),
(7, '150', 'Scotiabank', 'WhatsApp', 7, 3, 2, '2022-12-05 06:36:35'),
(8, NULL, NULL, 'WhatsApp', 7, 3, 1, '2022-12-05 06:40:18'),
(9, NULL, NULL, 'Telegram', 7, 3, 1, '2022-12-05 06:40:36'),
(10, NULL, NULL, 'WhatsApp', 7, 3, 1, '2022-12-05 06:40:40');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido_p` varchar(50) NOT NULL,
  `apellido_m` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `telefono` varchar(11) NOT NULL,
  `idusuariotipo` int(10) NOT NULL,
  `idbilletera` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nombre`, `apellido_p`, `apellido_m`, `password`, `correo`, `telefono`, `idusuariotipo`, `idbilletera`) VALUES
(1, 'Daniel', 'Loja', 'Mamani', '123123', 'jordanloja20@gmail.com', '952658675', 1, NULL),
(3, 'Paolo', 'Lizarraga', 'Morera', '123123', 'pmorera@gmail.com', '952867542', 2, NULL),
(12, 'Karim', 'Benzema', 'Mostafa', '123123', 'kbenzema@gmail.com', '123123123', 3, 6),
(13, 'Kevin', 'Loja', 'Mamani', '123123', 'kloja@gmail.com', '952848484', 3, 7);

-- --------------------------------------------------------

--
-- Table structure for table `usuariotipo`
--

CREATE TABLE `usuariotipo` (
  `idusuariotipo` int(4) NOT NULL,
  `tipo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `usuariotipo`
--

INSERT INTO `usuariotipo` (`idusuariotipo`, `tipo`) VALUES
(1, 'Administrador'),
(2, 'Promotor'),
(3, 'Cliente');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `billetera`
--
ALTER TABLE `billetera`
  ADD PRIMARY KEY (`idbilletera`),
  ADD KEY `idusuario_fk` (`idusuario`);

--
-- Indexes for table `interaccion`
--
ALTER TABLE `interaccion`
  ADD PRIMARY KEY (`idinteraccion`),
  ADD KEY `idusuariointeraccion_fk` (`idinteractuador`);

--
-- Indexes for table `recarga`
--
ALTER TABLE `recarga`
  ADD PRIMARY KEY (`idrecarga`),
  ADD KEY `idpromotor_fk` (`idpromotor`),
  ADD KEY `idbilleterarecarga_fk` (`idbilletera`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`),
  ADD KEY `idusuariotipo_fk` (`idusuariotipo`),
  ADD KEY `idbilletera_fk` (`idbilletera`);

--
-- Indexes for table `usuariotipo`
--
ALTER TABLE `usuariotipo`
  ADD PRIMARY KEY (`idusuariotipo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `billetera`
--
ALTER TABLE `billetera`
  MODIFY `idbilletera` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `interaccion`
--
ALTER TABLE `interaccion`
  MODIFY `idinteraccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `recarga`
--
ALTER TABLE `recarga`
  MODIFY `idrecarga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `usuariotipo`
--
ALTER TABLE `usuariotipo`
  MODIFY `idusuariotipo` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `billetera`
--
ALTER TABLE `billetera`
  ADD CONSTRAINT `idusuario_fk` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `interaccion`
--
ALTER TABLE `interaccion`
  ADD CONSTRAINT `idusuariointeraccion_fk` FOREIGN KEY (`idinteractuador`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `recarga`
--
ALTER TABLE `recarga`
  ADD CONSTRAINT `idbilleterarecarga_fk` FOREIGN KEY (`idbilletera`) REFERENCES `billetera` (`idbilletera`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `idpromotor_fk` FOREIGN KEY (`idpromotor`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `idbilletera_fk` FOREIGN KEY (`idbilletera`) REFERENCES `billetera` (`idbilletera`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `idusuariotipo_fk` FOREIGN KEY (`idusuariotipo`) REFERENCES `usuariotipo` (`idusuariotipo`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
