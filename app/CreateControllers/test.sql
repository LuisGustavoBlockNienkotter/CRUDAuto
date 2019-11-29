drop database if exists project01;

create database project01;

use project01;

create table usuario (
  id int not null auto_increment,
  nome varchar(50) not null,
  login varchar(50) not null,
  senha varchar(50) not null,
  primary key(id)
);

create table produto (
  id int not null auto_increment,
  descricao varchar(50) not null,
  ncm varchar(50) not null,
  estoque int not null,
  primary key(id)
);

create table fornecedor (
  id int not null auto_increment,
  nome varchar(50),
  cpf varchar(50),
  primary key(id)
);

create table cliente (
  id int not null auto_increment,
  nome varchar(50),
  cpf varchar(50),
  rg varchar(50),
  primary key(id)
);