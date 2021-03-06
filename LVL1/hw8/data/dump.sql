DROP TABLE IF EXISTS `order_list`;
DROP TABLE IF EXISTS `orders`;
DROP TABLE IF EXISTS `cart`;
DROP TABLE IF EXISTS `news`;
DROP TABLE IF EXISTS `feedback`;
DROP TABLE IF EXISTS `review_item`;
DROP TABLE IF EXISTS `catalog`;
DROP TABLE IF EXISTS `category`;
DROP TABLE IF EXISTS `users`;



-- ________________________________________________________________________________________________________________

CREATE TABLE `users`(
	id SERIAL PRIMARY KEY,
	login VARCHAR(255) UNIQUE NOT NULL,
	hash_pass VARCHAR(255) NOT NULL,
	hash VARCHAR(255)
);

CREATE TABLE `feedback` (
  id SERIAL PRIMARY KEY,
  user_id BIGINT UNSIGNED NOT NULL,
  feedback text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  
  FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE
);


CREATE TABLE `category` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL
);


CREATE TABLE `news` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `categoty_id` int NOT NULL,
  `views` int NOT NULL DEFAULT '0'
);

CREATE TABLE `catalog` (
	id SERIAL PRIMARY KEY,
	name VARCHAR(255) NOT NULL,
	price BIGINT NOT NULL,
	img_filename VARCHAR(255),
	likes BIGINT UNSIGNED NOT NULL DEFAULT 0,
	about_info TEXT
);


CREATE TABLE `cart`(
	id SERIAL PRIMARY KEY,
	catalog_item_id BIGINT UNSIGNED NOT NULL,
	session_id VARCHAR(255) NOT NULL,
	user_id BIGINT UNSIGNED,
	`count` BIGINT UNSIGNED DEFAULT 1,
	order_status VARCHAR(255) DEFAULT NULL,
	
	FOREIGN KEY (catalog_item_id) REFERENCES `catalog`(id) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE `orders`(
	id SERIAL PRIMARY KEY,
	name VARCHAR(255) NOT NULL,
	phone VARCHAR(255) NOT NULL,
	session_id VARCHAR(255) NOT NULL,
	user_id BIGINT UNSIGNED,
	status enum('wait_approve','approved') DEFAULT 'wait_approve',
	total_sum VARCHAR(255)
);


CREATE TABLE `order_list`(
	id SERIAL PRIMARY KEY,
	order_id BIGINT UNSIGNED NOT NULL,
	item_id BIGINT UNSIGNED NOT NULL,
	session_id VARCHAR(255) NOT NULL,
	counts_item BIGINT UNSIGNED NOT NULL,
	user_id BIGINT UNSIGNED,
	item_price BIGINT UNSIGNED NOT NULL,
	
	FOREIGN KEY (order_id) REFERENCES orders(id) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (item_id) REFERENCES `catalog`(id) ON UPDATE CASCADE ON DELETE CASCADE
);


CREATE TABLE `review_item` (
	id SERIAL PRIMARY KEY,
	name VARCHAR(255) NOT NULL,
	textReview TEXT,
	item_catalog_id BIGINT UNSIGNED NOT NULL,
	
	FOREIGN KEY (item_catalog_id) REFERENCES `catalog`(id) ON UPDATE CASCADE ON DELETE CASCADE
);

-- -------------------
-- ???????????? ?????????? 123 --
INSERT INTO `users` (login, hash_pass) VALUES ('admin', '$2y$10$mW.mvlzXGAg6zgitruZafOjirFCfChKDjc6brzItzHrcZWQJhj5KK'),
('alex', '$2y$10$e.7Y1B99dNHTuXq8GkAu8ue3JVn46UDGNtzL8acQS3U9NBSDc0xjm'),
('anna', '$2y$10$V6EPhzjINANkhN2yuSD8o.V4A6z1IZmpAdJt5/od9zv3wN1f6yMD2'),
('dima', '$2y$10$fiExjf7Gx3d3heEjNA2NaOMMCnpkEGlUOQjAe64Gj3yn/cHf4bKmO'),
('andrew', '$2y$10$8As5WJktqwMQNHsDAQtUouk2bapkP6J4neCv4SSwOcZwn5ofWdC6S'),
('olga', '$2y$10$NHDvseXY8Djht8PQzCVOKO.53uBqoo//G9wmanpcJnQhkoK/tXxem');

INSERT INTO `catalog` (likes, name, price, about_info, img_filename)
VALUES 
(85,'JOURNEY', 390, '???????? ?????? ??????????????, ?????????????? ?????????? ???????????????? ?? ?????????????????? ?????????? ???????????????? ?? ?????????????????????? ???????? Journey. ???????????? ?????? ???????????????? ???????????????????????? ?? ???????????????? ?????? ???????????? ?? ???????????? ???? ??????????????????????. ???????? Journey ?? ???? ?????????????????????? ???????????????? ?? ??????????????, ???????????????????????????? ???? ???????????? ????????????????, ?????????????? ?????????? ?????????? ?? ???????????????????????? ??????????????????????.', 'journey.png'),
(101, 'Ori and the Will of te Wisps', 515, '?????????????????? ?????? ?????? ???? ???????????????????? ???????????? ???? ?????????????????????????? ??????????????????????. ?????? ???????? ??????????????, ???????? ????, ?????????????????? ?? ???????? ?????????? ???????????????????????? ????????????. ?????? ?????????????????? ???????????????????????? ???????? ??????????, ???????????? ???????????????????? ???????? ?? ????????????, ?????? ?????????????????? ?????? ??????????????, ??? ?? ?????????? ?????????????????? ?????? ?????????? ????????. ?????????????????????????? ?? ???????? ???? ???????????????????? ?????????????????? ?????????????????????????? ?????????????? ????????, ?????? ?????? ???????????????????? ?????????? ???????????? ?? ??????????. Ori and the Will of the Wisps ???????????????????? ???????????? ???????????????? Moon Studios ??? ?????????? ?????????????????????????? ?????????????? ?????????????? ?????? ???????????????????????? ???????????? ?? ???????????????????? ???????????????? ?????????? ???????????????????? ?? ???????????????????????? ??????????????.', 'ori.jpg'),
(91, 'Hades', 465 , '?????????????? ?????????????????????? ?????????????? ???????????????????? ????????, ???????????????????? ???????????????????? ?????????????? ?? ???????????? ????????????, ?????????????? ?????????????? ?????????????????? ???? ???????????????? ???????????? ???????? ??????????????. ?????????? ???????????? ???????????????????? ?????????????? ???????????? ???? ???????????? ?????????????????????? ?????????????? ?? ?????????????????? ???? ?????????????????? ????????????.', 'hades.jpg'),
(70, 'Kingdoms and Castles', 249, '?????????????????????? ?? ?????????? ?????? ???????? ?? ?????? ?????? ?????????????????? ?????????????????????? ???? ?????????????????? ?????????????????? ???? ?????????????????????????? ???????????? ?? ?????????????????????????? ??????????. ???????? ?????????????????????? ???????????? ???????????????? ?? ?????????? ?? ?????????????? ????????. ?????????????? ???? ?????????? ???????????????? ?? ???????????? ?????????????????????? ?? ????????????? ?????? ???? ?????????????? ???????????????? ???? ?????????????????? ?? ????????????? ???????????? ???? ???????????? ?????? ??????????, ?? ???????? ???????????? ?????????? ???? ????????????, ?????? ???? ?????????????? ???????? ?????????? ??????????? ?????????? ???????????? ?????????????????????? ?????????????? ?????????????????????????? ???? ?????????? ?????????????? ???????????? ???????????? ?? ??????????.', 'kingdomAndCastles.jpg'),
(85, 'Omensight: Definitive Edition', 435, '???? - ??????????????????????, ???????????????????? ????????, ?????????????? ???????????????????? ???????????? ?? ???????????????????? ??????????????. ?????????? ???????????? ?????????????????? ??????????. ???? ?????? ?????? ????????, ?????????? ?????????????????? ????????, ???? ?????????????????????? ???????????????????? ???????????????????? ???????? ???? ?????? ?????????????? ????????. ?????? ???????? ???????? ?????????????? ?????????????????? ???????? ?????? ??????. ???????????? ?????????????????????????? ?? ?????????????????????? ?????????? ?? ??????????????????????, ?????????????? ?????????????? ???????? ?? ????????????????????????, ???????????????????? ?? ???????? ?????? ???????????? ??????, ?? ?????????????????????? ???????? ????????????????, ?????????? ?????????????? ?????????? ??????????????. ?????????????????? ?????????? ????????????????, ?????????? ?????????????? ?? ??????????????, ???????????????? ???????? ????????, ?? ????????????????, ???? ?????????????? ?????????????????? ???????? ?? ???????????????? ????????????????.', 'Omensight.jpg'),
(95, 'Mark of the Ninja: Remastered', 435, '?? ???????? Mark of the Ninja Remastered ???? ??????????????, ?????? ???????????? ???????? ?????????????????? ????????????. ?????????? ?????????????????????? ????????????????????, ?????????? ???????? ????????????????????, ???????????? ?? ??????????????????????. ?????????????????? ???????????????????? ?????????????????? ?????????????? ????????????, ?? ???????????? ???????????????? ???????? ?????????? ??????????????????????. ?? ?????????????? ???????? ???????????????????????? ?????????????? ?? ???????????????? ????????????????.', 'mark-of-the-ninja-ninja.jpg');


INSERT INTO feedback (user_id, feedback) VALUES (3,'??????????-???? ??????????.'),(2, '??????????-???? ?????????? ???? ????????????'),(4, '???????? ??????-???? ?????????????? :)');



-- -----------------------------------------------------------------------------------------------------------------------------------
-- -----------------------------------------------------------------------------------------------------------------------------------
-- ???????????? ??????????????
 
INSERT INTO `category` (`id`, `name`) VALUES
(3, '????????????????'),
(4, '??????????'),
(5, '????????');

INSERT INTO `news` (`id`, `title`, `text`, `categoty_id`, `views`) VALUES
(4, '?????? ?????????????????????????????? ?????????????????? ???????????? ?????????????????????????? ????????????', '\r\n????????????, 24 ?????? ??? ?????? ??????????????. ???????? ?????? ???????????? ???????????????????????? ???????????????????? ?? ?????????? ??????????????????, ?????????????? ???????????????? ?????????????? ????????????????, ???????????? ?????????????????????? ???????????????? ?????????????????? ?????????????????????? ?????????????????????????????? (??????) ???????????? ?????????????? ????????????????????.\r\n\"???????????????? ???????????? ??????????, ?????????????? ?????????? ?????????? ???????????????? ?? ????????????????????????, ?????? ????????\", ??? ???????????? ????, ???????????????? ???? ???????????????? 74-?? ???????????? ??????.\r\n???????????????? ???? ?????????? ???? ???????? ?????????? - ?????? ??????????????, 1920, 24.05.2021\r\n10:45\r\n?? ?????? ?????????? ?????????????????????????????????? ?????????????????? ?? ?????????????? ???????? ?????????????????????? ???? ????????????????\r\n???? ???????????? ?????????? ??????????????????????, ???????????? ???????????? ?? ???????????????? ????????????????????, ?????? ???????????????????????? ?????????????? ???????????????????????? ???????? ?? ????????????, ?? ???? ??????????????????????????.\r\n\"???? ?????????? ???? ?????????? ?????????? ??????????????: ?????????????????????? ???????????? ?????? ???????? ??????????????????????????\", ??? ???????????????? ????????????????????.\r\n?????????????????? ?????????????????? ?????????????????????????????? ???????????????? ?? 24 ?????? ???? 1 ???????? ?? ?????????????????????? ??????????????. ???? ???????????????? ???????? ??? ???????????? ?? ?????????????????? COVID-19 ?? ???????????????????????????? ?????????? ???????????????????? ???????????????????????? ???????????????? ?? ?????????????? ??????????????????????????????. ?? ???????????? ?????????????????? ?????????????????? ?????????????? ?????????????????? ???? ?????????? ????????.', 3, 0),
(6, '?????????? ???????????????? ?????????????????? ?????????????????? ?? ???????????????????????? ???? ?????????????? ?? ????????', '??????????????????????, 24 ?????? ??? ?????? ??????????????. ???????????? ???????????????? ?????????? ?????????? ?????????????? ?? ????????, ?????????? ?????????????? ???????????????? ?? ???????????????? ??????????????????????, ???????????? ?????????? ???????????????? ?????????????????? ???????????? ????????????????.\r\n???????????????? ?????????????? ?????? 25 ?????????????? ?????? ???????????????? ?? ???????????????????? ???????????? ?? ???????????? ?????????????? ???????????????? ???????????????????? \"???????????? ???????? ??? ???????????? ??????????????. ???????????????? ???????????? ?????? ?????????????????????? ????????????????\".\r\n\"???????? ???????????? ?????????? ????????????????????????. ???? ???? ?????????? ???????????? ?????????? ?? ?????? ?? ??????????. ?? ???????????? (???? ???????????????????? ??????????????. ??? ????????. ??????.) ???? ????????????????????, ???????????? ???????????? ???? ??????????. ???????? ???????? ???????????????? ??? ?? ?????? ??????????????. ?????? ?????????? ?????????? ?????????????? ?? ????????, ???????????????????? ???????????? ??????????????, ?????? ?? ?????? ?????? ?????????? ????????????????????????\", ??? ???????????? ???????????????? ???? ?????????????? ?? ???????????????? ????????????????????.\r\n\r\n???? ??????????????, ?????? ?????? ???? ?? ???????????? ?????? ???????????????? ???????????????? ???????????????? ???? ????????????????????, ????????????????????, ?????? ?????? ???????????????????? ????????????.', 4, 0);

INSERT INTO `review_item` (name, textReview, item_catalog_id)
VALUES ('????????????', '?????????????? ????????', 1), ('????????', '?????????? ???????????????????????????? ??????????????????', 1), ('??????????????????', '???????????????? ????????????', 1), ('??????????????????', '???????????????? ?????????? ?????????? ????????????????????????', 1);


