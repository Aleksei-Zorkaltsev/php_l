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
-- пароль везде 123 --
INSERT INTO `users` (login, hash_pass) VALUES ('admin', '$2y$10$mW.mvlzXGAg6zgitruZafOjirFCfChKDjc6brzItzHrcZWQJhj5KK'),
('alex', '$2y$10$e.7Y1B99dNHTuXq8GkAu8ue3JVn46UDGNtzL8acQS3U9NBSDc0xjm'),
('anna', '$2y$10$V6EPhzjINANkhN2yuSD8o.V4A6z1IZmpAdJt5/od9zv3wN1f6yMD2'),
('dima', '$2y$10$fiExjf7Gx3d3heEjNA2NaOMMCnpkEGlUOQjAe64Gj3yn/cHf4bKmO'),
('andrew', '$2y$10$8As5WJktqwMQNHsDAQtUouk2bapkP6J4neCv4SSwOcZwn5ofWdC6S'),
('olga', '$2y$10$NHDvseXY8Djht8PQzCVOKO.53uBqoo//G9wmanpcJnQhkoK/tXxem');

INSERT INTO `catalog` (likes, name, price, about_info, img_filename)
VALUES 
(85,'JOURNEY', 390, 'Лети над песками, скользи среди развалин и раскрывай тайны древнего и загадочного мира Journey. Изучай эти огромные пространства в одиночку или вместе с такими же странниками. Игра Journey с ее потрясающей графикой и музыкой, номинированной на премию «Грэмми», подарит самые яркие и незабываемые впечатления.', 'journey.png'),
(101, 'Ori and the Will of te Wisps', 515, 'Маленький дух Ори не понаслышке знаком со всевозможными опасностями. Его юная подруга, сова Ку, очутилась в беде после злополучного полёта. Ори предстоит воссоединить свою семью, спасти искажённый край и узнать, что уготовано ему судьбой, — а одной храбрости для этого мало. Отправляйтесь в путь по бескрайним просторам нарисованного вручную мира, где вам встретятся новые друзья и враги. Ori and the Will of the Wisps продолжает добрую традицию Moon Studios — здесь захватывающий игровой процесс под оригинальную музыку в исполнении оркестра тесно переплетён с трогательным сюжетом.', 'ori.jpg'),
(91, 'Hades', 465 , 'Станьте бессмертным принцем Подземного мира, обладающим мифическим оружием и силами Олимпа, которые помогут вырваться из владений самого бога мёртвых. После каждой уникальной попытки побега вы будете становиться сильнее и наблюдать за развитием сюжета.', 'hades.jpg'),
(70, 'Kingdoms and Castles', 249, 'Королевства и Замки это игра о том как вырастить королевство из маленькой деревушки до процветающего города и великолепного замка. Ваше королевство должно выживать в живом и опасном мири. Уплывут ли шайки викингов с вашими поселенцами в трюмах? Или их утыкают стрелами на подступах к стенам? Спалит ли дракон ваш амбар, а люди вымрут зимой от голода, или вы сможете дать зверю отпор? Успех вашего королевства зависит исключительно от ваших навыков сроить города и замки.', 'kingdomAndCastles.jpg'),
(85, 'Omensight: Definitive Edition', 435, 'Вы - предвестник, мифический воин, который появляется только в переломные моменты. Землю Уралии раздирает война. Но что ещё хуже, когда наступает ночь, вы становитесь свидетелем разрушения мира от рук темного Бога. Вам дана сила прожить последний день еще раз. Ведите расследование и появляйтесь рядом с персонажами, которые сыграли роль в апокалипсисе, сражайтесь с ними или против них, и используйте силу Оменсайт, чтобы создать новую историю. Благодаря вашим решениям, вашим навыкам и умениям, измените этот день, и возможно, вы сможете проложить путь к светлому будущему.', 'Omensight.jpg'),
(95, 'Mark of the Ninja: Remastered', 435, 'В игре Mark of the Ninja Remastered вы узнаете, что значит быть настоящим ниндзя. Чтобы перехитрить соперников, нужно быть безмолвным, ловким и смекалистым. Проклятые татуировки усиливают чувства ниндзя, а каждая ситуация даёт новые возможности. В игровом мире удивительные пейзажи и красивая анимация.', 'mark-of-the-ninja-ninja.jpg');


INSERT INTO feedback (user_id, feedback) VALUES (3,'Какой-то текст.'),(2, 'Какой-то текст от Алекса'),(4, 'Дима что-то написал :)');



-- -----------------------------------------------------------------------------------------------------------------------------------
-- -----------------------------------------------------------------------------------------------------------------------------------
-- Старые инсерты
 
INSERT INTO `category` (`id`, `name`) VALUES
(3, 'Политика'),
(4, 'Спорт'),
(5, 'Игры');

INSERT INTO `news` (`id`, `title`, `text`, `categoty_id`, `views`) VALUES
(4, 'ВОЗ спрогнозировала появление нового смертоносного вируса', '\r\nМОСКВА, 24 мая — РИА Новости. Рано или поздно человечество столкнется с новой пандемией, которая окажется опаснее нынешней, заявил генеральный директор Всемирной организации здравоохранения (ВОЗ) Тедрос Адханом Гебрейесус.\r\n\"Появится другой вирус, который будет более заразным и смертоносным, чем этот\", — сказал он, выступая на открытии 74-й сессии ВОЗ.\r\nПрохожие на одной из улиц Уханя - РИА Новости, 1920, 24.05.2021\r\n10:45\r\nВ МИД Китая прокомментировали сообщения о болезни трех вирусологов до пандемии\r\nПо мнению главы организации, именно борьба с вирусами показывает, что государствам следует сотрудничать друг с другом, а не соревноваться.\r\n\"По факту мы стоим перед выбором: действовать сообща или быть незащищенными\", — заключил Гебрейесус.\r\nВсемирная ассамблея здравоохранения проходит с 24 мая по 1 июня в виртуальном формате. Ее основная тема — борьба с пандемией COVID-19 и предотвращение новых глобальных чрезвычайных ситуаций в области здравоохранения. В работе ассамблеи принимают участие делегации со всего мира.', 3, 0),
(6, 'Глава немецкой делегации рассказал о впечатлениях от поездки в Крым', 'СИМФЕРОПОЛЬ, 24 мая — РИА Новости. Жители Германии очень хотят попасть в Крым, чтобы увидеть прогресс в развитии полуострова, заявил глава немецкой делегации Виктор Триппель.\r\nДвадцать второго мая 25 граждан ФРГ приехали в российский регион в рамках проекта народной дипломатии \"Мирный Крым — своими глазами. Крымские реалии без европейских домыслов\".\r\n\"Наша дружба будет продолжаться. Мы от всего сердца ездим к вам в гости. Я никого (из участников поездки. — Прим. ред.) не уговаривал, никому деньги не давал. Люди сами приехали — и еще приедут. Все очень хотят попасть в Крым, посмотреть своими глазами, как у вас все здесь замечательно\", — сказал Триппель на встрече в крымском парламенте.\r\n\r\nОн уточнил, что уже не в первый раз привозит немецких туристов на полуостров, подчеркнув, что это безопасный регион.', 4, 0);

INSERT INTO `review_item` (name, textReview, item_catalog_id)
VALUES ('Валера', 'хорошая игра', 1), ('Анна', 'Очень умиротворяющая атмосфера', 1), ('Екатерира', 'Классная музыка', 1), ('Александр', 'Отличная чигра чтобы расслабиться', 1);


