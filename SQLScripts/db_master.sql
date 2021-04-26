SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `db_master`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `medic`
--

CREATE TABLE `medic` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `crm` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `medic_specialty`
--

CREATE TABLE `medic_specialty` (
  `id` int(11) NOT NULL,
  `medic_id` int(11) NOT NULL,
  `specialty_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `specialty`
--

CREATE TABLE `specialty` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `specialty`
--

INSERT INTO `specialty` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'ALERGOLOGIA', '2021-04-24 21:47:30', '2021-04-25 00:51:41'),
(2, 'ANGIOLOGIA', '2021-04-24 21:47:30', '2021-04-25 00:51:41'),
(3, 'BUCO MAXILO', '2021-04-24 21:48:07', '2021-04-25 00:51:41'),
(4, 'CARDIOLOGIA CLINICA', '2021-04-24 21:48:07', '2021-04-25 00:51:41'),
(5, 'CARDIOLOGIA INFANTIL', '2021-04-24 21:48:48', '2021-04-25 00:51:41'),
(6, 'CIRURGIA CABEÇA E PESCOÇO', '2021-04-24 21:48:48', '2021-04-25 00:51:41'),
(7, 'CIRURGIA CARDÍACA', '2021-04-24 21:48:48', '2021-04-25 00:51:41'),
(8, 'CIRURGIA DE CABEÇA/PESCOÇO', '2021-04-24 21:48:48', '2021-04-25 00:51:41'),
(9, 'CIRURGIA DE TORAX', '2021-04-24 21:48:48', '2021-04-25 00:51:41'),
(10, 'CIRURGIA GERAL', '2021-04-24 21:50:20', '2021-04-25 00:51:41'),
(11, 'CIRURGIA PEDIÁTRICA', '2021-04-24 21:50:20', '2021-04-25 00:51:41'),
(12, 'CIRURGIA PLÁSTICA', '2021-04-24 21:50:20', '2021-04-25 00:51:41'),
(13, 'CIRURGIA TORÁCICA', '2021-04-24 21:51:00', '2021-04-25 00:51:41'),
(14, 'CIRURGIA VASCULAR', '2021-04-24 21:51:00', '2021-04-25 00:51:41'),
(15, 'CLINICA MEDICA', '2021-04-24 21:51:00', '2021-04-25 00:51:41');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `medic`
--
ALTER TABLE `medic`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `medic_specialty`
--
ALTER TABLE `medic_specialty`
  ADD PRIMARY KEY (`id`),
  ADD KEY `specialty_id` (`specialty_id`),
  ADD KEY `medic_id` (`medic_id`);

--
-- Índices para tabela `specialty`
--
ALTER TABLE `specialty`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `medic`
--
ALTER TABLE `medic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `medic_specialty`
--
ALTER TABLE `medic_specialty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `specialty`
--
ALTER TABLE `specialty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `medic_specialty`
--
ALTER TABLE `medic_specialty`
  ADD CONSTRAINT `medic_specialty_ibfk_2` FOREIGN KEY (`specialty_id`) REFERENCES `specialty` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `medic_specialty_ibfk_3` FOREIGN KEY (`medic_id`) REFERENCES `medic` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
