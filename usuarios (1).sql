
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `dni` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` enum('usuario','admin') DEFAULT 'usuario',
  `fecha_creacion` datetime DEFAULT current_timestamp(),
  `fecha_archivado` datetime DEFAULT NULL,
  `activo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `dni`, `email`, `password`, `rol`, `fecha_creacion`, `fecha_archivado`, `activo`) VALUES
(1, 'Admin', 'TodoModa', '11111111', 'admin@todomoda.com', '$2y$10$8kw0YG3GyoeOPZgNqT0BQu3exsInAkZ8UEJRRHD6/qCXLA.hhFyii', 'admin', '2026-11-15 21:01:00', NULL, 1),
(2, 'Martina', 'Seri', '49839213', 'martiinaseri@gmail.com', '$2y$10$Z7zRr2yFijLZWxWESvNWguVGo0kdFn/4yGWimWdOIHEHPiCwOdIDG', 'usuario', '2026-11-15 21:10:48', NULL, 1),
(5, 'Martina', 'Seri', '58268486', 'marseri@gmail.com', '$2y$10$VN75.ezamVn.raGHp3LGF.GKmVyWU0Vj2WqWETzn5UceTchvFnCIa', 'usuario', '2026-11-15 21:12:47', NULL, 1),
(8, 'Martina', 'Seri', '46839213', 'martinseri@gmail.com', '$2y$10$MmDfh3WYL5NV09sfYnRO..Uk6OPN7d8oynWqovO/TJUN3zHoQBdqm', 'usuario', '2026-11-15 21:38:04', NULL, 1),
(11, 'Martina', 'Seri', '44556688', 'martriinaseri@gmail.com', '$2y$10$aB0guzKMjrhDECb1org4JOC1l8OQLj0WU17EfhybdM05xlCrBUS4e', 'usuario', '2026-11-16 01:55:07', NULL, 1),
(13, 'Martina', 'Seri', '55555555', 'martiinasseri@gmail.com', '$2y$10$heNtgV7io84QFbKfg645RuwKhaxJvBkSukD/dgbe6L2Y6OBgeblga', 'usuario', '2026-11-16 01:55:49', NULL, 1),
(15, 'Martina', 'Seri', '22578866', 'martiitnasseri@gmail.com', '$2y$10$2feXtmVt0jT5mwy39SzhF.8EiXuj.oG/A7MtxNc5NjrQtsoAkxgyG', 'admin', '2026-11-16 01:56:06', NULL, 1),
(16, 'Javier', 'Seri', '84526714', 'javier@gmail.com', '$2y$10$DCRCm8axIZXzojB2C5.GZuwm9qw3udARj3ujhiD1liUMuXCJ06zn.', 'usuario', '2026-11-16 02:51:05', NULL, 1),
(17, 'agustin', 'rodriguez', '23684512', 'agus@gmail.com', '$2y$10$sLz6p5VT0uGGAVmnoYFDPuE0xQEKnrQGBorARHGMtnlNNVp05s.fK', 'admin', '2026-11-16 03:00:54', NULL, 1);


ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dni` (`dni`),
  ADD UNIQUE KEY `email` (`email`);


ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

