

CREATE DATABASE hospital;
USE hospital;

CREATE TABLE medico (
    medcodigo INT PRIMARY KEY auto_increment,
    mednome VARCHAR(100)
);

CREATE TABLE paciente (
    paccodigo INT PRIMARY KEY auto_increment,
    pacnome VARCHAR(100)
);

CREATE TABLE consulta (
    id_medcodigo INT,
    id_paccodigo INT,
    concodigo INT primary key auto_increment,
    data date,
    FOREIGN KEY (id_medcodigo) REFERENCES medico(medcodigo),
    FOREIGN KEY (id_paccodigo) REFERENCES paciente(paccodigo)
);

INSERT INTO medico (medcodigo, mednome) VALUES
(1,'Dr. Luan'),
(2 ,'Dr. Rodrigo');

INSERT INTO paciente (paccodigo,pacnome) VALUES
(1,'Sarah'),
(2,'Loira');

insert into consulta (id_medcodigo, id_paccodigo, concodigo) values
(1, 2, 1),
(2, 1, 2);
 
SELECT 
medico.mednome,
paciente.pacnome
FROM consulta
INNER JOIN medico ON consulta.id_medcodigo = medico.medcodigo
INNER JOIN paciente ON consulta.id_paccodigo = paciente.paccodigo;