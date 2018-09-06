/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  factoria
 * Created: 26/07/2018
 */


create table Sede(
id int  NOT NULL AUTO_INCREMENT,
isActivo int,
nombreSede varchar(150),
descripcion varchar(150),
PRIMARY KEY(id)
)ENGINE=InnoDB;

create table ZonaTrabajo(
id int  NOT NULL AUTO_INCREMENT,
FKidSede int,
isActivo int,
nombreZonaTrabajo varchar(150),
descripcion varchar(150),
logo varchar(150),
ubicacion varchar(150),
PRIMARY KEY(id),
FOREIGN KEY(FKidSede) REFERENCES Sede(id)
)ENGINE=InnoDB;

create table UsuarioZona(
FKidUsuario varchar(50),
FKidZona int,
FOREIGN KEY(FKidZona) REFERENCES ZonaTrabajo(id)
) ENGINE=InnoDB;


create table PlanEmergencia(
id int  NOT NULL AUTO_INCREMENT,
FKidZonaTrabajo int, 
revisadoPor varchar(150),
codigoZonaTrabajo varchar(150),
actividad varchar(150),
direccion varchar(150),
personaContactoGeneral varchar(150),
numeroTelefono varchar(150),
numeroFax varchar(150),
notificaciones varchar(150),
categoriaNFPA varchar(150),
usoInstalaciones varchar(150),
horarioJornada varchar(150),
seguridadInstitucional varchar(150),
servicioConsegeria varchar(150),
personalAdministrativo varchar(150),
personalAcademico varchar(150),
presenciaEstudiantil varchar(150),
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
PRIMARY KEY(id),
FOREIGN KEY(FKidZonaTrabajo) REFERENCES ZonaTrabajo(id)
)ENGINE=InnoDB;

create table OrigenAmenaza(
    id int NOT NULL AUTO_INCREMENT,
    descripcion varchar(150),
    isActivo int,
    PRIMARY KEY(id)
)ENGINE=InnoDB;


create table TipoAmenaza (
    id int NOT NULL AUTO_INCREMENT,  
    descripcion varchar(150),
    isActivo int,
    FkidOrigen int,
    PRIMARY KEY(id),
    FOREIGN KEY(FKidOrigen) REFERENCES OrigenAmenaza(id)
)ENGINE=InnoDB;

create table CategoriaTipoAmenaza (
    id int NOT NULL AUTO_INCREMENT, 
    FKidTipoAmenaza int,   
    isActivo int,
    descripcion varchar(150),    
    PRIMARY KEY(id), 
    FOREIGN KEY(FKidTipoAmenaza) REFERENCES TipoAmenaza(id)
)ENGINE=InnoDB;

create table Matriz (
    id int NOT NULL AUTO_INCREMENT,  
    FKidCategoriaTipoAmenaza int,
    FKidPlanEmergencias int,
    fuente varchar(5000),
    probabilidad int,
    gravedad int,
    consecuenciaAmenaza int,
    PRIMARY KEY(id), 
    FOREIGN KEY(FKidCategoriaTipoAmenaza) REFERENCES CategoriaTipoAmenaza(id),
    FOREIGN KEY(FKidPlanEmergencias) REFERENCES PlanEmergencia(id)
)ENGINE=InnoDB;




create table Capitulo(
id int NOT NULL AUTO_INCREMENT,
descripcion varchar(5000),
isActivo int,
titulo varchar(150),
orden int,
 PRIMARY KEY(id) 
)ENGINE=InnoDB;

create table SubCapitulo(
id int NOT NULL AUTO_INCREMENT,
descripcion varchar(5000),
titulo varchar(150),
isActivo int,
FKidCapitulo int,
orden int,
PRIMARY KEY(id),
FOREIGN KEY (FKidCapitulo) REFERENCES Capitulo(id)
)ENGINE=InnoDB;

create table Formulario(
id int NOT NULL AUTO_INCREMENT,
descripcion varchar(5000),
FKidSubcapitulos int,
PRIMARY KEY(id),
FOREIGN KEY (FKidSubcapitulos) REFERENCES SubCapitulo(id)
)ENGINE=InnoDB;


create table TipoPoblacion(
id int NOT NULL AUTO_INCREMENT,
FKidPlanEmergencias int,
tipoPoblacion varchar(150),
descripcion varchar(150),
total int,
representacionDe varchar(150),
PRIMARY KEY(id),
FOREIGN KEY(FKidPlanEmergencias) REFERENCES PlanEmergencia(id)
) ENGINE=InnoDB;

create table RecursoHumanos(
id int NOT NULL AUTO_INCREMENT,
FKidPlanEmergencias int,
cantidad int,
profesion varchar(150),
categorias varchar(150),
localizacion varchar(150),
contacto varchar(150),
PRIMARY KEY(id),
FOREIGN KEY(FKidPlanEmergencias) REFERENCES PlanEmergencia(id)
) ENGINE=InnoDB;

create table EquipoMovil(
id int NOT NULL AUTO_INCREMENT,
FKidPlanEmergencias int,
cantidad int,
capacidad varchar(150),
tipo varchar(150),
caracteristicas varchar(150),
contacto varchar(150),
ubicacion varchar(150),
categoria varchar(150),
PRIMARY KEY(id),
FOREIGN KEY(FKidPlanEmergencias) REFERENCES PlanEmergencia(id)
) ENGINE=InnoDB;

create table RecursoIntalaciones(
id int NOT NULL AUTO_INCREMENT,
FKidPlanEmergencias int,
tipo int,
cantidad int,
tamaño varchar(150),
distribucion varchar(150),
contacto varchar(150),
ubicacion varchar(150),
PRIMARY KEY(id),
FOREIGN KEY(FKidPlanEmergencias) REFERENCES PlanEmergencia(id)
) ENGINE=InnoDB;

create table RecursosOtros(
id int NOT NULL AUTO_INCREMENT,
FKidPlanEmergencias int,
cantidad int,
tipo varchar(150),
caracteristicas varchar(150),
contacto varchar(150),
ubicacion varchar(150),
categoria varchar(150),
categoria varchar(150),
PRIMARY KEY(id),
FOREIGN KEY(FKidPlanEmergencias) REFERENCES PlanEmergencia(id)
) ENGINE=InnoDB;

create table CuerposScorro(
id int NOT NULL AUTO_INCREMENT,
FKidPlanEmergencias int,
cantidad int,
tipo varchar(150),
ubicacion varchar(150),
Distancia varchar(150),
Tiempo varchar(150),
PRIMARY KEY(id),
FOREIGN KEY(FKidPlanEmergencias) REFERENCES PlanEmergencia(id)
) ENGINE=InnoDB;

-- faltan 3 tablas increso cuerpo de socorro y  las rutas de evacuacion

create table ZonaSegurida(
id int NOT NULL AUTO_INCREMENT,
FKidPlanEmergencias int,
Nombre varchar(150),
ubicacion varchar(150),
capacidad varchar(150),
observaciones varchar(150),
sector varchar(150),
PRIMARY KEY(id),
FOREIGN KEY(FKidPlanEmergencias) REFERENCES PlanEmergencia(id)
) ENGINE=InnoDB;

-- para wamp en cada tabla ENGINE=INNODB;

INSERT INTO `Sede`(`isActivo`, `nombreSede`, `descripcion`) VALUES (1,'Heredia','Heredia');
INSERT INTO `Sede`(`isActivo`, `nombreSede`, `descripcion`) VALUES (1,'San Jose','San Jose');
INSERT INTO `Sede`(`isActivo`, `nombreSede`, `descripcion`) VALUES (1,'Alajuela','Alajuela');

INSERT INTO `BDSIGPE`.`ZonaTrabajo` (`FKidSede`,`isActivo`,`nombreZonaTrabajo`,`descripcion`) VALUES (1,1,'Escuala de informatica','Zona ubicada en la region de limon');
INSERT INTO `BDSIGPE`.`ZonaTrabajo` (`FKidSede`,`isActivo`,`nombreZonaTrabajo`,`descripcion`) VALUES (2,1,'central','Zona ubicada en la region de Heredia');
INSERT INTO `BDSIGPE`.`ZonaTrabajo` (`FKidSede`,`isActivo`,`nombreZonaTrabajo`,`descripcion`) VALUES (2,1,'side','Zona ubicada en la region de Guanacaste');
INSERT INTO `BDSIGPE`.`ZonaTrabajo` (`FKidSede`,`isActivo`,`nombreZonaTrabajo`,`descripcion`) VALUES (3,1,'Sede alajuela','Zona ubicada en la region de Alajuela');
INSERT INTO `BDSIGPE`.`ZonaTrabajo` (`FKidSede`,`isActivo`,`nombreZonaTrabajo`,`descripcion`) VALUES (1,1,'Sede Cartago','Zona ubicada en la region de Cartago');

INSERT INTO `PlanEmergencia`( `FKidZonaTrabajo`) VALUES(1);
INSERT INTO `PlanEmergencia`( `FKidZonaTrabajo`) VALUES(2);
INSERT INTO `PlanEmergencia`( `FKidZonaTrabajo`) VALUES(3);
INSERT INTO `PlanEmergencia`( `FKidZonaTrabajo`) VALUES(4);
INSERT INTO `PlanEmergencia`( `FKidZonaTrabajo`) VALUES(5);

INSERT INTO `BDSIGPE`.`OrigenAmenaza` (`descripcion`,`isActivo`) VALUES ('Natural',1);
INSERT INTO `BDSIGPE`.`OrigenAmenaza` (`descripcion`,`isActivo`) VALUES ('Socio-Natural',1);
INSERT INTO `BDSIGPE`.`OrigenAmenaza` (`descripcion`,`isActivo`) VALUES ('Antrópica',1);

INSERT INTO `BDSIGPE`.`TipoAmenaza` (`descripcion`,`isActivo`,FkidOrigen) VALUES ('Geodinámica interna',1,1);
INSERT INTO `BDSIGPE`.`TipoAmenaza` (`descripcion`,`isActivo`,FkidOrigen) VALUES ('Hidrometereológicas',1,1);
INSERT INTO `BDSIGPE`.`TipoAmenaza` (`descripcion`,`isActivo`,FkidOrigen) VALUES ('Geodinamica externa',1,1);
INSERT INTO `BDSIGPE`.`TipoAmenaza` (`descripcion`,`isActivo`,FkidOrigen) VALUES ('Biológicas',1,1);
INSERT INTO `BDSIGPE`.`TipoAmenaza` (`descripcion`,`isActivo`,FkidOrigen) VALUES ('Socio-natural',1,2);
INSERT INTO `BDSIGPE`.`TipoAmenaza` (`descripcion`,`isActivo`,FkidOrigen) VALUES ('Antrópica',1,3);


INSERT INTO `Capitulo`(`descripcion`, `isActivo`, `titulo`, `orden`) VALUES ('',1,'PRESENTACIÓN',1);
INSERT INTO `Capitulo`(`descripcion`, `isActivo`, `titulo`, `orden`) VALUES ('',1,'INFORMACIÓN GENERAL DE LA ORGANIZACIÓN',2);
INSERT INTO `Capitulo`(`descripcion`, `isActivo`, `titulo`, `orden`) VALUES ('',1,'VALORACIÓN DEL RIESGO',3);
INSERT INTO `Capitulo`(`descripcion`, `isActivo`, `titulo`, `orden`) VALUES ('',1,'POLÍTICA DE GESTIÓN DE RIESGOS',4);
INSERT INTO `Capitulo`(`descripcion`, `isActivo`, `titulo`, `orden`) VALUES ('',1,'ORGANIZACIÓN PARA LOS PREPARATIVOS Y RESPUESTA',5);
INSERT INTO `Capitulo`(`descripcion`, `isActivo`, `titulo`, `orden`) VALUES ('',1,'PLAN DE ACCIÓN',6);
INSERT INTO `Capitulo`(`descripcion`, `isActivo`, `titulo`, `orden`) VALUES ('',1,'MECANISMOS DE ACTIVACIÓN',7);
INSERT INTO `Capitulo`(`descripcion`, `isActivo`, `titulo`, `orden`) VALUES ('',1,'PROCEDIMIENTOS OPERATIVOS DE RESPUESTA',8);
INSERT INTO `Capitulo`(`descripcion`, `isActivo`, `titulo`, `orden`) VALUES ('',1,'EVALUACIÓN DEL PLAN DE PREPARATIVOS Y RESPUESTA',9);
INSERT INTO `Capitulo`(`descripcion`, `isActivo`, `titulo`, `orden`) VALUES ('',1,'DEFINICIONES Y TÉRMINOS',10);
INSERT INTO `Capitulo`(`descripcion`, `isActivo`, `titulo`, `orden`) VALUES ('',1,'ANEXO',11);


INSERT INTO `SubCapitulo`( `descripcion`, `titulo`, `isActivo`, `FKidCapitulo`, `orden`) VALUES ('descripcion','Propósito',1,1,1);
INSERT INTO `SubCapitulo`( `descripcion`, `titulo`, `isActivo`, `FKidCapitulo`, `orden`) VALUES ('descripcion','Alcance',1,1,2);
INSERT INTO `SubCapitulo`( `descripcion`, `titulo`, `isActivo`, `FKidCapitulo`, `orden`) VALUES ('descripcion','Marco normativo',1,1,3);
INSERT INTO `SubCapitulo`( `descripcion`, `titulo`, `isActivo`, `FKidCapitulo`, `orden`) VALUES ('descripcion','Descripción del plan',1,1,4);
INSERT INTO `SubCapitulo`( `descripcion`, `titulo`, `isActivo`, `FKidCapitulo`, `orden`) VALUES ('descripcion','Documentos de referencia',1,1,5);
 

INSERT INTO `Formulario`(`descripcion`, `FKidSubCapitulos`) VALUES ('Datos generales',1);
INSERT INTO `Formulario`(`descripcion`, `FKidSubCapitulos`) VALUES ('Tipo de población',1);
INSERT INTO `Formulario`(`descripcion`, `FKidSubcapitulos`) VALUES ('Instalaciones',1);
INSERT INTO `Formulario`(`descripcion`, `FKidSubcapitulos`) VALUES ('Matriz de riesgo',1);


INSERT INTO `UsuarioZona`(`FKidUsuario`, `FKidZona`) VALUES ('402340420',1);
INSERT INTO `UsuarioZona`(`FKidUsuario`, `FKidZona`) VALUES ('402340420',2);
INSERT INTO `UsuarioZona`(`FKidUsuario`, `FKidZona`) VALUES ('402340420',5);

insert into `PlanEmergencia`(`FKidZonaTrabajo`) VALUES (1);



-- ******************************Alerta***********************************
-- correr solo una vez en la base 
-- inserta en la base de permisos
INSERT INTO `sis_mod` VALUES ('4', 'Administración Planes', 'Administración de los planes de energencia', '1');
INSERT INTO `sis_mod` VALUES ('5', 'Planes de emergencia', 'permite la edición de los planes de emergencia', '1');

INSERT INTO `sis_permits`( `id_mod`, `id_action`, `id_roll`) VALUES ('5','1','2');
INSERT INTO `sis_permits`( `id_mod`, `id_action`, `id_roll`) VALUES ('5','2','2');
INSERT INTO `sis_permits`( `id_mod`, `id_action`, `id_roll`) VALUES ('5','3','2');
INSERT INTO `sis_permits`( `id_mod`, `id_action`, `id_roll`) VALUES ('5','4','2');
INSERT INTO `sis_permits`( `id_mod`, `id_action`, `id_roll`) VALUES ('5','5','2');
INSERT INTO `sis_permits`( `id_mod`, `id_action`, `id_roll`) VALUES ('5','6','2');

INSERT INTO `sis_permits`( `id_mod`, `id_action`, `id_roll`) VALUES ('4','1','2');
INSERT INTO `sis_permits`( `id_mod`, `id_action`, `id_roll`) VALUES ('4','2','2');
INSERT INTO `sis_permits`( `id_mod`, `id_action`, `id_roll`) VALUES ('4','3','2');
INSERT INTO `sis_permits`( `id_mod`, `id_action`, `id_roll`) VALUES ('4','4','2');
INSERT INTO `sis_permits`( `id_mod`, `id_action`, `id_roll`) VALUES ('4','5','2');
INSERT INTO `sis_permits`( `id_mod`, `id_action`, `id_roll`) VALUES ('4','6','2');




drop table TipoPoblacion;
drop table Formulario;
drop table SubCapitulo;
drop table Capitulo;
drop table Matriz;
drop table CategoriaTipoAmenaza;
drop table TipoAmenaza;
drop table OrigenAmenaza;
drop table PlanEmergencia;
drop  table UsuarioZona;
drop table ZonaTrabajo;
drop table Sede;



-- ----------------Procedimientos almacenados----------------------------------
-- ----------------------------
-- Proceso insertar zona de trabajo
-- ----------------------------
DROP PROCEDURE IF EXISTS `insert_sede`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_sede`(IN `p_nombre` varchar(150),IN `p_activo` int, IN `p_descripcion` varchar(150), OUT `res` TINYINT  UNSIGNED)
BEGIN
	DECLARE EXIT HANDLER FOR SQLEXCEPTION
	BEGIN
		-- ERROR
    SET res = -1;
    ROLLBACK;
	END;

  DECLARE EXIT HANDLER FOR SQLWARNING
	BEGIN
		-- ERROR
    SET res = -2;
    ROLLBACK;
	END;
            START TRANSACTION;
                    INSERT INTO `Sede`(nombreSede,isActivo, descripcion) VALUES (p_nombre, p_activo,p_descripcion);
            COMMIT;
            -- SUCCESS
END
;;
DELIMITER ;

-- ----------------------------
-- Proceso insertar zona de trabajo
-- ----------------------------
DROP PROCEDURE IF EXISTS `insert_zona_trabajo`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_zona_trabajo`(IN `p_nombre` varchar(150),IN `p_FKidSede` int,IN `p_activo` int,IN `p_logo` varchar(150), IN `p_ubicacion` varchar(150), IN `p_descripcion` varchar(150), OUT `res` TINYINT  UNSIGNED)
BEGIN
	DECLARE EXIT HANDLER FOR SQLEXCEPTION
	BEGIN
		-- ERROR
    SET res = -1;
    ROLLBACK;
	END;

  DECLARE EXIT HANDLER FOR SQLWARNING
	BEGIN
		-- ERROR
    SET res = -2;
    ROLLBACK;
	END;
            START TRANSACTION;
                    INSERT INTO `ZonaTrabajo`(FKidSede,nombreZonaTrabajo,isActivo, descripcion,logo,ubicacion) VALUES (p_FKidSede,p_nombre, p_activo,p_descripcion,p_logo,p_ubicacion);
                    SELECT  MAX(id) into res from ZonaTrabajo ;
                    INSERT INTO `PlanEmergencia`(FKidZonaTrabajo) VALUES (res);                  
            COMMIT;
            -- SUCCESS
END
;;
DELIMITER ;


-- ----------------------------
-- Proceso insertar elemento a usuarioZona
-- ----------------------------
DROP PROCEDURE IF EXISTS `insert_usuario_zona_trabajo`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_usuario_zona_trabajo`(IN `p_FKidUsuario` varchar(50),IN `p_FKidZona` int, OUT `res` TINYINT  UNSIGNED)
BEGIN   
         declare existe Integer;
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
                    select count(`FKidUsuario`) into existe from UsuarioZona where FKidUsuario=p_FKidUsuario and FKidZona=p_FKidZona;
                    IF(existe = 0) THEN
                    INSERT INTO `UsuarioZona`(FKidUsuario,FKidZona) VALUES (p_FKidUsuario, p_FKidZona);
                    END IF; 

            COMMIT;
            -- SUCCESS
            SET res = 0;
            -- Existe usuario
END
;;
DELIMITER ;

-- ----------------------------
-- Proceso Eliminar elemento a usuarioZona
-- ----------------------------
DROP PROCEDURE IF EXISTS `delete_usuario_zona_trabajo`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_usuario_zona_trabajo`(IN `p_FKidZona` int, OUT `res` TINYINT  UNSIGNED)
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
                  DELETE FROM `UsuarioZona` WHERE `FKidZona`=p_FKidZona;                   

            COMMIT;
            -- SUCCESS
            SET res = 0;
            -- Existe usuario
END
;;
DELIMITER ;





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
-- Proceso eliminar zona de trabajo
-- ----------------------------
DROP PROCEDURE IF EXISTS `delete_sede`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_sede`(IN `p_id` varchar(50),OUT `res` tinyint unsigned)
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
		DELETE FROM Sede WHERE id=p_id;
	
	COMMIT;
	-- SUCCESS
	SET res = 0;
END
;;
DELIMITER ;


-- ----------------------------
-- Proceso eliminar zona de trabajo
-- ----------------------------
DROP PROCEDURE IF EXISTS `delete_zona_trabajo`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_zona_trabajo`(IN `p_id` varchar(50),OUT `res` tinyint unsigned)
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
		DELETE FROM ZonaTrabajo WHERE id=p_id;
	
	COMMIT;
	-- SUCCESS
	SET res = 0;
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
DELIMITER ;


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
;;
DELIMITER ;

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
;;
DELIMITER ;

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
;;
DELIMITER ;
-- ----------------------------
-- Proceso insertar capitulo
-- ----------------------------


DROP PROCEDURE IF EXISTS `insert_capitulo`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_capitulo`(IN `p_titulo` varchar(150),IN `p_activo` int, IN  `p_descripcion` varchar(5000),  OUT `res` TINYINT  UNSIGNED)
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
            select MAX(`orden`) into ordenar from Capitulo;
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_subcapitulo`(IN `p_titulo` varchar(150),IN `p_activo` int, IN  `p_fkcapitulo` int,IN  `p_descripcion` varchar(5000),  OUT `res` TINYINT  UNSIGNED)
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
            select MAX(orden) into ordenar from SubCapitulo where FKidCapitulo=p_fkcapitulo;
             IF (ISNULL(ordenar)) THEN
                SET ordenar=1;
            ELSE
                SET ordenar= ordenar +1;   
            END IF;  
            START TRANSACTION;
                    INSERT INTO `SubCapitulo`(descripcion, titulo, isActivo, FKidCapitulo, orden) VALUES (p_descripcion, p_titulo,p_activo,p_fkcapitulo,ordenar);
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_capitulo`(IN `p_id` int,IN `p_titulo` varchar(150), IN  `p_descripcion` varchar(5000), OUT `res` TINYINT  UNSIGNED)
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_subcapitulo`(IN `p_id` int,IN `p_titulo` varchar(150),IN `p_fkcapitulo` int, IN  `p_descripcion` varchar(5000), OUT `res` TINYINT  UNSIGNED)
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
            select FKidCapitulo into FKAntigua from SubCapitulo WHERE `id`=p_id;
            IF(FKAntigua = p_fkcapitulo) THEN
                  START TRANSACTION;
                   UPDATE `SubCapitulo` SET `descripcion`= p_descripcion ,`titulo`=p_titulo, `FKidCapitulo`=p_fkcapitulo WHERE `id`=p_id;
                 COMMIT;
                -- SUCCESS
                SET res = 0;
            ELSE
                select MAX(orden) into ordenar from SubCapitulo where FKidCapitulo=p_fkcapitulo;
                IF (ISNULL(ordenar)) THEN
                  SET ordenar=1;
                ELSE
                  SET ordenar= ordenar +1;   
                END IF;
                START TRANSACTION;
                   UPDATE `SubCapitulo` SET `descripcion`= p_descripcion ,`titulo`=p_titulo, `FKidCapitulo`=p_fkcapitulo,`orden`=ordenar WHERE `id`=p_id;
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `ordenar_capitulo`(IN `p_id` int,IN `p_orden` int, OUT `res` TINYINT  UNSIGNED)
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
                   UPDATE `Capitulo` SET `orden`= p_orden WHERE `id`=p_id;            
            COMMIT;
            -- SUCCESS
            SET res = 0;
            -- Existe usuario
END
;;
DELIMITER ;


-- ----------------------------
-- Proceso actualizar zona de trabajo
-- ----------------------------
DROP PROCEDURE IF EXISTS `update_zona_trabajo`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_zona_trabajo`(IN `p_id` int, IN `p_FKidSede` int,IN `p_nombre` varchar(150),IN `p_activo` int,IN `p_logo` varchar(150),IN `p_ubicacion` varchar(150), IN `p_descripcion` varchar(150), OUT `res` TINYINT  UNSIGNED)
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
        UPDATE `ZonaTrabajo` SET `FKidSede`= p_FKidSede ,`nombreZonaTrabajo`= p_nombre ,`isActivo`= p_activo,descripcion = p_descripcion, logo=p_logo, ubicacion=p_ubicacion WHERE `id`= p_id;
        COMMIT;
        -- SUCCESS      
        SET res = 0;      
       
END
;;
DELIMITER ;


-- ----------------------------
-- Proceso actualizar zona de trabajo
-- ----------------------------
DROP PROCEDURE IF EXISTS `update_sede`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_sede`(IN `p_id` int, IN `p_nombre` varchar(150),IN `p_activo` int, IN `p_descripcion` varchar(150), OUT `res` TINYINT  UNSIGNED)
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
        UPDATE `Sede` SET `nombreSede`= p_nombre ,`isActivo`= p_activo,descripcion = p_descripcion WHERE `id`= p_id;
        COMMIT;
        -- SUCCESS
        SET res = 0;
       
END
;;
DELIMITER ;
-- ----------------------------
-- Proceso ordenar Subcapitulos
-- ----------------------------
DROP PROCEDURE IF EXISTS `ordenar_subcapitulo`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `ordenar_subcapitulo`(IN `p_id` int,IN `p_orden` int,OUT `res` TINYINT  UNSIGNED)
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
                   UPDATE `SubCapitulo` SET `orden`= p_orden WHERE `id`=p_id;            
            COMMIT;
            -- SUCCESS
            SET res = 0;
            -- Existe usuario
END
;;
DELIMITER ;
-- CALL ordenar_subcapitulo(1,2,@res);


-- ----------------------------
-- Proceso activar capitulo
-- ----------------------------
DROP PROCEDURE IF EXISTS `active_capitulo`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `active_capitulo`(IN `p_id` int,IN `p_activo` int,OUT `respuesta` int)
BEGIN
    DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET respuesta=0;
    START TRANSACTION;
        UPDATE Capitulo SET  isActivo = p_activo WHERE id=p_id;
        SELECT ROW_COUNT() INTO respuesta;
    IF (respuesta=1) THEN
    COMMIT;
    ELSE
    ROLLBACK;
    SET respuesta=0;
END IF;
END
;;
DELIMITER ;


-- ----------------------------
-- Proceso activar subcapitulo
-- ----------------------------
DROP PROCEDURE IF EXISTS `active_subcapitulo`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `active_subcapitulo`(IN `p_id` int,IN `p_activo` int,OUT `respuesta` int)
BEGIN
    DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET respuesta=0;
    START TRANSACTION;
        UPDATE SubCapitulo SET  isActivo = p_activo WHERE id=p_id;
        SELECT ROW_COUNT() INTO respuesta;
    IF (respuesta=1) THEN
    COMMIT;
    ELSE
    ROLLBACK;
    SET respuesta=0;
END IF;
END
;;
DELIMITER ;

-- ----------------------------
-- Proceso eliminar origen de amenaza
-- ----------------------------
DROP PROCEDURE IF EXISTS `delete_capitulo`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_capitulo`(IN `p_id` varchar(50),OUT `res` tinyint unsigned)
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
		DELETE FROM Capitulo WHERE id=p_id;
	
	COMMIT;
	-- SUCCESS
	SET res = 0;
END
;;
DELIMITER ;


-- ----------------------------
-- Proceso eliminar origen de amenaza
-- ----------------------------
DROP PROCEDURE IF EXISTS `delete_subcapitulo`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_subcapitulo`(IN `p_id` varchar(50),OUT `res` tinyint unsigned)
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
		DELETE FROM SubCapitulo WHERE id=p_id;
	
	COMMIT;
	-- SUCCESS
	SET res = 0;
END
;;
DELIMITER ;
-- ----------------------------
-- Proceso actualizar origen de amenaza
-- ----------------------------
DROP PROCEDURE IF EXISTS `update_origen_amenaza`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_origen_amenaza`(IN `p_id` int, IN `p_nombre` varchar(150),IN `p_activo` int, OUT `res` TINYINT  UNSIGNED)
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
        UPDATE `OrigenAmenaza` SET `descripcion`= p_nombre ,`isActivo`= p_activo WHERE `id`= p_id;
        COMMIT;
        -- SUCCESS
        SET res = 0;
       
END
;;
DELIMITER ;


-- update_zona_trabajo('$id','$nombre','$activo','$descripcion',@res);";


-- ----------------------------
-- Proceso actualizar tipo de amenaza
-- ----------------------------
DROP PROCEDURE IF EXISTS `update_tipo_amenaza`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_tipo_amenaza`(IN `p_id` int, IN `p_nombre` varchar(150),IN `p_activo` int, IN `p_FkidOrigen` int, OUT `res` TINYINT  UNSIGNED)
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
        UPDATE `TipoAmenaza` SET `descripcion`= p_nombre ,`isActivo`= p_activo, `FkidOrigen` = p_FkidOrigen WHERE `id`= p_id;
        COMMIT;
        -- SUCCESS
        SET res = 0;
       
END
;;
DELIMITER ;


-- ----------------------------
-- Proceso actualizar categoria de amenaza
-- ----------------------------
DROP PROCEDURE IF EXISTS `update_categoria_amenaza`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_categoria_amenaza`(IN `p_id` int, IN `p_nombre` varchar(150),IN `p_activo` int, IN `p_FKidTipoAmenaza` int, OUT `res` TINYINT  UNSIGNED)
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
        UPDATE `CategoriaTipoAmenaza` SET `descripcion`= p_nombre ,`isActivo`= p_activo, `FKidTipoAmenaza` = p_FKidTipoAmenaza WHERE `id`= p_id;
        COMMIT;
        -- SUCCESS
        SET res = 0;
       
END
;;
DELIMITER ;

-- ----------------------------
-- Proceso ordenar formularios
-- ----------------------------

DROP PROCEDURE IF EXISTS `ordenar_formulario`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `ordenar_formulario`(IN `p_id` int, IN `p_subcapitulo` int, OUT `res` TINYINT  UNSIGNED)
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
        UPDATE `Formulario` SET `FKidSubcapitulos`= p_subcapitulo  WHERE `id`= p_id;
        COMMIT;
        -- SUCCESS
        SET res = 0;
       
END
;;
DELIMITER ;
-- ordenar_formulario('1','2',@res);

-- ----------------------------
-- Proceso datos generales
-- ----------------------------
DROP PROCEDURE IF EXISTS `datos_generales`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `datos_generales`(IN `p_FKidZonaTrabajo` int, IN `p_actividad` varchar(150),
 IN `p_direccion` varchar(150), IN `p_personaContactoGeneral` varchar(150),IN `p_numeroTelefono` varchar(150),
 IN `p_numeroFax` varchar(150),IN `p_notificaciones` varchar(150),
 IN `p_categoriaNFPA` varchar(150),IN `p_usoInstalaciones` varchar(150),
 IN `p_horarioJornada` varchar(150),IN `p_seguridadInstitucional` varchar(150),
 IN `p_servicioConsegeria` varchar(150),IN `p_personalAdministrativo` varchar(150),
 IN `p_personalAcademico` varchar(150),IN `p_presenciaEstudiantil` varchar(150),
 OUT `res` TINYINT  UNSIGNED)
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
         UPDATE `PlanEmergencia` SET `actividad`=p_actividad,`direccion`= p_direccion,`personaContactoGeneral`=p_personaContactoGeneral,
         `numeroTelefono`=p_numeroTelefono,`numeroFax`= p_numeroFax,`notificaciones`=p_notificaciones,`categoriaNFPA`=p_categoriaNFPA,`usoInstalaciones`=p_usoInstalaciones,`horarioJornada`=p_horarioJornada,
         `seguridadInstitucional`=p_seguridadInstitucional,`servicioConsegeria`=p_servicioConsegeria,`personalAdministrativo`=p_personalAdministrativo,`personalAcademico`=p_personalAcademico,
           `presenciaEstudiantil` = p_presenciaEstudiantil   where `FKidZonaTrabajo`=p_FKidZonaTrabajo;   

        COMMIT;
        -- SUCCESS         

         SET res = 0;
END
;;
DELIMITER ;
-- Call datos_generales(1,'3','3','3','3','3','3','3','3','3','3','3','3','3',@res);
--    SELECT @res as res;

-- ----------------------------
-- Proceso tipoPoblacion actividades
-- ----------------------------
DROP PROCEDURE IF EXISTS `tipo_poblacion`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `tipo_poblacion`(IN `p_FKidPlanEmergencias` int, IN `p_tipoPoblacion` varchar(150),
 IN `p_descripcion` varchar(150), IN `p_total` int, IN `p_representacionDe` varchar(150),
OUT `res` TINYINT  UNSIGNED)
BEGIN   
    declare existe Integer;
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

      set existe = null;
      select count(`FKidPlanEmergencias`) into existe from TipoPoblacion WHERE  `FKidPlanEmergencias`=p_FKidPlanEmergencias and `tipoPoblacion`=p_tipoPoblacion;
         IF(existe = 1) THEN
         START TRANSACTION;
         UPDATE `TipoPoblacion` SET `descripcion`=p_descripcion,`total`=p_total,`representacionDe`=p_representacionDe WHERE `FKidPlanEmergencias`=p_FKidPlanEmergencias and `tipoPoblacion`=p_tipoPoblacion;  
        COMMIT;
        -- SUCCESS       
     ELSE
        START TRANSACTION;       
       INSERT INTO `TipoPoblacion`( `FKidPlanEmergencias`, `tipoPoblacion`, `descripcion`, `total`, `representacionDe`)
       VALUES (p_FKidPlanEmergencias,p_tipoPoblacion,p_descripcion,p_total,p_representacionDe);
         
        COMMIT;
        -- SUCCESS         
   END IF;
         SET res = 0;
END
;;
DELIMITER ;

-- call tipo_poblacion(1,'1','1',1,'1',@res);

-- ----------------------------
-- Proceso datos generales
-- ----------------------------
DROP PROCEDURE IF EXISTS `datos_Instalaciones`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `datos_Instalaciones`(
 IN `p_FKidZonaTrabajo` int, IN `p_instalacionesDensidadOcupacion` varchar(150),
 IN `p_instalacionesAreaConstruccion` varchar(150), IN `p_instalacionesInstalaciones` varchar(150),
 IN `p_instalacionesCaracteristicasZona` varchar(150), IN `p_instalacionesTopografia` varchar(150),
 IN `p_instalacionesNivelTerreno` varchar(150), IN `p_instalacionesColindates` varchar(150),
 IN `p_elementosConstructivosTipoConstruccion` varchar(150), IN `p_elementosConstructivosAntiguedad` varchar(150),
 IN `p_elementosConstructivosCimientos` varchar(150), IN `p_elementosConstructivosEstructura` varchar(150),
IN `p_elementosConstructivosParedes` varchar(150), IN `p_elementosConstructivosEntrepiso` varchar(150),
IN `p_elementosConstructivosTecho` varchar(150), IN `p_elementosConstructivosCielos` varchar(150),
IN `p_elementosConstructivosPisos` varchar(150), IN `p_elementosConstructivosAreaParqueo` varchar(150),
IN `p_elementosConstructivosSistemaAguaPotable` varchar(150), IN `p_elementosConstructivosAlcantarilladoSanitario` varchar(150),
IN `p_elementosConstructivosAlcantarilladoPluvial` varchar(150), IN `p_elementosConstructivosSistemaElectrico` varchar(150),
IN `p_elementosConstructivosSistemaTelefonico` varchar(150),
IN `p_elementosConstructivosOtros` varchar(150), OUT `res` TINYINT  UNSIGNED)
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
         UPDATE `PlanEmergencia` SET `instalacionesDensidadOcupacion`=p_instalacionesDensidadOcupacion,`instalacionesAreaConstruccion`=p_instalacionesAreaConstruccion,
        `instalacionesInstalaciones`=p_instalacionesInstalaciones,`instalacionesCaracteristicasZona`=p_instalacionesCaracteristicasZona,
        `instalacionesTopografia`=p_instalacionesTopografia,`instalacionesNivelTerreno`=p_instalacionesNivelTerreno,`instalacionesColindates`=p_instalacionesColindates,
         `elementosConstructivosTipoConstruccion`=p_elementosConstructivosTipoConstruccion,`elementosConstructivosAntiguedad`=p_elementosConstructivosAntiguedad,
         `elementosConstructivosCimientos`=p_elementosConstructivosCimientos,`elementosConstructivosEstructura`=p_elementosConstructivosEstructura,
        `elementosConstructivosParedes`=p_elementosConstructivosParedes,`elementosConstructivosEntrepiso`=p_elementosConstructivosEntrepiso,`elementosConstructivosTecho`=p_elementosConstructivosTecho,
        `elementosConstructivosCielos`=p_elementosConstructivosCielos,`elementosConstructivosPisos`=p_elementosConstructivosPisos,`elementosConstructivosAreaParqueo`=p_elementosConstructivosAreaParqueo,
        `elementosConstructivosSistemaAguaPotable`=p_elementosConstructivosSistemaAguaPotable,`elementosConstructivosAlcantarilladoSanitario`=p_elementosConstructivosAlcantarilladoSanitario,
        `elementosConstructivosAlcantarilladoPluvial`=p_elementosConstructivosAlcantarilladoPluvial,`elementosConstructivosSistemaElectrico`=p_elementosConstructivosSistemaElectrico,
        `elementosConstructivosSistemaTelefonico`=p_elementosConstructivosSistemaTelefonico,`elementosConstructivosOtros`=p_elementosConstructivosOtros WHERE  `FKidZonaTrabajo`=p_FKidZonaTrabajo;   

        COMMIT;
        -- SUCCESS         

         SET res = 0;
END
;;
DELIMITER ;
-- call datos_Instalaciones(1,'1','1',1,'1',@res);




-- ----------------------------
-- Proceso insertar y actualizar matriz de riesgos update_matriz
-- ----------------------------
DROP PROCEDURE IF EXISTS `update_matriz`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_matriz`(IN `p_id` int,IN `p_idZona` int, IN `p_fuente` varchar(150), IN `p_probabilidad` int, IN `p_gravedad` int, IN `p_consecuencia` int, OUT `res` TINYINT  UNSIGNED)
BEGIN
	declare existe Integer;
    declare idPlanEmergencia Integer;
	DECLARE EXIT HANDLER FOR SQLEXCEPTION
	BEGIN
		-- ERROR
    SET res = -1;
    ROLLBACK;
	END;

  DECLARE EXIT HANDLER FOR SQLWARNING
	BEGIN
		-- ERROR
    SET res = -2;
    ROLLBACK;
	END;
    
	SET existe = null;    
    SET idPlanEmergencia = null;    
    select `id` into idPlanEmergencia from PlanEmergencia WHERE  `FKidZonaTrabajo`=p_idZona;
    select count(`FKidCategoriaTipoAmenaza`) into existe from Matriz WHERE  `FKidCategoriaTipoAmenaza`=p_id and `FKidPlanEmergencias`=idPlanEmergencia;
    IF (existe = 1) THEN
    START TRANSACTION;
         UPDATE `Matriz` SET `fuente`=p_fuente,`probabilidad`=p_probabilidad,`gravedad`=p_gravedad,`consecuenciaAmenaza`=p_consecuencia WHERE `FKidCategoriaTipoAmenaza`=p_id and `FKidPlanEmergencias`=idPlanEmergencia;  
        SET res = 0;
        COMMIT;
     ELSE
        START TRANSACTION;       
            INSERT INTO `Matriz`(FKidCategoriaTipoAmenaza,FKidPlanEmergencias, fuente,probabilidad, gravedad, consecuenciaAmenaza) VALUES (p_id, idPlanEmergencia,p_fuente,p_probabilidad,p_gravedad, p_consecuencia);
       SET res = 0;
       COMMIT;
        -- SUCCESS         
   END IF;
  
END
;;
DELIMITER ;

