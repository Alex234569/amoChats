-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Янв 10 2021 г., 23:46
-- Версия сервера: 8.0.19
-- Версия PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `chats`
--

DELIMITER $$
--
-- Функции
--
CREATE DEFINER=`root`@`127.0.0.1` FUNCTION `VerboseCompare` (`n` INT, `m` INT) RETURNS VARCHAR(50) CHARSET utf8mb4 BEGIN
    DECLARE s VARCHAR(50);

    IF n = m THEN SET s = 'equals';
    ELSE
      IF n > m THEN SET s = 'greater';
      ELSE SET s = 'less';
      END IF;

      SET s = CONCAT('is ', s, ' than');
    END IF;

    SET s = CONCAT(n, ' ', s, ' ', m, '.');

    RETURN s;
  END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `compound`
--

CREATE TABLE `compound` (
  `id_main` int DEFAULT NULL,
  `id_teg` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `compound`
--

INSERT INTO `compound` (`id_main`, `id_teg`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(2, 5),
(2, 6),
(2, 7),
(3, 8),
(3, 9),
(3, 10),
(4, 6),
(4, 11),
(4, 12),
(4, 13),
(4, 14),
(5, 6),
(5, 14),
(5, 15),
(5, 16),
(6, 6),
(6, 12),
(6, 17),
(6, 18),
(6, 19),
(6, 20),
(7, 9),
(7, 21),
(7, 22),
(7, 23),
(8, 17),
(8, 20),
(9, 1),
(9, 2),
(9, 12),
(9, 25),
(9, 26),
(9, 27),
(9, 28),
(10, 29),
(10, 30),
(10, 31),
(11, 18),
(11, 19),
(11, 32),
(11, 33),
(11, 34),
(12, 35),
(12, 36),
(12, 37),
(13, 32),
(13, 35),
(13, 36),
(13, 38),
(13, 39),
(13, 40),
(14, 35),
(14, 42),
(14, 43),
(14, 44),
(14, 45),
(14, 46),
(14, 47),
(14, 48),
(15, 30),
(15, 35),
(15, 49),
(15, 50),
(15, 51),
(15, 52),
(16, 31),
(16, 35),
(16, 53),
(16, 54),
(16, 55),
(16, 56),
(17, 12),
(17, 14),
(17, 50),
(17, 57),
(17, 58),
(18, 59),
(18, 60),
(18, 61),
(18, 62),
(19, 63),
(19, 64),
(19, 65),
(20, 28),
(20, 66),
(20, 67),
(20, 68),
(20, 69),
(20, 70),
(21, 71),
(22, 72),
(22, 73),
(22, 74),
(23, 35),
(23, 75),
(23, 76),
(23, 77),
(23, 78),
(23, 79),
(23, 80),
(23, 81),
(24, 35),
(24, 82),
(25, 35),
(25, 83),
(25, 84),
(26, 85),
(26, 86),
(26, 87),
(26, 88),
(26, 89),
(27, 30),
(27, 90),
(27, 91),
(28, 30),
(28, 35),
(28, 92),
(28, 93),
(29, 35),
(29, 38),
(29, 93),
(29, 94),
(30, 67),
(30, 68),
(30, 94),
(30, 95),
(30, 96),
(30, 97),
(31, 35),
(31, 98),
(31, 99),
(31, 100),
(32, 28),
(32, 35),
(32, 101),
(32, 102),
(32, 103),
(32, 104),
(33, 84),
(33, 105),
(33, 106);

-- --------------------------------------------------------

--
-- Структура таблицы `main`
--

CREATE TABLE `main` (
  `id_main` int NOT NULL,
  `question` varchar(1000) NOT NULL,
  `answer` varchar(2000) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `main`
--

INSERT INTO `main` (`id_main`, `question`, `answer`, `url`, `date`) VALUES
(1, '*', 'Перевод аккаунта на технический тариф. ОИ Слободяник А.', NULL, NULL),
(2, '*', 'Пока данный метод не опубликован, но вскоре должен появиться в API документации.', NULL, NULL),
(3, '*', 'Рады, что вы смогли разобраться в данной ситуации.', NULL, NULL),
(4, '*', 'Зафиксировали ваше сообщение и добавили в список работ. Мы обязательно вас проинформируем как будут внесены необходимые правки.\r\nДанное обращение по-прежнему находится в списке работ наших специалистов. Мы сообщим вам в данном чате при получении актуальной информации.\r\n', NULL, NULL),
(5, '*', 'Запросили информацию у специалистов, ждем обратной связи. Обязательно сообщим вам при ее получении', NULL, NULL),
(6, '*', 'Зафиксировали некорректное поведение иконки левого меню при отключении интеграции и добавили в список работ специалистов. Как появится актуальная информация - сообщим в рамках данного чата.\r\n//\r\nПотом добавить коммент в jira (ссылка на чат + id клиента)\r\nПотом отписать в бота:\r\n«https://amocrm.atlassian.net/browse/INT-631\r\nПри отключении интеграции не произошло удаление пункта из левого меню»  \r\n', NULL, NULL),
(7, '*', '1. Суть проблемы\r\n2. ID клиента и/или субдомен, где наблюдается проблема\r\n3. Воспроизводиться или нет в техническом аккаунте\r\n3.1 Если воспроизводиться - подробный кейс воспроизведения\r\n3.2 Если не воспроизводиться - время и дата запроса, тело запроса (если это метод API), сам метод, и по возможности Acess Token, URL, Header, версия аккаунта, код ответа и тело ответа на запрос\r\n', NULL, NULL),
(8, 'Информация по тикетам', '1. Теряются хуки https://amocrm.atlassian.net/browse/XDUTY-906 \r\n2. Кэшируются данные меню https://amocrm.atlassian.net/browse/INT-787 \r\n3. При отключении интеграции не произошло удаление пункта из левого меню https://amocrm.atlassian.net/browse/INT-631\r\n', NULL, NULL),
(9, 'Надо выполнить запрос от лица клиента', 'Можно ли нам выполнить данный запрос с вашими данными?\r\nМожно ли нам выполнить запросы в вашем техническом аккаунте?', NULL, NULL),
(10, '*', 'Интеграция принята и поставлена в очередь на модерацию. Процесс может занимать 1-2 рабочих дня.\r\nНапоминаем, что модерация проходит в 2 этапа\r\n1.Аудит кода интеграции\r\n2.Тестирование интеграции\r\nПо результатам проверки сообщим вам в рамках данного чата.\r\n', NULL, NULL),
(11, 'Закэшировались данные левого меню при удалении интеграции', 'Пожалуйста. Попробуйте сменить часовой пояс и пересохранить настройки аккаунта. ', NULL, NULL),
(12, 'Откат версии виджета', 'Откатить версию виджета может только руководитель отдела интеграции', 'https://customers.amocrm.ru/customers/detail/151847', '2020-12-21'),
(13, 'Зарузили новую версию виджета, старый код', 'После загрузки новой версии виджета попробуйте сделать очистку кэша: для этого в браузере хром нажмите на f12, открыв консоль, далее ПКМ на знак обновления страницы и в выпадающем списке выберите \"Очистка кэша и жесткая перезагрузка\"\r\nhttps://i.imgur.com/er7vcS9.png \r\n', NULL, NULL),
(14, 'Что надо сделать что бы наш виджет попал в верхнюю карусель лучших интеграций, где сейчас находится UIS, Мегафон и тд? Может быть надо заплатить за это место?', 'Что бы ваша интеграция была размещена в дополнительном разделе рекомендуемые или карусели, вы можете написать на почтовый адрес marketing@team.amocrm.com , для последующего согласования.', NULL, NULL),
(15, 'Не загружается картинка', 'Изображение должно быть строго размером 1188х616', 'https://customers.amocrm.ru/leads/detail/33565791', '2020-12-21'),
(16, 'Не активна кнопка «отправить на проверку» ', 'Проверьте заполнены ли у вас все поля и не превышает ли поле короткое описание 50 символов', 'https://customers.amocrm.ru/leads/detail/33351353', '2020-12-21'),
(17, '*', 'Обращение по некорректному отображению изображений до описания находится в списке работ наших специалистов.', NULL, NULL),
(18, 'Где подключать css', 'подключать файл style.css рекомендуем в блоке define  ', 'https://customers.amocrm.ru/leads/detail/37498301', '2020-12-18'),
(19, 'про расположение серверов (не отвечать)', 'Для обеспечения надежности работы системы мы используем географически распределенную сеть серверов, расположенную в Российской Федерации', 'https://customers.amocrm.ru/leads/detail/33354211', '2020-12-21'),
(20, 'касаемо типа данных у айдишников полей', 'И на 11, и на 12 версии данные поля имели тип int. Документация: https://www.amocrm.ru/developers/content/crm_platform/custom-fields. Вероятно, запрос работал на старой версии аккаунта по причине некорректной валидации данных.', 'https://customers.amocrm.ru/leads/detail/33350549 ', '2020-12-22'),
(21, 'надо подключить смс сервис что бы было можно создавать кабинеты для клиентов', 'Для работы с личным кабинетом, вам необходимо добавить новые области видимости описанные в нашей документации https://www.amocrm.ru/developers/content/integrations/system_sms', 'https://customers.amocrm.ru/leads/detail/31465290  22 12 2020', '2020-12-22'),
(22, 'ошибка 401 при запросе на обновление токена', 'Ошибку 401 при запросе на обновление токена вы можете получить по следующим причинам:\r\n- пользователь отключил интеграцию\r\n- пользователь отозвал права в настройках интеграции\r\n- пользователь, через которого интеграция была авторизована был деактивирован или удален из аккаунта\r\n- вы пытаетесь авторизоваться со старым токеном (при обменен refresh на access создается новая пара ключей)\r\n- истек период действия refresh_token\r\n- указаны некорректные данные\r\n \r\nЧтобы проверить, от какого пользователя была авторизована интеграция в аккаунте, пожалуйста, укажите предыдущий access_token. Также уточните у клиента, мог ли он отозвать права у интеграции\r\n', 'https://customers.amocrm.ru/leads/detail/33926251', '2020-12-22'),
(23, 'виджет ошибка: Upload and manifest codes not equal', 'Ошибка \"Upload and manifest codes not equal\" возникает в случае, если вы передаете в manifest.json поля code и sekret_key.\r\nЕсли у вас нет данных полей, то перешлите нам архив виджета.\r\n', 'https://customers.amocrm.ru/leads/detail/37511583', '2020-12-22'),
(24, 'Про добавление библиотек в виджет', '// ответ в чате (21 12 2020 и 22 12 2020)', 'https://customers.amocrm.ru/leads/detail/37498301', '2020-12-21'),
(25, 'интегратор просит разрешить в виджете делать запросы в цикле к амо', 'Нашими правилами запрещено использование запросов к нашей системе из кода виджета именно из-за опасений одномоментного большого количества обращений. Единственное, как вы можете решить данную проблему, это отправлять такой запрос с вашего бэка: то есть виджет передает информацию на ваши сервера с вашим бэком и уже оттуда идут запросы к нам. Пожалуйста, если будете осуществлять данную схему, не забудьте про ограничение в 7 запросов в секунду к нашим серверам для избежания блокировки.', 'https://customers.amocrm.ru/leads/detail/33199175', '2020-12-23'),
(26, 'фильтр по сделкам в альфа тесте, просят добавить', 'Да можете оставить заявку, с субдоменом и id аккаунта, который необходимо подключить к альфа тестированию\r\nмы составим заявку, и когда она будет одобрена и функционал будет подключен, мы вам отпишем\r\n', 'https://customers.amocrm.ru/leads/detail/33349167', '2020-12-23'),
(27, 'слетает форматирование в описаниях интеграции\r\n(При редактировании вижу там отступы и абзацы, а при поиске по интеграциям все отображается сплошной простыней без абзацев)\r\n', 'для форматирования необходимо использовать html разметку', 'https://customers.amocrm.ru/leads/detail/36946717', '2020-12-23'),
(28, 'как подать модерацию на интеграцию', 'Необходимо завести виджет в собственных интеграциях, а не как приватный https://prnt.sc/w8gmh2\r\nВы можете подать интеграцию к нам на модерацию, используя интерфейс технического аккаунта.\r\nДля этого, после действий выше, перейдите в раздел настройки - интеграции https://prnt.sc/sq0ofx, и далее , заполнив все необходимые поля в разделе \"Создать интеграцию\" https://prnt.sc/sq0p9v и https://prnt.sc/sq0pu5 вы можете отправить интеграцию на модерацию\r\n', 'https://customers.amocrm.ru/leads/detail/37517361', '2020-12-23'),
(29, 'что вводить в поле код виджета?', 'В поле код виджета надо вностить уникальный идентификатор для вашей интеграции. Вы ее придумываете сами, она не должна совпадать ни с одной уже существующей. По нему, в дальнейшем, можно будет осуществлять поиск вашей интеграции в маркетплейсе, так же он служит для обозначения внутри системы.\r\nУточню: код интеграции не должен начинаться с заглавной буквы и должен содержать минимум 4 символа\r\n', 'https://customers.amocrm.ru/leads/detail/37517361', '2020-12-24'),
(30, 'изменить тип доп поля', 'К сожалению, невозможно поменять тип поля, вам придется перенести все данные.', 'https://customers.amocrm.ru/leads/detail/37104567', '2020-12-24'),
(31, 'чтобы виджет выпустить с английским интерфейсом, нужен наш сайт на английском и англоязычная тех поддержка?', 'Для этого необходим сайт на EN и хотя бы текстовая поддержка. \r\nНа сайте должна быть EN политика конфиденциальности и указаны ценники в валюте. \r\nПодробнее здесь: https://www.amocrm.ru/developers/content/integrations/requirements#en-es-pt-integrations\r\n', 'https://customers.amocrm.ru/leads/detail/33351069', '2020-12-24'),
(32, 'self.set_settings виджет не сохраняет', 'Метод set_settings() сохраняет данные в качестве настроек виджета до перезагрузки страницы. Это логика его работы. Если вам нужно использовать данные в дальнейшем, используйте localStorage или sessionStorage.', '\r\nhttps://customers.amocrm.ru/leads/detail/37299449\r\n', '2020-12-29'),
(33, 'готовый механизм для метода crm_post() препятствования подделки запроса', 'Здравствуйте для препятствования подделки запроса вы можете использовать одноразовый токен. \r\nМетод работы с ним описан в нашей документации: https://www.amocrm.ru/developers/content/oauth/disposable-tokens\r\nhttps://www.amocrm.ru/developers/content/web_sdk/mechanics#authorized_ajax\r\n', 'https://customers.amocrm.ru/leads/detail/37494979', '2021-01-30');

-- --------------------------------------------------------

--
-- Структура таблицы `tegs`
--

CREATE TABLE `tegs` (
  `id_teg` int NOT NULL,
  `teg` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `tegs`
--

INSERT INTO `tegs` (`id_teg`, `teg`) VALUES
(1, 'акк'),
(2, 'тех'),
(3, 'перевод'),
(4, 'админка'),
(5, 'API'),
(6, 'будущее'),
(7, 'метод'),
(8, 'сарказм'),
(9, 'идиот'),
(10, 'сам'),
(11, 'правки'),
(12, 'косяк'),
(13, 'фиксация'),
(14, 'спецы'),
(15, 'информация'),
(16, 'спец'),
(17, 'jira'),
(18, 'левое'),
(19, 'меню'),
(20, 'тикет'),
(21, 'непонятно'),
(22, 'вопрос'),
(23, 'уточнить'),
(25, 'можно'),
(26, 'разрешение'),
(27, 'чужие'),
(28, 'данные'),
(29, 'отправка'),
(30, 'интеграция'),
(31, 'проверка'),
(32, 'кэш'),
(33, 'удалить'),
(34, 'удаление'),
(35, 'виджет'),
(36, 'версия'),
(37, 'откат'),
(38, 'код'),
(39, 'обновить'),
(40, 'перезагрузка'),
(42, 'блат'),
(43, 'магазин'),
(44, 'интеграции'),
(45, 'раздел'),
(46, 'рекомендации'),
(47, 'лучше'),
(48, 'лучший'),
(49, 'размер'),
(50, 'картинка'),
(51, 'грузить'),
(52, 'загрузка'),
(53, 'отправить'),
(54, 'кнопка'),
(55, 'не'),
(56, 'активна'),
(57, 'изображение'),
(58, 'неправильно'),
(59, 'css'),
(60, 'define'),
(61, 'где'),
(62, 'подключать'),
(63, 'сервера'),
(64, 'сервер'),
(65, 'амо'),
(66, 'айди'),
(67, 'тип'),
(68, 'доп'),
(69, 'поля'),
(70, 'дополнительные'),
(71, 'смс'),
(72, 'токен'),
(73, 'обновление'),
(74, '401'),
(75, 'ошибка'),
(76, 'Upload'),
(77, 'and'),
(78, 'manifest'),
(79, 'codes'),
(80, 'not'),
(81, 'equal'),
(82, 'библиотека'),
(83, 'цикл'),
(84, 'запрос'),
(85, 'фильтр'),
(86, 'альфа'),
(87, 'тест'),
(88, 'фильтрация'),
(89, 'добавить'),
(90, 'форматирование'),
(91, 'разметка'),
(92, 'модерация'),
(93, 'инструкция'),
(94, 'поле'),
(95, 'дополнительное'),
(96, 'поменять'),
(97, 'менять'),
(98, 'английский'),
(99, 'иностранный'),
(100, 'язык'),
(101, 'self.set_settings'),
(102, 'set_settings'),
(103, 'self'),
(104, 'сохранить'),
(105, 'безопасность'),
(106, 'подделка');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `compound`
--
ALTER TABLE `compound`
  ADD KEY `id_main` (`id_main`,`id_teg`),
  ADD KEY `compound_ibfk_2` (`id_teg`);

--
-- Индексы таблицы `main`
--
ALTER TABLE `main`
  ADD PRIMARY KEY (`id_main`);

--
-- Индексы таблицы `tegs`
--
ALTER TABLE `tegs`
  ADD PRIMARY KEY (`id_teg`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `main`
--
ALTER TABLE `main`
  MODIFY `id_main` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT для таблицы `tegs`
--
ALTER TABLE `tegs`
  MODIFY `id_teg` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `compound`
--
ALTER TABLE `compound`
  ADD CONSTRAINT `compound_ibfk_1` FOREIGN KEY (`id_main`) REFERENCES `main` (`id_main`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `compound_ibfk_2` FOREIGN KEY (`id_teg`) REFERENCES `tegs` (`id_teg`) ON DELETE CASCADE ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;