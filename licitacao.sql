/*
Navicat MySQL Data Transfer

Source Server         : Conexao
Source Server Version : 50537
Source Host           : localhost:3306
Source Database       : licitacao

Target Server Type    : MYSQL
Target Server Version : 50537
File Encoding         : 65001

Date: 2014-10-20 18:32:32
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for licitacoes
-- ----------------------------
DROP TABLE IF EXISTS `licitacoes`;
CREATE TABLE `licitacoes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `processo` int(20) DEFAULT NULL,
  `modalidade` varchar(255) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `tipo` varchar(255) DEFAULT NULL,
  `julgamento` varchar(255) DEFAULT NULL,
  `objetivo` text,
  `documentacao` text,
  `comunicado` text,
  `ata` text,
  `contrato` text,
  `relatorio` text,
  `data_ini` timestamp NULL DEFAULT NULL,
  `data_end` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of licitacoes
-- ----------------------------
INSERT INTO `licitacoes` VALUES ('1', 'Contratação de empresa para especialização', '123456921', '6', '1', 'Menor Preço', 'Item', 'Contratação de Empresa p/Prest. de serv. especializados, p/Reforma de Balsas em estrutura em Madeira e Metal sobre o Rio Tocantinzinho e o Rio Bagagem.', null, null, null, null, null, '2014-10-20 14:00:00', '2014-10-20 16:00:00');
INSERT INTO `licitacoes` VALUES ('2', 'Aquisição de Gêneros Alimentícios', '254163', '1', '2', 'Menor Preço', 'Item', 'Aquisição de Gêneros Alimentícios Perecíveis Produtos Panificados destinados a atender a Secretaria Municipal de Educação.', null, null, null, null, null, '2014-10-21 12:10:32', '2014-10-21 15:00:34');
INSERT INTO `licitacoes` VALUES ('3', 'Contração de Servidores', '2014003365', '1', '1', 'Menor Preço', 'Item', 'Contração de Serv. de Locação de Palco, Som, Iluminação, Gerador, Trio Elétrico, Tenda e Cabine Sanitária, destinados a eventos diversos, p/ atender as necessidades da Prefeitura Mun. de Niquelândia, FMMA e SEMAS.', null, null, null, null, null, '2014-10-22 12:12:24', '2014-10-22 14:00:26');
INSERT INTO `licitacoes` VALUES ('4', 'Aquisição de Líquido de Gás ', '2014004730', '1', '1', 'Menor Preço', 'Item', 'Aquisição de Líquido de Gás com 13kg, P- 45kg e Vasilhame de Gás (13kg, destinados a atender as necessidades do Fundo Municipal de Educação.', null, null, null, null, null, '2014-10-23 16:00:55', '2014-10-20 17:00:06');
INSERT INTO `licitacoes` VALUES ('5', 'Aquisição de Equipamentos Hospitalar', '2014003689', '1', '2', 'Menor Preço', 'Item', 'Aquisição de Equipamentos Hospitalar e odontológico p/ atender o Fundo Municipal de Saúde.', 'texto da documentação', null, null, null, null, '2014-10-25 08:00:59', '2014-10-25 09:00:10');
INSERT INTO `licitacoes` VALUES ('6', 'Contração de Empresa Especializada', '2014007548', '2', '1', 'Menor Preço', 'Global', 'Contração de Empresa Especializada na Prestação de serviço de Obras e serviço de Engenharia na Construção de uma Escola com 02 salas de Aula - Modelo Padrão MEC/ FNDE, no Povoado de Machadinho, Zona Rural deste Município de Niquelândia - Goiás.', null, null, null, null, null, '2014-10-27 14:00:45', '2014-10-20 15:00:51');

-- ----------------------------
-- Table structure for modalidades
-- ----------------------------
DROP TABLE IF EXISTS `modalidades`;
CREATE TABLE `modalidades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of modalidades
-- ----------------------------
INSERT INTO `modalidades` VALUES ('1', 'Pregão Presencial');
INSERT INTO `modalidades` VALUES ('2', 'Tomada de Preços');
INSERT INTO `modalidades` VALUES ('3', 'Carta Convite');
INSERT INTO `modalidades` VALUES ('4', 'Concorrência Pública');
INSERT INTO `modalidades` VALUES ('5', 'Pregão Eletrônico');
INSERT INTO `modalidades` VALUES ('6', 'Serviços Técnicos');
INSERT INTO `modalidades` VALUES ('7', 'Coleta de Preços');
INSERT INTO `modalidades` VALUES ('8', 'Credenciamento');
INSERT INTO `modalidades` VALUES ('9', 'Covênios');
INSERT INTO `modalidades` VALUES ('10', 'Inexigibilidade');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `nivel` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'Olavo de Carvalho', 'olavo@carvalho.com', 'd41d8cd98f00b204e9800998ecf8427e', '2014-10-18 15:36:55', '2');
INSERT INTO `users` VALUES ('3', 'Felipe Moura Brasil', 'felipe@moura.com', 'd41d8cd98f00b204e9800998ecf8427e', '2014-10-20 15:23:03', '1');
INSERT INTO `users` VALUES ('4', 'Airton Lopes', 'airtonlopes_@hotmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '2014-10-18 23:47:08', '1');
INSERT INTO `users` VALUES ('5', 'Reinaldo Azevedo', 'reinaldo@axevedo.com', '827ccb0eea8a706c4c34a16891f84e7b', '2014-10-18 14:03:20', '2');
