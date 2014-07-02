CREATE SCHEMA carretmvc;

use carretmvc;


CREATE TABLE `usuari` (
    `id_usuari` SMALLINT(10) unsigned NOT NULL AUTO_INCREMENT,
     login VARCHAR(40) NOT NULL,
    `nom` VARCHAR(40) NOT NULL,
    `password` VARCHAR(40) NOT NULL,
    `foto` VARCHAR(45),
    CONSTRAINT `PK_Usuari` PRIMARY KEY (`id_usuari`)
)engine = innodb DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;


CREATE TABLE `producte` (
    `id_producte` SMALLINT(10) unsigned NOT NULL AUTO_INCREMENT,
    `nomProducte` VARCHAR(200) NOT NULL,
    `preu` FLOAT NOT NULL,
    `foto` VARCHAR(45),
    CONSTRAINT `PK_Producte` PRIMARY KEY (`id_producte`)
)engine = innodb DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE `carretmvc`.`ventes` (
`idventa` SMALLINT( 10 ) unsigned NOT NULL AUTO_INCREMENT ,
`id_producte` SMALLINT( 10 ) unsigned NOT NULL ,
`id_usuari` SMALLINT( 10 ) unsigned NOT NULL ,
`unitats` SMALLINT( 10 ) unsigned NOT NULL ,
`data_venta` DATE NOT NULL ,
`preu_venta`  FLOAT NOT NULL,
CONSTRAINT `PK_idventa` PRIMARY KEY ( `idventa` ) ,
CONSTRAINT `FK_idproducte` FOREIGN KEY ( `id_producte` ) REFERENCES `carretmvc`.`producte` (`id_producte`),
CONSTRAINT `FK_idusuari` FOREIGN KEY ( `id_usuari` ) REFERENCES `carretmvc`.`usuari` (`id_usuari`) 
ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_general_ci