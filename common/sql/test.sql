
--
-- テーブルの構造 `list`
--

CREATE TABLE `list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `list`
--

INSERT INTO `list` (`id`, `name`) VALUES
(1, 'aaa'),
(2, 'bbb'),
(3, 'ccc'),
(4, '5556677'),
(5, 'qqqq'),
(6, 'qqqq'),
(7, 'rrr'),
(8, 'rrrrtttt'),
(9, '1111'),
(10, '日本語'),
(11, '文字化けテスト');

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(16) NOT NULL,
  `email` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(100, '管理者', 'admin@email.com', '1a1dc91c907325c69271ddf0c944bc72'),
(101, 'Lucen', 'lucen@email.com', '1a1dc91c907325c69271ddf0c944bc72', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(102, 'Wataru', 'wataru@email.com', '1a1dc91c907325c69271ddf0c944bc72', '0000-00-00 00:00:00', '0000-00-00 00:00:00');


