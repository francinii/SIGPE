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
-- Procedure structure for insert_user
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
                    INSERT INTO `OrigenAmenaza`(descripcion,isActivo) VALUES (p_nombre, p_pass, p_activo);
            COMMIT;
            -- SUCCESS
            SET res = 0;
            -- Existe usuario
END
;;
DELIMITER ;



