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



