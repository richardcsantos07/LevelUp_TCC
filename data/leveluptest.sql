-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 25/04/2025 às 18:39
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `leveluptest`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `aluno`
--

CREATE TABLE `aluno` (
  `ra` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `turma` varchar(100) DEFAULT NULL,
  `serie` varchar(50) DEFAULT NULL,
  `dataNasc` date DEFAULT NULL,
  `nivelAcesso` varchar(50) DEFAULT NULL,
  `id_inst` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `aluno`
--

INSERT INTO `aluno` (`ra`, `nome`, `email`, `senha`, `turma`, `serie`, `dataNasc`, `nivelAcesso`, `id_inst`) VALUES
(0, 'Richard Camargo dos Santos', 'richardcamargodosantos@gmail.com', 'aluno1234', 'A', '3', '2025-04-24', NULL, 3),
(12345, 'Lucas', 'lucas@gmail.com', 'lucas1234', 'A', '3', '2025-04-24', NULL, 3);

-- --------------------------------------------------------

--
-- Estrutura para tabela `atividade`
--

CREATE TABLE `atividade` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `descricao` text DEFAULT NULL,
  `materia` varchar(255) DEFAULT NULL,
  `nota` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `crianca`
--

CREATE TABLE `crianca` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `idResponsavel` int(11) DEFAULT NULL,
  `dataNasc` date DEFAULT NULL,
  `nivelAcesso` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `desenvolvedor`
--

CREATE TABLE `desenvolvedor` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `dataNasc` date DEFAULT NULL,
  `nivelAcesso` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `instituicao`
--

CREATE TABLE `instituicao` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `nivelAcesso` varchar(50) DEFAULT 'admin',
  `cnpj` varchar(20) DEFAULT NULL,
  `tipoInstituicao` varchar(100) DEFAULT NULL,
  `dataCriacaoInst` date DEFAULT NULL,
  `estado` varchar(100) DEFAULT NULL,
  `bairro` varchar(255) DEFAULT NULL,
  `rua` varchar(255) DEFAULT NULL,
  `num` int(11) DEFAULT NULL,
  `cep` varchar(20) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `instituicao`
--

INSERT INTO `instituicao` (`id`, `nome`, `email`, `senha`, `nivelAcesso`, `cnpj`, `tipoInstituicao`, `dataCriacaoInst`, `estado`, `bairro`, `rua`, `num`, `cep`, `telefone`) VALUES
(3, 'Etec Uirapuru', 'uirapuru@etec.sp.gov.br', 'uirapuru1234', 'admin', '55555555555555', 'pública', '2025-04-22', 'SÃO PAULO', 'Jardim Cláudia', 'Rua General Teixeira de Campos', 233, '05546-000', '11930248633');

-- --------------------------------------------------------

--
-- Estrutura para tabela `jogo`
--

CREATE TABLE `jogo` (
  `cod` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `indicacao` varchar(255) DEFAULT NULL,
  `codCategoria` int(11) DEFAULT NULL,
  `nomeCategoria` varchar(255) DEFAULT NULL,
  `dataCad` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `professor`
--

CREATE TABLE `professor` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `materia` varchar(255) DEFAULT NULL,
  `dataNasc` date DEFAULT NULL,
  `nivelAcesso` varchar(50) DEFAULT 'professor',
  `telefone` varchar(20) DEFAULT NULL,
  `id_inst` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `professor`
--

INSERT INTO `professor` (`id`, `nome`, `email`, `senha`, `materia`, `dataNasc`, `nivelAcesso`, `telefone`, `id_inst`) VALUES
(3, 'RICHARD CAMARGO DOS SANTOS', 'silshe@globomail.com', '222', 'artes', '2025-04-23', 'professor', '11930248633', 3);

-- --------------------------------------------------------

--
-- Estrutura para tabela `responsavel`
--

CREATE TABLE `responsavel` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `dataNasc` date DEFAULT NULL,
  `nivelAcesso` varchar(50) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `responsavel_crianca`
--

CREATE TABLE `responsavel_crianca` (
  `responsavel_id` int(11) NOT NULL,
  `crianca_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `turma`
--

CREATE TABLE `turma` (
  `id` int(11) NOT NULL,
  `turma` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `turma_aluno`
--

CREATE TABLE `turma_aluno` (
  `turma_id` int(11) NOT NULL,
  `aluno_ra` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`ra`),
  ADD KEY `fk_aluno_instituicao` (`id_inst`);

--
-- Índices de tabela `atividade`
--
ALTER TABLE `atividade`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `crianca`
--
ALTER TABLE `crianca`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idResponsavel` (`idResponsavel`);

--
-- Índices de tabela `desenvolvedor`
--
ALTER TABLE `desenvolvedor`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `instituicao`
--
ALTER TABLE `instituicao`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `jogo`
--
ALTER TABLE `jogo`
  ADD PRIMARY KEY (`cod`);

--
-- Índices de tabela `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_aluno_instituicao` (`id_inst`);

--
-- Índices de tabela `responsavel`
--
ALTER TABLE `responsavel`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `responsavel_crianca`
--
ALTER TABLE `responsavel_crianca`
  ADD PRIMARY KEY (`responsavel_id`,`crianca_id`),
  ADD KEY `crianca_id` (`crianca_id`);

--
-- Índices de tabela `turma`
--
ALTER TABLE `turma`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `turma_aluno`
--
ALTER TABLE `turma_aluno`
  ADD PRIMARY KEY (`turma_id`,`aluno_ra`),
  ADD KEY `aluno_ra` (`aluno_ra`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `atividade`
--
ALTER TABLE `atividade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `crianca`
--
ALTER TABLE `crianca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `desenvolvedor`
--
ALTER TABLE `desenvolvedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `instituicao`
--
ALTER TABLE `instituicao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `jogo`
--
ALTER TABLE `jogo`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `professor`
--
ALTER TABLE `professor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `responsavel`
--
ALTER TABLE `responsavel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `turma`
--
ALTER TABLE `turma`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `aluno`
--
ALTER TABLE `aluno`
  ADD CONSTRAINT `fk_aluno_instituicao` FOREIGN KEY (`id_inst`) REFERENCES `instituicao` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `crianca`
--
ALTER TABLE `crianca`
  ADD CONSTRAINT `crianca_ibfk_1` FOREIGN KEY (`idResponsavel`) REFERENCES `responsavel` (`id`) ON DELETE SET NULL;

--
-- Restrições para tabelas `professor`
--
ALTER TABLE `professor`
  ADD CONSTRAINT `fk_professor_instituicao` FOREIGN KEY (`id_inst`) REFERENCES `instituicao` (`id`);

--
-- Restrições para tabelas `responsavel_crianca`
--
ALTER TABLE `responsavel_crianca`
  ADD CONSTRAINT `responsavel_crianca_ibfk_1` FOREIGN KEY (`responsavel_id`) REFERENCES `responsavel` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `responsavel_crianca_ibfk_2` FOREIGN KEY (`crianca_id`) REFERENCES `crianca` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `turma_aluno`
--
ALTER TABLE `turma_aluno`
  ADD CONSTRAINT `turma_aluno_ibfk_1` FOREIGN KEY (`turma_id`) REFERENCES `turma` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `turma_aluno_ibfk_2` FOREIGN KEY (`aluno_ra`) REFERENCES `aluno` (`ra`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
