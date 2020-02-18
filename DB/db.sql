-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.8-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              10.3.0.5771
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Copiando estrutura do banco de dados para cadastro_de_motoristas
CREATE DATABASE IF NOT EXISTS `cadastro_de_motoristas` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `cadastro_de_motoristas`;

-- Copiando estrutura para tabela cadastro_de_motoristas.motoristas
CREATE TABLE IF NOT EXISTS `motoristas` (
  `RECNO` int(11) NOT NULL AUTO_INCREMENT,
  `MOT_CODIGO` int(11) DEFAULT NULL,
  `MOT_NOME` varchar(50) DEFAULT NULL,
  `MOT_TELEFONE` varchar(50) DEFAULT NULL,
  `MOT_CNH` int(11) DEFAULT NULL,
  `MOT_TIPO_CNH` char(50) DEFAULT NULL,
  `MOT_CPF` varchar(50) DEFAULT NULL,
  `MOT_DTNACIMENTO` date DEFAULT NULL,
  PRIMARY KEY (`RECNO`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela cadastro_de_motoristas.recnos
CREATE TABLE IF NOT EXISTS `recnos` (
  `RECNO` int(11) DEFAULT NULL,
  `TABELA` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Exportação de dados foi desmarcado.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
