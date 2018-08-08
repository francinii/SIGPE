/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  factoria
 * Created: 26/07/2018
 */

create table ZonaTrabajo(
id int  NOT NULL AUTO_INCREMENT,
isActivo int,
nombreZonaTrabajo varchar(150),
revisadoPor varchar(150),
codigoZonaTrabajo varchar(150),
actividad varchar(150),
direcion varchar(150),
personaContactoGeneral varchar(150),
numeroTelefono varchar(150),
numeroFax varchar(150),
notificaciones varchar(150),
categoriNFPA varchar(150),
usoInstalaciones varchar(150),
horarioJornada varchar(150),
seguridadInstitucional varchar(150),
servicioConsegeria varchar(150),
personalAdministrativo varchar(150),
presenciaEstudiantil varchar(150),
tipoPoblacion varchar(150),
tipoPoblacionPersonalAcademico varchar(150),
tipoPoblacionEstudiantes varchar(150),
instalacionesDensidadOcupacion varchar(150),
instalacionesAreaConstruccion varchar(150),
instalacionesInstalaciones varchar(150),
instalacionesCaracteristicasZona varchar(150),
instalacionesTopografia varchar(150),
instalacionesNivelTerreno varchar(150),
instalacionesColindates varchar(150),
elementosConstructivosTipoConstruccion varchar(150),
elementosConstructivosAntiguedad varchar(150),
elementosConstructivosCimientos varchar(150),
elementosConstructivosEstructura varchar(150),
elementosConstructivosParedes varchar(150),
elementosConstructivosEntrepiso varchar(150),
elementosConstructivosTecho varchar(150),
elementosConstructivosCielos varchar(150),
elementosConstructivosPisos varchar(150),
elementosConstructivosAreaParqueo varchar(150),
elementosConstructivosSistemaAguaPotable varchar(150),
elementosConstructivosAlcantarilladoSanitario varchar(150),
elementosConstructivosAlcantarilladoPluvial varchar(150),
elementosConstructivosSistemaElectrico varchar(150),
elementosConstructivosSistemaTelefonico varchar(150),
elementosConstructivosOtros varchar(150),
PRIMARY KEY(id)
);

create table OrigenAmenaza(
    id int NOT NULL AUTO_INCREMENT,
    descripcion varchar(150),
    isActivo int,
    PRIMARY KEY(id)
);


create table TipoAmenaza (
    id int NOT NULL AUTO_INCREMENT,  
    descripcion varchar(150),
    isActivo int,
    FkidOrigen int,
    PRIMARY KEY(id),
    FOREIGN KEY(FKidOrigen) REFERENCES OrigenAmenaza(id)
);

create table CategoriaTipoAmenaza (
    id int NOT NULL AUTO_INCREMENT, 
    FKidTipoAmenaza int,   
    isActivo int,
    descripcion varchar(150),    
    PRIMARY KEY(id), 
    FOREIGN KEY(FKidTipoAmenaza) REFERENCES TipoAmenaza(id)
);

create table Matriz (
    id int NOT NULL AUTO_INCREMENT,  
    FKidCategoriaTipoAmenaza int,
    FKidZonaTrabajo int,
    fuente text,
    probabilidad int,
    gravedad int,
    consecuenciaAmenaza int,
    PRIMARY KEY(id), 
    FOREIGN KEY(FKidCategoriaTipoAmenaza) REFERENCES CategoriaTipoAmenaza(id),
    FOREIGN KEY(FKidZonaTrabajo) REFERENCES ZonaTrabajo(id)
);

create table Capitulo(
id int NOT NULL AUTO_INCREMENT,
descripcion text,
isActivo int,
titulo varchar(150),
orden int,
 PRIMARY KEY(id) 
);

create table SubCapitulo(
id int NOT NULL AUTO_INCREMENT,
descripcion text,
titulo varchar(150),
isActivo int,
FKidCapitulo int,
orden int,
PRIMARY KEY(id),
FOREIGN KEY (FKidCapitulo) REFERENCES Capitulo(id)
);

create table Formulario(
id int NOT NULL AUTO_INCREMENT,
descripcion text,
FKidSubcapitulos int,
PRIMARY KEY(id),
FOREIGN KEY (FKidSubcapitulos) REFERENCES SubCapitulo(id)
);


create table TipoPoblacion(
id int NOT NULL AUTO_INCREMENT,
FKidZonaTrabajo int,
tipoPoblacion varchar(150),
descripcion varchar(150),
total int,
representacionDe varchar(150),
PRIMARY KEY(id),
FOREIGN KEY (FKidZonaTrabajo) REFERENCES ZonaTrabajo(id)
);


INSERT INTO `BDSIGPE`.`ZonaTrabajo` ( `nombreZonaTrabajo`, `revisadoPor`, `codigoZonaTrabajo`, `actividad`, `direcion`, `personaContactoGeneral`, `numeroTelefono`, `numeroFax`, `notificaciones`, `categoriNFPA`, `usoInstalaciones`, `horarioJornada`, `seguridadInstitucional`, `servicioConsegeria`, `personalAdministrativo`, `presenciaEstudiantil`, `tipoPoblacion`, `tipoPoblacionPersonalAcademico`, `tipoPoblacionEstudiantes`, `instalacionesDensidadOcupacion`, `instalacionesAreaConstruccion`, `instalacionesInstalaciones`, `instalacionesCaracteristicasZona`, `instalacionesTopografia`, `instalacionesNivelTerreno`, `instalacionesColindates`, `elementosConstructivosTipoConstruccion`, `elementosConstructivosAntiguedad`, `elementosConstructivosCimientos`, `elementosConstructivosEstructura`, `elementosConstructivosParedes`, `elementosConstructivosEntrepiso`, `elementosConstructivosTecho`, `elementosConstructivosCielos`, `elementosConstructivosPisos`, `elementosConstructivosAreaParqueo`, `elementosConstructivosSistemaAguaPotable`, `elementosConstructivosAlcantarilladoSanitario`, `elementosConstructivosAlcantarilladoPluvial`, `elementosConstructivosSistemaElectrico`, `elementosConstructivosSistemaTelefonico`, `elementosConstructivosOtros`) VALUES ('Limon', 'Fran', 'Fran', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1');
INSERT INTO `BDSIGPE`.`ZonaTrabajo` ( `nombreZonaTrabajo`, `revisadoPor`, `codigoZonaTrabajo`, `actividad`, `direcion`, `personaContactoGeneral`, `numeroTelefono`, `numeroFax`, `notificaciones`, `categoriNFPA`, `usoInstalaciones`, `horarioJornada`, `seguridadInstitucional`, `servicioConsegeria`, `personalAdministrativo`, `presenciaEstudiantil`, `tipoPoblacion`, `tipoPoblacionPersonalAcademico`, `tipoPoblacionEstudiantes`, `instalacionesDensidadOcupacion`, `instalacionesAreaConstruccion`, `instalacionesInstalaciones`, `instalacionesCaracteristicasZona`, `instalacionesTopografia`, `instalacionesNivelTerreno`, `instalacionesColindates`, `elementosConstructivosTipoConstruccion`, `elementosConstructivosAntiguedad`, `elementosConstructivosCimientos`, `elementosConstructivosEstructura`, `elementosConstructivosParedes`, `elementosConstructivosEntrepiso`, `elementosConstructivosTecho`, `elementosConstructivosCielos`, `elementosConstructivosPisos`, `elementosConstructivosAreaParqueo`, `elementosConstructivosSistemaAguaPotable`, `elementosConstructivosAlcantarilladoSanitario`, `elementosConstructivosAlcantarilladoPluvial`, `elementosConstructivosSistemaElectrico`, `elementosConstructivosSistemaTelefonico`, `elementosConstructivosOtros`) VALUES ( 'Limon', 'Fran', 'Fran', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1');
INSERT INTO `BDSIGPE`.`ZonaTrabajo` ( `nombreZonaTrabajo`, `revisadoPor`, `codigoZonaTrabajo`, `actividad`, `direcion`, `personaContactoGeneral`, `numeroTelefono`, `numeroFax`, `notificaciones`, `categoriNFPA`, `usoInstalaciones`, `horarioJornada`, `seguridadInstitucional`, `servicioConsegeria`, `personalAdministrativo`, `presenciaEstudiantil`, `tipoPoblacion`, `tipoPoblacionPersonalAcademico`, `tipoPoblacionEstudiantes`, `instalacionesDensidadOcupacion`, `instalacionesAreaConstruccion`, `instalacionesInstalaciones`, `instalacionesCaracteristicasZona`, `instalacionesTopografia`, `instalacionesNivelTerreno`, `instalacionesColindates`, `elementosConstructivosTipoConstruccion`, `elementosConstructivosAntiguedad`, `elementosConstructivosCimientos`, `elementosConstructivosEstructura`, `elementosConstructivosParedes`, `elementosConstructivosEntrepiso`, `elementosConstructivosTecho`, `elementosConstructivosCielos`, `elementosConstructivosPisos`, `elementosConstructivosAreaParqueo`, `elementosConstructivosSistemaAguaPotable`, `elementosConstructivosAlcantarilladoSanitario`, `elementosConstructivosAlcantarilladoPluvial`, `elementosConstructivosSistemaElectrico`, `elementosConstructivosSistemaTelefonico`, `elementosConstructivosOtros`) VALUES ( 'Limon', 'Fran', 'Fran', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1');
INSERT INTO `BDSIGPE`.`ZonaTrabajo` ( `nombreZonaTrabajo`, `revisadoPor`, `codigoZonaTrabajo`, `actividad`, `direcion`, `personaContactoGeneral`, `numeroTelefono`, `numeroFax`, `notificaciones`, `categoriNFPA`, `usoInstalaciones`, `horarioJornada`, `seguridadInstitucional`, `servicioConsegeria`, `personalAdministrativo`, `presenciaEstudiantil`, `tipoPoblacion`, `tipoPoblacionPersonalAcademico`, `tipoPoblacionEstudiantes`, `instalacionesDensidadOcupacion`, `instalacionesAreaConstruccion`, `instalacionesInstalaciones`, `instalacionesCaracteristicasZona`, `instalacionesTopografia`, `instalacionesNivelTerreno`, `instalacionesColindates`, `elementosConstructivosTipoConstruccion`, `elementosConstructivosAntiguedad`, `elementosConstructivosCimientos`, `elementosConstructivosEstructura`, `elementosConstructivosParedes`, `elementosConstructivosEntrepiso`, `elementosConstructivosTecho`, `elementosConstructivosCielos`, `elementosConstructivosPisos`, `elementosConstructivosAreaParqueo`, `elementosConstructivosSistemaAguaPotable`, `elementosConstructivosAlcantarilladoSanitario`, `elementosConstructivosAlcantarilladoPluvial`, `elementosConstructivosSistemaElectrico`, `elementosConstructivosSistemaTelefonico`, `elementosConstructivosOtros`) VALUES ( 'Limon', 'Fran', 'Fran', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1');
INSERT INTO `BDSIGPE`.`ZonaTrabajo` ( `nombreZonaTrabajo`, `revisadoPor`, `codigoZonaTrabajo`, `actividad`, `direcion`, `personaContactoGeneral`, `numeroTelefono`, `numeroFax`, `notificaciones`, `categoriNFPA`, `usoInstalaciones`, `horarioJornada`, `seguridadInstitucional`, `servicioConsegeria`, `personalAdministrativo`, `presenciaEstudiantil`, `tipoPoblacion`, `tipoPoblacionPersonalAcademico`, `tipoPoblacionEstudiantes`, `instalacionesDensidadOcupacion`, `instalacionesAreaConstruccion`, `instalacionesInstalaciones`, `instalacionesCaracteristicasZona`, `instalacionesTopografia`, `instalacionesNivelTerreno`, `instalacionesColindates`, `elementosConstructivosTipoConstruccion`, `elementosConstructivosAntiguedad`, `elementosConstructivosCimientos`, `elementosConstructivosEstructura`, `elementosConstructivosParedes`, `elementosConstructivosEntrepiso`, `elementosConstructivosTecho`, `elementosConstructivosCielos`, `elementosConstructivosPisos`, `elementosConstructivosAreaParqueo`, `elementosConstructivosSistemaAguaPotable`, `elementosConstructivosAlcantarilladoSanitario`, `elementosConstructivosAlcantarilladoPluvial`, `elementosConstructivosSistemaElectrico`, `elementosConstructivosSistemaTelefonico`, `elementosConstructivosOtros`) VALUES ( 'Limon', 'Fran', 'Fran', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1');

INSERT INTO `BDSIGPE`.`OrigenAmenaza` (`descripcion`,`isActivo`) VALUES ('Natural',1);
INSERT INTO `BDSIGPE`.`OrigenAmenaza` (`descripcion`,`isActivo`) VALUES ('Socio-Natural',1);
INSERT INTO `BDSIGPE`.`OrigenAmenaza` (`descripcion`,`isActivo`) VALUES ('Antrópica',1);


INSERT INTO `BDSIGPE`.`TipoAmenaza` (`descripcion`,`isActivo`,FkidOrigen) VALUES ('Geodinámica interna',1,1);
INSERT INTO `BDSIGPE`.`TipoAmenaza` (`descripcion`,`isActivo`,FkidOrigen) VALUES ('Hidrometereológicas',1,1);
INSERT INTO `BDSIGPE`.`TipoAmenaza` (`descripcion`,`isActivo`,FkidOrigen) VALUES ('Geodinamica externa',1,1);
INSERT INTO `BDSIGPE`.`TipoAmenaza` (`descripcion`,`isActivo`,FkidOrigen) VALUES ('Biológicas',1,1);
INSERT INTO `BDSIGPE`.`TipoAmenaza` (`descripcion`,`isActivo`,FkidOrigen) VALUES ('Socio-natural',1,2);
INSERT INTO `BDSIGPE`.`TipoAmenaza` (`descripcion`,`isActivo`,FkidOrigen) VALUES ('Antrópica',1,3);


INSERT INTO `capitulo`(`descripcion`, `isActivo`, `titulo`, `orden`) VALUES ('',1,'PRESENTACIÓN',1);
INSERT INTO `capitulo`(`descripcion`, `isActivo`, `titulo`, `orden`) VALUES ('',1,'INFORMACIÓN GENERAL DE LA ORGANIZACIÓN',2);
INSERT INTO `capitulo`(`descripcion`, `isActivo`, `titulo`, `orden`) VALUES ('',1,'VALORACIÓN DEL RIESGO',3);
INSERT INTO `capitulo`(`descripcion`, `isActivo`, `titulo`, `orden`) VALUES ('',1,'POLÍTICA DE GESTIÓN DE RIESGOS',4);
INSERT INTO `capitulo`(`descripcion`, `isActivo`, `titulo`, `orden`) VALUES ('',1,'ORGANIZACIÓN PARA LOS PREPARATIVOS Y RESPUESTA',5);
INSERT INTO `capitulo`(`descripcion`, `isActivo`, `titulo`, `orden`) VALUES ('',1,'PLAN DE ACCIÓN',6);
INSERT INTO `capitulo`(`descripcion`, `isActivo`, `titulo`, `orden`) VALUES ('',1,'MECANISMOS DE ACTIVACIÓN',7);
INSERT INTO `capitulo`(`descripcion`, `isActivo`, `titulo`, `orden`) VALUES ('',1,'PROCEDIMIENTOS OPERATIVOS DE RESPUESTA',8);
INSERT INTO `capitulo`(`descripcion`, `isActivo`, `titulo`, `orden`) VALUES ('',1,'EVALUACIÓN DEL PLAN DE PREPARATIVOS Y RESPUESTA',9);
INSERT INTO `capitulo`(`descripcion`, `isActivo`, `titulo`, `orden`) VALUES ('',1,'DEFINICIONES Y TÉRMINOS',10);
INSERT INTO `capitulo`(`descripcion`, `isActivo`, `titulo`, `orden`) VALUES ('',1,'ANEXO',11);


INSERT INTO `subcapitulo`( `descripcion`, `titulo`, `isActivo`, `FKidCapitulo`, `orden`) VALUES ('<p>Es la condición o resultado cuantificable que debe ser alcanzado y mantenido, con la aplicación<br/>
del procedimiento y que refleja el valor o beneficio que obtiene el usuario. El propósito debe<br/>
redactarse en forma breve y concisa; especificará los resultados o condiciones que se desean<br/>
lograr, iniciará con un verbo en infinitivo y, en lo posible, se evitará utilizar gerundios y adjetivos<br/>
calificativos. El propósito debe quedar escrito en prosa, únicamente para la redacción de<br/>
este se facilita la siguiente tabla, que no deberá incorporarse en el manual respectivo:</p>','Propósito',1,1,1);
INSERT INTO `subcapitulo`( `descripcion`, `titulo`, `isActivo`, `FKidCapitulo`, `orden`) VALUES ('<p>En este apartado se describe brevemente el área o campo de aplicación del procedimiento;<br/>
es decir, a quiénes afecta o qué límites o influencia tiene, representa la esfera de acción<br />
que cubren los procedimientos.</p>','Alcance',1,1,2);
INSERT INTO `subcapitulo`( `descripcion`, `titulo`, `isActivo`, `FKidCapitulo`, `orden`) VALUES ('<p>Aqu&iacute; se registra el compendio de normas aplicables al procedimiento, conforme a la secuencia<br />
l&oacute;gica de las etapas del mismo. Es decir aquellas disposiciones internas que:</p>

<p>&nbsp;&nbsp; a) Tienen como prop&oacute;sito regular la interacci&oacute;n entre los individuos en una</p>
<p>&nbsp;&nbsp; organizaci&oacute;n y las actividades de una unidad responsable.</p>
<p>&nbsp;&nbsp; b) Marcan responsabilidades y l&iacute;mites generales y espec&iacute;ficos, dentro de los cuales<br />
&nbsp;&nbsp; se realizan leg&iacute;timamente las actividades en distintas &aacute;reas de acci&oacute;n.<br />
&nbsp;&nbsp; c) Se aplican a todas las situaciones similares.<br />
&nbsp;&nbsp; d) Dan orientaciones claras hacia donde deben dirigirse todas las actividades de un<br />
&nbsp;&nbsp; mismo tipo.<br />
&nbsp;&nbsp; e) Facilitan la toma de decisiones en actividades rutinarias.<br />
&nbsp;&nbsp; f) Describen lo que la direcci&oacute;n desea que se haga en cada situaci&oacute;n definida.</p>','Marco normativo',1,1,3);
INSERT INTO `subcapitulo`( `descripcion`, `titulo`, `isActivo`, `FKidCapitulo`, `orden`) VALUES ('<p>a) Secuencia de etapas
i. Son las partes en que se divide el procedimiento, y cada una de ellas integra
un conjunto afín de actividades.
ii. La redacción de la etapa, iniciará con un verbo conjugado en el tiempo
presente de la tercera persona del singular.
b) Descripción de las actividades
i. Es la descripción detallada de las actividades; de manera tal que permita al
personal comprenderlas, seguirlas y aplicarlas, aun cuando sea de recién
ingreso al área.
ii. El número con que se registrará cada actividad, estará compuesto por el dígito
de la etapa correspondiente, seguido de un punto, y a la derecha de éste, del
número consecutivo respectivo.
iii. La redacción de la actividad, iniciará con un verbo conjugado en el tiempo
presente de la tercera persona del singular.
iv. Deberá considerarse en la redacción de las actividades, los elementos
necesarios para su realización; así como los productos que se generen.
c) Responsable
i. Se refiere a los órganos o cargos de la estructura autorizada responsables de
la ejecución y cumplimiento de las actividades del procedimiento.
ii. En el caso del personal operativo habrá de señalarse el nombre del puesto por
funciones reales desempeñadas: analista, secretaria, mensajero, etcétera; y
no por el nombre de la plaza: coordinador de técnicos, secretaria ejecutiva,
entre otros.

En la descripción se utilizará la siguiente forma:</p>','Descripción del plan',1,1,4);
INSERT INTO `subcapitulo`( `descripcion`, `titulo`, `isActivo`, `FKidCapitulo`, `orden`) VALUES ('<p>Anotar qué documentos no normativos se requieren al utilizar el procedimiento, para tener
un mejor entendimiento o completar su ejecución no incluidos en los puntos anteriores.</p>','Documentos de referencia',1,1,5);
 



drop table TipoPoblacion;
drop table Formulario;
drop table SubCapitulo;
drop table Capitulo;
drop table Matriz;
drop table CategoriaTipoAmenaza;
drop table TipoAmenaza;
drop table OrigenAmenaza;
drop table ZonaTrabajo;



------------------Procedimientos almacenados----------------------------------
-- ----------------------------
-- Proceso insertar origen de amenaza
-- ----------------------------
DROP PROCEDURE IF EXISTS `insert_origen_amenaza`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_origen_amenaza`(IN `p_nombre` varchar(150),IN `p_activo` int, OUT `res` TINYINT  UNSIGNED)
BEGIN
	DECLARE EXIT HANDLER FOR SQLEXCEPTION
	BEGIN
		-- ERROR
    SET res = 1;
    ROLLBACK;
	END;

  DECLARE EXIT HANDLER FOR SQLWARNING
	BEGIN
		-- ERROR
    SET res = 2;
    ROLLBACK;
	END;
            START TRANSACTION;
                    INSERT INTO `OrigenAmenaza`(descripcion,isActivo) VALUES (p_nombre, p_activo);
            COMMIT;
            -- SUCCESS
            SET res = 0;
            -- Existe usuario
END
;;
DELIMITER ;


-- ----------------------------
-- Proceso insertar categoria de amenaza
-- ----------------------------
DROP PROCEDURE IF EXISTS `insert_categoria_amenaza`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_categoria_amenaza`(IN `p_nombre` varchar(150),IN `p_activo` int, IN  `p_fkTipoAmenaza` int,  OUT `res` TINYINT  UNSIGNED)
BEGIN
	DECLARE EXIT HANDLER FOR SQLEXCEPTION
	BEGIN
		-- ERROR
    SET res = 1;
    ROLLBACK;
	END;

  DECLARE EXIT HANDLER FOR SQLWARNING
	BEGIN
		-- ERROR
    SET res = 2;
    ROLLBACK;
	END;
            START TRANSACTION;
                    INSERT INTO `CategoriaTipoAmenaza`(FKidTipoAmenaza,isActivo,descripcion) VALUES (p_fkTipoAmenaza, p_activo,p_nombre);
            COMMIT;
            -- SUCCESS
            SET res = 0;
            -- Existe usuario
END
;;
DELIMITER ;



-- ----------------------------
-- Proceso insertar tipo de amenaza
-- ----------------------------
DROP PROCEDURE IF EXISTS `insert_tipo_amenaza`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_tipo_amenaza`(IN `p_nombre` varchar(150),IN `p_activo` int, IN  `p_fkOrigenAmenaza` int,  OUT `res` TINYINT  UNSIGNED)
BEGIN
	DECLARE EXIT HANDLER FOR SQLEXCEPTION
	BEGIN
		-- ERROR
    SET res = 1;
    ROLLBACK;
	END;

  DECLARE EXIT HANDLER FOR SQLWARNING
	BEGIN
		-- ERROR
    SET res = 2;
    ROLLBACK;
	END;
            START TRANSACTION;
                    INSERT INTO `TipoAmenaza`(descripcion,isActivo,FkidOrigen) VALUES (p_nombre, p_activo,p_fkOrigenAmenaza);
            COMMIT;
            -- SUCCESS
            SET res = 0;
            -- Existe usuario
END
;;
DELIMITER ;



-- ----------------------------
-- Proceso eliminar origen de amenaza
-- ----------------------------
DROP PROCEDURE IF EXISTS `delete_origen_amenaza`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_origen_amenaza`(IN `p_id` varchar(50),OUT `res` tinyint unsigned)
BEGIN
	DECLARE EXIT HANDLER FOR SQLEXCEPTION
	BEGIN
		-- ERROR
    SET res = 1;
    ROLLBACK;
	END;

  DECLARE EXIT HANDLER FOR SQLWARNING
	BEGIN
		-- ERROR
    SET res = 2;
    ROLLBACK;
	END;

	START TRANSACTION ;
		DELETE FROM OrigenAmenaza WHERE id=p_id;
	
	COMMIT;
	-- SUCCESS
	SET res = 0;
END
;;
DELIMITER;


-- ----------------------------
-- Proceso eliminar tipo de amenaza
-- ----------------------------
DROP PROCEDURE IF EXISTS `delete_tipo_amenaza`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_tipo_amenaza`(IN `p_id` varchar(50),OUT `res` tinyint unsigned)
BEGIN
	DECLARE EXIT HANDLER FOR SQLEXCEPTION
	BEGIN
		-- ERROR
    SET res = 1;
    ROLLBACK;
	END;

  DECLARE EXIT HANDLER FOR SQLWARNING
	BEGIN
		-- ERROR
    SET res = 2;
    ROLLBACK;
	END;

	START TRANSACTION ;
		DELETE FROM TipoAmenaza WHERE id=p_id;
	
	COMMIT;
	-- SUCCESS
	SET res = 0;
END
;;
DELIMITER ;



-- ----------------------------
-- Proceso eliminar categoria de amenaza
-- ----------------------------
DROP PROCEDURE IF EXISTS `delete_categoria_amenaza`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_categoria_amenaza`(IN `p_id` varchar(50),OUT `res` tinyint unsigned)
BEGIN
	DECLARE EXIT HANDLER FOR SQLEXCEPTION
	BEGIN
		-- ERROR
    SET res = 1;
    ROLLBACK;
	END;

  DECLARE EXIT HANDLER FOR SQLWARNING
	BEGIN
		-- ERROR
    SET res = 2;
    ROLLBACK;
	END;

	START TRANSACTION ;
		DELETE FROM CategoriaTipoAmenaza WHERE id=p_id;
	
	COMMIT;
	-- SUCCESS
	SET res = 0;
END
;;
DELIMITER ;


-- ----------------------------
-- Proceso activar tipo de amenaza
-- ----------------------------
DROP PROCEDURE IF EXISTS `active_tipo_amenaza`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `active_tipo_amenaza`(IN `p_id` int,IN `p_activo` int,OUT `respuesta` int)
BEGIN
    DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET respuesta=0;
    START TRANSACTION;
        UPDATE TipoAmenaza SET  isActivo = p_activo WHERE id=p_id;
        SELECT ROW_COUNT() INTO respuesta;
    IF (respuesta=1) THEN
    COMMIT;
    ELSE
    ROLLBACK;
    SET respuesta=0;
END IF;
END


-- ----------------------------
-- Proceso activar categoria de amenaza
-- ----------------------------
DROP PROCEDURE IF EXISTS `active_categoria_amenaza`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `active_categoria_amenaza`(IN `p_id` int,IN `p_activo` int,OUT `respuesta` int)
BEGIN
    DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET respuesta=0;
    START TRANSACTION;
        UPDATE CategoriaTipoAmenaza SET  isActivo = p_activo WHERE id=p_id;
        SELECT ROW_COUNT() INTO respuesta;
    IF (respuesta=1) THEN
    COMMIT;
    ELSE
    ROLLBACK;
    SET respuesta=0;
END IF;
END


-- ----------------------------
-- Proceso activar origen de amenaza
-- ----------------------------
DROP PROCEDURE IF EXISTS `active_origen_amenaza`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `active_origen_amenaza`(IN `p_id` int,IN `p_activo` int,OUT `respuesta` int)
BEGIN
    DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET respuesta=0;
    START TRANSACTION;
        UPDATE OrigenAmenaza SET  isActivo = p_activo WHERE id=p_id;
        SELECT ROW_COUNT() INTO respuesta;
    IF (respuesta=1) THEN
    COMMIT;
    ELSE
    ROLLBACK;
    SET respuesta=0;
END IF;
END
-- ----------------------------
-- Proceso insertar capitulo
-- ----------------------------


DROP PROCEDURE IF EXISTS `insert_capitulo`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_capitulo`(IN `p_titulo` varchar(150),IN `p_activo` int, IN  `p_descripcion` text,  OUT `res` TINYINT  UNSIGNED)
BEGIN
declare ordenar Integer;
	DECLARE EXIT HANDLER FOR SQLEXCEPTION     
	BEGIN  
		-- ERROR
    SET res = 1;
    ROLLBACK;
	END;

  DECLARE EXIT HANDLER FOR SQLWARNING
	BEGIN
		-- ERROR
    SET res = 2;  
    ROLLBACK;
	END;          
            select MAX(`orden`) into ordenar from capitulo;
            IF (ISNULL(ordenar)) THEN
                SET ordenar = 1;
            ELSE
                SET ordenar = ordenar +1;   
            END IF;           
            START TRANSACTION;
                     
                    INSERT INTO `Capitulo`(descripcion,isActivo,titulo,orden) VALUES (p_descripcion, p_activo,p_titulo,ordenar);
            COMMIT;
            -- SUCCESS
            SET res = 0;
            -- Existe usuario
END
;;
DELIMITER ;
-- CALL insert_capitulo('micapitulo',1,'$nombre',@res);


-- ----------------------------
-- Proceso insertar subcapitulos
-- ----------------------------

DROP PROCEDURE IF EXISTS `insert_subcapitulo`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_subcapitulo`(IN `p_titulo` varchar(150),IN `p_activo` int, IN  `p_fkcapitulo` int,IN  `p_descripcion` text,  OUT `res` TINYINT  UNSIGNED)
BEGIN
declare ordenar Integer;
	DECLARE EXIT HANDLER FOR SQLEXCEPTION
	BEGIN
		-- ERROR
    SET res = 1;
    ROLLBACK;
	END;

  DECLARE EXIT HANDLER FOR SQLWARNING
	BEGIN
		-- ERROR
    SET res = 2;
    ROLLBACK;
	END;
            select MAX(orden) into ordenar from Subcapitulo where FKidCapitulo=p_fkcapitulo;
             IF (ISNULL(ordenar)) THEN
                SET ordenar=1;
            ELSE
                SET ordenar= ordenar +1;   
            END IF;  
            START TRANSACTION;
                    INSERT INTO `Subcapitulo`(descripcion, titulo, isActivo, FKidCapitulo, orden) VALUES (p_descripcion, p_titulo,p_activo,p_fkcapitulo,ordenar);
            COMMIT;
            -- SUCCESS
            SET res = 0;
            -- Existe usuario
END
;;
DELIMITER ;
-- CALL insert_subcapitulo('micapitulo',1,2'nombre',@res);





-- ----------------------------
-- Proceso actualizar capitulos
-- ----------------------------
DROP PROCEDURE IF EXISTS `update_capitulo`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_capitulo`(IN `p_id` int,IN `p_titulo` varchar(150), IN  `p_descripcion` text, OUT `res` TINYINT  UNSIGNED)
BEGIN
        
	DECLARE EXIT HANDLER FOR SQLEXCEPTION
	BEGIN
		-- ERROR
    SET res = 1;
    ROLLBACK;
	END;

  DECLARE EXIT HANDLER FOR SQLWARNING
	BEGIN
		-- ERROR
    SET res = 2;
    ROLLBACK;
	END;
            START TRANSACTION;
                   UPDATE `Capitulo` SET `descripcion`= p_descripcion ,`titulo`=p_titulo WHERE `id`=p_id;
            COMMIT;
            -- SUCCESS
            SET res = 0;
            -- Existe usuario
END
;;
DELIMITER ;

-- CALL update_capitulo(1,'PRESENTACIÓN','nombre',@res);


-- ----------------------------
-- Proceso actualizar subcapitulos
-- ----------------------------
DROP PROCEDURE IF EXISTS `update_subcapitulo`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_subcapitulo`(IN `p_id` int,IN `p_titulo` varchar(150),IN `p_fkcapitulo` int, IN  `p_descripcion` text, OUT `res` TINYINT  UNSIGNED)
BEGIN   
        declare ordenar Integer;
        declare FKAntigua Integer;
	DECLARE EXIT HANDLER FOR SQLEXCEPTION
	BEGIN
		-- ERROR
    SET res = 1;
    ROLLBACK;
	END;

  DECLARE EXIT HANDLER FOR SQLWARNING
	BEGIN
		-- ERROR
    SET res = 2;
    ROLLBACK;
	END;
            select FKidCapitulo into FKAntigua from Subcapitulo WHERE `id`=p_id;
            IF(FKAntigua = p_fkcapitulo) THEN
                  START TRANSACTION;
                   UPDATE `Subcapitulo` SET `descripcion`= p_descripcion ,`titulo`=p_titulo, `FKidCapitulo`=p_fkcapitulo WHERE `id`=p_id;
                 COMMIT;
                -- SUCCESS
                SET res = 0;
            ELSE
                select MAX(orden) into ordenar from Subcapitulo where FKidCapitulo=p_fkcapitulo;
                IF (ISNULL(ordenar)) THEN
                  SET ordenar=1;
                ELSE
                  SET ordenar= ordenar +1;   
                END IF;
                START TRANSACTION;
                   UPDATE `Subcapitulo` SET `descripcion`= p_descripcion ,`titulo`=p_titulo, `FKidCapitulo`=p_fkcapitulo,`orden`=ordenar WHERE `id`=p_id;
                 COMMIT;
                 -- SUCCESS
               SET res = 0;
               -- Existe usuario
            END IF;
END
;;
DELIMITER ;

-- CALL update_subcapitulo(1,'PRESENTACIÓN','nombre',1,@res);

-- ----------------------------
-- Proceso ordenar capitulos
-- ----------------------------
DROP PROCEDURE IF EXISTS `ordenar_capitulo`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `ordenar_capitulo`(IN `p_list` cursor, OUT `res` TINYINT  UNSIGNED)
BEGIN
        declare miId int;
        declare cont int;
	DECLARE EXIT HANDLER FOR SQLEXCEPTION
	BEGIN
		-- ERROR
    SET res = 1;
    ROLLBACK;
	END;

  DECLARE EXIT HANDLER FOR SQLWARNING
	BEGIN
		-- ERROR
    SET res = 2;
    ROLLBACK;
	END;
            SET cont = 1;
            START TRANSACTION;
            FETCH p_list INTO miId 
                   UPDATE `capitulo` SET `orden`= cont ,WHERE `id`=miId;
            END LOOP loop_List;
            COMMIT;
            -- SUCCESS
            SET res = 0;
            -- Existe usuario
END
;;
DELIMITER ;

