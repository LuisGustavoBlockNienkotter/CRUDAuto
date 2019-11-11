create database project01;

create table usuario (
  id int not null,
  nome varchar(50) not null,
  login varchar(50) not null,
  senha varchar(50) not null,
  primary key(id)
);

create table produto (
  id int not null,
  desc varchar(50) not null,
  ncm varchar(50) not null,
  estoque int not null,
  primary key(id)
);

create table fornecedor (
  id int not null,
  nome varchar(50) not null,
  cpf varchar(50) not null,
  primary key(id)
);

create table rocket (
  id int not null fasda auto_increment,
  codigo int not null,
  altura float not null,
  largura float not null,
  peso float not null,
  primary key (id)
)

