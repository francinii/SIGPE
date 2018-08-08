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
INSERT INTO `capitulo`(`descripcion`, `isActivo`, `titulo`, `orden`) VALUES ('',1,'Descripción del plan',2);
INSERT INTO `capitulo`(`descripcion`, `isActivo`, `titulo`, `orden`) VALUES ('',1,'Documentos de referencia',3);
INSERT INTO `capitulo`(`descripcion`, `isActivo`, `titulo`, `orden`) VALUES ('',1,'INFORMACIÓN GENERAL DE LA ORGANIZACIÓN',4);
INSERT INTO `capitulo`(`descripcion`, `isActivo`, `titulo`, `orden`) VALUES ('',1,'VALORACIÓN DEL RIESGO',5);
INSERT INTO `capitulo`(`descripcion`, `isActivo`, `titulo`, `orden`) VALUES ('',1,'POLÍTICA DE GESTIÓN DE RIESGOS',6);
INSERT INTO `capitulo`(`descripcion`, `isActivo`, `titulo`, `orden`) VALUES ('',1,'ORGANIZACIÓN PARA LOS PREPARATIVOS Y RESPUESTA',7);
INSERT INTO `capitulo`(`descripcion`, `isActivo`, `titulo`, `orden`) VALUES ('',1,'PLAN DE ACCIÓN',8);
INSERT INTO `capitulo`(`descripcion`, `isActivo`, `titulo`, `orden`) VALUES ('',1,'MECANISMOS DE ACTIVACIÓN',9);
INSERT INTO `capitulo`(`descripcion`, `isActivo`, `titulo`, `orden`) VALUES ('',1,'PROCEDIMIENTOS OPERATIVOS DE RESPUESTA',10);
INSERT INTO `capitulo`(`descripcion`, `isActivo`, `titulo`, `orden`) VALUES ('',1,'EVALUACIÓN DEL PLAN DE PREPARATIVOS Y RESPUESTA',11);
INSERT INTO `capitulo`(`descripcion`, `isActivo`, `titulo`, `orden`) VALUES ('',1,'DEFINICIONES Y TÉRMINOS',12);
INSERT INTO `capitulo`(`descripcion`, `isActivo`, `titulo`, `orden`) VALUES ('',1,'ANEXO',13);


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

 
drop table TipoPoblacion;
drop table Formulario;
drop table SubCapitulo;
drop table Capitulo;
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