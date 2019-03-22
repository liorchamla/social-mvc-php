-- MySQL dump 10.13  Distrib 5.7.25, for Linux (x86_64)
--
-- Host: localhost    Database: social
-- ------------------------------------------------------
-- Server version	5.7.25-0ubuntu0.16.04.2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `createdAt` datetime NOT NULL,
  `content` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,'2019-02-07 18:29:58','Eos sunt deserunt odio et et quisquam.',3,1),(2,'2019-02-24 12:22:17','Est vel ducimus rerum molestiae fuga voluptatem.',4,1),(3,'2019-02-27 18:33:04','Aut facilis ex harum.',4,1),(4,'2019-02-24 02:19:46','Illum molestiae nam omnis ipsum.',5,1),(5,'2019-02-19 23:30:38','Mollitia ea esse esse velit inventore doloremque perspiciatis.',4,2),(6,'2019-02-19 14:45:14','Occaecati ut temporibus nisi aspernatur sed.',4,2),(7,'2019-02-22 01:28:38','Aspernatur molestias necessitatibus ipsum commodi labore incidunt qui.',1,2),(8,'2019-02-12 12:43:01','Est consequuntur qui nemo qui ut vitae.',3,2),(9,'2019-02-13 20:20:32','Illo libero vitae sunt magni hic.',4,3),(10,'2019-02-27 07:52:41','Odio porro provident perspiciatis non debitis qui quas.',1,3),(11,'2019-02-14 11:25:14','Ducimus molestiae vero in.',4,4),(12,'2019-02-25 10:19:58','Aut accusantium odio omnis.',3,4),(13,'2019-03-05 08:58:33','Nostrum molestiae eos iste reiciendis.',5,5),(14,'2019-02-21 23:18:21','Perferendis sit non earum aperiam nulla harum.',5,5),(15,'2019-03-04 23:17:42','Ipsa id accusamus fugit eos vel aperiam deleniti cupiditate.',3,5),(16,'2019-02-26 23:22:07','Ut natus quas unde eos.',3,5),(17,'2019-02-21 12:18:07','Qui ad blanditiis quia autem sint numquam sunt.',4,5),(18,'2019-02-21 23:51:52','Ipsa fugit ducimus quo eius quaerat.',5,5),(19,'2019-02-20 04:53:11','Voluptas est nulla recusandae laudantium.',3,6),(20,'2019-02-11 22:48:23','Soluta modi aliquid et cupiditate.',2,6),(21,'2019-02-24 19:39:44','Voluptas magnam et a nihil.',3,6),(22,'2019-03-03 13:02:53','Sit ut odio numquam placeat fugit tempora.',4,6),(23,'2019-03-04 13:31:33','Ullam itaque ad corrupti impedit vel illum.',3,6),(24,'2019-02-11 08:48:00','Deserunt et ullam nostrum excepturi quia sed non.',1,6),(25,'2019-02-08 05:11:56','Rem pariatur architecto ut tenetur ea dolor sit vel.',4,6),(26,'2019-02-16 03:51:42','Tempore corrupti quasi ipsam.',1,7),(27,'2019-02-15 00:30:45','Eveniet aspernatur dignissimos quod quibusdam.',1,7),(28,'2019-03-03 10:53:35','Fugit magni ut vitae qui qui facere tempore cum.',2,7),(29,'2019-02-10 18:47:09','Asperiores ut sed non nesciunt quia.',3,7),(30,'2019-02-15 03:19:11','Eum facilis nisi odit in dignissimos at sunt voluptas.',5,7),(31,'2019-02-20 12:19:02','Eaque animi autem eum culpa quasi est aut.',5,7),(32,'2019-02-20 20:57:11','Ipsa et dolorum nostrum qui sint.',4,8),(33,'2019-02-07 13:19:52','Incidunt doloremque deserunt possimus.',5,8),(34,'2019-02-14 06:08:00','Minima atque deleniti magnam dolor soluta.',5,9),(35,'2019-02-11 07:31:07','Velit corporis deleniti qui esse minus.',1,9),(36,'2019-02-24 07:42:39','Vitae deserunt dolore quibusdam.',1,9),(37,'2019-02-13 02:48:58','Iste provident eligendi perferendis.',2,9),(38,'2019-02-17 04:46:31','Impedit voluptatem nulla id et consequatur.',5,9),(39,'2019-02-25 18:58:07','Inventore ex architecto ea veritatis ea.',3,10),(40,'2019-02-14 11:02:32','Quia et quo officia assumenda.',4,10),(41,'2019-02-08 08:10:40','Eligendi aliquid veniam omnis velit temporibus nostrum.',3,10),(42,'2019-02-25 13:15:42','Ut in sunt dolor facere quia vero officia.',4,11),(43,'2019-02-13 04:02:23','Consequatur ipsa voluptatem non nesciunt facilis sunt nihil.',2,11),(44,'2019-02-25 03:34:42','Sed dolores et quo et voluptatem provident.',5,11),(45,'2019-03-04 13:39:15','Autem dolor omnis error placeat quis.',4,11),(46,'2019-02-26 00:33:22','Dicta sed eveniet tempore nihil quae a sed reiciendis.',4,12),(47,'2019-02-09 06:55:49','Quo quasi magni omnis omnis sunt qui.',4,12),(48,'2019-02-19 22:45:08','Quia perferendis dolorem aut qui quaerat.',4,12),(49,'2019-03-03 07:51:31','Magnam iure molestiae dolorem minima amet.',3,13),(50,'2019-03-01 23:46:07','Nisi vel nemo omnis in qui.',4,13),(51,'2019-02-11 14:27:44','Incidunt illum sunt quidem molestiae aut et dolor.',3,13),(52,'2019-02-18 19:48:33','Blanditiis facilis et minus sint vel ea.',2,13),(53,'2019-02-12 20:30:00','Ut distinctio libero nemo nobis fugit nisi ex.',3,13),(54,'2019-02-17 09:25:45','Optio enim laboriosam non velit.',4,13),(55,'2019-02-24 11:33:09','Alias minus sint voluptas vero repudiandae placeat qui quaerat.',1,14),(56,'2019-02-06 23:07:43','Laudantium odit nostrum eos unde veritatis quia ipsum.',5,14),(57,'2019-02-06 17:37:02','Deleniti sequi ut est.',1,14),(58,'2019-03-07 16:16:06','Kikoo !',7,15),(59,'2019-03-08 15:18:20','Salut les amis',7,16),(60,'2019-03-08 15:24:17','Encore un commentaire',7,16),(61,'2019-03-12 14:56:44','Un test',7,18),(62,'2019-03-12 14:57:29','Un test',7,18),(63,'2019-03-12 15:02:25','TEEEST',7,18);
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `createdAt` datetime NOT NULL,
  `content` text NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_USERS` (`user_id`),
  CONSTRAINT `status_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status`
--

LOCK TABLES `status` WRITE;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
INSERT INTO `status` VALUES (1,'2018-10-05 06:51:27','I\'ve tried to fancy to herself how she would have done that, you know,\' said Alice doubtfully: \'it means--to--make--anything--prettier.\' \'Well, then,\' the Cat said, waving its tail about in the pool.',1),(2,'2018-10-24 16:15:23','Gryphon as if he had never done such a thing before, but she could have been that,\' said the King added in a very difficult question. However, at last turned sulky, and would only say, \'I am older.',1),(3,'2018-10-14 14:31:05','Queen was to eat or drink something or other; but the wise little Alice herself, and once she remembered how small she was now about a whiting before.\' \'I can tell you his history,\' As they walked.',2),(4,'2019-02-03 23:00:17','Footman remarked, \'till tomorrow--\' At this moment the King, and the pool of tears which she had quite a commotion in the last words out loud, and the poor little Lizard, Bill, was in confusion.',2),(5,'2019-01-27 22:20:18','Mouse had changed his mind, and was in confusion, getting the Dormouse crossed the court, without even waiting to put the hookah out of the lefthand bit. * * * * * * * * * * * * * * * \'What a.',2),(6,'2018-12-06 06:44:56','WOULD put their heads down! I am now? That\'ll be a person of authority over Alice. \'Stand up and say \"How doth the little golden key and hurried off at once, she found she could do, lying down on.',3),(7,'2018-12-08 06:53:13','Alice felt a very interesting dance to watch,\' said Alice, swallowing down her flamingo, and began staring at the stick, and made believe to worry it; then Alice, thinking it was her turn or not. So.',3),(8,'2019-01-11 09:31:22','And argued each case with MINE,\' said the Gryphon. \'The reason is,\' said the March Hare: she thought of herself, \'I don\'t think--\' \'Then you shouldn\'t talk,\' said the Pigeon the opportunity of.',3),(9,'2018-12-22 09:24:43','Bill, the Lizard) could not help bursting out laughing: and when she found that it was empty: she did not feel encouraged to ask them what the name of the words \'DRINK ME,\' but nevertheless she.',4),(10,'2018-12-10 02:45:21','Alice, and looking at it gloomily: then he dipped it into his plate. Alice did not quite know what you had been looking over their heads. She felt very lonely and low-spirited. In a little animal.',4),(11,'2018-09-30 14:47:03','Hatter trembled so, that he had never heard before, \'Sure then I\'m here! Digging for apples, yer honour!\' (He pronounced it \'arrum.\') \'An arm, you goose! Who ever saw in another moment down went.',4),(12,'2018-11-12 00:31:16','I\'m NOT a serpent!\' said Alice timidly. \'Would you like the name: however, it only grinned a little shriek and a scroll of parchment in the last few minutes that she remained the same words as.',4),(13,'2019-02-11 22:19:13','ONE respectable person!\' Soon her eye fell on a bough of a well?\' The Dormouse shook itself, and was coming to, but it had made. \'He took me for a minute or two, and the Queen\'s shrill cries to the.',4),(14,'2018-09-25 08:48:57','I should be raving mad--at least not so mad as it went, \'One side of the song, \'I\'d have said to the table to measure herself by it, and then she had not noticed before, and he wasn\'t one?\' Alice.',5),(15,'2019-03-06 17:00:12','Je suis si beau que le matin je m&#39;ébloui (de ouf) !!',7),(16,'2019-03-08 15:17:33','Je viens de faire mon premier kikoo',7),(17,'2019-03-08 16:42:10','Nouveau statut !',7),(18,'2019-03-12 14:56:39','Un test de status 2',7);
/*!40000 ALTER TABLE `status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `avatar` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Neoma','O\'Conner','dayna43@wisoky.org','$2y$10$mOcSV.c8lprZnRH8GX4jMOXT51Ez4kQWA9c9kjAmfrAX/FBGmT4TC','Reprehenderit ab est voluptatibus facilis et voluptatum. Corrupti et debitis esse quo.','https://randomuser.me/api/portraits/women/0.jpg'),(2,'Rickey','Sipes','thelma17@gmail.com','$2y$10$38kM7eR..1GYcz5tO53fJe/5hGvdHx5XEqZBWXq7TA/ztFbcHiP.6','Quidem quidem enim molestiae veritatis. Eveniet voluptate eum dolor nesciunt itaque magnam dolorem. Reprehenderit quia nihil quo et et. Rerum magnam tenetur reiciendis nemo officia.','https://randomuser.me/api/portraits/men/1.jpg'),(3,'Tyree','Wehner','brionna16@hayes.org','$2y$10$XyHHkRicXzWiyC3lB4OLH.qC5ufJ7knlTOnw8yTbA/HezUUZph1NK','Sapiente voluptatem et qui ut velit et et. Explicabo est accusantium officiis incidunt sed. Occaecati autem sit qui deleniti sequi. Ut a eligendi sint accusantium.','https://randomuser.me/api/portraits/men/2.jpg'),(4,'Zakary','Block','kirlin.torey@hotmail.com','$2y$10$nw5I1lwMda80tLjv4aTXWeqgUg0OLUyOYco03ZWjwJpjHSzIvRN7i','Laudantium aliquam dolorem maiores accusamus animi hic quam unde. Dolores aut libero in voluptas accusantium commodi dolor.','https://randomuser.me/api/portraits/men/3.jpg'),(5,'Krystel','Muller','damaris87@schroeder.com','$2y$10$bNzkUTdP75PPh5segWaSO.ht1XjUOzyM..bFxTeZlZmuR9A9KmjuO','Fugiat quod at soluta aut. Quia commodi occaecati sit non aut dolores corrupti. Rerum fugit quaerat id id molestias.','https://randomuser.me/api/portraits/women/4.jpg'),(7,'Lior','Chamla','lior@3wa.fr','$2y$10$g2F25IrAcClnFpO/O2Tj7OQBZAaFCIhaNn7xjPS1qdqVKgy7a9Msu','Très bon formateur, à n&#39;en point douter','http://avatars.io/twitter/LiiorC');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-03-22 11:56:30
