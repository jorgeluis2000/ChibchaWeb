-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.6.24-log - MySQL Community Server (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando datos para la tabla chibcha.auditoria: ~0 rows (aproximadamente)
DELETE FROM `auditoria`;
/*!40000 ALTER TABLE `auditoria` DISABLE KEYS */;
/*!40000 ALTER TABLE `auditoria` ENABLE KEYS */;

-- Volcando datos para la tabla chibcha.calificacion: ~11 rows (aproximadamente)
DELETE FROM `calificacion`;
/*!40000 ALTER TABLE `calificacion` DISABLE KEYS */;
INSERT INTO `calificacion` (`cod_calificacion`, `val_calificacion`) VALUES
	(1, 3),
	(2, 2),
	(3, 5),
	(4, 4),
	(5, 5),
	(6, 5),
	(7, 5),
	(8, 5),
	(9, 4),
	(10, 5),
	(11, 5);
/*!40000 ALTER TABLE `calificacion` ENABLE KEYS */;

-- Volcando datos para la tabla chibcha.categoria_distribuidor: ~2 rows (aproximadamente)
DELETE FROM `categoria_distribuidor`;
/*!40000 ALTER TABLE `categoria_distribuidor` DISABLE KEYS */;
INSERT INTO `categoria_distribuidor` (`cod_categoria_distribuidor`, `nom_categoria_distribuidor`, `tasa_interes_categoria`) VALUES
	(1, 'BÁSICO', 10),
	(2, 'PREMIUM', 15);
/*!40000 ALTER TABLE `categoria_distribuidor` ENABLE KEYS */;

-- Volcando datos para la tabla chibcha.cliente: ~11 rows (aproximadamente)
DELETE FROM `cliente`;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` (`cod_cliente`, `pais_cliente`, `cod_sitio_web`, `estado_cliente`, `fecha_ingreso`) VALUES
	(2, 'Colombia', 1, 1, '18/10/2019'),
	(3, 'Inglaterra', 2, 1, '16/09/2019'),
	(4, 'EEUU', 3, 1, '18/10/2019'),
	(5, 'Colombia', 4, 0, '18/10/2019'),
	(6, 'EEUU', 5, 1, '18/10/2019'),
	(7, 'Inglaterra', 6, 1, '31/10/19'),
	(8, 'Colombia', 7, 1, '08/11/19'),
	(9, 'Argentina', 8, 1, '08/11/19'),
	(14, 'Colombia', 0, 1, '13/11/19'),
	(15, 'Argentina', 9, 0, '25/11/19'),
	(16, 'Argentina', 10, 0, '25/11/19');
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;

-- Volcando datos para la tabla chibcha.distribuidor: ~4 rows (aproximadamente)
DELETE FROM `distribuidor`;
/*!40000 ALTER TABLE `distribuidor` DISABLE KEYS */;
INSERT INTO `distribuidor` (`cod_distribuidor`, `cod_categoria_distribuidor`, `estado_distribuidor`) VALUES
	(10, 2, 0),
	(11, 2, 1),
	(12, 1, 1),
	(13, 2, 1);
/*!40000 ALTER TABLE `distribuidor` ENABLE KEYS */;

-- Volcando datos para la tabla chibcha.empleado: ~2 rows (aproximadamente)
DELETE FROM `empleado`;
/*!40000 ALTER TABLE `empleado` DISABLE KEYS */;
INSERT INTO `empleado` (`cod_empleado`, `cod_tipo_empleado`, `cod_estado_empleado`) VALUES
	(14, 1, 1),
	(17, 1, 1);
/*!40000 ALTER TABLE `empleado` ENABLE KEYS */;

-- Volcando datos para la tabla chibcha.estado_ticket: ~2 rows (aproximadamente)
DELETE FROM `estado_ticket`;
/*!40000 ALTER TABLE `estado_ticket` DISABLE KEYS */;
INSERT INTO `estado_ticket` (`cod_estado_ticket`, `nom_estado_ticket`) VALUES
	(1, 'Pendiente'),
	(2, 'Resuelto');
/*!40000 ALTER TABLE `estado_ticket` ENABLE KEYS */;

-- Volcando datos para la tabla chibcha.franquicia: ~3 rows (aproximadamente)
DELETE FROM `franquicia`;
/*!40000 ALTER TABLE `franquicia` DISABLE KEYS */;
INSERT INTO `franquicia` (`cod_franquicia`, `nom_franquicia`) VALUES
	(1, 'VISA'),
	(2, 'MATERCARD'),
	(3, 'DINERS');
/*!40000 ALTER TABLE `franquicia` ENABLE KEYS */;

-- Volcando datos para la tabla chibcha.hosting: ~12 rows (aproximadamente)
DELETE FROM `hosting`;
/*!40000 ALTER TABLE `hosting` DISABLE KEYS */;
INSERT INTO `hosting` (`cod_hosting`, `cod_distribuidor`, `tipo_hosting`, `valor_mensual`, `datos_hosting`) VALUES
	(1, 10, 'Platino', 2.15, '5.1 sitio web,Optimizado para WordPress,1 buzón de negocios gratis por 6 meses!,100 GB de ancho de banda,1X potencia de procesamiento y memoria,'),
	(2, 10, 'Plata', 3.49, '7.Optimizado para WordPress,1 buzón de negocios gratis por 6 meses!,100 sitios web,Ancho de banda ilimitado,2X potencia de procesamiento y memoria,Copias de seguridad semanales,Nombre de dominio gratis,'),
	(3, 10, 'Oro', 7.95, '4.Todos los beneficios de Premium,Copias de seguridad diarias,Certificado SSL gratuito,Potencia de procesamiento 4X y memoria,'),
	(4, 11, 'Platino', 4.08, '5.1 sitio web,100 GB de almacenamiento,Ancho de banda sin medición,Correo comercial gratis - 1er año,Dominio gratis con un plan anual'),
	(5, 11, 'Plata', 4.57, '3.Sitios web ilimitados,Almacenamiento ilimitado,Subdominios ilimitados'),
	(6, 11, 'Oro', 8.12, '4.El doble de potencia de procesamiento y memoria,Certificado SSL gratis - 1 año,DNS Premium gratis,Bases de datos ilimitadas'),
	(7, 12, 'Platino', 4.12, '6.Lo mejor para un sitio web,10 GB de almacenamiento,10 bases de datos (SSD de 1 GB), 10 cuentas de correo electrónico,Dominio gratis por 1 año,Recursos básicos de CPU y MEM'),
	(8, 12, 'Plata', 8.21, '6.Sitios web ilimitados,almacenamiento ilimitado,bases de datos ilimitadas,50 cuentas de correo electrónico,Dominio gratis por 1 año, recursos mejorados de CPU y MEM'),
	(9, 12, 'Oro', 12.15, '6.Sitios web ilimitados,almacenamiento ilimitado,bases de datos ilimitadas,100 cuentas de correo electrónico,SSL ilimitado,protección contra malware de SiteCan'),
	(10, 13, 'Platino', 3.75, '4.30GB de almacenamiento,20 cuentas E-mail,ilimitado cuentas FTP,certificado SSL'),
	(11, 13, 'Plata', 5.49, '6.500GB de transferencia,3 dominios permitidos,50 cuentas E-mail,Seguridad inmunify360,Certificado SSL,10 bases de datos'),
	(12, 13, 'Oro', 7.49, '5.70GB de espacio,700GB de transferencia,CPU y memoria X3,ilimitado cuentas FTP,constructor sitios web');
/*!40000 ALTER TABLE `hosting` ENABLE KEYS */;

-- Volcando datos para la tabla chibcha.hosting_cliente: ~0 rows (aproximadamente)
DELETE FROM `hosting_cliente`;
/*!40000 ALTER TABLE `hosting_cliente` DISABLE KEYS */;
/*!40000 ALTER TABLE `hosting_cliente` ENABLE KEYS */;

-- Volcando datos para la tabla chibcha.sitio_web: ~10 rows (aproximadamente)
DELETE FROM `sitio_web`;
/*!40000 ALTER TABLE `sitio_web` DISABLE KEYS */;
INSERT INTO `sitio_web` (`cod_sitio_web`, `nom_sitio_web`, `logo_sitio_web`, `descripcion_sitio_web`, `tipo_sitio_web`) VALUES
	(1, 'GameMaster', 'Data/Logos/GameMaster_travel.jpg', 'Compra y venta de juegos Online. Multiples usuarios y juegos para todas las edades', 'Tecnología'),
	(2, 'GamerMaster', 'Data/Logos/GamerMaster_cadenas_para_quien.pn', 'Una pagina de venta de viewgames', 'Venta de viewgames'),
	(3, 'HolaMundo', 'Data/Logos/HolaMundo_0.png', 'Venta de comida', 'Alimentacion'),
	(4, 'La vaca lola', 'Data/Logos/La vaca lola_vaca_lola.jpg', 'Una vaca que le gusta comer pasta todos los dÃ­as, la cual cada maÃ±ana sale a decir muu, a su vez hay un granjero que la ordeÃ±a', 'Ganadero'),
	(5, 'Tecno Ciencia', 'Data/Logos/Tecno Ciencia_0.png', 'Pagina de ciencia inspirada al diseÃ±o artificial', 'Inteligencia Artificial'),
	(6, 'Plus Medic', 'Data/Logos/Plus Medic_desk2.jpg', 'Encuentra los mejores médicos a tu alrededor y agenda con ellos tu cita', 'Medicina'),
	(7, 'TravelMagic', 'Data/Logos/prueba_travel.jpg', 'pï¿½gina de viajes por todo el mundo', 'Exploraciï¿½n'),
	(8, 'terror', 'Data/Logos/terror_IMG_20190920_014316.jpg', 'libros,peliculas, historias reales terrorirficas ', 'Terror'),
	(9, 'Plani - Check', 'Data/Logos/Plani - Check_server3.jpeg', 'La mejor organización para los planes en la agenda', 'Organización'),
	(10, 'DermaLook', 'Data/Logos/DermaLook_Snapchat-153334412.jpg', 'El mejor sitio para renovar tu piel y tu vida', 'Salud');
/*!40000 ALTER TABLE `sitio_web` ENABLE KEYS */;

-- Volcando datos para la tabla chibcha.ticket: ~3 rows (aproximadamente)
DELETE FROM `ticket`;
/*!40000 ALTER TABLE `ticket` DISABLE KEYS */;
INSERT INTO `ticket` (`cod_ticket`, `cod_usuario`, `asunto_ticket`, `descripcin_ticket`, `cod_estado_ticket`, `fecha`) VALUES
	(1, 2, 'Pregunta', 'Sale error', '2', '2019-11-26'),
	(2, 2, 'Dominio', 'Cómo realizo la compra', '2', '2019-11-26'),
	(3, 3, 'Ayuda', 'ESTÁ MAL EL INICIO', '1', '2019-11-26');
/*!40000 ALTER TABLE `ticket` ENABLE KEYS */;

-- Volcando datos para la tabla chibcha.tipo_empleado: ~4 rows (aproximadamente)
DELETE FROM `tipo_empleado`;
/*!40000 ALTER TABLE `tipo_empleado` DISABLE KEYS */;
INSERT INTO `tipo_empleado` (`cod_tipo_empleado`, `nom_tipo_empleado`) VALUES
	(1, 'Técnico'),
	(2, 'Asesor'),
	(3, 'Programador'),
	(4, 'Soporte');
/*!40000 ALTER TABLE `tipo_empleado` ENABLE KEYS */;

-- Volcando datos para la tabla chibcha.tipo_forma_pago: ~0 rows (aproximadamente)
DELETE FROM `tipo_forma_pago`;
/*!40000 ALTER TABLE `tipo_forma_pago` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipo_forma_pago` ENABLE KEYS */;

-- Volcando datos para la tabla chibcha.tipo_usuario: ~0 rows (aproximadamente)
DELETE FROM `tipo_usuario`;
/*!40000 ALTER TABLE `tipo_usuario` DISABLE KEYS */;
INSERT INTO `tipo_usuario` (`cod_tipo_usuario`, `nom_tipo_usuario`) VALUES
	(1, 'Administrador'),
	(2, 'Cliente'),
	(3, 'Distribuidor'),
	(4, 'Empleado');
/*!40000 ALTER TABLE `tipo_usuario` ENABLE KEYS */;

-- Volcando datos para la tabla chibcha.usuario: ~0 rows (aproximadamente)
DELETE FROM `usuario`;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`cod_usuario`, `nom_usuario`, `ape_usuario`, `doc_usuario`, `correo_usuario`, `pass_usuario`, `cod_tipo_usuario`, `tel_usuario`, `img_usuario`) VALUES
	(1, 'Administrador', '', '194492371', 'chweb.info@gmail.com', 'admin123', 1, '3103847336', 'Data/imgs/user.png'),
	(2, 'Diego Andrés', 'Garzon C', '19495302', 'diego.andres0601@hotmail.com', 'Diego.1234', 2, '3152903732', 'Data/Profiles/4ef043d011f6393a2805f43c0346e033.jpg'),
	(3, 'Jorge', 'Güiza', '19944382', 'siulegroj55@hotmail.com', 'jorgito12', 2, '+573105508980', 'Data/imgs/user.png'),
	(4, 'Liseth ', 'Arevalo', '19672272', 'siulegroj55@gmail.com', 'liseth12', 2, '+573105508980', 'Data/imgs/user.png'),
	(5, 'Pedro', 'Feijoo', '812837213', 'luisjorge-123@hotmail.com', 'pedrito123', 2, '+573928123454', 'Data/Profiles/PedroFeijoo_IMG_20180606_212126_316.jpg'),
	(6, 'Helio', 'Ramirez', '1937261611', 'luisito-con@gmail.com', 'helio12', 2, '+573105508980', 'Data/imgs/user.png'),
	(7, 'Diego', 'Garzón', '1010114222', 'diego.andres0601@gmail.com', 'Diegoch', 2, '3102057439', 'Data/Profiles/e6d927264b424fb2201112574e121aed.jpg'),
	(8, 'Pepito', 'Perez', '10381744812', 'carlo.es@yahoo.es', 'pepito7', 2, '3152849293', 'Data/Profiles/46639ec6d72572b00ba4e5bdfc69494c.jpg'),
	(9, 'valentina', 'velandia', '1020829968', 'valentinavelandia1@gmail.com', 'Tronodecristal19', 2, '234456', 'Data/Profiles/973518a8f097ae99abbb60013c98ca5e.jpg'),
	(10, 'GoDaddy', '', '9559385239-3', 'go.service@godaddy.com', 'godaddy123', 3, '382 6761', 'Data/Distributor/GoDaddy.png'),
	(11, 'Hostinger', '', '8992184593-5', 'info@hostinger.com', 'hostinger123', 3, '2584730', 'Data/Distributor/Hostinger.png'),
	(12, 'Ionos', '', '799402683-4', 'ionos.web@ionos.es', 'ionos123', 3, '3004023', 'Data/Distributor/Ionos.jpg'),
	(13, 'LatinoamericaHosting', '', '986492274-3', 'latin.americ@hosting.com', 'latin123', 3, '3441337', 'Data/Distributor/LatinamericaHosting.png'),
	(14, 'Alfonso', 'Vanegas', '1038163682', 'luisalf5@gmail.com', '1C9S4W', 4, '32788339104', 'Data/imgs/user.png'),
	(15, 'Luisa', 'Pedraza', '3929102939', 'lu.pepi@gmail.com', '4U1W4B', 2, '3173302283', 'Data/imgs/user.png'),
	(16, 'Johanna', 'Mca', '2010224864', 'joha.nna@hotmail.com', '5O2Y4C', 2, '3192294093', 'Data/imgs/user.png'),
	(17, 'laura', 'Serrano', '1234567890', 'lizeth1arevalo@hotmail.con', '123456', 4, '3143256473', 'Data/imgs/user.png');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
