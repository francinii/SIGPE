/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  factoria
 * Created: 26/07/2018
 */

drop table TipoPoblacion;
drop table CapituloPlan;
drop table SubCapituloPlan;
drop table Formulario;
drop table SubCapitulo;
drop table Capitulo;
drop table Matriz;
drop table CategoriaTipoAmenaza;
drop table TipoAmenaza;
drop table OrigenAmenaza;
drop table  RecursoHumanos;
drop table  EquipoMovil;
drop table  RecursoIntalaciones;
drop table  InventarioOtros;
drop table  CuerposScorro;
drop table  ZonaSeguridad;
drop table  IdentificacionPeligro;
drop table  PlanAccion;
drop table  FormularioPoblacion;
drop table  RutaEvacuacion;
drop table  Brigada;
drop table IngresoCuerpoSocorro;
drop table  PlanEmergencia;
drop table  UsuarioZona;
drop table  ZonaTrabajo;
drop table  Sede;

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
version int, 
revisadoPor varchar(150),
codigoZonaTrabajo varchar(150),
actividad varchar(150),
direccion varchar(150),
personaContactoGeneral varchar(150),
numeroTelefono varchar(150),
numeroFax varchar(150),
correo varchar(150),
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
    fuente text,
    probabilidad int,
    gravedad int,
    consecuenciaAmenaza int,
    PRIMARY KEY(id), 
    FOREIGN KEY(FKidCategoriaTipoAmenaza) REFERENCES CategoriaTipoAmenaza(id),
    FOREIGN KEY(FKidPlanEmergencias) REFERENCES PlanEmergencia(id)
)ENGINE=InnoDB;




create table Capitulo(
id int NOT NULL AUTO_INCREMENT,
descripcion text,
isActivo int,
titulo varchar(150),
orden int,
 PRIMARY KEY(id) 
)ENGINE=InnoDB;

create table SubCapitulo(
id int NOT NULL AUTO_INCREMENT,
descripcion text,
titulo varchar(150),
isActivo int,
FKidCapitulo int,
orden int,
PRIMARY KEY(id),
FOREIGN KEY (FKidCapitulo) REFERENCES Capitulo(id)
)ENGINE=InnoDB;

create table Formulario(
id int NOT NULL AUTO_INCREMENT,
descripcion text,
FKidSubcapitulos int,
PRIMARY KEY(id),
FOREIGN KEY (FKidSubcapitulos) REFERENCES SubCapitulo(id)
)ENGINE=InnoDB;


create table CapituloPlan(
    FKidCapitulo int NOT NULL,
    FKidPlanEmergencias int NOT NULL,
descripcion text,
    FOREIGN KEY (FKidCapitulo) REFERENCES Capitulo(id),
    FOREIGN KEY(FKidPlanEmergencias) REFERENCES PlanEmergencia(id)

) ENGINE=InnoDB;

create table SubCapituloPlan(
    FKidSubCapitulo int NOT NULL,
    FKidPlanEmergencias int NOT NULL,
    descripcion text,
    FOREIGN KEY (FKidSubCapitulo) REFERENCES SubCapitulo(id),
    FOREIGN KEY(FKidPlanEmergencias) REFERENCES PlanEmergencia(id)
) ENGINE=InnoDB;

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
capacidad int,
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

create table InventarioOtros(
id int NOT NULL AUTO_INCREMENT,
FKidPlanEmergencias int,
cantidad int,
tipo varchar(150),
caracteristicas text,
contacto varchar(150),
ubicacion varchar(150),
categoria varchar(150),
observaciones text,
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

create table IngresoCuerpoSocorro(
    id int NOT NULL AUTO_INCREMENT,
    dimensionAreaAcceso varchar(150),
    FKidPlanEmergencias int,
    radioGiro varchar(150),
    caseta varchar(150),
    plumas varchar(150),
    anchoLibre varchar(150),
   PRIMARY KEY(id),
FOREIGN KEY(FKidPlanEmergencias) REFERENCES PlanEmergencia(id) 
)ENGINE=InnoDB;
-- faltan 3 tablas increso cuerpo de socorro y  las rutas de evacuacion

create table Brigada(
    id int NOT NULL AUTO_INCREMENT, 
    FKidPlanEmergencias int,
    brigadista varchar(150),
    puntoPartida varchar(150),
    zonaEvacuar varchar(150),
    numPersonasEvacuar int,    
    distancia float,
    tiempo int,
    PRIMARY KEY(id),
    FOREIGN KEY(FKidPlanEmergencias) REFERENCES PlanEmergencia(id) 
) ENGINE=InnoDB;
 
 
create table RutaEvacuacion(
    id int NOT NULL AUTO_INCREMENT, 
    FKidPlanEmergencias int,
    nombreArea varchar(150),
    personaPermanente varchar(150),
    personaFlotante varchar(150),
    ruta1 varchar(150),
    distancia1 float,
    tiempo1 int,
    ruta2 varchar(150),
    distancia2 float,
    tiempo2 int,
    PRIMARY KEY(id),
    FOREIGN KEY(FKidPlanEmergencias) REFERENCES PlanEmergencia(id) 
) ENGINE=InnoDB;


create table ZonaSeguridad(
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

create table FormularioPoblacion(
    id int NOT NULL AUTO_INCREMENT,
    FKidPlanEmergencias int,
    nombreOficina varchar(150),
    capacidadPermanente int, 
    capacidadTemporal int,
    representanteComite varchar(150),
    representanteBrigadaEfectiva varchar(150),
    representantePrimerosAuxilios varchar(150),
    telefonoOficina varchar(150),
    contactoEmergencia varchar(150),
    telefonoPersonal varchar(150),
    correoElectronico varchar (150),
    sector varchar(150),
    PRIMARY KEY(id),
    FOREIGN KEY(FKidPlanEmergencias) REFERENCES PlanEmergencia(id)
)ENGINE=InnoDB;

create table IdentificacionPeligro(
    id int NOT NULL AUTO_INCREMENT,
    FKidPlanEmergencias int,
    peligro varchar(150),
    presente int,
    ubicacion varchar(150),
    recomendacion varchar(150),
    fecha date,
    responsable varchar(150),
    priorizacion int,
    PRIMARY KEY(id),
    FOREIGN KEY(FKidPlanEmergencias) REFERENCES PlanEmergencia(id)
)ENGINE=InnoDB;

create table PlanAccion(
    id int NOT NULL AUTO_INCREMENT,
    FKidPlanEmergencias int,
    area varchar(150),
    peligro varchar(150),
    accionPorRealizar varchar(150),
    recomendaciones varchar(150),
    fechaEjecucion date,
    responsable varchar(150),
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


INSERT INTO `SubCapitulo` (`descripcion`,`titulo`,`isActivo`,`FKidCapitulo`,`orden`) VALUES ('<p style=\"text-align:justify\">Es la condición o resultado cuantificable que debe ser alcanzado y mantenido, con la aplicación del procedimiento y que refleja el valor o beneficio que obtiene el usuario. El propósito debe redactarse en forma breve y concisa; especificará los resultados o condiciones que se desean lograr, iniciará con un verbo en infinitivo y, en lo posible, se evitará utilizar gerundios y adjetivos calificativos. <u><strong>El propósito debe quedar escrito en prosa, únicamente para la redacción de este se facilita la siguiente tabla, que no deberá incorporarse en el manual respectivo:</strong></u></p><table align=\"center\" border=\"1\" cellpadding=\"1\" cellspacing=\"1\" style=\"width:500px\"><tbody><tr><td colspan=\"1\" rowspan=\"2\" style=\"text-align:center\"><strong>Qué se hace</strong></td><td colspan=\"1\" rowspan=\"2\" style=\"text-align:center\"><strong>En qué función o campo de especialidad se hace</strong></td><td colspan=\"2\" rowspan=\"1\" style=\"text-align:center\"><strong>Justificación Razón de ser</strong></td></tr><tr><td style=\"text-align:center\"><strong>Para qué se hace</strong></td><td style=\"text-align:center\"><strong>Para quién se hace</strong></td></tr><tr><td style=\"text-align:center\">Acción<br />expresada en<br />verbo</td><td style=\"text-align:center\">Campo de especialidad<br />principal</td><td style=\"text-align:center\">Resultado</td><td style=\"text-align:center\">Usuario final</td></tr></tbody></table><p>','Propósito',1,1,1);
INSERT INTO `SubCapitulo` (`descripcion`,`titulo`,`isActivo`,`FKidCapitulo`,`orden`) VALUES ('<p style=\"text-align:justify\">En este apartado se describe brevemente el área o campo de aplicación del procedimiento; es decir, a quiénes afecta o qué límites o influencia tiene, representa la esfera de acción que cubren los procedimientos.</p>','Alcance',1,1,2);
INSERT INTO `SubCapitulo` (`descripcion`,`titulo`,`isActivo`,`FKidCapitulo`,`orden`) VALUES ('<p>Aquí se registra el compendio de normas aplicables al procedimiento, conforme a la secuencia lógica de las etapas del mismo. Es decir aquellas disposiciones internas que:</p><p style=\"margin-left:40px\">a) Tienen como propósito regular la interacción entre los individuos en una organización y las actividades de una unidad responsable.<br />b) Marcan responsabilidades y límites generales y específicos, dentro de los cuales se realizan legítimamente las actividades en distintas áreas de acción.<br />c) Se aplican a todas las situaciones similares.<br />d) Dan orientaciones claras hacia donde deben dirigirse todas las actividades de un mismo tipo.<br />e) Facilitan la toma de decisiones en actividades rutinarias.<br />f) Describen lo que la dirección desea que se haga en cada situación definida.</p>','Marco normativo',1,1,3);
INSERT INTO `SubCapitulo` (`descripcion`,`titulo`,`isActivo`,`FKidCapitulo`,`orden`) VALUES ('<p style=\"margin-left:40px\"><strong>a) Secuencia de etapas</strong></p><p style=\"margin-left:80px\">i. Son las partes en que se divide el procedimiento, y cada una de ellas integra<br />un conjunto afín de actividades.<br />ii. La redacción de la etapa, iniciará con un verbo conjugado en el tiempo<br />presente de la tercera persona del singular.</p><p style=\"margin-left:40px\"><strong>b) Descripción de las actividades</strong></p><p style=\"margin-left:80px\">i. Es la descripción detallada de las actividades; de manera tal que permita al<br />personal comprenderlas, seguirlas y aplicarlas, aun cuando sea de recién<br />ingreso al área.<br />ii. El número con que se registrará cada actividad, estará compuesto por el dígito<br />de la etapa correspondiente, seguido de un punto, y a la derecha de éste, del<br />número consecutivo respectivo.<br />iii. La redacción de la actividad, iniciará con un verbo conjugado en el tiempo<br />presente de la tercera persona del singular.<br />iv. Deberá considerarse en la redacción de las actividades, los elementos<br />necesarios para su realización; así como los productos que se generen.</p><p style=\"margin-left:40px\"><strong>c) Responsable</strong></p><p style=\"margin-left:80px\">i. Se refiere a los órganos o cargos de la estructura autorizada responsables de<br />la ejecución y cumplimiento de las actividades del procedimiento.<br />ii. En el caso del personal operativo habrá de señalarse el nombre del puesto por<br />funciones reales desempeñadas: analista, secretaria, mensajero, etcétera; y<br />no por el nombre de la plaza: coordinador de técnicos, secretaria ejecutiva,<br />entre otros.</p><p><strong>En la descripción se utilizará la siguiente forma:</strong></p><p>','Descripción del plan',1,1,4);
INSERT INTO `SubCapitulo` (`descripcion`,`titulo`,`isActivo`,`FKidCapitulo`,`orden`) VALUES ('descripcion','Documentos de referencia',1,1,5);
INSERT INTO `SubCapitulo` (`descripcion`,`titulo`,`isActivo`,`FKidCapitulo`,`orden`) VALUES ('','Datos Generales y actividades que desarrolla la organización',1,2,1);

INSERT INTO `Formulario`(`id`,`descripcion`, `FKidSubCapitulos`) VALUES (1,'Datos generales',1);
INSERT INTO `Formulario`(`id`,`descripcion`, `FKidSubCapitulos`) VALUES (2,'Población actividades',1);
INSERT INTO `Formulario`(`id`,`descripcion`, `FKidSubcapitulos`) VALUES (3,'Instalaciones',1);
INSERT INTO `Formulario`(`id`,`descripcion`, `FKidSubcapitulos`) VALUES (4,'Matriz de riesgo',1);
INSERT INTO `Formulario`(`id`,`descripcion`, `FKidSubcapitulos`) VALUES (5,'Inventario',1);
INSERT INTO `Formulario`(`id`,`descripcion`, `FKidSubcapitulos`) VALUES (6,'Identificacion de peligros',1);
INSERT INTO `Formulario`(`id`,`descripcion`, `FKidSubcapitulos`) VALUES (7,'Poblacion',1);

INSERT INTO `UsuarioZona`(`FKidUsuario`, `FKidZona`) VALUES ('402340420',1);
INSERT INTO `UsuarioZona`(`FKidUsuario`, `FKidZona`) VALUES ('402340420',2);
INSERT INTO `UsuarioZona`(`FKidUsuario`, `FKidZona`) VALUES ('402340420',5);

insert into `PlanEmergencia`(`FKidZonaTrabajo`) VALUES (1);









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
DROP PROCEDURE IF EXISTS `update_datos_generales`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_datos_generales`(IN `p_id` int, IN `p_actividad` varchar(150),
 IN `p_direccion` varchar(150), IN `p_personaContactoGeneral` varchar(150),IN `p_numeroTelefono` varchar(150),
 IN `p_numeroFax` varchar(150),IN `p_correo` varchar(150),
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
         `numeroTelefono`=p_numeroTelefono,`numeroFax`= p_numeroFax,`correo`=p_correo,`categoriaNFPA`=p_categoriaNFPA,`usoInstalaciones`=p_usoInstalaciones,`horarioJornada`=p_horarioJornada,
         `seguridadInstitucional`=p_seguridadInstitucional,`servicioConsegeria`=p_servicioConsegeria,`personalAdministrativo`=p_personalAdministrativo,`personalAcademico`=p_personalAcademico,
           `presenciaEstudiantil` = p_presenciaEstudiantil   where `id`=p_id;   

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
DROP PROCEDURE IF EXISTS `update_tipo_poblacion`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_tipo_poblacion`(IN `p_FKidPlanEmergencias` int, IN `p_tipoPoblacion` varchar(150),
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


-- ----------------------------
-- Proceso IdentificacionPeligro actividades
-- ----------------------------
DROP PROCEDURE IF EXISTS `insert_identificacion_peligro`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_identificacion_peligro`(IN `p_FKidPlanEmergencias` int,IN `p_id` int,  IN `p_peligro` varchar(150),
 IN `p_presente` int, IN `p_ubicacion` varchar(150), IN `p_recomendacion` varchar(150) ,IN `p_fecha` date, IN `p_responsable` varchar(150),  IN `p_priorizacion` int,
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

      set existe = 0;
      select count(`FKidPlanEmergencias`) into existe from IdentificacionPeligro WHERE  `FKidPlanEmergencias`=p_FKidPlanEmergencias and `id` = p_id ;
         IF(existe = 1) THEN
         START TRANSACTION;
         UPDATE `IdentificacionPeligro` SET `peligro`= p_peligro,`presente`=p_presente,`ubicacion`=p_ubicacion,`recomendacion`=p_recomendacion,`fecha`=p_fecha,`responsable`=p_responsable,`priorizacion`=p_priorizacion  WHERE `FKidPlanEmergencias`=p_FKidPlanEmergencias and `id`=p_id;  
        COMMIT;
        -- SUCCESS       
     ELSE
        START TRANSACTION;       
       INSERT INTO `IdentificacionPeligro`( `FKidPlanEmergencias`, `peligro`, `presente`, `ubicacion`, `recomendacion`, `fecha`, `responsable`, `priorizacion`)
       VALUES (p_FKidPlanEmergencias,p_peligro,p_presente,p_ubicacion,p_recomendacion,p_fecha,p_responsable,p_priorizacion);
         
        COMMIT;
        -- SUCCESS         
   END IF;
         SET res = 0;
END
;;
DELIMITER ;
-- call insert_identificacion_peligro(5,1,'1',1,'Heredia','hacer las cosas mejor','2003-05-21','Francini',1,@res);
-- call tipo_poblacion(1,'1','1',1,'1',@res);

-- ----------------------------
-- Proceso datos generales
-- ----------------------------
DROP PROCEDURE IF EXISTS `update_datos_Instalaciones`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_datos_Instalaciones`(
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

-- ----------------------------
-- Proceso insertar y actualizar EquiposMovil
-- ----------------------------
DROP PROCEDURE IF EXISTS `insert_equipoMovil`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_equipoMovil`(IN `p_FKidPlanEmergencias` int,IN `p_cantidad` int,
IN `p_capacidad` int, IN `p_tipo` varchar(150),
IN `p_caracteristicas` varchar(150), IN `p_contacto` varchar(150),
IN `p_ubicacion` varchar(150),IN `p_categoria` varchar(150),
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
       INSERT INTO `equipomovil`( `FKidPlanEmergencias`, `cantidad`, `capacidad`, `tipo`, `caracteristicas`, `contacto`, `ubicacion`, `categoria`)
        VALUES (p_FKidPlanEmergencias,p_cantidad,p_capacidad,p_tipo,p_caracteristicas,p_contacto,p_ubicacion,p_categoria);
         
        COMMIT;
        -- SUCCESS         

         SET res = 0;
END
;;
DELIMITER ;

-- ----------------------------
-- Proceso eliminar EquiposMovil
-- ----------------------------
DROP PROCEDURE IF EXISTS `delete_equipoMovil`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_equipoMovil`(IN `p_FKidPlanEmergencias` int,OUT `res` TINYINT  UNSIGNED)
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
       DELETE FROM `equipomovil` WHERE `FKidPlanEmergencias`=p_FKidPlanEmergencias;
         
        COMMIT;
        -- SUCCESS         

         SET res = 0;
END
;;
DELIMITER ;




-- ----------------------------
-- Proceso insertar y actualizar EquiposMovil
-- ----------------------------
DROP PROCEDURE IF EXISTS `insert_RecursoHumano`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_RecursoHumano`(IN `p_FKidPlanEmergencias` int,IN `p_cantidad` int,
IN `p_profesion` varchar(150),IN `p_categorias` varchar(150),
IN `p_localizacion` varchar(150),IN `p_contacto` varchar(150),
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
        INSERT INTO `recursohumanos`( `FKidPlanEmergencias`, `cantidad`, `profesion`, `categorias`, `localizacion`, `contacto`) 
        VALUES (p_FKidPlanEmergencias,p_cantidad,p_profesion,p_categorias,p_localizacion,p_contacto);
         
        COMMIT;
        -- SUCCESS         

         SET res = 0;
END
;;
DELIMITER ;

-- ----------------------------
-- Proceso eliminar EquiposMovil
-- ----------------------------
DROP PROCEDURE IF EXISTS `delete_RecursoHumano`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_RecursoHumano`(IN `p_FKidPlanEmergencias` int,OUT `res` TINYINT  UNSIGNED)
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
       DELETE FROM `RecursoHumanos` WHERE `FKidPlanEmergencias`=p_FKidPlanEmergencias;
         
        COMMIT;
        -- SUCCESS         

         SET res = 0;
END
;;
DELIMITER ;


-- ----------------------------
-- Proceso insertar recursos instalaciones
-- ----------------------------

DROP PROCEDURE IF EXISTS `insert_RecursoInstalaciones`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_RecursoInstalaciones`(IN `p_FKidPlanEmergencias` int,IN `p_tipo` varchar(150),
IN `p_cantidad` int,IN `p_tamaño` varchar(150),
IN `p_distribucion` varchar(150),IN `p_contacto` varchar(150),
IN `p_ubicacion` varchar(150),OUT `res` TINYINT  UNSIGNED)
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
        INSERT INTO `RecursoIntalaciones`( `FKidPlanEmergencias`, `tipo`, `cantidad`, `tamaño`, `distribucion`, `contacto`, `ubicacion`) 
        VALUES (p_FKidPlanEmergencias,p_tipo,p_cantidad,p_tamaño,p_distribucion,p_contacto,p_ubicacion);

        COMMIT;
        -- SUCCESS         

         SET res = 0;
END
;;
DELIMITER ;
-- ----------------------------
-- Proceso eliminar recursos instalaciones
-- ----------------------------

DROP PROCEDURE IF EXISTS `delete_RecursoInstalaciones`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_RecursoInstalaciones`(IN `p_FKidPlanEmergencias` int,OUT `res` TINYINT  UNSIGNED)
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
       DELETE FROM `RecursoIntalaciones` WHERE `FKidPlanEmergencias`=p_FKidPlanEmergencias;
         
        COMMIT;
        -- SUCCESS         

         SET res = 0;
END
;;
DELIMITER ;
-- ----------------------------
-- Proceso insertar otros recursos 
-- ----------------------------
DROP PROCEDURE IF EXISTS `insert_InventarioOtros`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_InventarioOtros`(IN `p_FKidPlanEmergencias` int,IN `p_cantidad` int,
IN `p_tipo` varchar(150),IN `p_caracteristicas` text,
IN `p_contacto` varchar(150),IN `p_ubicacion` varchar(150),
IN `p_categoria` varchar(150),IN `p_observaciones` text,OUT `res` TINYINT  UNSIGNED)
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
        INSERT INTO `InventarioOtros`(`FKidPlanEmergencias`, `cantidad`, `tipo`, `caracteristicas`, `contacto`, `ubicacion`, `categoria`,`observaciones`)
        VALUES (p_FKidPlanEmergencias,p_cantidad,p_tipo,p_caracteristicas,p_contacto,p_ubicacion,p_categoria,p_observaciones);

        COMMIT;
        -- SUCCESS         

         SET res = 0;
END
;;
DELIMITER ;

-- ----------------------------
-- Proceso eliminar otros recursos 
-- ----------------------------
DROP PROCEDURE IF EXISTS `delete_InventarioOtros`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_InventarioOtros`(IN `p_FKidPlanEmergencias` int,IN `p_categoria` varchar(150),OUT `res` TINYINT  UNSIGNED)
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
       DELETE FROM `InventarioOtros` WHERE `FKidPlanEmergencias`=p_FKidPlanEmergencias and `categoria`=p_categoria;
         
        COMMIT;
        -- SUCCESS         

         SET res = 0;
END
;;
DELIMITER ;
-- call delete_recursosOtros(5,'telecomunicaciones');


-- ----------------------------
-- Proceso insertar otros recursos 
-- ----------------------------
DROP PROCEDURE IF EXISTS `insert_formularioPoblacion`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_formularioPoblacion`(IN p_FKidPlanEmergencias int ,IN p_nombreOficina varchar(150),
IN p_capacidadPermanente int,IN p_capacidadTemporal int ,IN p_representanteComite varchar(150),IN p_representanteBrigadaEfectiva varchar(150),
   IN p_representantePrimerosAuxilios varchar(150) ,IN p_telefonoOficina varchar(150),IN p_contactoEmergencia varchar(150) ,
IN p_telefonoPersonal varchar(150),IN p_correoElectronico varchar(150),IN sector varchar(150),OUT `res` TINYINT  UNSIGNED)
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
        INSERT INTO `formulariopoblacion`(`FKidPlanEmergencias`, `nombreOficina`, `capacidadPermanente`, `capacidadTemporal`, `representanteComite`,
     `representanteBrigadaEfectiva`, `representantePrimerosAuxilios`, `telefonoOficina`, `contactoEmergencia`, `telefonoPersonal`, `correoElectronico`, `sector`) 
        VALUES (p_FKidPlanEmergencias,p_nombreOficina,p_capacidadPermanente,p_capacidadTemporal,p_representanteComite,p_representanteBrigadaEfectiva,p_representantePrimerosAuxilios
      ,p_telefonoOficina,p_contactoEmergencia,p_telefonoPersonal,p_correoElectronico,sector);

        COMMIT;
        -- SUCCESS         

         SET res = 0;
END
;;
DELIMITER ;

-- ----------------------------
-- Proceso eliminar otros recursos 
-- ----------------------------
DROP PROCEDURE IF EXISTS `delete_formularioPoblacion`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_formularioPoblacion`(IN `p_FKidPlanEmergencias` int,OUT `res` TINYINT  UNSIGNED)
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
       DELETE FROM `FormularioPoblacion` WHERE `FKidPlanEmergencias`=p_FKidPlanEmergencias;
         
        COMMIT;
        -- SUCCESS         

         SET res = 0;
END
;;
DELIMITER ;