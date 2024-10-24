CREATE DATABASE dbasistencia;
USE dbasistencia;

CREATE TABLE personas 
(
	idpersona INT AUTO_INCREMENT PRIMARY KEY,
    apellidos VARCHAR(40) NOT NULL,
    nombres VARCHAR(40) NOT NULl,
    dni CHAR(8) NOT NULL,
    telefono CHAR(9)  NULL,
    direccion VARCHAR(70)  NULL,
    email VARCHAR(70)  NULL,
    create_at DATETIME NOT NULL DEFAULT NOW(),
    CONSTRAINT uk_dni_per UNIQUE (dni)
)ENGINE = INNODB;

INSERT INTO personas(apellidos, nombres, dni) VALUES 
	('Pachas Mogrovejo','Ruben','73208847'),
    ('Sanchez Sanchez','Luis','12489783'),
    ('Almeyda Yataco','Maria','78945685');
    
CREATE TABLE perfiles
(
	idperfil INT AUTO_INCREMENT PRIMARY KEY,
    perfil VARCHAR(30) NOT NULL,
    nombrecorto CHAR(3) NOT NULL,
    descripcion VARCHAR(200) NULL,
    create_at DATETIME NOT NULL DEFAULT NOW(),
    CONSTRAINT uk_perfil_per UNIQUE (perfil),
    CONSTRAINT uk_nombrecorto_per UNIQUE (nombrecorto)
)ENGINE = INNODB;

INSERT INTO perfiles(perfil, nombrecorto) VALUES 
	('Administrador','ADM'),
    ('Superior','SPV'),
    ('Invitado','INV');
    
CREATE TABLE usuarios
(
	idusuario INT AUTO_INCREMENT PRIMARY KEY,
    idpersona INT NOT NULL,
    idperfil INT NOT NULL,
    nomuser VARCHAR(20) NOT NULL,
    passuser VARCHAR(70) NOT NULL,
    create_at DATETIME NOT NULL DEFAULT NOW(),
    update_at DATETIME NULL,
    inactive_at DATETIME NULL,
    CONSTRAINT fk_idpersona_usu FOREIGN KEY (idpersona) REFERENCES personas (idpersona),
    CONSTRAINT uk_idpersona_usu UNIQUE (idpersona),
    CONSTRAINT fk_idperfil_usu FOREIGN KEY (idperfil) REFERENCES perfiles (idperfil),
    CONSTRAINT uk_nomuser_usur UNIQUE (nomuser)
)ENGINE = INNODB;

INSERT INTO usuarios(idpersona, idperfil, nomuser, passuser)
	VALUES
		(1,1,'Ruben','22062003'),
        (2,2,'Luis','123'),
        (3,3,'Maria','123');
        
UPDATE usuarios SET passuser ='$2y$10$DRNJmW.t6YW5UO6P1uFM/OcJgd0JIIwl7G7k98qplpIPx7UbqqwC6' WHERE idusuario = 1;
UPDATE usuarios SET passuser ='$2y$10$Z3doF4rmw54bunFAg3vzF.GDd8CpMPt2cdF9dXfbdxQaLRxcZMWDq' WHERE idusuario = 2;
UPDATE usuarios SET passuser ='$2y$10$XiFpj3XO36A2o1WhXJQQkeE3FOdBi3Kmqt/208k0Fje4zka2wsm1i' WHERE idusuario = 3;
