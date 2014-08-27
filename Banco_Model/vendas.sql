-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost:3306
-- Tempo de Geração: 17/07/2014 às 18:12
-- Versão do servidor: 5.5.32
-- Versão do PHP: 5.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de dados: `vendas`
--

--
-- Fazendo dump de dados para tabela `categoria`
--

INSERT INTO `categoria` (`idCategoria`, `Nome`, `Ativo`) VALUES
(1, 'Bebidas', 'S');

--
-- Fazendo dump de dados para tabela `cidade`
--

INSERT INTO `cidade` (`idEstado`, `NomeEstado`, `idCidade`, `NomeCidade`, `Ativo`) VALUES
(43, 'Rio Grande do Sul', 1, 'Porto Alegre', 'S');

--
-- Fazendo dump de dados para tabela `fornecedor`
--

INSERT INTO `fornecedor` (`idFornecedor`, `RazaoSocial`, `Fantasia`, `CNPJ`, `IE`, `CEP`, `Endereco`, `Bairro`, `idCidade`, `idEstado`, `idTransportadora`, `Fone`, `Email`, `DataCadastro`, `Ativo`) VALUES
(1, 'Souza Roxo Ltda', 'Souza Roxo Distribuidora', 2147483647, 2147483647, 0, 'Rua Giacomo Sonego, 488 apto 310', 0, 1, 43, 1, 2147483647, 'atendimento@souzarocho.com.br', '0000-00-00 00:00:00', 'S');

--
-- Fazendo dump de dados para tabela `marca`
--

INSERT INTO `marca` (`idMarca`, `Nome`, `Email`, `Ativo`) VALUES
(1, 'Gen?rico', 'semcontato@none.non', 'N'),
(2, 'Coca Cola', 'contato@cocacola.com.br', 'S'),
(3, 'Cris&aacute;lida Ltda', 'contato@crisalida.com.br', 'S'),
(4, 'Pros?dia', 'prosodia@prosodia.com.br', 'S'),
(5, '', 'prosodia@prosodia.com.br', 'S'),
(6, 'Lenovo', 'contato@Lenovo.com.br', 'S'),
(7, 'Japan Kirin', 'japan@kirin.co.jp', 'N');

--
-- Fazendo dump de dados para tabela `transportadora`
--

INSERT INTO `transportadora` (`idTransportadora`, `RazaoSocial`, `Fantasia`, `CNPJ`, `IE`, `CEP`, `Endereco`, `Bairro`, `idCidade`, `idEstado`, `Fone`, `Email`, `DataCadastro`, `Ativo`) VALUES
(1, 'Transrosa Ltda', 'Transrosa Transportes', 344123423, 444222, 88965, 'Estrada Geral Forquilha do Cedro', 0, 1, 43, 2147483647, 'dougmz@gmail.com', '0000-00-00 00:00:00', 'S');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
