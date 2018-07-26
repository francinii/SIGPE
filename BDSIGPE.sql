/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  factoria
 * Created: 26/07/2018
 */

create table InformacionFija (
    idInformacionFija int NOT NULL AUTO_INCREMENT,  
    descripcion text,
    titulo varchar(150),
    PRIMARY KEY(idInformacionFija)   
);
create table ZonaTrabajo(
id int  NOT NULL AUTO_INCREMENT,
FKIdInformacionFija int,
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
PRIMARY KEY(id),
FOREIGN KEY (FKIdInformacionFija) REFERENCES InformacionFija(idInformacionFija)
);
create table TipoAmenaza (
    idTipoAmenaza int NOT NULL AUTO_INCREMENT,  
    descripcion varchar(150),
    PRIMARY KEY(idTipoAmenaza)
);


create table CategoriaTipoAmenaza (
    idCategoriaTipoAmenaza int NOT NULL AUTO_INCREMENT,  
    FKidTipoAmenaza int,
    descripcion varchar(150),
    PRIMARY KEY(idCategoriaTipoAmenaza), 
    FOREIGN KEY(FKidTipoAmenaza) REFERENCES TipoAmenaza(idTipoAmenaza)
);

create table SubCategoriaTipoAmenaza (
    idSubCategoriaTipoAmenaza int NOT NULL AUTO_INCREMENT,  
    FKidCategoriaTipoAmenaza int,
    descripcion varchar(150),
    PRIMARY KEY(idSubCategoriaTipoAmenaza), 
    FOREIGN KEY(FKidCategoriaTipoAmenaza) REFERENCES CategoriaTipoAmenaza(idCategoriaTipoAmenaza)
);


create table MatrizRiesgos (
    idMatrizRiesgos int NOT NULL AUTO_INCREMENT,  
    FKsubCategoriaTipoAmenaza int,
    FKzonaTrabajo int,
    descripcion varchar(150),
    fuente varchar(150),
    probabilidad int,
    gravedad int,
    consecuenciaAmenaza int,
    PRIMARY KEY(idMatrizRiesgos), 
    FOREIGN KEY(FKsubCategoriaTipoAmenaza) REFERENCES SubCategoriaTipoAmenaza(idSubCategoriaTipoAmenaza),
    FOREIGN KEY (FKzonaTrabajo) REFERENCES ZonaTrabajo(id)
);






drop table MatrizRiesgos;
drop table SubCategoriaTipoAmenaza;
drop table CategoriaTipoAmenaza;
drop table TipoAmenaza;
drop table ZonaTrabajo;
drop table InformacionFija;