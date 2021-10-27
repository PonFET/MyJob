create database IF NOT EXISTS MyJob;

use MyJob;

#drop database  MyJob;

create table  IF NOT EXISTS students(
id int not null,
studentId int not null,
careerId int not null,
firstName varchar(30) not null,
lastName varchar(30) not null,
dni int not null,
fileNumber int not null,
phoneNumber int not null,
gender varchar(30) not null,
birthDate varchar(30) not null,
active varchar(30) not null,
primary key (studentId),
primary key (dni),
constraint uniq_email unique (email),
constraint fk_id foreign key (id) references cuentas(id),
constraint uniq_dni unique (dni)
);
#drop table  students;

create table IF NOT EXISTS accounts(
id int not null auto_increment ,
email varchar(50) not null,
password varchar(50),
privilegios int default 1,
primary key (id),
constraint uniq_email unique (email)
);
#drop table accounts;
