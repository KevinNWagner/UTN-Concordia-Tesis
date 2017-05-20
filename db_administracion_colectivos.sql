-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-05-2017 a las 20:23:58
-- Versión del servidor: 10.1.16-MariaDB
-- Versión de PHP: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_administracion_colectivos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carteleras`
--

CREATE TABLE `carteleras` (
  `idCarteleras` int(11) NOT NULL,
  `horaInicio` time NOT NULL,
  `horaFin` time NOT NULL,
  `cantidadPersonas` int(11) NOT NULL,
  `duracionRecorrido` time NOT NULL,
  `descripcion` varchar(50) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `carteleras`
--

INSERT INTO `carteleras` (`idCarteleras`, `horaInicio`, `horaFin`, `cantidadPersonas`, `duracionRecorrido`, `descripcion`) VALUES
(1, '06:30:00', '23:30:00', 6000, '01:10:00', 'Dia Normal'),
(2, '06:30:00', '23:20:00', 2000, '01:10:00', 'Dia lluvioso'),
(3, '06:30:00', '00:50:00', 4000, '01:00:00', 'Sabado y Domingo'),
(4, '09:00:00', '10:00:00', 2000, '01:00:00', 'Feriado');

--
-- Disparadores `carteleras`
--
DELIMITER $$
CREATE TRIGGER `a_d_carteleras` AFTER DELETE ON `carteleras` FOR EACH ROW BEGIN						SET @time_mark = DATE_ADD(NOW(), INTERVAL 0 SECOND); 						SET @tbl_name = 'carteleras';						SET @pk_d = CONCAT('<idCarteleras>',OLD.`idCarteleras`,'</idCarteleras>');						SET @rec_state = 3;						SET @rs = 0;						SELECT `record_state` INTO @rs FROM `history_store` WHERE  `table_name` = @tbl_name AND `pk_date_src` = @pk_d;						DELETE FROM `history_store` WHERE `table_name` = @tbl_name AND `pk_date_src` = @pk_d; 						IF @rs <> 1 THEN 						INSERT INTO `history_store`( `timemark`, `table_name`, `pk_date_src`,`pk_date_dest`, `record_state` ) VALUES (@time_mark, @tbl_name, @pk_d,@pk_d, @rec_state ); 						END IF; END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `a_i_carteleras` AFTER INSERT ON `carteleras` FOR EACH ROW BEGIN 						SET @time_mark = DATE_ADD(NOW(), INTERVAL 0 SECOND); 						SET @tbl_name = 'carteleras'; 						SET @pk_d = CONCAT('<idCarteleras>',NEW.`idCarteleras`,'</idCarteleras>'); 						SET @rec_state = 1;						DELETE FROM `history_store` WHERE `table_name` = @tbl_name AND `pk_date_src` = @pk_d; 						INSERT INTO `history_store`( `timemark`, `table_name`, `pk_date_src`,`pk_date_dest`,`record_state` ) 						VALUES (@time_mark, @tbl_name, @pk_d, @pk_d, @rec_state); 						END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `a_u_carteleras` AFTER UPDATE ON `carteleras` FOR EACH ROW BEGIN						SET @time_mark = DATE_ADD(NOW(), INTERVAL 0 SECOND); 						SET @tbl_name = 'carteleras';						SET @pk_d_old = CONCAT('<idCarteleras>',OLD.`idCarteleras`,'</idCarteleras>');						SET @pk_d = CONCAT('<idCarteleras>',NEW.`idCarteleras`,'</idCarteleras>');						SET @rec_state = 2;						SET @rs = 0;						SELECT `record_state` INTO @rs FROM `history_store` WHERE `table_name` = @tbl_name AND `pk_date_src` = @pk_d_old;						IF @rs = 0 THEN 						INSERT INTO `history_store`( `timemark`, `table_name`, `pk_date_src`,`pk_date_dest`, `record_state` ) VALUES (@time_mark, @tbl_name, @pk_d,@pk_d_old, @rec_state );						ELSE 						UPDATE `history_store` SET `timemark` = @time_mark, `pk_date_src` = @pk_d WHERE `table_name` = @tbl_name AND `pk_date_src` = @pk_d_old;						END IF; END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colectivos`
--

CREATE TABLE `colectivos` (
  `idColectivos` int(11) NOT NULL,
  `marca` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `modelo` int(4) DEFAULT NULL,
  `matricula` varchar(45) CHARACTER SET utf8 NOT NULL,
  `posicionLatitud` float DEFAULT NULL,
  `posicionLongitud` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `colectivos`
--

INSERT INTO `colectivos` (`idColectivos`, `marca`, `modelo`, `matricula`, `posicionLatitud`, `posicionLongitud`) VALUES
(1, 'TATSA', 1995, 'TJL 421', 0, 0),
(2, 'Dimex', 1996, 'KVT 467', 0, 0),
(3, 'TATSA', 2001, 'TFA 235', 0, 0),
(4, 'VW', 2000, 'ABO 718', 0, 0),
(5, 'Agrale', 1995, 'PVX 953', 0, 0),
(6, 'Volvo', 1992, 'VJV 614', 0, 0),
(7, 'Agrale', 1996, 'HIF 630', 0, 0),
(8, 'Volvo', 1998, 'KNM 544', 0, 0),
(9, 'Agrale', 2001, 'NWD 945', 0, 0),
(10, 'TATSA', 1998, 'TMH 678', 0, 0),
(11, 'VW', 2001, 'VJI 117', 0, 0),
(12, 'TATSA', 1998, 'ZCJ 778', 0, 0),
(13, 'Dimex', 1993, 'VGB 242', 0, 0),
(14, 'Mercedes Benz', 1992, 'AVZ 588', 0, 0),
(15, 'VW', 2000, 'YGY 791', 0, 0),
(16, 'Agrale', 1994, 'STP 112', 0, 0),
(17, 'Mercedes Benz', 1994, 'ROL 440', 0, 0),
(18, 'Scania', 2001, 'EAP 124', 0, 0),
(19, 'Volvo', 1993, 'XBJ 019', 0, 0),
(20, 'Scania', 1999, 'VGS 583', 0, 0),
(21, 'Dimex', 1999, 'NWQ 254', 0, 0),
(22, 'VW', 1995, 'XLT 848', 0, 0),
(23, 'Agrale', 2001, 'XFP 088', 0, 0),
(24, 'Volvo', 1994, 'PVA 344', 0, 0),
(25, 'Volvo', 1993, 'SAV 252', 0, 0),
(26, 'VW', 2000, 'LXW 267', 0, 0),
(27, 'TATSA', 2001, 'WUH 669', 0, 0),
(28, 'TATSA', 1992, 'RUR 233', 0, 0),
(29, 'Agrale', 2001, 'GYI 663', 0, 0),
(30, 'Scania', 2000, 'MSX 069', 0, 0),
(31, 'TATSA', 1996, 'AFW 412', 0, 0),
(32, 'Agrale', 1994, 'FBH 801', 0, 0),
(33, 'Mercedes Benz', 1999, 'XHC 103', 0, 0),
(34, 'Mercedes Benz', 1995, 'AGJ 721', 0, 0);

--
-- Disparadores `colectivos`
--
DELIMITER $$
CREATE TRIGGER `a_d_colectivos` AFTER DELETE ON `colectivos` FOR EACH ROW BEGIN						SET @time_mark = DATE_ADD(NOW(), INTERVAL 0 SECOND); 						SET @tbl_name = 'colectivos';						SET @pk_d = CONCAT('<idColectivos>',OLD.`idColectivos`,'</idColectivos>');						SET @rec_state = 3;						SET @rs = 0;						SELECT `record_state` INTO @rs FROM `history_store` WHERE  `table_name` = @tbl_name AND `pk_date_src` = @pk_d;						DELETE FROM `history_store` WHERE `table_name` = @tbl_name AND `pk_date_src` = @pk_d; 						IF @rs <> 1 THEN 						INSERT INTO `history_store`( `timemark`, `table_name`, `pk_date_src`,`pk_date_dest`, `record_state` ) VALUES (@time_mark, @tbl_name, @pk_d,@pk_d, @rec_state ); 						END IF; END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `a_i_colectivos` AFTER INSERT ON `colectivos` FOR EACH ROW BEGIN 						SET @time_mark = DATE_ADD(NOW(), INTERVAL 0 SECOND); 						SET @tbl_name = 'colectivos'; 						SET @pk_d = CONCAT('<idColectivos>',NEW.`idColectivos`,'</idColectivos>'); 						SET @rec_state = 1;						DELETE FROM `history_store` WHERE `table_name` = @tbl_name AND `pk_date_src` = @pk_d; 						INSERT INTO `history_store`( `timemark`, `table_name`, `pk_date_src`,`pk_date_dest`,`record_state` ) 						VALUES (@time_mark, @tbl_name, @pk_d, @pk_d, @rec_state); 						END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `a_u_colectivos` AFTER UPDATE ON `colectivos` FOR EACH ROW BEGIN						SET @time_mark = DATE_ADD(NOW(), INTERVAL 0 SECOND); 						SET @tbl_name = 'colectivos';						SET @pk_d_old = CONCAT('<idColectivos>',OLD.`idColectivos`,'</idColectivos>');						SET @pk_d = CONCAT('<idColectivos>',NEW.`idColectivos`,'</idColectivos>');						SET @rec_state = 2;						SET @rs = 0;						SELECT `record_state` INTO @rs FROM `history_store` WHERE `table_name` = @tbl_name AND `pk_date_src` = @pk_d_old;						IF @rs = 0 THEN 						INSERT INTO `history_store`( `timemark`, `table_name`, `pk_date_src`,`pk_date_dest`, `record_state` ) VALUES (@time_mark, @tbl_name, @pk_d,@pk_d_old, @rec_state );						ELSE 						UPDATE `history_store` SET `timemark` = @time_mark, `pk_date_src` = @pk_d WHERE `table_name` = @tbl_name AND `pk_date_src` = @pk_d_old;						END IF; END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cronogramas`
--

CREATE TABLE `cronogramas` (
  `idCronogramas` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `Carteleras_idCarteleras` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cronogramas`
--

INSERT INTO `cronogramas` (`idCronogramas`, `fecha`, `Carteleras_idCarteleras`) VALUES
(101, '2017-04-01', 1);

--
-- Disparadores `cronogramas`
--
DELIMITER $$
CREATE TRIGGER `a_d_cronogramas` AFTER DELETE ON `cronogramas` FOR EACH ROW BEGIN						SET @time_mark = DATE_ADD(NOW(), INTERVAL 0 SECOND); 						SET @tbl_name = 'cronogramas';						SET @pk_d = CONCAT('<idCronogramas>',OLD.`idCronogramas`,'</idCronogramas>');						SET @rec_state = 3;						SET @rs = 0;						SELECT `record_state` INTO @rs FROM `history_store` WHERE  `table_name` = @tbl_name AND `pk_date_src` = @pk_d;						DELETE FROM `history_store` WHERE `table_name` = @tbl_name AND `pk_date_src` = @pk_d; 						IF @rs <> 1 THEN 						INSERT INTO `history_store`( `timemark`, `table_name`, `pk_date_src`,`pk_date_dest`, `record_state` ) VALUES (@time_mark, @tbl_name, @pk_d,@pk_d, @rec_state ); 						END IF; END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `a_i_cronogramas` AFTER INSERT ON `cronogramas` FOR EACH ROW BEGIN 						SET @time_mark = DATE_ADD(NOW(), INTERVAL 0 SECOND); 						SET @tbl_name = 'cronogramas'; 						SET @pk_d = CONCAT('<idCronogramas>',NEW.`idCronogramas`,'</idCronogramas>'); 						SET @rec_state = 1;						DELETE FROM `history_store` WHERE `table_name` = @tbl_name AND `pk_date_src` = @pk_d; 						INSERT INTO `history_store`( `timemark`, `table_name`, `pk_date_src`,`pk_date_dest`,`record_state` ) 						VALUES (@time_mark, @tbl_name, @pk_d, @pk_d, @rec_state); 						END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `a_u_cronogramas` AFTER UPDATE ON `cronogramas` FOR EACH ROW BEGIN						SET @time_mark = DATE_ADD(NOW(), INTERVAL 0 SECOND); 						SET @tbl_name = 'cronogramas';						SET @pk_d_old = CONCAT('<idCronogramas>',OLD.`idCronogramas`,'</idCronogramas>');						SET @pk_d = CONCAT('<idCronogramas>',NEW.`idCronogramas`,'</idCronogramas>');						SET @rec_state = 2;						SET @rs = 0;						SELECT `record_state` INTO @rs FROM `history_store` WHERE `table_name` = @tbl_name AND `pk_date_src` = @pk_d_old;						IF @rs = 0 THEN 						INSERT INTO `history_store`( `timemark`, `table_name`, `pk_date_src`,`pk_date_dest`, `record_state` ) VALUES (@time_mark, @tbl_name, @pk_d,@pk_d_old, @rec_state );						ELSE 						UPDATE `history_store` SET `timemark` = @time_mark, `pk_date_src` = @pk_d WHERE `table_name` = @tbl_name AND `pk_date_src` = @pk_d_old;						END IF; END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `designaciones`
--

CREATE TABLE `designaciones` (
  `idDesignaciones` int(11) NOT NULL,
  `Cronogramas_idCronogramas` int(11) NOT NULL,
  `Empleados_idEmpleados` int(11) NOT NULL,
  `Colectivos_idColectivos` int(11) NOT NULL,
  `orden` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `designaciones`
--

INSERT INTO `designaciones` (`idDesignaciones`, `Cronogramas_idCronogramas`, `Empleados_idEmpleados`, `Colectivos_idColectivos`, `orden`) VALUES
(123, 101, 3, 1, 1),
(124, 101, 5, 34, 2),
(125, 101, 15, 3, 3),
(126, 101, 16, 4, 4),
(127, 101, 23, 5, 5),
(128, 101, 25, 6, 6),
(129, 101, 45, 7, 7),
(130, 101, 47, 8, 8),
(131, 101, 2, 1, 1),
(132, 101, 13, 34, 2),
(133, 101, 21, 3, 3),
(134, 101, 35, 4, 4),
(135, 101, 48, 5, 5),
(136, 101, 51, 6, 6),
(137, 101, 52, 7, 7),
(138, 101, 54, 8, 8);

--
-- Disparadores `designaciones`
--
DELIMITER $$
CREATE TRIGGER `a_d_designaciones` AFTER DELETE ON `designaciones` FOR EACH ROW BEGIN						SET @time_mark = DATE_ADD(NOW(), INTERVAL 0 SECOND); 						SET @tbl_name = 'designaciones';						SET @pk_d = CONCAT('<idDesignaciones>',OLD.`idDesignaciones`,'</idDesignaciones>');						SET @rec_state = 3;						SET @rs = 0;						SELECT `record_state` INTO @rs FROM `history_store` WHERE  `table_name` = @tbl_name AND `pk_date_src` = @pk_d;						DELETE FROM `history_store` WHERE `table_name` = @tbl_name AND `pk_date_src` = @pk_d; 						IF @rs <> 1 THEN 						INSERT INTO `history_store`( `timemark`, `table_name`, `pk_date_src`,`pk_date_dest`, `record_state` ) VALUES (@time_mark, @tbl_name, @pk_d,@pk_d, @rec_state ); 						END IF; END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `a_i_designaciones` AFTER INSERT ON `designaciones` FOR EACH ROW BEGIN 						SET @time_mark = DATE_ADD(NOW(), INTERVAL 0 SECOND); 						SET @tbl_name = 'designaciones'; 						SET @pk_d = CONCAT('<idDesignaciones>',NEW.`idDesignaciones`,'</idDesignaciones>'); 						SET @rec_state = 1;						DELETE FROM `history_store` WHERE `table_name` = @tbl_name AND `pk_date_src` = @pk_d; 						INSERT INTO `history_store`( `timemark`, `table_name`, `pk_date_src`,`pk_date_dest`,`record_state` ) 						VALUES (@time_mark, @tbl_name, @pk_d, @pk_d, @rec_state); 						END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `a_u_designaciones` AFTER UPDATE ON `designaciones` FOR EACH ROW BEGIN						SET @time_mark = DATE_ADD(NOW(), INTERVAL 0 SECOND); 						SET @tbl_name = 'designaciones';						SET @pk_d_old = CONCAT('<idDesignaciones>',OLD.`idDesignaciones`,'</idDesignaciones>');						SET @pk_d = CONCAT('<idDesignaciones>',NEW.`idDesignaciones`,'</idDesignaciones>');						SET @rec_state = 2;						SET @rs = 0;						SELECT `record_state` INTO @rs FROM `history_store` WHERE `table_name` = @tbl_name AND `pk_date_src` = @pk_d_old;						IF @rs = 0 THEN 						INSERT INTO `history_store`( `timemark`, `table_name`, `pk_date_src`,`pk_date_dest`, `record_state` ) VALUES (@time_mark, @tbl_name, @pk_d,@pk_d_old, @rec_state );						ELSE 						UPDATE `history_store` SET `timemark` = @time_mark, `pk_date_src` = @pk_d WHERE `table_name` = @tbl_name AND `pk_date_src` = @pk_d_old;						END IF; END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `idEmpleados` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8 NOT NULL,
  `apellido` varchar(50) CHARACTER SET utf8 NOT NULL,
  `domicilio` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `telefono` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `celular` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `fechaNacimiento` date DEFAULT NULL,
  `fechaAntiguedad` date DEFAULT NULL,
  `turno` tinyint(1) DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`idEmpleados`, `name`, `nombre`, `apellido`, `domicilio`, `telefono`, `celular`, `fechaNacimiento`, `fechaAntiguedad`, `turno`, `email`) VALUES
(0, 'AvramScott', 'Avram', 'Scott', '5081 Risus Street', '146-4592', '1-532-174-6253', '2017-07-17', '2016-04-04', 2, 'torquent.per@ipsum.ca'),
(1, 'kevinwagner', 'Kevin', 'Wagner', NULL, '12312312', '1567867341534', '2017-03-01', '2017-03-14', 1, 'kevin_nw@hotmail.com'),
(2, 'AutumnPrince', 'Autumn', 'Prince', '5131 Nibh Rd.', '1-458-656-7394', '427-0289', '2017-01-08', '2017-10-21', 2, 'aliquet@auctorMaurisvel.ca'),
(3, 'VannaNguyen', 'Vanna', 'Nguyen', 'Ap #412-7566 Quis Avenue', '1-687-130-0612', '1-397-733-6321', '2016-06-05', '2017-07-06', 1, 'In.at@nonbibendumsed.edu'),
(4, 'LaithRojas', 'Laith', 'Rojas', 'P.O. Box 232, 6542 Eu, Avenue', '777-2584', '204-6495', '2017-01-20', '2016-12-17', 1, 'dolor.sit@suscipitest.net'),
(5, 'FelixPorter', 'Felix', 'Porter', '403-957 Nam Ave', '1-500-334-4919', '154-7065', '2017-04-02', '2017-09-03', 1, 'nunc.Quisque@dolorNulla.edu'),
(8, 'SydneeGaines', 'Sydnee', 'Gaines', '730-3284 Lacinia Ave', '1-342-978-4685', '1-981-893-8713', '2018-03-17', '2016-10-19', 1, 'enim.mi@Classaptent.ca'),
(9, 'EleanorJacobson', 'Eleanor', 'Jacobson', '730-7565 Tellus Av.', '1-340-664-1939', '664-2052', '2018-03-08', '2017-06-05', 1, 'diam.Duis.mi@eu.net'),
(10, 'DaneBuckley', 'Dane', 'Buckley', 'P.O. Box 133, 9601 Mi, St.', '1-451-969-5801', '764-3145', '2017-10-07', '2017-12-25', 1, 'a.tortor.Nunc@velturpis.net'),
(11, 'LacyBarron', 'Lacy', 'Barron', '6168 Sed St.', '604-4615', '927-6460', '2018-02-21', '2017-08-12', 2, 'arcu.iaculis@sapienimperdietornare.net'),
(12, 'TaraGonzales', 'Tara', 'Gonzales', 'Ap #572-3641 Molestie Street', '142-9824', '1-555-223-9374', '2017-06-19', '2016-05-24', 2, 'adipiscing.lacus.Ut@aliquamenim.co.uk'),
(13, 'DorianRosales', 'Dorian', 'Rosales', '4687 Auctor Street', '1-484-340-8109', '888-2297', '2017-06-17', '2017-03-05', 2, 'ornare@Donecconsectetuermauris.org'),
(14, 'JacobKoch', 'Jacob', 'Koch', '6202 Sed Av.', '116-0709', '1-983-564-7462', '2016-08-04', '2018-01-22', 2, 'metus@mollisdui.com'),
(15, 'DriscollHancock', 'Driscoll', 'Hancock', '1997 Enim Ave', '544-7039', '589-3332', '2016-09-16', '2017-01-09', 1, 'ipsum.nunc.id@loremDonecelementum.org'),
(16, 'CaldwellReilly', 'Caldwell', 'Reilly', 'P.O. Box 930, 160 Neque St.', '329-4982', '952-1010', '2017-04-14', '2016-03-30', 1, 'Vivamus.molestie@ornareFusce.edu'),
(17, 'KionaFrederick', 'Kiona', 'Frederick', '169-3250 Aenean St.', '1-898-840-6539', '241-3629', '2017-12-25', '2017-04-21', 1, 'Nulla.aliquet@semperdui.edu'),
(18, 'AmenaGraham', 'Amena', 'Graham', '2330 Ac St.', '1-218-772-3730', '1-573-440-1070', '2016-10-09', '2016-05-02', 2, 'Cras@nuncsitamet.org'),
(19, 'TimonPorter', 'Timon', 'Porter', '3211 Tincidunt Road', '244-6239', '901-0427', '2016-12-12', '2017-11-11', 1, 'egestas.a.scelerisque@accumsan.ca'),
(20, 'RisaLeon', 'Risa', 'Leon', 'Ap #617-1955 Mauris Rd.', '1-966-740-3808', '261-2208', '2018-01-21', '2018-02-06', 2, 'metus.urna.convallis@sedconsequat.edu'),
(21, 'NehruCrawford', 'Nehru', 'Crawford', 'Ap #578-9462 Amet, Av.', '1-840-893-0249', '332-4891', '2018-03-07', '2017-11-12', 2, 'magna.a.neque@porttitor.co.uk'),
(22, 'NashByers', 'Nash', 'Byers', '6186 Fermentum Rd.', '1-924-968-2578', '809-8809', '2016-12-24', '2016-05-22', 1, 'at.velit@augue.org'),
(23, 'TanyaKelley', 'Tanya', 'Kelley', '362-5956 Enim, Rd.', '325-8638', '1-613-232-4600', '2016-08-03', '2016-06-14', 1, 'dictum.placerat.augue@ornaretortor.org'),
(24, 'DeaconAndrews', 'Deacon', 'Andrews', '301-988 Sem Av.', '211-9052', '1-657-356-8433', '2017-05-26', '2016-05-12', 2, 'sed@mauris.ca'),
(25, 'ZahirBattle', 'Zahir', 'Battle', 'P.O. Box 155, 6070 Integer Rd.', '250-1382', '242-8487', '2017-07-20', '2018-02-07', 1, 'nisi@consequatenimdiam.org'),
(26, 'BrynneAcevedo', 'Brynne', 'Acevedo', 'P.O. Box 242, 2485 Quam Ave', '138-2206', '337-5440', '2018-01-21', '2017-07-15', 2, 'Duis.a.mi@Proinsed.co.uk'),
(27, 'CiaraVasquez', 'Ciara', 'Vasquez', '2778 Et Av.', '890-6600', '1-423-263-7395', '2017-12-03', '2017-05-02', 2, 'rutrum.non.hendrerit@egestasadui.ca'),
(28, 'UlricCantu', 'Ulric', 'Cantu', 'Ap #444-7385 Lectus Street', '1-293-794-1452', '1-498-670-3656', '2017-08-09', '2016-12-12', 2, 'semper.rutrum.Fusce@velmaurisInteger.edu'),
(29, 'ZenaidaHutchinson', 'Zenaida', 'Hutchinson', 'Ap #671-6185 Rhoncus. Rd.', '207-9115', '1-229-253-2185', '2017-12-21', '2017-04-08', 2, 'diam@penatibus.org'),
(30, 'NaomiVinson', 'Naomi', 'Vinson', 'Ap #122-8578 Aliquam Street', '1-438-289-5051', '188-6586', '2017-05-16', '2016-12-04', 2, 'vulputate.mauris@risus.edu'),
(31, 'ShannonAdkins', 'Shannon', 'Adkins', 'P.O. Box 522, 6066 Neque. Street', '674-0602', '1-878-844-7033', '2017-08-04', '2018-03-11', 1, 'egestas.Sed@sedduiFusce.co.uk'),
(32, 'SummerVinson', 'Summer', 'Vinson', '139-2623 Arcu. Ave', '1-423-209-6916', '1-108-492-9342', '2017-10-07', '2017-11-16', 2, 'justo.Praesent@nondui.net'),
(33, 'MeghanDrake', 'Meghan', 'Drake', '6935 Nunc Av.', '1-445-121-8050', '858-4698', '2017-02-28', '2017-11-20', 1, 'dapibus.id@ligulaAliquamerat.com'),
(34, 'DorianGeorge', 'Dorian', 'George', 'Ap #617-3026 Non Av.', '529-7215', '662-4208', '2017-12-19', '2016-04-05', 2, 'sollicitudin@nonummy.org'),
(35, 'PlatoLane', 'Plato', 'Lane', 'P.O. Box 925, 4742 Gravida St.', '540-7796', '537-0769', '2016-12-17', '2017-07-01', 2, 'a.mi@eunibhvulputate.org'),
(36, 'DrakeRowland', 'Drake', 'Rowland', '3075 Sociis Road', '1-898-119-2605', '1-543-285-5573', '2017-05-15', '2016-08-30', 2, 'Nulla.tempor@ligulaDonec.co.uk'),
(37, 'GriffithGentry', 'Griffith', 'Gentry', 'Ap #389-3274 Nec Street', '641-3888', '1-503-830-6216', '2016-07-02', '2016-09-13', 1, 'Proin.dolor.Nulla@primis.co.uk'),
(38, 'LawrenceYang', 'Lawrence', 'Yang', '6274 Tempus, Rd.', '1-453-994-9221', '1-391-395-3311', '2018-01-05', '2018-02-08', 1, 'risus.a.ultricies@Nunclectuspede.ca'),
(39, 'FitzgeraldGould', 'Fitzgerald', 'Gould', 'Ap #938-8115 Ornare Av.', '229-4775', '1-954-764-6984', '2017-01-08', '2017-12-13', 1, 'Sed.nunc@purusmauris.com'),
(40, 'AmelaStafford', 'Amela', 'Stafford', 'P.O. Box 837, 7662 Tristique Rd.', '1-955-362-2305', '1-963-895-4736', '2016-06-26', '2017-01-25', 1, 'ac@nullaCras.ca'),
(41, 'WynneTorres', 'Wynne', 'Torres', '377 Libero Rd.', '470-3437', '463-9389', '2018-02-28', '2017-02-05', 2, 'Quisque.ac.libero@Nunc.net'),
(42, 'JenniferAdams', 'Jennifer', 'Adams', 'Ap #806-2177 Libero. Av.', '1-285-779-0579', '807-7649', '2016-07-25', '2016-08-31', 2, 'Nullam.enim.Sed@nasceturridiculus.net'),
(43, 'TanishaBuck', 'Tanisha', 'Buck', '5058 Luctus St.', '401-4910', '1-289-330-4440', '2017-05-20', '2016-04-07', 2, 'faucibus@nonummyultriciesornare.edu'),
(44, 'LatifahHopkins', 'Latifah', 'Hopkins', '928-8895 Accumsan St.', '533-5597', '184-0000', '2018-01-02', '2017-10-26', 2, 'Pellentesque.tincidunt.tempus@senectuset.net'),
(45, 'RamaCollier', 'Rama', 'Collier', '5544 Urna Av.', '1-794-858-8217', '940-6925', '2016-11-19', '2017-08-01', 1, 'Donec.sollicitudin@tellusSuspendissesed.org'),
(46, 'AlikaMaxwell', 'Alika', 'Maxwell', '6056 Et Rd.', '1-123-948-7840', '1-839-679-7551', '2016-04-06', '2017-05-06', 1, 'enim.nec.tempus@nisi.com'),
(47, 'KyleeWest', 'Kylee', 'West', 'P.O. Box 167, 3141 Ut, Street', '1-312-874-3770', '173-2229', '2016-10-20', '2016-07-22', 1, 'est@sapienNunc.ca'),
(48, 'KarinaBallard', 'Karina', 'Ballard', '428-3383 In, Road', '557-5307', '1-859-518-1097', '2017-02-17', '2016-10-31', 2, 'ut.molestie.in@ut.co.uk'),
(49, 'YaelEstrada', 'Yael', 'Estrada', '8927 Vivamus Avenue', '1-802-726-8353', '519-9393', '2016-05-12', '2016-10-31', 2, 'Cras.convallis.convallis@vellectus.com'),
(50, 'ChavaFox', 'Chava', 'Fox', '3780 Vel Street', '250-8218', '258-9895', '2017-05-25', '2016-05-07', 1, 'ac.nulla.In@condimentumegetvolutpat.co.uk'),
(51, 'GlennaVelez', 'Glenna', 'Velez', '1978 Purus Street', '947-2734', '624-5835', '2017-02-28', '2016-11-14', 2, 'nisl.Quisque@nisi.com'),
(52, 'ZenaJefferson', 'Zena', 'Jefferson', 'P.O. Box 623, 6824 At, Rd.', '769-6102', '122-1580', '2017-03-23', '2017-06-19', 2, 'Suspendisse@nonbibendum.com'),
(53, 'KiboWilliams', 'Kibo', 'Williams', 'Ap #907-5921 Lorem, Street', '1-288-458-3860', '1-136-690-8702', '2017-04-05', '2016-04-12', 1, 'ipsum.ac@nullaIntincidunt.ca'),
(54, 'DarylFarmer', 'Daryl', 'Farmer', '9603 Augue Rd.', '1-860-849-8192', '377-8323', '2018-01-05', '2016-07-05', 2, 'et@nonenimMauris.ca'),
(55, 'DrewBrewer', 'Drew', 'Brewer', 'P.O. Box 521, 7094 Vestibulum St.', '618-2465', '658-0760', '2017-03-01', '2018-01-13', 1, 'iaculis@Pellentesquetincidunt.org'),
(56, 'JacquelineWillis', 'Jacqueline', 'Willis', '8129 Lacinia. Road', '1-108-273-1503', '200-0833', '2016-04-11', '2016-11-26', 2, 'enim.commodo@vitaepurus.com'),
(57, 'SandraWebster', 'Sandra', 'Webster', '808-6987 Massa. St.', '1-104-857-3273', '519-6964', '2016-07-23', '2017-09-17', 2, 'Aliquam.vulputate@pretiumet.org'),
(58, 'ChardeWooten', 'Charde', 'Wooten', 'P.O. Box 240, 2900 Donec Rd.', '1-308-813-3973', '955-6907', '2017-06-23', '2016-09-03', 1, 'cursus.et@semPellentesque.com'),
(59, 'HavivaBuckner', 'Haviva', 'Buckner', 'P.O. Box 998, 727 Nunc Rd.', '821-1962', '338-6095', '2018-02-18', '2016-09-17', 1, 'eget.volutpat@faucibusorciluctus.co.uk'),
(60, 'TheodoreDale', 'Theodore', 'Dale', 'P.O. Box 749, 7118 Donec Rd.', '889-4047', '979-9315', '2016-09-23', '2017-02-05', 2, 'adipiscing@liberolacusvarius.ca'),
(61, 'DennisPuckett', 'Dennis', 'Puckett', 'Ap #182-2616 Congue Road', '876-3437', '1-111-477-5566', '2016-06-24', '2016-08-02', 2, 'ut.quam@lectusasollicitudin.edu'),
(62, 'MalikMartin', 'Malik', 'Martin', 'Ap #232-2681 Sed St.', '1-394-984-1948', '579-7025', '2017-04-02', '2016-09-19', 2, 'magna@etultrices.com'),
(63, 'IsadoraWare', 'Isadora', 'Ware', '1941 Enim St.', '218-5776', '936-9981', '2016-10-31', '2017-03-07', 1, 'sollicitudin@diamnunc.co.uk'),
(64, 'CassandraHester', 'Cassandra', 'Hester', '5694 Sodales. Rd.', '1-922-526-8706', '878-4909', '2017-03-08', '2017-02-17', 1, 'aliquet@Nullaegetmetus.net'),
(65, 'BarclayEspinoza', 'Barclay', 'Espinoza', 'Ap #739-8457 Phasellus Avenue', '535-3738', '263-4502', '2016-05-18', '2017-01-25', 1, 'interdum.enim.non@sapien.co.uk'),
(66, 'OriCline', 'Ori', 'Cline', '579-5992 Cras Ave', '1-965-165-7584', '1-137-899-2577', '2017-10-12', '2017-05-24', 1, 'sapien@tacitisociosqu.edu'),
(67, 'AltheaNielsen', 'Althea', 'Nielsen', 'Ap #594-1149 Urna. Rd.', '340-3380', '188-6887', '2017-02-22', '2017-06-05', 2, 'hendrerit.id@aliquetlobortisnisi.com'),
(68, 'ArsenioWilcox', 'Arsenio', 'Wilcox', 'P.O. Box 471, 9486 Risus St.', '988-0551', '1-856-820-7306', '2017-08-09', '2017-12-24', 1, 'nibh.vulputate.mauris@mattis.ca'),
(69, 'AvaGriffith', 'Ava', 'Griffith', 'P.O. Box 116, 9869 Adipiscing Ave', '1-756-618-8040', '1-677-775-7123', '2017-11-02', '2016-04-28', 2, 'at.velit.Cras@fringillacursus.edu'),
(70, 'YvetteEllison', 'Yvette', 'Ellison', '682-2409 Lacus. Street', '1-407-940-8414', '225-8122', '2017-01-15', '2018-01-26', 2, 'tempus.scelerisque.lorem@uteratSed.co.uk'),
(71, 'TanaPatterson', 'Tana', 'Patterson', '742 Ac Street', '1-877-857-3902', '951-1523', '2016-06-03', '2016-11-26', 1, 'mauris.ipsum@Cumsociisnatoque.org'),
(72, 'SybillRaymond', 'Sybill', 'Raymond', 'Ap #401-3103 Donec Street', '735-0978', '687-3329', '2017-11-11', '2018-03-22', 2, 'auctor.vitae.aliquet@utpellentesque.com'),
(73, 'NigelAnderson', 'Nigel', 'Anderson', '844-2443 Diam Avenue', '1-868-587-5908', '1-105-779-2886', '2017-04-29', '2017-02-24', 2, 'quam.dignissim.pharetra@sapienmolestie.com'),
(74, 'KatellDurham', 'Katell', 'Durham', '934-5357 Scelerisque Av.', '1-983-820-9388', '852-7145', '2017-12-04', '2017-02-10', 1, 'arcu.et.pede@NullamnislMaecenas.com'),
(75, 'PhoebeClements', 'Phoebe', 'Clements', '7853 Vestibulum St.', '1-527-348-6718', '853-5971', '2017-12-04', '2017-04-22', 2, 'lectus@vestibulumnequesed.edu'),
(76, 'UnityRutledge', 'Unity', 'Rutledge', 'Ap #231-5093 Aliquam St.', '169-9511', '1-515-792-6276', '2017-06-10', '2017-07-13', 2, 'parturient.montes@NuncmaurisMorbi.org'),
(77, 'TallulahThornton', 'Tallulah', 'Thornton', 'P.O. Box 569, 4311 Pellentesque St.', '317-1643', '221-2184', '2016-12-13', '2017-10-12', 2, 'gravida@massalobortis.co.uk'),
(78, 'DaphneHuff', 'Daphne', 'Huff', 'P.O. Box 517, 3806 Ipsum St.', '415-4375', '1-760-144-0776', '2016-07-25', '2016-11-27', 2, 'Sed@vestibulum.com'),
(79, 'DustinWaters', 'Dustin', 'Waters', 'P.O. Box 180, 9804 Phasellus Road', '256-4974', '1-431-954-0070', '2016-05-05', '2016-12-31', 2, 'eu@dolor.co.uk'),
(80, 'JamaliaRomero', 'Jamalia', 'Romero', '1545 Non St.', '1-991-335-7638', '1-629-606-7656', '2017-12-21', '2017-04-18', 1, 'nec@imperdietdictummagna.co.uk'),
(81, 'CamillaHaynes', 'Camilla', 'Haynes', '1992 Mauris Street', '1-499-166-2346', '1-549-978-4046', '2017-01-07', '2016-11-30', 2, 'Mauris@Sednecmetus.org'),
(82, 'QuynnMurphy', 'Quynn', 'Murphy', '618-6671 In, Road', '872-1743', '479-1881', '2018-02-26', '2017-07-03', 1, 'sit@mauriserat.co.uk'),
(83, 'CarterFitzgerald', 'Carter', 'Fitzgerald', '930-5775 Sodales Road', '667-9273', '1-505-361-1691', '2016-06-12', '2016-10-08', 2, 'eget.venenatis@mauris.co.uk'),
(84, 'JacksonCopeland', 'Jackson', 'Copeland', '876-8431 Tempor St.', '1-374-850-9905', '238-6941', '2016-06-27', '2017-03-27', 1, 'consequat.purus.Maecenas@ultricesa.com'),
(85, 'MadonnaBoone', 'Madonna', 'Boone', '5712 Ut Road', '417-6107', '267-2755', '2017-09-19', '2017-03-04', 1, 'Proin.mi.Aliquam@quistristique.net'),
(86, 'AlanaFrederick', 'Alana', 'Frederick', 'Ap #330-9806 Ac Avenue', '1-281-745-0359', '1-170-586-3568', '2018-02-03', '2017-07-01', 1, 'Etiam.ligula@commodo.co.uk'),
(87, 'LeandraPowers', 'Leandra', 'Powers', 'Ap #111-3948 Sed Road', '1-414-714-9433', '1-958-865-7892', '2017-05-13', '2017-11-29', 2, 'a@Nunclaoreetlectus.com'),
(88, 'LucianTodd', 'Lucian', 'Todd', 'Ap #101-5439 Suspendisse St.', '1-234-650-6772', '298-0720', '2016-06-07', '2016-10-18', 2, 'parturient.montes@Donec.ca'),
(89, 'HollyHicks', 'Holly', 'Hicks', '402-1142 Mauris Road', '679-9688', '799-9342', '2017-07-07', '2017-06-11', 2, 'sit.amet.consectetuer@rutrum.net'),
(90, 'NyssaSweeney', 'Nyssa', 'Sweeney', 'P.O. Box 644, 1080 Lobortis. Rd.', '1-984-851-9177', '1-209-429-3859', '2017-01-25', '2016-05-15', 1, 'fermentum.convallis@mattisornare.ca'),
(91, 'FrancesReed', 'Frances', 'Reed', 'P.O. Box 165, 7624 Cras St.', '490-8429', '853-4884', '2018-01-10', '2016-11-15', 2, 'pede@nunc.ca'),
(92, 'IonaSchroeder', 'Iona', 'Schroeder', '927-2523 Elementum Rd.', '911-6073', '949-1986', '2016-09-17', '2017-07-07', 1, 'nec.ante.blandit@venenatisamagna.ca'),
(93, 'ZeniaSantos', 'Zenia', 'Santos', '582-3142 Lobortis Street', '1-732-586-0081', '831-2623', '2016-05-16', '2017-08-13', 2, 'nisl.Quisque.fringilla@non.ca'),
(94, 'CharlotteSawyer', 'Charlotte', 'Sawyer', 'Ap #246-4896 Nulla Rd.', '1-374-951-4333', '961-7151', '2017-04-10', '2016-12-19', 2, 'a@famesac.co.uk'),
(95, 'TyroneBarnes', 'Tyrone', 'Barnes', '6552 Non Rd.', '1-562-245-5054', '1-306-889-8485', '2016-07-16', '2016-11-03', 2, 'sem.magna.nec@iaculis.net'),
(96, 'CoraNash', 'Cora', 'Nash', '2242 Facilisis Ave', '120-9697', '655-2789', '2016-04-11', '2016-10-17', 2, 'consectetuer.adipiscing@Maecenas.co.uk'),
(97, 'AristotleMcmahon', 'Aristotle', 'Mcmahon', '7983 Rutrum. St.', '1-236-776-0830', '475-4890', '2017-03-22', '2017-05-14', 1, 'consectetuer@loremsemperauctor.ca'),
(98, 'AliceColon', 'Alice', 'Colon', '7203 Interdum St.', '107-7460', '843-8818', '2017-08-26', '2017-02-19', 1, 'sollicitudin.orci@risusDonecnibh.org'),
(99, 'AlexanderWyatt', 'Alexander', 'Wyatt', 'P.O. Box 459, 3723 Enim Avenue', '1-113-257-3224', '976-5260', '2016-10-18', '2017-10-22', 2, 'metus.facilisis.lorem@atrisusNunc.org'),
(100, 'VivianGamble', 'Vivian', 'Gamble', '717-6184 Nunc Av.', '652-9908', '949-6705', '2016-06-29', '2018-01-07', 2, 'habitant.morbi.tristique@luctus.co.uk');

--
-- Disparadores `empleados`
--
DELIMITER $$
CREATE TRIGGER `a_d_empleados` AFTER DELETE ON `empleados` FOR EACH ROW BEGIN						SET @time_mark = DATE_ADD(NOW(), INTERVAL 0 SECOND); 						SET @tbl_name = 'empleados';						SET @pk_d = CONCAT('<idEmpleados>',OLD.`idEmpleados`,'</idEmpleados>');						SET @rec_state = 3;						SET @rs = 0;						SELECT `record_state` INTO @rs FROM `history_store` WHERE  `table_name` = @tbl_name AND `pk_date_src` = @pk_d;						DELETE FROM `history_store` WHERE `table_name` = @tbl_name AND `pk_date_src` = @pk_d; 						IF @rs <> 1 THEN 						INSERT INTO `history_store`( `timemark`, `table_name`, `pk_date_src`,`pk_date_dest`, `record_state` ) VALUES (@time_mark, @tbl_name, @pk_d,@pk_d, @rec_state ); 						END IF; END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `a_i_empleados` AFTER INSERT ON `empleados` FOR EACH ROW BEGIN 						SET @time_mark = DATE_ADD(NOW(), INTERVAL 0 SECOND); 						SET @tbl_name = 'empleados'; 						SET @pk_d = CONCAT('<idEmpleados>',NEW.`idEmpleados`,'</idEmpleados>'); 						SET @rec_state = 1;						DELETE FROM `history_store` WHERE `table_name` = @tbl_name AND `pk_date_src` = @pk_d; 						INSERT INTO `history_store`( `timemark`, `table_name`, `pk_date_src`,`pk_date_dest`,`record_state` ) 						VALUES (@time_mark, @tbl_name, @pk_d, @pk_d, @rec_state); 						END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `a_u_empleados` AFTER UPDATE ON `empleados` FOR EACH ROW BEGIN						SET @time_mark = DATE_ADD(NOW(), INTERVAL 0 SECOND); 						SET @tbl_name = 'empleados';						SET @pk_d_old = CONCAT('<idEmpleados>',OLD.`idEmpleados`,'</idEmpleados>');						SET @pk_d = CONCAT('<idEmpleados>',NEW.`idEmpleados`,'</idEmpleados>');						SET @rec_state = 2;						SET @rs = 0;						SELECT `record_state` INTO @rs FROM `history_store` WHERE `table_name` = @tbl_name AND `pk_date_src` = @pk_d_old;						IF @rs = 0 THEN 						INSERT INTO `history_store`( `timemark`, `table_name`, `pk_date_src`,`pk_date_dest`, `record_state` ) VALUES (@time_mark, @tbl_name, @pk_d,@pk_d_old, @rec_state );						ELSE 						UPDATE `history_store` SET `timemark` = @time_mark, `pk_date_src` = @pk_d WHERE `table_name` = @tbl_name AND `pk_date_src` = @pk_d_old;						END IF; END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `history_store`
--

CREATE TABLE `history_store` (
  `timemark` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `table_name` tinytext NOT NULL,
  `pk_date_src` text NOT NULL,
  `pk_date_dest` text NOT NULL,
  `record_state` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) CHARACTER SET utf8 NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recorridos`
--

CREATE TABLE `recorridos` (
  `idRecorridos` int(11) NOT NULL,
  `idPunto` int(11) NOT NULL,
  `posicionLatitud` double NOT NULL,
  `posicionLongitud` double NOT NULL,
  `nombre` varchar(45) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Disparadores `recorridos`
--
DELIMITER $$
CREATE TRIGGER `a_d_recorridos` AFTER DELETE ON `recorridos` FOR EACH ROW BEGIN						SET @time_mark = DATE_ADD(NOW(), INTERVAL 0 SECOND); 						SET @tbl_name = 'recorridos';						SET @pk_d = CONCAT('<idRecorridos>',OLD.`idRecorridos`,'</idRecorridos>','<idPunto>',OLD.`idPunto`,'</idPunto>');						SET @rec_state = 3;						SET @rs = 0;						SELECT `record_state` INTO @rs FROM `history_store` WHERE  `table_name` = @tbl_name AND `pk_date_src` = @pk_d;						DELETE FROM `history_store` WHERE `table_name` = @tbl_name AND `pk_date_src` = @pk_d; 						IF @rs <> 1 THEN 						INSERT INTO `history_store`( `timemark`, `table_name`, `pk_date_src`,`pk_date_dest`, `record_state` ) VALUES (@time_mark, @tbl_name, @pk_d,@pk_d, @rec_state ); 						END IF; END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `a_i_recorridos` AFTER INSERT ON `recorridos` FOR EACH ROW BEGIN 						SET @time_mark = DATE_ADD(NOW(), INTERVAL 0 SECOND); 						SET @tbl_name = 'recorridos'; 						SET @pk_d = CONCAT('<idRecorridos>',NEW.`idRecorridos`,'</idRecorridos>','<idPunto>',NEW.`idPunto`,'</idPunto>'); 						SET @rec_state = 1;						DELETE FROM `history_store` WHERE `table_name` = @tbl_name AND `pk_date_src` = @pk_d; 						INSERT INTO `history_store`( `timemark`, `table_name`, `pk_date_src`,`pk_date_dest`,`record_state` ) 						VALUES (@time_mark, @tbl_name, @pk_d, @pk_d, @rec_state); 						END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `a_u_recorridos` AFTER UPDATE ON `recorridos` FOR EACH ROW BEGIN						SET @time_mark = DATE_ADD(NOW(), INTERVAL 0 SECOND); 						SET @tbl_name = 'recorridos';						SET @pk_d_old = CONCAT('<idRecorridos>',OLD.`idRecorridos`,'</idRecorridos>','<idPunto>',OLD.`idPunto`,'</idPunto>');						SET @pk_d = CONCAT('<idRecorridos>',NEW.`idRecorridos`,'</idRecorridos>','<idPunto>',NEW.`idPunto`,'</idPunto>');						SET @rec_state = 2;						SET @rs = 0;						SELECT `record_state` INTO @rs FROM `history_store` WHERE `table_name` = @tbl_name AND `pk_date_src` = @pk_d_old;						IF @rs = 0 THEN 						INSERT INTO `history_store`( `timemark`, `table_name`, `pk_date_src`,`pk_date_dest`, `record_state` ) VALUES (@time_mark, @tbl_name, @pk_d,@pk_d_old, @rec_state );						ELSE 						UPDATE `history_store` SET `timemark` = @time_mark, `pk_date_src` = @pk_d WHERE `table_name` = @tbl_name AND `pk_date_src` = @pk_d_old;						END IF; END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rendiciones_boleteras`
--

CREATE TABLE `rendiciones_boleteras` (
  `idRendicionesBoleteras` int(11) NOT NULL,
  `recaudacion` decimal(10,2) DEFAULT NULL,
  `fecha` datetime NOT NULL,
  `observacionAdmin` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `boletoPrimera` int(11) DEFAULT NULL,
  `beletoSegunda` int(11) DEFAULT NULL,
  `boletoEscolar` int(11) DEFAULT NULL,
  `boletoSecundario` int(11) DEFAULT NULL,
  `boletoJubilado` int(11) DEFAULT NULL,
  `boleteoCombinado` int(11) DEFAULT NULL,
  `Empleados_idEmpleados` int(11) NOT NULL,
  `Colectivos_idColectivos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `rendiciones_boleteras`
--

INSERT INTO `rendiciones_boleteras` (`idRendicionesBoleteras`, `recaudacion`, `fecha`, `observacionAdmin`, `boletoPrimera`, `beletoSegunda`, `boletoEscolar`, `boletoSecundario`, `boletoJubilado`, `boleteoCombinado`, `Empleados_idEmpleados`, `Colectivos_idColectivos`) VALUES
(1, '1.00', '2017-04-01 00:00:00', NULL, 0, 0, 0, 0, 0, 0, 3, 1),
(2, '1.00', '2017-04-01 00:00:00', NULL, 0, 0, 0, 0, 0, 0, 3, 1),
(3, '1.00', '2017-04-01 00:00:00', NULL, 0, 0, 0, 0, 0, 0, 3, 1),
(4, '12.50', '2017-04-01 00:00:00', NULL, 0, 0, 0, 0, 0, 0, 3, 1);

--
-- Disparadores `rendiciones_boleteras`
--
DELIMITER $$
CREATE TRIGGER `a_d_rendiciones_boleteras` AFTER DELETE ON `rendiciones_boleteras` FOR EACH ROW BEGIN						SET @time_mark = DATE_ADD(NOW(), INTERVAL 0 SECOND); 						SET @tbl_name = 'rendiciones_boleteras';						SET @pk_d = CONCAT('<idRendicionesBoleteras>',OLD.`idRendicionesBoleteras`,'</idRendicionesBoleteras>');						SET @rec_state = 3;						SET @rs = 0;						SELECT `record_state` INTO @rs FROM `history_store` WHERE  `table_name` = @tbl_name AND `pk_date_src` = @pk_d;						DELETE FROM `history_store` WHERE `table_name` = @tbl_name AND `pk_date_src` = @pk_d; 						IF @rs <> 1 THEN 						INSERT INTO `history_store`( `timemark`, `table_name`, `pk_date_src`,`pk_date_dest`, `record_state` ) VALUES (@time_mark, @tbl_name, @pk_d,@pk_d, @rec_state ); 						END IF; END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `a_i_rendiciones_boleteras` AFTER INSERT ON `rendiciones_boleteras` FOR EACH ROW BEGIN 						SET @time_mark = DATE_ADD(NOW(), INTERVAL 0 SECOND); 						SET @tbl_name = 'rendiciones_boleteras'; 						SET @pk_d = CONCAT('<idRendicionesBoleteras>',NEW.`idRendicionesBoleteras`,'</idRendicionesBoleteras>'); 						SET @rec_state = 1;						DELETE FROM `history_store` WHERE `table_name` = @tbl_name AND `pk_date_src` = @pk_d; 						INSERT INTO `history_store`( `timemark`, `table_name`, `pk_date_src`,`pk_date_dest`,`record_state` ) 						VALUES (@time_mark, @tbl_name, @pk_d, @pk_d, @rec_state); 						END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `a_u_rendiciones_boleteras` AFTER UPDATE ON `rendiciones_boleteras` FOR EACH ROW BEGIN						SET @time_mark = DATE_ADD(NOW(), INTERVAL 0 SECOND); 						SET @tbl_name = 'rendiciones_boleteras';						SET @pk_d_old = CONCAT('<idRendicionesBoleteras>',OLD.`idRendicionesBoleteras`,'</idRendicionesBoleteras>');						SET @pk_d = CONCAT('<idRendicionesBoleteras>',NEW.`idRendicionesBoleteras`,'</idRendicionesBoleteras>');						SET @rec_state = 2;						SET @rs = 0;						SELECT `record_state` INTO @rs FROM `history_store` WHERE `table_name` = @tbl_name AND `pk_date_src` = @pk_d_old;						IF @rs = 0 THEN 						INSERT INTO `history_store`( `timemark`, `table_name`, `pk_date_src`,`pk_date_dest`, `record_state` ) VALUES (@time_mark, @tbl_name, @pk_d,@pk_d_old, @rec_state );						ELSE 						UPDATE `history_store` SET `timemark` = @time_mark, `pk_date_src` = @pk_d WHERE `table_name` = @tbl_name AND `pk_date_src` = @pk_d_old;						END IF; END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reportes_inspectores`
--

CREATE TABLE `reportes_inspectores` (
  `idReportesInspectores` int(11) NOT NULL,
  `descripcion` varchar(300) CHARACTER SET utf8 NOT NULL,
  `fecha` datetime NOT NULL,
  `Colectivos_idColectivos` int(11) NOT NULL,
  `Empleados_idEmpleadosChofer` int(11) NOT NULL,
  `Empleados_idEmpleadosInspector` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Disparadores `reportes_inspectores`
--
DELIMITER $$
CREATE TRIGGER `a_d_reportes_inspectores` AFTER DELETE ON `reportes_inspectores` FOR EACH ROW BEGIN						SET @time_mark = DATE_ADD(NOW(), INTERVAL 0 SECOND); 						SET @tbl_name = 'reportes_inspectores';						SET @pk_d = CONCAT('<idReportesInspectores>',OLD.`idReportesInspectores`,'</idReportesInspectores>');						SET @rec_state = 3;						SET @rs = 0;						SELECT `record_state` INTO @rs FROM `history_store` WHERE  `table_name` = @tbl_name AND `pk_date_src` = @pk_d;						DELETE FROM `history_store` WHERE `table_name` = @tbl_name AND `pk_date_src` = @pk_d; 						IF @rs <> 1 THEN 						INSERT INTO `history_store`( `timemark`, `table_name`, `pk_date_src`,`pk_date_dest`, `record_state` ) VALUES (@time_mark, @tbl_name, @pk_d,@pk_d, @rec_state ); 						END IF; END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `a_i_reportes_inspectores` AFTER INSERT ON `reportes_inspectores` FOR EACH ROW BEGIN 						SET @time_mark = DATE_ADD(NOW(), INTERVAL 0 SECOND); 						SET @tbl_name = 'reportes_inspectores'; 						SET @pk_d = CONCAT('<idReportesInspectores>',NEW.`idReportesInspectores`,'</idReportesInspectores>'); 						SET @rec_state = 1;						DELETE FROM `history_store` WHERE `table_name` = @tbl_name AND `pk_date_src` = @pk_d; 						INSERT INTO `history_store`( `timemark`, `table_name`, `pk_date_src`,`pk_date_dest`,`record_state` ) 						VALUES (@time_mark, @tbl_name, @pk_d, @pk_d, @rec_state); 						END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `a_u_reportes_inspectores` AFTER UPDATE ON `reportes_inspectores` FOR EACH ROW BEGIN						SET @time_mark = DATE_ADD(NOW(), INTERVAL 0 SECOND); 						SET @tbl_name = 'reportes_inspectores';						SET @pk_d_old = CONCAT('<idReportesInspectores>',OLD.`idReportesInspectores`,'</idReportesInspectores>');						SET @pk_d = CONCAT('<idReportesInspectores>',NEW.`idReportesInspectores`,'</idReportesInspectores>');						SET @rec_state = 2;						SET @rs = 0;						SELECT `record_state` INTO @rs FROM `history_store` WHERE `table_name` = @tbl_name AND `pk_date_src` = @pk_d_old;						IF @rs = 0 THEN 						INSERT INTO `history_store`( `timemark`, `table_name`, `pk_date_src`,`pk_date_dest`, `record_state` ) VALUES (@time_mark, @tbl_name, @pk_d,@pk_d_old, @rec_state );						ELSE 						UPDATE `history_store` SET `timemark` = @time_mark, `pk_date_src` = @pk_d WHERE `table_name` = @tbl_name AND `pk_date_src` = @pk_d_old;						END IF; END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos`
--

CREATE TABLE `tipos` (
  `idTipos` int(11) NOT NULL,
  `Nombre` varchar(45) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tipos`
--

INSERT INTO `tipos` (`idTipos`, `Nombre`) VALUES
(1, 'Administrativo'),
(2, 'Chofer'),
(3, 'Inspector'),
(6, 'pedro');

--
-- Disparadores `tipos`
--
DELIMITER $$
CREATE TRIGGER `a_d_tipos` AFTER DELETE ON `tipos` FOR EACH ROW BEGIN						SET @time_mark = DATE_ADD(NOW(), INTERVAL 0 SECOND); 						SET @tbl_name = 'tipos';						SET @pk_d = CONCAT('<idTipos>',OLD.`idTipos`,'</idTipos>');						SET @rec_state = 3;						SET @rs = 0;						SELECT `record_state` INTO @rs FROM `history_store` WHERE  `table_name` = @tbl_name AND `pk_date_src` = @pk_d;						DELETE FROM `history_store` WHERE `table_name` = @tbl_name AND `pk_date_src` = @pk_d; 						IF @rs <> 1 THEN 						INSERT INTO `history_store`( `timemark`, `table_name`, `pk_date_src`,`pk_date_dest`, `record_state` ) VALUES (@time_mark, @tbl_name, @pk_d,@pk_d, @rec_state ); 						END IF; END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `a_i_tipos` AFTER INSERT ON `tipos` FOR EACH ROW BEGIN 						SET @time_mark = DATE_ADD(NOW(), INTERVAL 0 SECOND); 						SET @tbl_name = 'tipos'; 						SET @pk_d = CONCAT('<idTipos>',NEW.`idTipos`,'</idTipos>'); 						SET @rec_state = 1;						DELETE FROM `history_store` WHERE `table_name` = @tbl_name AND `pk_date_src` = @pk_d; 						INSERT INTO `history_store`( `timemark`, `table_name`, `pk_date_src`,`pk_date_dest`,`record_state` ) 						VALUES (@time_mark, @tbl_name, @pk_d, @pk_d, @rec_state); 						END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `a_u_tipos` AFTER UPDATE ON `tipos` FOR EACH ROW BEGIN						SET @time_mark = DATE_ADD(NOW(), INTERVAL 0 SECOND); 						SET @tbl_name = 'tipos';						SET @pk_d_old = CONCAT('<idTipos>',OLD.`idTipos`,'</idTipos>');						SET @pk_d = CONCAT('<idTipos>',NEW.`idTipos`,'</idTipos>');						SET @rec_state = 2;						SET @rs = 0;						SELECT `record_state` INTO @rs FROM `history_store` WHERE `table_name` = @tbl_name AND `pk_date_src` = @pk_d_old;						IF @rs = 0 THEN 						INSERT INTO `history_store`( `timemark`, `table_name`, `pk_date_src`,`pk_date_dest`, `record_state` ) VALUES (@time_mark, @tbl_name, @pk_d,@pk_d_old, @rec_state );						ELSE 						UPDATE `history_store` SET `timemark` = @time_mark, `pk_date_src` = @pk_d WHERE `table_name` = @tbl_name AND `pk_date_src` = @pk_d_old;						END IF; END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `Tipos_idTipos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `Tipos_idTipos`) VALUES
(1, 'kevinwagner', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', 'pVKG88Rq8Sj6glRbBz88EQqrrunURwgN9j9cQBaAglnl9Vs3tudB57dq0NMO', '2017-03-24 21:39:39', '2017-04-01 20:38:31', 1),
(2, 'AutumnPrince', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2),
(3, 'VannaNguyen', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '0qT58e4ITQHeIY4oPZrEsjS66rOKRHunaiREDW0567DeeHfIVsbYyRcbilx7', '0000-00-00 00:00:00', '2017-04-01 21:22:51', 2),
(4, 'LaithRojas', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3),
(5, 'FelixPorter', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2),
(6, 'JackAvery', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(7, 'AvramScott', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(8, 'SydneeGaines', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(9, 'EleanorJacobson', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3),
(10, 'DaneBuckley', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3),
(11, 'LacyBarron', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(12, 'TaraGonzales', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3),
(13, 'DorianRosales', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2),
(14, 'JacobKoch', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(15, 'DriscollHancock', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2),
(16, 'CaldwellReilly', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2),
(17, 'KionaFrederick', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(18, 'AmenaGraham', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(19, 'TimonPorter', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(20, 'RisaLeon', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(21, 'NehruCrawford', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2),
(22, 'NashByers', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(23, 'TanyaKelley', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2),
(24, 'DeaconAndrews', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(25, 'ZahirBattle', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2),
(26, 'BrynneAcevedo', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(27, 'CiaraVasquez', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3),
(28, 'UlricCantu', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3),
(29, 'ZenaidaHutchinson', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3),
(30, 'NaomiVinson', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3),
(31, 'ShannonAdkins', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(32, 'SummerVinson', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(33, 'MeghanDrake', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3),
(34, 'DorianGeorge', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(35, 'PlatoLane', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2),
(36, 'DrakeRowland', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(37, 'GriffithGentry', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3),
(38, 'LawrenceYang', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3),
(39, 'FitzgeraldGould', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(40, 'AmelaStafford', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3),
(41, 'WynneTorres', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3),
(42, 'JenniferAdams', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(43, 'TanishaBuck', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3),
(44, 'LatifahHopkins', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(45, 'RamaCollier', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2),
(46, 'AlikaMaxwell', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3),
(47, 'KyleeWest', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2),
(48, 'KarinaBallard', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2),
(49, 'YaelEstrada', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3),
(50, 'ChavaFox', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3),
(51, 'GlennaVelez', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2),
(52, 'ZenaJefferson', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2),
(53, 'KiboWilliams', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3),
(54, 'DarylFarmer', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2),
(55, 'DrewBrewer', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2),
(56, 'JacquelineWillis', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', 'UUcdsdqMiIB8Py79LAeLjIsEmEIuVW7f4jrUQTSS0U1QAaNifhsfuoOekeew', '0000-00-00 00:00:00', '2017-04-01 01:13:09', 2),
(57, 'SandraWebster', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2),
(58, 'ChardeWooten', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(59, 'HavivaBuckner', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3),
(60, 'TheodoreDale', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2),
(61, 'DennisPuckett', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(62, 'MalikMartin', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(63, 'IsadoraWare', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(64, 'CassandraHester', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2),
(65, 'BarclayEspinoza', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3),
(66, 'OriCline', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2),
(67, 'AltheaNielsen', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(68, 'ArsenioWilcox', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2),
(69, 'AvaGriffith', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(70, 'YvetteEllison', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3),
(71, 'TanaPatterson', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2),
(72, 'SybillRaymond', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3),
(73, 'NigelAnderson', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3),
(74, 'KatellDurham', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2),
(75, 'PhoebeClements', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(76, 'UnityRutledge', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3),
(77, 'TallulahThornton', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3),
(78, 'DaphneHuff', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2),
(79, 'DustinWaters', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3),
(80, 'JamaliaRomero', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(81, 'CamillaHaynes', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(82, 'QuynnMurphy', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2),
(83, 'CarterFitzgerald', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3),
(84, 'JacksonCopeland', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3),
(85, 'MadonnaBoone', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(86, 'AlanaFrederick', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(87, 'LeandraPowers', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(88, 'LucianTodd', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(89, 'HollyHicks', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(90, 'NyssaSweeney', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2),
(91, 'FrancesReed', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3),
(92, 'IonaSchroeder', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(93, 'ZeniaSantos', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2),
(94, 'CharlotteSawyer', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', 'WZTYujc7GDjdNakCswjC54Mi5u2owtS7xAA3GZ9Ovb8Fwo2UV9ngmmrH07hC', '0000-00-00 00:00:00', '2017-03-31 21:48:18', 2),
(95, 'TyroneBarnes', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3),
(96, 'CoraNash', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(97, 'AristotleMcmahon', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3),
(98, 'AliceColon', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3),
(99, 'AlexanderWyatt', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', 'UZ28fUdSteuVkQlED0O4Jmtc9Oec8bW5lMqEHirUbU70PMTTwFrqcbII7d4Z', '0000-00-00 00:00:00', '2017-03-26 23:32:13', 3),
(100, 'VivianGamble', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3),
(101, 'MiriamSlater', '', '$2y$10$sK8ChIkv8Kme0RbUCZiPqumh4V5JLFaTRExnQOW1wYNbGQP60x4Yu', 'zvsl3uikKZhEoEQjezlF7lYWl69wNNXGrTeFMskU4HWd7AMMM7LAjfa6dAHA', '0000-00-00 00:00:00', '2017-03-24 22:15:07', 3);

--
-- Disparadores `users`
--
DELIMITER $$
CREATE TRIGGER `a_d_users` AFTER DELETE ON `users` FOR EACH ROW BEGIN						SET @time_mark = DATE_ADD(NOW(), INTERVAL 0 SECOND); 						SET @tbl_name = 'users';						SET @pk_d = CONCAT('<id>',OLD.`id`,'</id>');						SET @rec_state = 3;						SET @rs = 0;						SELECT `record_state` INTO @rs FROM `history_store` WHERE  `table_name` = @tbl_name AND `pk_date_src` = @pk_d;						DELETE FROM `history_store` WHERE `table_name` = @tbl_name AND `pk_date_src` = @pk_d; 						IF @rs <> 1 THEN 						INSERT INTO `history_store`( `timemark`, `table_name`, `pk_date_src`,`pk_date_dest`, `record_state` ) VALUES (@time_mark, @tbl_name, @pk_d,@pk_d, @rec_state ); 						END IF; END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `a_i_users` AFTER INSERT ON `users` FOR EACH ROW BEGIN 						SET @time_mark = DATE_ADD(NOW(), INTERVAL 0 SECOND); 						SET @tbl_name = 'users'; 						SET @pk_d = CONCAT('<id>',NEW.`id`,'</id>'); 						SET @rec_state = 1;						DELETE FROM `history_store` WHERE `table_name` = @tbl_name AND `pk_date_src` = @pk_d; 						INSERT INTO `history_store`( `timemark`, `table_name`, `pk_date_src`,`pk_date_dest`,`record_state` ) 						VALUES (@time_mark, @tbl_name, @pk_d, @pk_d, @rec_state); 						END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `a_u_users` AFTER UPDATE ON `users` FOR EACH ROW BEGIN						SET @time_mark = DATE_ADD(NOW(), INTERVAL 0 SECOND); 						SET @tbl_name = 'users';						SET @pk_d_old = CONCAT('<id>',OLD.`id`,'</id>');						SET @pk_d = CONCAT('<id>',NEW.`id`,'</id>');						SET @rec_state = 2;						SET @rs = 0;						SELECT `record_state` INTO @rs FROM `history_store` WHERE `table_name` = @tbl_name AND `pk_date_src` = @pk_d_old;						IF @rs = 0 THEN 						INSERT INTO `history_store`( `timemark`, `table_name`, `pk_date_src`,`pk_date_dest`, `record_state` ) VALUES (@time_mark, @tbl_name, @pk_d,@pk_d_old, @rec_state );						ELSE 						UPDATE `history_store` SET `timemark` = @time_mark, `pk_date_src` = @pk_d WHERE `table_name` = @tbl_name AND `pk_date_src` = @pk_d_old;						END IF; END
$$
DELIMITER ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carteleras`
--
ALTER TABLE `carteleras`
  ADD PRIMARY KEY (`idCarteleras`);

--
-- Indices de la tabla `colectivos`
--
ALTER TABLE `colectivos`
  ADD PRIMARY KEY (`idColectivos`);

--
-- Indices de la tabla `cronogramas`
--
ALTER TABLE `cronogramas`
  ADD PRIMARY KEY (`idCronogramas`),
  ADD UNIQUE KEY `fecha_UNIQUE` (`fecha`),
  ADD KEY `fk_Cronogramas_carteleras1_idx` (`Carteleras_idCarteleras`);

--
-- Indices de la tabla `designaciones`
--
ALTER TABLE `designaciones`
  ADD PRIMARY KEY (`idDesignaciones`),
  ADD KEY `fk_Designaciones_Cronogramas1_idx` (`Cronogramas_idCronogramas`),
  ADD KEY `fk_Designaciones_empleados1_idx` (`Empleados_idEmpleados`),
  ADD KEY `fk_Designaciones_colectivos1_idx` (`Colectivos_idColectivos`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`idEmpleados`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- Indices de la tabla `history_store`
--
ALTER TABLE `history_store`
  ADD PRIMARY KEY (`table_name`(100),`pk_date_dest`(100));

--
-- Indices de la tabla `recorridos`
--
ALTER TABLE `recorridos`
  ADD PRIMARY KEY (`idRecorridos`,`idPunto`);

--
-- Indices de la tabla `rendiciones_boleteras`
--
ALTER TABLE `rendiciones_boleteras`
  ADD PRIMARY KEY (`idRendicionesBoleteras`),
  ADD KEY `fk_RendicionesBoleteras_Empleados1_idx` (`Empleados_idEmpleados`),
  ADD KEY `fk_RendicionesBoleteras_Colectivos1_idx` (`Colectivos_idColectivos`);

--
-- Indices de la tabla `reportes_inspectores`
--
ALTER TABLE `reportes_inspectores`
  ADD PRIMARY KEY (`idReportesInspectores`),
  ADD KEY `fk_ReportesInspectores_Colectivos1_idx` (`Colectivos_idColectivos`),
  ADD KEY `fk_ReportesInspectores_Empleados1_idx` (`Empleados_idEmpleadosChofer`),
  ADD KEY `fk_ReportesInspectores_Empleados2_idx` (`Empleados_idEmpleadosInspector`);

--
-- Indices de la tabla `tipos`
--
ALTER TABLE `tipos`
  ADD PRIMARY KEY (`idTipos`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`),
  ADD KEY `fk_users_tipos1_idx` (`Tipos_idTipos`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carteleras`
--
ALTER TABLE `carteleras`
  MODIFY `idCarteleras` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `colectivos`
--
ALTER TABLE `colectivos`
  MODIFY `idColectivos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT de la tabla `cronogramas`
--
ALTER TABLE `cronogramas`
  MODIFY `idCronogramas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;
--
-- AUTO_INCREMENT de la tabla `designaciones`
--
ALTER TABLE `designaciones`
  MODIFY `idDesignaciones` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;
--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `idEmpleados` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
--
-- AUTO_INCREMENT de la tabla `recorridos`
--
ALTER TABLE `recorridos`
  MODIFY `idRecorridos` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `rendiciones_boleteras`
--
ALTER TABLE `rendiciones_boleteras`
  MODIFY `idRendicionesBoleteras` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `reportes_inspectores`
--
ALTER TABLE `reportes_inspectores`
  MODIFY `idReportesInspectores` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cronogramas`
--
ALTER TABLE `cronogramas`
  ADD CONSTRAINT `fk_Cronogramas_carteleras1` FOREIGN KEY (`Carteleras_idCarteleras`) REFERENCES `carteleras` (`idCarteleras`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `designaciones`
--
ALTER TABLE `designaciones`
  ADD CONSTRAINT `fk_Designaciones_Cronogramas1` FOREIGN KEY (`Cronogramas_idCronogramas`) REFERENCES `cronogramas` (`idCronogramas`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Designaciones_colectivos1` FOREIGN KEY (`Colectivos_idColectivos`) REFERENCES `colectivos` (`idColectivos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Designaciones_empleados1` FOREIGN KEY (`Empleados_idEmpleados`) REFERENCES `empleados` (`idEmpleados`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD CONSTRAINT `name` FOREIGN KEY (`name`) REFERENCES `users` (`name`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `rendiciones_boleteras`
--
ALTER TABLE `rendiciones_boleteras`
  ADD CONSTRAINT `fk_RendicionesBoleteras_Colectivos1` FOREIGN KEY (`Colectivos_idColectivos`) REFERENCES `colectivos` (`idColectivos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_RendicionesBoleteras_Empleados1` FOREIGN KEY (`Empleados_idEmpleados`) REFERENCES `empleados` (`idEmpleados`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `reportes_inspectores`
--
ALTER TABLE `reportes_inspectores`
  ADD CONSTRAINT `fk_ReportesInspectores_Colectivos1` FOREIGN KEY (`Colectivos_idColectivos`) REFERENCES `colectivos` (`idColectivos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ReportesInspectores_Empleados1` FOREIGN KEY (`Empleados_idEmpleadosChofer`) REFERENCES `empleados` (`idEmpleados`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ReportesInspectores_Empleados2` FOREIGN KEY (`Empleados_idEmpleadosInspector`) REFERENCES `empleados` (`idEmpleados`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_tipos1` FOREIGN KEY (`Tipos_idTipos`) REFERENCES `tipos` (`idTipos`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
