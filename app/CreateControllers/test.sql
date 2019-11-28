create database project01;

use project01;

create table usuario (
  id int not null auto_increment,
  nome varchar(50) not null,
  login varchar(50) not null,
  senha varchar(50) not null,
  primary key(id)
);


insert