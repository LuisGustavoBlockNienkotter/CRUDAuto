create database project01;

create table usuario (
  login varchar(50) not null,
  senha varchar(25) not null,
  nome varchar(25) not null,
  primary key(var1)
);

create table produto (
  desc varchar(50) not null,
  preco varchar(50) not null,
  estoque varchar(50) not null,
  ncm int not null,
  primary key(var1)
);

