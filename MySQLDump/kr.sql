-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Дек 18 2024 г., 16:53
-- Версия сервера: 10.4.32-MariaDB
-- Версия PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `kr`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- ССЫЛКИ ТАБЛИЦЫ `cache`:
--

-- --------------------------------------------------------

--
-- Структура таблицы `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- ССЫЛКИ ТАБЛИЦЫ `cache_locks`:
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id_category` bigint(20) UNSIGNED NOT NULL,
  `name_category` varchar(100) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- ССЫЛКИ ТАБЛИЦЫ `categories`:
--

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id_category`, `name_category`, `picture`, `created_at`, `updated_at`) VALUES
(1, 'Мыши', '/storage/categories/QP4eHMFcMMiNWMJBwTeSFEW28UXJ4ale8zmo9SOF.png', '2024-12-18 07:42:30', '2024-12-18 07:42:30'),
(2, 'Клавиатуры', '/storage/categories/8RUeeJfSv5GgqSNAw5hIyYXO5e7nM4tlhoxo88Jb.png', '2024-12-18 07:42:42', '2024-12-18 07:42:42'),
(3, 'Гарнитура', '/storage/categories/aJ30u9mvgAgLQiO20FEzv88npTKHlxYXUTZqHyHR.png', '2024-12-18 07:43:04', '2024-12-18 07:43:04');

-- --------------------------------------------------------

--
-- Структура таблицы `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- ССЫЛКИ ТАБЛИЦЫ `failed_jobs`:
--

-- --------------------------------------------------------

--
-- Структура таблицы `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- ССЫЛКИ ТАБЛИЦЫ `jobs`:
--

-- --------------------------------------------------------

--
-- Структура таблицы `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- ССЫЛКИ ТАБЛИЦЫ `job_batches`:
--

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- ССЫЛКИ ТАБЛИЦЫ `migrations`:
--

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_11_07_235929_create_categories_table', 1),
(5, '2024_11_07_235930_create_orders_table', 1),
(6, '2024_11_07_235930_create_products_table', 1),
(7, '2024_11_07_235931_create_order_items_table', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id_order` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `summ` decimal(10,2) NOT NULL,
  `status` enum('Создан','В обработке','Сборка','Готов к выдаче','Завершён','Отменён') NOT NULL DEFAULT 'Создан',
  `payment_method` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- ССЫЛКИ ТАБЛИЦЫ `orders`:
--   `id_user`
--       `users` -> `id`
--

-- --------------------------------------------------------

--
-- Структура таблицы `order_items`
--

CREATE TABLE `order_items` (
  `id_order_item` bigint(20) UNSIGNED NOT NULL,
  `id_order` bigint(20) UNSIGNED NOT NULL,
  `id_product` bigint(20) UNSIGNED NOT NULL,
  `kol` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- ССЫЛКИ ТАБЛИЦЫ `order_items`:
--   `id_order`
--       `orders` -> `id_order`
--   `id_product`
--       `products` -> `id_product`
--

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id_product` bigint(20) UNSIGNED NOT NULL,
  `name_product` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `kol` int(11) NOT NULL,
  `id_category` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- ССЫЛКИ ТАБЛИЦЫ `products`:
--   `id_category`
--       `categories` -> `id_category`
--

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id_product`, `name_product`, `description`, `picture`, `price`, `kol`, `id_category`, `created_at`, `updated_at`) VALUES
(1, 'Мышь беспроводная Logitech G PRO X SUPERLIGHT 2 [910-006634] черный', 'Мышь беспроводная Logitech G PRO X SUPERLIGHT 2 стала обладателем оптического светодиодного сенсора HERO 2, который имеет настраиваемое разрешение в диапазоне от 100 до 32000 dpi.  В конструкцию устройства входят пять кнопок с возможностью их программирования на выполнение определенных действий. Подходящие конфигурации кнопок и прочие настройки можно сохранять во встроенную память мыши. Беспроводная мышь Logitech G PRO X SUPERLIGHT 2 облачена в черный пластиковый корпус, форма которого подходит для использования правой рукой. Стабильную связь с компьютером обеспечивает радиоканал, который настраивается при помощи комплектного USB-ресивера. Для автономной работы манипулятора имеется встроенный аккумулятор, заряда которого хватает на 95 часов непрерывного функционирования.', '/storage/products/brUyyNwsSGApOa1w7lEKYu6xJltGdI21L5lk0mT2.png', 17999.00, 52, 1, '2024-12-18 07:44:24', '2024-12-18 07:44:24'),
(2, 'Мышь беспроводная/проводная Razer DeathAdder V3 Pro [RZ01-04630200-R3G1] белый', 'Мышь беспроводная/проводная Razer DeathAdder V3 Pro выполнена в белом корпусе из пластика с матовым покрытием. Ее эргономичная форма ориентирована для комфортного пользования правой рукой. Для лучшей тактильности верхняя часть корпуса и клавиши разделены. Для связи с компьютером можно воспользоваться миниатюрным ресивером USB либо подключить Razer DeathAdder V3 Pro при помощи кабеля. Тканевая оплетка кабеля делает его устойчивым на разрыв, исключает повреждение в результате перегибов. Мышь использует 5 кнопок, среди которых основные, боковые программируемые клавиши, колесо прокрутки и кнопка смены DPI. От встроенного аккумулятора мышь работает до 90 часов. В основе манипулятора лежит светодиодный сенсор с поддержкой разрешения 30000 dpi.', '/storage/products/tsiEgsYEGC3dum6DmSYQvQi0zz7Os8gahOs4RFKR.png', 14599.00, 52, 1, '2024-12-18 07:44:55', '2024-12-18 07:44:55'),
(3, 'Мышь беспроводная/проводная ARDOR GAMING Phantom PRO [ARDW-PH3395-BK] черный', 'Мышь беспроводная/проводная ARDOR GAMING Phantom PRO [ARDW-PH3395-BK] принесет пользу любителям игр. Оптический светодиодный сенсор устройства PixArt PAW3395 обеспечивает разрешение до 26000 dpi. Высокая точность позиционирования курсора помогает достигать успеха в динамичных видеоиграх. Разрешение датчика можно менять. Подлежит изменению и частота опроса сенсора (максимальное значение данного показателя типично – 1000 Гц). Мышь беспроводная/проводная ARDOR GAMING Phantom PRO [ARDW-PH3395-BK] предоставляет пользователю выбор способа подключения. Максимальный радиус связи «по воздуху» составляет 10 м. Проводное подключение мыши осуществляется с помощью 1.8-метрового кабеля USB, защищенного от механических воздействий износостойкой оплеткой из ткани. Количество кнопок, входящих в оснащение мыши – 6. Устройство рассчитано на хват правой рукой.', '/storage/products/XP1vOOjiHR6lC0wUWs9bRm0lL3lW5e0aqPMqjNQg.png', 5199.00, 52, 1, '2024-12-18 07:45:15', '2024-12-18 07:45:15'),
(4, 'Мышь беспроводная/проводная ASUS ROG Harpe Ace Aim Lab Edition [90MP02W0-BMUA10] белый', 'Мышь беспроводная/проводная ASUS ROG Harpe Ace Aim Lab Edition выдерживает до 90 ч работы от аккумулятора. Есть поддержка подключения к разным устройствам по радиоканалу или Bluetooth. При низком заряде вы можете использовать 2-метровый USB-кабель с устойчивой к износу тканевой оплеткой. Модель украшена логотипом производителя и RGB-подсветкой. ASUS ROG Harpe Ace Aim Lab Edition с симметричным дизайном подходит для хвата любой рукой. Устройство оснащено 5 кнопками управления с поддержкой программирования и встроенной памятью для сохранения заданных настроек. Вы можете ускорять и замедлять курсор с помощью режимов работы датчика в диапазоне 100-36000 dpi.', '/storage/products/07GyZa43S6R5XrxFsQtOSXLW4sSqxHLJAwVcmT7C.png', 8399.00, 52, 1, '2024-12-18 07:45:37', '2024-12-18 07:45:37'),
(5, 'Мышь беспроводная Дарк Проджект x VGN F1 черный', 'Дарк Проджект x VGN F1 - мышь беспроводная с ультранизким весом в 49 грамм, высокоточным сенсором Pixart PAW3395 и временем работы от одного заряда встроенного аккумулятора до 40 часов. Работы датчика в диапазоне 26000 dpi', '/storage/products/muQfGH6U5YXntJcSurZSIidOSSnuaYsqLUYcrmtS.png', 5299.00, 52, 1, '2024-12-18 07:46:02', '2024-12-18 07:46:02'),
(6, 'Клавиатура проводная+беспроводная ARDOR GAMING Guardian [AG-ZD-Gu98GY-HS-G-Sub-WL]', 'Клавиатура проводная + беспроводная ARDOR GAMING Guardian – стильная игровая модель с RGB-подсветкой. 97 удобных клавиш с раскладкой ANSI упрощают ввод текста и управление персонажем. Механическая клавиатура дополнена системой быстрой замены свитчей (Hot Swap), что облегчает ремонт и продлевает срок службы устройства. ARDOR GAMING Guardian с классическим дизайном оснащена отдельным цифровым блоком и рядом клавиш функций Fn. Аккумуляторная модель может работать по Bluetooth, радиоканалу или USB-подключению. При полном заряде вы можете отсоединять кабель и располагаться на любом расстоянии от монитора/телевизора. Клавиатура идет в комплекте с двойным пуллером, сменными свитчами и фирменной наклейкой.', '/storage/products/GdbTvbUJ0YX2H2unl3KlDpd6Rjz8UPlXH2FuiJOM.png', 7299.00, 32, 2, '2024-12-18 07:46:46', '2024-12-18 07:47:29'),
(7, 'Клавиатура проводная Red Square Keyrox TKL Classic Pro II [RSQ-20026]', 'Клавиатура проводная Red Square Keyrox TKL Classic Pro II выполнена в сером корпусе и имеет 87 клавиш. Кнопки управления курсором, специальные и функциональные выделены зеленым цветом, а символьные ‒ белым. Это облегчает поиск нужных клавиш, позволяя работать с клавиатурой быстрее и удобнее. Клавиатура использует механические линейные переключатели Gateron Yellow. Их отличие в приятном щелчке и более плавном ходе. Выполнена клавиатура Red Square Keyrox TKL Classic Pro II в надежном корпусе из металла и пластика, сочетает в себе эргономичную конструкцию и профессиональное исполнение. Система Hot Swap предполагает возможность быстрой и легкой замены свитчей без припоя. Это обеспечивают специальные переходники, которые устанавливают в отверстия под ножки свитчей. Для подключения клавиатуры к ПК используется USB-кабель длиной 1.8 м. Выдвигающиеся ножки на обратной стороне корпуса позволяют настроить высоту устройства.', '/storage/products/fnDo9dEBcla0R5PCq3YBfkgPyzIHhg1JwHzEjUGS.png', 5999.00, 32, 2, '2024-12-18 07:47:21', '2024-12-18 07:47:21'),
(8, 'Клавиатура проводная Logitech G413 CARBON [920-008309]', 'Если вам нужна надежная и функциональная клавиатура, которая не подведет вас в самый ответственный момент при прохождении компьютерной игры, обратите свое внимание на модель Logitech G413 Mechanical Gaming Keyboard. Классический черный корпус представленной модели оригинально разбавляет красная подсветка клавиш, общее количество которых равняется 104. Для пользователей, которым необходимо много работать с числовыми данными, предусмотрен цифровой блок, располагающийся стандартно в правой части клавиатуры. Logitech G413 Mechanical Gaming Keyboard обладает программируемыми клавишами, при помощи которых можно будет установить макросы в какой-нибудь онлайновой ролевой игре. Клавиша функций позволит управлять мультимедия без использования компьютерной мыши. Представленная модель является полноразмерной. Необычным является использование для изготовления корпуса алюминия, который обеспечил данному устройству потрясающую износостойкость. Подключение клавиатуры к компьютеру производится при помощи USB-кабеля.', '/storage/products/KZ7usT8OQMdka8Qu77TJjYuLAsFak32vZmOrK1M1.png', 4399.00, 23, 2, '2024-12-18 07:47:52', '2024-12-18 07:47:52'),
(9, 'Клавиатура проводная Logitech G Pro [920-009393]', 'Клавиатура Logitech G Pro представлена в строгом черном корпусе и обладает многочисленными функциями, которые делают ее идеальным инструментом для игр. Это механическая клавиатура с переключателями GX Blue, обеспечивающими тактильный отклик. Устройство отличается быстрой реакцией на каждое нажатие: отклик клавиш будет быстрее на 10 мс. Конструкция клавиатуры предполагает наличие 89 клавиш, среди которых имеются две дополнительные клавиши, позволяющие управлять подсветкой. Logitech G Pro использует кабель USB длиной 1.8 м для подключения. Модель не содержит цифрового блока, что делает ее идеальным приобретением для турнирных столов: игре с целью победы не будет ничего мешать. Клавиатура содержит 26 клавиш, на которые можно настроить выполнение сложных заданий: они действенны при нажатии их с клавишами-модификаторами. Особенность устройства в подсветке RGB, которую можно синхронизировать с игровыми профилями, сделав процесс игры более эффектным.', '/storage/products/6d5BjhDcv6UsXC8C6yI3EKd8AhjEjzxzCXMNnDso.png', 15799.00, 32, 2, '2024-12-18 07:48:13', '2024-12-18 07:48:13'),
(10, 'Клавиатура проводная Dark Project KD68B [DP-KD-68B-907700-GMT]', 'Клавиатура проводная Dark Project KD68B выполнена в прочном пластиковом корпусе элегантного белого цвета и дополнена светодиодной подсветкой символов RGB, обеспечивая увлекательное погружение в мир компьютерных захватывающих игр. Данная модель обладает компактными размерами и оснащена 68 клавишами с долговечными механическими переключателями. Подключение клавиатуры осуществляется проводным способом с помощью кабеля USB. Среди других особенностей Dark Project KD68B отмечаются выдвижные ножки.', '/storage/products/a8HlG2zAZKmeyA39lY6oLxhmB387W0OWFDBV8eo7.png', 7399.00, 32, 2, '2024-12-18 07:48:35', '2024-12-18 07:48:35'),
(11, 'Проводные наушники ARDOR GAMING Edge черный', 'Проводная гарнитура ARDOR GAMING Edge черного цвета подходит для прослушивания музыки, просмотра фильмов или игр. Модель обеспечивает качественную передачу чистого и естественного звука, передавая высокие и низкие частоты в диапазоне от 20 до 20000 Гц. Технология 7.1 Virtual позволяет слышать мельчайшие шорохи и приближение соперника, что дает преимущество в прохождении уровней. Проводная гарнитура ARDOR GAMING Edge имеет удобное мягкое оголовье и амбушюры. Конструкция обеспечивает длительный комфорт, поэтому наушники практически не ощущаются в процессе многочасовой игры. Подключение к компьютеру, консоли, ноутбуку или другим устройствам осуществляется с помощью кабеля с разъемом jack 3.5 мм. Чистую передачу без искажений осуществляют 50-миллиметровые излучатели. На корпусе есть съемный микрофон для общения и координации действий.', '/storage/products/3vul5GHs5epNo5cVUX6BTzVQ0SKYDMIcvWqnHL5h.png', 3799.00, 15, 3, '2024-12-18 07:50:02', '2024-12-18 07:50:33'),
(12, 'Беспроводные наушники Logitech G435 белый', 'Проводная гарнитура Razer Kraken X Lite использует мягкие охватывающие амбушюры, которые плотно прилегают к ушным каналам. Это изолирует от посторонних шумов, позволяя погрузиться в виртуальный звук. Динамики диаметром 40 мм формируют объемный звук 7.1 Virtual, который обеспечивает точное позиционирование в процессе игры. Вы будете слышать направление звука, определять сторону, где враг ведет активность. Вы получаете сбалансированное, чистое звучание в диапазоне 12-28000 Гц. Наушники Razer Kraken X Lite фиксируются на мягкое регулируемое оголовье. Их положение можно отрегулировать так, чтобы не ощущать дискомфорта при длительном нахождении в них. Мягкая прокладка на внутренней стороне оголовья снижает давление на голову, снимая напряжение. Гарнитура содержит на корпусе гибкий микрофон с подвижным креплением. Его можно отодвинуть, когда он не нужен. Микрофон передает четко голос, заглушая сбоку и сзади фоновые шумы. Это обусловлено использованием микрофоном кардиоидной диаграммы, фокусирующейся у рта.', '/storage/products/l2HLPAkw1lkU686u6SFzfMAQIFTVbQI0OmHMeY0r.png', 9099.00, 15, 3, '2024-12-18 07:50:25', '2024-12-18 07:50:25'),
(13, 'Проводные наушники Razer Kraken X Lite черный', 'Радиочастотная гарнитура Logitech G435 LIGHTSPEED создана для игр и прослушивания музыки. Подключение к ПК или другим устройствам осуществляется на основе технологии LIGHTSPEED и интерфейса Bluetooth беспроводным способом. Динамики с диаметром мембраны 50 мм совместно с технологией Dolby Atmos гарантируют формирование чистого и насыщенного звука. Фиксированный микрофон с четкостью передает голос. Гарнитура Logitech G435 выполнена в корпусе из переработанного пластика и отличается приятной тканевой отделкой. На чашах предусмотрены кнопки включения/выключения и регулировки громкости. Аккумулятор гарантирует в пределах 18 часов автономной работы, а подзарядка выполняется через порт USB Type-C.', '/storage/products/2pmsSD3jftm4YbTHiMzsC0hsjc8tGvWm4Ywl9pZO.png', 3799.00, 15, 3, '2024-12-18 07:51:07', '2024-12-18 07:51:07'),
(14, 'Беспроводные/проводные наушники ARDOR GAMING Blackout 2.4G белый', 'Радиочастотная гарнитура ARDOR GAMING Blackout 2.4G помогает погрузиться в игровой процесс. Шелест, шаги, дыхание врагов в игре и другие звуки воспроизводятся четко благодаря закрытому акустическому оформлению с системой 7.1 Virtual и динамиками 50 мм. Всенаправленный микрофон на гибкой подвижной штанге без искажений передает голос. ARDOR GAMING Blackout 2.4G подключается беспроводным способом по радиоканальной технологии на частоте 2.4 ГГц. Для проводного подключения предусмотрен кабель с разъемами 2х jack 3.5 мм и jack 3.5 мм. Мягкие амбушюры и эргономичное оголовье с регулировкой гарантируют комфортное расположение на голове. В чашах реализована многоцветная подсветка. В автономном режиме встроенный аккумулятор позволяет гарнитуре работать до 12 часов без подзарядки.', '/storage/products/iV9Eh3t8TPLcYKvHkRwu1j9rtKc29qmx4zvUi3Nh.png', 6699.00, 15, 3, '2024-12-18 07:51:28', '2024-12-18 07:51:28'),
(15, 'Проводные наушники SteelSeries Arctis Prime черный', 'Проводная гарнитура SteelSeries Arctis Prime – универсальное и удобное решение в классическом облике. Модель выполнена в сравнительно легком корпусе, главной особенностью которого является конструкция охватывающего типа. Благодаря этому, а также регулируемому оголовью и мягким амбушюрам из искусственной кожи гарнитура подарит вам комфортное повседневное использование. Также SteelSeries Arctis Prime порадует вас высоким качеством звука. Основой модели являются высококачественные излучатели динамического типа диаметром 40 мм. Благодаря этому, а также поддержке звуковой схемы формата 2.0 и широкому диапазону частот модель обеспечит качественное и детализированное звучание. Для подключения гарнитуры используется стандартный AUX-кабель длиной 3 м, что обеспечивает совместимость с различными устройствами. Еще одной особенностью модели является микрофон с функцией шумоподавления и ветрозащитой, который может обеспечить высокое качество передачи голоса и комфортную аудиосвязь. Для управления работой гарнитуры предусмотрено несколько многофункциональных кнопок и регулятор громкости. Модель поставляется в фирменной упаковке с набором кабелей.', '/storage/products/BXaem70QZzA0vZY3xsMSTJW9l1sOgkvYs2oZJHty.png', 7499.00, 15, 3, '2024-12-18 07:51:55', '2024-12-18 07:51:55');

-- --------------------------------------------------------

--
-- Структура таблицы `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- ССЫЛКИ ТАБЛИЦЫ `sessions`:
--

--
-- Дамп данных таблицы `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('G7uANJU1dhHf0xP2EsxhQj511wTL52uP5m07s2Mv', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 YaBrowser/24.12.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoic3J2NG5wcjFnY2R1V2Q4bmpMOWxKUmE5b0xIc29mdFcxd1RzV3VKNCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9kdWN0cy9jYXRlZ29yeS8zIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjM6InVybCI7YTowOnt9fQ==', 1734537129),
('InGfqwNYcDzPxvN3z4Cpwg5906wJQMImuhaRnJJK', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoib0VCU2hTbzJFRnVSd3lPam9BVjE3TDh0dUQxT3BBempFeEJnTU94eCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQxOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvcHJvZHVjdHMvY2F0ZWdvcnkvMyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1734537120);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `phone` varchar(20) NOT NULL,
  `login` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- ССЫЛКИ ТАБЛИЦЫ `users`:
--

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `last_name`, `first_name`, `middle_name`, `phone`, `login`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'User', 'User', 'User', '+7 (487) 982-74-89', 'User', '$2y$12$B0IJzUSpPD9QeoxI6GzJM.2weGCqrKyKM5ij4rh4fc9fgEDl0YToG', 0, '2024-12-18 07:35:08', '2024-12-18 07:35:08'),
(2, 'Admin', 'Admin', 'Admin', '+7 (423) 535-23-54', 'Admin', '$2y$12$lzfxAJ8pvJqyStOtbgEGb.n.L3P5HrzmkDnerJyjCKRjWSj5zJp2G', 1, '2024-12-18 07:35:36', '2024-12-18 07:35:36');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Индексы таблицы `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_category`);

--
-- Индексы таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Индексы таблицы `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Индексы таблицы `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `orders_id_user_foreign` (`id_user`);

--
-- Индексы таблицы `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id_order_item`),
  ADD KEY `order_items_id_order_foreign` (`id_order`),
  ADD KEY `order_items_id_product_foreign` (`id_product`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_product`),
  ADD KEY `products_id_category_foreign` (`id_category`);

--
-- Индексы таблицы `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`),
  ADD UNIQUE KEY `users_login_unique` (`login`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id_category` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id_order_item` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id_product` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_id_order_foreign` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id_order`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_id_product_foreign` FOREIGN KEY (`id_product`) REFERENCES `products` (`id_product`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_id_category_foreign` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id_category`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
