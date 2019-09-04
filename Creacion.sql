Create database PedidoM;
Use PedidoM;

CREATE TABLE `administradores` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Usuario` varchar(45) DEFAULT NULL,
  `Clave` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

INSERT INTO administradores (Usuario,Clave)Values('Admin','12345');

CREATE TABLE `auditoria_pedidod` (
  `Tipo` char(3) NOT NULL,
  `Numero` int(11) NOT NULL,
  `Id_N` char(30) NOT NULL,
  `Item` char(30) NOT NULL,
  `Cantidad` double NOT NULL,
  `Subtotal` double NOT NULL,
  `Iva` double NOT NULL,
  `Descuento` double NOT NULL,
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Bonificado` char(1) NOT NULL,
  `COMENTARIO` varchar(100) DEFAULT NULL,
  `Precio` double DEFAULT NULL,
  `Bodega` char(3) DEFAULT NULL,
  `Tarifa` int(11) DEFAULT NULL,
  `Fecha` date DEFAULT NULL,
  `Hora` time DEFAULT NULL,
  `USERNAME` char(10) DEFAULT NULL,
  `Operacion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
CREATE TABLE `auditoria_pedidoe` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Tipo` char(3) NOT NULL,
  `Numero` int(11) NOT NULL,
  `Id_N` char(30) NOT NULL,
  `succliente` int(11) DEFAULT NULL,
  `Subtotal` double NOT NULL,
  `Iva` double DEFAULT NULL,
  `Descuento` double DEFAULT NULL,
  `Comentario` varchar(500) DEFAULT NULL,
  `Fecha` date DEFAULT NULL,
  `Hora` time DEFAULT NULL,
  `USERNAME` char(10) DEFAULT NULL,
  `IDVEND` int(11) DEFAULT NULL,
  `Operacion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
CREATE TABLE `cartera` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Invc` char(15) DEFAULT NULL,
  `Cruce` char(3) DEFAULT NULL,
  `Saldo` double DEFAULT NULL,
  `Cuota` int(11) DEFAULT NULL,
  `Shipto` int(11) DEFAULT NULL,
  `Id_N` char(30) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
CREATE TABLE `configuracion` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `ManejoExistencia` char(1) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
INSERT INTO configuracion(ManejoExistencia) VALUES('N');
CREATE TABLE `existencia` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `ITEM` char(30) DEFAULT NULL,
  `BODEGA` char(3) DEFAULT NULL,
  `SALDO` double DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
CREATE TABLE `fatipdoc` (
  `ID_USUARIO` char(10) NOT NULL,
  `MODIFICAVEND` char(1) DEFAULT 'N',
  `LISTA_COT_MOVIL` char(1) DEFAULT 'N',
  `TIPO_PE` char(3) DEFAULT 'N',
  `PMSINEXISTENCIA` char(1) DEFAULT 'N',
  `PMDESCUENTO` char(1) DEFAULT 'N',
  `Bodega` char(3) DEFAULT NULL,
  `Lista_Precios` char(1) DEFAULT NULL,
  `PERMISOPRECIO` char(1) DEFAULT NULL,
  `MODIPRECIOS` char(5) DEFAULT NULL,
  PRIMARY KEY (`ID_USUARIO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE `items` (
  `ITEM` char(30) NOT NULL,
  `DESCRIPCION` varchar(80) DEFAULT NULL,
  `PRICE` double DEFAULT NULL,
  `PRICE1` double DEFAULT NULL,
  `PRICE2` double DEFAULT NULL,
  `PRICE3` double DEFAULT NULL,
  `PRICE4` double DEFAULT NULL,
  `PRICE5` double DEFAULT NULL,
  `IVA` int(11) DEFAULT NULL,
  `PORCENTAJE` double DEFAULT NULL,
  PRIMARY KEY (`ITEM`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE `nombres` (
  `USERNAME` char(10) NOT NULL,
  `CLAVE` char(15) DEFAULT NULL,
  `USUARIOFACTURA` varchar(10) DEFAULT NULL,
  `IDVEND` int(11) DEFAULT NULL,
  PRIMARY KEY (`USERNAME`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE `pedidod` (
  `Tipo` char(3) NOT NULL,
  `Numero` int(11) NOT NULL,
  `Id_N` char(30) NOT NULL,
  `Item` char(30) NOT NULL,
  `Cantidad` double NOT NULL,
  `Subtotal` double NOT NULL,
  `Iva` double NOT NULL,
  `Descuento` double NOT NULL,
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Bonificado` char(1) NOT NULL,
  `COMENTARIO` varchar(100) DEFAULT NULL,
  `Precio` double DEFAULT NULL,
  `Bodega` char(3) DEFAULT NULL,
  `Tarifa` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
CREATE TABLE `pedidoe` (
  `Tipo` char(3) NOT NULL,
  `Numero` int(11) NOT NULL,
  `Id_N` char(30) NOT NULL,
  `succliente` int(11) DEFAULT NULL,
  `Subtotal` double NOT NULL,
  `Iva` double DEFAULT NULL,
  `Descuento` double DEFAULT NULL,
  `Comentario` varchar(500) DEFAULT NULL,
  `Fecha` date DEFAULT NULL,
  `Hora` time DEFAULT NULL,
  `USERNAME` char(10) DEFAULT NULL,
  `IDVEND` int(11) DEFAULT NULL,
  `SINC` char(1) DEFAULT NULL,
  `Estado` varchar(45) DEFAULT NULL,
  `BONOTOTAL` double DEFAULT NULL,
  `Terms` char(15) DEFAULT NULL,
  `FechaEntrega` date DEFAULT NULL,
  PRIMARY KEY (`Tipo`,`Numero`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE `temp_pedidod` (
  `Id_N` char(30) NOT NULL,
  `Item` char(30) NOT NULL,
  `Cantidad` double NOT NULL,
  `Subtotal` double NOT NULL,
  `Iva` double NOT NULL,
  `Descuento` double NOT NULL,
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Bonificado` char(1) NOT NULL,
  `COMENTARIO` varchar(100) DEFAULT NULL,
  `Precio` double DEFAULT NULL,
  `Bodega` char(3) DEFAULT NULL,
  `Tarifa` int(11) DEFAULT NULL,
  `Estado` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
CREATE TABLE `temp_pedidoe` (
  `Tipo` char(3) DEFAULT NULL,
  `Numero` int(11) DEFAULT NULL,
  `Id_N` char(30) NOT NULL,
  `succliente` int(11) DEFAULT NULL,
  `Subtotal` double NOT NULL,
  `Iva` double DEFAULT NULL,
  `Descuento` double DEFAULT NULL,
  `Comentario` varchar(500) DEFAULT NULL,
  `USERNAME` char(10) DEFAULT NULL,
  `IDVEND` int(11) DEFAULT NULL,
  `BONOTOTAL` double DEFAULT NULL,
  `Terms` char(15) DEFAULT NULL,
  `FechaEntrega` date DEFAULT NULL,
  PRIMARY KEY (`Id_N`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE `terceros` (
  `id_n` char(30) NOT NULL,
  `phone1` char(16) DEFAULT NULL,
  `addr1` char(35) DEFAULT NULL,
  `company` char(35) DEFAULT NULL,
  `succliente` int(11) NOT NULL,
  `id_vend` int(11) DEFAULT NULL,
  `NIVEL` char(10) DEFAULT NULL,
  `COMPANY_EXTENDIDO` char(80) DEFAULT NULL,
  `Terms` char(15) DEFAULT NULL,
  `FechaEntrega` date DEFAULT NULL,
  PRIMARY KEY (`id_n`,`succliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE `vendedor` (
  `IDVEND` int(11) NOT NULL,
  `NOMBRE` char(30) DEFAULT NULL,
  `TELEFONO` char(16) DEFAULT NULL,
  `ID_N` char(30) DEFAULT NULL,
  `ACTIVO` char(5) DEFAULT 'True',
  PRIMARY KEY (`IDVEND`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




















































