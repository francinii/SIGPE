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
    idOrigen int NOT NULL AUTO_INCREMENT,
    descripcion varchar(150),
    PRIMARY KEY(idOrigen)
);


create table TipoAmenaza (
    idTipoAmenaza int NOT NULL AUTO_INCREMENT,  
    descripcion varchar(150),
    FkidOrigen int,
    PRIMARY KEY(idTipoAmenaza),
    FOREIGN KEY(FKidOrigen) REFERENCES OrigenAmenaza(idOrigen)
);

create table CategoriaTipoAmenaza (
    idCategoriaTipoAmenaza int NOT NULL AUTO_INCREMENT,  
    FKidTipoAmenaza int,
    FKidZonaTrabajo int,
    descripcion varchar(150),
    fuente varchar(150),
    probabilidad int,
    gravedad int,
    consecuenciaAmenaza int,
    PRIMARY KEY(idCategoriaTipoAmenaza), 
    FOREIGN KEY(FKidTipoAmenaza) REFERENCES TipoAmenaza(idTipoAmenaza),
    FOREIGN KEY (FKidZonaTrabajo) REFERENCES ZonaTrabajo(id)
);


create table Capitulo(
idCapitulo int NOT NULL AUTO_INCREMENT,
descripcion text,
titulo varchar(150),
orden int,
 PRIMARY KEY(idCapitulo) 
);

create table SubCapitulo(
idSubCapitulo int NOT NULL AUTO_INCREMENT,
descripcion text,
titulo varchar(150),
FKidCapitulo int,
orden int,
PRIMARY KEY(idSubCapitulo),
FOREIGN KEY (FKidCapitulo) REFERENCES Capitulo(idCapitulo)
);

create table Formulario(
idFormulario int NOT NULL AUTO_INCREMENT,
descripcion text,
FKidSubcapitulos int,
PRIMARY KEY(idFormulario),
FOREIGN KEY (FKidSubcapitulos) REFERENCES SubCapitulo(idSubCapitulo)
);


create table TipoPoblacion(
idTipoPoblacion int NOT NULL AUTO_INCREMENT,
FKidZonaTrabajo int,
tipoPoblacion varchar(150),
descripcion varchar(150),
total int,
representacionDe varchar(150),
PRIMARY KEY(idTipoPoblacion),
FOREIGN KEY (FKidZonaTrabajo) REFERENCES ZonaTrabajo(id)
);



drop table TipoPoblacion;
drop table Formulario;
drop table SubCapitulo;
drop table Capitulo;
drop table CategoriaTipoAmenaza;
drop table TipoAmenaza;
drop table OrigenAmenaza;
drop table ZonaTrabajo;





INSERT INTO `BDSIGPE`.`ZonaTrabajo` ( `nombreZonaTrabajo`, `revisadoPor`, `codigoZonaTrabajo`, `actividad`, `direcion`, `personaContactoGeneral`, `numeroTelefono`, `numeroFax`, `notificaciones`, `categoriNFPA`, `usoInstalaciones`, `horarioJornada`, `seguridadInstitucional`, `servicioConsegeria`, `personalAdministrativo`, `presenciaEstudiantil`, `tipoPoblacion`, `tipoPoblacionPersonalAcademico`, `tipoPoblacionEstudiantes`, `instalacionesDensidadOcupacion`, `instalacionesAreaConstruccion`, `instalacionesInstalaciones`, `instalacionesCaracteristicasZona`, `instalacionesTopografia`, `instalacionesNivelTerreno`, `instalacionesColindates`, `elementosConstructivosTipoConstruccion`, `elementosConstructivosAntiguedad`, `elementosConstructivosCimientos`, `elementosConstructivosEstructura`, `elementosConstructivosParedes`, `elementosConstructivosEntrepiso`, `elementosConstructivosTecho`, `elementosConstructivosCielos`, `elementosConstructivosPisos`, `elementosConstructivosAreaParqueo`, `elementosConstructivosSistemaAguaPotable`, `elementosConstructivosAlcantarilladoSanitario`, `elementosConstructivosAlcantarilladoPluvial`, `elementosConstructivosSistemaElectrico`, `elementosConstructivosSistemaTelefonico`, `elementosConstructivosOtros`) VALUES ('Limon', 'Fran', 'Fran', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1');
INSERT INTO `BDSIGPE`.`ZonaTrabajo` ( `nombreZonaTrabajo`, `revisadoPor`, `codigoZonaTrabajo`, `actividad`, `direcion`, `personaContactoGeneral`, `numeroTelefono`, `numeroFax`, `notificaciones`, `categoriNFPA`, `usoInstalaciones`, `horarioJornada`, `seguridadInstitucional`, `servicioConsegeria`, `personalAdministrativo`, `presenciaEstudiantil`, `tipoPoblacion`, `tipoPoblacionPersonalAcademico`, `tipoPoblacionEstudiantes`, `instalacionesDensidadOcupacion`, `instalacionesAreaConstruccion`, `instalacionesInstalaciones`, `instalacionesCaracteristicasZona`, `instalacionesTopografia`, `instalacionesNivelTerreno`, `instalacionesColindates`, `elementosConstructivosTipoConstruccion`, `elementosConstructivosAntiguedad`, `elementosConstructivosCimientos`, `elementosConstructivosEstructura`, `elementosConstructivosParedes`, `elementosConstructivosEntrepiso`, `elementosConstructivosTecho`, `elementosConstructivosCielos`, `elementosConstructivosPisos`, `elementosConstructivosAreaParqueo`, `elementosConstructivosSistemaAguaPotable`, `elementosConstructivosAlcantarilladoSanitario`, `elementosConstructivosAlcantarilladoPluvial`, `elementosConstructivosSistemaElectrico`, `elementosConstructivosSistemaTelefonico`, `elementosConstructivosOtros`) VALUES ( 'Limon', 'Fran', 'Fran', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1');
INSERT INTO `BDSIGPE`.`ZonaTrabajo` ( `nombreZonaTrabajo`, `revisadoPor`, `codigoZonaTrabajo`, `actividad`, `direcion`, `personaContactoGeneral`, `numeroTelefono`, `numeroFax`, `notificaciones`, `categoriNFPA`, `usoInstalaciones`, `horarioJornada`, `seguridadInstitucional`, `servicioConsegeria`, `personalAdministrativo`, `presenciaEstudiantil`, `tipoPoblacion`, `tipoPoblacionPersonalAcademico`, `tipoPoblacionEstudiantes`, `instalacionesDensidadOcupacion`, `instalacionesAreaConstruccion`, `instalacionesInstalaciones`, `instalacionesCaracteristicasZona`, `instalacionesTopografia`, `instalacionesNivelTerreno`, `instalacionesColindates`, `elementosConstructivosTipoConstruccion`, `elementosConstructivosAntiguedad`, `elementosConstructivosCimientos`, `elementosConstructivosEstructura`, `elementosConstructivosParedes`, `elementosConstructivosEntrepiso`, `elementosConstructivosTecho`, `elementosConstructivosCielos`, `elementosConstructivosPisos`, `elementosConstructivosAreaParqueo`, `elementosConstructivosSistemaAguaPotable`, `elementosConstructivosAlcantarilladoSanitario`, `elementosConstructivosAlcantarilladoPluvial`, `elementosConstructivosSistemaElectrico`, `elementosConstructivosSistemaTelefonico`, `elementosConstructivosOtros`) VALUES ( 'Limon', 'Fran', 'Fran', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1');
INSERT INTO `BDSIGPE`.`ZonaTrabajo` ( `nombreZonaTrabajo`, `revisadoPor`, `codigoZonaTrabajo`, `actividad`, `direcion`, `personaContactoGeneral`, `numeroTelefono`, `numeroFax`, `notificaciones`, `categoriNFPA`, `usoInstalaciones`, `horarioJornada`, `seguridadInstitucional`, `servicioConsegeria`, `personalAdministrativo`, `presenciaEstudiantil`, `tipoPoblacion`, `tipoPoblacionPersonalAcademico`, `tipoPoblacionEstudiantes`, `instalacionesDensidadOcupacion`, `instalacionesAreaConstruccion`, `instalacionesInstalaciones`, `instalacionesCaracteristicasZona`, `instalacionesTopografia`, `instalacionesNivelTerreno`, `instalacionesColindates`, `elementosConstructivosTipoConstruccion`, `elementosConstructivosAntiguedad`, `elementosConstructivosCimientos`, `elementosConstructivosEstructura`, `elementosConstructivosParedes`, `elementosConstructivosEntrepiso`, `elementosConstructivosTecho`, `elementosConstructivosCielos`, `elementosConstructivosPisos`, `elementosConstructivosAreaParqueo`, `elementosConstructivosSistemaAguaPotable`, `elementosConstructivosAlcantarilladoSanitario`, `elementosConstructivosAlcantarilladoPluvial`, `elementosConstructivosSistemaElectrico`, `elementosConstructivosSistemaTelefonico`, `elementosConstructivosOtros`) VALUES ( 'Limon', 'Fran', 'Fran', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1');
INSERT INTO `BDSIGPE`.`ZonaTrabajo` ( `nombreZonaTrabajo`, `revisadoPor`, `codigoZonaTrabajo`, `actividad`, `direcion`, `personaContactoGeneral`, `numeroTelefono`, `numeroFax`, `notificaciones`, `categoriNFPA`, `usoInstalaciones`, `horarioJornada`, `seguridadInstitucional`, `servicioConsegeria`, `personalAdministrativo`, `presenciaEstudiantil`, `tipoPoblacion`, `tipoPoblacionPersonalAcademico`, `tipoPoblacionEstudiantes`, `instalacionesDensidadOcupacion`, `instalacionesAreaConstruccion`, `instalacionesInstalaciones`, `instalacionesCaracteristicasZona`, `instalacionesTopografia`, `instalacionesNivelTerreno`, `instalacionesColindates`, `elementosConstructivosTipoConstruccion`, `elementosConstructivosAntiguedad`, `elementosConstructivosCimientos`, `elementosConstructivosEstructura`, `elementosConstructivosParedes`, `elementosConstructivosEntrepiso`, `elementosConstructivosTecho`, `elementosConstructivosCielos`, `elementosConstructivosPisos`, `elementosConstructivosAreaParqueo`, `elementosConstructivosSistemaAguaPotable`, `elementosConstructivosAlcantarilladoSanitario`, `elementosConstructivosAlcantarilladoPluvial`, `elementosConstructivosSistemaElectrico`, `elementosConstructivosSistemaTelefonico`, `elementosConstructivosOtros`) VALUES ( 'Limon', 'Fran', 'Fran', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1');

INSERT INTO `BDSIGPE`.`OrigenAmenaza` (`descripcion`) VALUES ('Natural');
INSERT INTO `BDSIGPE`.`OrigenAmenaza` (`descripcion`) VALUES ('Sub-Natural');
INSERT INTO `BDSIGPE`.`OrigenAmenaza` (`descripcion`) VALUES ('Antropica');


