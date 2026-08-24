create database crud_petshop;
use crud_petshop;

create table donos (
    id int primary key auto_increment,
    nome varchar(100) not null,
    email varchar(100) not null,
    telefone varchar(20) not null
);

create table cachorros (
    id int primary key auto_increment,
    nome varchar(100) not null,
    raca varchar(50) not null,
    idade int not null,
    porte varchar(20) not null,

    id_dono int not null,
    foreign key (id_dono) references donos(id)
);

insert into donos (nome, email, telefone) values
('João Silva', 'joao.silva@email.com', '11999990000'),
('Maria Santos', 'maria.santos@email.com', '11988881111'),
('Carlos Oliveira', 'carlos.oliveira@email.com', '11977772222'),
('Ana Souza', 'ana.souza@email.com', '11966663333'),
('Pedro Costa', 'pedro.costa@email.com', '11955554444'),
('Juliana Lima', 'juliana.lima@email.com', '11944445555'),
('Rafael Almeida', 'rafael.almeida@email.com', '11933336666'),
('Camila Rodrigues', 'camila.rodrigues@email.com', '11922227777'),
('Lucas Ferreira', 'lucas.ferreira@email.com', '11911118888'),
('Beatriz Martins', 'beatriz.martins@email.com', '11900009999');

insert into cachorros (nome, raca, idade, porte, id_dono) values
('Rex', 'Labrador', 3, 'grande', 1),
('Bella', 'Poodle', 2, 'pequeno', 2),
('Thor', 'Bulldog Francês', 4, 'pequeno', 3),
('Mel', 'Golden Retriever', 1, 'grande', 4),
('Bidu', 'Vira-lata', 5, 'médio', 5),
('Luna', 'Shih Tzu', 2, 'pequeno', 6),
('Max', 'Pastor Alemão', 6, 'grande', 7),
('Nina', 'Chihuahua', 1, 'pequeno', 8),
('Zeus', 'Rottweiler', 3, 'grande', 9),
('Amora', 'Beagle', 2, 'médio', 10);



-- Listar todos os donos
select * from donos;

-- Listar todos os cachorros
select * from cachorros;

-- Listar cachorros junto com o nome do dono
select cachorros.nome as cachorro, cachorros.raca, donos.nome as dono, donos.telefone
from cachorros
join donos on cachorros.id_dono = donos.id;

-- Buscar cachorro por nome
select * from cachorros where nome = 'Rex';

-- Buscar dono por email
select * from donos where email = 'joao.silva@email.com';


-- Atualizar telefone do dono
update donos set telefone = '11999998888' where id = 1;

-- Atualizar porte do cachorro
update cachorros set porte = 'médio' where id = 1;



delete from cachorros where id = 10;

