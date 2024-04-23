drop database if exists carrinhoBrasil;
create database carrinhoBrasil;
use carrinhoBrasil;

create table produto(
	id_produto int primary key auto_increment,
    nome varchar(200),
    imagem varchar(125),
    preco decimal(10, 2);
);

create table produto_in_pedido(
    id_produto int auto_increment,
    id_pedido int auto_increment,
    qntPorUnidade INT,
    foreign key (id_produto) references pedidos(id_produto),
    foreign key (id_pedido) references produtos(id_pedido)
);

create table pedido(
    id_pedido int primary key auto_increment,
    cliente_id INT,
    preco_pedido DECIMAL(10, 2),
    data_pedido TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    foreign key (cliente_id) REFERENCES clientes(cliente_id)
);

create table usuario(
    id_usuario int primary key auto_increment,
    email varchar(200),
    nome varchar(200),
    senha varchar(200)
);

insert into usuario (nome, email, senha) values ("Rian", "a@a", "asasas");