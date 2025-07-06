-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 07/07/2025 às 01:45
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
-- Banco de dados: `sistemadino`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `dinossauros`
--

CREATE TABLE `dinossauros` (
  `idDinossauro` int(11) NOT NULL,
  `nomeDinossauro` varchar(100) NOT NULL,
  `especieDinossauro` varchar(100) NOT NULL,
  `dietaDinossauro` varchar(50) NOT NULL,
  `generoDinossauro` varchar(20) NOT NULL,
  `fotoDinossauro` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `reservas`
--

CREATE TABLE `reservas` (
  `idReserva` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `areaVisita` varchar(100) NOT NULL,
  `dataVisita` date NOT NULL,
  `quantidadeVisitantes` int(11) NOT NULL,
  `comGuia` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `reservas`
--

INSERT INTO `reservas` (`idReserva`, `idUsuario`, `areaVisita`, `dataVisita`, `quantidadeVisitantes`, `comGuia`) VALUES
(24, 5, 'carnivoros', '2025-07-11', 3, 1),
(25, 5, 'museu', '2025-07-25', 1, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `nomeUsuario` varchar(50) NOT NULL,
  `emailUsuario` varchar(50) NOT NULL,
  `senhaUsuario` varchar(50) NOT NULL,
  `tipoUsuario` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `nomeUsuario`, `emailUsuario`, `senhaUsuario`, `tipoUsuario`) VALUES
(3, 'ana', 'nana@gmail.com', '$2y$10$090KWjj8kFzivJYf32LWTezD6Ojv4Cg17WSNtm27l2Z', 'cliente'),
(4, 'geno', 'geno@gmail.com', '$2y$10$HwYWcnDVYKnFIEuZigI5HOzscul5h7UO9Y0na2gmE4t', 'cliente'),
(5, 'lilo', 'lilo@gmail.com', '202cb962ac59075b964b07152d234b70', 'administrador'),
(6, 'Silverval Cara de Pau', 'aaa@gmail.com', '202cb962ac59075b964b07152d234b70', 'cliente');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `dinossauros`
--
ALTER TABLE `dinossauros`
  ADD PRIMARY KEY (`idDinossauro`);

--
-- Índices de tabela `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`idReserva`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `dinossauros`
--
ALTER TABLE `dinossauros`
  MODIFY `idDinossauro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `reservas`
--
ALTER TABLE `reservas`
  MODIFY `idReserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
