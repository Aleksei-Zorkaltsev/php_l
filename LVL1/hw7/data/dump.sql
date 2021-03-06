DROP TABLE IF EXISTS `cart`;
DROP TABLE IF EXISTS `news`;
DROP TABLE IF EXISTS `category`;
DROP TABLE IF EXISTS `feedback`;
DROP TABLE IF EXISTS `review_item`;
DROP TABLE IF EXISTS `catalog`;
DROP TABLE IF EXISTS `users`;



CREATE TABLE `category` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `feedback` (
  `id` int NOT NULL,
  `name` varchar(33) NOT NULL,
  `feedback` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `news` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `categoty_id` int NOT NULL,
  `views` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoty_id` (`categoty_id`);

ALTER TABLE `category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `feedback`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

ALTER TABLE `news`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`categoty_id`) REFERENCES `category` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

INSERT INTO `category` (`id`, `name`) VALUES
(3, 'Политика'),
(4, 'Спорт'),
(5, 'Игры');

INSERT INTO `feedback` (`id`, `name`, `feedback`) VALUES
(1, 'Артем', 'Ваш магазин обладает наилучшими товарами!'),
(5, 'Василий', 'Вы обладаете наилучшими качествами!'),
(22, 'Петруччо', 'Мне ничего не понравилось');

INSERT INTO `news` (`id`, `title`, `text`, `categoty_id`, `views`) VALUES
(4, 'ВОЗ спрогнозировала появление нового смертоносного вируса', '\r\nМОСКВА, 24 мая — РИА Новости. Рано или поздно человечество столкнется с новой пандемией, которая окажется опаснее нынешней, заявил генеральный директор Всемирной организации здравоохранения (ВОЗ) Тедрос Адханом Гебрейесус.\r\n\"Появится другой вирус, который будет более заразным и смертоносным, чем этот\", — сказал он, выступая на открытии 74-й сессии ВОЗ.\r\nПрохожие на одной из улиц Уханя - РИА Новости, 1920, 24.05.2021\r\n10:45\r\nВ МИД Китая прокомментировали сообщения о болезни трех вирусологов до пандемии\r\nПо мнению главы организации, именно борьба с вирусами показывает, что государствам следует сотрудничать друг с другом, а не соревноваться.\r\n\"По факту мы стоим перед выбором: действовать сообща или быть незащищенными\", — заключил Гебрейесус.\r\nВсемирная ассамблея здравоохранения проходит с 24 мая по 1 июня в виртуальном формате. Ее основная тема — борьба с пандемией COVID-19 и предотвращение новых глобальных чрезвычайных ситуаций в области здравоохранения. В работе ассамблеи принимают участие делегации со всего мира.', 3, 0),
(6, 'Глава немецкой делегации рассказал о впечатлениях от поездки в Крым', 'СИМФЕРОПОЛЬ, 24 мая — РИА Новости. Жители Германии очень хотят попасть в Крым, чтобы увидеть прогресс в развитии полуострова, заявил глава немецкой делегации Виктор Триппель.\r\nДвадцать второго мая 25 граждан ФРГ приехали в российский регион в рамках проекта народной дипломатии \"Мирный Крым — своими глазами. Крымские реалии без европейских домыслов\".\r\n\"Наша дружба будет продолжаться. Мы от всего сердца ездим к вам в гости. Я никого (из участников поездки. — Прим. ред.) не уговаривал, никому деньги не давал. Люди сами приехали — и еще приедут. Все очень хотят попасть в Крым, посмотреть своими глазами, как у вас все здесь замечательно\", — сказал Триппель на встрече в крымском парламенте.\r\n\r\nОн уточнил, что уже не в первый раз привозит немецких туристов на полуостров, подчеркнув, что это безопасный регион.', 4, 0);


-- ________________________________________________________________________________________________________________

CREATE TABLE `users`(
	id SERIAL PRIMARY KEY,
	login VARCHAR(255) UNIQUE NOT NULL,
	hash_pass VARCHAR(255) NOT NULL,
	hash VARCHAR(255)
);

INSERT INTO `users` (login, hash_pass) VALUES ('admin', '$2y$10$mW.mvlzXGAg6zgitruZafOjirFCfChKDjc6brzItzHrcZWQJhj5KK'),
('user', '$2y$10$1r60.yDPDE1SZ2MP6UUaS.RAxo4Hfma6a9StLZhTgGOML/1L2Enee'),
('alex', '$2y$10$BIX4a9SohN0IhFKvOM7oNudAMO5wuWf2K3E2LS8e02kpmT4Ut7Y0O');
-- 123
-- 321
-- 555

CREATE TABLE `catalog` (
	id SERIAL PRIMARY KEY,
	name VARCHAR(255) NOT NULL,
	price BIGINT NOT NULL,
	img_filename VARCHAR(255),
	about_info TEXT
);

drop table if exists `cart`;
CREATE TABLE `cart`(
	id SERIAL PRIMARY KEY,
	catalog_item_id BIGINT UNSIGNED NOT NULL,
	session_id VARCHAR(255) NOT NULL,
	user_id BIGINT UNSIGNED,
	`count` BIGINT DEFAULT 1,
	
	FOREIGN KEY (catalog_item_id) REFERENCES `catalog`(id) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE
);


CREATE TABLE `review_item` (
	id SERIAL PRIMARY KEY,
	name VARCHAR(255) NOT NULL,
	textReview TEXT,
	item_catalog_id BIGINT UNSIGNED NOT NULL,
	
	FOREIGN KEY (item_catalog_id) REFERENCES `catalog`(id) ON UPDATE CASCADE ON DELETE CASCADE
);



INSERT INTO `catalog` (name, price, about_info, img_filename)
VALUES 
('JOURNEY', 390, 'Лети над песками, скользи среди развалин и раскрывай тайны древнего и загадочного мира Journey. Изучай эти огромные пространства в одиночку или вместе с такими же странниками. Игра Journey с ее потрясающей графикой и музыкой, номинированной на премию «Грэмми», подарит самые яркие и незабываемые впечатления.', 'journey.png'),
('Ori and the Will of te Wisps', 515, 'Маленький дух Ори не понаслышке знаком со всевозможными опасностями. Его юная подруга, сова Ку, очутилась в беде после злополучного полёта. Ори предстоит воссоединить свою семью, спасти искажённый край и узнать, что уготовано ему судьбой, — а одной храбрости для этого мало. Отправляйтесь в путь по бескрайним просторам нарисованного вручную мира, где вам встретятся новые друзья и враги. Ori and the Will of the Wisps продолжает добрую традицию Moon Studios — здесь захватывающий игровой процесс под оригинальную музыку в исполнении оркестра тесно переплетён с трогательным сюжетом.', 'ori.jpg'),
('Hades', 465 , 'Станьте бессмертным принцем Подземного мира, обладающим мифическим оружием и силами Олимпа, которые помогут вырваться из владений самого бога мёртвых. После каждой уникальной попытки побега вы будете становиться сильнее и наблюдать за развитием сюжета.', 'hades.jpg'),
('Kingdoms and Castles', 249, 'Королевства и Замки это игра о том как вырастить королевство из маленькой деревушки до процветающего города и великолепного замка. Ваше королевство должно выживать в живом и опасном мири. Уплывут ли шайки викингов с вашими поселенцами в трюмах? Или их утыкают стрелами на подступах к стенам? Спалит ли дракон ваш амбар, а люди вымрут зимой от голода, или вы сможете дать зверю отпор? Успех вашего королевства зависит исключительно от ваших навыков сроить города и замки.', 'kingdomAndCastles.jpg'),
('Omensight: Definitive Edition', 435, 'Вы - предвестник, мифический воин, который появляется только в переломные моменты. Землю Уралии раздирает война. Но что ещё хуже, когда наступает ночь, вы становитесь свидетелем разрушения мира от рук темного Бога. Вам дана сила прожить последний день еще раз. Ведите расследование и появляйтесь рядом с персонажами, которые сыграли роль в апокалипсисе, сражайтесь с ними или против них, и используйте силу Оменсайт, чтобы создать новую историю. Благодаря вашим решениям, вашим навыкам и умениям, измените этот день, и возможно, вы сможете проложить путь к светлому будущему.', 'Omensight.jpg'),
('Mark of the Ninja: Remastered', 435, 'В игре Mark of the Ninja Remastered вы узнаете, что значит быть настоящим ниндзя. Чтобы перехитрить соперников, нужно быть безмолвным, ловким и смекалистым. Проклятые татуировки усиливают чувства ниндзя, а каждая ситуация даёт новые возможности. В игровом мире удивительные пейзажи и красивая анимация.', 'mark-of-the-ninja-ninja.jpg');


INSERT INTO `review_item` (name, textReview, item_catalog_id)
VALUES ('Валера', 'хорошая игра', 1), ('Анна', 'Очень умиротворяющая атмосфера', 1), ('Екатерира', 'Классная музыка', 1), ('Александр', 'Отличная чигра чтобы расслабиться', 1);

/*
DROP TABLE IF EXISTS news;
CREATE TABLE news (
  id SERIAL PRIMARY KEY,
  title  VARCHAR(255) NOT NULL,
  `text` TEXT NOT NULL,
  categoty_id BIGINT UNSIGNED NOT NULL,
  views BIGINT NOT NULL DEFAULT 0
  
);

DROP TABLE IF EXISTS category;
CREATE TABLE category (
	id SERIAL PRIMARY KEY,
	name VARCHAR(255) NOT NULL
);

DROP TABLE IF EXISTS `imgs`;
CREATE TABLE `imgs` (
	id SERIAL PRIMARY KEY,
	name VARCHAR(255) NOT NULL,
	views BIGINT DEFAULT 0
);

ALTER TABLE news
ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (categoty_id) REFERENCES category(id) ON UPDATE CASCADE ON DELETE CASCADE;


INSERT INTO `imgs` (id, name) VALUES (15, '01.jpg'),(19, '02.jpg'),( 56,'03.jpg'),(14, '04.jpg'),(88,'05.jpg'),(54, '06.jpg'),(42, '07.jpg'),(81, '08.jpg'),(91, '09.jpg'),(77, '10.jpg');

INSERT INTO `category` (`id`, `name`) VALUES (3, 'Политика'), (4, 'Спорт'), (5, 'Игры');

INSERT INTO `news` (`id`, `title`, `text`, `categoty_id`, `views`) VALUES
(4, 'ВОЗ спрогнозировала появление нового смертоносного вируса', '\r\nМОСКВА, 24 мая — РИА Новости. Рано или поздно человечество столкнется с новой пандемией, которая окажется опаснее нынешней, заявил генеральный директор Всемирной организации здравоохранения (ВОЗ) Тедрос Адханом Гебрейесус.\r\n\"Появится другой вирус, который будет более заразным и смертоносным, чем этот\", — сказал он, выступая на открытии 74-й сессии ВОЗ.\r\nПрохожие на одной из улиц Уханя - РИА Новости, 1920, 24.05.2021\r\n10:45\r\nВ МИД Китая прокомментировали сообщения о болезни трех вирусологов до пандемии\r\nПо мнению главы организации, именно борьба с вирусами показывает, что государствам следует сотрудничать друг с другом, а не соревноваться.\r\n\"По факту мы стоим перед выбором: действовать сообща или быть незащищенными\", — заключил Гебрейесус.\r\nВсемирная ассамблея здравоохранения проходит с 24 мая по 1 июня в виртуальном формате. Ее основная тема — борьба с пандемией COVID-19 и предотвращение новых глобальных чрезвычайных ситуаций в области здравоохранения. В работе ассамблеи принимают участие делегации со всего мира.', 3, 0),
(6, 'Глава немецкой делегации рассказал о впечатлениях от поездки в Крым', 'СИМФЕРОПОЛЬ, 24 мая — РИА Новости. Жители Германии очень хотят попасть в Крым, чтобы увидеть прогресс в развитии полуострова, заявил глава немецкой делегации Виктор Триппель.\r\nДвадцать второго мая 25 граждан ФРГ приехали в российский регион в рамках проекта народной дипломатии \"Мирный Крым — своими глазами. Крымские реалии без европейских домыслов\".\r\n\"Наша дружба будет продолжаться. Мы от всего сердца ездим к вам в гости. Я никого (из участников поездки. — Прим. ред.) не уговаривал, никому деньги не давал. Люди сами приехали — и еще приедут. Все очень хотят попасть в Крым, посмотреть своими глазами, как у вас все здесь замечательно\", — сказал Триппель на встрече в крымском парламенте.\r\n\r\nОн уточнил, что уже не в первый раз привозит немецких туристов на полуостров, подчеркнув, что это безопасный регион.', 4, 0);
*/