-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Июл 27 2022 г., 17:10
-- Версия сервера: 8.0.29-0ubuntu0.20.04.3
-- Версия PHP: 7.4.3
USE qprtech;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `qprtech`
--

-- --------------------------------------------------------

--
-- Структура таблицы `contact`
--

CREATE TABLE `contact` (
                           `id` int NOT NULL,
                           `name` varchar(128) NOT NULL,
                           `email` varchar(128) NOT NULL,
                           `subject` varchar(256) NOT NULL,
                           `body` text NOT NULL,
                           `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `subject`, `body`, `date`) VALUES
    (1, 'John Doe', 'johndoe@example.com', 'Test Email subject', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut id accumsan ipsum, quis vulputate purus. Sed quis ante id diam placerat egestas sit amet maximus diam. Aenean ut nisl in metus viverra rutrum in vehicula lectus. Nullam rhoncus vitae felis sed pharetra. Donec mauris lectus, efficitur ac odio ac, congue facilisis urna. Nunc aliquet mattis est, id porta diam porttitor hendrerit. Curabitur ex diam, vestibulum sit amet nisi ac, vehicula tristique tortor. Etiam malesuada sem orci, a ornare est rhoncus ut. Sed non eleifend felis. Proin molestie ex enim, ac feugiat lacus sodales sit amet.\r\n\r\n', '2022-07-27 11:09:00');

-- --------------------------------------------------------

--
-- Структура таблицы `language`
--

CREATE TABLE `language` (
                            `id` int NOT NULL,
                            `title` varchar(64) NOT NULL,
                            `shortcut` varchar(8) NOT NULL,
                            `isDefault` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `language`
--

INSERT INTO `language` (`id`, `title`, `shortcut`, `isDefault`) VALUES
    (1, 'English', 'gb', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `page`
--

CREATE TABLE `page` (
                        `id` int NOT NULL,
                        `languageId` int NOT NULL,
                        `sectionId` int DEFAULT NULL,
                        `orderNumber` int NOT NULL DEFAULT '1',
                        `title` varchar(128) NOT NULL,
                        `shortTitle` varchar(32) NOT NULL,
                        `content` text,
                        `image` varchar(128) DEFAULT NULL,
                        `metaTitle` varchar(128) DEFAULT NULL,
                        `metaDescription` varchar(256) DEFAULT NULL,
                        `keywords` varchar(256) DEFAULT NULL,
                        `isIndex` tinyint(1) NOT NULL DEFAULT '1',
                        `isFollow` tinyint(1) NOT NULL DEFAULT '1',
                        `isHomePage` tinyint(1) NOT NULL DEFAULT '0',
                        `slug` varchar(256) DEFAULT NULL,
                        `headScript` text CHARACTER SET utf8mb3 COLLATE utf8_general_ci,
                        `bodyScript` text CHARACTER SET utf8mb3 COLLATE utf8_general_ci,
                        `isHidden` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `page`
--

INSERT INTO `page` (`id`, `languageId`, `sectionId`, `orderNumber`, `title`, `shortTitle`, `content`, `image`, `metaTitle`, `metaDescription`, `keywords`, `isIndex`, `isFollow`, `isHomePage`, `slug`, `headScript`, `bodyScript`, `isHidden`) VALUES
                                                                                                                                                                                                                                                    (2, 1, NULL, 1, 'Hello, world!', 'H E L L O', '<div class=\"container\">\r\n  <div class=\"intro\">\r\n    <div class=\"content\">\r\n      <h2>Hello, World!</h2>\r\n      <p>Creating your website has never been so easy</p>\r\n    </div>\r\n  </div>\r\n</div>', '/img/pages/0VRxosAbgrq27RPi.jpeg', '', '', '', 1, 1, 1, 'index', 'console.log(\'hello head\');', 'console.log(\'hello body\');', 0),
                                                                                                                                                                                                                                                    (7, 1, 9, 1, 'Login', 'Login', '<div class=\"container\">\r\n  {{ breadCrumbs }}\r\n  {{ loginForm }}\r\n</div>', NULL, 'Login', '', '', 0, 0, 0, 'login', '', '', 0),
                                                                                                                                                                                                                                                    (8, 1, 10, 1, 'About', 'About', '', NULL, 'About', 'About', 'About', 1, 1, 0, 'about', '', '', 0),
                                                                                                                                                                                                                                                    (9, 1, 10, 2, 'Blog', 'Blog', '<div class=\"container\">{{ blog }}</div>', NULL, 'Blog', 'Blog', 'Blog', 1, 1, 0, 'blog', '', '', 0),
                                                                                                                                                                                                                                                    (10, 1, 10, 3, 'Contact', 'Contact', '<div class=\"container\">\r\n  <h1>Contact</h1>\r\n    <p>\r\n        If you have business inquiries or other questions, please fill out the following form to contact us.\r\n        Thank you.\r\n    </p>\r\n  {{ contactForm }}\r\n</div>', NULL, 'Contact', 'Contact', 'Contact', 1, 1, 0, 'contact', '', '', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `post`
--

CREATE TABLE `post` (
                        `id` int NOT NULL,
                        `languageId` int NOT NULL,
                        `orderNumber` int NOT NULL DEFAULT '1',
                        `title` varchar(128) NOT NULL,
                        `preview` varchar(256) DEFAULT NULL,
                        `content` text,
                        `image` varchar(128) DEFAULT NULL,
                        `metaTitle` varchar(128) DEFAULT NULL,
                        `metaDescription` varchar(256) DEFAULT NULL,
                        `keywords` varchar(256) DEFAULT NULL,
                        `isIndex` tinyint(1) NOT NULL DEFAULT '1',
                        `isFollow` tinyint(1) NOT NULL DEFAULT '1',
                        `slug` varchar(256) CHARACTER SET utf8mb3 COLLATE utf8_general_ci NOT NULL,
                        `headScript` text,
                        `bodyScript` text,
                        `isHidden` int NOT NULL DEFAULT '0',
                        `views` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `post`
--

INSERT INTO `post` (`id`, `languageId`, `orderNumber`, `title`, `preview`, `content`, `image`, `metaTitle`, `metaDescription`, `keywords`, `isIndex`, `isFollow`, `slug`, `headScript`, `bodyScript`, `isHidden`, `views`) VALUES
                                                                                                                                                                                                                               (2, 1, 1, 'The Best Chocolate Mug Cake', 'Mug cake is just so incredibly cozy!', '<p style=\"font-family: arial, sans-serif; -webkit-font-smoothing: antialiased; font-size: 17px; line-height: 30px; position: relative; color: rgb(0, 0, 0);\">\r\n  Do you love cake? Do you love mugs? If you answered yes to either question then you know in your heart that mug cake is for you. Mug cake is just so incredibly cozy! What could be better than curling up on the couch with a warm chocolate cake in a mug in your hands? It is the pinnacle of being.\r\n</p>\r\n<p style=\"font-family: arial, sans-serif; -webkit-font-smoothing: antialiased; font-size: 17px; line-height: 30px; position: relative; color: rgb(0, 0, 0);\">\r\n  <em style=\"-webkit-font-smoothing: antialiased;\">\r\n    Food confession time:\r\n  </em>\r\n  &nbsp;when I was a kid, I LOVED those frozen chocolate cakes you got at the grocery store. My mom never baked chocolate cake, so Deep‘n Delicious is the chocolate cake that has all my warm and fuzzy nostalgic childhood memories. I’m pretty sure&nbsp;it’s a Canadian thing, so if you have no idea what I’m talking about, I don’t blame you. Basically, DND (as it shall now be known) is a frozen chocolate cake with star shaped chocolate frosting piped on top. The closest thing I’ve found to it while living in America is SaraLee.\r\n</p>\r\n<p style=\"font-family: arial, sans-serif; -webkit-font-smoothing: antialiased; font-size: 17px; line-height: 30px; position: relative; color: rgb(0, 0, 0);\">\r\n  <img src=\"/uploads/mug-cake-6049.jpg\" class=\"img-fluid\">\r\n    </p>\r\n  <p style=\"font-family: arial, sans-serif; -webkit-font-smoothing: antialiased; font-size: 17px; line-height: 30px; position: relative; color: rgb(0, 0, 0);\">\r\n    I totally don’t buy frozen chocolate cake anymore (or do I?!), but what I remember loving about it was the fact that there was always cake on hand. It was frozen, but magically easy to slice and enjoy at all times of the day. Mug cake is almost as easy as pulling a pre-made cake out of the freezer, but it has the bonus of being warm, so mug cake is my new favorite thing!\r\n  </p>\r\n  <h2 style=\"font-family: nobel; -webkit-font-smoothing: antialiased; font-size: 30px; color: rgb(0, 0, 0);\">\r\n    What is mug cake?\r\n  </h2>\r\n  <p style=\"font-family: arial, sans-serif; -webkit-font-smoothing: antialiased; font-size: 17px; line-height: 30px; position: relative; color: rgb(0, 0, 0);\">\r\n\r\n  </p>\r\n  <p style=\"font-family: arial, sans-serif; -webkit-font-smoothing: antialiased; font-size: 17px; line-height: 30px; position: relative; color: rgb(0, 0, 0);\">\r\n    Mug cake is a cake that’s made in a mug! It bakes up in just a minute in the microwave and is a warm and chocolate-y treat that will satisfy any chocolate sweet tooth. Mug cake is perfect for when you just want a single serving of cake and don’t want to bust out all your baking equipment.\r\n  </p>\r\n  <p style=\"font-family: arial, sans-serif; -webkit-font-smoothing: antialiased; font-size: 17px; line-height: 30px; position: relative; color: rgb(0, 0, 0);\">\r\n    <img src=\"/uploads/mug-cake-6067.jpg\" class=\"img-fluid\">\r\n      </p>\r\n    <h2 style=\"font-family: nobel; -webkit-font-smoothing: antialiased; font-size: 30px; color: rgb(0, 0, 0);\">\r\n      What does it taste like?\r\n    </h2>\r\n    <p style=\"font-family: arial, sans-serif; -webkit-font-smoothing: antialiased; font-size: 17px; line-height: 30px; position: relative; color: rgb(0, 0, 0);\">\r\n      Heaven! Seriously, I’m not joking guys, this cake is SO GOOD. It’s moist, chocolatey, and light and fluffy. I love the melty chocolate parts that essentially make it like molten chocolate lava cake. I like it plain, with a little bit of powdered sugar, with whipped cream, with ice cream, oh my gosh, I feel like I need one right now. The best part is that it comes together so quickly. Bonus points for the fact that I almost always have everything right at home.\r\n    </p>\r\n    <h2 style=\"font-family: nobel; -webkit-font-smoothing: antialiased; font-size: 30px; color: rgb(0, 0, 0);\">\r\n      Mug cake ingredients\r\n    </h2>\r\n    <p style=\"font-family: arial, sans-serif; -webkit-font-smoothing: antialiased; font-size: 17px; line-height: 30px; position: relative; color: rgb(0, 0, 0);\">\r\n      For this mug cake, you need:\r\n    </p>\r\n    <p style=\"font-family: arial, sans-serif; -webkit-font-smoothing: antialiased; font-size: 17px; line-height: 30px; position: relative; color: rgb(0, 0, 0);\">\r\n\r\n    </p>\r\n    <ul style=\"font-family: arial, sans-serif; -webkit-font-smoothing: antialiased; color: rgb(0, 0, 0); font-size: medium;\">\r\n      <li style=\"-webkit-font-smoothing: antialiased; font-size: 17px; line-height: 30px; padding-right: 60px; margin-bottom: 15px;\">\r\n        <strong style=\"font-weight: bold; -webkit-font-smoothing: antialiased;\">\r\n          Milk.\r\n        </strong>\r\n        &nbsp;I use whatever milk I have in the fridge, usually 2% or almond.\r\n      </li>\r\n      <li style=\"-webkit-font-smoothing: antialiased; font-size: 17px; line-height: 30px; padding-right: 60px; margin-bottom: 15px;\">\r\n        <strong style=\"font-weight: bold; -webkit-font-smoothing: antialiased;\">\r\n          Oil.\r\n        </strong>\r\n        &nbsp;Try to use a neutral oil that doesn’t have any flavor like canola oil.\r\n      </li>\r\n      <li style=\"-webkit-font-smoothing: antialiased; font-size: 17px; line-height: 30px; padding-right: 60px; margin-bottom: 15px;\">\r\n        <strong style=\"font-weight: bold; -webkit-font-smoothing: antialiased;\">\r\n          Flour.\r\n        </strong>\r\n      </li>\r\n      <li style=\"-webkit-font-smoothing: antialiased; font-size: 17px; line-height: 30px; padding-right: 60px; margin-bottom: 15px;\">\r\n        <strong style=\"font-weight: bold; -webkit-font-smoothing: antialiased;\">\r\n          Cocoa powder.\r\n        </strong>\r\n        &nbsp;For cocoa powder, we need the unsweetened kind, not hot chocolate milk.\r\n      </li>\r\n      <li style=\"-webkit-font-smoothing: antialiased; font-size: 17px; line-height: 30px; padding-right: 60px; margin-bottom: 15px;\">\r\n        <strong style=\"font-weight: bold; -webkit-font-smoothing: antialiased;\">\r\n          Baking powder.\r\n        </strong>\r\n      </li>\r\n      <li style=\"-webkit-font-smoothing: antialiased; font-size: 17px; line-height: 30px; padding-right: 60px; margin-bottom: 15px;\">\r\n        <strong style=\"font-weight: bold; -webkit-font-smoothing: antialiased;\">\r\n          Sugar.\r\n        </strong>\r\n        &nbsp;You can adjust the sugar to you liking, or use a sugar alternative.\r\n      </li>\r\n      <li style=\"-webkit-font-smoothing: antialiased; font-size: 17px; line-height: 30px; padding-right: 60px; margin-bottom: 15px;\">\r\n        <strong style=\"font-weight: bold; -webkit-font-smoothing: antialiased;\">\r\n          Chocolate chips.\r\n        </strong>\r\n        &nbsp;The chocolate gets melty and gooey and is the best part! I usually just chop up a bit of a chocolate bar/baking chocolate if I don’t have chocolate chips in the pantry.\r\n        <img src=\"/uploads/mug-cake-6073.jpg\" class=\"img-fluid\">\r\n          </li>\r\n        </ul>', '/img/posts/mug-cake-6076w.jpg', 'The Best Chocolate Mug Cake', 'Mug cake is just so incredibly cozy!', '', 1, 1, 'the-best-chocolate-mug-cake', '', '', 0, 0),
                                                                                                                                                                                                                               (3, 1, 1, 'Air Fryer Donuts', 'These yeasted air fryer donuts taste just like deep fried donuts and are way better than baked.', '<p style=\"font-family: arial, sans-serif; -webkit-font-smoothing: antialiased; font-size: 17px; line-height: 30px; position: relative; color: rgb(0, 0, 0);\">\r\n  <strong style=\"font-family: nobel; font-weight: bold; -webkit-font-smoothing: antialiased; font-size: 19px;\">\r\n    Fluffy, soft, pillowy, air fryer donuts are a thing and they are amazing.\r\n  </strong>\r\n</p>\r\n<p style=\"font-family: arial, sans-serif; -webkit-font-smoothing: antialiased; font-size: 17px; line-height: 30px; position: relative; color: rgb(0, 0, 0);\">\r\n  If you have an air fryer, you know all about the temptation to make everything in it. It’s kind of funny because all an air fryer really is, is a tiny convection oven with lots of hot air blowing around. Technically, if you have a convection oven, you have a giant air fryer. But there’s something about an air fryer that just seems magic. And what’s even more magic is that you can fry donuts in it.\r\n</p>\r\n<p style=\"font-family: arial, sans-serif; -webkit-font-smoothing: antialiased; font-size: 17px; line-height: 30px; position: relative; color: rgb(0, 0, 0);\">\r\n  <img src=\"/uploads/air-fryer-donuts-3897.webp\" class=\"img-fluid\">\r\n    </p>\r\n  <h2 style=\"font-family: nobel; -webkit-font-smoothing: antialiased; font-size: 30px; color: rgb(0, 0, 0);\">\r\n    Air fryer donuts are the real deal\r\n  </h2>\r\n  <p style=\"font-family: arial, sans-serif; -webkit-font-smoothing: antialiased; font-size: 17px; line-height: 30px; position: relative; color: rgb(0, 0, 0);\">\r\n\r\n  </p>\r\n  <p style=\"font-family: arial, sans-serif; -webkit-font-smoothing: antialiased; font-size: 17px; line-height: 30px; position: relative; color: rgb(0, 0, 0);\">\r\n    These yeasted air fryer donuts taste just like deep fried donuts and are way better than baked. You don’t need to break out the deep fry oil. They’re just like the regular yeasted donuts you know and love, but made easier in the air fryer. You can glaze them, like I did, or you can dip them in cinnamon sugar. Either way, these air fryer donuts are the perfect sweet treat.\r\n  </p>\r\n  <p style=\"font-family: arial, sans-serif; -webkit-font-smoothing: antialiased; font-size: 17px; line-height: 30px; position: relative; color: rgb(0, 0, 0);\">\r\n    <img src=\"/uploads/air-fryer-donuts-3908.webp\" class=\"img-fluid\">\r\n      </p>\r\n    <h2 style=\"font-family: nobel; -webkit-font-smoothing: antialiased; font-size: 30px; color: rgb(0, 0, 0);\">\r\n      Biscuit vs Yeast Donuts\r\n    </h2>\r\n    <p style=\"font-family: arial, sans-serif; -webkit-font-smoothing: antialiased; font-size: 17px; line-height: 30px; position: relative; color: rgb(0, 0, 0);\">\r\n      There are a bunch of biscuit donut recipes out there, but the truth is, if you air fry biscuit dough and coat it in glaze, it’s still a biscuit, not a doughnut. Yeast donuts are fluffier, softer, and taste more like the kind of donut you can get at a really good donuterie. Making yeast donuts takes a little more time (mostly hands off) but it’s so worth it.\r\n    </p>\r\n    <h2 style=\"font-family: nobel; -webkit-font-smoothing: antialiased; font-size: 30px; color: rgb(0, 0, 0);\">\r\n      How to make air fryer donuts\r\n    </h2>\r\n    <p style=\"font-family: arial, sans-serif; -webkit-font-smoothing: antialiased; font-size: 17px; line-height: 30px; position: relative; color: rgb(0, 0, 0);\">\r\n\r\n    </p>\r\n    <ol style=\"font-family: arial, sans-serif; -webkit-font-smoothing: antialiased; color: rgb(0, 0, 0); font-size: medium;\">\r\n      <li style=\"-webkit-font-smoothing: antialiased; font-size: 17px; line-height: 30px; padding-right: 60px; margin-bottom: 15px;\">\r\n        <strong style=\"font-weight: bold; -webkit-font-smoothing: antialiased;\">\r\n          Mix.\r\n        </strong>\r\n        &nbsp;In the bowl of a stand mixer, mix together melted butter, milk, egg, and yeast.\r\n      </li>\r\n      <li style=\"-webkit-font-smoothing: antialiased; font-size: 17px; line-height: 30px; padding-right: 60px; margin-bottom: 15px;\">\r\n        <strong style=\"font-weight: bold; -webkit-font-smoothing: antialiased;\">\r\n          Stir.\r\n        </strong>\r\n        &nbsp;To the yeast mixture, add flour, sugar, and a touch of salt, then stir everything together until it comes into a shaggy ball.\r\n      </li>\r\n      <li style=\"-webkit-font-smoothing: antialiased; font-size: 17px; line-height: 30px; padding-right: 60px; margin-bottom: 15px;\">\r\n        <strong style=\"font-weight: bold; -webkit-font-smoothing: antialiased;\">\r\n          Knead.\r\n        </strong>\r\n        &nbsp;From there, knead the dough on high, using the dough hook, for 3-5 minutes, until the dough is smooth and elastic. If you don’t have a stand mixer, you can knead everything by hand for about 10 minutes.\r\n      </li>\r\n      <li style=\"-webkit-font-smoothing: antialiased; font-size: 17px; line-height: 30px; padding-right: 60px; margin-bottom: 15px;\">\r\n        <strong style=\"font-weight: bold; -webkit-font-smoothing: antialiased;\">\r\n          Proof.\r\n        </strong>\r\n        &nbsp;Gather the dough into a ball and let it rise, covered, in a lightly oiled bowl, until doubled, about 1 hour.\r\n      </li>\r\n      <li style=\"-webkit-font-smoothing: antialiased; font-size: 17px; line-height: 30px; padding-right: 60px; margin-bottom: 15px;\">\r\n        <strong style=\"font-weight: bold; -webkit-font-smoothing: antialiased;\">\r\n          Cut.\r\n        </strong>\r\n        &nbsp;Tip the dough out onto a lightly floured surface and roll it out about 1 inch thick and then cut the doughnuts. Place the cut donuts on a parchment paper lined baking sheet and brush with melted butter.\r\n      </li>\r\n      <li style=\"-webkit-font-smoothing: antialiased; font-size: 17px; line-height: 30px; padding-right: 60px; margin-bottom: 15px;\">\r\n        <strong style=\"font-weight: bold; -webkit-font-smoothing: antialiased;\">\r\n          Rise.\r\n        </strong>\r\n        &nbsp;Let the donuts rise, covered, until puffy and doubled.\r\n      </li>\r\n      <li style=\"-webkit-font-smoothing: antialiased; font-size: 17px; line-height: 30px; padding-right: 60px; margin-bottom: 15px;\">\r\n        <strong style=\"font-weight: bold; -webkit-font-smoothing: antialiased;\">\r\n          Air fry.\r\n        </strong>\r\n        &nbsp;Preheat the air fryer to 350°F, then air fry the donuts for 3 minutes.\r\n      </li>\r\n      <li style=\"-webkit-font-smoothing: antialiased; font-size: 17px; line-height: 30px; padding-right: 60px; margin-bottom: 15px;\">\r\n        <strong style=\"font-weight: bold; -webkit-font-smoothing: antialiased;\">\r\n          Glaze.\r\n        </strong>\r\n        &nbsp;Mix together melted butter, vanilla, milk and powdered sugar to make a glaze and dip the donuts in the glaze while they’re still warm.\r\n      </li>\r\n      <li style=\"-webkit-font-smoothing: antialiased; font-size: 17px; line-height: 30px; padding-right: 60px; margin-bottom: 15px;\">\r\n        <strong style=\"font-weight: bold; -webkit-font-smoothing: antialiased;\">\r\n          Enjoy.\r\n        </strong>\r\n        &nbsp;Pat yourself on the back for making homemade donuts and enjoy!\r\n      </li>\r\n      <li style=\"-webkit-font-smoothing: antialiased; font-size: 17px; line-height: 30px; padding-right: 60px; margin-bottom: 15px;\">\r\n        <img src=\"/uploads/air-fryer-donuts-3921.webp\" class=\"img-fluid\">\r\n          <br>\r\n            </li>\r\n          </ol>', '/img/posts/air-fryer-donuts-3927w-2048x1366.webp', 'Air Fryer Donuts', 'These yeasted air fryer donuts taste just like deep fried donuts and are way better than baked.', '', 1, 1, 'air-fryer-donuts', '', '', 0, 0),
                                                                                                                                                                                                                               (4, 1, 1, 'Shawarma', 'This chicken shawarma is going to blow you away. Pantry spices + chicken = magic!', '<p style=\"font-family: arial, sans-serif; -webkit-font-smoothing: antialiased; font-size: 17px; line-height: 30px; position: relative; color: rgb(0, 0, 0);\">\r\n  <strong style=\"font-family: nobel; font-weight: bold; -webkit-font-smoothing: antialiased; font-size: 19px;\">\r\n    This chicken shawarma is going to blow you away. Pantry spices + chicken = magic!\r\n  </strong>\r\n</p>\r\n<p style=\"font-family: arial, sans-serif; -webkit-font-smoothing: antialiased; font-size: 17px; line-height: 30px; position: relative; color: rgb(0, 0, 0);\">\r\n  <strong style=\"font-weight: bold; -webkit-font-smoothing: antialiased;\">\r\n    Shawarma is all the good things: crispy charred spiced meat wrapped up in a fluffy pita with fresh lettuce, juicy tomatoes, and crunchy cucumbers.&nbsp;\r\n  </strong>\r\n  It’s one of the best combinations on earth, especially at 2 in the morning. Heck, it’s one of the best combinations at any time of the day really. There’s a reason why humans have been grilling meat since the beginning of time and the deliciousness of shawarma is one of them.\r\n</p>\r\n<p style=\"font-family: arial, sans-serif; -webkit-font-smoothing: antialiased; font-size: 17px; line-height: 30px; position: relative; color: rgb(0, 0, 0);\">\r\n  <img src=\"/uploads/shawarma-8147w-2048x1366.webp\" class=\"img-fluid\">\r\n    </p>\r\n  <h2 style=\"font-family: nobel; -webkit-font-smoothing: antialiased; font-size: 30px; color: rgb(0, 0, 0);\">\r\n    What is shawarma?\r\n  </h2>\r\n  <p style=\"font-family: arial, sans-serif; -webkit-font-smoothing: antialiased; font-size: 17px; line-height: 30px; position: relative; color: rgb(0, 0, 0);\">\r\n    Shawarma as we know and love it, is a staple street food of the Middle East. Traditionally, shawarma refers to a Levantine way of preparing meat: thin cuts of marinated meat are stacked in a cone on vertical rotisserie and grilled. The word shawarma itself means “turning.”\r\n  </p>\r\n  <h2 style=\"font-family: nobel; -webkit-font-smoothing: antialiased; font-size: 30px; color: rgb(0, 0, 0);\">\r\n    How to make shawarma\r\n  </h2>\r\n  <p style=\"font-family: arial, sans-serif; -webkit-font-smoothing: antialiased; font-size: 17px; line-height: 30px; position: relative; color: rgb(0, 0, 0);\">\r\n    Shawarma can be made with lamb, beef, chicken, or turkey. In our case, we’re going to be using chicken thighs.\r\n  </p>\r\n  <div id=\"AdThrive_Content_1_desktop\" class=\"adthrive-ad adthrive-content adthrive-content-1 adthrive-ad-cls up-show\" data-google-query-id=\"CNPw_oLjl_kCFf3AOwIdAYgFOA\" style=\"font-family: arial, sans-serif; -webkit-font-smoothing: antialiased; margin-top: 10px; margin-bottom: 10px; text-align: center; overflow-x: visible; line-height: 0; min-height: 250px; align-items: center; display: flex; flex-wrap: wrap; justify-content: center; padding: 20px 0px 5px; background: rgb(246, 246, 246); position: relative; color: rgb(0, 0, 0); font-size: medium; clear: none !important;\">\r\n    <div id=\"google_ads_iframe_/18190176,22574751847/AdThrive_Content_1/59cbf9fd808bf74ea6d669a1_0__container__\" style=\"-webkit-font-smoothing: antialiased; flex-basis: 100%; border: 0pt none; display: block; height: 90px; position: relative; z-index: 0; margin: 0px auto; width: max-content !important;\">\r\n      <iframe frameborder=\"0\" src=\"https://3d64cca9d61c50eeae30e167db0bc53c.safeframe.googlesyndication.com/safeframe/1-0-38/html/container.html?upapi=true\" id=\"google_ads_iframe_/18190176,22574751847/AdThrive_Content_1/59cbf9fd808bf74ea6d669a1_0\" title=\"3rd party ad content\" name=\"\" scrolling=\"no\" marginwidth=\"0\" marginheight=\"0\" width=\"728\" height=\"90\" data-is-safeframe=\"true\" sandbox=\"allow-forms allow-popups allow-popups-to-escape-sandbox allow-same-origin allow-scripts allow-top-navigation-by-user-activation\" role=\"region\" aria-label=\"Advertisement\" tabindex=\"0\" data-google-container-id=\"5\" data-load-complete=\"true\" style=\"-webkit-font-smoothing: antialiased; border-width: 0px; border-style: initial; vertical-align: bottom; width: 728px !important;\">\r\n      </iframe>\r\n      <div class=\"upo-label\" style=\"-webkit-font-smoothing: antialiased; text-align: left; padding: 0px; margin: 0px; position: absolute; top: 0px; left: 0px; z-index: 10000; transition: opacity 1s ease-out 0s; opacity: 1; cursor: pointer;\">\r\n        <span style=\"font-family: sans-serif; font-weight: bold; -webkit-font-smoothing: antialiased; display: block; background: rgba(255, 255, 255, 0.7); height: fit-content; width: fit-content; top: 0px; left: 0px; color: rgb(68, 68, 68); font-size: 10px; line-height: normal; margin: 0px; padding: 6px; border-radius: 0px 0px 5px;\">\r\n          AD\r\n        </span>\r\n      </div>\r\n    </div>\r\n  </div>\r\n  <p style=\"font-family: arial, sans-serif; -webkit-font-smoothing: antialiased; font-size: 17px; line-height: 30px; position: relative; color: rgb(0, 0, 0);\">\r\n\r\n  </p>\r\n  <ol style=\"font-family: arial, sans-serif; -webkit-font-smoothing: antialiased; color: rgb(0, 0, 0); font-size: medium;\">\r\n    <li style=\"-webkit-font-smoothing: antialiased; font-size: 17px; line-height: 30px; padding-right: 60px; margin-bottom: 15px;\">\r\n      <strong style=\"font-weight: bold; -webkit-font-smoothing: antialiased;\">\r\n        Make a spice mix: I\r\n      </strong>\r\n      n a small bowl, mix together cumin, paprika, garlic powder, coriander, cardamom, ginger, turmeric, aleppo peppers, cinnamon, and ground cloves to make a spice mix.\r\n    </li>\r\n    <li style=\"-webkit-font-smoothing: antialiased; font-size: 17px; line-height: 30px; padding-right: 60px; margin-bottom: 15px;\">\r\n      <strong style=\"font-weight: bold; -webkit-font-smoothing: antialiased;\">\r\n        Marinate:\r\n      </strong>\r\n      &nbsp;Add the spice mix, along with olive oil and lemon juice to a bowl with the chicken thighs. Marinate for at least 2 hours.\r\n    </li>\r\n    <li style=\"-webkit-font-smoothing: antialiased; font-size: 17px; line-height: 30px; padding-right: 60px; margin-bottom: 15px;\">\r\n      <strong style=\"font-weight: bold; -webkit-font-smoothing: antialiased;\">\r\n        Cook the chicken:\r\n      </strong>\r\n      &nbsp;You can do this in the oven, on the stove, in the air fryer, or on the grill. When it’s done, let it rest, then slice.\r\n    </li>\r\n    <li style=\"-webkit-font-smoothing: antialiased; font-size: 17px; line-height: 30px; padding-right: 60px; margin-bottom: 15px;\">\r\n      <strong style=\"font-weight: bold; -webkit-font-smoothing: antialiased;\">\r\n        Serve:\r\n      </strong>\r\n      &nbsp;enjoy hot on a platter with shawarma sauce, salad, and a pita; or place everything in a pita and wrap it up, street food style.<img src=\"/uploads/shawarma-8151.webp\" class=\"img-fluid\"><h2 style=\"font-family: nobel; -webkit-font-smoothing: antialiased; font-size: 30px; color: rgb(0, 0, 0);\"><br></h2><h2 style=\"font-family: nobel; -webkit-font-smoothing: antialiased; font-size: 30px; color: rgb(0, 0, 0);\">Shawarma ingredients</h2><p style=\"-webkit-font-smoothing: antialiased; line-height: 30px; position: relative;\">Shawarma is all about the spice, so aside from chicken thighs, fresh lemon juice, and olive oil, you will need: cumin, paprika, garlic powder, ground coriander, ground cardamom, ground ginger, turmeric, aleppo pepper, cinnamon, and ground cloves.</p><div id=\"AdThrive_Content_2_desktop\" class=\"adthrive-ad adthrive-content adthrive-content-1 adthrive-ad-cls up-show\" data-google-query-id=\"CNTw_oLjl_kCFf3AOwIdAYgFOA\" style=\"-webkit-font-smoothing: antialiased; margin-top: 10px; margin-bottom: 10px; text-align: center; overflow-x: visible; line-height: 0; min-height: 250px; align-items: center; display: flex; flex-wrap: wrap; justify-content: center; padding: 20px 0px 5px; background: rgb(246, 246, 246); position: relative; font-size: medium; clear: none !important;\"><div id=\"google_ads_iframe_/18190176,22574751847/AdThrive_Content_2/59cbf9fd808bf74ea6d669a1_0__container__\" style=\"-webkit-font-smoothing: antialiased; flex-basis: 100%; border: 0pt none; display: block; height: 100px; position: relative; z-index: 0; margin: 0px auto; width: max-content !important;\"><iframe frameborder=\"0\" src=\"https://3d64cca9d61c50eeae30e167db0bc53c.safeframe.googlesyndication.com/safeframe/1-0-38/html/container.html?upapi=true\" id=\"google_ads_iframe_/18190176,22574751847/AdThrive_Content_2/59cbf9fd808bf74ea6d669a1_0\" title=\"3rd party ad content\" name=\"\" scrolling=\"no\" marginwidth=\"0\" marginheight=\"0\" width=\"320\" height=\"100\" data-is-safeframe=\"true\" sandbox=\"allow-forms allow-popups allow-popups-to-escape-sandbox allow-same-origin allow-scripts allow-top-navigation-by-user-activation\" role=\"region\" aria-label=\"Advertisement\" tabindex=\"0\" data-google-container-id=\"6\" data-load-complete=\"true\" style=\"-webkit-font-smoothing: antialiased; border-width: 0px; border-style: initial; vertical-align: bottom; width: 320px !important;\"></iframe><div class=\"upo-label\" style=\"-webkit-font-smoothing: antialiased; text-align: left; padding: 0px; margin: 0px; position: absolute; top: 0px; left: 0px; z-index: 10000; transition: opacity 1s ease-out 0s; opacity: 1; cursor: pointer;\"><span style=\"font-family: sans-serif; font-weight: bold; -webkit-font-smoothing: antialiased; display: block; background: rgba(255, 255, 255, 0.7); height: fit-content; width: fit-content; top: 0px; left: 0px; color: rgb(68, 68, 68); font-size: 10px; line-height: normal; margin: 0px; padding: 6px; border-radius: 0px 0px 5px;\">AD</span></div></div></div><ul style=\"-webkit-font-smoothing: antialiased; font-size: medium;\"><li style=\"-webkit-font-smoothing: antialiased; font-size: 17px; line-height: 30px; padding-right: 60px; margin-bottom: 15px;\"><strong style=\"font-weight: bold; -webkit-font-smoothing: antialiased;\">Aleppo pepper</strong>&nbsp;– These little dried pepper flakes are amazing. The aleppo pepper in this recipe is optional, so leave it out if you’re spice adverse. But if you’re adventurous, please give it a try. It’ll add just a hint of heat and so much deliciousness. They’re about as half as spicy as regular crushed red pepper flakes but so much more flavorful: earthy, with a fruity tang.</li></ul></li>\r\n        </ol>', '/img/posts/shawarma-8146.webp', 'Shawarma', 'This chicken shawarma is going to blow you away. Pantry spices + chicken = magic!', '', 1, 1, 'shawarma', '', '', 0, 0),
                                                                                                                                                                                                                               (5, 1, 1, 'Korean Corn Dog', 'Korean corn dogs are hot dogs coated in a batter, then deep fried and finished with sugar. They’re sweet and salty and completely delicious.', '<p style=\"font-family: arial, sans-serif; -webkit-font-smoothing: antialiased; font-size: 17px; line-height: 30px; position: relative; color: rgb(0, 0, 0);\">\r\n  <strong style=\"font-family: nobel; font-weight: bold; -webkit-font-smoothing: antialiased; font-size: 19px;\">\r\n    Is there anything more delicious or incredibly fun than a Korean corn dog?!\r\n  </strong>\r\n  &nbsp;The sweet and savory combination of the crispy outer batter and the stretchy cheese pulls – I’m addicted!\r\n</p>\r\n<p style=\"font-family: arial, sans-serif; -webkit-font-smoothing: antialiased; font-size: 17px; line-height: 30px; position: relative; color: rgb(0, 0, 0);\">\r\n  If you’ve watched any K-drama or are remotely interested in Korean culture, you’ve seen Korean corn dogs: beautifully fried, golden battered hot dogs with mozzarella on a stick, dusted with a sparkling sprinkle of sugar.\r\n</p>\r\n<p style=\"font-family: arial, sans-serif; -webkit-font-smoothing: antialiased; font-size: 17px; line-height: 30px; position: relative; color: rgb(0, 0, 0);\">\r\n  Korean corn dogs are everywhere street food is a thing and it’s not really surprising that they’re so popular. I had a Korean corn dog way back in the day when travel was still a thing, fresh from the fryer and it was glorious. The cheese was melty and the batter was crisp and savory. I’ve been missing travel like crazy and making Korean corn dogs at home is the next best thing so here we are.\r\n</p>\r\n<p style=\"font-family: arial, sans-serif; -webkit-font-smoothing: antialiased; font-size: 17px; line-height: 30px; position: relative; color: rgb(0, 0, 0);\">\r\n  <img src=\"/uploads/nagoya-1225.webp\" class=\"img-fluid\">\r\n    </p>\r\n  <h2 style=\"font-family: nobel; -webkit-font-smoothing: antialiased; font-size: 30px; color: rgb(0, 0, 0);\">\r\n    What is a Korean corn dog?\r\n  </h2>\r\n  <p style=\"font-family: arial, sans-serif; -webkit-font-smoothing: antialiased; font-size: 17px; line-height: 30px; position: relative; color: rgb(0, 0, 0);\">\r\n    Korean corn dogs are hot dogs, rice cakes, fish cakes, or mozzarella cheese coated in a batter (and sometimes panko, french fry pieces, or ramen) and deep fried. They’re finished with sugar and a signature squirt of your condiment of choice: ketchup, mayo, mustard, or all three. They’re sweet and salty and completely delicious.\r\n  </p>\r\n  <div id=\"AdThrive_Content_1_desktop\" class=\"adthrive-ad adthrive-content adthrive-content-1 adthrive-ad-cls up-show\" data-google-query-id=\"CK-n6Pjjl_kCFUy5mgodO4gDCg\" style=\"font-family: arial, sans-serif; -webkit-font-smoothing: antialiased; margin-top: 10px; margin-bottom: 10px; text-align: center; overflow-x: visible; line-height: 0; min-height: 250px; align-items: center; display: flex; flex-wrap: wrap; justify-content: center; padding: 20px 0px 5px; background: rgb(246, 246, 246); position: relative; color: rgb(0, 0, 0); font-size: medium; clear: none !important;\">\r\n    <div id=\"google_ads_iframe_/18190176,22574751847/AdThrive_Content_1/59cbf9fd808bf74ea6d669a1_0__container__\" style=\"-webkit-font-smoothing: antialiased; flex-basis: 100%; border: 0pt none; display: block; height: 100px; position: relative; z-index: 0; margin: 0px auto; width: max-content !important;\">\r\n      <iframe frameborder=\"0\" src=\"https://e5cbb17f44570b8c876c70126153e5c8.safeframe.googlesyndication.com/safeframe/1-0-38/html/container.html?upapi=true\" id=\"google_ads_iframe_/18190176,22574751847/AdThrive_Content_1/59cbf9fd808bf74ea6d669a1_0\" title=\"3rd party ad content\" name=\"\" scrolling=\"no\" marginwidth=\"0\" marginheight=\"0\" width=\"320\" height=\"100\" data-is-safeframe=\"true\" sandbox=\"allow-forms allow-popups allow-popups-to-escape-sandbox allow-same-origin allow-scripts allow-top-navigation-by-user-activation\" role=\"region\" aria-label=\"Advertisement\" tabindex=\"0\" data-google-container-id=\"5\" data-load-complete=\"true\" style=\"-webkit-font-smoothing: antialiased; border-width: 0px; border-style: initial; vertical-align: bottom; width: 320px !important;\">\r\n      </iframe>\r\n      <div class=\"upo-label\" style=\"-webkit-font-smoothing: antialiased; text-align: left; padding: 0px; margin: 0px; position: absolute; top: 0px; left: 0px; z-index: 10000; transition: opacity 1s ease-out 0s; opacity: 1; cursor: pointer;\">\r\n        <span style=\"font-family: sans-serif; font-weight: bold; -webkit-font-smoothing: antialiased; display: block; background: rgba(255, 255, 255, 0.7); height: fit-content; width: fit-content; top: 0px; left: 0px; color: rgb(68, 68, 68); font-size: 10px; line-height: normal; margin: 0px; padding: 6px; border-radius: 0px 0px 5px;\">\r\n          AD\r\n        </span>\r\n      </div>\r\n    </div>\r\n  </div>\r\n  <p style=\"font-family: arial, sans-serif; -webkit-font-smoothing: antialiased; font-size: 17px; line-height: 30px; position: relative; color: rgb(0, 0, 0);\">\r\n\r\n  </p>\r\n  <p style=\"font-family: arial, sans-serif; -webkit-font-smoothing: antialiased; font-size: 17px; line-height: 30px; position: relative; color: rgb(0, 0, 0);\">\r\n    Some Korean hotdogs are made with a yeasted batter and some are made with a rice flour batter. There are a lot of variations!\r\n  </p>\r\n  <p style=\"font-family: arial, sans-serif; -webkit-font-smoothing: antialiased; font-size: 17px; line-height: 30px; position: relative; color: rgb(0, 0, 0);\">\r\n    <img src=\"/uploads/korean-corn-dogs-3994.webp\" class=\"img-fluid\">\r\n      <br>\r\n        </p>\r\n      <h2 style=\"font-family: nobel; -webkit-font-smoothing: antialiased; font-size: 30px; color: rgb(0, 0, 0);\">\r\n        What makes Korean corn dogs different?\r\n      </h2>\r\n      <p style=\"font-family: arial, sans-serif; -webkit-font-smoothing: antialiased; font-size: 17px; line-height: 30px; position: relative; color: rgb(0, 0, 0);\">\r\n        There are a couple of differences between the corn dogs you know and Korean corn dogs. The main difference between corn dogs and Korean corn dogs lies in the batter.&nbsp;\r\n        <a href=\"https://iamafoodblog.com/mini-corn-dogs/\" style=\"-webkit-font-smoothing: antialiased; color: rgb(211, 35, 57);\">\r\n          American corn dogs are battered in a cornmeal batter\r\n        </a>\r\n        &nbsp;and Korean corn dogs are battered in a yeasted dough or a rice flour batter.\r\n      </p>\r\n      <p style=\"font-family: arial, sans-serif; -webkit-font-smoothing: antialiased; font-size: 17px; line-height: 30px; position: relative; color: rgb(0, 0, 0);\">\r\n        Korean corn dogs are also finished with a sprinkling of sugar. And last of all, Korean corn dogs don’t actually have to have hot dogs in them. There are plenty of Korean corn dogs that are just mozzarella cheese, fish cake, or rice cakes.\r\n      </p>\r\n      <p style=\"font-family: arial, sans-serif; -webkit-font-smoothing: antialiased; font-size: 17px; line-height: 30px; position: relative; color: rgb(0, 0, 0);\">\r\n        <img src=\"/uploads/korean-corn-dogs-3960.webp\" class=\"img-fluid\">\r\n          <br>\r\n            </p>\r\n', '/img/posts/korean-corn-dogs-3977w-2048x1366.webp', '', '', '', 1, 1, 'korean-corn-dog', '', '', 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `section`
--

CREATE TABLE `section` (
                           `id` int NOT NULL,
                           `label` varchar(32) NOT NULL,
                           `languageId` int NOT NULL,
                           `position` int NOT NULL DEFAULT '1',
                           `orderNumber` int NOT NULL DEFAULT '1',
                           `class` varchar(128) DEFAULT NULL,
                           `scrollTo` varchar(64) DEFAULT NULL,
                           `url` varchar(256) DEFAULT NULL,
                           `newTab` tinyint(1) NOT NULL DEFAULT '0',
                           `isActive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `section`
--

INSERT INTO `section` (`id`, `label`, `languageId`, `position`, `orderNumber`, `class`, `scrollTo`, `url`, `newTab`, `isActive`) VALUES
                                                                                                                                     (9, 'Login', 1, 1, 1, 'login-btn', '', '', 0, 1),
                                                                                                                                     (10, 'QPRTech', 1, 2, 1, '', '', '', 0, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `settings`
--

CREATE TABLE `settings` (
                            `id` int NOT NULL,
                            `label` varchar(64) NOT NULL,
                            `languageId` int NOT NULL,
                            `themeId` int DEFAULT NULL,
                            `siteName` varchar(64) NOT NULL,
                            `footerText` text,
                            `navAlign` varchar(32) NOT NULL DEFAULT '1',
                            `isActive` tinyint(1) NOT NULL DEFAULT '1',
                            `logo` varchar(128) NOT NULL,
                            `favicon` varchar(128) NOT NULL,
                            `languageEnabled` tinyint(1) NOT NULL DEFAULT '1',
                            `logoUrl` varchar(256) NOT NULL DEFAULT '/',
                            `logoWidth` int NOT NULL,
                            `email` varchar(64) NOT NULL,
                            `emailSender` varchar(128) NOT NULL,
                            `phone` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `settings`
--

INSERT INTO `settings` (`id`, `label`, `languageId`, `themeId`, `siteName`, `footerText`, `navAlign`, `isActive`, `logo`, `favicon`, `languageEnabled`, `logoUrl`, `logoWidth`, `email`, `emailSender`, `phone`) VALUES
    (1, 'Site settings', 1, 4, 'QPRTech', '<p>\r\n  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eget maximus justo, et suscipit tortor. Fusce pretium mauris id lectus sodales tincidunt. Morbi bibendum libero eros, in efficitur neque pellentesque a. Ut cursus, mauris sit amet mollis faucibus, elit odio blandit tortor, non dapibus lacus odio sit amet quam. Vestibulum eleifend odio a viverra laoreet. Fusce et quam a turpis lacinia varius. Quisque sed metus dui. Maecenas et velit eu dolor cursus venenatis a vitae ante. Nulla facilisi. Nulla facilisi. Quisque ac urna quis sem molestie blandit. Nulla justo est, iaculis eget est ac, pulvinar tempor diam. Nam feugiat dui sed ante gravida lacinia. Nunc eleifend justo non arcu lobortis, ut aliquet lacus molestie.\r\n    </p>', 'flex-end', 1, '/logo.png', '/favicon-32x32.png', 0, '/', 150, 'avastik777@gmail.com', 'contact@qpr.technology', '+4412345678910');

-- --------------------------------------------------------

--
-- Структура таблицы `socials`
--

CREATE TABLE `socials` (
                           `id` int NOT NULL,
                           `icon` varchar(32) NOT NULL,
                           `link` varchar(128) NOT NULL,
                           `languageId` int NOT NULL,
                           `isActive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `socials`
--

INSERT INTO `socials` (`id`, `icon`, `link`, `languageId`, `isActive`) VALUES
    (2, 'github', 'https://gihub.com', 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `themes`
--

CREATE TABLE `themes` (
                          `id` int NOT NULL,
                          `label` varchar(64) NOT NULL,
                          `jsFile` varchar(128) NOT NULL,
                          `cssFile` varchar(128) NOT NULL,
                          `navbarColor` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8_general_ci NOT NULL DEFAULT 'bg-dark',
                          `isActive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `themes`
--

INSERT INTO `themes` (`id`, `label`, `jsFile`, `cssFile`, `navbarColor`, `isActive`) VALUES
                                                                                         (2, 'Creative', '/themes/creative/scripts.js', '/themes/creative/styles.css', 'bg-dark navbar-dark', 1),
                                                                                         (3, 'Grayscale', '/themes/grayscale/scripts.js', '/themes/grayscale/styles.css', 'bg-dark', 1),
                                                                                         (4, 'Freelancer', '/themes/freelancer/scripts.js', '/themes/freelancer/styles.css', 'bg-light navbar-light', 1),
                                                                                         (7, 'Agency', '/themes/agency/scripts.js', '/themes/agency/styles.css', 'bg-dark', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
                         `id` int NOT NULL,
                         `username` varchar(128) NOT NULL,
                         `email` varchar(128) NOT NULL,
                         `password` varchar(256) NOT NULL,
                         `authKey` varchar(256) NOT NULL,
                         `accessToken` varchar(128) NOT NULL,
                         `isAdmin` tinyint(1) NOT NULL,
                         `firstName` varchar(64) NOT NULL,
                         `lastName` varchar(64) NOT NULL,
                         `avatar` varchar(128) CHARACTER SET utf8mb3 COLLATE utf8_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `authKey`, `accessToken`, `isAdmin`, `firstName`, `lastName`, `avatar`) VALUES
    (1, 'admin@example.com', 'admin@example.com', '5018b9b92fa0ccdc17f12c901099be9e4936ac87677b2c85586c9757f9774657', 'fce75604826b2dfaa7f24ebfe559368d', '77e3da81e2512a6fcdd1827a7964de04d339f9ebb98a2d14b37c712cea0b256f', 1, 'Test', 'Admin', '/img/users/ava.jpg');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `contact`
--
ALTER TABLE `contact`
    ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `language`
--
ALTER TABLE `language`
    ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `page`
--
ALTER TABLE `page`
    ADD PRIMARY KEY (`id`),
  ADD KEY `languageId` (`sectionId`),
  ADD KEY `languageId_2` (`languageId`);

--
-- Индексы таблицы `post`
--
ALTER TABLE `post`
    ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `section`
--
ALTER TABLE `section`
    ADD PRIMARY KEY (`id`),
  ADD KEY `languageId` (`languageId`);

--
-- Индексы таблицы `settings`
--
ALTER TABLE `settings`
    ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `socials`
--
ALTER TABLE `socials`
    ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `themes`
--
ALTER TABLE `themes`
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
-- AUTO_INCREMENT для таблицы `contact`
--
ALTER TABLE `contact`
    MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `language`
--
ALTER TABLE `language`
    MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `page`
--
ALTER TABLE `page`
    MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `post`
--
ALTER TABLE `post`
    MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `section`
--
ALTER TABLE `section`
    MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `settings`
--
ALTER TABLE `settings`
    MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `socials`
--
ALTER TABLE `socials`
    MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `themes`
--
ALTER TABLE `themes`
    MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
    MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `section`
--
ALTER TABLE `section`
    ADD CONSTRAINT `section_ibfk_1` FOREIGN KEY (`languageId`) REFERENCES `language` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;