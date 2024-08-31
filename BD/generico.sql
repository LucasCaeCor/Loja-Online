-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 07-Ago-2024 às 03:43
-- Versão do servidor: 8.0.26
-- versão do PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `generico`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `idPedido` int NOT NULL,
  `idUsuario` int NOT NULL,
  `idProduto` int NOT NULL,
  `dataPedido` date NOT NULL,
  `horaPedido` time NOT NULL,
  `statusPedido` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `pedidos`
--

INSERT INTO `pedidos` (`idPedido`, `idUsuario`, `idProduto`, `dataPedido`, `horaPedido`, `statusPedido`) VALUES
(1, 3, 1, '2024-08-06', '22:04:24', 'Solicitado'),
(2, 3, 1, '2024-08-06', '22:13:21', 'Solicitado');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `idProduto` int NOT NULL,
  `fotoProduto` varchar(100) NOT NULL,
  `nomeProduto` varchar(30) NOT NULL,
  `descricaoProduto` varchar(100) NOT NULL,
  `categoriaProduto` varchar(20) NOT NULL,
  `valorProduto` decimal(10,2) NOT NULL,
  `condicaoProduto` varchar(15) NOT NULL,
  `dataCadastroProduto` date NOT NULL,
  `horaCadastroProduto` time NOT NULL,
  `statusProduto` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`idProduto`, `fotoProduto`, `nomeProduto`, `descricaoProduto`, `categoriaProduto`, `valorProduto`, `condicaoProduto`, `dataCadastroProduto`, `horaCadastroProduto`, `statusProduto`) VALUES
(1, 'img/switchNeon.webp', 'Nintendo Switch Neon', 'Console Nintendo Switch Standard Neon', 'alimentos', '1500.00', 'Novo', '2024-08-06', '22:43:03', 'disponivel'),
(2, 'img/logo_petshop.png', 'Osso', 'Osso Pet Shop', 'vestuario', '100.00', 'Novo', '2024-07-10', '02:06:15', 'disponivel'),
(3, 'img/vans.webp', 'Tênis VANS', 'Calçado VANS preto Old School Bla bla bla bla', 'vestuario', '300.00', 'Novo', '2024-07-24', '02:47:09', 'esgotado');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int NOT NULL,
  `fotoUsuario` varchar(100) NOT NULL,
  `nomeUsuario` varchar(100) NOT NULL,
  `cidadeUsuario` varchar(50) NOT NULL,
  `telefoneUsuario` varchar(20) NOT NULL,
  `emailUsuario` varchar(50) NOT NULL,
  `senhaUsuario` varchar(100) NOT NULL,
  `dataCadastroUsuario` date NOT NULL,
  `horaCadastroUsuario` time NOT NULL,
  `tipoUsuario` varchar(20) NOT NULL,
  `statusUsuario` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `fotoUsuario`, `nomeUsuario`, `cidadeUsuario`, `telefoneUsuario`, `emailUsuario`, `senhaUsuario`, `dataCadastroUsuario`, `horaCadastroUsuario`, `tipoUsuario`, `statusUsuario`) VALUES
(1, 'img/senhorCapivara.jpeg', 'Capivara Roedora de Matos', 'telemaco', '(42) 99922-2222', 'capivara@gmail.com', '202cb962ac59075b964b07152d234b70', '2024-04-09', '21:43:36', 'administrador', 'ativo'),
(3, 'img/ana.jpg', 'Ana Conda', 'telemaco', '(23) 42323-4234', 'anaconda@gmail.com', '202cb962ac59075b964b07152d234b70', '2024-07-17', '01:22:43', 'consumidor', 'ativo');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`idPedido`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idProduto` (`idProduto`);

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`idProduto`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `idPedido` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `idProduto` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`),
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`idProduto`) REFERENCES `produtos` (`idProduto`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
