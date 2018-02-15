-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.5.24-log - MySQL Community Server (GPL)
-- SO del servidor:              Win32
-- HeidiSQL Versión:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para pventa
CREATE DATABASE IF NOT EXISTS `pventaweb` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `pventaweb`;

-- Volcando estructura para función pventa.altainventario
DELIMITER //
CREATE DEFINER=`root`@`localhost` FUNCTION `altainventario`(`idunicoe` INT, `idunicos` INT, `idunicop` INT, `cantidad` INT, `modelo` VARCHAR(50), `talla` VARCHAR(50), `lote` VARCHAR(50), `fcaducidad` DATE) RETURNS int(10) unsigned
    READS SQL DATA
BEGIN
			DECLARE num INT DEFAULT 1;
        
        insert into inventario(idunicoe,idunicos,idunicop,cantidad,modelo,talla,lote,fcaducidad,tipo)
        VALUES (idunicoe,idunicos,idunicop,cantidad,modelo,talla,lote,fcaducidad,'0');
        SET num=(select max(idunicoregi) from inventario);
        RETURN num;
END//
DELIMITER ;

-- Volcando estructura para tabla pventa.bitacora
CREATE TABLE IF NOT EXISTS `bitacora` (
  `idunicob` int(12) NOT NULL AUTO_INCREMENT COMMENT 'id unico de la bitacora',
  `idunicoe` int(12) DEFAULT NULL COMMENT 'id unico de la empresa',
  `idunicos` int(12) DEFAULT NULL COMMENT 'id unico de la sucursal',
  `idunicop` int(12) DEFAULT NULL COMMENT 'id unico del producto',
  `tipo` int(1) DEFAULT NULL COMMENT 'tipo de movimiento 0=alta 1=modif 2=entrada 3=salida 4=traspaso 5=baja 6=baja x dev 7=entr x dev',
  `cantidad` int(12) DEFAULT NULL COMMENT 'cantidad modificada',
  `pmostrador` float(12,2) DEFAULT NULL COMMENT 'precio mostrador modificado',
  `idunicou` int(12) DEFAULT NULL COMMENT 'id unico del usuario que hizo el movimiento',
  `fechahora` datetime DEFAULT NULL COMMENT 'fecha hora del movimiento',
  KEY `Índice 1` (`idunicob`)
) ENGINE=InnoDB AUTO_INCREMENT=161 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='registra los movimietos multiples del sistema';

-- Volcando datos para la tabla pventa.bitacora: ~25 rows (aproximadamente)
/*!40000 ALTER TABLE `bitacora` DISABLE KEYS */;
REPLACE INTO `bitacora` (`idunicob`, `idunicoe`, `idunicos`, `idunicop`, `tipo`, `cantidad`, `pmostrador`, `idunicou`, `fechahora`) VALUES
	(136, 1, 1, 3528, 2, 2, 205.00, 34, '2017-04-03 13:42:06'),
	(137, 1, 1, 3528, 2, 3, 205.00, 34, '2017-04-03 13:42:06'),
	(138, 1, 1, 3528, 2, 4, 205.00, 34, '2017-04-03 13:42:06'),
	(139, 1, 1, 3528, 2, 2, 205.00, 34, '2017-04-03 13:42:06'),
	(140, 1, 1, 3528, 3, 2, 205.00, 35, '2017-04-03 13:45:06'),
	(141, 1, 1, 3528, 3, 2, 205.00, 35, '2017-04-03 17:23:09'),
	(142, 1, 1, 3528, 3, 2, 205.00, 35, '2017-04-03 17:25:13'),
	(143, 1, 1, 3528, 3, 2, 195.00, 35, '2017-04-03 17:54:03'),
	(144, 1, 1, 3528, 3, 2, 205.00, 35, '2017-04-03 17:54:35'),
	(145, 1, 1, 3535, 2, 3, 160.00, 34, '2017-05-08 14:22:13'),
	(146, 1, 1, 3535, 5, 3, 0.00, 34, '2017-05-08 14:23:24'),
	(147, 1, 1, 3536, 3, 0, 27.00, 35, '2017-05-08 15:53:52'),
	(148, 1, 1, 3536, 3, 0, 27.00, 35, '2017-05-08 17:05:09'),
	(149, 1, 1, 3536, 3, 0, 27.00, 35, '2017-05-08 17:05:09'),
	(150, 1, 1, 3536, 3, 0, 27.00, 35, '2017-05-08 17:05:09'),
	(151, 1, 1, 3536, 3, 2, 27.00, 35, '2017-05-08 17:11:24'),
	(152, 1, 1, 3536, 3, 1, 27.00, 35, '2017-05-08 17:11:24'),
	(153, 1, 1, 3536, 3, 1, 27.00, 35, '2017-05-08 17:11:24'),
	(154, 1, 1, 3542, 1, 10, 0.00, 34, '2017-07-13 12:39:46'),
	(155, 1, 1, 3542, 1, 6, 0.00, 34, '2017-07-13 12:48:07'),
	(156, 1, 1, 3542, 5, 0, 0.00, 34, '2017-07-13 12:48:33'),
	(157, 1, 1, 3542, 1, 0, 0.00, 34, '2017-07-13 12:52:51'),
	(158, 1, 1, 3528, 3, 1, 205.00, 35, '2018-02-12 22:45:59'),
	(159, 1, 1, 3535, 3, 1, 160.00, 35, '2018-02-12 22:47:53'),
	(160, 1, 1, 3535, 4, 1, 160.00, 33, '2018-02-12 22:51:46');
/*!40000 ALTER TABLE `bitacora` ENABLE KEYS */;

-- Volcando estructura para tabla pventa.catagrupadores
CREATE TABLE IF NOT EXISTS `catagrupadores` (
  `idunicoa` int(12) NOT NULL AUTO_INCREMENT COMMENT 'id unico de agrupador',
  `idunicoe` int(12) DEFAULT NULL COMMENT 'id unico de empresa',
  `agrupador` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'nombre del agrupador',
  PRIMARY KEY (`idunicoa`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='catalogo de agrupadores';

-- Volcando datos para la tabla pventa.catagrupadores: ~27 rows (aproximadamente)
/*!40000 ALTER TABLE `catagrupadores` DISABLE KEYS */;
REPLACE INTO `catagrupadores` (`idunicoa`, `idunicoe`, `agrupador`) VALUES
	(11, 1, '12/14'),
	(12, 1, '15/17'),
	(13, 1, '18/21'),
	(14, 1, '22/25'),
	(15, 1, '25/28'),
	(16, 1, 'ESPECIAL'),
	(17, 1, 'ZAPATO'),
	(18, 1, 'TENIS'),
	(19, 1, 'BOTA'),
	(20, 1, 'ZAPATILLA'),
	(21, 1, 'BALERINA'),
	(22, 1, 'BOTA TRABAJO'),
	(23, 1, 'HOMBRE'),
	(24, 1, 'MUJER'),
	(25, 1, 'FOCOS'),
	(26, 1, 'HUARACHE'),
	(27, 1, 'SANDALIA'),
	(28, 1, 'NINO'),
	(29, 1, 'NINA'),
	(30, 1, 'VESTIR'),
	(31, 1, 'CASUAL'),
	(32, 1, 'SENORA'),
	(33, 1, 'FUTBOL'),
	(34, 1, 'BASQUETBOL'),
	(35, 1, 'TELA'),
	(36, 1, 'PIEL'),
	(37, 1, 'OFERTA');
/*!40000 ALTER TABLE `catagrupadores` ENABLE KEYS */;

-- Volcando estructura para tabla pventa.catusuarios
CREATE TABLE IF NOT EXISTS `catusuarios` (
  `idunicou` int(12) NOT NULL AUTO_INCREMENT COMMENT 'id unico del usuario',
  `idunicoe` int(12) DEFAULT NULL COMMENT 'id unico de la empresa',
  `login` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'login del usuario',
  `password` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'contraseña del usuario',
  `nombre` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'nombre completo del usuario',
  `tipo` int(1) DEFAULT NULL COMMENT 'tipo de usuario 0=usuario 1=supervisor 2=administrador',
  `idunicos` int(12) DEFAULT NULL COMMENT 'idunico de la sucursal a la que entra 0=entra a todas las sucursales de la empresa',
  KEY `Índice 1` (`idunicou`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='catalogo de usuarios';

-- Volcando datos para la tabla pventa.catusuarios: ~7 rows (aproximadamente)
/*!40000 ALTER TABLE `catusuarios` DISABLE KEYS */;
REPLACE INTO `catusuarios` (`idunicou`, `idunicoe`, `login`, `password`, `nombre`, `tipo`, `idunicos`) VALUES
	(33, 1, 'adminixmi', '123', 'administrador Ixm', 2, 1),
	(34, 1, 'superixmi', '123', 'supervisor ixmi', 2, 1),
	(35, 1, 'ventaixmi1', '123', 'vendedor ixmi 1', 0, 1),
	(36, 1, 'ventaixmi2', '123', 'vendedor ixmi 2', 0, 1),
	(37, 1, 'adminzima', '123', 'administrador zimapan', 2, 2),
	(38, 1, 'superzima', '123', 'supervisor zimapan', 2, 2),
	(39, 1, 'ventazima1', '123', 'vendedor 1 zimapan', 0, 2);
/*!40000 ALTER TABLE `catusuarios` ENABLE KEYS */;

-- Volcando estructura para tabla pventa.complementoprod
CREATE TABLE IF NOT EXISTS `complementoprod` (
  `idunicoe` int(12) DEFAULT NULL COMMENT 'idunico de la empresa',
  `idunicop` int(12) DEFAULT NULL COMMENT 'idunico del producto',
  `campo` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'campo adicional',
  `tipo` int(1) DEFAULT NULL COMMENT 'tipo de campo 0=varchar 1=integer 2=float',
  `longitud` int(3) DEFAULT NULL COMMENT 'longitud del campo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='complementos de productos';

-- Volcando datos para la tabla pventa.complementoprod: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `complementoprod` DISABLE KEYS */;
/*!40000 ALTER TABLE `complementoprod` ENABLE KEYS */;

-- Volcando estructura para tabla pventa.configuraciones
CREATE TABLE IF NOT EXISTS `configuraciones` (
  `idunicoe` int(12) DEFAULT NULL COMMENT 'id unico de la empresa',
  `serie` int(1) DEFAULT NULL COMMENT '0= no activo 1= activo',
  `marca` int(1) DEFAULT NULL COMMENT '0= no activo 1= activo',
  `modelo` int(1) DEFAULT NULL COMMENT '0= no activo 1= activo',
  `talla` int(1) DEFAULT NULL COMMENT '0= no activo 1= activo',
  `lote` int(1) DEFAULT NULL COMMENT '0= no activo 1= activo',
  `fcaducidad` int(1) DEFAULT NULL COMMENT '0= no activo 1= activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='permite activar o no los campos especiales';

-- Volcando datos para la tabla pventa.configuraciones: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `configuraciones` DISABLE KEYS */;
REPLACE INTO `configuraciones` (`idunicoe`, `serie`, `marca`, `modelo`, `talla`, `lote`, `fcaducidad`) VALUES
	(1, 0, 1, 1, 1, 0, 0);
/*!40000 ALTER TABLE `configuraciones` ENABLE KEYS */;

-- Volcando estructura para tabla pventa.detpagos
CREATE TABLE IF NOT EXISTS `detpagos` (
  `idunicop` int(12) NOT NULL AUTO_INCREMENT COMMENT 'id unico del registro de pago',
  `idunicoe` int(12) DEFAULT NULL COMMENT 'id unico de la empresa',
  `idunicos` int(12) DEFAULT NULL COMMENT 'id unico de la sucursal',
  `importe` float(12,2) DEFAULT NULL COMMENT 'imprte del pago',
  `fecha` date DEFAULT NULL COMMENT 'fecha del pago',
  `referencia` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'referencia de pago',
  PRIMARY KEY (`idunicop`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='detalle de registro de pagos';

-- Volcando datos para la tabla pventa.detpagos: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `detpagos` DISABLE KEYS */;
/*!40000 ALTER TABLE `detpagos` ENABLE KEYS */;

-- Volcando estructura para tabla pventa.detprodagrup
CREATE TABLE IF NOT EXISTS `detprodagrup` (
  `idunicoreg` int(12) NOT NULL AUTO_INCREMENT COMMENT 'idunico del registro',
  `idunicoe` int(12) DEFAULT NULL COMMENT 'id unico de la empresa',
  `idunicop` int(12) DEFAULT NULL COMMENT 'id unico del producto',
  `idunicoa` int(12) DEFAULT NULL COMMENT 'id unico del agrupador',
  KEY `Índice 1` (`idunicoreg`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='asociacion de los agrupadores con los productos';

-- Volcando datos para la tabla pventa.detprodagrup: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `detprodagrup` DISABLE KEYS */;
REPLACE INTO `detprodagrup` (`idunicoreg`, `idunicoe`, `idunicop`, `idunicoa`) VALUES
	(13, 1, 3528, 18),
	(14, 1, 3528, 33),
	(15, 1, 3528, 23);
/*!40000 ALTER TABLE `detprodagrup` ENABLE KEYS */;

-- Volcando estructura para tabla pventa.detsalidas
CREATE TABLE IF NOT EXISTS `detsalidas` (
  `idunicodetsal` int(12) NOT NULL AUTO_INCREMENT COMMENT 'id unico del registro del detalle de la salida',
  `idunicosal` int(12) DEFAULT NULL COMMENT 'id unico de la salida',
  `idunicop` int(12) DEFAULT NULL COMMENT 'id unico del producto',
  `pmostrador` float(12,2) DEFAULT NULL COMMENT 'precio del mostrador',
  `cantidad` int(12) DEFAULT NULL COMMENT 'cantidad del arituclo vendida',
  `descuento` float(12,2) DEFAULT NULL COMMENT 'importe del descuento del articulo',
  `iva` float(12,2) DEFAULT NULL COMMENT 'importe del iva de ese articulo',
  `pfinal` float(12,2) DEFAULT NULL COMMENT 'precio final de esa partida',
  `modelo` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `talla` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `lote` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fcaducidad` date DEFAULT NULL,
  KEY `Índice 1` (`idunicodetsal`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='detalle de salidas';

-- Volcando datos para la tabla pventa.detsalidas: ~15 rows (aproximadamente)
/*!40000 ALTER TABLE `detsalidas` DISABLE KEYS */;
REPLACE INTO `detsalidas` (`idunicodetsal`, `idunicosal`, `idunicop`, `pmostrador`, `cantidad`, `descuento`, `iva`, `pfinal`, `modelo`, `talla`, `lote`, `fcaducidad`) VALUES
	(43, 39, 3528, 205.00, 2, 20.00, 0.00, 390.00, '3025', '2', '', '0000-00-00'),
	(44, 40, 3528, 205.00, 2, 0.00, 0.00, 390.00, '3025', '2.5', '', '0000-00-00'),
	(45, 41, 3528, 205.00, 2, 0.00, 0.00, 410.00, '3025', '3', '', '0000-00-00'),
	(46, 42, 3528, 195.00, 2, 0.00, 0.00, 390.00, '3025', '2.5', '', '0000-00-00'),
	(47, 43, 3528, 205.00, 2, 0.00, 0.00, 410.00, '3025', '3', '', '0000-00-00'),
	(48, 44, 3536, 27.00, 0, 0.00, 0.00, 0.00, 'aaa', '2.5', '', '0000-00-00'),
	(49, 45, 3536, 27.00, 0, 0.00, 0.00, 0.00, 'aaa', '1.5', '', '0000-00-00'),
	(50, 45, 3536, 27.00, 0, 0.00, 0.00, 0.00, 'aaa', '2', '', '0000-00-00'),
	(51, 45, 3536, 27.00, 0, 0.00, 0.00, 0.00, 'aaa', '2.5', '', '0000-00-00'),
	(52, 46, 3536, 27.00, 2, 0.00, 5.44, 59.44, 'aaa', '1.5', '', '0000-00-00'),
	(53, 46, 3536, 27.00, 1, 0.00, 2.72, 29.72, 'aaa', '2', '', '0000-00-00'),
	(54, 46, 3536, 27.00, 1, 0.00, 2.72, 29.72, 'aaa', '2.5', '', '0000-00-00'),
	(55, 47, 3528, 205.00, 1, 0.00, 0.00, 205.00, '3025', '2.5', '', '0000-00-00'),
	(56, 48, 3535, 160.00, 1, 0.00, 24.00, 184.00, 'modelo', '1.5', '', '0000-00-00'),
	(57, 49, 3535, 160.00, 1, 0.00, 25.60, 185.60, 'modelo', '1', NULL, NULL);
/*!40000 ALTER TABLE `detsalidas` ENABLE KEYS */;

-- Volcando estructura para tabla pventa.devoluciones
CREATE TABLE IF NOT EXISTS `devoluciones` (
  `idunicod` int(12) DEFAULT NULL COMMENT 'id unico de la devolcuion',
  `idunicoe` int(12) DEFAULT NULL COMMENT 'idunico de la empresa',
  `idunicos` int(12) DEFAULT NULL COMMENT 'idunico de la sucursal',
  `idunicosal` int(12) DEFAULT NULL COMMENT 'idunico de la salida original',
  `idunicop` int(12) DEFAULT NULL COMMENT 'id unico del producto',
  `pmostrador` float DEFAULT NULL COMMENT 'precio mostrador',
  `cantidad` int(11) DEFAULT NULL COMMENT 'cantidad',
  `descuento` float DEFAULT NULL COMMENT 'descuento',
  `iva` float DEFAULT NULL COMMENT 'iva',
  `pfinal` float DEFAULT NULL COMMENT 'precio final',
  `tipodev` int(1) DEFAULT NULL COMMENT 'tipo de devolucion 0=cambio 1=fabrica desperfecto',
  `fecha` datetime DEFAULT NULL COMMENT 'fecha de la devolucion',
  `cliente` varchar(50) DEFAULT NULL COMMENT 'cliente que hace la devolucion',
  `idunicoent` int(12) DEFAULT NULL COMMENT 'id unico de la entrada',
  `idunicou` int(12) DEFAULT NULL COMMENT 'usuario que hace la devolucion',
  `idunicoadm` int(12) DEFAULT NULL COMMENT 'usuario que autorizo la devolucion',
  `idunicosalc` int(12) DEFAULT NULL COMMENT 'idunico de salida ya devuelto al cliente',
  `idunicopsalc` int(12) DEFAULT NULL COMMENT 'idunico de poructo devuelto al cliente'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='registra las devoluciones de productos';

-- Volcando datos para la tabla pventa.devoluciones: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `devoluciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `devoluciones` ENABLE KEYS */;

-- Volcando estructura para tabla pventa.empresa
CREATE TABLE IF NOT EXISTS `empresa` (
  `idunicoe` int(12) NOT NULL COMMENT 'id unico de la empresa consecutivo',
  `nombre` varchar(100) COLLATE utf8_spanish_ci DEFAULT '0' COMMENT 'nombre de la empresa',
  `rfc` varchar(30) COLLATE utf8_spanish_ci DEFAULT '0' COMMENT 'rfc de la empresa',
  `calle` varchar(30) COLLATE utf8_spanish_ci DEFAULT '0' COMMENT 'calle de la empresa',
  `colonia` varchar(30) COLLATE utf8_spanish_ci DEFAULT '0' COMMENT 'colonia de la direccion',
  `estado` varchar(30) COLLATE utf8_spanish_ci DEFAULT '0' COMMENT 'estado de la republica',
  `municipio` varchar(30) COLLATE utf8_spanish_ci DEFAULT '0' COMMENT 'municipio',
  `telefono` varchar(10) COLLATE utf8_spanish_ci DEFAULT '0' COMMENT 'telefono ',
  `idregistro` int(12) DEFAULT NULL COMMENT 'id del registro',
  `status` int(1) DEFAULT '0' COMMENT '0=prueba 1=activo 2=suspendida 3=baja',
  `tipopago` int(1) DEFAULT '0' COMMENT '0=anual 2=vitalicio',
  `fechaalta` date DEFAULT NULL COMMENT 'fecha de alta',
  `fppago` date DEFAULT NULL COMMENT 'fecha de proximo pago',
  `rutalogo` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `piedepagina` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `leyendaticket` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'leyenda del ticket',
  `utilidad` int(2) DEFAULT NULL COMMENT 'porcentaje de utilidad',
  PRIMARY KEY (`idunicoe`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Almacena las empresas';

-- Volcando datos para la tabla pventa.empresa: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `empresa` DISABLE KEYS */;
REPLACE INTO `empresa` (`idunicoe`, `nombre`, `rfc`, `calle`, `colonia`, `estado`, `municipio`, `telefono`, `idregistro`, `status`, `tipopago`, `fechaalta`, `fppago`, `rutalogo`, `piedepagina`, `leyendaticket`, `utilidad`) VALUES
	(1, 'ZAPATERIAS JUNIORS', 'JNZ01012017', 'conocida', 'Centro', 'Hidalgo', 'Ixmiquilpan', '773125475', 1, 1, 0, '2017-03-30', '2017-08-10', 'logopventa.jpg', 'piedepagina2.png', 'Nuestra Satisfacción Servirle.......', NULL);
/*!40000 ALTER TABLE `empresa` ENABLE KEYS */;

-- Volcando estructura para tabla pventa.entradas
CREATE TABLE IF NOT EXISTS `entradas` (
  `idunicoreg` int(12) NOT NULL AUTO_INCREMENT COMMENT 'id unico del registro',
  `idunicoe` int(12) DEFAULT NULL COMMENT 'id unico de la empresa',
  `idunicos` int(12) DEFAULT NULL COMMENT 'id unico de la sucursal',
  `idunicop` int(12) DEFAULT NULL COMMENT 'id unico del producto',
  `fechae` date DEFAULT NULL COMMENT 'fecha de entrada',
  `cantidad` int(12) DEFAULT NULL COMMENT 'cantidad de producto comprado',
  `pcompra` float(12,2) DEFAULT NULL COMMENT 'precio de compra',
  `idunicou` int(12) DEFAULT NULL COMMENT 'id unico del usuario que registra la entrada',
  `folio` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'folio o registro de entrada',
  `pmostrador` float(12,2) DEFAULT NULL COMMENT 'precio de mostrador',
  `idunicoregi` int(12) DEFAULT NULL COMMENT 'id unico del registro de inventario',
  `tipoent` int(1) DEFAULT NULL COMMENT 'tipo de entrada 0=compra 1=traspaso 2=devolucion',
  KEY `Índice 1` (`idunicoreg`)
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='entradas de productos';

-- Volcando datos para la tabla pventa.entradas: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `entradas` DISABLE KEYS */;
REPLACE INTO `entradas` (`idunicoreg`, `idunicoe`, `idunicos`, `idunicop`, `fechae`, `cantidad`, `pcompra`, `idunicou`, `folio`, `pmostrador`, `idunicoregi`, `tipoent`) VALUES
	(82, 1, 1, 3528, '2017-04-03', 2, 130.00, 34, '', 205.00, 1549, 0),
	(83, 1, 1, 3528, '2017-04-03', 3, 130.00, 34, '', 205.00, 1550, 0),
	(84, 1, 1, 3528, '2017-04-03', 4, 130.00, 34, '', 205.00, 1551, 0),
	(85, 1, 1, 3528, '2017-04-03', 2, 130.00, 34, '', 205.00, 1552, 0),
	(86, 1, 4, 3535, '2018-02-12', 1, 160.00, 33, ' ', 160.00, 1754, 1);
/*!40000 ALTER TABLE `entradas` ENABLE KEYS */;

-- Volcando estructura para función pventa.inserta
DELIMITER //
CREATE DEFINER=`root`@`localhost` FUNCTION `inserta`(`idunicoe` INT, `idunicos` INT, `tiposal` INT, `idunicou` INT, `fecha` DATE, `idunicotras` INT, `idunicosr` INT, `baja` INT, `total` FLOAT, `pago` FLOAT, `cambio` FLOAT) RETURNS int(10) unsigned
    READS SQL DATA
BEGIN
	DECLARE num INT DEFAULT 1;
      SET num=(select max(ticket)+1 from mtosalidas where idunicoe=idunicoe and idunicos=idunicos);
		IF num is null then
      	SET  num=1;
      END IF;
      INSERT INTO mtosalidas(idunicoe,idunicos,tiposal,idunicou,fecha,idunicotras,idunicosr,ticket,baja,total,pago,cambio)
      VALUES (idunicoe,idunicos,tiposal,idunicou,fecha,idunicotras,idunicosr,num,baja,total,pago,cambio);
		
	
      RETURN num;
END//
DELIMITER ;

-- Volcando estructura para función pventa.inserta_tras_baj
DELIMITER //
CREATE DEFINER=`root`@`localhost` FUNCTION `inserta_tras_baj`(`idunicoe` INT, `idunicos` INT, `tiposal` INT, `idunicou` INT, `fecha` DATE, `idunicotras` INT, `idunicosr` INT, `baja` INT, `total` DOUBLE) RETURNS int(10) unsigned
    READS SQL DATA
BEGIN
	   DECLARE num INT DEFAULT 1;
      
      
      INSERT INTO mtosalidas(idunicoe,idunicos,tiposal,idunicou,fecha,idunicotras,idunicosr,baja,total,ticket)
      VALUES (idunicoe,idunicos,tiposal,idunicou,fecha,idunicotras,idunicosr,baja,total,'0');
      
		SET num=(select max(idunicosal) from mtosalidas where idunicoe=idunicoe and idunicos=idunicos);
	
      RETURN num;
END//
DELIMITER ;

-- Volcando estructura para tabla pventa.inventario
CREATE TABLE IF NOT EXISTS `inventario` (
  `idunicoregi` int(12) NOT NULL AUTO_INCREMENT COMMENT 'idunico del inventario registro',
  `idunicoe` int(12) DEFAULT NULL COMMENT 'id unico de la empresa',
  `idunicop` int(12) DEFAULT NULL COMMENT 'id unico del producto',
  `idunicos` int(12) DEFAULT NULL COMMENT 'id unico de la sucursal',
  `cantidad` int(11) DEFAULT NULL COMMENT 'cantidad en existencia',
  `modelo` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'modelo del producto',
  `talla` float DEFAULT NULL COMMENT 'talla del producto',
  `lote` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'lote del producto',
  `fcaducidad` date DEFAULT NULL COMMENT 'fecha de caducidad',
  `tipo` int(12) DEFAULT NULL COMMENT 'tipo 0=producto 1=servicio',
  KEY `Índice 1` (`idunicoregi`)
) ENGINE=InnoDB AUTO_INCREMENT=2204 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='almacena el inventario';

-- Volcando datos para la tabla pventa.inventario: ~544 rows (aproximadamente)
/*!40000 ALTER TABLE `inventario` DISABLE KEYS */;
REPLACE INTO `inventario` (`idunicoregi`, `idunicoe`, `idunicop`, `idunicos`, `cantidad`, `modelo`, `talla`, `lote`, `fcaducidad`, `tipo`) VALUES
	(1549, 1, 3528, 1, 0, '3025', 2, NULL, NULL, 0),
	(1550, 1, 3528, 1, 1, '3025', 2.5, NULL, NULL, 0),
	(1551, 1, 3528, 1, 0, '3025', 3, NULL, NULL, 0),
	(1552, 1, 3528, 1, 2, '3025', 3.5, NULL, NULL, 0),
	(1553, 1, 3528, 1, 0, '3025', 4, NULL, NULL, 0),
	(1554, 1, 3528, 1, 0, '3025', 4.5, NULL, NULL, 0),
	(1555, 1, 3528, 1, 0, '3025', 5, NULL, NULL, 0),
	(1556, 1, 3528, 2, 0, '3025', 2, NULL, NULL, 0),
	(1557, 1, 3528, 2, 0, '3025', 2.5, NULL, NULL, 0),
	(1558, 1, 3528, 2, 0, '3025', 3, NULL, NULL, 0),
	(1559, 1, 3528, 2, 0, '3025', 3.5, NULL, NULL, 0),
	(1560, 1, 3528, 2, 0, '3025', 4, NULL, NULL, 0),
	(1561, 1, 3528, 2, 0, '3025', 4.5, NULL, NULL, 0),
	(1562, 1, 3528, 2, 0, '3025', 5, NULL, NULL, 0),
	(1563, 1, 3528, 3, 0, '3025', 2, NULL, NULL, 0),
	(1564, 1, 3528, 3, 0, '3025', 2.5, NULL, NULL, 0),
	(1565, 1, 3528, 3, 0, '3025', 3, NULL, NULL, 0),
	(1566, 1, 3528, 3, 0, '3025', 3.5, NULL, NULL, 0),
	(1567, 1, 3528, 3, 0, '3025', 4, NULL, NULL, 0),
	(1568, 1, 3528, 3, 0, '3025', 4.5, NULL, NULL, 0),
	(1569, 1, 3528, 3, 0, '3025', 5, NULL, NULL, 0),
	(1570, 1, 3528, 4, 0, '3025', 2, NULL, NULL, 0),
	(1571, 1, 3528, 4, 0, '3025', 2.5, NULL, NULL, 0),
	(1572, 1, 3528, 4, 0, '3025', 3, NULL, NULL, 0),
	(1573, 1, 3528, 4, 0, '3025', 3.5, NULL, NULL, 0),
	(1574, 1, 3528, 4, 0, '3025', 4, NULL, NULL, 0),
	(1575, 1, 3528, 4, 0, '3025', 4.5, NULL, NULL, 0),
	(1576, 1, 3528, 4, 0, '3025', 5, NULL, NULL, 0),
	(1577, 1, 3528, 5, 0, '3025', 2, NULL, NULL, 0),
	(1578, 1, 3528, 5, 0, '3025', 2.5, NULL, NULL, 0),
	(1579, 1, 3528, 5, 0, '3025', 3, NULL, NULL, 0),
	(1580, 1, 3528, 5, 0, '3025', 3.5, NULL, NULL, 0),
	(1581, 1, 3528, 5, 0, '3025', 4, NULL, NULL, 0),
	(1582, 1, 3528, 5, 0, '3025', 4.5, NULL, NULL, 0),
	(1583, 1, 3528, 5, 0, '3025', 5, NULL, NULL, 0),
	(1584, 1, 3529, 1, 0, 'modelo', 3, NULL, NULL, 0),
	(1585, 1, 3529, 1, 0, 'modelo', 3.5, NULL, NULL, 0),
	(1586, 1, 3529, 1, 0, 'modelo', 4, NULL, NULL, 0),
	(1587, 1, 3529, 1, 0, 'modelo', 4.5, NULL, NULL, 0),
	(1588, 1, 3529, 1, 0, 'modelo', 5, NULL, NULL, 0),
	(1589, 1, 3529, 1, 0, 'modelo', 5.5, NULL, NULL, 0),
	(1590, 1, 3529, 1, 0, 'modelo', 6, NULL, NULL, 0),
	(1591, 1, 3529, 1, 0, 'modelo', 6.5, NULL, NULL, 0),
	(1592, 1, 3529, 1, 0, 'modelo', 7, NULL, NULL, 0),
	(1593, 1, 3529, 2, 0, 'modelo', 3, NULL, NULL, 0),
	(1594, 1, 3529, 2, 0, 'modelo', 3.5, NULL, NULL, 0),
	(1595, 1, 3529, 2, 0, 'modelo', 4, NULL, NULL, 0),
	(1596, 1, 3529, 2, 0, 'modelo', 4.5, NULL, NULL, 0),
	(1597, 1, 3529, 2, 0, 'modelo', 5, NULL, NULL, 0),
	(1598, 1, 3529, 2, 0, 'modelo', 5.5, NULL, NULL, 0),
	(1599, 1, 3529, 2, 0, 'modelo', 6, NULL, NULL, 0),
	(1600, 1, 3529, 2, 0, 'modelo', 6.5, NULL, NULL, 0),
	(1601, 1, 3529, 2, 0, 'modelo', 7, NULL, NULL, 0),
	(1602, 1, 3529, 3, 0, 'modelo', 3, NULL, NULL, 0),
	(1603, 1, 3529, 3, 0, 'modelo', 3.5, NULL, NULL, 0),
	(1604, 1, 3529, 3, 0, 'modelo', 4, NULL, NULL, 0),
	(1605, 1, 3529, 3, 0, 'modelo', 4.5, NULL, NULL, 0),
	(1606, 1, 3529, 3, 0, 'modelo', 5, NULL, NULL, 0),
	(1607, 1, 3529, 3, 0, 'modelo', 5.5, NULL, NULL, 0),
	(1608, 1, 3529, 3, 0, 'modelo', 6, NULL, NULL, 0),
	(1609, 1, 3529, 3, 0, 'modelo', 6.5, NULL, NULL, 0),
	(1610, 1, 3529, 3, 0, 'modelo', 7, NULL, NULL, 0),
	(1611, 1, 3529, 4, 0, 'modelo', 3, NULL, NULL, 0),
	(1612, 1, 3529, 4, 0, 'modelo', 3.5, NULL, NULL, 0),
	(1613, 1, 3529, 4, 0, 'modelo', 4, NULL, NULL, 0),
	(1614, 1, 3529, 4, 0, 'modelo', 4.5, NULL, NULL, 0),
	(1615, 1, 3529, 4, 0, 'modelo', 5, NULL, NULL, 0),
	(1616, 1, 3529, 4, 0, 'modelo', 5.5, NULL, NULL, 0),
	(1617, 1, 3529, 4, 0, 'modelo', 6, NULL, NULL, 0),
	(1618, 1, 3529, 4, 0, 'modelo', 6.5, NULL, NULL, 0),
	(1619, 1, 3529, 4, 0, 'modelo', 7, NULL, NULL, 0),
	(1620, 1, 3529, 5, 0, 'modelo', 3, NULL, NULL, 0),
	(1621, 1, 3529, 5, 0, 'modelo', 3.5, NULL, NULL, 0),
	(1622, 1, 3529, 5, 0, 'modelo', 4, NULL, NULL, 0),
	(1623, 1, 3529, 5, 0, 'modelo', 4.5, NULL, NULL, 0),
	(1624, 1, 3529, 5, 0, 'modelo', 5, NULL, NULL, 0),
	(1625, 1, 3529, 5, 0, 'modelo', 5.5, NULL, NULL, 0),
	(1626, 1, 3529, 5, 0, 'modelo', 6, NULL, NULL, 0),
	(1627, 1, 3529, 5, 0, 'modelo', 6.5, NULL, NULL, 0),
	(1628, 1, 3529, 5, 0, 'modelo', 7, NULL, NULL, 0),
	(1629, 1, 3530, 1, 0, 'M', 3, NULL, NULL, 0),
	(1630, 1, 3530, 1, 0, 'M', 3.5, NULL, NULL, 0),
	(1631, 1, 3530, 1, 0, 'M', 4, NULL, NULL, 0),
	(1632, 1, 3530, 1, 0, 'M', 4.5, NULL, NULL, 0),
	(1633, 1, 3530, 1, 0, 'M', 5, NULL, NULL, 0),
	(1634, 1, 3530, 1, 0, 'M', 5.5, NULL, NULL, 0),
	(1635, 1, 3530, 1, 0, 'M', 6, NULL, NULL, 0),
	(1636, 1, 3530, 1, 0, 'M', 6.5, NULL, NULL, 0),
	(1637, 1, 3530, 1, 0, 'M', 7, NULL, NULL, 0),
	(1638, 1, 3530, 1, 0, 'M', 7.5, NULL, NULL, 0),
	(1639, 1, 3530, 1, 0, 'M', 8, NULL, NULL, 0),
	(1640, 1, 3530, 2, 0, 'M', 3, NULL, NULL, 0),
	(1641, 1, 3530, 2, 0, 'M', 3.5, NULL, NULL, 0),
	(1642, 1, 3530, 2, 0, 'M', 4, NULL, NULL, 0),
	(1643, 1, 3530, 2, 0, 'M', 4.5, NULL, NULL, 0),
	(1644, 1, 3530, 2, 0, 'M', 5, NULL, NULL, 0),
	(1645, 1, 3530, 2, 0, 'M', 5.5, NULL, NULL, 0),
	(1646, 1, 3530, 2, 0, 'M', 6, NULL, NULL, 0),
	(1647, 1, 3530, 2, 0, 'M', 6.5, NULL, NULL, 0),
	(1648, 1, 3530, 2, 0, 'M', 7, NULL, NULL, 0),
	(1649, 1, 3530, 2, 0, 'M', 7.5, NULL, NULL, 0),
	(1650, 1, 3530, 2, 0, 'M', 8, NULL, NULL, 0),
	(1651, 1, 3530, 3, 0, 'M', 3, NULL, NULL, 0),
	(1652, 1, 3530, 3, 0, 'M', 3.5, NULL, NULL, 0),
	(1653, 1, 3530, 3, 0, 'M', 4, NULL, NULL, 0),
	(1654, 1, 3530, 3, 0, 'M', 4.5, NULL, NULL, 0),
	(1655, 1, 3530, 3, 0, 'M', 5, NULL, NULL, 0),
	(1656, 1, 3530, 3, 0, 'M', 5.5, NULL, NULL, 0),
	(1657, 1, 3530, 3, 0, 'M', 6, NULL, NULL, 0),
	(1658, 1, 3530, 3, 0, 'M', 6.5, NULL, NULL, 0),
	(1659, 1, 3530, 3, 0, 'M', 7, NULL, NULL, 0),
	(1660, 1, 3530, 3, 0, 'M', 7.5, NULL, NULL, 0),
	(1661, 1, 3530, 3, 0, 'M', 8, NULL, NULL, 0),
	(1662, 1, 3530, 4, 0, 'M', 3, NULL, NULL, 0),
	(1663, 1, 3530, 4, 0, 'M', 3.5, NULL, NULL, 0),
	(1664, 1, 3530, 4, 0, 'M', 4, NULL, NULL, 0),
	(1665, 1, 3530, 4, 0, 'M', 4.5, NULL, NULL, 0),
	(1666, 1, 3530, 4, 0, 'M', 5, NULL, NULL, 0),
	(1667, 1, 3530, 4, 0, 'M', 5.5, NULL, NULL, 0),
	(1668, 1, 3530, 4, 0, 'M', 6, NULL, NULL, 0),
	(1669, 1, 3530, 4, 0, 'M', 6.5, NULL, NULL, 0),
	(1670, 1, 3530, 4, 0, 'M', 7, NULL, NULL, 0),
	(1671, 1, 3530, 4, 0, 'M', 7.5, NULL, NULL, 0),
	(1672, 1, 3530, 4, 0, 'M', 8, NULL, NULL, 0),
	(1673, 1, 3530, 5, 0, 'M', 3, NULL, NULL, 0),
	(1674, 1, 3530, 5, 0, 'M', 3.5, NULL, NULL, 0),
	(1675, 1, 3530, 5, 0, 'M', 4, NULL, NULL, 0),
	(1676, 1, 3530, 5, 0, 'M', 4.5, NULL, NULL, 0),
	(1677, 1, 3530, 5, 0, 'M', 5, NULL, NULL, 0),
	(1678, 1, 3530, 5, 0, 'M', 5.5, NULL, NULL, 0),
	(1679, 1, 3530, 5, 0, 'M', 6, NULL, NULL, 0),
	(1680, 1, 3530, 5, 0, 'M', 6.5, NULL, NULL, 0),
	(1681, 1, 3530, 5, 0, 'M', 7, NULL, NULL, 0),
	(1682, 1, 3530, 5, 0, 'M', 7.5, NULL, NULL, 0),
	(1683, 1, 3530, 5, 0, 'M', 8, NULL, NULL, 0),
	(1684, 1, 3531, 1, 0, 'df', 5, NULL, NULL, 0),
	(1685, 1, 3531, 1, 0, 'df', 5.5, NULL, NULL, 0),
	(1686, 1, 3531, 1, 0, 'df', 6, NULL, NULL, 0),
	(1687, 1, 3531, 1, 0, 'df', 6.5, NULL, NULL, 0),
	(1688, 1, 3531, 1, 0, 'df', 7, NULL, NULL, 0),
	(1689, 1, 3531, 2, 0, 'df', 5, NULL, NULL, 0),
	(1690, 1, 3531, 2, 0, 'df', 5.5, NULL, NULL, 0),
	(1691, 1, 3531, 2, 0, 'df', 6, NULL, NULL, 0),
	(1692, 1, 3531, 2, 0, 'df', 6.5, NULL, NULL, 0),
	(1693, 1, 3531, 2, 0, 'df', 7, NULL, NULL, 0),
	(1694, 1, 3531, 3, 0, 'df', 5, NULL, NULL, 0),
	(1695, 1, 3531, 3, 0, 'df', 5.5, NULL, NULL, 0),
	(1696, 1, 3531, 3, 0, 'df', 6, NULL, NULL, 0),
	(1697, 1, 3531, 3, 0, 'df', 6.5, NULL, NULL, 0),
	(1698, 1, 3531, 3, 0, 'df', 7, NULL, NULL, 0),
	(1699, 1, 3531, 4, 0, 'df', 5, NULL, NULL, 0),
	(1700, 1, 3531, 4, 0, 'df', 5.5, NULL, NULL, 0),
	(1701, 1, 3531, 4, 0, 'df', 6, NULL, NULL, 0),
	(1702, 1, 3531, 4, 0, 'df', 6.5, NULL, NULL, 0),
	(1703, 1, 3531, 4, 0, 'df', 7, NULL, NULL, 0),
	(1704, 1, 3531, 5, 0, 'df', 5, NULL, NULL, 0),
	(1705, 1, 3531, 5, 0, 'df', 5.5, NULL, NULL, 0),
	(1706, 1, 3531, 5, 0, 'df', 6, NULL, NULL, 0),
	(1707, 1, 3531, 5, 0, 'df', 6.5, NULL, NULL, 0),
	(1708, 1, 3531, 5, 0, 'df', 7, NULL, NULL, 0),
	(1709, 1, 3532, 1, 0, 'e', 1, NULL, NULL, 0),
	(1710, 1, 3532, 1, 0, 'e', 1.5, NULL, NULL, 0),
	(1711, 1, 3532, 1, 0, 'e', 2, NULL, NULL, 0),
	(1712, 1, 3532, 1, 0, 'e', 2.5, NULL, NULL, 0),
	(1713, 1, 3532, 1, 0, 'e', 3, NULL, NULL, 0),
	(1714, 1, 3532, 2, 0, 'e', 1, NULL, NULL, 0),
	(1715, 1, 3532, 2, 0, 'e', 1.5, NULL, NULL, 0),
	(1716, 1, 3532, 2, 0, 'e', 2, NULL, NULL, 0),
	(1717, 1, 3532, 2, 0, 'e', 2.5, NULL, NULL, 0),
	(1718, 1, 3532, 2, 0, 'e', 3, NULL, NULL, 0),
	(1719, 1, 3532, 3, 0, 'e', 1, NULL, NULL, 0),
	(1720, 1, 3532, 3, 0, 'e', 1.5, NULL, NULL, 0),
	(1721, 1, 3532, 3, 0, 'e', 2, NULL, NULL, 0),
	(1722, 1, 3532, 3, 0, 'e', 2.5, NULL, NULL, 0),
	(1723, 1, 3532, 3, 0, 'e', 3, NULL, NULL, 0),
	(1724, 1, 3532, 4, 0, 'e', 1, NULL, NULL, 0),
	(1725, 1, 3532, 4, 0, 'e', 1.5, NULL, NULL, 0),
	(1726, 1, 3532, 4, 0, 'e', 2, NULL, NULL, 0),
	(1727, 1, 3532, 4, 0, 'e', 2.5, NULL, NULL, 0),
	(1728, 1, 3532, 4, 0, 'e', 3, NULL, NULL, 0),
	(1729, 1, 3532, 5, 0, 'e', 1, NULL, NULL, 0),
	(1730, 1, 3532, 5, 0, 'e', 1.5, NULL, NULL, 0),
	(1731, 1, 3532, 5, 0, 'e', 2, NULL, NULL, 0),
	(1732, 1, 3532, 5, 0, 'e', 2.5, NULL, NULL, 0),
	(1733, 1, 3532, 5, 0, 'e', 3, NULL, NULL, 0),
	(1734, 1, 3533, 1, 0, 'sds', 3, NULL, NULL, 0),
	(1735, 1, 3533, 2, 0, 'sds', 3, NULL, NULL, 0),
	(1736, 1, 3533, 3, 0, 'sds', 3, NULL, NULL, 0),
	(1737, 1, 3533, 4, 0, 'sds', 3, NULL, NULL, 0),
	(1738, 1, 3533, 5, 0, 'sds', 3, NULL, NULL, 0),
	(1739, 1, 3534, 1, 0, 'e', 1, NULL, NULL, 0),
	(1740, 1, 3534, 1, 0, 'e', 1.5, NULL, NULL, 0),
	(1741, 1, 3534, 1, 0, 'e', 2, NULL, NULL, 0),
	(1742, 1, 3534, 2, 0, 'e', 1, NULL, NULL, 0),
	(1743, 1, 3534, 2, 0, 'e', 1.5, NULL, NULL, 0),
	(1744, 1, 3534, 2, 0, 'e', 2, NULL, NULL, 0),
	(1745, 1, 3534, 3, 0, 'e', 1, NULL, NULL, 0),
	(1746, 1, 3534, 3, 0, 'e', 1.5, NULL, NULL, 0),
	(1747, 1, 3534, 3, 0, 'e', 2, NULL, NULL, 0),
	(1748, 1, 3534, 4, 0, 'e', 1, NULL, NULL, 0),
	(1749, 1, 3534, 4, 0, 'e', 1.5, NULL, NULL, 0),
	(1750, 1, 3534, 4, 0, 'e', 2, NULL, NULL, 0),
	(1751, 1, 3534, 5, 0, 'e', 1, NULL, NULL, 0),
	(1752, 1, 3534, 5, 0, 'e', 1.5, NULL, NULL, 0),
	(1753, 1, 3534, 5, 0, 'e', 2, NULL, NULL, 0),
	(1754, 1, 3535, 1, 0, 'modelo', 1, NULL, NULL, 0),
	(1755, 1, 3535, 1, 1, 'modelo', 1.5, NULL, NULL, 0),
	(1756, 1, 3535, 1, 1, 'modelo', 2, NULL, NULL, 0),
	(1757, 1, 3535, 2, 0, 'modelo', 1, NULL, NULL, 0),
	(1758, 1, 3535, 2, 0, 'modelo', 1.5, NULL, NULL, 0),
	(1759, 1, 3535, 2, 0, 'modelo', 2, NULL, NULL, 0),
	(1760, 1, 3535, 3, 0, 'modelo', 1, NULL, NULL, 0),
	(1761, 1, 3535, 3, 0, 'modelo', 1.5, NULL, NULL, 0),
	(1762, 1, 3535, 3, 0, 'modelo', 2, NULL, NULL, 0),
	(1763, 1, 3535, 4, 1, 'modelo', 1, NULL, NULL, 0),
	(1764, 1, 3535, 4, 0, 'modelo', 1.5, NULL, NULL, 0),
	(1765, 1, 3535, 4, 0, 'modelo', 2, NULL, NULL, 0),
	(1766, 1, 3535, 5, 0, 'modelo', 1, NULL, NULL, 0),
	(1767, 1, 3535, 5, 0, 'modelo', 1.5, NULL, NULL, 0),
	(1768, 1, 3535, 5, 0, 'modelo', 2, NULL, NULL, 0),
	(1769, 1, 3536, 1, 0, 'aaa', 1, NULL, NULL, 0),
	(1770, 1, 3536, 1, 0, 'aaa', 1.5, NULL, NULL, 0),
	(1771, 1, 3536, 1, 0, 'aaa', 2, NULL, NULL, 0),
	(1772, 1, 3536, 1, 0, 'aaa', 2.5, NULL, NULL, 0),
	(1773, 1, 3536, 1, 0, 'aaa', 3, NULL, NULL, 0),
	(1774, 1, 3536, 2, 0, 'aaa', 1, NULL, NULL, 0),
	(1775, 1, 3536, 2, 0, 'aaa', 1.5, NULL, NULL, 0),
	(1776, 1, 3536, 2, 0, 'aaa', 2, NULL, NULL, 0),
	(1777, 1, 3536, 2, 0, 'aaa', 2.5, NULL, NULL, 0),
	(1778, 1, 3536, 2, 0, 'aaa', 3, NULL, NULL, 0),
	(1779, 1, 3536, 3, 0, 'aaa', 1, NULL, NULL, 0),
	(1780, 1, 3536, 3, 0, 'aaa', 1.5, NULL, NULL, 0),
	(1781, 1, 3536, 3, 0, 'aaa', 2, NULL, NULL, 0),
	(1782, 1, 3536, 3, 0, 'aaa', 2.5, NULL, NULL, 0),
	(1783, 1, 3536, 3, 0, 'aaa', 3, NULL, NULL, 0),
	(1784, 1, 3536, 4, 0, 'aaa', 1, NULL, NULL, 0),
	(1785, 1, 3536, 4, 0, 'aaa', 1.5, NULL, NULL, 0),
	(1786, 1, 3536, 4, 0, 'aaa', 2, NULL, NULL, 0),
	(1787, 1, 3536, 4, 0, 'aaa', 2.5, NULL, NULL, 0),
	(1788, 1, 3536, 4, 0, 'aaa', 3, NULL, NULL, 0),
	(1789, 1, 3536, 5, 0, 'aaa', 1, NULL, NULL, 0),
	(1790, 1, 3536, 5, 2, 'aaa', 1.5, NULL, NULL, 0),
	(1791, 1, 3536, 5, 1, 'aaa', 2, NULL, NULL, 0),
	(1792, 1, 3536, 5, 0, 'aaa', 2.5, NULL, NULL, 0),
	(1793, 1, 3536, 5, 0, 'aaa', 3, NULL, NULL, 0),
	(1794, 1, 3537, 1, 0, 'M555', 3, NULL, NULL, 0),
	(1795, 1, 3537, 1, 0, 'M555', 3.5, NULL, NULL, 0),
	(1796, 1, 3537, 1, 0, 'M555', 4, NULL, NULL, 0),
	(1797, 1, 3537, 1, 0, 'M555', 4.5, NULL, NULL, 0),
	(1798, 1, 3537, 1, 0, 'M555', 5, NULL, NULL, 0),
	(1799, 1, 3537, 2, 0, 'M555', 3, NULL, NULL, 0),
	(1800, 1, 3537, 2, 0, 'M555', 3.5, NULL, NULL, 0),
	(1801, 1, 3537, 2, 0, 'M555', 4, NULL, NULL, 0),
	(1802, 1, 3537, 2, 0, 'M555', 4.5, NULL, NULL, 0),
	(1803, 1, 3537, 2, 0, 'M555', 5, NULL, NULL, 0),
	(1804, 1, 3537, 3, 0, 'M555', 3, NULL, NULL, 0),
	(1805, 1, 3537, 3, 0, 'M555', 3.5, NULL, NULL, 0),
	(1806, 1, 3537, 3, 0, 'M555', 4, NULL, NULL, 0),
	(1807, 1, 3537, 3, 0, 'M555', 4.5, NULL, NULL, 0),
	(1808, 1, 3537, 3, 0, 'M555', 5, NULL, NULL, 0),
	(1809, 1, 3537, 4, 0, 'M555', 3, NULL, NULL, 0),
	(1810, 1, 3537, 4, 0, 'M555', 3.5, NULL, NULL, 0),
	(1811, 1, 3537, 4, 0, 'M555', 4, NULL, NULL, 0),
	(1812, 1, 3537, 4, 0, 'M555', 4.5, NULL, NULL, 0),
	(1813, 1, 3537, 4, 0, 'M555', 5, NULL, NULL, 0),
	(1814, 1, 3537, 5, 0, 'M555', 3, NULL, NULL, 0),
	(1815, 1, 3537, 5, 0, 'M555', 3.5, NULL, NULL, 0),
	(1816, 1, 3537, 5, 0, 'M555', 4, NULL, NULL, 0),
	(1817, 1, 3537, 5, 0, 'M555', 4.5, NULL, NULL, 0),
	(1818, 1, 3537, 5, 0, 'M555', 5, NULL, NULL, 0),
	(1819, 1, 3538, 1, 0, 'h258', 4, NULL, NULL, 0),
	(1820, 1, 3538, 1, 0, 'h258', 4.5, NULL, NULL, 0),
	(1821, 1, 3538, 1, 0, 'h258', 5, NULL, NULL, 0),
	(1822, 1, 3538, 1, 0, 'h258', 5.5, NULL, NULL, 0),
	(1823, 1, 3538, 1, 0, 'h258', 6, NULL, NULL, 0),
	(1824, 1, 3538, 2, 0, 'h258', 4, NULL, NULL, 0),
	(1825, 1, 3538, 2, 0, 'h258', 4.5, NULL, NULL, 0),
	(1826, 1, 3538, 2, 0, 'h258', 5, NULL, NULL, 0),
	(1827, 1, 3538, 2, 0, 'h258', 5.5, NULL, NULL, 0),
	(1828, 1, 3538, 2, 0, 'h258', 6, NULL, NULL, 0),
	(1829, 1, 3538, 3, 0, 'h258', 4, NULL, NULL, 0),
	(1830, 1, 3538, 3, 0, 'h258', 4.5, NULL, NULL, 0),
	(1831, 1, 3538, 3, 0, 'h258', 5, NULL, NULL, 0),
	(1832, 1, 3538, 3, 0, 'h258', 5.5, NULL, NULL, 0),
	(1833, 1, 3538, 3, 0, 'h258', 6, NULL, NULL, 0),
	(1834, 1, 3538, 4, 0, 'h258', 4, NULL, NULL, 0),
	(1835, 1, 3538, 4, 0, 'h258', 4.5, NULL, NULL, 0),
	(1836, 1, 3538, 4, 0, 'h258', 5, NULL, NULL, 0),
	(1837, 1, 3538, 4, 0, 'h258', 5.5, NULL, NULL, 0),
	(1838, 1, 3538, 4, 0, 'h258', 6, NULL, NULL, 0),
	(1839, 1, 3538, 5, 0, 'h258', 4, NULL, NULL, 0),
	(1840, 1, 3538, 5, 0, 'h258', 4.5, NULL, NULL, 0),
	(1841, 1, 3538, 5, 0, 'h258', 5, NULL, NULL, 0),
	(1842, 1, 3538, 5, 0, 'h258', 5.5, NULL, NULL, 0),
	(1843, 1, 3538, 5, 0, 'h258', 6, NULL, NULL, 0),
	(1844, 1, 3539, 1, 0, 'modelo', 5, NULL, NULL, 0),
	(1845, 1, 3539, 1, 0, 'modelo', 5.5, NULL, NULL, 0),
	(1846, 1, 3539, 1, 0, 'modelo', 6, NULL, NULL, 0),
	(1847, 1, 3539, 1, 0, 'modelo', 6.5, NULL, NULL, 0),
	(1848, 1, 3539, 1, 0, 'modelo', 7, NULL, NULL, 0),
	(1849, 1, 3539, 1, 0, 'modelo', 7.5, NULL, NULL, 0),
	(1850, 1, 3539, 1, 0, 'modelo', 8, NULL, NULL, 0),
	(1851, 1, 3539, 1, 0, 'modelo', 8.5, NULL, NULL, 0),
	(1852, 1, 3539, 1, 0, 'modelo', 9, NULL, NULL, 0),
	(1853, 1, 3539, 1, 0, 'modelo', 9.5, NULL, NULL, 0),
	(1854, 1, 3539, 1, 0, 'modelo', 10, NULL, NULL, 0),
	(1855, 1, 3539, 2, 0, 'modelo', 5, NULL, NULL, 0),
	(1856, 1, 3539, 2, 0, 'modelo', 5.5, NULL, NULL, 0),
	(1857, 1, 3539, 2, 0, 'modelo', 6, NULL, NULL, 0),
	(1858, 1, 3539, 2, 0, 'modelo', 6.5, NULL, NULL, 0),
	(1859, 1, 3539, 2, 0, 'modelo', 7, NULL, NULL, 0),
	(1860, 1, 3539, 2, 0, 'modelo', 7.5, NULL, NULL, 0),
	(1861, 1, 3539, 2, 0, 'modelo', 8, NULL, NULL, 0),
	(1862, 1, 3539, 2, 0, 'modelo', 8.5, NULL, NULL, 0),
	(1863, 1, 3539, 2, 0, 'modelo', 9, NULL, NULL, 0),
	(1864, 1, 3539, 2, 0, 'modelo', 9.5, NULL, NULL, 0),
	(1865, 1, 3539, 2, 0, 'modelo', 10, NULL, NULL, 0),
	(1866, 1, 3539, 3, 0, 'modelo', 5, NULL, NULL, 0),
	(1867, 1, 3539, 3, 0, 'modelo', 5.5, NULL, NULL, 0),
	(1868, 1, 3539, 3, 0, 'modelo', 6, NULL, NULL, 0),
	(1869, 1, 3539, 3, 0, 'modelo', 6.5, NULL, NULL, 0),
	(1870, 1, 3539, 3, 0, 'modelo', 7, NULL, NULL, 0),
	(1871, 1, 3539, 3, 0, 'modelo', 7.5, NULL, NULL, 0),
	(1872, 1, 3539, 3, 0, 'modelo', 8, NULL, NULL, 0),
	(1873, 1, 3539, 3, 0, 'modelo', 8.5, NULL, NULL, 0),
	(1874, 1, 3539, 3, 0, 'modelo', 9, NULL, NULL, 0),
	(1875, 1, 3539, 3, 0, 'modelo', 9.5, NULL, NULL, 0),
	(1876, 1, 3539, 3, 0, 'modelo', 10, NULL, NULL, 0),
	(1877, 1, 3539, 4, 0, 'modelo', 5, NULL, NULL, 0),
	(1878, 1, 3539, 4, 0, 'modelo', 5.5, NULL, NULL, 0),
	(1879, 1, 3539, 4, 0, 'modelo', 6, NULL, NULL, 0),
	(1880, 1, 3539, 4, 0, 'modelo', 6.5, NULL, NULL, 0),
	(1881, 1, 3539, 4, 0, 'modelo', 7, NULL, NULL, 0),
	(1882, 1, 3539, 4, 0, 'modelo', 7.5, NULL, NULL, 0),
	(1883, 1, 3539, 4, 0, 'modelo', 8, NULL, NULL, 0),
	(1884, 1, 3539, 4, 0, 'modelo', 8.5, NULL, NULL, 0),
	(1885, 1, 3539, 4, 0, 'modelo', 9, NULL, NULL, 0),
	(1886, 1, 3539, 4, 0, 'modelo', 9.5, NULL, NULL, 0),
	(1887, 1, 3539, 4, 0, 'modelo', 10, NULL, NULL, 0),
	(1888, 1, 3539, 5, 0, 'modelo', 5, NULL, NULL, 0),
	(1889, 1, 3539, 5, 0, 'modelo', 5.5, NULL, NULL, 0),
	(1890, 1, 3539, 5, 0, 'modelo', 6, NULL, NULL, 0),
	(1891, 1, 3539, 5, 0, 'modelo', 6.5, NULL, NULL, 0),
	(1892, 1, 3539, 5, 0, 'modelo', 7, NULL, NULL, 0),
	(1893, 1, 3539, 5, 0, 'modelo', 7.5, NULL, NULL, 0),
	(1894, 1, 3539, 5, 0, 'modelo', 8, NULL, NULL, 0),
	(1895, 1, 3539, 5, 0, 'modelo', 8.5, NULL, NULL, 0),
	(1896, 1, 3539, 5, 0, 'modelo', 9, NULL, NULL, 0),
	(1897, 1, 3539, 5, 0, 'modelo', 9.5, NULL, NULL, 0),
	(1898, 1, 3539, 5, 0, 'modelo', 10, NULL, NULL, 0),
	(1899, 1, 3540, 1, 0, 'modelop', 6, NULL, NULL, 0),
	(1900, 1, 3540, 1, 0, 'modelop', 6.5, NULL, NULL, 0),
	(1901, 1, 3540, 1, 0, 'modelop', 7, NULL, NULL, 0),
	(1902, 1, 3540, 1, 0, 'modelop', 7.5, NULL, NULL, 0),
	(1903, 1, 3540, 1, 0, 'modelop', 8, NULL, NULL, 0),
	(1904, 1, 3540, 1, 0, 'modelop', 8.5, NULL, NULL, 0),
	(1905, 1, 3540, 1, 0, 'modelop', 9, NULL, NULL, 0),
	(1906, 1, 3540, 1, 0, 'modelop', 9.5, NULL, NULL, 0),
	(1907, 1, 3540, 1, 0, 'modelop', 10, NULL, NULL, 0),
	(1908, 1, 3540, 1, 0, 'modelop', 10.5, NULL, NULL, 0),
	(1909, 1, 3540, 1, 0, 'modelop', 11, NULL, NULL, 0),
	(1910, 1, 3540, 1, 0, 'modelop', 11.5, NULL, NULL, 0),
	(1911, 1, 3540, 1, 0, 'modelop', 12, NULL, NULL, 0),
	(1912, 1, 3540, 2, 0, 'modelop', 6, NULL, NULL, 0),
	(1913, 1, 3540, 2, 0, 'modelop', 6.5, NULL, NULL, 0),
	(1914, 1, 3540, 2, 0, 'modelop', 7, NULL, NULL, 0),
	(1915, 1, 3540, 2, 0, 'modelop', 7.5, NULL, NULL, 0),
	(1916, 1, 3540, 2, 0, 'modelop', 8, NULL, NULL, 0),
	(1917, 1, 3540, 2, 0, 'modelop', 8.5, NULL, NULL, 0),
	(1918, 1, 3540, 2, 0, 'modelop', 9, NULL, NULL, 0),
	(1919, 1, 3540, 2, 0, 'modelop', 9.5, NULL, NULL, 0),
	(1920, 1, 3540, 2, 0, 'modelop', 10, NULL, NULL, 0),
	(1921, 1, 3540, 2, 0, 'modelop', 10.5, NULL, NULL, 0),
	(1922, 1, 3540, 2, 0, 'modelop', 11, NULL, NULL, 0),
	(1923, 1, 3540, 2, 0, 'modelop', 11.5, NULL, NULL, 0),
	(1924, 1, 3540, 2, 0, 'modelop', 12, NULL, NULL, 0),
	(1925, 1, 3540, 3, 0, 'modelop', 6, NULL, NULL, 0),
	(1926, 1, 3540, 3, 0, 'modelop', 6.5, NULL, NULL, 0),
	(1927, 1, 3540, 3, 0, 'modelop', 7, NULL, NULL, 0),
	(1928, 1, 3540, 3, 0, 'modelop', 7.5, NULL, NULL, 0),
	(1929, 1, 3540, 3, 0, 'modelop', 8, NULL, NULL, 0),
	(1930, 1, 3540, 3, 0, 'modelop', 8.5, NULL, NULL, 0),
	(1931, 1, 3540, 3, 0, 'modelop', 9, NULL, NULL, 0),
	(1932, 1, 3540, 3, 0, 'modelop', 9.5, NULL, NULL, 0),
	(1933, 1, 3540, 3, 0, 'modelop', 10, NULL, NULL, 0),
	(1934, 1, 3540, 3, 0, 'modelop', 10.5, NULL, NULL, 0),
	(1935, 1, 3540, 3, 0, 'modelop', 11, NULL, NULL, 0),
	(1936, 1, 3540, 3, 0, 'modelop', 11.5, NULL, NULL, 0),
	(1937, 1, 3540, 3, 0, 'modelop', 12, NULL, NULL, 0),
	(1938, 1, 3540, 4, 0, 'modelop', 6, NULL, NULL, 0),
	(1939, 1, 3540, 4, 0, 'modelop', 6.5, NULL, NULL, 0),
	(1940, 1, 3540, 4, 0, 'modelop', 7, NULL, NULL, 0),
	(1941, 1, 3540, 4, 0, 'modelop', 7.5, NULL, NULL, 0),
	(1942, 1, 3540, 4, 0, 'modelop', 8, NULL, NULL, 0),
	(1943, 1, 3540, 4, 0, 'modelop', 8.5, NULL, NULL, 0),
	(1944, 1, 3540, 4, 0, 'modelop', 9, NULL, NULL, 0),
	(1945, 1, 3540, 4, 0, 'modelop', 9.5, NULL, NULL, 0),
	(1946, 1, 3540, 4, 0, 'modelop', 10, NULL, NULL, 0),
	(1947, 1, 3540, 4, 0, 'modelop', 10.5, NULL, NULL, 0),
	(1948, 1, 3540, 4, 0, 'modelop', 11, NULL, NULL, 0),
	(1949, 1, 3540, 4, 0, 'modelop', 11.5, NULL, NULL, 0),
	(1950, 1, 3540, 4, 0, 'modelop', 12, NULL, NULL, 0),
	(1951, 1, 3540, 5, 0, 'modelop', 6, NULL, NULL, 0),
	(1952, 1, 3540, 5, 0, 'modelop', 6.5, NULL, NULL, 0),
	(1953, 1, 3540, 5, 0, 'modelop', 7, NULL, NULL, 0),
	(1954, 1, 3540, 5, 0, 'modelop', 7.5, NULL, NULL, 0),
	(1955, 1, 3540, 5, 0, 'modelop', 8, NULL, NULL, 0),
	(1956, 1, 3540, 5, 0, 'modelop', 8.5, NULL, NULL, 0),
	(1957, 1, 3540, 5, 0, 'modelop', 9, NULL, NULL, 0),
	(1958, 1, 3540, 5, 0, 'modelop', 9.5, NULL, NULL, 0),
	(1959, 1, 3540, 5, 0, 'modelop', 10, NULL, NULL, 0),
	(1960, 1, 3540, 5, 0, 'modelop', 10.5, NULL, NULL, 0),
	(1961, 1, 3540, 5, 0, 'modelop', 11, NULL, NULL, 0),
	(1962, 1, 3540, 5, 0, 'modelop', 11.5, NULL, NULL, 0),
	(1963, 1, 3540, 5, 0, 'modelop', 12, NULL, NULL, 0),
	(2114, 1, 3540, 1, 0, 'modelop', 12.5, NULL, NULL, 0),
	(2115, 1, 3540, 2, 0, 'modelop', 12.5, NULL, NULL, 0),
	(2116, 1, 3540, 3, 0, 'modelop', 12.5, NULL, NULL, 0),
	(2117, 1, 3540, 4, 0, 'modelop', 12.5, NULL, NULL, 0),
	(2118, 1, 3540, 5, 0, 'modelop', 12.5, NULL, NULL, 0),
	(2119, 1, 3540, 1, 0, 'modelop', 13, NULL, NULL, 0),
	(2120, 1, 3540, 2, 0, 'modelop', 13, NULL, NULL, 0),
	(2121, 1, 3540, 3, 0, 'modelop', 13, NULL, NULL, 0),
	(2122, 1, 3540, 4, 0, 'modelop', 13, NULL, NULL, 0),
	(2123, 1, 3540, 5, 0, 'modelop', 13, NULL, NULL, 0),
	(2159, 1, 3542, 1, 0, 'MODELO', 5, NULL, NULL, 0),
	(2160, 1, 3542, 1, 0, '  MODELO', 5.5, '', '1900-01-01', 0),
	(2161, 1, 3542, 1, 10, ' MODELO', 6, '', '1900-01-01', 0),
	(2162, 1, 3542, 1, 0, 'MODELO', 6.5, NULL, NULL, 0),
	(2163, 1, 3542, 1, 0, 'MODELO', 7, NULL, NULL, 0),
	(2164, 1, 3542, 1, 0, 'MODELO', 7.5, NULL, NULL, 0),
	(2165, 1, 3542, 1, 0, 'MODELO', 8, NULL, NULL, 0),
	(2166, 1, 3542, 1, 0, 'MODELO', 8.5, NULL, NULL, 0),
	(2167, 1, 3542, 1, 0, 'MODELO', 9, NULL, NULL, 0),
	(2168, 1, 3542, 2, 0, 'MODELO', 5, NULL, NULL, 0),
	(2169, 1, 3542, 2, 0, 'MODELO', 5.5, NULL, NULL, 0),
	(2170, 1, 3542, 2, 0, 'MODELO', 6, NULL, NULL, 0),
	(2171, 1, 3542, 2, 0, 'MODELO', 6.5, NULL, NULL, 0),
	(2172, 1, 3542, 2, 0, 'MODELO', 7, NULL, NULL, 0),
	(2173, 1, 3542, 2, 0, 'MODELO', 7.5, NULL, NULL, 0),
	(2174, 1, 3542, 2, 0, 'MODELO', 8, NULL, NULL, 0),
	(2175, 1, 3542, 2, 0, 'MODELO', 8.5, NULL, NULL, 0),
	(2176, 1, 3542, 2, 0, 'MODELO', 9, NULL, NULL, 0),
	(2177, 1, 3542, 3, 0, 'MODELO', 5, NULL, NULL, 0),
	(2178, 1, 3542, 3, 0, 'MODELO', 5.5, NULL, NULL, 0),
	(2179, 1, 3542, 3, 0, 'MODELO', 6, NULL, NULL, 0),
	(2180, 1, 3542, 3, 0, 'MODELO', 6.5, NULL, NULL, 0),
	(2181, 1, 3542, 3, 0, 'MODELO', 7, NULL, NULL, 0),
	(2182, 1, 3542, 3, 0, 'MODELO', 7.5, NULL, NULL, 0),
	(2183, 1, 3542, 3, 0, 'MODELO', 8, NULL, NULL, 0),
	(2184, 1, 3542, 3, 0, 'MODELO', 8.5, NULL, NULL, 0),
	(2185, 1, 3542, 3, 0, 'MODELO', 9, NULL, NULL, 0),
	(2186, 1, 3542, 4, 0, 'MODELO', 5, NULL, NULL, 0),
	(2187, 1, 3542, 4, 0, 'MODELO', 5.5, NULL, NULL, 0),
	(2188, 1, 3542, 4, 0, 'MODELO', 6, NULL, NULL, 0),
	(2189, 1, 3542, 4, 0, 'MODELO', 6.5, NULL, NULL, 0),
	(2190, 1, 3542, 4, 0, 'MODELO', 7, NULL, NULL, 0),
	(2191, 1, 3542, 4, 0, 'MODELO', 7.5, NULL, NULL, 0),
	(2192, 1, 3542, 4, 0, 'MODELO', 8, NULL, NULL, 0),
	(2193, 1, 3542, 4, 0, 'MODELO', 8.5, NULL, NULL, 0),
	(2194, 1, 3542, 4, 0, 'MODELO', 9, NULL, NULL, 0),
	(2195, 1, 3542, 5, 0, 'MODELO', 5, NULL, NULL, 0),
	(2196, 1, 3542, 5, 0, 'MODELO', 5.5, NULL, NULL, 0),
	(2197, 1, 3542, 5, 0, 'MODELO', 6, NULL, NULL, 0),
	(2198, 1, 3542, 5, 0, 'MODELO', 6.5, NULL, NULL, 0),
	(2199, 1, 3542, 5, 0, 'MODELO', 7, NULL, NULL, 0),
	(2200, 1, 3542, 5, 0, 'MODELO', 7.5, NULL, NULL, 0),
	(2201, 1, 3542, 5, 0, 'MODELO', 8, NULL, NULL, 0),
	(2202, 1, 3542, 5, 0, 'MODELO', 8.5, NULL, NULL, 0),
	(2203, 1, 3542, 5, 0, 'MODELO', 9, NULL, NULL, 0);
/*!40000 ALTER TABLE `inventario` ENABLE KEYS */;

-- Volcando estructura para tabla pventa.mtosalidas
CREATE TABLE IF NOT EXISTS `mtosalidas` (
  `idunicosal` int(12) NOT NULL AUTO_INCREMENT COMMENT 'id unico de la salida',
  `idunicoe` int(12) DEFAULT NULL COMMENT 'id unico de la empresa',
  `idunicos` int(12) DEFAULT NULL COMMENT 'id unico de la sucursal',
  `tiposal` int(1) DEFAULT NULL COMMENT 'tipo de salida 0=venta 1=traspaso 2=baja 3=baja x devolucion',
  `idunicou` int(12) DEFAULT NULL COMMENT 'id unico del usuario',
  `fecha` datetime DEFAULT NULL COMMENT 'hora con fecha de venta',
  `idunicotras` int(12) DEFAULT NULL COMMENT 'idunico del traspaso consecutivo de traspasos por empresa/sucursal',
  `idunicosr` int(12) DEFAULT NULL COMMENT 'id unico de la sucursal que recibe el traspaso',
  `ticket` int(12) DEFAULT NULL COMMENT 'numero de salida consecutivo de empresa/sucursal',
  `baja` int(12) DEFAULT NULL COMMENT 'id unico de la baja consecutivo por empresa/sucursal',
  `total` float(12,2) DEFAULT NULL COMMENT 'importe total del ticket',
  `pago` float(12,2) DEFAULT NULL COMMENT 'pago que da el cliente',
  `cambio` float(12,2) DEFAULT NULL COMMENT 'cambio que se le da al cliente',
  KEY `Índice 1` (`idunicosal`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='maestro de salidas';

-- Volcando datos para la tabla pventa.mtosalidas: ~11 rows (aproximadamente)
/*!40000 ALTER TABLE `mtosalidas` DISABLE KEYS */;
REPLACE INTO `mtosalidas` (`idunicosal`, `idunicoe`, `idunicos`, `tiposal`, `idunicou`, `fecha`, `idunicotras`, `idunicosr`, `ticket`, `baja`, `total`, `pago`, `cambio`) VALUES
	(39, 1, 1, 0, 35, '2017-04-03 00:00:00', 0, 0, 1, 0, 390.00, 500.00, -110.00),
	(40, 1, 1, 0, 35, '2017-04-03 00:00:00', 0, 0, 2, 0, 410.00, 500.00, -90.00),
	(41, 1, 1, 0, 35, '2017-04-03 00:00:00', 0, 0, 3, 0, 410.00, 500.00, -90.00),
	(42, 1, 1, 0, 35, '2017-04-03 00:00:00', 0, 0, 4, 0, 390.00, 400.00, -10.00),
	(43, 1, 1, 0, 35, '2017-04-03 00:00:00', 0, 0, 5, 0, 410.00, 450.00, -40.00),
	(44, 1, 1, 0, 35, '2017-05-08 00:00:00', 0, 0, 6, 0, 156.60, 800.00, -643.40),
	(45, 1, 1, 0, 35, '2017-05-08 00:00:00', 0, 0, 7, 0, 187.92, 450.00, -262.08),
	(46, 1, 1, 0, 35, '2017-05-08 00:00:00', 0, 0, 8, 0, 125.28, 200.00, -74.72),
	(47, 1, 1, 0, 35, '2018-02-12 00:00:00', 0, 0, 9, 0, 205.00, 210.00, -5.00),
	(48, 1, 1, 0, 35, '2018-02-12 00:00:00', 0, 0, 10, 0, 185.60, 200.00, -14.40),
	(49, 1, 1, 1, 33, '2018-02-12 00:00:00', 1, 4, 0, 0, 185.60, NULL, NULL);
/*!40000 ALTER TABLE `mtosalidas` ENABLE KEYS */;

-- Volcando estructura para tabla pventa.productos
CREATE TABLE IF NOT EXISTS `productos` (
  `idunicop` int(12) NOT NULL AUTO_INCREMENT COMMENT 'idunico del producto',
  `idunicoe` int(12) DEFAULT NULL COMMENT 'id unico de la empresa',
  `codigo` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'codigo del producto',
  `nombrep` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'nombre del producto',
  `descrip` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'descripcion del producto',
  `ultpcompra` float(12,2) DEFAULT NULL COMMENT 'ultimo precio de compra',
  `pmostrador` float(12,2) DEFAULT NULL COMMENT 'precio de mostrador',
  `stock` int(12) DEFAULT NULL COMMENT 'numero de stock',
  `iva` int(2) DEFAULT NULL COMMENT 'porcentaje de iva',
  `descuento` int(2) DEFAULT NULL COMMENT 'porcentaje de descuento',
  `marca` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'marca del producto',
  `color` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'color del producto',
  `serie` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `tipo` int(11) NOT NULL COMMENT 'tipo 0=producto 1=servicio',
  `idunicopr` int(11) NOT NULL COMMENT 'id unico del proveedor',
  `cvetip` int(11) NOT NULL COMMENT 'clave del tipo de productos',
  PRIMARY KEY (`idunicop`)
) ENGINE=InnoDB AUTO_INCREMENT=3543 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='catalogo principal de productos por empresa';

-- Volcando datos para la tabla pventa.productos: ~13 rows (aproximadamente)
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
REPLACE INTO `productos` (`idunicop`, `idunicoe`, `codigo`, `nombrep`, `descrip`, `ultpcompra`, `pmostrador`, `stock`, `iva`, `descuento`, `marca`, `color`, `serie`, `tipo`, `idunicopr`, `cvetip`) VALUES
	(3528, 1, '00050101B0100262A', 'A POINT', 'TENIS 2/5', 130.00, 205.00, 0, 0, 0, '', 'ROJO BCO', '', 0, 1, 0),
	(3529, 1, '707070', 'desc', 'tipo', 100.00, 160.00, 0, 0, 0, 'marca', 'color', '', 0, 1, 0),
	(3530, 1, '808080', 'descr1', 'SSKSK', 100.00, 160.00, 0, 16, 0, 'M', 'C', '', 0, 1, 0),
	(3531, 1, '4545', 'descr2', 'wew', 123.00, 195.00, 0, 16, 0, 'df', 'dfd', '', 0, 1, 0),
	(3532, 1, '454554', 'descr3', 'erere', 100.00, 160.00, 0, 16, 0, 'e', 'e', '', 0, 1, 0),
	(3533, 1, '4545', 'descr4', 's', 1222.00, 1843.00, 0, 16, 0, 'ssds', 'ss', '', 0, 1, 0),
	(3534, 1, '4546', 'dama', '444', 4.00, 16.00, 0, 16, 0, 'e', 'e', '', 0, 1, 0),
	(3535, 1, '8080', 'caballero', 'tipo', 100.00, 160.00, 0, 16, 0, 'marca', 'color', '', 0, 1, 0),
	(3536, 1, '9090', 'prueba', 'tipo', 11.00, 27.00, 0, 16, 0, 'Q', 'amarillo', '', 0, 1, 0),
	(3537, 1, '151516', 'zapato dama', '', 100.00, 160.00, 0, 16, 0, 'andrea', 'negro', '', 0, 1, 1),
	(3538, 1, '141425', 'zapato hombre', '', 150.00, 235.00, 0, 16, 0, 'andrea', 'cafe', '', 0, 2, 2),
	(3539, 1, '363625', 'descripcion', '', 250.00, 385.00, 0, 16, 0, 'marca', 'color', '', 0, 2, 1),
	(3542, 1, '787898', 'DESCRIP', '', 100.00, 160.00, 0, 16, 0, 'MARCA', 'COLOR', '', 0, 1, 1);
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;

-- Volcando estructura para tabla pventa.proveedores
CREATE TABLE IF NOT EXISTS `proveedores` (
  `idunicopr` int(12) NOT NULL COMMENT 'idunico del proveedor',
  `idunicoe` int(12) NOT NULL COMMENT 'id unico de la empresa',
  `nombre` varchar(80) NOT NULL COMMENT 'nombre del proveedor'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='catalogo de proveedores';

-- Volcando datos para la tabla pventa.proveedores: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `proveedores` DISABLE KEYS */;
REPLACE INTO `proveedores` (`idunicopr`, `idunicoe`, `nombre`) VALUES
	(1, 1, 'Proveedor 1'),
	(2, 1, 'Proveedor2'),
	(3, 1, 'Provedor3');
/*!40000 ALTER TABLE `proveedores` ENABLE KEYS */;

-- Volcando estructura para tabla pventa.registro
CREATE TABLE IF NOT EXISTS `registro` (
  `idregistro` int(12) DEFAULT NULL COMMENT 'idunico del registro',
  `appaterno` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'apellido paterno',
  `apmaterno` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'apellido materno',
  `nombre` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'nombre',
  `correo` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'correo electronico',
  `telefono` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'telefono',
  `autentificado` int(1) DEFAULT NULL COMMENT '0=no autentificado 1= si auntetificado',
  `fechar` date DEFAULT NULL COMMENT 'fecha de registro',
  `login` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'login principal',
  `password` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'password principal'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='almacena los registros en web';

-- Volcando datos para la tabla pventa.registro: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `registro` DISABLE KEYS */;
REPLACE INTO `registro` (`idregistro`, `appaterno`, `apmaterno`, `nombre`, `correo`, `telefono`, `autentificado`, `fechar`, `login`, `password`) VALUES
	(1, '.', '.', 'Rubicel', 'rubicel31@gmail.com', '7717177777', 1, '2016-07-21', 'rubicel', '1');
/*!40000 ALTER TABLE `registro` ENABLE KEYS */;

-- Volcando estructura para tabla pventa.sesiones
CREATE TABLE IF NOT EXISTS `sesiones` (
  `idsesion` int(12) NOT NULL AUTO_INCREMENT,
  `idregistro` int(12) DEFAULT NULL,
  `idunicou` int(12) DEFAULT NULL,
  `dirip` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `login` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idsesion`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla pventa.sesiones: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `sesiones` DISABLE KEYS */;
REPLACE INTO `sesiones` (`idsesion`, `idregistro`, `idunicou`, `dirip`, `login`) VALUES
	(16, 1, 0, '127.0.0.1', 'rubicel'),
	(17, 0, 33, '127.0.0.1', 'adminixmi'),
	(18, 0, 37, '127.0.0.1', 'adminzima'),
	(19, 0, 34, '127.0.0.1', 'superixmi'),
	(20, 0, 35, '127.0.0.1', 'ventaixmi1');
/*!40000 ALTER TABLE `sesiones` ENABLE KEYS */;

-- Volcando estructura para tabla pventa.sucursal
CREATE TABLE IF NOT EXISTS `sucursal` (
  `idunicos` int(12) NOT NULL AUTO_INCREMENT COMMENT 'id unico de la sucursal ',
  `idunicoe` int(12) DEFAULT NULL COMMENT 'id unico de la empresa',
  `nombre` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'nombre de la sucursal',
  `rfc` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'rfc de la sucursal',
  `calle` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'calle de la sucursal',
  `colonia` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'colonia',
  `estado` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'estado',
  `municipio` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'municipio',
  `telefono` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'telefono',
  `status` int(1) DEFAULT NULL COMMENT 'status de la susucrsal 0=prueba 1=activo 2=suspendida 3 baja ',
  `tipopago` int(1) DEFAULT NULL COMMENT 'tipo de pago 0= anual 1=vitalicio',
  `fechaalta` date DEFAULT NULL COMMENT 'fecha de alta',
  `fppago` date DEFAULT NULL COMMENT 'fecha proxima de pago',
  KEY `Índice 1` (`idunicos`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='almacena los datos de las sucursales';

-- Volcando datos para la tabla pventa.sucursal: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `sucursal` DISABLE KEYS */;
REPLACE INTO `sucursal` (`idunicos`, `idunicoe`, `nombre`, `rfc`, `calle`, `colonia`, `estado`, `municipio`, `telefono`, `status`, `tipopago`, `fechaalta`, `fppago`) VALUES
	(1, 1, 'Ixmiquilpan Cedis', 'Cedis', 'Ixmi', 'Centro', 'Hidalgo', 'Ixmiquilpan', '773258555', 1, 0, '2017-03-30', '2018-03-30'),
	(2, 1, 'Zimpan', 'Zima', 'Zimapan', 'Centro', 'Hidalgo', 'Zimapan', '77525552', 1, 0, '2017-03-30', '2017-03-30'),
	(3, 1, 'Actopan', 'Actopan', 'Actopan', 'Centro', 'Hidalgo', 'Actopan', '77225447', 1, 0, '2017-03-30', '2017-03-30'),
	(4, 1, 'Mixquiahuala', 'Mix', 'Mixq', 'Centro', 'Hidalgo', 'Mixquiahuala', '774522255', 1, 0, '2017-03-30', '2017-03-30'),
	(5, 1, 'Progreso', 'Progre', 'Progre', 'Centro', 'Hidalgo', 'Progreso', '75525555', 1, 0, '2017-03-30', '2017-03-30');
/*!40000 ALTER TABLE `sucursal` ENABLE KEYS */;

-- Volcando estructura para tabla pventa.tipoprod
CREATE TABLE IF NOT EXISTS `tipoprod` (
  `cvetip` int(12) NOT NULL COMMENT 'clave del tipo ',
  `descripcion` varchar(50) DEFAULT NULL COMMENT 'descripcion del tipo',
  PRIMARY KEY (`cvetip`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='almacena los tipos de producto';

-- Volcando datos para la tabla pventa.tipoprod: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `tipoprod` DISABLE KEYS */;
REPLACE INTO `tipoprod` (`cvetip`, `descripcion`) VALUES
	(1, 'MUJER 2/6'),
	(2, 'HOMBRE 2 - 5');
/*!40000 ALTER TABLE `tipoprod` ENABLE KEYS */;

-- Volcando estructura para tabla pventa.tmpbajas
CREATE TABLE IF NOT EXISTS `tmpbajas` (
  `idsesion` int(11) DEFAULT NULL COMMENT 'id sesion usuario',
  `idunicoe` int(11) DEFAULT NULL COMMENT 'id de la empresa',
  `idunicos` int(11) DEFAULT NULL COMMENT 'id de la sucursal',
  `idunicop` int(11) DEFAULT NULL COMMENT 'idunico del producto a traspasar',
  `cantidad` int(11) DEFAULT NULL,
  `idunicoregi` int(11) DEFAULT NULL COMMENT 'id inventario'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla pventa.tmpbajas: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `tmpbajas` DISABLE KEYS */;
/*!40000 ALTER TABLE `tmpbajas` ENABLE KEYS */;

-- Volcando estructura para tabla pventa.tmptraspaso
CREATE TABLE IF NOT EXISTS `tmptraspaso` (
  `idsesion` int(11) DEFAULT NULL COMMENT 'id sesion usuario',
  `idunicoe` int(11) DEFAULT NULL COMMENT 'id de la empresa',
  `idunicos` int(11) DEFAULT NULL COMMENT 'id de la sucursal',
  `idunicop` int(11) DEFAULT NULL COMMENT 'idunico del producto a traspasar',
  `cantidad` int(11) DEFAULT NULL,
  `idunicoregi` int(11) DEFAULT NULL COMMENT 'id inventario'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla pventa.tmptraspaso: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `tmptraspaso` DISABLE KEYS */;
/*!40000 ALTER TABLE `tmptraspaso` ENABLE KEYS */;

-- Volcando estructura para tabla pventa.tmpventas
CREATE TABLE IF NOT EXISTS `tmpventas` (
  `idsesion` int(11) DEFAULT NULL COMMENT 'id sesion del usuario',
  `idunicoe` int(11) DEFAULT NULL COMMENT 'id de la empresa',
  `idunicos` int(11) DEFAULT NULL COMMENT 'idunico de la sucursal',
  `idunicop` int(11) DEFAULT NULL COMMENT 'id del producto',
  `cantidad` int(11) DEFAULT NULL,
  `idunicoregi` int(11) DEFAULT NULL COMMENT 'id de inventario',
  `precio` float(12,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla pventa.tmpventas: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `tmpventas` DISABLE KEYS */;
/*!40000 ALTER TABLE `tmpventas` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
