-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 10/06/2025 às 14:46
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
  `dataNasc` date DEFAULT NULL,
  `nivelAcesso` varchar(50) DEFAULT 'user',
  `id_inst` int(10) DEFAULT NULL,
  `nome_responsavel` varchar(250) DEFAULT NULL,
  `tell_responsavel` varchar(100) DEFAULT NULL,
  `tell` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `aluno`
--

INSERT INTO `aluno` (`ra`, `nome`, `email`, `senha`, `turma`, `dataNasc`, `nivelAcesso`, `id_inst`, `nome_responsavel`, `tell_responsavel`, `tell`) VALUES
(4575, 'Richard Camargo dos Santos', 'richardcamargo@gmail.com', 'rcds2005', '1º A - Manhã', '2005-11-07', 'user', 3, 'PATRICIA LUCIANA CAMARGO', '11930248633', '11930248633'),
(4576, 'Lucas Almeida Sporques', 'lucassporques@gmail.com', 'lucas1234', '3º B - Tarde', '2005-07-10', 'user', 3, 'Sr. Almeida ', '11930248633', '1194540577');

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
-- Estrutura para tabela `atividade_aluno`
--

CREATE TABLE `atividade_aluno` (
  `id_atv` int(11) NOT NULL,
  `id_aluno` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `nota` decimal(4,2) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `materia` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `comunicado`
--

CREATE TABLE `comunicado` (
  `id` int(11) NOT NULL,
  `titulo` varchar(250) DEFAULT NULL,
  `destinatario` varchar(250) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `arquivo_upado` text DEFAULT NULL,
  `id_inst` int(11) DEFAULT NULL,
  `data_comunicado` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `comunicado`
--

INSERT INTO `comunicado` (`id`, `titulo`, `destinatario`, `descricao`, `arquivo_upado`, `id_inst`, `data_comunicado`) VALUES
(7, 'Semana da Tecnologia', '1a', 'semana de estudos intensivos', NULL, 3, NULL),
(8, 'Semana da Tecnologia', '1a', 'semana de estudos intensivos', NULL, 3, '2025-06-17'),
(9, 'Semana da Tecnologia', '1a', 'semana de estudos intensivos', NULL, 3, '2025-06-17');

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
  `nivelAcesso` varchar(50) DEFAULT 'user',
  `telefone` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `crianca`
--

INSERT INTO `crianca` (`id`, `nome`, `email`, `senha`, `idResponsavel`, `dataNasc`, `nivelAcesso`, `telefone`) VALUES
(4, 'Richard Camargo', 'richardcamargodosantos@gmail.com', 'rcds2005', 3, '2005-11-07', 'user', '11930248633');

-- --------------------------------------------------------

--
-- Estrutura para tabela `game_progress`
--

CREATE TABLE `game_progress` (
  `id` int(11) NOT NULL,
  `id_aluno` int(11) NOT NULL,
  `game_name` varchar(50) NOT NULL,
  `current_level` int(11) NOT NULL,
  `max_levels` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
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
(3, 'Etec Uirapuru CPS', 'uirapuru@etec.sp.gov.br', 'uirapuru1234', 'admin', '55555555555555', 'pública', '2025-04-22', 'SÃO PAULO', 'Jardim Cláudia', 'Rua General Teixeira de Campos', 233, '05546-000', '11930248633');

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
  `id_inst` int(11) DEFAULT NULL,
  `cpf` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `professor`
--

INSERT INTO `professor` (`id`, `nome`, `email`, `senha`, `materia`, `dataNasc`, `nivelAcesso`, `telefone`, `id_inst`, `cpf`) VALUES
(6, 'Davi Coelho Branco', 'davicoelhobranco@gmail.com', 'branco1234', 'Fisica', '1982-04-24', 'professor', '11984140536', 3, '30959593896');

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
  `nivelAcesso` varchar(50) DEFAULT 'admin',
  `telefone` varchar(20) DEFAULT NULL,
  `cpf` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `responsavel`
--

INSERT INTO `responsavel` (`id`, `nome`, `email`, `senha`, `dataNasc`, `nivelAcesso`, `telefone`, `cpf`) VALUES
(3, 'Silvio Donizete dos Santos', 'silshe@globomail.com', 'silvio1234', '1982-06-15', 'admin', '(11) 974633374', '521.313.828-47');

-- --------------------------------------------------------

--
-- Estrutura para tabela `turma`
--

CREATE TABLE `turma` (
  `id` int(11) NOT NULL,
  `turma` varchar(100) DEFAULT NULL,
  `id_inst` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `turma`
--

INSERT INTO `turma` (`id`, `turma`, `id_inst`) VALUES
(1, '1º A - Manhã', 3),
(2, '3º B - Tarde', 3),
(5, '4º c - Manhã', 3);

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
-- Índices de tabela `atividade_aluno`
--
ALTER TABLE `atividade_aluno`
  ADD PRIMARY KEY (`id_atv`,`id_aluno`),
  ADD KEY `id_aluno` (`id_aluno`);

--
-- Índices de tabela `comunicado`
--
ALTER TABLE `comunicado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_id_inst` (`id_inst`);

--
-- Índices de tabela `crianca`
--
ALTER TABLE `crianca`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idResponsavel` (`idResponsavel`);

--
-- Índices de tabela `game_progress`
--
ALTER TABLE `game_progress`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_aluno` (`id_aluno`,`game_name`);

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
-- Índices de tabela `turma`
--
ALTER TABLE `turma`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_turma_instituicao` (`id_inst`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `atividade`
--
ALTER TABLE `atividade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `comunicado`
--
ALTER TABLE `comunicado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `crianca`
--
ALTER TABLE `crianca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `game_progress`
--
ALTER TABLE `game_progress`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `responsavel`
--
ALTER TABLE `responsavel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `turma`
--
ALTER TABLE `turma`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `aluno`
--
ALTER TABLE `aluno`
  ADD CONSTRAINT `fk_aluno_instituicao` FOREIGN KEY (`id_inst`) REFERENCES `instituicao` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `atividade_aluno`
--
ALTER TABLE `atividade_aluno`
  ADD CONSTRAINT `atividade_aluno_ibfk_1` FOREIGN KEY (`id_atv`) REFERENCES `atividade` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `atividade_aluno_ibfk_2` FOREIGN KEY (`id_aluno`) REFERENCES `aluno` (`ra`) ON DELETE CASCADE;

--
-- Restrições para tabelas `comunicado`
--
ALTER TABLE `comunicado`
  ADD CONSTRAINT `fk_comunicado_inst` FOREIGN KEY (`id_inst`) REFERENCES `instituicao` (`id`) ON UPDATE CASCADE;

--
-- Restrições para tabelas `crianca`
--
ALTER TABLE `crianca`
  ADD CONSTRAINT `crianca_ibfk_1` FOREIGN KEY (`idResponsavel`) REFERENCES `responsavel` (`id`) ON DELETE SET NULL;

--
-- Restrições para tabelas `game_progress`
--
ALTER TABLE `game_progress`
  ADD CONSTRAINT `game_progress_ibfk_1` FOREIGN KEY (`id_aluno`) REFERENCES `aluno` (`ra`);

--
-- Restrições para tabelas `professor`
--
ALTER TABLE `professor`
  ADD CONSTRAINT `fk_professor_instituicao` FOREIGN KEY (`id_inst`) REFERENCES `instituicao` (`id`);

--
-- Restrições para tabelas `turma`
--
ALTER TABLE `turma`
  ADD CONSTRAINT `fk_turma_instituicao` FOREIGN KEY (`id_inst`) REFERENCES `instituicao` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
