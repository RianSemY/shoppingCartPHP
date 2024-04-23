drop database if exists carrinhoBrasil;
create database carrinhoBrasil;
use carrinhoBrasil;

create table produto(
	id_produto int primary key auto_increment,
    nome varchar(200),
    imagem varchar(125),
    preco decimal(10, 2)
);

create table produto_in_pedido(
	id_pedido int,
    id_produto int,
    qntPorUnidade INT,
    foreign key (id_produto) references pedidos(id_produto),
    foreign key (id_pedido) references produtos(id_pedido)
);

create table pedido(
    id_pedido int primary key auto_increment,
    id_usuario int,
    preco_pedido DECIMAL(10, 2),
    data_pedido TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    foreign key (id_usuario) REFERENCES clientes(id_usuario)
);

create table usuario(
    id_usuario int primary key auto_increment,
    email varchar(200),
    nome varchar(200),
    senha varchar(200)
);

insert into usuario (nome, email, senha) values ("Rian", "a@a", "asasas");

INSERT INTO produto (nome, imagem, preco) VALUES
('Nike Air Max 270', 'air_max_270.jpg', 299.99),
('Adidas Ultraboost 21', 'ultraboost_21.jpg', 179.99),
('Puma RS-X3', 'puma_rs_x3.jpg', 129.99),
('New Balance Fresh Foam 1080v11', 'fresh_foam_1080v11.jpg', 149.99),
('Under Armour HOVR Infinite 3', 'hovr_infinite_3.jpg', 139.99),
('Brooks Ghost 13', 'ghost_13.jpg', 129.99);