create database crud_petshop;
use crud_petshop;

create table donos (
    id int primary key auto_increment,
    nome varchar(100) not null,
    email varchar(100) not null,
    telefone varchar(20) not null
);

create table animais (
    id int primary key auto_increment,
    nome varchar(100) not null,
    raca varchar(50) not null,
    descricao text not null,
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

insert into animais (nome, raca, descricao, idade, porte, id_dono) values
('Rex', 'Labrador', 'Muito brincalhão e gosta de crianças', 3, 'grande', 1),
('Bella', 'Poodle', 'Calma, late pouco', 2, 'pequeno', 2),
('Thor', 'Bulldog Francês', 'Preguiçoso, adora dormir', 4, 'pequeno', 3),
('Mel', 'Golden Retriever', 'Muito dócil e sociável', 1, 'grande', 4),
('Bidu', 'Vira-lata', 'Agitado, precisa de bastante exercício', 5, 'médio', 5),
('Luna', 'Shih Tzu', 'Tímida com estranhos', 2, 'pequeno', 6),
('Max', 'Pastor Alemão', 'Protetor e obediente', 6, 'grande', 7),
('Nina', 'Chihuahua', 'Late bastante, é bem territorial', 1, 'pequeno', 8),
('Zeus', 'Rottweiler', 'Forte e leal ao dono', 3, 'grande', 9),
('Amora', 'Beagle', 'Curiosa e cheia de energia', 2, 'médio', 10);




select * from donos;


select * from animais;


select animais.nome as animal, animais.raca, animais.descricao, donos.nome as dono, donos.telefone
from animais
join donos on animais.id_dono = donos.id;


select * from animais where id_dono = 1;


select * from animais where nome = 'Rex';


select * from donos where email = 'joao.silva@email.com';




update donos set telefone = '11999998888' where id = 1;


update animais
set nome = 'Rex', raca = 'Labrador', descricao = 'Muito brincalhão', idade = 4, porte = 'grande'
where id = 1;


delete from animais where id = 10;

