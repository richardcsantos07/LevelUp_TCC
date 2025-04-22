-- Script para criação do banco de dados de teste baseado no diagrama de classes

CREATE DATABASE LevelUpTest;
USE LevelUpTest;

-- Tabela Instituicao
CREATE TABLE Instituicao (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255),
    senha VARCHAR(255),
    nivelAcesso VARCHAR(50),
    cnpj VARCHAR(20),
    tipoInstituicao VARCHAR(100),
    dataCriacaoInst DATE,
    estado VARCHAR(100),
    bairro VARCHAR(255),
    rua VARCHAR(255),
    num INT,
    cep VARCHAR(20),
    telefone VARCHAR(20)
);

-- Tabela Responsavel
CREATE TABLE Responsavel (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255),
    senha VARCHAR(255),
    dataNasc DATE,
    nivelAcesso VARCHAR(50),
    telefone VARCHAR(20)
);

-- Tabela Crianca
CREATE TABLE Crianca (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255),
    senha VARCHAR(255),
    idResponsavel INT,
    dataNasc DATE,
    nivelAcesso VARCHAR(50),
    FOREIGN KEY (idResponsavel) REFERENCES Responsavel(id) ON DELETE SET NULL
);

-- Tabela Aluno
CREATE TABLE Aluno (
    ra INT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255),
    senha VARCHAR(255),
    turma VARCHAR(100),
    serie VARCHAR(50),
    dataNasc DATE,
    nivelAcesso VARCHAR(50),
    nomeInstituicao VARCHAR(255)
);

-- Tabela Professor
CREATE TABLE Professor (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255),
    senha VARCHAR(255),
    materia VARCHAR(255),
    dataNasc DATE,
    nivelAcesso VARCHAR(50),
    telefone VARCHAR(20)
);

-- Tabela Turma
CREATE TABLE Turma (
    id INT AUTO_INCREMENT PRIMARY KEY,
    turma VARCHAR(100)
);

-- Tabela de relacionamento Turma_Aluno (muitos para muitos)
CREATE TABLE Turma_Aluno (
    turma_id INT,
    aluno_ra INT,
    PRIMARY KEY (turma_id, aluno_ra),
    FOREIGN KEY (turma_id) REFERENCES Turma(id) ON DELETE CASCADE,
    FOREIGN KEY (aluno_ra) REFERENCES Aluno(ra) ON DELETE CASCADE
);

-- Tabela Jogo
CREATE TABLE Jogo (
    cod INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    indicacao VARCHAR(255),
    codCategoria INT,
    nomeCategoria VARCHAR(255),
    dataCad DATE
);

-- Tabela Desenvolvedor
CREATE TABLE Desenvolvedor (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255),
    senha VARCHAR(255),
    dataNasc DATE,
    nivelAcesso VARCHAR(50)
);

-- Tabela Atividade
CREATE TABLE Atividade (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    descricao TEXT,
    materia VARCHAR(255),
    nota VARCHAR(50)
);

-- Tabela de relacionamento Responsavel_Crianca (um para muitos)
CREATE TABLE Responsavel_Crianca (
    responsavel_id INT,
    crianca_id INT,
    PRIMARY KEY (responsavel_id, crianca_id),
    FOREIGN KEY (responsavel_id) REFERENCES Responsavel(id) ON DELETE CASCADE,
    FOREIGN KEY (crianca_id) REFERENCES Crianca(id) ON DELETE CASCADE
);
