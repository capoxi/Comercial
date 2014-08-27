SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `vendas` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `vendas` ;

-- -----------------------------------------------------
-- Table `vendas`.`Cidade`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `vendas`.`Cidade` (
  `idEstado` INT NOT NULL ,
  `NomeEstado` VARCHAR(100) NOT NULL ,
  `idCidade` INT NOT NULL ,
  `NomeCidade` VARCHAR(100) NOT NULL ,
  `Ativo` CHAR(1) NOT NULL DEFAULT 'N' ,
  PRIMARY KEY (`idEstado`, `idCidade`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `vendas`.`Cliente`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `vendas`.`Cliente` (
  `idCliente` INT NOT NULL AUTO_INCREMENT ,
  `Nome` VARCHAR(80) NOT NULL ,
  `CPF` INT NULL ,
  `RG` INT NULL ,
  `CEP` INT NULL ,
  `Endereco` VARCHAR(200) NULL ,
  `Bairro` VARCHAR(40) NULL ,
  `idCidade` INT NOT NULL ,
  `idEstado` INT NOT NULL ,
  `Fone` INT NULL ,
  `DataNascimento` DATE NULL ,
  `Sexo` CHAR(1) NULL ,
  `EstadoCivil` CHAR(1) NULL COMMENT '$estadocivil = array(\\n        \\\"N\\\" => \\\"Não informado\\\",\\n        \\\"C\\\" => \\\"Casado\\\",\\n        \\\"D\\\" => \\\"Divorciado\\\",\\n        \\\"E\\\" => \\\"Noivo\\\",\\n        \\\"S\\\" => \\\"Solteiro\\\",\\n        \\\"V\\\" => \\\"Viúvo\\\"\\n    );' ,
  `Email` VARCHAR(40) NOT NULL ,
  `DataCadastro` DATETIME NULL ,
  `Ativo` CHAR(1) NOT NULL DEFAULT 'S' ,
  PRIMARY KEY (`idCliente`) ,
  INDEX `fk_Cliente_Cidade_idx` (`idEstado` ASC, `idCidade` ASC) ,
  CONSTRAINT `fk_Cliente_Cidade`
    FOREIGN KEY (`idEstado` , `idCidade` )
    REFERENCES `vendas`.`Cidade` (`idEstado` , `idCidade` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `vendas`.`Funcionario`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `vendas`.`Funcionario` (
  `idFuncionario` INT NOT NULL AUTO_INCREMENT ,
  `Nome` VARCHAR(80) NOT NULL ,
  `Login` VARCHAR(40) NOT NULL ,
  `Senha` VARCHAR(200) NOT NULL ,
  `CEP` INT NULL ,
  `Endereco` VARCHAR(200) NULL ,
  `Bairro` VARCHAR(40) NULL ,
  `idCidade` INT NOT NULL ,
  `idEstado` INT NOT NULL ,
  `CPF` INT NULL ,
  `RG` INT NULL ,
  `Ativo` CHAR(1) NOT NULL DEFAULT 'S' ,
  PRIMARY KEY (`idFuncionario`) ,
  INDEX `fk_Funcionario_Cidade1_idx` (`idEstado` ASC, `idCidade` ASC) ,
  CONSTRAINT `fk_Funcionario_Cidade1`
    FOREIGN KEY (`idEstado` , `idCidade` )
    REFERENCES `vendas`.`Cidade` (`idEstado` , `idCidade` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `vendas`.`Venda`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `vendas`.`Venda` (
  `idVenda` INT NOT NULL AUTO_INCREMENT ,
  `idFuncionario` INT NOT NULL ,
  `idCliente` INT NOT NULL ,
  `CondicaoPagto` INT NULL COMMENT 'CondicaoPagto\\n0 - Em aberto\\n1 - Avista Dinheiro\\n2 - Avista Cartão\\n3 - Avista Cheque\\n4 - Prazo Cartão\\n5 - Prazo Cheque' ,
  `DataVenda` DATETIME NOT NULL ,
  `Ativo` CHAR(1) NOT NULL DEFAULT 'S' ,
  PRIMARY KEY (`idVenda`) ,
  INDEX `fk_Venda_Cliente1_idx` (`idCliente` ASC) ,
  INDEX `fk_Venda_Funcionario1_idx` (`idFuncionario` ASC) ,
  CONSTRAINT `fk_Venda_Cliente1`
    FOREIGN KEY (`idCliente` )
    REFERENCES `vendas`.`Cliente` (`idCliente` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Venda_Funcionario1`
    FOREIGN KEY (`idFuncionario` )
    REFERENCES `vendas`.`Funcionario` (`idFuncionario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `vendas`.`Transportadora`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `vendas`.`Transportadora` (
  `idTransportadora` INT NOT NULL AUTO_INCREMENT ,
  `RazaoSocial` VARCHAR(200) NOT NULL ,
  `Fantasia` VARCHAR(200) NOT NULL ,
  `CNPJ` INT NULL ,
  `IE` INT NULL ,
  `CEP` INT NULL ,
  `Endereco` VARCHAR(200) NULL ,
  `Bairro` INT NULL ,
  `idCidade` INT NOT NULL ,
  `idEstado` INT NOT NULL ,
  `Fone` INT NOT NULL ,
  `Email` VARCHAR(40) NOT NULL ,
  `DataCadastro` DATETIME NULL ,
  `Ativo` CHAR(1) NOT NULL DEFAULT 'S' ,
  PRIMARY KEY (`idTransportadora`) ,
  INDEX `fk_Transportadora_Cidade1_idx` (`idEstado` ASC, `idCidade` ASC) ,
  CONSTRAINT `fk_Transportadora_Cidade1`
    FOREIGN KEY (`idEstado` , `idCidade` )
    REFERENCES `vendas`.`Cidade` (`idEstado` , `idCidade` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `vendas`.`Marca`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `vendas`.`Marca` (
  `idMarca` INT NOT NULL AUTO_INCREMENT ,
  `Nome` VARCHAR(80) NOT NULL ,
  `Email` VARCHAR(40) NULL ,
  `Ativo` CHAR(1) NOT NULL DEFAULT 'S' ,
  PRIMARY KEY (`idMarca`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `vendas`.`Categoria`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `vendas`.`Categoria` (
  `idCategoria` INT NOT NULL AUTO_INCREMENT ,
  `Nome` VARCHAR(40) NOT NULL ,
  `Ativo` CHAR(1) NOT NULL DEFAULT 'S' ,
  PRIMARY KEY (`idCategoria`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `vendas`.`Fornecedor`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `vendas`.`Fornecedor` (
  `idFornecedor` INT NOT NULL AUTO_INCREMENT ,
  `RazaoSocial` VARCHAR(200) NOT NULL ,
  `Fantasia` VARCHAR(200) NOT NULL ,
  `CNPJ` INT NULL ,
  `IE` INT NULL ,
  `CEP` INT NULL ,
  `Endereco` VARCHAR(200) NULL ,
  `Bairro` INT NULL ,
  `idCidade` INT NOT NULL ,
  `idEstado` INT NOT NULL ,
  `idTransportadora` INT NOT NULL ,
  `Fone` INT NULL ,
  `Email` VARCHAR(40) NOT NULL ,
  `DataCadastro` DATETIME NULL ,
  `Ativo` CHAR(1) NOT NULL DEFAULT 'S' ,
  PRIMARY KEY (`idFornecedor`) ,
  INDEX `fk_Fornecedor_Transportadora1_idx` (`idTransportadora` ASC) ,
  INDEX `fk_Fornecedor_Cidade1_idx` (`idEstado` ASC, `idCidade` ASC) ,
  CONSTRAINT `fk_Fornecedor_Transportadora1`
    FOREIGN KEY (`idTransportadora` )
    REFERENCES `vendas`.`Transportadora` (`idTransportadora` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Fornecedor_Cidade1`
    FOREIGN KEY (`idEstado` , `idCidade` )
    REFERENCES `vendas`.`Cidade` (`idEstado` , `idCidade` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `vendas`.`Produto`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `vendas`.`Produto` (
  `idProduto` INT NOT NULL AUTO_INCREMENT ,
  `Nome` VARCHAR(80) NULL ,
  `idCategoria` INT NOT NULL ,
  `idMarca` INT NOT NULL ,
  `idFornecedor` INT NOT NULL ,
  `QtdEstoque` FLOAT NULL ,
  `Unidade` INT NULL COMMENT 'Unidade\\n\\\"1\\\" => \\\"Grama\\\",\\n\\\"2\\\" => \\\"Kilograma\\\",\\n\\\"3\\\"  =>\\\"Mililitro\\\",\\n\\\"4\\\" => \\\"Litro\\\",\\n\\\"5\\\" => \\\"Centímetro\\\",\\n\\\"6\\\" => \\\"Metro\\\"\\n' ,
  `ValorCompra` DECIMAL(13,3) NULL ,
  `ValorVenda` DECIMAL(13,3) NULL ,
  PRIMARY KEY (`idProduto`) ,
  INDEX `fk_Produto_Marca1_idx` (`idMarca` ASC) ,
  INDEX `fk_Produto_Categoria1_idx` (`idCategoria` ASC) ,
  INDEX `fk_Produto_Fornecedor1_idx` (`idFornecedor` ASC) ,
  CONSTRAINT `fk_Produto_Marca1`
    FOREIGN KEY (`idMarca` )
    REFERENCES `vendas`.`Marca` (`idMarca` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Produto_Categoria1`
    FOREIGN KEY (`idCategoria` )
    REFERENCES `vendas`.`Categoria` (`idCategoria` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Produto_Fornecedor1`
    FOREIGN KEY (`idFornecedor` )
    REFERENCES `vendas`.`Fornecedor` (`idFornecedor` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `vendas`.`VendaItens`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `vendas`.`VendaItens` (
  `idVendaItens` INT NOT NULL ,
  `idVenda` INT NOT NULL ,
  `idProduto` INT NOT NULL ,
  `idFuncionario` INT NOT NULL ,
  PRIMARY KEY (`idVendaItens`) ,
  INDEX `fk_VendaItens_Funcionario1_idx` (`idFuncionario` ASC) ,
  INDEX `fk_VendaItens_Produto1_idx` (`idProduto` ASC) ,
  INDEX `fk_VendaItens_Venda1_idx` (`idVenda` ASC) ,
  CONSTRAINT `fk_VendaItens_Funcionario1`
    FOREIGN KEY (`idFuncionario` )
    REFERENCES `vendas`.`Funcionario` (`idFuncionario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_VendaItens_Produto1`
    FOREIGN KEY (`idProduto` )
    REFERENCES `vendas`.`Produto` (`idProduto` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_VendaItens_Venda1`
    FOREIGN KEY (`idVenda` )
    REFERENCES `vendas`.`Venda` (`idVenda` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `vendas`.`Compra`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `vendas`.`Compra` (
  `idCompra` INT NOT NULL AUTO_INCREMENT ,
  `idFornecedor` INT NOT NULL ,
  `idFuncionario` INT NOT NULL ,
  `CondicaoPagto` INT NULL COMMENT 'CondicaoPagto\\n0 - Em aberto\\n1 - Avista Dinheiro\\n2 - Avista Cartão\\n3 - Avista Cheque\\n4 - Prazo Cartão\\n5 - Prazo Cheque' ,
  `DataVenda` DATETIME NULL ,
  `Ativo` CHAR(1) NOT NULL DEFAULT 'S' ,
  PRIMARY KEY (`idCompra`) ,
  INDEX `fk_Compra_Fornecedor1_idx` (`idFornecedor` ASC) ,
  INDEX `fk_Compra_Funcionario1_idx` (`idFuncionario` ASC) ,
  CONSTRAINT `fk_Compra_Fornecedor1`
    FOREIGN KEY (`idFornecedor` )
    REFERENCES `vendas`.`Fornecedor` (`idFornecedor` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Compra_Funcionario1`
    FOREIGN KEY (`idFuncionario` )
    REFERENCES `vendas`.`Funcionario` (`idFuncionario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `vendas`.`CompraItens`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `vendas`.`CompraItens` (
  `idCompraItens` INT NOT NULL ,
  `idProduto` INT NOT NULL ,
  `idCompra` INT NOT NULL ,
  `idFuncionario` INT NOT NULL ,
  PRIMARY KEY (`idCompraItens`) ,
  INDEX `fk_VendaItens_Funcionario1_idx` (`idFuncionario` ASC) ,
  INDEX `fk_VendaItens_Produto1_idx` (`idProduto` ASC) ,
  INDEX `fk_CompraItens_Compra1_idx` (`idCompra` ASC) ,
  CONSTRAINT `fk_VendaItens_Funcionario10`
    FOREIGN KEY (`idFuncionario` )
    REFERENCES `vendas`.`Funcionario` (`idFuncionario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_VendaItens_Produto10`
    FOREIGN KEY (`idProduto` )
    REFERENCES `vendas`.`Produto` (`idProduto` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_CompraItens_Compra1`
    FOREIGN KEY (`idCompra` )
    REFERENCES `vendas`.`Compra` (`idCompra` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
