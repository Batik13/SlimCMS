-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 09 2019 г., 15:34
-- Версия сервера: 5.6.38
-- Версия PHP: 7.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `slimcms`
--

-- --------------------------------------------------------

--
-- Структура таблицы `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `publish` enum('0','1') COLLATE utf8_unicode_ci DEFAULT '1',
  `name` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `href` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `text` longtext COLLATE utf8_unicode_ci,
  `min_text` text COLLATE utf8_unicode_ci,
  `art` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `art_href` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `img` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `thumb` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `label` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `keywords` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `errors`
--

CREATE TABLE `errors` (
  `id` int(11) NOT NULL,
  `ip` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `options`
--

CREATE TABLE `options` (
  `id` int(11) NOT NULL,
  `namespace` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tab` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `value` text COLLATE utf8_unicode_ci,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `values` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `options`
--

INSERT INTO `options` (`id`, `namespace`, `tab`, `name`, `description`, `value`, `type`, `code`, `values`, `created_at`, `updated_at`) VALUES
(2, 'admin.settings', 'Seo', 'Мета заголовок', 'Title главной страницы', '', 'input', 'title', '', '2019-03-13 07:19:20', '2019-05-06 06:58:31'),
(3, 'admin.settings', 'Seo', 'Description', 'Мета описание главной страницы', '', 'textarea', 'description', '', '2019-03-13 07:20:26', '2019-05-06 06:58:31'),
(4, 'admin.settings', 'Seo', 'Keywords', 'Мета ключевые слова главной страницы', '', 'textarea', 'keywords', '', '2019-03-13 07:21:09', '2019-05-06 06:58:31'),
(5, 'admin.settings', 'Email', 'Email', 'Email, на который будут приходить письма', '', 'input', 'email', '', '2019-03-13 07:24:49', '2019-05-06 06:58:31'),
(6, 'admin.settings', 'Email', 'Шаблон письма', 'Шаблон письма', '<h2>Новая заявка</h2>\r\n<br>\r\n<table>  \r\n  <tr>\r\n    <td>ФИО</td>\r\n    <td>{{name}}</td>\r\n  </tr>\r\n  <tr>\r\n    <td>Телефон</td>\r\n    <td>{{phone}}</td>\r\n  </tr>\r\n  <tr>\r\n    <td>E-mail</td>\r\n    <td>{{email}}</td>\r\n  </tr>\r\n  <tr>\r\n    <td>Организация</td>\r\n    <td>{{organization}}</td>\r\n  </tr>\r\n  <tr>\r\n    <td>Комментарии</td>\r\n    <td>{{comment}}</td>\r\n  </tr>\r\n</table>', 'textarea', 'email_template', '', '2019-03-13 07:26:17', '2019-05-06 06:58:31'),
(7, 'admin.settings', 'Контакты', 'Адрес', 'Адрес компании', '', 'input', 'address', '', '2019-03-13 07:35:02', '2019-05-06 06:58:31'),
(8, 'admin.settings', 'Контакты', 'Телефон 1', 'Телефон храма', '', 'input', 'phone1', '', '2019-03-13 07:36:36', '2019-05-06 06:58:31'),
(9, 'admin.settings', 'Контакты', 'Телефон 2', 'Телефон секретаря', '', 'input', 'phone', '', '2019-03-13 07:37:16', '2019-05-06 06:58:31'),
(10, 'admin.settings', 'Контакты', 'Адрес на карте', 'Яндекс или Google код карты', '', 'textarea', 'map', '', '2019-03-13 07:38:58', '2019-05-06 06:58:31'),
(13, 'admin.settings', 'Основные', 'Домен', 'Домен сайта (без протокола)', '', 'input', 'domen', '', '2019-03-14 11:13:03', '2019-05-06 06:58:31');

-- --------------------------------------------------------

--
-- Структура таблицы `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `publish` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `sort` int(11) NOT NULL,
  `name` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(254) COLLATE utf8_unicode_ci NOT NULL,
  `art` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `text` longtext COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `keywords` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `seo_title` text COLLATE utf8_unicode_ci,
  `seo_text` longtext COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `min_text` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `pages`
--

INSERT INTO `pages` (`id`, `publish`, `sort`, `name`, `url`, `art`, `text`, `title`, `description`, `keywords`, `seo_title`, `seo_text`, `created_at`, `updated_at`, `min_text`) VALUES
(6, '1', 0, 'Контакты', 'kontakty', 'main,footer2,contacts', '', 'Контакты', '', '', '', '', '2019-05-09 12:33:06', '2019-04-29 05:43:37', NULL),
(8, '1', 0, '404', '404', 'default', '&lt;p&gt;404&lt;/p&gt;', '404', '', '', NULL, NULL, '2019-04-28 22:22:31', '2019-04-28 22:22:31', NULL),
(12, '1', 100, 'О нас', 'o-nas', 'main', '', 'О нас', '', '', '', '', '2019-05-06 14:38:18', '2019-05-06 11:43:59', '');

-- --------------------------------------------------------

--
-- Структура таблицы `shorts`
--

CREATE TABLE `shorts` (
  `id` int(1) NOT NULL,
  `name` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `text` longtext COLLATE utf8_unicode_ci NOT NULL,
  `art` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `shorts`
--

INSERT INTO `shorts` (`id`, `name`, `text`, `art`, `updated_at`, `created_at`) VALUES
(1, 'Логотип', '&lt;p&gt;&lt;img src=&quot;{{root}}resources/uploads/short/logo.png&quot; alt=&quot;thumbnail&quot;&gt;&lt;br&gt;&lt;/p&gt;', 'template', '2019-04-28 20:25:18', '2019-04-28 20:25:18'),
(2, 'Слоган', '&lt;p&gt;Компания «Выкуп - автозапчастей» - всегда будет «Гарантом» вашей безопасной сделки!&lt;/p&gt;', 'template', '2019-04-29 04:40:50', '2019-04-29 04:40:50'),
(3, 'Копирайт', '&lt;p&gt;© 2019 компания Выкуп автозапчастей. Все права защищены.&lt;/p&gt;', 'template', '2019-04-29 04:47:04', '2019-04-29 04:47:04'),
(4, 'Реклама на сайте', '&lt;a class=&quot;btn btn--promo&quot; href=&quot;javascript:void(0)&quot;&gt;Реклама на сайте&lt;/a&gt;', 'template', '2019-04-29 04:48:56', '2019-04-29 04:48:56'),
(8, 'Заголовок', '&lt;p&gt;О компании&lt;br&gt;&lt;/p&gt;', 'О компании', '2019-04-29 13:23:42', '2019-04-29 13:23:42'),
(9, 'Текст 1', '&lt;p&gt;Наша компания занимается выкупом и реализацией новых неликвидных запчастей.&lt;/p&gt;', 'О компании', '2019-04-29 13:24:47', '2019-04-29 13:24:47'),
(10, 'Текст 2', '&lt;p&gt;Компания Выкуп-неликвида начала свою деятельность в 2015 году, до этого на протяжении трёх лет мы работали под другим именем.&lt;/p&gt;\r\n              &lt;p&gt;За пять лет нашего существования, мы приобрели колоссальный опыт в направлении по выкупу и реализации автозапчастей, а также мы познакомились, с очень надёжными партнёрами, которые ни разу нас не подводили!&lt;/p&gt;', 'О компании', '2019-04-29 13:25:20', '2019-04-29 13:25:20'),
(11, 'Скилл 1', '&lt;div class=&quot;skills__block&quot;&gt;\r\n                &lt;div class=&quot;skills__icon&quot;&gt;&lt;i class=&quot;icon  icon--partners&quot;&gt;&lt;/i&gt;&lt;/div&gt;\r\n                &lt;div class=&quot;skills__title&quot;&gt;\r\n                  &lt;h5&gt;Торговых партнеров&lt;/h5&gt;\r\n                &lt;/div&gt;\r\n                &lt;div class=&quot;skills__text text text--14&quot;&gt;\r\n                  &lt;p&gt;В том числе крупных интернет - площадок Москвы и Московской области&lt;/p&gt;\r\n                &lt;/div&gt;\r\n              &lt;/div&gt;', 'О компании', '2019-04-29 13:26:09', '2019-04-29 13:26:09'),
(12, 'Скилл 2', '&lt;div class=&quot;skills__block&quot;&gt;\r\n                &lt;div class=&quot;skills__icon&quot;&gt;&lt;i class=&quot;icon  icon--clients&quot;&gt;&lt;/i&gt;&lt;/div&gt;\r\n                &lt;div class=&quot;skills__title&quot;&gt;\r\n                  &lt;h5&gt;Довольных клиентов&lt;/h5&gt;\r\n                &lt;/div&gt;\r\n                &lt;div class=&quot;skills__text text text--14&quot;&gt;\r\n                  &lt;p&gt;Автосервисов, техцентров, магазинов автозапчастей&lt;/p&gt;\r\n                &lt;/div&gt;\r\n              &lt;/div&gt;', 'О компании', '2019-04-29 13:27:34', '2019-04-29 13:27:17'),
(13, 'Заголовок', 'Как мы работаем', 'Как мы работаем', '2019-04-29 13:28:24', '2019-04-29 13:28:24'),
(14, 'Карточка 1', '&lt;div class=&quot;card&quot;&gt;\r\n          &lt;div class=&quot;card__inner&quot;&gt;\r\n            &lt;div class=&quot;card__numb&quot;&gt;&lt;span&gt;01&lt;/span&gt;&lt;/div&gt;\r\n            &lt;div class=&quot;card__icon&quot;&gt;&lt;i class=&quot;icon  icon--call&quot;&gt;&lt;/i&gt;&lt;/div&gt;\r\n            &lt;div class=&quot;card__title&quot;&gt;\r\n              &lt;p&gt;Свяжитесь с нами&lt;/p&gt;\r\n            &lt;/div&gt;\r\n            &lt;div class=&quot;card__text&quot;&gt;\r\n              &lt;p&gt;Просто звоните нам и присылайте прайс со списком новых неликвид. автозапчастей&lt;/p&gt;\r\n            &lt;/div&gt;\r\n          &lt;/div&gt;\r\n        &lt;/div&gt;', 'Как мы работаем', '2019-04-29 13:30:21', '2019-04-29 13:29:41'),
(15, 'Карточка 2', '&lt;div class=&quot;card&quot;&gt;\r\n          &lt;div class=&quot;card__inner&quot;&gt;\r\n            &lt;div class=&quot;card__numb&quot;&gt;&lt;span&gt;02&lt;/span&gt;&lt;/div&gt;\r\n            &lt;div class=&quot;card__icon&quot;&gt;&lt;i class=&quot;icon  icon--discussion&quot;&gt;&lt;/i&gt;&lt;/div&gt;\r\n            &lt;div class=&quot;card__title&quot;&gt;\r\n              &lt;p&gt;Обсуждение сделки&lt;/p&gt;\r\n            &lt;/div&gt;\r\n            &lt;div class=&quot;card__text&quot;&gt;\r\n              &lt;p&gt;Обсуждаем условия сотрудничества индивидуально с каждым клиентом&lt;/p&gt;\r\n            &lt;/div&gt;\r\n          &lt;/div&gt;\r\n        &lt;/div&gt;', 'Как мы работаем', '2019-04-29 13:31:13', '2019-04-29 13:31:13'),
(16, 'Карточка 3', '&lt;div class=&quot;card&quot;&gt;\r\n          &lt;div class=&quot;card__inner&quot;&gt;\r\n            &lt;div class=&quot;card__numb&quot;&gt;&lt;span&gt;03&lt;/span&gt;&lt;/div&gt;\r\n            &lt;div class=&quot;card__icon&quot;&gt;&lt;i class=&quot;icon  icon--completion&quot;&gt;&lt;/i&gt;&lt;/div&gt;\r\n            &lt;div class=&quot;card__title&quot;&gt;\r\n              &lt;p&gt;Завершение сделки&lt;/p&gt;\r\n            &lt;/div&gt;\r\n            &lt;div class=&quot;card__text&quot;&gt;\r\n              &lt;p&gt;Вы привозите запчасти и получаете деньги наличными&lt;/p&gt;\r\n            &lt;/div&gt;\r\n          &lt;/div&gt;\r\n        &lt;/div&gt;', 'Как мы работаем', '2019-04-29 13:31:43', '2019-04-29 13:31:43'),
(17, 'Шаблон прайс листа (фото)', '&lt;p&gt;&lt;img src=&quot;{{root}}resources/uploads/short/price.jpg&quot; alt=&quot;thumbnail&quot;&gt;&lt;br&gt;&lt;/p&gt;', 'Форма', '2019-04-30 08:37:26', '2019-04-30 08:37:26'),
(18, 'Текст', '&lt;p&gt;С развитием информационных технологий одним из ключевых понятий в продаже автозапчастей, определяющим успех всей деятельности, становится Проценка.&lt;/p&gt;\r\n&lt;p&gt;Проценка – это автоматический поиск запчасти по всем имеющимся у продавца источникам, с подбором аналогов и формированием актуальных цен.&lt;/p&gt;', 'Проценка онлайн', '2019-05-02 11:13:30', '2019-05-02 11:13:30'),
(19, 'Логотип Контрафакта.нет', '&lt;p&gt;&lt;img src=&quot;{{root}}resources/uploads/short/kontrafaktanet.jpg&quot; alt=&quot;thumbnail&quot;&gt;&lt;br&gt;&lt;/p&gt;', '', '2019-05-06 13:33:46', '2019-05-06 13:33:46');

-- --------------------------------------------------------

--
-- Структура таблицы `sliders`
--

CREATE TABLE `sliders` (
  `id` int(11) NOT NULL,
  `publish` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `img` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL,
  `btn` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `href` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `art` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'adm@mail.ru', '$2y$10$ipf4mSDv19DpsJR5TqHZHe1xRYCF3QONRYtxdiOQd1UgiwGqmyrkm', '2019-02-27 09:28:41', '2019-02-27 09:28:41');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `errors`
--
ALTER TABLE `errors`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `url` (`url`);

--
-- Индексы таблицы `shorts`
--
ALTER TABLE `shorts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `errors`
--
ALTER TABLE `errors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `options`
--
ALTER TABLE `options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT для таблицы `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `shorts`
--
ALTER TABLE `shorts`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT для таблицы `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
