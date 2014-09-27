mysql -h localhost -u root
show databases;

drop database gestionHorarios;

create database gestionHorarios;
use gestionHorarios;

create table instituciones(
id int auto_increment primary key,
nombre varchar(20) not null,
correo varchar(20) not null,
telefono int not null,
direccion varchar(20) not null) Engine=InnoDB;

create table sedes(
id int primary key,
nombre varchar(20) not null,
correo varchar(20) not null,
telefono int(20) not null,
direccion varchar(20) not null,
ciudad varchar(20) not null,
id_institucion int not null) Engine=InnoDB;

create table ambientes(
id int auto_increment primary key,
nombre varchar(20) not null,
tipo varchar(20) not null,
descripcion varchar(200) not null,
id_sedes int not null) Engine=InnoDB;


create table inventario(
id int auto_increment primary key,
cantidad varchar(20) not null,
tipo varchar(20) not null,
descripcion varchar(200) not null,
id_ambiente int not null) Engine=InnoDB;

create table prestamoInventario(
id int auto_increment primary key,
tipo varchar(20) not null,
id_inventario int not null,
cantidad int not null,
fecha date not null,
hora_inicio time,
hora_fin time,
nombre varchar(20) not null,
id_instructor int not null,
aprobado varchar(20) not null) Engine=InnoDB;

create table reservaAmbientes(
id int auto_increment primary key,
fecha_inicio date not null,
fecha_fin date not null,
dia_semana varchar(20) not null,
hora_inicio time not null,
hora_fin time not null,
id_ambiente int not null,
id_instructor int not null,
id_grupo int not null,
aprobado varchar(20) not null) Engine=InnoDB;

create table grupos(
id int auto_increment primary key,
nombre varchar(40) not null,
tipo varchar(20) not null,
fecha_inicio date not null,
fecha_fin date not null,
cantidad int not null) Engine=InnoDB;

create table instructores(
id int primary key,
nombre varchar(40) not null,
apellido varchar(40) not null,
correo varchar(40) not null,
telefono int) Engine=InnoDB;

create table usuarios(
id int auto_increment primary key,
nombre varchar(40) not null,
contrasena varchar(40) not null,
rol int ) Engine=InnoDB;

alter table sedes add Foreign key(id_institucion)
references instituciones (id);

alter table ambientes add Foreign key(id_sedes)
references sedes (id);

alter table inventario add Foreign key(id_ambiente)
references ambientes (id);

alter table prestamoInventario add Foreign key(id_inventario)
references inventario (id);

alter table prestamoInventario add Foreign key(id_instructor)
references instructores (id);

alter table reservaAmbientes add Foreign key(id_instructor)
references instructores (id);

alter table reservaAmbientes add Foreign key(id_ambiente)
references ambientes (id);

alter table reservaAmbientes add Foreign key(id_grupo)
references grupos (id);

insert into usuarios values
("","admin","admin",1),
("","camilo","1231",2),
("","carlos","1232",2),
("","victor","1233",2),
("","alex","1234",2),
("","johan","1235",2),
("","alvaro","1236",2),
("","daniel","1237",2),
("","sebastian","1238",2),
("","jhon","1239",2),
("","mario","1230",2);


insert into instructores values
(1118291792,"camilo","olarte","camilo@misena.edu.co",321856785),
(1118291793,"carlos","quintero","carlos@misena.edu.co",321856786),
(1118291794,"victor","chacon","victor@misena.edu.co",321856787),
(1118291795,"alex","largo","alex@misena.edu.co",321856788),
(1118291796,"johan","asprilla","johan@misena.edu.co",321856789),
(1118291797,"alvaro","parra","alvaro@misena.edu.co",321856790),
(1118291798,"daniel","mora","daniel@misena.edu.co",321856791),
(1118291799,"sebastian","lerma","sebastian@misena.edu.co",321856792),
(1118291800,"jhon","quintero","jhon@misena.edu.co",321856793),
(1118291801,"mario","olarte","mario@misena.edu.co",321856794);

insert into instituciones values
("","sena","sena@misena.edu.co",6692704,"calle cerca");

insert into sedes values
(1,"salomia","senaSalomia@misena.edu.co",6692704,"calle lejos","cali",1),
(2,"alameda","senaSalomia@misena.edu.co",6692705,"calle mas lejos","cali",1),
(3,"bretana","senaBretaña@misena.edu.co",6692706,"calle mas lejos","cali",1);

insert into ambientes values
("","1","sistemas","sala de sistemas",1),
("","2","sistemas","sala de sistemas",1),
("","3","electromecanica","sala de electronica",1),
("","4","electromecanica","sala de electronica",1),
("","5","sistemas","sala de sistemas",1),
("","1","bodega","bodega con vidobeam",2),
("","2","sistemas","sala de sistemas",2),
("","3","bodega","bodega con computadores",2),
("","4","electromecanica","sala de electronica",2),
("","5","sistemas","sala de sistemas",2),
("","6","electromecanica","sala de electronica",2),
("","1","sistemas","sala de sistemas",3),
("","2","pintura","sala de sistemas",3),
("","3","sistemas","sala de sistemas",3),
("","4","bodega","bodega con computadores",3),
("","5","sistemas","sala de sistemas",3),
("","6","mecanica","electromecanica",3);


insert into inventario values
("","20","computador","computador portatil",1),
("","15","computador","computador portatil",2),
("","17","testers","para medir energia",3),
("","15","testers","para medir energia",4),
("","10","computador","computador de mesa",5),
("","25","computador","computador portatil",6),
("","20","computador","computador portatil",7),
("","30","computador","computador portatil",8),
("","18","testers","medir energia",9),
("","20","computador","computador portatil",10),
("","22","testers","medir energia",11),
("","21","computador","computador portatil",12),
("","20","mesa","mesas de pintura",13),
("","20","computador","computador portatil",14),
("","24","computador","computador portatil",15),
("","20","computador","computador portatil",16),
("","19","testers","para medir energia",17);


insert into prestamoInventario values
("","computador",1,5,"2014-09-20","13:00:00","17:00:00","camilo",1118291792,"si"),
("","computador",2,5,"2014-09-20","13:00:00","17:00:00","camilo",1118291792,"no"),
("","computador",3,5,"2014-09-20","13:00:00","17:00:00","camilo",1118291792,"si"),
("","testers",4,5,"2014-09-20","13:00:00","17:00:00","carlos",1118291793,"no"),
("","testers",5,5,"2014-09-20","13:00:00","17:00:00","carlos",1118291793,"si"),
("","computador",6,5,"2014-09-20","13:00:00","17:00:00","victor",1118291794,"si"),
("","computador",7,5,"2014-09-20","13:00:00","17:00:00","victor",1118291794,"no"),
("","computador",8,5,"2014-09-20","13:00:00","17:00:00","victor",1118291794,"si"),
("","testers",9,5,"2014-09-20","13:00:00","17:00:00","alex",1118291795,"si"),
("","computador",10,5,"2014-09-20","13:00:00","17:00:00","alex",1118291795,"no"),
("","testers",11,5,"2014-09-20","13:00:00","17:00:00","johan",1118291796,"si"),
("","computador",12,5,"2014-09-20","13:00:00","17:00:00","johan",1118291796,"no"),
("","mesa",13,5,"2014-09-20","13:00:00","17:00:00","johan",1118291796,"si"),
("","computador",14,5,"2014-09-20","13:00:00","17:00:00","alvaro",1118291797,"si"),
("","computador",15,5,"2014-09-20","13:00:00","17:00:00","daniel",1118291798,"no"),
("","computador",16,5,"2014-09-20","13:00:00","17:00:00","daniel",1118291798,"si"),
("","testers",17,5,"2014-09-20","13:00:00","17:00:00","sebastian",1118291799,"si");


insert into grupos values
("","tps40","tecnico en programacion de sofware","2014-03-20","2015-03-20",20),
("","tps41","tecnico en programacion de sofware","2014-03-20","2015-03-20",20),
("","tps42","tecnico en programacion de sofware","2014-03-20","2015-03-20",20),
("","tps43","tecnico en programacion de sofware","2014-03-20","2015-03-20",20),
("","tps44","tecnico en programacion de sofware","2014-03-20","2015-03-20",20),
("","adsi45","analisis de sistemas de informacion","2014-03-20","2015-03-20",20),
("","adsi46","analisis de sistemas de informacion","2014-03-20","2015-03-20",20),
("","adsi47","analisis de sistemas de informacion","2014-03-20","2015-03-20",20),
("","tso44","tecnico en seguridad ocupacional","2014-03-20","2015-03-20",20),
("","tso45","tecnico en seguridad ocupacional","2014-03-20","2015-03-20",20),
("","tso46","tecnico en seguridad ocupacional","2014-03-20","2015-03-20",20),
("","tso47","tecnico en seguridad ocupacional","2014-03-20","2015-03-20",20),
("","tso48","tecnico en seguridad ocupacional","2014-03-20","2015-03-20",20);


insert into reservaAmbientes values
("","2014-03-20","2015-03-20","lunes","13:00:00","17:00:00",1,1118291792,2,"si"),
("","2014-03-20","2015-03-20","martes","13:00:00","17:00:00",2,1118291793,1,"no"),
("","2014-03-20","2015-03-20","miercoles","13:00:00","17:00:00",3,1118291794,3,"si"),
("","2014-03-20","2015-03-20","jueves","13:00:00","17:00:00",4,1118291795,4,"no"),
("","2014-03-20","2015-03-20","viernes","13:00:00","17:00:00",5,1118291796,5,"si"),
("","2014-03-20","2015-03-20","sabado","13:00:00","17:00:00",6,1118291797,6,"si"),
("","2014-03-20","2015-03-20","lunes","13:00:00","17:00:00",7,1118291798,7,"si"),
("","2014-03-20","2015-03-20","martes","13:00:00","17:00:00",8,1118291799,8,"no"),
("","2014-03-20","2015-03-20","miercoles","13:00:00","17:00:00",9,1118291800,9,"si"),
("","2014-03-20","2015-03-20","jueves","13:00:00","17:00:00",1,1118291801,10,"si"),
("","2014-03-20","2015-03-20","viernes","13:00:00","17:00:00",2,1118291792,11,"no"),
("","2014-03-20","2015-03-20","sabado","13:00:00","17:00:00",3,1118291793,12,"no"),
("","2014-03-20","2015-03-20","lunes","13:00:00","17:00:00",4,1118291794,13,"si"),
("","2014-03-20","2015-03-20","martes","13:00:00","17:00:00",5,1118291795,1,"si"),
("","2014-03-20","2015-03-20","miercoles","13:00:00","17:00:00",1,1118291796,2,"no"),
("","2014-03-20","2015-03-20","jueves","13:00:00","17:00:00",2,1118291797,1,"si"),
("","2014-03-20","2015-03-20","viernes","13:00:00","17:00:00",3,1118291798,2,"si"),
("","2014-03-20","2015-03-20","sabado","13:00:00","17:00:00",4,1118291799,3,"no"),
("","2014-03-20","2015-03-20","lunes","13:00:00","17:00:00",5,1118291800,4,"si");




