CREATE TABLE IF NOT EXISTS `c_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(256) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
#---
CREATE TABLE IF NOT EXISTS `c_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `time` datetime NOT NULL,
  `for_post` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `c_comments_fk_post` (`for_post`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
#---
CREATE TABLE IF NOT EXISTS `c_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `install_date` datetime NOT NULL,
  `module_name` varchar(144) NOT NULL,
  `module_description` text,
  `module_img` varchar(144) DEFAULT NULL,
  `author` varchar(64) NOT NULL,
  `on` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
#---
CREATE TABLE IF NOT EXISTS `c_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_id` varchar(96) NOT NULL,
  `module` varchar(48) DEFAULT NULL,
  `controller` varchar(96) DEFAULT 'Application',
  `whitelist` TEXT NULL DEFAULT NULL,
  `blacklist` TEXT NULL DEFAULT NULL,
  `description` text,
  `title` varchar(256) DEFAULT NULL,
  `theme` varchar(96) DEFAULT NULL,
  `path` varchar(164) NOT NULL,
  `custom_url` varchar(128) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `c_pages_page_id_uindex` (`page_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
#---
CREATE TABLE IF NOT EXISTS `c_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_publish` datetime DEFAULT NULL,
  `date_write` datetime NOT NULL,
  `title` varchar(256) NOT NULL,
  `post` text NOT NULL,
  `author` int(11) NOT NULL,
  `category` int(11) DEFAULT NULL,
  `is_publish` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `c_posts_fk_categories` (`category`),
  KEY `c_posts_fk_users` (`author`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
#---
CREATE TABLE IF NOT EXISTS `c_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `setting_key` varchar(128) NOT NULL,
  `value` text NOT NULL,
  `description` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `c_settings_setting_key_uindex` (`setting_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
#---
CREATE TABLE IF NOT EXISTS `c_users_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ugroup` varchar(64) NOT NULL,
  `name` varchar(32) NOT NULL,
  `description` text,
  `permission` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `c_users_group_name_uindex` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
#---
CREATE TABLE IF NOT EXISTS `c_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(32) NOT NULL,
  `password` varchar(64) NOT NULL,
  `avatar` varchar(256) DEFAULT NULL,
  `email` varchar(144) NOT NULL,
  `date_registration` datetime NOT NULL,
  `birthday` date DEFAULT NULL,
  `first_name` varchar(48) DEFAULT NULL,
  `second_name` varchar(64) DEFAULT NULL,
  `last_name` varchar(64) DEFAULT NULL,
  `user_group` int(11) NOT NULL,
  `permission` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `c_users_login_uindex` (`login`),
  KEY `c_users_fk_group` (`user_group`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
#---
CREATE TABLE IF NOT EXISTS `c_users_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `setting` text,
  PRIMARY KEY (`id`),
  KEY `c_users_settings_fk_users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
#---
INSERT INTO `c_users_group` (`id`, `ugroup`, `name`, `description`, `permission`) VALUES
(1, 'Гость', 'guest', 'Данная группа имеет право только просматривать содержимое страниц.', NULL),
(2, 'Пользователь', 'user', 'Данная группа имеет право оставлять комментарии, удалять только свои комментарии.', NULL),
(3, 'Модератор', 'moderator', 'Данная группа может удалять комментарии и создавать их.', NULL),
(4, 'Администратор', 'admin', 'Имеют полный список прав на сайте', NULL);
#---
INSERT INTO `c_pages` (`id`, `page_id`, `module`, `controller`, `whitelist`, `blacklist`, `description`, `title`, `path`, `custom_url`) VALUES
(1, 'install', 		NULL, 	'Application', 	NULL, NULL, NULL, 'Установка {object}', 	'...', 			'install'),
(2, 'update', 		NULL, 	'Application', 	NULL, NULL, NULL, 'Обновление {object}', 	'...', 				'update'),
(3, 'index', 		NULL, 	'Application', 	NULL, NULL, NULL, 'Главная', 				'/path/', 						'index'),
(4, 'registration', NULL, 	'Auth', 		NULL, NULL, NULL, 'Регистрация', 			'/path/', 	'auth/registration'),
(5, 'login', 		NULL, 	'Auth', 		NULL, NULL, NULL, 'Вход', 					'/path/', 			'auth/login'),
(6, 'admin', 		'Admin', 'Admin', 		NULL, NULL, NULL, 'Панель Администратора', 	'/admin-panel/path/', 				'admin'),
(7, 'contact', 		NULL, 	'Go', 			NULL, NULL, NULL, 'Контакты', 				'/path/', 			'go/contact'),
(8, 'news', 		NULL, 	'Go', 			NULL, NULL, NULL, 'Новости', 				'/path/', 			'go/news'),
(9, 'about', 		NULL, 	'Go', 			NULL, NULL, NULL, 'О нас', 					'/path/', 			'go/about');
#---
INSERT INTO `c_settings` (`id`, `setting_key`, `value`, `description`) VALUES
(1, 'salt', '670ee529d7261cb9575b806d359b759f8d77b61d', 'Соль для шифрования паролей');
#---
ALTER TABLE `c_comments`
  ADD CONSTRAINT `c_comments_fk_post` FOREIGN KEY (`for_post`) REFERENCES `c_posts` (`id`);
#---
ALTER TABLE `c_posts`
  ADD CONSTRAINT `c_posts_fk_users` FOREIGN KEY (`author`) REFERENCES `c_users` (`id`),
  ADD CONSTRAINT `c_posts_fk_categories` FOREIGN KEY (`category`) REFERENCES `c_categories` (`id`);
#---
ALTER TABLE `c_users`
  ADD CONSTRAINT `c_users_fk_group` FOREIGN KEY (`user_group`) REFERENCES `c_users_group` (`id`);
#---
ALTER TABLE `c_users_settings`
  ADD CONSTRAINT `c_users_settings_fk_users` FOREIGN KEY (`user_id`) REFERENCES `c_users` (`id`);