create database  bdpizzeria;
use bdpizzeria ;


/*ESTO YA ESTÁ HECHO DESDE LA MIGRACION*/
create table tipousuario(
id int auto_increment not null primary key,
tipousuario varchar(50),
activo BOOLEAN DEFAULT TRUE,
created_at TIMESTAMP NULL DEFAULT NULL,
updated_at TIMESTAMP NULL DEFAULT NULL
);



insert into tipousuario(tipousuario,activo) values ("Administrador",1);
/*Vista de Total de Tipo de Usuarios*/
create view mostrarusuarios as
select tipousuario.id , tipousuario.tipousuario  from tipousuario
WHERE tipousuario.activo=1;

select * from mostrarusuarios;



/*Ingresar tipo de usuario*/
DELIMITER $$
CREATE PROCEDURE ingresarnuevotipousuario(IN paramtipousuario varchar(50))
BEGIN
insert into tipousuario (tipousuario,activo) values (paramtipousuario,1);
END$$
DELIMITER ;

/*Modificar tipo de usuarios*/
DELIMITER $$
CREATE PROCEDURE modificartipousuarios(IN paramidtipousuario int,IN paramtipousuario varchar(50))
BEGIN
UPDATE tipousuario set tipousuario.tipousuario =paramtipousuario WHERE tipousuario.id= paramidtipousuario;
END$$
DELIMITER ;

/*Eliminar tipo de usuario*/
DELIMITER $$
CREATE PROCEDURE eliminartipousuario(IN paramidtipousuario int)
BEGIN
UPDATE tipousuario set tipousuario.activo =0 WHERE tipousuario.id= paramidtipousuario;
END$$
DELIMITER ;


/*ESTO YA ESTÁ EN LA MIGRACIÓN*/
create table usuario(
id int auto_increment not null primary key,
usuario varchar(50),
contrasena varchar(50),
activo BOOLEAN DEFAULT TRUE,
created_at TIMESTAMP NULL DEFAULT NULL,
updated_at TIMESTAMP NULL DEFAULT NULL,
foreign key(fktipousuario) references tipousuario(id)
);

/*ESTO YA ESTÁ EN LA MIGRACIÓN*/
create table tipoproducto(
id int auto_increment not null primary key,
tipoproducto varchar(50),
activo BOOLEAN DEFAULT TRUE,
created_at TIMESTAMP NULL DEFAULT NULL,
updated_at TIMESTAMP NULL DEFAULT NULL
);


insert into tipoproducto (tipoproducto,estadotipoproducto) values ('Pizza',1);
insert into tipoproducto (tipoproducto,estadotipoproducto) values ('Bebidas',1);
select * from tipoproducto;


/*STORED PROCEDURE*/

/*Ingresar tipo de producto*/
DELIMITER $$
CREATE PROCEDURE ingresarnuevotipoproductos(IN tipoproducto varchar(50))
BEGIN
insert into tipoproducto (tipoproducto,estadotipoproducto) values (tipoproducto,1);
END$$
DELIMITER ;


/*Modificar tipo de producto*/
DELIMITER $$
CREATE PROCEDURE modificartipoproductos(IN paramidtipoproducto int,IN paramtipoproducto varchar(50))
BEGIN
UPDATE tipoproducto set tipoproducto.tipoproducto =paramtipoproducto WHERE tipoproducto.id= paramidtipoproducto;
END$$
DELIMITER ;

/*Eliminar tipo de producto*/
DELIMITER $$
CREATE PROCEDURE eliminartipoproductos(IN paramidtipoproducto int)
BEGIN
UPDATE tipoproducto set tipoproducto.estadotipoproducto =0 WHERE tipoproducto.id= paramidtipoproducto;
END$$
DELIMITER ;


/*Vista de Total de Tipo de Productos*/
create view mostrartiposproductos as
select tipoproducto.id , tipoproducto.tipoproducto  from tipoproducto WHERE tipoproducto.estadotipoproducto=1;

select * from mostrartiposproductos;



/*ESTO YA ESTÁ EN LA MIGRACIÓN*/
create table producto(
id int auto_increment not null primary key,
nombreproducto varchar(100),
descripcionproducto varchar(150),
precioproducto double(10,2),
stock int,
fktipoproducto int,
activo BOOLEAN DEFAULT TRUE,
created_at TIMESTAMP NULL DEFAULT NULL,
updated_at TIMESTAMP NULL DEFAULT NULL,
foreign key(fktipoproducto) references tipoproducto(id)
);

/*Vista de Total de Combo de Tipo de Productos*/
create view mostrarcombotiposproductos as
select tipoproducto.id , tipoproducto.tipoproducto  from tipoproducto WHERE tipoproducto.estadotipoproducto=1;

select * from mostrarcombotiposproductos;


/*Vista de Total de Tipo de Productos*/
create view mostrarproductos as
select producto.id , producto.nombreproducto,producto.descripcionproducto,producto.precioproducto,producto.stock, tipoproducto.tipoproducto  from producto
INNER JOIN tipoproducto ON tipoproducto.id = producto.fktipoproducto WHERE producto.estadoproducto=1;

select * from mostrarproductos;


/*STORED PROCEDURE*/

/*Ingresar producto*/
DELIMITER $$
CREATE PROCEDURE ingresarnuevoproducto(IN param_nombreproducto varchar(100),IN param_descripcion varchar(150),IN param_precioproducto decimal(5,2),IN param_stock int,IN param_fktipoproducto int)
BEGIN
insert into producto (nombreproducto,descripcionproducto,precioproducto,stock,fktipoproducto,estadoproducto) values (param_nombreproducto,param_descripcion,param_precioproducto,param_stock,param_fktipoproducto,1);
END$$
DELIMITER ;

call ingresarnuevoproducto('Pizza Americana','Pizza America Clásica',5.2,10,1);

/*Modificar  producto*/
DELIMITER $$
CREATE PROCEDURE modificarproductos(IN paramidproducto int,IN paramnombreproducto varchar(100),IN paramdescripcionproducto varchar(150),IN paramprecioproducto double(5,2),IN paramstockproducto INT,IN paramfktipoproducto INT)
BEGIN
UPDATE producto
set producto.nombreproducto =paramnombreproducto,
producto.descripcionproducto =paramdescripcionproducto, 
producto.precioproducto =paramprecioproducto,
producto.stock =paramstockproducto,
producto.fktipoproducto =paramfktipoproducto
WHERE producto.id= paramidproducto;
END$$
DELIMITER ;


/*Eliminar producto*/
DELIMITER $$
CREATE PROCEDURE eliminarproductos(IN paramidproducto int)
BEGIN
UPDATE producto set producto.estadoproducto =0 WHERE producto.id= paramidproducto;
END$$
DELIMITER ;

/*ESTO YA ESTÁ EN LA MIGRACION
Y EL AUTOLLENADO INICIAL POR SEEDER DE LARAVEL*/
create table sexo(
id int auto_increment not null primary key,
sexo varchar(50),
activo BOOLEAN DEFAULT TRUE,
created_at TIMESTAMP NULL DEFAULT NULL,
updated_at TIMESTAMP NULL DEFAULT NULL
);

/*ESTO YA ESTÁ EN LA MIGRACION*/
create table cliente(
id int auto_increment not null primary key,
nombres varchar(100),
appaterno varchar(100),
apmaterno varchar(100),
direccion varchar(300),
celular1 varchar(15),
celular2 varchar(15),
fksexo int,
activo BOOLEAN DEFAULT TRUE,
created_at TIMESTAMP NULL DEFAULT NULL,
updated_at TIMESTAMP NULL DEFAULT NULL,
foreign key(fksexo) references sexo(id)
);

create table tipopago(
id int auto_increment not null primary key,
tipopago varchar(50),
estadotipopago bit
);

create table presentacionproductoproveedor(
id int auto_increment not null primary key,
nombrepresentacionproductoproveedor varchar(50),
estadonombrepresentacionproductoproveedor bit
);


create table productoproveedor(
id int auto_increment not null primary key,
nombreproductoproveedor varchar(100),
presentacion varchar(100),
stock int,
fkpresentacionproductoproveedor int,
estadoproductoproveedor bit,
foreign key(fkpresentacionproductoproveedor) references presentacionproductoproveedor(id)
);

create table proveedor(
id int auto_increment not null primary key,
nombreproveedor varchar(100),
telefono1 varchar(15),
telefono2 varchar(15),
fkproductoproveedor int,
estadoproveedor bit,
foreign key(fkproductoproveedor) references productoproveedor(id)
);
 
create table factura(
id int auto_increment not null primary key,
fkcliente int,
fechahora datetime,
fktipopago int,
fkusuario int,
fkproveedores int,
estadofactura bit,
foreign key(fkcliente) references cliente(id),
foreign key(fktipopago) references tipopago(id),
foreign key(fkusuario) references usuario(id),
foreign key(fkproveedores) references proveedor(id)
);

create table tipodeventa(
id int auto_increment not null primary key,
tipodeventa varchar(50),
estadottipodeventa bit
);

create table detallefactura(
id int auto_increment not null primary key,
fkfactura int,
fkproducto int,
fktipodeventa int,
cantidadventa int,
precioventa double(5, 2),
estadodetallefactura bit,
foreign key(fkfactura) references factura(id),
foreign key(fkproducto) references producto(id),
foreign key(fktipodeventa) references tipodeventa(id)
);












