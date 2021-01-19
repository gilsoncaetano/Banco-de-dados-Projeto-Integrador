-- Nome Para o Banco de Dados será dbisaclube

create database dbisaclube;
use dbisaclube;

create table cliente(
idcliente int auto_increment primary key,
nomecliente varchar(50) not null,
cpf varchar(13) not null unique,
sexo char(10) not null,
email varchar(100) not null,
telefone varchar(20) not null,
foto varchar (250),
senha varchar (250) not null
)engine InnoDB;
select * from cliente;

insert into cliente(nomecliente, cpf, sexo,email,telefone,foto,senha)
values('Amber','207545484755','Feminina','amber@gmail.com','11 97989-8877','Amber.png',md5('123')),
('Marcela','207545400','Femenina','marcela@gmail.com','11 97989-8899','marcela.png',md5('123')),
('Tay','2075454845','Masculino','tay@gmail.com','11 97989-7766','tay.png',md5('123'));

create table endereco(
idendereco int auto_increment primary key,
logradouro varchar(100) not null,
numero varchar(10) not null,
complemento varchar(20) not null,
bairro varchar(50) not null,
cidade varchar(20) not null,
estado varchar(5) not null,
cep varchar(10) not null,
idcliente int not null
)engine Innodb;
select * from endereco;

insert into endereco(logradouro, numero, complemento,bairro, cidade,cep,idcliente)
values('Rua','cafe','150','Casa dos fundos','Jardim', 'guarulhos','SP','08523100','7'),
('Rua','Três','50','Casa','Jardim','08523-200','10'),
('TV',' Combe','760','Casa C3','Jardim Ipe','08523100','13')
;

create table armasigma(
idarma int auto_increment primary key,
cpfarma varchar(20) not null,
funcao varchar (25) not null,
sigma varchar(20) not null,
calibre varchar(10) not null,
modelo varchar(15) not null,
cano varchar(5) not null,
capacidade varchar(20) not null,
arma varchar (20) not null,
fabricante varchar(20) not null,
funcionamento varchar(30) not null,
notafiscal varchar(20) not null,
datafiscal varchar(20) not null,
orgaoauto varchar(20) not null,
codigoauto varchar(20) not null,
idcliente int not null
)engine InnoDB;

select * from armasigma;
insert into armasigma(cpfarma,funcao,sigma,arma,fabricante,calibre,modelo,cano,capacidade,funcionamento,notafiscal,datafiscal,orgaoauto,codigoauto,idcliente)
value('02316548-89','Atirador','Exercito','Pistola','Imbel','380 GC','MD1 LX','01','19+1','Semeautomatica','32659874','20/06/2020','Exercito','659874512','1');
select * from endereco;

create table produto(
idproduto int auto_increment primary key,
tipo varchar(20) not null,
nomeproduto varchar(50) not null,
descricao text not null,
preco decimal(10,2) not null,
idfoto int not null
)engine InnoDB;
select * from produto;

insert into produto(nomeproduto, descricao, preco, idfoto)
values('Pistola IMBEL 40 GC MD7','Calibre: .40 S&W
Acabamento: Pintado, cor preta
Comprimento: 219 mm
Peso sem carregador: 1.200 g
Funcionamento: semiautomático em ação simples.
',5997.56,1);

create table foto(
idfoto int auto_increment primary key,
foto1 varchar(200) not null,
foto2 varchar(200) not null,
foto3 varchar(200) not null,
foto4 varchar(200) not null
)engine InnoDB;

select * from foto;
insert into foto(foto1,foto2,foto3,foto4)
values ('pistola1.png','pistola2.png','pistola3.png','pistola4.png');


create table pedido(
idpedido int auto_increment primary key,
idcliente int not null,
datapedido timestamp default current_timestamp()
)engine InnoDB;

insert into pedido(idcliente) 
values(1);

select * from pedido;

create table itenspedido(
iditens int auto_increment primary key,
idpedido int not null,
idproduto int not null,
quantidade int default 1 not null 
)engine InnoDB;

insert into itenspedido(idpedido,idproduto,quantidade)
values(1,1,3);
select * from itenspedido;

create table pagamento(
idpagamento int auto_increment primary key,
idpedido int not null,
tipo varchar(20) not null,
descricao varchar(200) not null,
valor decimal(10,2) not null,
parcelas int default 1 not null,
valorparcela decimal(10,2) not null
)engine InnoDB;

ALTER TABLE `dbisaclube`.`endereco` 
ADD CONSTRAINT `fk_endereco_pk_cliente`
  FOREIGN KEY (`idcliente`)
  REFERENCES `dbisaclube`.`cliente` (`idcliente`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;


ALTER TABLE `dbisaclube`.`armasigma` 
ADD CONSTRAINT `fk_armasigma_pk_cliente`
  FOREIGN KEY (`idcliente`)
  REFERENCES `dbisaclube`.`cliente` (`idcliente`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE `dbisaclube`.`pedido` 
ADD CONSTRAINT `fk_pedido_pk_cliente`
  FOREIGN KEY (`idcliente`)
  REFERENCES `dbisaclube`.`cliente` (`idcliente`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;
  
  
  ALTER TABLE `dbisaclube`.`produto` 
ADD CONSTRAINT `fk_produto_pk_foto`
  FOREIGN KEY (`idfoto`)
  REFERENCES `dbisaclube`.`foto` (`idfoto`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;
  
  ALTER TABLE `dbisaclube`.`itenspedido` 
ADD CONSTRAINT `fk_itens_pk_pedido`
  FOREIGN KEY (`idpedido`)
  REFERENCES `dbisaclube`.`pedido` (`idpedido`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;
  
  ALTER TABLE `dbisaclube`.`itenspedido` 
ADD CONSTRAINT `fk_itens_pk_produto`
  FOREIGN KEY (`idproduto`)
  REFERENCES `dbisaclube`.`produto` (`idproduto`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;
  
  
  ALTER TABLE `dbisaclube`.`pagamento` 
ADD CONSTRAINT `fk_pagamento_pk_pedido`
  FOREIGN KEY (`idpedido`)
  REFERENCES `dbisaclube`.`pedido` (`idpedido`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

select
    cl.idcliente,
    cl.nomecliente,
    cl.cpf,
    cl.sexo,
    cl.email,
    cl.telefone,
    cl.foto,
    cl.senha,
    en.idendereco,
    en.tipo,
    en.logradouro,
    en.numero,
    en.complemento,
    en.bairro,
    en.cep,
    en.idcliente
    from endereco en inner join cliente cl on en.idcliente=cl.idcliente
    where en.idendereco = idendereco;
    
    /**where cl.email = 'dalila@gmail.com' and cl.senha = md5('123');**/
					













