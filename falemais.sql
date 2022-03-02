
CREATE DATABASE IF NOT EXISTS telzir;

USE telzir;

DROP TABLE IF EXISTS `planos`;

CREATE TABLE `planos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `tempo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;


INSERT INTO `planos` VALUES (1,'FaleMais 30',30);
INSERT INTO `planos` VALUES (2,'FaleMais 60',60);
INSERT INTO `planos` VALUES (3,'FaleMais 120',120);

DROP TABLE IF EXISTS `tarifas`;

CREATE TABLE `tarifas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `origem` varchar(100) NOT NULL,
  `destino` varchar(100) NOT NULL,
  `tarifa` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

INSERT INTO `tarifas` VALUES (1,'011','016',1.9);
INSERT INTO `tarifas` VALUES (2,'016','011',2.9);
INSERT INTO `tarifas` VALUES (3,'011','017',1.7);
INSERT INTO `tarifas` VALUES (4,'017','011',2.7);
INSERT INTO `tarifas` VALUES (5,'011','018',0.9);
INSERT INTO `tarifas` VALUES (6,'018','011',1.9);

