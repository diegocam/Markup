CREATE TABLE IF NOT EXISTS `rules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_name` varchar(25) NOT NULL,
  `points` int(11) NOT NULL,
  PRIMARY KEY (`id`)
);

INSERT INTO `rules` (`id`, `tag_name`, `points`) VALUES
(1, 'div', 3),
(2, 'p', 1),
(3, 'h1', 3),
(4, 'h2', 0),
(5, 'html', 5),
(6, 'body', 5),
(7, 'header', 10),
(8, 'footer', 10),
(9, 'font', -1),
(10, 'center', -2),
(11, 'big', -2),
(12, 'strike', -1),
(13, 'tt', -2),
(14, 'frameset', -5),
(15, 'frame', -5);
