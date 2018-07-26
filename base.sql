/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50722
Source Host           : localhost:3306
Source Database       : base

Target Server Type    : MYSQL
Target Server Version : 50722
File Encoding         : 65001

Date: 2018-07-26 15:39:12
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for sis_canton
-- ----------------------------
DROP TABLE IF EXISTS `sis_canton`;
CREATE TABLE `sis_canton` (
  `id_prov` varchar(1) NOT NULL DEFAULT '',
  `id_cant` varchar(2) NOT NULL DEFAULT '',
  `desc_cant` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_cant`,`id_prov`),
  KEY `fk_id_prov` (`id_prov`),
  KEY `id_cant` (`id_cant`),
  CONSTRAINT `fk_id_prov` FOREIGN KEY (`id_prov`) REFERENCES `sis_provincia` (`id_prov`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sis_canton
-- ----------------------------
INSERT INTO `sis_canton` VALUES ('1', '01', 'San Jose');
INSERT INTO `sis_canton` VALUES ('2', '01', 'Alajuela');
INSERT INTO `sis_canton` VALUES ('3', '01', 'Cartago');
INSERT INTO `sis_canton` VALUES ('4', '01', 'Heredia');
INSERT INTO `sis_canton` VALUES ('5', '01', 'Liberia');
INSERT INTO `sis_canton` VALUES ('6', '01', 'Puntarenas');
INSERT INTO `sis_canton` VALUES ('7', '01', 'Limon');
INSERT INTO `sis_canton` VALUES ('1', '02', 'Escazu');
INSERT INTO `sis_canton` VALUES ('2', '02', 'San Ramon');
INSERT INTO `sis_canton` VALUES ('3', '02', 'Paraiso');
INSERT INTO `sis_canton` VALUES ('4', '02', 'Barva');
INSERT INTO `sis_canton` VALUES ('5', '02', 'Nicoya');
INSERT INTO `sis_canton` VALUES ('6', '02', 'Esparza');
INSERT INTO `sis_canton` VALUES ('7', '02', 'Pococí');
INSERT INTO `sis_canton` VALUES ('1', '03', 'Desamparados');
INSERT INTO `sis_canton` VALUES ('2', '03', 'Grecia');
INSERT INTO `sis_canton` VALUES ('3', '03', 'La Union');
INSERT INTO `sis_canton` VALUES ('4', '03', 'Santo Domingo');
INSERT INTO `sis_canton` VALUES ('5', '03', 'Santa Cruz');
INSERT INTO `sis_canton` VALUES ('6', '03', 'Buenos Aires');
INSERT INTO `sis_canton` VALUES ('7', '03', 'Siquirres');
INSERT INTO `sis_canton` VALUES ('1', '04', 'Puriscal');
INSERT INTO `sis_canton` VALUES ('2', '04', 'San Mateo');
INSERT INTO `sis_canton` VALUES ('3', '04', 'Jimenez');
INSERT INTO `sis_canton` VALUES ('4', '04', 'Santa Barbara');
INSERT INTO `sis_canton` VALUES ('5', '04', 'Bagaces');
INSERT INTO `sis_canton` VALUES ('6', '04', 'Montes de Oro');
INSERT INTO `sis_canton` VALUES ('7', '04', 'Talamanca');
INSERT INTO `sis_canton` VALUES ('1', '05', 'Tarrazu');
INSERT INTO `sis_canton` VALUES ('2', '05', 'Atenas');
INSERT INTO `sis_canton` VALUES ('3', '05', 'Turrialba');
INSERT INTO `sis_canton` VALUES ('4', '05', 'San Rafael');
INSERT INTO `sis_canton` VALUES ('5', '05', 'Carrillo');
INSERT INTO `sis_canton` VALUES ('6', '05', 'Osa');
INSERT INTO `sis_canton` VALUES ('7', '05', 'Matina');
INSERT INTO `sis_canton` VALUES ('1', '06', 'Aserri');
INSERT INTO `sis_canton` VALUES ('2', '06', 'Naranjo');
INSERT INTO `sis_canton` VALUES ('3', '06', 'Alvarado');
INSERT INTO `sis_canton` VALUES ('4', '06', 'San Isidro');
INSERT INTO `sis_canton` VALUES ('5', '06', 'Cañas');
INSERT INTO `sis_canton` VALUES ('6', '06', 'Aguirre');
INSERT INTO `sis_canton` VALUES ('7', '06', 'Guacimo');
INSERT INTO `sis_canton` VALUES ('1', '07', 'Mora');
INSERT INTO `sis_canton` VALUES ('2', '07', 'Palmares');
INSERT INTO `sis_canton` VALUES ('3', '07', 'Oreamuno');
INSERT INTO `sis_canton` VALUES ('4', '07', 'Belen');
INSERT INTO `sis_canton` VALUES ('5', '07', 'Abangares');
INSERT INTO `sis_canton` VALUES ('6', '07', 'Golfito');
INSERT INTO `sis_canton` VALUES ('1', '08', 'Goicoechea');
INSERT INTO `sis_canton` VALUES ('2', '08', 'Poas');
INSERT INTO `sis_canton` VALUES ('3', '08', 'El Guarco');
INSERT INTO `sis_canton` VALUES ('4', '08', 'Flores');
INSERT INTO `sis_canton` VALUES ('5', '08', 'Tilaran');
INSERT INTO `sis_canton` VALUES ('6', '08', 'Coto Brus');
INSERT INTO `sis_canton` VALUES ('1', '09', 'Santa Ana');
INSERT INTO `sis_canton` VALUES ('2', '09', 'Orotina');
INSERT INTO `sis_canton` VALUES ('4', '09', 'San Pablo');
INSERT INTO `sis_canton` VALUES ('5', '09', 'Nandayure');
INSERT INTO `sis_canton` VALUES ('6', '09', 'Parrita');
INSERT INTO `sis_canton` VALUES ('1', '10', 'Alajuelita');
INSERT INTO `sis_canton` VALUES ('2', '10', 'San Carlos');
INSERT INTO `sis_canton` VALUES ('4', '10', 'Sarapiqui');
INSERT INTO `sis_canton` VALUES ('5', '10', 'La Cruz');
INSERT INTO `sis_canton` VALUES ('6', '10', 'Corredores');
INSERT INTO `sis_canton` VALUES ('1', '11', 'Vazquez de Coronado');
INSERT INTO `sis_canton` VALUES ('2', '11', 'Alfaro Ruiz');
INSERT INTO `sis_canton` VALUES ('5', '11', 'Hojancha');
INSERT INTO `sis_canton` VALUES ('6', '11', 'Garabito');
INSERT INTO `sis_canton` VALUES ('1', '12', 'Acosta');
INSERT INTO `sis_canton` VALUES ('2', '12', 'Valverde Vega');
INSERT INTO `sis_canton` VALUES ('1', '13', 'Tibas');
INSERT INTO `sis_canton` VALUES ('2', '13', 'Upala');
INSERT INTO `sis_canton` VALUES ('1', '14', 'Moravia');
INSERT INTO `sis_canton` VALUES ('2', '14', 'Los Chiles');
INSERT INTO `sis_canton` VALUES ('1', '15', 'Montes de Oca');
INSERT INTO `sis_canton` VALUES ('2', '15', 'Guatuso');
INSERT INTO `sis_canton` VALUES ('1', '16', 'Turrubares');
INSERT INTO `sis_canton` VALUES ('1', '17', 'Dota');
INSERT INTO `sis_canton` VALUES ('1', '18', 'Curridabat');
INSERT INTO `sis_canton` VALUES ('1', '19', 'Perez Zeledon');
INSERT INTO `sis_canton` VALUES ('1', '20', 'Leon Cortes');

-- ----------------------------
-- Table structure for sis_distrito
-- ----------------------------
DROP TABLE IF EXISTS `sis_distrito`;
CREATE TABLE `sis_distrito` (
  `id_prov` varchar(1) NOT NULL DEFAULT '',
  `id_cant` varchar(2) NOT NULL DEFAULT '',
  `id_dist` varchar(2) NOT NULL DEFAULT '',
  `desc_dist` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_prov`,`id_cant`,`id_dist`),
  KEY `fk_id_cant` (`id_cant`),
  CONSTRAINT `fk_id_cant` FOREIGN KEY (`id_cant`) REFERENCES `sis_canton` (`id_cant`),
  CONSTRAINT `fk_id_prov_cant` FOREIGN KEY (`id_prov`) REFERENCES `sis_canton` (`id_prov`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sis_distrito
-- ----------------------------
INSERT INTO `sis_distrito` VALUES ('1', '01', '01', 'Carmen');
INSERT INTO `sis_distrito` VALUES ('1', '01', '02', 'Merced');
INSERT INTO `sis_distrito` VALUES ('1', '01', '03', 'Hospital');
INSERT INTO `sis_distrito` VALUES ('1', '01', '04', 'Catedral');
INSERT INTO `sis_distrito` VALUES ('1', '01', '05', 'Zapote');
INSERT INTO `sis_distrito` VALUES ('1', '01', '06', 'San Francisco de Dos Rios');
INSERT INTO `sis_distrito` VALUES ('1', '01', '07', 'Uruca');
INSERT INTO `sis_distrito` VALUES ('1', '01', '08', 'Mata Redonda');
INSERT INTO `sis_distrito` VALUES ('1', '01', '09', 'Pavas');
INSERT INTO `sis_distrito` VALUES ('1', '01', '10', 'Hatillo');
INSERT INTO `sis_distrito` VALUES ('1', '01', '11', 'San Sebastian');
INSERT INTO `sis_distrito` VALUES ('1', '02', '01', 'Escazu');
INSERT INTO `sis_distrito` VALUES ('1', '02', '02', 'San Antonio');
INSERT INTO `sis_distrito` VALUES ('1', '02', '03', 'San Rafael');
INSERT INTO `sis_distrito` VALUES ('1', '03', '01', 'Desamparados');
INSERT INTO `sis_distrito` VALUES ('1', '03', '02', 'San Miguel');
INSERT INTO `sis_distrito` VALUES ('1', '03', '03', 'San Juan de Dios');
INSERT INTO `sis_distrito` VALUES ('1', '03', '04', 'San Rafael Arriba');
INSERT INTO `sis_distrito` VALUES ('1', '03', '05', 'San Antonio');
INSERT INTO `sis_distrito` VALUES ('1', '03', '06', 'Frailes');
INSERT INTO `sis_distrito` VALUES ('1', '03', '07', 'Patarra');
INSERT INTO `sis_distrito` VALUES ('1', '03', '08', 'San Cristobal');
INSERT INTO `sis_distrito` VALUES ('1', '03', '09', 'Rosario');
INSERT INTO `sis_distrito` VALUES ('1', '03', '10', 'Damas');
INSERT INTO `sis_distrito` VALUES ('1', '03', '11', 'San Rafael Abajo');
INSERT INTO `sis_distrito` VALUES ('1', '03', '12', 'Gravilias');
INSERT INTO `sis_distrito` VALUES ('1', '03', '13', 'Los Guido');
INSERT INTO `sis_distrito` VALUES ('1', '04', '01', 'Santiago');
INSERT INTO `sis_distrito` VALUES ('1', '04', '02', 'Mercedes Sur');
INSERT INTO `sis_distrito` VALUES ('1', '04', '03', 'Barbacoas');
INSERT INTO `sis_distrito` VALUES ('1', '04', '04', 'Grifo Alto');
INSERT INTO `sis_distrito` VALUES ('1', '04', '05', 'San Rafael');
INSERT INTO `sis_distrito` VALUES ('1', '04', '06', 'Candelaria');
INSERT INTO `sis_distrito` VALUES ('1', '04', '07', 'Desamparaditos');
INSERT INTO `sis_distrito` VALUES ('1', '04', '08', 'San Antonio');
INSERT INTO `sis_distrito` VALUES ('1', '04', '09', 'Chires');
INSERT INTO `sis_distrito` VALUES ('1', '05', '01', 'San Marcos');
INSERT INTO `sis_distrito` VALUES ('1', '05', '02', 'San Lorenzo');
INSERT INTO `sis_distrito` VALUES ('1', '05', '03', 'San Carlos');
INSERT INTO `sis_distrito` VALUES ('1', '06', '01', 'Aserri');
INSERT INTO `sis_distrito` VALUES ('1', '06', '02', 'Tarbaca');
INSERT INTO `sis_distrito` VALUES ('1', '06', '03', 'Vuelta de Jorco');
INSERT INTO `sis_distrito` VALUES ('1', '06', '04', 'San Gabriel');
INSERT INTO `sis_distrito` VALUES ('1', '06', '05', 'Legua');
INSERT INTO `sis_distrito` VALUES ('1', '06', '06', 'Monterrey');
INSERT INTO `sis_distrito` VALUES ('1', '06', '07', 'Salitrillos');
INSERT INTO `sis_distrito` VALUES ('1', '07', '01', 'Colon');
INSERT INTO `sis_distrito` VALUES ('1', '07', '02', 'Guayabo');
INSERT INTO `sis_distrito` VALUES ('1', '07', '03', 'Tabarcia');
INSERT INTO `sis_distrito` VALUES ('1', '07', '04', 'Piedras Negras');
INSERT INTO `sis_distrito` VALUES ('1', '07', '05', 'Picagres');
INSERT INTO `sis_distrito` VALUES ('1', '08', '01', 'Guadalupe');
INSERT INTO `sis_distrito` VALUES ('1', '08', '02', 'San Francisco');
INSERT INTO `sis_distrito` VALUES ('1', '08', '03', 'Calle Blancos');
INSERT INTO `sis_distrito` VALUES ('1', '08', '04', 'Mata de Platano');
INSERT INTO `sis_distrito` VALUES ('1', '08', '05', 'Ipis');
INSERT INTO `sis_distrito` VALUES ('1', '08', '06', 'Rancho Redondo');
INSERT INTO `sis_distrito` VALUES ('1', '08', '07', 'Purral');
INSERT INTO `sis_distrito` VALUES ('1', '09', '01', 'Santa Ana');
INSERT INTO `sis_distrito` VALUES ('1', '09', '02', 'Salitral');
INSERT INTO `sis_distrito` VALUES ('1', '09', '03', 'Pozos');
INSERT INTO `sis_distrito` VALUES ('1', '09', '04', 'Uruca');
INSERT INTO `sis_distrito` VALUES ('1', '09', '05', 'Piedades');
INSERT INTO `sis_distrito` VALUES ('1', '09', '06', 'Brasil');
INSERT INTO `sis_distrito` VALUES ('1', '10', '01', 'Alajuelita');
INSERT INTO `sis_distrito` VALUES ('1', '10', '02', 'San Josecito');
INSERT INTO `sis_distrito` VALUES ('1', '10', '03', 'San Antonio');
INSERT INTO `sis_distrito` VALUES ('1', '10', '04', 'Concepcion');
INSERT INTO `sis_distrito` VALUES ('1', '10', '05', 'San Felipe');
INSERT INTO `sis_distrito` VALUES ('1', '11', '01', 'San Isidro');
INSERT INTO `sis_distrito` VALUES ('1', '11', '02', 'San Rafael');
INSERT INTO `sis_distrito` VALUES ('1', '11', '03', 'Dulce Nombre de Jesus');
INSERT INTO `sis_distrito` VALUES ('1', '11', '04', 'Patalillo');
INSERT INTO `sis_distrito` VALUES ('1', '11', '05', 'Cascajal');
INSERT INTO `sis_distrito` VALUES ('1', '12', '01', 'San Ignacio de Acosta');
INSERT INTO `sis_distrito` VALUES ('1', '12', '02', 'Guaitil');
INSERT INTO `sis_distrito` VALUES ('1', '12', '03', 'Palmichal');
INSERT INTO `sis_distrito` VALUES ('1', '12', '04', 'Cangrejal');
INSERT INTO `sis_distrito` VALUES ('1', '12', '05', 'Sabanillas');
INSERT INTO `sis_distrito` VALUES ('1', '13', '01', 'San Juan');
INSERT INTO `sis_distrito` VALUES ('1', '13', '02', 'Cinco esquinas');
INSERT INTO `sis_distrito` VALUES ('1', '13', '03', 'Anselmo Llorente');
INSERT INTO `sis_distrito` VALUES ('1', '13', '04', 'Leon XIII');
INSERT INTO `sis_distrito` VALUES ('1', '13', '05', 'Colima');
INSERT INTO `sis_distrito` VALUES ('1', '14', '01', 'San Vicente');
INSERT INTO `sis_distrito` VALUES ('1', '14', '02', 'San Jeronimo');
INSERT INTO `sis_distrito` VALUES ('1', '14', '03', 'Trinidad');
INSERT INTO `sis_distrito` VALUES ('1', '15', '01', 'San Pedro');
INSERT INTO `sis_distrito` VALUES ('1', '15', '02', 'Sabanilla');
INSERT INTO `sis_distrito` VALUES ('1', '15', '03', 'Mercedes');
INSERT INTO `sis_distrito` VALUES ('1', '15', '04', 'San Rafael');
INSERT INTO `sis_distrito` VALUES ('1', '16', '01', 'San Pablo');
INSERT INTO `sis_distrito` VALUES ('1', '16', '02', 'San Pedro');
INSERT INTO `sis_distrito` VALUES ('1', '16', '03', 'San Juan de Mata');
INSERT INTO `sis_distrito` VALUES ('1', '16', '04', 'San Luis');
INSERT INTO `sis_distrito` VALUES ('1', '16', '05', 'Carara');
INSERT INTO `sis_distrito` VALUES ('1', '17', '01', 'Santa Maria');
INSERT INTO `sis_distrito` VALUES ('1', '17', '02', 'Jardin');
INSERT INTO `sis_distrito` VALUES ('1', '17', '03', 'Copey');
INSERT INTO `sis_distrito` VALUES ('1', '18', '01', 'Curridabat');
INSERT INTO `sis_distrito` VALUES ('1', '18', '02', 'Granadilla');
INSERT INTO `sis_distrito` VALUES ('1', '18', '03', 'Sanchez');
INSERT INTO `sis_distrito` VALUES ('1', '18', '04', 'Tirrases');
INSERT INTO `sis_distrito` VALUES ('1', '19', '01', 'San Isidro del General');
INSERT INTO `sis_distrito` VALUES ('1', '19', '02', 'General');
INSERT INTO `sis_distrito` VALUES ('1', '19', '03', 'Daniel Flores');
INSERT INTO `sis_distrito` VALUES ('1', '19', '04', 'Rivas');
INSERT INTO `sis_distrito` VALUES ('1', '19', '05', 'San Pedro');
INSERT INTO `sis_distrito` VALUES ('1', '19', '06', 'Platanares');
INSERT INTO `sis_distrito` VALUES ('1', '19', '07', 'Pejibaye');
INSERT INTO `sis_distrito` VALUES ('1', '19', '08', 'Cajon');
INSERT INTO `sis_distrito` VALUES ('1', '19', '09', 'Baru');
INSERT INTO `sis_distrito` VALUES ('1', '19', '10', 'Rio Nuevo');
INSERT INTO `sis_distrito` VALUES ('1', '19', '11', 'Paramo');
INSERT INTO `sis_distrito` VALUES ('1', '20', '01', 'San Pablo');
INSERT INTO `sis_distrito` VALUES ('1', '20', '02', 'San Andres');
INSERT INTO `sis_distrito` VALUES ('1', '20', '03', 'Llano Bonito');
INSERT INTO `sis_distrito` VALUES ('1', '20', '04', 'San Isidro');
INSERT INTO `sis_distrito` VALUES ('1', '20', '05', 'Santa Cruz');
INSERT INTO `sis_distrito` VALUES ('1', '20', '06', 'San Antonio');
INSERT INTO `sis_distrito` VALUES ('2', '01', '01', 'Alajuela');
INSERT INTO `sis_distrito` VALUES ('2', '01', '02', 'San Jose');
INSERT INTO `sis_distrito` VALUES ('2', '01', '03', 'Carrizal');
INSERT INTO `sis_distrito` VALUES ('2', '01', '04', 'San Antonio');
INSERT INTO `sis_distrito` VALUES ('2', '01', '05', 'Guacima');
INSERT INTO `sis_distrito` VALUES ('2', '01', '06', 'San Isidro');
INSERT INTO `sis_distrito` VALUES ('2', '01', '07', 'Sabanilla');
INSERT INTO `sis_distrito` VALUES ('2', '01', '08', 'San Rafael');
INSERT INTO `sis_distrito` VALUES ('2', '01', '09', 'Rio Segundo');
INSERT INTO `sis_distrito` VALUES ('2', '01', '10', 'Desamparados');
INSERT INTO `sis_distrito` VALUES ('2', '01', '11', 'Turrucares');
INSERT INTO `sis_distrito` VALUES ('2', '01', '12', 'Tambor');
INSERT INTO `sis_distrito` VALUES ('2', '01', '13', 'Garita');
INSERT INTO `sis_distrito` VALUES ('2', '01', '14', 'Sarapiqui');
INSERT INTO `sis_distrito` VALUES ('2', '02', '01', 'San Ramon');
INSERT INTO `sis_distrito` VALUES ('2', '02', '02', 'Santiago');
INSERT INTO `sis_distrito` VALUES ('2', '02', '03', 'San Juan');
INSERT INTO `sis_distrito` VALUES ('2', '02', '04', 'Piedades Norte');
INSERT INTO `sis_distrito` VALUES ('2', '02', '05', 'Piedades Sur');
INSERT INTO `sis_distrito` VALUES ('2', '02', '06', 'San Rafael');
INSERT INTO `sis_distrito` VALUES ('2', '02', '07', 'San Isidro');
INSERT INTO `sis_distrito` VALUES ('2', '02', '08', 'angeles');
INSERT INTO `sis_distrito` VALUES ('2', '02', '09', 'Alfaro');
INSERT INTO `sis_distrito` VALUES ('2', '02', '10', 'Volio');
INSERT INTO `sis_distrito` VALUES ('2', '02', '11', 'Concepcion');
INSERT INTO `sis_distrito` VALUES ('2', '02', '12', 'Zapotal');
INSERT INTO `sis_distrito` VALUES ('2', '02', '13', 'Peñas Blancas');
INSERT INTO `sis_distrito` VALUES ('2', '03', '01', 'Grecia');
INSERT INTO `sis_distrito` VALUES ('2', '03', '02', 'San Isidro');
INSERT INTO `sis_distrito` VALUES ('2', '03', '03', 'San Jose');
INSERT INTO `sis_distrito` VALUES ('2', '03', '04', 'San Roque');
INSERT INTO `sis_distrito` VALUES ('2', '03', '05', 'Tacares');
INSERT INTO `sis_distrito` VALUES ('2', '03', '06', 'Rio Cuarto');
INSERT INTO `sis_distrito` VALUES ('2', '03', '07', 'Puente de Piedra');
INSERT INTO `sis_distrito` VALUES ('2', '03', '08', 'Bolivar');
INSERT INTO `sis_distrito` VALUES ('2', '04', '01', 'San Mateo');
INSERT INTO `sis_distrito` VALUES ('2', '04', '02', 'Desmonte');
INSERT INTO `sis_distrito` VALUES ('2', '04', '03', 'Jesus Maria');
INSERT INTO `sis_distrito` VALUES ('2', '05', '01', 'Atenas');
INSERT INTO `sis_distrito` VALUES ('2', '05', '02', 'Jesus');
INSERT INTO `sis_distrito` VALUES ('2', '05', '03', 'Mercedes');
INSERT INTO `sis_distrito` VALUES ('2', '05', '04', 'San Isidro');
INSERT INTO `sis_distrito` VALUES ('2', '05', '05', 'Concepcion');
INSERT INTO `sis_distrito` VALUES ('2', '05', '06', 'San Jose');
INSERT INTO `sis_distrito` VALUES ('2', '05', '07', 'Santa Eulalia');
INSERT INTO `sis_distrito` VALUES ('2', '05', '08', 'Escobal');
INSERT INTO `sis_distrito` VALUES ('2', '06', '01', 'Naranjo');
INSERT INTO `sis_distrito` VALUES ('2', '06', '02', 'San Miguel');
INSERT INTO `sis_distrito` VALUES ('2', '06', '03', 'San Jose');
INSERT INTO `sis_distrito` VALUES ('2', '06', '04', 'Cirri Sur');
INSERT INTO `sis_distrito` VALUES ('2', '06', '05', 'San Jeronimo');
INSERT INTO `sis_distrito` VALUES ('2', '06', '06', 'San Juan');
INSERT INTO `sis_distrito` VALUES ('2', '06', '07', 'Rosario');
INSERT INTO `sis_distrito` VALUES ('2', '06', '08', 'Palmitos');
INSERT INTO `sis_distrito` VALUES ('2', '07', '01', 'Palmares');
INSERT INTO `sis_distrito` VALUES ('2', '07', '02', 'Zaragoza');
INSERT INTO `sis_distrito` VALUES ('2', '07', '03', 'Buenos Aires');
INSERT INTO `sis_distrito` VALUES ('2', '07', '04', 'Santiago');
INSERT INTO `sis_distrito` VALUES ('2', '07', '05', 'Candelaria');
INSERT INTO `sis_distrito` VALUES ('2', '07', '06', 'Esquipulas');
INSERT INTO `sis_distrito` VALUES ('2', '07', '07', 'Granja');
INSERT INTO `sis_distrito` VALUES ('2', '08', '01', 'San Pedro');
INSERT INTO `sis_distrito` VALUES ('2', '08', '02', 'San Juan');
INSERT INTO `sis_distrito` VALUES ('2', '08', '03', 'San Rafael');
INSERT INTO `sis_distrito` VALUES ('2', '08', '04', 'Carrillos');
INSERT INTO `sis_distrito` VALUES ('2', '08', '05', 'Sabana Redonda');
INSERT INTO `sis_distrito` VALUES ('2', '09', '01', 'Orotina');
INSERT INTO `sis_distrito` VALUES ('2', '09', '02', 'Mastate');
INSERT INTO `sis_distrito` VALUES ('2', '09', '03', 'Hacienda Vieja');
INSERT INTO `sis_distrito` VALUES ('2', '09', '04', 'Coyolar');
INSERT INTO `sis_distrito` VALUES ('2', '09', '05', 'Ceiba');
INSERT INTO `sis_distrito` VALUES ('2', '10', '01', 'Quesada');
INSERT INTO `sis_distrito` VALUES ('2', '10', '02', 'Florencia');
INSERT INTO `sis_distrito` VALUES ('2', '10', '03', 'Buenavista');
INSERT INTO `sis_distrito` VALUES ('2', '10', '04', 'Aguas Zarcas');
INSERT INTO `sis_distrito` VALUES ('2', '10', '05', 'Venecia');
INSERT INTO `sis_distrito` VALUES ('2', '10', '06', 'Pital');
INSERT INTO `sis_distrito` VALUES ('2', '10', '07', 'Fortuna');
INSERT INTO `sis_distrito` VALUES ('2', '10', '08', 'Tigra');
INSERT INTO `sis_distrito` VALUES ('2', '10', '09', 'Palmera');
INSERT INTO `sis_distrito` VALUES ('2', '10', '10', 'Venado');
INSERT INTO `sis_distrito` VALUES ('2', '10', '11', 'Cutris');
INSERT INTO `sis_distrito` VALUES ('2', '10', '12', 'Monterrey');
INSERT INTO `sis_distrito` VALUES ('2', '10', '13', 'Pocosol');
INSERT INTO `sis_distrito` VALUES ('2', '11', '01', 'Zarcero');
INSERT INTO `sis_distrito` VALUES ('2', '11', '02', 'Laguna');
INSERT INTO `sis_distrito` VALUES ('2', '11', '03', 'Tapezco');
INSERT INTO `sis_distrito` VALUES ('2', '11', '04', 'Guadalupe');
INSERT INTO `sis_distrito` VALUES ('2', '11', '05', 'Palmira');
INSERT INTO `sis_distrito` VALUES ('2', '11', '06', 'Zapote');
INSERT INTO `sis_distrito` VALUES ('2', '11', '07', 'Brisas');
INSERT INTO `sis_distrito` VALUES ('2', '12', '01', 'Sarchi Norte');
INSERT INTO `sis_distrito` VALUES ('2', '12', '02', 'Sarchi Sur');
INSERT INTO `sis_distrito` VALUES ('2', '12', '03', 'Toro Amarillo');
INSERT INTO `sis_distrito` VALUES ('2', '12', '04', 'San Pedro');
INSERT INTO `sis_distrito` VALUES ('2', '12', '05', 'Rodriguez');
INSERT INTO `sis_distrito` VALUES ('2', '13', '01', 'Upala');
INSERT INTO `sis_distrito` VALUES ('2', '13', '02', 'Aguas Claras');
INSERT INTO `sis_distrito` VALUES ('2', '13', '03', 'San Jose (Pizote)');
INSERT INTO `sis_distrito` VALUES ('2', '13', '04', 'Bijagua');
INSERT INTO `sis_distrito` VALUES ('2', '13', '05', 'Delicias');
INSERT INTO `sis_distrito` VALUES ('2', '13', '06', 'Dos Rios');
INSERT INTO `sis_distrito` VALUES ('2', '13', '07', 'Yoliyllal');
INSERT INTO `sis_distrito` VALUES ('2', '14', '01', 'Los Chiles');
INSERT INTO `sis_distrito` VALUES ('2', '14', '02', 'Caño Negro');
INSERT INTO `sis_distrito` VALUES ('2', '14', '03', 'El Amparo');
INSERT INTO `sis_distrito` VALUES ('2', '14', '04', 'San Jorge');
INSERT INTO `sis_distrito` VALUES ('2', '15', '01', 'San Rafael');
INSERT INTO `sis_distrito` VALUES ('2', '15', '02', 'Buenavista');
INSERT INTO `sis_distrito` VALUES ('2', '15', '03', 'Cote');
INSERT INTO `sis_distrito` VALUES ('2', '15', '04', 'Katira');
INSERT INTO `sis_distrito` VALUES ('3', '01', '01', 'Oriental');
INSERT INTO `sis_distrito` VALUES ('3', '01', '02', 'Occidental');
INSERT INTO `sis_distrito` VALUES ('3', '01', '03', 'Carmen');
INSERT INTO `sis_distrito` VALUES ('3', '01', '04', 'San Nicolas');
INSERT INTO `sis_distrito` VALUES ('3', '01', '05', 'Aguacaliente (San Francisco)');
INSERT INTO `sis_distrito` VALUES ('3', '01', '06', 'Guadalupe (Arenilla)');
INSERT INTO `sis_distrito` VALUES ('3', '01', '07', 'Corralillo');
INSERT INTO `sis_distrito` VALUES ('3', '01', '08', 'Tierra Blanca');
INSERT INTO `sis_distrito` VALUES ('3', '01', '09', 'Dulce Nombre');
INSERT INTO `sis_distrito` VALUES ('3', '01', '10', 'Llano Grande');
INSERT INTO `sis_distrito` VALUES ('3', '01', '11', 'Quebradilla');
INSERT INTO `sis_distrito` VALUES ('3', '02', '01', 'Paraiso');
INSERT INTO `sis_distrito` VALUES ('3', '02', '02', 'Santiago');
INSERT INTO `sis_distrito` VALUES ('3', '02', '03', 'Orosi');
INSERT INTO `sis_distrito` VALUES ('3', '02', '04', 'Cachi');
INSERT INTO `sis_distrito` VALUES ('3', '02', '05', 'Llanos de Santa Lucia');
INSERT INTO `sis_distrito` VALUES ('3', '03', '01', 'Tres Rios');
INSERT INTO `sis_distrito` VALUES ('3', '03', '02', 'San Diego');
INSERT INTO `sis_distrito` VALUES ('3', '03', '03', 'San Juan');
INSERT INTO `sis_distrito` VALUES ('3', '03', '04', 'San Rafael');
INSERT INTO `sis_distrito` VALUES ('3', '03', '05', 'Concepcion');
INSERT INTO `sis_distrito` VALUES ('3', '03', '06', 'Dulce Nombre');
INSERT INTO `sis_distrito` VALUES ('3', '03', '07', 'San Ramon');
INSERT INTO `sis_distrito` VALUES ('3', '03', '08', 'Rio Azul');
INSERT INTO `sis_distrito` VALUES ('3', '04', '01', 'Juan Viñas');
INSERT INTO `sis_distrito` VALUES ('3', '04', '02', 'Tucurrique');
INSERT INTO `sis_distrito` VALUES ('3', '04', '03', 'Pejibaye');
INSERT INTO `sis_distrito` VALUES ('3', '05', '01', 'Turrialba');
INSERT INTO `sis_distrito` VALUES ('3', '05', '02', 'La Suiza');
INSERT INTO `sis_distrito` VALUES ('3', '05', '03', 'Peralta');
INSERT INTO `sis_distrito` VALUES ('3', '05', '04', 'Santa Cruz');
INSERT INTO `sis_distrito` VALUES ('3', '05', '05', 'Santa Teresita');
INSERT INTO `sis_distrito` VALUES ('3', '05', '06', 'Pavones');
INSERT INTO `sis_distrito` VALUES ('3', '05', '07', 'Tuis');
INSERT INTO `sis_distrito` VALUES ('3', '05', '08', 'Tayutic');
INSERT INTO `sis_distrito` VALUES ('3', '05', '09', 'Santa Rosa');
INSERT INTO `sis_distrito` VALUES ('3', '05', '10', 'Tres Equis');
INSERT INTO `sis_distrito` VALUES ('3', '05', '11', 'La Isabel');
INSERT INTO `sis_distrito` VALUES ('3', '05', '12', 'Chirripo');
INSERT INTO `sis_distrito` VALUES ('3', '06', '01', 'Pacayas');
INSERT INTO `sis_distrito` VALUES ('3', '06', '02', 'Cervantes');
INSERT INTO `sis_distrito` VALUES ('3', '06', '03', 'Capellades');
INSERT INTO `sis_distrito` VALUES ('3', '07', '01', 'San Rafael');
INSERT INTO `sis_distrito` VALUES ('3', '07', '02', 'Cot');
INSERT INTO `sis_distrito` VALUES ('3', '07', '03', 'Potrero Cerrado');
INSERT INTO `sis_distrito` VALUES ('3', '07', '04', 'Cipreses');
INSERT INTO `sis_distrito` VALUES ('3', '07', '05', 'Santa Rosa');
INSERT INTO `sis_distrito` VALUES ('3', '08', '01', 'Tejar');
INSERT INTO `sis_distrito` VALUES ('3', '08', '02', 'San Isidro');
INSERT INTO `sis_distrito` VALUES ('3', '08', '03', 'Tobosi');
INSERT INTO `sis_distrito` VALUES ('3', '08', '04', 'Patio de Agua');
INSERT INTO `sis_distrito` VALUES ('4', '01', '01', 'Heredia');
INSERT INTO `sis_distrito` VALUES ('4', '01', '02', 'Mercedes');
INSERT INTO `sis_distrito` VALUES ('4', '01', '03', 'San Francisco');
INSERT INTO `sis_distrito` VALUES ('4', '01', '04', 'Ulloa');
INSERT INTO `sis_distrito` VALUES ('4', '01', '05', 'Varablanca');
INSERT INTO `sis_distrito` VALUES ('4', '02', '01', 'Barva');
INSERT INTO `sis_distrito` VALUES ('4', '02', '02', 'San Pedro');
INSERT INTO `sis_distrito` VALUES ('4', '02', '03', 'San Pablo');
INSERT INTO `sis_distrito` VALUES ('4', '02', '04', 'San Roque');
INSERT INTO `sis_distrito` VALUES ('4', '02', '05', 'Santa Lucia');
INSERT INTO `sis_distrito` VALUES ('4', '02', '06', 'San Jose de la Montaña');
INSERT INTO `sis_distrito` VALUES ('4', '03', '01', 'Santo Domingo');
INSERT INTO `sis_distrito` VALUES ('4', '03', '02', 'San Vicente');
INSERT INTO `sis_distrito` VALUES ('4', '03', '03', 'San Miguel');
INSERT INTO `sis_distrito` VALUES ('4', '03', '04', 'Paracito');
INSERT INTO `sis_distrito` VALUES ('4', '03', '05', 'Santo Tomas');
INSERT INTO `sis_distrito` VALUES ('4', '03', '06', 'Santa Rosa');
INSERT INTO `sis_distrito` VALUES ('4', '03', '07', 'Tures');
INSERT INTO `sis_distrito` VALUES ('4', '03', '08', 'Para');
INSERT INTO `sis_distrito` VALUES ('4', '04', '01', 'Santa Barbara');
INSERT INTO `sis_distrito` VALUES ('4', '04', '02', 'San Pedro');
INSERT INTO `sis_distrito` VALUES ('4', '04', '03', 'San Juan');
INSERT INTO `sis_distrito` VALUES ('4', '04', '04', 'Jesus');
INSERT INTO `sis_distrito` VALUES ('4', '04', '05', 'Santo Domingo');
INSERT INTO `sis_distrito` VALUES ('4', '04', '06', 'Puraba');
INSERT INTO `sis_distrito` VALUES ('4', '05', '01', 'San Rafael');
INSERT INTO `sis_distrito` VALUES ('4', '05', '02', 'San Josecito');
INSERT INTO `sis_distrito` VALUES ('4', '05', '03', 'Santiago');
INSERT INTO `sis_distrito` VALUES ('4', '05', '04', 'angeles');
INSERT INTO `sis_distrito` VALUES ('4', '05', '05', 'Concepcion');
INSERT INTO `sis_distrito` VALUES ('4', '06', '01', 'San Isidro');
INSERT INTO `sis_distrito` VALUES ('4', '06', '02', 'San Jose');
INSERT INTO `sis_distrito` VALUES ('4', '06', '03', 'Concepcion');
INSERT INTO `sis_distrito` VALUES ('4', '06', '04', 'San Francisco');
INSERT INTO `sis_distrito` VALUES ('4', '07', '01', 'San Antonio');
INSERT INTO `sis_distrito` VALUES ('4', '07', '02', 'Ribera');
INSERT INTO `sis_distrito` VALUES ('4', '07', '03', 'Asuncion');
INSERT INTO `sis_distrito` VALUES ('4', '08', '01', 'San Joaquín de Flores');
INSERT INTO `sis_distrito` VALUES ('4', '08', '02', 'Barrantes');
INSERT INTO `sis_distrito` VALUES ('4', '08', '03', 'Llorente');
INSERT INTO `sis_distrito` VALUES ('4', '09', '01', 'San Pablo');
INSERT INTO `sis_distrito` VALUES ('4', '09', '02', 'Rincón de Sabanilla');
INSERT INTO `sis_distrito` VALUES ('4', '10', '01', 'Puerto Viejo');
INSERT INTO `sis_distrito` VALUES ('4', '10', '02', 'La Virgen');
INSERT INTO `sis_distrito` VALUES ('4', '10', '03', 'Horquetas');
INSERT INTO `sis_distrito` VALUES ('4', '10', '04', 'Llanuras del Gaspar');
INSERT INTO `sis_distrito` VALUES ('4', '10', '05', 'Cureña');
INSERT INTO `sis_distrito` VALUES ('5', '01', '01', 'Liberia');
INSERT INTO `sis_distrito` VALUES ('5', '01', '02', 'Cañas Dulces');
INSERT INTO `sis_distrito` VALUES ('5', '01', '03', 'Mayorga');
INSERT INTO `sis_distrito` VALUES ('5', '01', '04', 'Nacascolo');
INSERT INTO `sis_distrito` VALUES ('5', '01', '05', 'Curubande');
INSERT INTO `sis_distrito` VALUES ('5', '02', '01', 'Nicoya');
INSERT INTO `sis_distrito` VALUES ('5', '02', '02', 'Mansion');
INSERT INTO `sis_distrito` VALUES ('5', '02', '03', 'San Antonio');
INSERT INTO `sis_distrito` VALUES ('5', '02', '04', 'Quebrada Honda');
INSERT INTO `sis_distrito` VALUES ('5', '02', '05', 'Samara');
INSERT INTO `sis_distrito` VALUES ('5', '02', '06', 'Nosara');
INSERT INTO `sis_distrito` VALUES ('5', '02', '07', 'Belen de Nosarita');
INSERT INTO `sis_distrito` VALUES ('5', '03', '01', 'Santa Cruz');
INSERT INTO `sis_distrito` VALUES ('5', '03', '02', 'Bolson');
INSERT INTO `sis_distrito` VALUES ('5', '03', '03', 'Veintisiete de Abril');
INSERT INTO `sis_distrito` VALUES ('5', '03', '04', 'Tempate');
INSERT INTO `sis_distrito` VALUES ('5', '03', '05', 'Cartagena');
INSERT INTO `sis_distrito` VALUES ('5', '03', '06', 'Cuajiniquil');
INSERT INTO `sis_distrito` VALUES ('5', '03', '07', 'Diria');
INSERT INTO `sis_distrito` VALUES ('5', '03', '08', 'Cabo Velas');
INSERT INTO `sis_distrito` VALUES ('5', '03', '09', 'Tamarindo');
INSERT INTO `sis_distrito` VALUES ('5', '04', '01', 'Bagaces');
INSERT INTO `sis_distrito` VALUES ('5', '04', '02', 'Fortuna');
INSERT INTO `sis_distrito` VALUES ('5', '04', '03', 'Mogote');
INSERT INTO `sis_distrito` VALUES ('5', '04', '04', 'Rio Naranjo');
INSERT INTO `sis_distrito` VALUES ('5', '05', '01', 'Filadelfia');
INSERT INTO `sis_distrito` VALUES ('5', '05', '02', 'Palmira');
INSERT INTO `sis_distrito` VALUES ('5', '05', '03', 'Sardinal');
INSERT INTO `sis_distrito` VALUES ('5', '05', '04', 'Belen');
INSERT INTO `sis_distrito` VALUES ('5', '06', '01', 'Cañas');
INSERT INTO `sis_distrito` VALUES ('5', '06', '02', 'Palmira');
INSERT INTO `sis_distrito` VALUES ('5', '06', '03', 'San Miguel');
INSERT INTO `sis_distrito` VALUES ('5', '06', '04', 'Bebedero');
INSERT INTO `sis_distrito` VALUES ('5', '06', '05', 'Porozal');
INSERT INTO `sis_distrito` VALUES ('5', '07', '01', 'Juntas');
INSERT INTO `sis_distrito` VALUES ('5', '07', '02', 'Sierra');
INSERT INTO `sis_distrito` VALUES ('5', '07', '03', 'San Juan');
INSERT INTO `sis_distrito` VALUES ('5', '07', '04', 'Colorado');
INSERT INTO `sis_distrito` VALUES ('5', '08', '01', 'Tilaran');
INSERT INTO `sis_distrito` VALUES ('5', '08', '02', 'Quebrada Grande');
INSERT INTO `sis_distrito` VALUES ('5', '08', '03', 'Tronadora');
INSERT INTO `sis_distrito` VALUES ('5', '08', '04', 'Santa Rosa');
INSERT INTO `sis_distrito` VALUES ('5', '08', '05', 'Libano');
INSERT INTO `sis_distrito` VALUES ('5', '08', '06', 'Tierras Morenas');
INSERT INTO `sis_distrito` VALUES ('5', '08', '07', 'Arenal');
INSERT INTO `sis_distrito` VALUES ('5', '09', '01', 'Carmona');
INSERT INTO `sis_distrito` VALUES ('5', '09', '02', 'Santa Rita');
INSERT INTO `sis_distrito` VALUES ('5', '09', '03', 'Zapotal');
INSERT INTO `sis_distrito` VALUES ('5', '09', '04', 'San Pablo');
INSERT INTO `sis_distrito` VALUES ('5', '09', '05', 'Porvenir');
INSERT INTO `sis_distrito` VALUES ('5', '09', '06', 'Bejuco');
INSERT INTO `sis_distrito` VALUES ('5', '10', '01', 'La Cruz');
INSERT INTO `sis_distrito` VALUES ('5', '10', '02', 'Santa Cecilia');
INSERT INTO `sis_distrito` VALUES ('5', '10', '03', 'Garita');
INSERT INTO `sis_distrito` VALUES ('5', '10', '04', 'Santa Elena');
INSERT INTO `sis_distrito` VALUES ('5', '11', '01', 'Hojancha');
INSERT INTO `sis_distrito` VALUES ('5', '11', '02', 'Monte Romo');
INSERT INTO `sis_distrito` VALUES ('5', '11', '03', 'Puerto Carrillo');
INSERT INTO `sis_distrito` VALUES ('5', '11', '04', 'Huacas');
INSERT INTO `sis_distrito` VALUES ('6', '01', '01', 'Puntarenas');
INSERT INTO `sis_distrito` VALUES ('6', '01', '02', 'Pitahaya');
INSERT INTO `sis_distrito` VALUES ('6', '01', '03', 'Chomes');
INSERT INTO `sis_distrito` VALUES ('6', '01', '04', 'Lepanto');
INSERT INTO `sis_distrito` VALUES ('6', '01', '05', 'Paquera');
INSERT INTO `sis_distrito` VALUES ('6', '01', '06', 'Manzanillo');
INSERT INTO `sis_distrito` VALUES ('6', '01', '07', 'Guacimal');
INSERT INTO `sis_distrito` VALUES ('6', '01', '08', 'Barranca');
INSERT INTO `sis_distrito` VALUES ('6', '01', '09', 'Monte Verde');
INSERT INTO `sis_distrito` VALUES ('6', '01', '10', 'Isla del Coco');
INSERT INTO `sis_distrito` VALUES ('6', '01', '11', 'Cobano');
INSERT INTO `sis_distrito` VALUES ('6', '01', '12', 'Chacarita');
INSERT INTO `sis_distrito` VALUES ('6', '01', '13', 'Chira');
INSERT INTO `sis_distrito` VALUES ('6', '01', '14', 'Acapulco');
INSERT INTO `sis_distrito` VALUES ('6', '01', '15', 'El Roble');
INSERT INTO `sis_distrito` VALUES ('6', '01', '16', 'Arancibia');
INSERT INTO `sis_distrito` VALUES ('6', '02', '01', 'Espiritu Santo');
INSERT INTO `sis_distrito` VALUES ('6', '02', '02', 'San Juan Grande');
INSERT INTO `sis_distrito` VALUES ('6', '02', '03', 'Macacona');
INSERT INTO `sis_distrito` VALUES ('6', '02', '04', 'San Rafael');
INSERT INTO `sis_distrito` VALUES ('6', '02', '05', 'San Jeronimo');
INSERT INTO `sis_distrito` VALUES ('6', '03', '01', 'Buenos Aires');
INSERT INTO `sis_distrito` VALUES ('6', '03', '02', 'Volcan');
INSERT INTO `sis_distrito` VALUES ('6', '03', '03', 'Potrero Grande');
INSERT INTO `sis_distrito` VALUES ('6', '03', '04', 'Boruca');
INSERT INTO `sis_distrito` VALUES ('6', '03', '05', 'Pilas');
INSERT INTO `sis_distrito` VALUES ('6', '03', '06', 'Colinas');
INSERT INTO `sis_distrito` VALUES ('6', '03', '07', 'Changena');
INSERT INTO `sis_distrito` VALUES ('6', '03', '08', 'Briolley');
INSERT INTO `sis_distrito` VALUES ('6', '03', '09', 'Brunka');
INSERT INTO `sis_distrito` VALUES ('6', '04', '01', 'Miramar');
INSERT INTO `sis_distrito` VALUES ('6', '04', '02', 'Union');
INSERT INTO `sis_distrito` VALUES ('6', '04', '03', 'San Isidro');
INSERT INTO `sis_distrito` VALUES ('6', '05', '01', 'Puerto Cortes');
INSERT INTO `sis_distrito` VALUES ('6', '05', '02', 'Palmar');
INSERT INTO `sis_distrito` VALUES ('6', '05', '03', 'Sierpe');
INSERT INTO `sis_distrito` VALUES ('6', '05', '04', 'Bahia Ballena');
INSERT INTO `sis_distrito` VALUES ('6', '05', '05', 'Piedras Blancas');
INSERT INTO `sis_distrito` VALUES ('6', '06', '01', 'Quepos');
INSERT INTO `sis_distrito` VALUES ('6', '06', '02', 'Savegre');
INSERT INTO `sis_distrito` VALUES ('6', '06', '03', 'Naranjito');
INSERT INTO `sis_distrito` VALUES ('6', '07', '01', 'Golfito');
INSERT INTO `sis_distrito` VALUES ('6', '07', '02', 'Puerto Jimenez');
INSERT INTO `sis_distrito` VALUES ('6', '07', '03', 'Guaycara');
INSERT INTO `sis_distrito` VALUES ('6', '07', '04', 'Pavon');
INSERT INTO `sis_distrito` VALUES ('6', '08', '01', 'San Vito');
INSERT INTO `sis_distrito` VALUES ('6', '08', '02', 'Sabalito');
INSERT INTO `sis_distrito` VALUES ('6', '08', '03', 'Aguabuena');
INSERT INTO `sis_distrito` VALUES ('6', '08', '04', 'Limoncito');
INSERT INTO `sis_distrito` VALUES ('6', '08', '05', 'Pittier');
INSERT INTO `sis_distrito` VALUES ('6', '09', '01', 'Parrita');
INSERT INTO `sis_distrito` VALUES ('6', '10', '01', 'Corredor');
INSERT INTO `sis_distrito` VALUES ('6', '10', '02', 'La Cuesta');
INSERT INTO `sis_distrito` VALUES ('6', '10', '03', 'Canoas');
INSERT INTO `sis_distrito` VALUES ('6', '10', '04', 'Laurel');
INSERT INTO `sis_distrito` VALUES ('6', '11', '01', 'Jaco');
INSERT INTO `sis_distrito` VALUES ('6', '11', '02', 'Tarcoles');
INSERT INTO `sis_distrito` VALUES ('7', '01', '01', 'Limon');
INSERT INTO `sis_distrito` VALUES ('7', '01', '02', 'Valle La Estrella');
INSERT INTO `sis_distrito` VALUES ('7', '01', '03', 'Rio Blanco');
INSERT INTO `sis_distrito` VALUES ('7', '01', '04', 'Matama');
INSERT INTO `sis_distrito` VALUES ('7', '02', '01', 'Guapiles');
INSERT INTO `sis_distrito` VALUES ('7', '02', '02', 'Jimenez');
INSERT INTO `sis_distrito` VALUES ('7', '02', '03', 'Rita');
INSERT INTO `sis_distrito` VALUES ('7', '02', '04', 'Roxana');
INSERT INTO `sis_distrito` VALUES ('7', '02', '05', 'Cariari');
INSERT INTO `sis_distrito` VALUES ('7', '02', '06', 'Colorado');
INSERT INTO `sis_distrito` VALUES ('7', '03', '01', 'Siquirres');
INSERT INTO `sis_distrito` VALUES ('7', '03', '02', 'Pacuarito');
INSERT INTO `sis_distrito` VALUES ('7', '03', '03', 'Florida');
INSERT INTO `sis_distrito` VALUES ('7', '03', '04', 'Germania');
INSERT INTO `sis_distrito` VALUES ('7', '03', '05', 'Cairo');
INSERT INTO `sis_distrito` VALUES ('7', '03', '06', 'Alegria');
INSERT INTO `sis_distrito` VALUES ('7', '04', '01', 'Bratsi');
INSERT INTO `sis_distrito` VALUES ('7', '04', '02', 'Sixaola');
INSERT INTO `sis_distrito` VALUES ('7', '04', '03', 'Cahuita');
INSERT INTO `sis_distrito` VALUES ('7', '04', '04', 'Telire');
INSERT INTO `sis_distrito` VALUES ('7', '05', '01', 'Matina');
INSERT INTO `sis_distrito` VALUES ('7', '05', '02', 'Battan');
INSERT INTO `sis_distrito` VALUES ('7', '05', '03', 'Carrandi');
INSERT INTO `sis_distrito` VALUES ('7', '06', '01', 'Guacimo');
INSERT INTO `sis_distrito` VALUES ('7', '06', '02', 'Mercedes');
INSERT INTO `sis_distrito` VALUES ('7', '06', '03', 'Pocora');
INSERT INTO `sis_distrito` VALUES ('7', '06', '04', 'Rio Jimenez');
INSERT INTO `sis_distrito` VALUES ('7', '06', '05', 'Duacari');

-- ----------------------------
-- Table structure for sis_log
-- ----------------------------
DROP TABLE IF EXISTS `sis_log`;
CREATE TABLE `sis_log` (
  `id_bi` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador para bitacora',
  `id_user` varchar(20) DEFAULT NULL,
  `date_bi` datetime DEFAULT NULL,
  `detail` blob,
  PRIMARY KEY (`id_bi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sis_log
-- ----------------------------

-- ----------------------------
-- Table structure for sis_login
-- ----------------------------
DROP TABLE IF EXISTS `sis_login`;
CREATE TABLE `sis_login` (
  `id` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `id_roll` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_roll_user` (`id_roll`),
  CONSTRAINT `fk_roll_user` FOREIGN KEY (`id_roll`) REFERENCES `sis_rolls` (`id_roll`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sis_login
-- ----------------------------
INSERT INTO `sis_login` VALUES ('112170040', 'd41d8cd98f00b204e9800998ecf8427e', '1');
INSERT INTO `sis_login` VALUES ('116650288', 'd41d8cd98f00b204e9800998ecf8427e', '2');
INSERT INTO `sis_login` VALUES ('402340420', 'd41d8cd98f00b204e9800998ecf8427e', '2');

-- ----------------------------
-- Table structure for sis_mod
-- ----------------------------
DROP TABLE IF EXISTS `sis_mod`;
CREATE TABLE `sis_mod` (
  `id_mod` int(11) NOT NULL AUTO_INCREMENT,
  `mod_name` varchar(100) DEFAULT NULL,
  `mod_desc` varchar(500) DEFAULT NULL,
  `active` varchar(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_mod`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sis_mod
-- ----------------------------
INSERT INTO `sis_mod` VALUES ('1', 'Administración', 'Administración del sistema', '1');
INSERT INTO `sis_mod` VALUES ('2', 'Roles', 'Permite el acceso al modulo de roles para el sistema', '1');
INSERT INTO `sis_mod` VALUES ('3', 'Usuarios', 'Controla los usuarios del sistema', '1');

-- ----------------------------
-- Table structure for sis_mod_actions
-- ----------------------------
DROP TABLE IF EXISTS `sis_mod_actions`;
CREATE TABLE `sis_mod_actions` (
  `id_action` int(11) NOT NULL AUTO_INCREMENT,
  `action_name` varchar(100) DEFAULT NULL,
  `action_desc` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id_action`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sis_mod_actions
-- ----------------------------
INSERT INTO `sis_mod_actions` VALUES ('1', 'Ver', 'Ver elementos del modulo');
INSERT INTO `sis_mod_actions` VALUES ('2', 'Listar', 'Listar elementos del modulo');
INSERT INTO `sis_mod_actions` VALUES ('3', 'Añadir', 'Añade elementos del modulo');
INSERT INTO `sis_mod_actions` VALUES ('4', 'Editar', 'Modifica elmentos del modulo');
INSERT INTO `sis_mod_actions` VALUES ('5', 'Eliminar', 'Elimina elementos del modulo');
INSERT INTO `sis_mod_actions` VALUES ('6', 'Imprimir', 'Permite imprimir elementos del modulo');

-- ----------------------------
-- Table structure for sis_paises
-- ----------------------------
DROP TABLE IF EXISTS `sis_paises`;
CREATE TABLE `sis_paises` (
  `id_pais` int(16) NOT NULL AUTO_INCREMENT,
  `iso` varchar(10) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_pais`)
) ENGINE=InnoDB AUTO_INCREMENT=241 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sis_paises
-- ----------------------------
INSERT INTO `sis_paises` VALUES ('1', 'AF', 'Afganistán');
INSERT INTO `sis_paises` VALUES ('2', 'AX', 'Islas Gland');
INSERT INTO `sis_paises` VALUES ('3', 'AL', 'Albania');
INSERT INTO `sis_paises` VALUES ('4', 'DE', 'Alemania');
INSERT INTO `sis_paises` VALUES ('5', 'AD', 'Andorra');
INSERT INTO `sis_paises` VALUES ('6', 'AO', 'Angola');
INSERT INTO `sis_paises` VALUES ('7', 'AI', 'Anguilla');
INSERT INTO `sis_paises` VALUES ('8', 'AQ', 'Antártida');
INSERT INTO `sis_paises` VALUES ('9', 'AG', 'Antigua y Barbuda');
INSERT INTO `sis_paises` VALUES ('10', 'AN', 'Antillas Holandesas');
INSERT INTO `sis_paises` VALUES ('11', 'SA', 'Arabia Saudí');
INSERT INTO `sis_paises` VALUES ('12', 'DZ', 'Argelia');
INSERT INTO `sis_paises` VALUES ('13', 'AR', 'Argentina');
INSERT INTO `sis_paises` VALUES ('14', 'AM', 'Armenia');
INSERT INTO `sis_paises` VALUES ('15', 'AW', 'Aruba');
INSERT INTO `sis_paises` VALUES ('16', 'AU', 'Australia');
INSERT INTO `sis_paises` VALUES ('17', 'AT', 'Austria');
INSERT INTO `sis_paises` VALUES ('18', 'AZ', 'Azerbaiyán');
INSERT INTO `sis_paises` VALUES ('19', 'BS', 'Bahamas');
INSERT INTO `sis_paises` VALUES ('20', 'BH', 'Bahréin');
INSERT INTO `sis_paises` VALUES ('21', 'BD', 'Bangladesh');
INSERT INTO `sis_paises` VALUES ('22', 'BB', 'Barbados');
INSERT INTO `sis_paises` VALUES ('23', 'BY', 'Bielorrusia');
INSERT INTO `sis_paises` VALUES ('24', 'BE', 'Bélgica');
INSERT INTO `sis_paises` VALUES ('25', 'BZ', 'Belice');
INSERT INTO `sis_paises` VALUES ('26', 'BJ', 'Benin');
INSERT INTO `sis_paises` VALUES ('27', 'BM', 'Bermudas');
INSERT INTO `sis_paises` VALUES ('28', 'BT', 'Bhután');
INSERT INTO `sis_paises` VALUES ('29', 'BO', 'Bolivia');
INSERT INTO `sis_paises` VALUES ('30', 'BA', 'Bosnia y Herzegovina');
INSERT INTO `sis_paises` VALUES ('31', 'BW', 'Botsuana');
INSERT INTO `sis_paises` VALUES ('32', 'BV', 'Isla Bouvet');
INSERT INTO `sis_paises` VALUES ('33', 'BR', 'Brasil');
INSERT INTO `sis_paises` VALUES ('34', 'BN', 'Brunéi');
INSERT INTO `sis_paises` VALUES ('35', 'BG', 'Bulgaria');
INSERT INTO `sis_paises` VALUES ('36', 'BF', 'Burkina Faso');
INSERT INTO `sis_paises` VALUES ('37', 'BI', 'Burundi');
INSERT INTO `sis_paises` VALUES ('38', 'CV', 'Cabo Verde');
INSERT INTO `sis_paises` VALUES ('39', 'KY', 'Islas Caimán');
INSERT INTO `sis_paises` VALUES ('40', 'KH', 'Camboya');
INSERT INTO `sis_paises` VALUES ('41', 'CM', 'Camerún');
INSERT INTO `sis_paises` VALUES ('42', 'CA', 'Canadá');
INSERT INTO `sis_paises` VALUES ('43', 'CF', 'República Centroafricana');
INSERT INTO `sis_paises` VALUES ('44', 'TD', 'Chad');
INSERT INTO `sis_paises` VALUES ('45', 'CZ', 'República Checa');
INSERT INTO `sis_paises` VALUES ('46', 'CL', 'Chile');
INSERT INTO `sis_paises` VALUES ('47', 'CN', 'China');
INSERT INTO `sis_paises` VALUES ('48', 'CY', 'Chipre');
INSERT INTO `sis_paises` VALUES ('49', 'CX', 'Isla de Navidad');
INSERT INTO `sis_paises` VALUES ('50', 'VA', 'Ciudad del Vaticano');
INSERT INTO `sis_paises` VALUES ('51', 'CC', 'Islas Cocos');
INSERT INTO `sis_paises` VALUES ('52', 'CO', 'Colombia');
INSERT INTO `sis_paises` VALUES ('53', 'KM', 'Comoras');
INSERT INTO `sis_paises` VALUES ('54', 'CD', 'República Democrática del Congo');
INSERT INTO `sis_paises` VALUES ('55', 'CG', 'Congo');
INSERT INTO `sis_paises` VALUES ('56', 'CK', 'Islas Cook');
INSERT INTO `sis_paises` VALUES ('57', 'KP', 'Corea del Norte');
INSERT INTO `sis_paises` VALUES ('58', 'KR', 'Corea del Sur');
INSERT INTO `sis_paises` VALUES ('59', 'CI', 'Costa de Marfil');
INSERT INTO `sis_paises` VALUES ('60', 'CR', 'Costa Rica');
INSERT INTO `sis_paises` VALUES ('61', 'HR', 'Croacia');
INSERT INTO `sis_paises` VALUES ('62', 'CU', 'Cuba');
INSERT INTO `sis_paises` VALUES ('63', 'DK', 'Dinamarca');
INSERT INTO `sis_paises` VALUES ('64', 'DM', 'Dominica');
INSERT INTO `sis_paises` VALUES ('65', 'DO', 'República Dominicana');
INSERT INTO `sis_paises` VALUES ('66', 'EC', 'Ecuador');
INSERT INTO `sis_paises` VALUES ('67', 'EG', 'Egipto');
INSERT INTO `sis_paises` VALUES ('68', 'SV', 'El Salvador');
INSERT INTO `sis_paises` VALUES ('69', 'AE', 'Emiratos Árabes Unidos');
INSERT INTO `sis_paises` VALUES ('70', 'ER', 'Eritrea');
INSERT INTO `sis_paises` VALUES ('71', 'SK', 'Eslovaquia');
INSERT INTO `sis_paises` VALUES ('72', 'SI', 'Eslovenia');
INSERT INTO `sis_paises` VALUES ('73', 'ES', 'España');
INSERT INTO `sis_paises` VALUES ('74', 'UM', 'Islas ultramarinas de Estados Unidos');
INSERT INTO `sis_paises` VALUES ('75', 'US', 'Estados Unidos');
INSERT INTO `sis_paises` VALUES ('76', 'EE', 'Estonia');
INSERT INTO `sis_paises` VALUES ('77', 'ET', 'Etiopía');
INSERT INTO `sis_paises` VALUES ('78', 'FO', 'Islas Feroe');
INSERT INTO `sis_paises` VALUES ('79', 'PH', 'Filipinas');
INSERT INTO `sis_paises` VALUES ('80', 'FI', 'Finlandia');
INSERT INTO `sis_paises` VALUES ('81', 'FJ', 'Fiyi');
INSERT INTO `sis_paises` VALUES ('82', 'FR', 'Francia');
INSERT INTO `sis_paises` VALUES ('83', 'GA', 'Gabón');
INSERT INTO `sis_paises` VALUES ('84', 'GM', 'Gambia');
INSERT INTO `sis_paises` VALUES ('85', 'GE', 'Georgia');
INSERT INTO `sis_paises` VALUES ('86', 'GS', 'Islas Georgias del Sur y Sandwich del Sur');
INSERT INTO `sis_paises` VALUES ('87', 'GH', 'Ghana');
INSERT INTO `sis_paises` VALUES ('88', 'GI', 'Gibraltar');
INSERT INTO `sis_paises` VALUES ('89', 'GD', 'Granada');
INSERT INTO `sis_paises` VALUES ('90', 'GR', 'Grecia');
INSERT INTO `sis_paises` VALUES ('91', 'GL', 'Groenlandia');
INSERT INTO `sis_paises` VALUES ('92', 'GP', 'Guadalupe');
INSERT INTO `sis_paises` VALUES ('93', 'GU', 'Guam');
INSERT INTO `sis_paises` VALUES ('94', 'GT', 'Guatemala');
INSERT INTO `sis_paises` VALUES ('95', 'GF', 'Guayana Francesa');
INSERT INTO `sis_paises` VALUES ('96', 'GN', 'Guinea');
INSERT INTO `sis_paises` VALUES ('97', 'GQ', 'Guinea Ecuatorial');
INSERT INTO `sis_paises` VALUES ('98', 'GW', 'Guinea-Bissau');
INSERT INTO `sis_paises` VALUES ('99', 'GY', 'Guyana');
INSERT INTO `sis_paises` VALUES ('100', 'HT', 'Haití');
INSERT INTO `sis_paises` VALUES ('101', 'HM', 'Islas Heard y McDonald');
INSERT INTO `sis_paises` VALUES ('102', 'HN', 'Honduras');
INSERT INTO `sis_paises` VALUES ('103', 'HK', 'Hong Kong');
INSERT INTO `sis_paises` VALUES ('104', 'HU', 'Hungría');
INSERT INTO `sis_paises` VALUES ('105', 'IN', 'India');
INSERT INTO `sis_paises` VALUES ('106', 'ID', 'Indonesia');
INSERT INTO `sis_paises` VALUES ('107', 'IR', 'Irán');
INSERT INTO `sis_paises` VALUES ('108', 'IQ', 'Iraq');
INSERT INTO `sis_paises` VALUES ('109', 'IE', 'Irlanda');
INSERT INTO `sis_paises` VALUES ('110', 'IS', 'Islandia');
INSERT INTO `sis_paises` VALUES ('111', 'IL', 'Israel');
INSERT INTO `sis_paises` VALUES ('112', 'IT', 'Italia');
INSERT INTO `sis_paises` VALUES ('113', 'JM', 'Jamaica');
INSERT INTO `sis_paises` VALUES ('114', 'JP', 'Japón');
INSERT INTO `sis_paises` VALUES ('115', 'JO', 'Jordania');
INSERT INTO `sis_paises` VALUES ('116', 'KZ', 'Kazajstán');
INSERT INTO `sis_paises` VALUES ('117', 'KE', 'Kenia');
INSERT INTO `sis_paises` VALUES ('118', 'KG', 'Kirguistán');
INSERT INTO `sis_paises` VALUES ('119', 'KI', 'Kiribati');
INSERT INTO `sis_paises` VALUES ('120', 'KW', 'Kuwait');
INSERT INTO `sis_paises` VALUES ('121', 'LA', 'Laos');
INSERT INTO `sis_paises` VALUES ('122', 'LS', 'Lesotho');
INSERT INTO `sis_paises` VALUES ('123', 'LV', 'Letonia');
INSERT INTO `sis_paises` VALUES ('124', 'LB', 'Líbano');
INSERT INTO `sis_paises` VALUES ('125', 'LR', 'Liberia');
INSERT INTO `sis_paises` VALUES ('126', 'LY', 'Libia');
INSERT INTO `sis_paises` VALUES ('127', 'LI', 'Liechtenstein');
INSERT INTO `sis_paises` VALUES ('128', 'LT', 'Lituania');
INSERT INTO `sis_paises` VALUES ('129', 'LU', 'Luxemburgo');
INSERT INTO `sis_paises` VALUES ('130', 'MO', 'Macao');
INSERT INTO `sis_paises` VALUES ('131', 'MK', 'ARY Macedonia');
INSERT INTO `sis_paises` VALUES ('132', 'MG', 'Madagascar');
INSERT INTO `sis_paises` VALUES ('133', 'MY', 'Malasia');
INSERT INTO `sis_paises` VALUES ('134', 'MW', 'Malawi');
INSERT INTO `sis_paises` VALUES ('135', 'MV', 'Maldivas');
INSERT INTO `sis_paises` VALUES ('136', 'ML', 'Malí');
INSERT INTO `sis_paises` VALUES ('137', 'MT', 'Malta');
INSERT INTO `sis_paises` VALUES ('138', 'FK', 'Islas Malvinas');
INSERT INTO `sis_paises` VALUES ('139', 'MP', 'Islas Marianas del Norte');
INSERT INTO `sis_paises` VALUES ('140', 'MA', 'Marruecos');
INSERT INTO `sis_paises` VALUES ('141', 'MH', 'Islas Marshall');
INSERT INTO `sis_paises` VALUES ('142', 'MQ', 'Martinica');
INSERT INTO `sis_paises` VALUES ('143', 'MU', 'Mauricio');
INSERT INTO `sis_paises` VALUES ('144', 'MR', 'Mauritania');
INSERT INTO `sis_paises` VALUES ('145', 'YT', 'Mayotte');
INSERT INTO `sis_paises` VALUES ('146', 'MX', 'México');
INSERT INTO `sis_paises` VALUES ('147', 'FM', 'Micronesia');
INSERT INTO `sis_paises` VALUES ('148', 'MD', 'Moldavia');
INSERT INTO `sis_paises` VALUES ('149', 'MC', 'Mónaco');
INSERT INTO `sis_paises` VALUES ('150', 'MN', 'Mongolia');
INSERT INTO `sis_paises` VALUES ('151', 'MS', 'Montserrat');
INSERT INTO `sis_paises` VALUES ('152', 'MZ', 'Mozambique');
INSERT INTO `sis_paises` VALUES ('153', 'MM', 'Myanmar');
INSERT INTO `sis_paises` VALUES ('154', 'NA', 'Namibia');
INSERT INTO `sis_paises` VALUES ('155', 'NR', 'Nauru');
INSERT INTO `sis_paises` VALUES ('156', 'NP', 'Nepal');
INSERT INTO `sis_paises` VALUES ('157', 'NI', 'Nicaragua');
INSERT INTO `sis_paises` VALUES ('158', 'NE', 'Níger');
INSERT INTO `sis_paises` VALUES ('159', 'NG', 'Nigeria');
INSERT INTO `sis_paises` VALUES ('160', 'NU', 'Niue');
INSERT INTO `sis_paises` VALUES ('161', 'NF', 'Isla Norfolk');
INSERT INTO `sis_paises` VALUES ('162', 'NO', 'Noruega');
INSERT INTO `sis_paises` VALUES ('163', 'NC', 'Nueva Caledonia');
INSERT INTO `sis_paises` VALUES ('164', 'NZ', 'Nueva Zelanda');
INSERT INTO `sis_paises` VALUES ('165', 'OM', 'Omán');
INSERT INTO `sis_paises` VALUES ('166', 'NL', 'Países Bajos');
INSERT INTO `sis_paises` VALUES ('167', 'PK', 'Pakistán');
INSERT INTO `sis_paises` VALUES ('168', 'PW', 'Palau');
INSERT INTO `sis_paises` VALUES ('169', 'PS', 'Palestina');
INSERT INTO `sis_paises` VALUES ('170', 'PA', 'Panamá');
INSERT INTO `sis_paises` VALUES ('171', 'PG', 'Papúa Nueva Guinea');
INSERT INTO `sis_paises` VALUES ('172', 'PY', 'Paraguay');
INSERT INTO `sis_paises` VALUES ('173', 'PE', 'Perú');
INSERT INTO `sis_paises` VALUES ('174', 'PN', 'Islas Pitcairn');
INSERT INTO `sis_paises` VALUES ('175', 'PF', 'Polinesia Francesa');
INSERT INTO `sis_paises` VALUES ('176', 'PL', 'Polonia');
INSERT INTO `sis_paises` VALUES ('177', 'PT', 'Portugal');
INSERT INTO `sis_paises` VALUES ('178', 'PR', 'Puerto Rico');
INSERT INTO `sis_paises` VALUES ('179', 'QA', 'Qatar');
INSERT INTO `sis_paises` VALUES ('180', 'GB', 'Reino Unido');
INSERT INTO `sis_paises` VALUES ('181', 'RE', 'Reunión');
INSERT INTO `sis_paises` VALUES ('182', 'RW', 'Ruanda');
INSERT INTO `sis_paises` VALUES ('183', 'RO', 'Rumania');
INSERT INTO `sis_paises` VALUES ('184', 'RU', 'Rusia');
INSERT INTO `sis_paises` VALUES ('185', 'EH', 'Sahara Occidental');
INSERT INTO `sis_paises` VALUES ('186', 'SB', 'Islas Salomón');
INSERT INTO `sis_paises` VALUES ('187', 'WS', 'Samoa');
INSERT INTO `sis_paises` VALUES ('188', 'AS', 'Samoa Americana');
INSERT INTO `sis_paises` VALUES ('189', 'KN', 'San Cristóbal y Nevis');
INSERT INTO `sis_paises` VALUES ('190', 'SM', 'San Marino');
INSERT INTO `sis_paises` VALUES ('191', 'PM', 'San Pedro y Miquelón');
INSERT INTO `sis_paises` VALUES ('192', 'VC', 'San Vicente y las Granadinas');
INSERT INTO `sis_paises` VALUES ('193', 'SH', 'Santa Helena');
INSERT INTO `sis_paises` VALUES ('194', 'LC', 'Santa Lucía');
INSERT INTO `sis_paises` VALUES ('195', 'ST', 'Santo Tomé y Príncipe');
INSERT INTO `sis_paises` VALUES ('196', 'SN', 'Senegal');
INSERT INTO `sis_paises` VALUES ('197', 'CS', 'Serbia y Montenegro');
INSERT INTO `sis_paises` VALUES ('198', 'SC', 'Seychelles');
INSERT INTO `sis_paises` VALUES ('199', 'SL', 'Sierra Leona');
INSERT INTO `sis_paises` VALUES ('200', 'SG', 'Singapur');
INSERT INTO `sis_paises` VALUES ('201', 'SY', 'Siria');
INSERT INTO `sis_paises` VALUES ('202', 'SO', 'Somalia');
INSERT INTO `sis_paises` VALUES ('203', 'LK', 'Sri Lanka');
INSERT INTO `sis_paises` VALUES ('204', 'SZ', 'Suazilandia');
INSERT INTO `sis_paises` VALUES ('205', 'ZA', 'Sudáfrica');
INSERT INTO `sis_paises` VALUES ('206', 'SD', 'Sudán');
INSERT INTO `sis_paises` VALUES ('207', 'SE', 'Suecia');
INSERT INTO `sis_paises` VALUES ('208', 'CH', 'Suiza');
INSERT INTO `sis_paises` VALUES ('209', 'SR', 'Surinam');
INSERT INTO `sis_paises` VALUES ('210', 'SJ', 'Svalbard y Jan Mayen');
INSERT INTO `sis_paises` VALUES ('211', 'TH', 'Tailandia');
INSERT INTO `sis_paises` VALUES ('212', 'TW', 'Taiwán');
INSERT INTO `sis_paises` VALUES ('213', 'TZ', 'Tanzania');
INSERT INTO `sis_paises` VALUES ('214', 'TJ', 'Tayikistán');
INSERT INTO `sis_paises` VALUES ('215', 'IO', 'Territorio Británico del Océano Índico');
INSERT INTO `sis_paises` VALUES ('216', 'TF', 'Territorios Australes Franceses');
INSERT INTO `sis_paises` VALUES ('217', 'TL', 'Timor Oriental');
INSERT INTO `sis_paises` VALUES ('218', 'TG', 'Togo');
INSERT INTO `sis_paises` VALUES ('219', 'TK', 'Tokelau');
INSERT INTO `sis_paises` VALUES ('220', 'TO', 'Tonga');
INSERT INTO `sis_paises` VALUES ('221', 'TT', 'Trinidad y Tobago');
INSERT INTO `sis_paises` VALUES ('222', 'TN', 'Túnez');
INSERT INTO `sis_paises` VALUES ('223', 'TC', 'Islas Turcas y Caicos');
INSERT INTO `sis_paises` VALUES ('224', 'TM', 'Turkmenistán');
INSERT INTO `sis_paises` VALUES ('225', 'TR', 'Turquía');
INSERT INTO `sis_paises` VALUES ('226', 'TV', 'Tuvalu');
INSERT INTO `sis_paises` VALUES ('227', 'UA', 'Ucrania');
INSERT INTO `sis_paises` VALUES ('228', 'UG', 'Uganda');
INSERT INTO `sis_paises` VALUES ('229', 'UY', 'Uruguay');
INSERT INTO `sis_paises` VALUES ('230', 'UZ', 'Uzbekistán');
INSERT INTO `sis_paises` VALUES ('231', 'VU', 'Vanuatu');
INSERT INTO `sis_paises` VALUES ('232', 'VE', 'Venezuela');
INSERT INTO `sis_paises` VALUES ('233', 'VN', 'Vietnam');
INSERT INTO `sis_paises` VALUES ('234', 'VG', 'Islas Vírgenes Británicas');
INSERT INTO `sis_paises` VALUES ('235', 'VI', 'Islas Vírgenes de los Estados Unidos');
INSERT INTO `sis_paises` VALUES ('236', 'WF', 'Wallis y Futuna');
INSERT INTO `sis_paises` VALUES ('237', 'YE', 'Yemen');
INSERT INTO `sis_paises` VALUES ('238', 'DJ', 'Yibuti');
INSERT INTO `sis_paises` VALUES ('239', 'ZM', 'Zambia');
INSERT INTO `sis_paises` VALUES ('240', 'ZW', 'Zimbabue');

-- ----------------------------
-- Table structure for sis_parametros_varios
-- ----------------------------
DROP TABLE IF EXISTS `sis_parametros_varios`;
CREATE TABLE `sis_parametros_varios` (
  `id_pv` int(16) NOT NULL AUTO_INCREMENT,
  `parametro` varchar(50) DEFAULT NULL COMMENT 'Nombre del parametro',
  `valor` varchar(100) DEFAULT NULL COMMENT 'Valor del parametro',
  `descripcion` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id_pv`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabla para almacenar parametros varios';

-- ----------------------------
-- Records of sis_parametros_varios
-- ----------------------------

-- ----------------------------
-- Table structure for sis_permits
-- ----------------------------
DROP TABLE IF EXISTS `sis_permits`;
CREATE TABLE `sis_permits` (
  `id_permit` int(11) NOT NULL AUTO_INCREMENT,
  `id_mod` int(11) NOT NULL,
  `id_action` int(11) NOT NULL,
  `id_roll` int(11) NOT NULL,
  PRIMARY KEY (`id_permit`),
  KEY `fk_mod` (`id_mod`),
  KEY `fk_mod_action` (`id_action`),
  KEY `fk_roll` (`id_roll`),
  CONSTRAINT `fk_mod` FOREIGN KEY (`id_mod`) REFERENCES `sis_mod` (`id_mod`),
  CONSTRAINT `fk_mod_action` FOREIGN KEY (`id_action`) REFERENCES `sis_mod_actions` (`id_action`),
  CONSTRAINT `fk_roll` FOREIGN KEY (`id_roll`) REFERENCES `sis_rolls` (`id_roll`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sis_permits
-- ----------------------------
INSERT INTO `sis_permits` VALUES ('1', '1', '1', '2');
INSERT INTO `sis_permits` VALUES ('2', '1', '2', '2');
INSERT INTO `sis_permits` VALUES ('3', '1', '3', '2');
INSERT INTO `sis_permits` VALUES ('4', '1', '4', '2');
INSERT INTO `sis_permits` VALUES ('5', '1', '5', '2');
INSERT INTO `sis_permits` VALUES ('6', '1', '6', '2');
INSERT INTO `sis_permits` VALUES ('7', '2', '1', '2');
INSERT INTO `sis_permits` VALUES ('8', '2', '2', '2');
INSERT INTO `sis_permits` VALUES ('9', '2', '3', '2');
INSERT INTO `sis_permits` VALUES ('10', '2', '4', '2');
INSERT INTO `sis_permits` VALUES ('11', '2', '5', '2');
INSERT INTO `sis_permits` VALUES ('12', '2', '6', '2');
INSERT INTO `sis_permits` VALUES ('13', '3', '1', '2');
INSERT INTO `sis_permits` VALUES ('14', '3', '2', '2');
INSERT INTO `sis_permits` VALUES ('15', '3', '3', '2');
INSERT INTO `sis_permits` VALUES ('16', '3', '4', '2');
INSERT INTO `sis_permits` VALUES ('17', '3', '5', '2');
INSERT INTO `sis_permits` VALUES ('18', '3', '6', '2');

-- ----------------------------
-- Table structure for sis_provincia
-- ----------------------------
DROP TABLE IF EXISTS `sis_provincia`;
CREATE TABLE `sis_provincia` (
  `id_prov` varchar(1) NOT NULL DEFAULT '0',
  `desc_prov` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id_prov`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sis_provincia
-- ----------------------------
INSERT INTO `sis_provincia` VALUES ('1', 'San José');
INSERT INTO `sis_provincia` VALUES ('2', 'Alajuela');
INSERT INTO `sis_provincia` VALUES ('3', 'Cartago');
INSERT INTO `sis_provincia` VALUES ('4', 'Heredia');
INSERT INTO `sis_provincia` VALUES ('5', 'Guanacaste');
INSERT INTO `sis_provincia` VALUES ('6', 'Puntarenas');
INSERT INTO `sis_provincia` VALUES ('7', 'Limón');

-- ----------------------------
-- Table structure for sis_rolls
-- ----------------------------
DROP TABLE IF EXISTS `sis_rolls`;
CREATE TABLE `sis_rolls` (
  `id_roll` int(11) NOT NULL AUTO_INCREMENT,
  `roll_name` varchar(100) DEFAULT NULL,
  `roll_desc` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id_roll`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sis_rolls
-- ----------------------------
INSERT INTO `sis_rolls` VALUES ('1', 'SuperAdmin', 'Permisos totales sobre todos los modulos este usuario no encuentra ninguna restricción');
INSERT INTO `sis_rolls` VALUES ('2', 'Administrador', 'Administradores del sistema');

-- ----------------------------
-- Table structure for sis_sessions
-- ----------------------------
DROP TABLE IF EXISTS `sis_sessions`;
CREATE TABLE `sis_sessions` (
  `sid` varchar(100) NOT NULL DEFAULT '',
  `expires` int(11) unsigned NOT NULL DEFAULT '0',
  `forced_expires` int(11) unsigned NOT NULL,
  `ua` varchar(40) NOT NULL DEFAULT '',
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sis_sessions
-- ----------------------------

-- ----------------------------
-- Table structure for sis_sessions_vars
-- ----------------------------
DROP TABLE IF EXISTS `sis_sessions_vars`;
CREATE TABLE `sis_sessions_vars` (
  `name` text NOT NULL,
  `value` text NOT NULL,
  `sid` varchar(100) NOT NULL,
  KEY `sid` (`sid`),
  CONSTRAINT `sis_sessions_vars_ibfk_1` FOREIGN KEY (`sid`) REFERENCES `sis_sessions` (`sid`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sis_sessions_vars
-- ----------------------------

-- ----------------------------
-- Table structure for sis_tipo_tel
-- ----------------------------
DROP TABLE IF EXISTS `sis_tipo_tel`;
CREATE TABLE `sis_tipo_tel` (
  `id_tipo_tel` varchar(1) NOT NULL DEFAULT '',
  `desc_tipo_tel` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_tipo_tel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sis_tipo_tel
-- ----------------------------
INSERT INTO `sis_tipo_tel` VALUES ('C', 'Casa');
INSERT INTO `sis_tipo_tel` VALUES ('F', 'Fax');
INSERT INTO `sis_tipo_tel` VALUES ('M', 'Movil');
INSERT INTO `sis_tipo_tel` VALUES ('T', 'Trabajo');

-- ----------------------------
-- Table structure for sis_ubicaciones
-- ----------------------------
DROP TABLE IF EXISTS `sis_ubicaciones`;
CREATE TABLE `sis_ubicaciones` (
  `id_ub` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identifiacdor unico para ubicacion',
  `desc_ub` varchar(100) DEFAULT NULL COMMENT 'Descripcion de la ubicacion',
  PRIMARY KEY (`id_ub`)
) ENGINE=InnoDB AUTO_INCREMENT=109 DEFAULT CHARSET=utf8 COMMENT='Almacena ubicaciones donde puede estar un elemento de inspección';

-- ----------------------------
-- Records of sis_ubicaciones
-- ----------------------------
INSERT INTO `sis_ubicaciones` VALUES ('1', 'Escuela de Informática');
INSERT INTO `sis_ubicaciones` VALUES ('2', 'Facultad de Filosofía y Letras');
INSERT INTO `sis_ubicaciones` VALUES ('3', 'Escuela de Literatura y Ciencias del Lenguaje');
INSERT INTO `sis_ubicaciones` VALUES ('4', 'Escuela Ecuménica de Ciencias de la Religión');
INSERT INTO `sis_ubicaciones` VALUES ('5', 'Escuela de Filosofía');
INSERT INTO `sis_ubicaciones` VALUES ('6', 'Escuela de Bibliotecología, Documentación e Información');
INSERT INTO `sis_ubicaciones` VALUES ('7', 'Instituto de Estudios Latinoamericanos (IDELA)');
INSERT INTO `sis_ubicaciones` VALUES ('8', 'Instituto de Estudios de la Mujer (IEM)');
INSERT INTO `sis_ubicaciones` VALUES ('9', 'Facultad de Ciencias Sociales');
INSERT INTO `sis_ubicaciones` VALUES ('10', 'Escuela de Historia');
INSERT INTO `sis_ubicaciones` VALUES ('11', 'Escuela de Sociología');
INSERT INTO `sis_ubicaciones` VALUES ('12', 'Escuela de Planificación y Promoción Social');
INSERT INTO `sis_ubicaciones` VALUES ('13', 'Escuela de Secretariado Profesional');
INSERT INTO `sis_ubicaciones` VALUES ('14', 'Escuela de Relaciones Internacionales');
INSERT INTO `sis_ubicaciones` VALUES ('15', 'Escuela de Economía');
INSERT INTO `sis_ubicaciones` VALUES ('16', 'Escuela de Administración');
INSERT INTO `sis_ubicaciones` VALUES ('17', 'Escuela de Psicología');
INSERT INTO `sis_ubicaciones` VALUES ('18', 'Instituto de Estudios Sociales en Población (IDESPO)');
INSERT INTO `sis_ubicaciones` VALUES ('19', 'Centro Internacional de Política Económica (CINPE)');
INSERT INTO `sis_ubicaciones` VALUES ('20', 'Centro Información Documental de Ciencias Sociales');
INSERT INTO `sis_ubicaciones` VALUES ('21', 'Facultad de Tierra y Mar');
INSERT INTO `sis_ubicaciones` VALUES ('22', 'Escuela de Ciencias Agrarias');
INSERT INTO `sis_ubicaciones` VALUES ('23', 'Escuela de Ciencias Ambientales');
INSERT INTO `sis_ubicaciones` VALUES ('24', 'Escuela de Ciencias Geográficas');
INSERT INTO `sis_ubicaciones` VALUES ('25', 'Instituto de Investigación y Servicios Forestales (INISEFOR)');
INSERT INTO `sis_ubicaciones` VALUES ('26', 'Instituto Internacional en Conservación y Manejo de Vida Silvestre (ICOMVIS)');
INSERT INTO `sis_ubicaciones` VALUES ('27', 'Observatorio Vulcanológico y Sismológico de Costa Rica (OVSICORI)');
INSERT INTO `sis_ubicaciones` VALUES ('28', 'Centro de Investigaciones Apícolas Tropicales (CINAT)');
INSERT INTO `sis_ubicaciones` VALUES ('29', 'Instituto Regional de Estudios en Sustancias Tóxicas (IRET)');
INSERT INTO `sis_ubicaciones` VALUES ('30', 'Facultad de Ciencias Exactas y Naturales');
INSERT INTO `sis_ubicaciones` VALUES ('31', 'Escuela de Matemática');
INSERT INTO `sis_ubicaciones` VALUES ('32', 'Escuela de Topografía');
INSERT INTO `sis_ubicaciones` VALUES ('33', 'Escuela de Ciencias Biológicas');
INSERT INTO `sis_ubicaciones` VALUES ('34', 'Escuela de Química');
INSERT INTO `sis_ubicaciones` VALUES ('35', 'Departamento de Física');
INSERT INTO `sis_ubicaciones` VALUES ('37', 'Facultad de Ciencias de la Salud');
INSERT INTO `sis_ubicaciones` VALUES ('38', 'Escuela de Medicina Veterinaria');
INSERT INTO `sis_ubicaciones` VALUES ('39', 'Escuela de Ciencias del Deporte');
INSERT INTO `sis_ubicaciones` VALUES ('40', 'Centro de Estudios Generales');
INSERT INTO `sis_ubicaciones` VALUES ('41', 'Centro de Investigación y Docencia en Educación (CIDE)');
INSERT INTO `sis_ubicaciones` VALUES ('42', 'Centro de Investigación, Docencia y Extensión Artística (CIDEA)');
INSERT INTO `sis_ubicaciones` VALUES ('43', 'Biblioteca Especializada');
INSERT INTO `sis_ubicaciones` VALUES ('44', 'Escuela de Arte Escénico');
INSERT INTO `sis_ubicaciones` VALUES ('45', 'Escuela de Arte y Comunicación Visual');
INSERT INTO `sis_ubicaciones` VALUES ('46', 'Asesoría Jurídica');
INSERT INTO `sis_ubicaciones` VALUES ('47', 'ASOUNA');
INSERT INTO `sis_ubicaciones` VALUES ('48', 'Biblioteca Joaquín García Monge');
INSERT INTO `sis_ubicaciones` VALUES ('49', 'Departamento de Bienestar Estudiantil');
INSERT INTO `sis_ubicaciones` VALUES ('50', 'Carrera Académica');
INSERT INTO `sis_ubicaciones` VALUES ('51', 'Carrera Administrativa');
INSERT INTO `sis_ubicaciones` VALUES ('52', 'Centro de Gestión Informática (CGI)');
INSERT INTO `sis_ubicaciones` VALUES ('53', 'Centro de Gestión Tecnológica (CGT)');
INSERT INTO `sis_ubicaciones` VALUES ('54', 'Centro Mesoamericano de Desarrollo Sostenible del Trópico Seco (CEMEDE)');
INSERT INTO `sis_ubicaciones` VALUES ('55', 'Escuela de Danza');
INSERT INTO `sis_ubicaciones` VALUES ('56', 'Defensoría del Estudiante');
INSERT INTO `sis_ubicaciones` VALUES ('57', 'Dirección de Tecnologías de Información y Comunicación (DTIC)');
INSERT INTO `sis_ubicaciones` VALUES ('58', 'Diseño y Gestión Curricular');
INSERT INTO `sis_ubicaciones` VALUES ('59', 'Dirección de Docencia');
INSERT INTO `sis_ubicaciones` VALUES ('60', 'Dirección de Extensión');
INSERT INTO `sis_ubicaciones` VALUES ('61', 'Federación de Estudiantes (FEUNA)');
INSERT INTO `sis_ubicaciones` VALUES ('62', 'Fondo de Beneficio Social');
INSERT INTO `sis_ubicaciones` VALUES ('63', 'FUNDAUNA');
INSERT INTO `sis_ubicaciones` VALUES ('64', 'Fiscalía Contra el Hostigamiento Sexual');
INSERT INTO `sis_ubicaciones` VALUES ('65', 'Programa de Gestión Financiera');
INSERT INTO `sis_ubicaciones` VALUES ('66', 'Hospital Médico Veterinario');
INSERT INTO `sis_ubicaciones` VALUES ('67', 'Centro de Recursos Hídricos para Centroamérica y el Caribe (HIDROCEC)');
INSERT INTO `sis_ubicaciones` VALUES ('68', 'Programa de Identidad Cultural, Arte y Tecnología (ICAT)');
INSERT INTO `sis_ubicaciones` VALUES ('69', 'Instituto de Estudios Interdisciplinarios de la Niñez y la Adolescencia (INEINA)');
INSERT INTO `sis_ubicaciones` VALUES ('70', 'Instituto Internacional del Océano (IOI)');
INSERT INTO `sis_ubicaciones` VALUES ('71', 'Dirección de Investigación');
INSERT INTO `sis_ubicaciones` VALUES ('72', 'Junta de Becas');
INSERT INTO `sis_ubicaciones` VALUES ('73', 'Junta de Relaciones Laborales');
INSERT INTO `sis_ubicaciones` VALUES ('74', 'Sección de Mantenimiento');
INSERT INTO `sis_ubicaciones` VALUES ('75', 'Departamento de Orientación y Psicología');
INSERT INTO `sis_ubicaciones` VALUES ('76', 'Área de Planeamiento Espacial');
INSERT INTO `sis_ubicaciones` VALUES ('77', 'Área de Planificación Económica');
INSERT INTO `sis_ubicaciones` VALUES ('78', 'Posgrado en Administración de Justicia');
INSERT INTO `sis_ubicaciones` VALUES ('79', 'Posgrado en Gestión de la Tecnología de Información y Comunicación (ProGesTIC)');
INSERT INTO `sis_ubicaciones` VALUES ('80', 'Programa de Estudios de Posgrado en Ciencias Sociales');
INSERT INTO `sis_ubicaciones` VALUES ('81', 'Programa de Evaluación Académica y Desarrollo Profesional');
INSERT INTO `sis_ubicaciones` VALUES ('82', 'Programa Interdisciplinario de Investigación y Gestión del Agua (PRIGA)');
INSERT INTO `sis_ubicaciones` VALUES ('83', 'Programa Medicina Poblacional');
INSERT INTO `sis_ubicaciones` VALUES ('84', 'Programa Regional de Desarrollo Rural');
INSERT INTO `sis_ubicaciones` VALUES ('85', 'Departamento de Promoción Estudiantil');
INSERT INTO `sis_ubicaciones` VALUES ('86', 'Proveeduría');
INSERT INTO `sis_ubicaciones` VALUES ('87', 'Programa de Publicaciones e Impresiones');
INSERT INTO `sis_ubicaciones` VALUES ('88', 'Rectoría');
INSERT INTO `sis_ubicaciones` VALUES ('89', 'Programa de Recursos Humanos');
INSERT INTO `sis_ubicaciones` VALUES ('90', 'Departamento de Registro');
INSERT INTO `sis_ubicaciones` VALUES ('91', 'Oficina de Relaciones Públicas');
INSERT INTO `sis_ubicaciones` VALUES ('92', 'Departamento de Salud');
INSERT INTO `sis_ubicaciones` VALUES ('93', 'Sede Interuniversitaria Alajuela');
INSERT INTO `sis_ubicaciones` VALUES ('94', 'Sede Región Brunca – Pérez Zeledón');
INSERT INTO `sis_ubicaciones` VALUES ('95', 'Sede Región Chorotega');
INSERT INTO `sis_ubicaciones` VALUES ('96', 'Sede Región Huetar Norte y Caribe, Campus Sarapiquí');
INSERT INTO `sis_ubicaciones` VALUES ('97', 'Sede Regional Brunca – Campus Coto');
INSERT INTO `sis_ubicaciones` VALUES ('98', 'Sección de Seguridad Institucional');
INSERT INTO `sis_ubicaciones` VALUES ('99', 'Oficina de Transferencia Tecnológica y Vinculación Externa');
INSERT INTO `sis_ubicaciones` VALUES ('100', 'Sección de Transportes');
INSERT INTO `sis_ubicaciones` VALUES ('101', 'Tribunal Electoral Universitario (TEUNA)');
INSERT INTO `sis_ubicaciones` VALUES ('102', 'Tribunal Estudiantil (TEEUNA)');
INSERT INTO `sis_ubicaciones` VALUES ('103', 'Tribunal Universitario de Apelaciones (TUA)');
INSERT INTO `sis_ubicaciones` VALUES ('104', 'UNA Virtual');
INSERT INTO `sis_ubicaciones` VALUES ('105', 'Programa UNA Campus Sostenible');
INSERT INTO `sis_ubicaciones` VALUES ('106', 'Vicerrectoría Académica');
INSERT INTO `sis_ubicaciones` VALUES ('107', 'Vicerrectoría de Desarrollo');
INSERT INTO `sis_ubicaciones` VALUES ('108', 'Vicerrectoría de Vida Estudiantil');

-- ----------------------------
-- Table structure for sis_user
-- ----------------------------
DROP TABLE IF EXISTS `sis_user`;
CREATE TABLE `sis_user` (
  `id` varchar(50) NOT NULL,
  `nombre` varchar(150) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `id_tipo_tel` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_sis_login_sis_user` FOREIGN KEY (`id`) REFERENCES `sis_login` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sis_user
-- ----------------------------
INSERT INTO `sis_user` VALUES ('112170040', 'AARON CASTILLO ALPIZAR', 'acastil@una.cr', '83419199', 'M');
INSERT INTO `sis_user` VALUES ('116650288', 'FRANCINI CORRALES GARRO', 'francini.corrales.garro@una.cr', '25626354', 'T');
INSERT INTO `sis_user` VALUES ('402340420', 'DANNY VALERIO RAMIREZ', 'danny.valerio.ramirez@una.cr', '25626354', 'T');

-- ----------------------------
-- View structure for vis_user
-- ----------------------------
DROP VIEW IF EXISTS `vis_user`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vis_user` AS select `a`.`id` AS `id`,`b`.`nombre` AS `nombre`,(select `sis_rolls`.`roll_name` from `sis_rolls` where (`sis_rolls`.`id_roll` = `a`.`id_roll`)) AS `roll` from (`sis_login` `a` join `sis_user` `b`) where (`a`.`id` = `b`.`id`) ;

-- ----------------------------
-- Procedure structure for delete_mod
-- ----------------------------
DROP PROCEDURE IF EXISTS `delete_mod`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_mod`(IN `p_id_mod` int,OUT `respuesta` int)
BEGIN







DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET respuesta=0;







START TRANSACTION;



UPDATE sis_mod 



SET  active='0'



WHERE id_mod=p_id_mod;



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
-- Procedure structure for delete_roll
-- ----------------------------
DROP PROCEDURE IF EXISTS `delete_roll`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_roll`(IN `p_id_roll` int)
BEGIN







CALL  delete_roll_permits(p_id_roll);



DELETE FROM sis_rolls



WHERE id_roll=p_id_roll;







END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for delete_roll_permits
-- ----------------------------
DROP PROCEDURE IF EXISTS `delete_roll_permits`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_roll_permits`(IN `p_id_roll` int)
BEGIN







DELETE FROM sis_permits



WHERE id_roll=p_id_roll;







END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for delete_user
-- ----------------------------
DROP PROCEDURE IF EXISTS `delete_user`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_user`(IN `p_id` varchar(50),OUT `res` tinyint unsigned)
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
		DELETE FROM sis_user WHERE id=p_id;
		DELETE FROM sis_login WHERE id=p_id;
	COMMIT;
	-- SUCCESS
	SET res = 0;
END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for exploit
-- ----------------------------
DROP PROCEDURE IF EXISTS `exploit`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `exploit`(INOUT `pcadena` varchar(5000),IN `separador` varchar(1),OUT `vtexto` varchar(5000))
BEGIN



set vtexto = substring(pcadena, 1, instr(pcadena, separador)-1);



set pcadena = substring(pcadena, instr(pcadena, separador)+1);



END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for insert_log
-- ----------------------------
DROP PROCEDURE IF EXISTS `insert_log`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_log`(IN `p_id_user` int,IN `p_detail` blob,OUT `res` tinyint)
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
		INSERT INTO `sis_log`(id_user,date_bi,detail) VALUES (p_id_user,now(),p_detail);
	COMMIT;
	
	-- SUCCESS
	SET res = 0;
END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for insert_mod
-- ----------------------------
DROP PROCEDURE IF EXISTS `insert_mod`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_mod`(IN `p_name_mod` varchar(100),IN `p_desc_mod` varchar(500),OUT `respuesta` int)
BEGIN







DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET respuesta=0;







START TRANSACTION;







INSERT INTO sis_mod (mod_name,mod_desc)



VALUES (p_name_mod,p_desc_mod);



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
-- Procedure structure for insert_roll_permits
-- ----------------------------
DROP PROCEDURE IF EXISTS `insert_roll_permits`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_roll_permits`(IN `p_id_roll` int,IN `p_cadena` varchar(500))
BEGIN



	DECLARE vmodulo varchar(5000);



  DECLARE vpermiso varchar(5000);



  DECLARE vaccion varchar(5000);



  BEGIN



        WHILE (p_cadena != "") DO



            BEGIN



            CALL exploit(p_cadena, 'm', vmodulo);



                WHILE (p_cadena != "" AND instr(substr(p_cadena, 1, if(instr(p_cadena, "m") = 0, instr(concat(p_cadena, "m"), "m")-1, instr(p_cadena, "m")-1)), "a") > 0) DO



                    BEGIN



                        CALL exploit(p_cadena, 'a', vaccion);



                        INSERT INTO sis_permits (id_roll, id_mod, id_action)



                        VALUES (p_id_roll, vmodulo, vaccion);



                    END;



                END WHILE;



            END;



        END WHILE;



    END;



END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for insert_user
-- ----------------------------
DROP PROCEDURE IF EXISTS `insert_user`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_user`(IN `p_id` varchar(50),IN `p_nombre` varchar(150),IN `p_email` varchar(100),IN `p_telefono` varchar(15),IN `p_id_tipo_tel` varchar(1),IN `p_id_roll` int,IN `p_pass` varchar(50),OUT `res` TINYINT  UNSIGNED)
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

	SELECT 	count(a.id) INTO @cantidad FROM sis_user  a, sis_login b WHERE a.id=p_id AND b.id=p_id;
	IF (@cantidad = 0) THEN
		START TRANSACTION;
			INSERT INTO `sis_login`(id, pass, id_roll) VALUES (p_id, p_pass, p_id_roll);
			INSERT INTO `sis_user`(id, nombre, email,telefono, id_tipo_tel) VALUES (p_id, p_nombre, p_email,p_telefono, p_id_tipo_tel);
		COMMIT;
		-- SUCCESS
		SET res = 0;
	ELSE
		-- Existe usuario
		SET res = 3;
	END IF;
END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for update_mod
-- ----------------------------
DROP PROCEDURE IF EXISTS `update_mod`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_mod`(IN `p_id_mod` int,IN `p_mod_name` varchar(100),IN `p_mod_desc` varchar(500),OUT `respuesta` int)
BEGIN







DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET respuesta=0;







START TRANSACTION;



UPDATE sis_mod 



SET  mod_name=p_mod_name,



         mod_desc=p_mod_desc



WHERE id_mod=p_id_mod;



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
-- Procedure structure for update_perfil
-- ----------------------------
DROP PROCEDURE IF EXISTS `update_perfil`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_perfil`(IN `p_id` varchar(50),IN `p_email` varchar(100),IN `p_telefono` varchar(15),IN `p_id_tipo_tel` varchar(1),IN `p_pass` varchar(50),OUT `res` TINYINT  UNSIGNED)
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
		UPDATE `sis_login`
		SET pass = p_pass
		WHERE id=P_id;
		UPDATE `sis_user`
		SET email = p_email,
						telefono = p_telefono,
						id_tipo_tel = p_id_tipo_tel
		WHERE id=P_id;
	COMMIT;
	-- SUCCESS
	SET res = 0;
END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for update_roll
-- ----------------------------
DROP PROCEDURE IF EXISTS `update_roll`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_roll`(IN `p_id_roll` int,IN `p_roll_name` varchar(100),IN `p_roll_desc` varchar(500),OUT `respuesta` int)
BEGIN







DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET respuesta=0;







START TRANSACTION;



UPDATE sis_rolls 



SET  roll_name=p_roll_name,



         roll_desc=p_roll_desc



WHERE id_roll=p_id_roll;



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
-- Procedure structure for update_user
-- ----------------------------
DROP PROCEDURE IF EXISTS `update_user`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_user`(IN `p_id` varchar(50),IN `p_nombre` varchar(150),IN `p_email` varchar(100),IN `p_telefono` varchar(15),IN `p_id_tipo_tel` varchar(1),IN `p_id_roll` int,OUT `res` TINYINT  UNSIGNED)
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
		UPDATE `sis_login`
		SET id_roll = p_id_roll
		WHERE id=P_id;
		UPDATE `sis_user`
		SET nombre = p_nombre,
						email = p_email,
						telefono = p_telefono,
						id_tipo_tel = p_id_tipo_tel
		WHERE id=P_id;
	COMMIT;
	-- SUCCESS
	SET res = 0;
END
;;
DELIMITER ;

-- ----------------------------
-- Function structure for check_permits
-- ----------------------------
DROP FUNCTION IF EXISTS `check_permits`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `check_permits`(`p_id_mod` int,`p_id_action` int,`p_id_roll` int) RETURNS int(1)
BEGIN

	DECLARE 

		li_out int(1);

	IF(p_id_roll=1) THEN

		RETURN 1;

	ELSE

		SELECT COUNT(id_roll) INTO li_out

		FROM sis_permits 

		WHERE id_mod = p_id_mod

			AND id_action = p_id_action

			AND id_roll = p_id_roll ;

		RETURN li_out;

	END IF;

END
;;
DELIMITER ;

-- ----------------------------
-- Function structure for checklogin
-- ----------------------------
DROP FUNCTION IF EXISTS `checklogin`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `checklogin`(`p_id` varchar(50),`p_pass` varchar(50)) RETURNS int(1)
BEGIN
	DECLARE
		li_out int(1);
	DECLARE
		li_user int(1);
	DECLARE
		li_pass int(1);
	BEGIN
		SELECT count(id) INTO li_user
		FROM sis_login
		WHERE id = p_id;
	END;
	BEGIN
		SELECT count(id) INTO li_pass
		FROM sis_login
		WHERE id = p_id
			AND pass = p_pass;
	END;
	IF(li_user=0) THEN
		SET li_out =2; -- noexiste usuario
	ELSE 
		IF (li_pass=0) THEN
			SET li_out =1; -- pass erroneo
		ELSE
			SET li_out = 0; -- todo está bien
		END IF;
	END IF;
	RETURN li_out;
END
;;
DELIMITER ;

-- ----------------------------
-- Function structure for insert_roll
-- ----------------------------
DROP FUNCTION IF EXISTS `insert_roll`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `insert_roll`(`p_roll_name` varchar(100),`p_roll_desc` varchar(500)) RETURNS int(11)
BEGIN



	DECLARE



		li_out int(11);



	



		INSERT INTO sis_rolls (roll_name,roll_desc)



		VALUES (p_roll_name,p_roll_desc);



		SELECT ROW_COUNT() INTO li_out;







		IF (li_out=1) THEN



			SELECT IF(id_roll = '', 0, id_roll) INTO li_out



			FROM sis_rolls



			WHERE roll_name = p_roll_name



				AND roll_desc= p_roll_desc;



		ELSE



			SET li_out=0;



		END IF;







	RETURN li_out;



END
;;
DELIMITER ;
