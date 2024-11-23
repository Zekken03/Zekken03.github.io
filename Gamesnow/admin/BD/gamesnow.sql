create database gamesnow;

use gamesnow;

create table users(
id integer not null auto_increment,
name varchar (30),
last_name varchar (30),
age integer,
weight double,
height double,
email varchar (50),
password varchar (100),
level tinyint,
img varchar (30),
primary key (id)
)

insert into users values
(0, 'Luis', 'Grijalva', 33, 62,173, 'admin@gmail.com','123',1, 'default'),
(0, 'Pablo', 'Grijalva', 33, 62,173, 'admin@gmail.com','123',2, 'default'),
(0, 'Pepe', 'Grijalva', 33, 62,173, 'admin@gmail.com','123',2, 'default')