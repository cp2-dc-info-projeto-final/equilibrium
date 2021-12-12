-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 12-Dez-2021 às 03:26
-- Versão do servidor: 5.7.17
-- PHP Version: 7.1.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `equilibrium`
--

DROP DATABASE IF EXISTS equilibrium;

CREATE DATABASE equilibrium;

USE equilibrium;


DROP USER IF EXISTS 'admin'@'localhost';

CREATE USER 'admin'@'localhost' IDENTIFIED BY 'admin';

GRANT ALL PRIVILEGES ON equilibrium.* TO 'admin'@'localhost';

-- --------------------------------------------------------

--
-- Estrutura da tabela `amizade`
--

CREATE TABLE `amizade` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_usuario_de` int(10) UNSIGNED NOT NULL,
  `id_usuario_para` int(10) UNSIGNED NOT NULL,
  `aceitou` tinyint(1) NOT NULL,
  `data` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `comentario`
--

CREATE TABLE `comentario` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_usuario` int(10) UNSIGNED NOT NULL,
  `id_post` int(10) UNSIGNED NOT NULL,
  `texto` varchar(400) NOT NULL,
  `dt_comentario` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `comentario`
--

INSERT INTO `comentario` (`id`, `id_usuario`, `id_post`, `texto`, `dt_comentario`) VALUES
(24, 15, 47, 'Muito gostoso e saudável.', '2021-12-11'),
(23, 15, 41, 'Estes monstros são muito elegantes. São mesmo.', '2021-12-11'),
(16, 15, 45, 'Muito gostoso. Eu recomendo.', '2021-12-10'),
(21, 14, 45, 'Amei esta receita. É muito fácil.', '2021-12-10'),
(25, 14, 41, 'Monstros muito fofos.', '2021-12-12'),
(26, 15, 45, 'Adoro bolo de cenoura.', '2021-12-12'),
(27, 15, 49, 'Suas dicas são excelentes. Já vou seguir.', '2021-12-12'),
(28, 14, 50, 'Eu fiz esta receita e é uma delecía. Vão por mim. Vale a pena!', '2021-12-12'),
(29, 18, 51, 'Vivamus eu semper quam. Ut vel volutpat lacus. Curabitur vestibulum lacus vel tempus efficitur. Vestibulum sodales varius faucibus. Pellentesque sed lectus non justo maximus aliquam.', '2021-12-12'),
(34, 18, 41, 'Gostei muito. Parabéns pelo artista.', '2021-12-12'),
(31, 18, 49, 'Dicas mt boas! Adorei.', '2021-12-12'),
(33, 18, 59, 'Maravilhoso. Um luxo!', '2021-12-12'),
(35, 18, 59, 'Ut blandit ultricies nibh vitae pretium. Nulla facilisi. Fusce dapibus enim mauris, ac maximus arcu posuere at.', '2021-12-12'),
(36, 15, 51, 'Boa dicas. Mt boas!', '2021-12-12');

-- --------------------------------------------------------

--
-- Estrutura da tabela `gostei`
--

CREATE TABLE `gostei` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_usuario` int(10) UNSIGNED NOT NULL,
  `id_post_ou_coment` int(10) UNSIGNED NOT NULL,
  `gostei_de_post_ou_coment` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `gostei`
--

INSERT INTO `gostei` (`id`, `id_usuario`, `id_post_ou_coment`, `gostei_de_post_ou_coment`) VALUES
(2, 15, 41, 0),
(4, 15, 6, 1),
(5, 15, 7, 1),
(6, 14, 9, 1),
(7, 15, 9, 1),
(8, 15, 15, 1),
(9, 15, 45, 0),
(10, 15, 17, 1),
(11, 14, 16, 1),
(13, 15, 20, 1),
(14, 15, 22, 1),
(15, 15, 23, 1),
(16, 15, 26, 1),
(17, 14, 25, 1),
(18, 14, 23, 1),
(19, 15, 49, 0),
(20, 15, 27, 1),
(21, 14, 47, 0),
(30, 18, 59, 0),
(23, 18, 29, 1),
(24, 18, 23, 1),
(25, 18, 30, 1),
(26, 18, 25, 1),
(27, 18, 49, 0),
(28, 18, 41, 0),
(31, 18, 31, 1),
(32, 15, 51, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `nome_img` varchar(255) DEFAULT NULL,
  `id_usuario` int(10) UNSIGNED NOT NULL,
  `texto` varchar(1750) NOT NULL,
  `dt_postagem` date NOT NULL,
  `alterado` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `posts`
--

INSERT INTO `posts` (`id`, `nome_img`, `id_usuario`, `texto`, `dt_postagem`, `alterado`) VALUES
(47, 'como-fazer-arroz-integral-gostoso.jpg', 14, 'Arroz integral\r\nIngredientes\r\n\r\n1 xícara (chá) de arroz integral\r\n3 xícaras (chá) de água fervente\r\n1 colher (chá) de colorau\r\n2 cenouras cruas raladas\r\n1 cebola picadinha\r\n2 dentes de alho\r\n1 colher (chá) de óleo\r\nsal a gosto\r\n\r\nModo de preparo\r\n\r\n- Pique bem a cebola e o alho e reserve.\r\n- Rale as cenouras e reserve.\r\n- Aqueça uma panela com o óleo e acrescente a cebola e o alho.\r\n- Refogue em fogo médio até que eles fiquem levemente dourados.\r\n- Acrescente a cenoura e o arroz e refogue por mais alguns minutos.\r\n- Adicione o colorau e o sal e misture bem.\r\n- Despeje a água fervente, mexa bem e tampe a panela.\r\n- Deixe cozinhar até que a água tenha secado completamente.\r\n- Você também pode preparar esse arroz na panela de pressão: para isso, cozinhe por 10 minutos depois que pegar pressão.\r\n- Viu como é bem fácil preparar um arroz integral gostoso?', '2021-12-10', 1),
(41, '240738868_3088188941412855_9009826850203493663_n.jpg', 15, 'Os monstros de H. P. Lovecraft.', '2021-12-10', 1),
(49, 'download (1).jpg', 15, 'Siga uma alimentação saudável. Se estiver comendo ou bebendo muito, pergunte-se o porquê dessa mudança e tente corrigir a tendência.\r\n\r\nMantenha um ritmo e qualidade de vida apropriados.\r\n\r\nFaça atividade física durante a semana ou realize pequenos exercícios, como andar no seu trajeto diário.\r\n\r\nRespeite um sono de qualidade e “desligue-se” do celular meia hora antes de ir dormir. A insônia compromete a memória.\r\n\r\nAdote o autocuidado, ele é essencial.\r\n\r\nTenha uma rede de apoio de qualidade para poder conversar e desabafar.\r\n\r\nFique atento à qualidade do seu aprendizado, se está falho ou não.\r\n\r\nEsteja aberto ao aprendizado de coisas novas.\r\n\r\nConsidere se o esquecimento ou se a memória ruim é ou não uma condição médica ou que tenha motivação com o seu trabalho.', '2021-12-12', 1),
(50, 'download (2).jpg', 14, 'Massa:\r\n200 g de biscoito de maisena\r\n150 g de margarina\r\nRecheio:\r\n1 lata de leite condensado (395 g)\r\n1 caixa de creme de leite (200 g)\r\nsuco de 4 limões\r\nraspas de 2 limões\r\nCobertura:\r\n3 ou 4 claras de ovo\r\n3 colheres (sopa) de açúcar\r\nraspas de 2 limões para decorar\r\n\r\nMODO DE PREPARO\r\nMassa:\r\n\r\nTriture o biscoito de maisena em um liquidificador ou processador.\r\n\r\nJunte a margarina e bata mais um pouco.\r\n\r\nDespeje a massa em uma forma de fundo removível (27 cm de diâmetro).\r\n\r\nCom as mãos, espalhe os biscoitos triturados no fundo e nas laterais da forma, cobrindo toda área de maneira uniforme.\r\n\r\nLeve ao forno médio (180° C), preaquecido, por aproximadamente 10 minutos.\r\n\r\nRecheio:\r\n\r\nBata todos os ingredientes no liquidificador (exceto as raspas de limão) até obter um creme liso e firme.\r\n\r\nRecheie a massa já assada e leve à geladeira por 30 minutos.\r\n\r\nCobertura:\r\n\r\nBata as claras em neve e acrescente o açúcar.\r\n\r\nMisture até obter um ponto de suspiro e leve ao forno até dourar.\r\n\r\nDesenforme a torta (sem retirar o fundo falso), despeje a cobertura e acrescente as raspas de limão.', '2021-12-12', 0),
(51, 'download (3).jpg', 18, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed accumsan purus a nulla egestas placerat. Vestibulum sit amet erat nec velit semper mollis. Phasellus rhoncus elit nec tincidunt ultricies. Donec pellentesque tincidunt diam, eu faucibus ante lobortis ut. Duis nec luctus leo, mollis suscipit turpis. Aenean lobortis nisi dignissim, ultricies ante commodo, pellentesque felis. Vestibulum dictum sagittis egestas. Vivamus odio libero, pellentesque a tempus varius, molestie ut nisi. Proin cursus posuere leo, vitae commodo lectus porta vel. Aliquam nec eleifend justo. Vivamus sit amet sapien fermentum sem consequat fermentum.\r\n\r\nSed euismod erat at ultrices efficitur. Nam consequat nibh in sapien tristique volutpat. Pellentesque pharetra nulla ex, sed lacinia elit ornare sit amet. Fusce sollicitudin dapibus libero, non fringilla nunc egestas nec. Cras dolor dui, semper sed laoreet sit amet, semper fermentum mauris. Duis rutrum ante justo, ut euismod orci malesuada nec. Pellentesque sagittis pulvinar massa, eget congue nunc fringilla sit amet. Sed non urna nec turpis egestas blandit. Duis vel bibendum purus. In tellus nibh, dictum consectetur magna sit amet, faucibus interdum velit.', '2021-12-12', 0),
(59, 'img_61b55cb88df338.19872864.jpg', 18, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris maximus suscipit posuere. In hac habitasse platea dictumst. Maecenas suscipit lacus id sapien vehicula vehicula. Quisque volutpat velit sapien, quis elementum magna congue in. Nulla a congue turpis, vel ornare elit. Proin suscipit quam ac turpis condimentum ultrices. Sed tincidunt sem a diam mattis convallis.', '2021-12-12', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(10) UNSIGNED NOT NULL,
  `nome` varchar(155) NOT NULL,
  `usuario` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `caminhoFtPerfil` varchar(50) DEFAULT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `usuario`, `email`, `senha`, `caminhoFtPerfil`, `admin`) VALUES
(14, 'Rayssa Batista Nazzari', 'rayssabatistanazzari', 'rayssabatistanazzari@gmail.com', '$2y$10$E/Q0MDjYFsACZLZ2WC1aBOkaSiU4IVmmAZJA5HLYTWX608lRoJwD6', NULL, 0),
(15, 'admin', 'admin', 'admin@gmail.com', '$2y$10$uPj/aybFyoY7DlcpEHmkdeAzEYq7ILswhueTR5SoOmVNIWG2UScg.', NULL, 1),
(18, 'Alessandro Cassandro', 'alexcassandro', 'alessandrocassandro@hotmail.com', '$2y$10$ZQjWTocpwM1MzhvH/HzSsOFL.68xcONQL9etwlhDDYBMHZZs5AlNC', NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `amizade`
--
ALTER TABLE `amizade`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_post` (`id_post`);

--
-- Indexes for table `gostei`
--
ALTER TABLE `gostei`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `amizade`
--
ALTER TABLE `amizade`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `comentario`
--
ALTER TABLE `comentario`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `gostei`
--
ALTER TABLE `gostei`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
