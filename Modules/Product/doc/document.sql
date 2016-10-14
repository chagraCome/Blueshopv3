-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 15. Nov 2012 um 14:03
-- Server Version: 5.5.8
-- PHP-Version: 5.3.5

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT=0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `amhshoppro`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `document`
--

DROP TABLE IF EXISTS `document`;
CREATE TABLE IF NOT EXISTS `document` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `folder` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `extention` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hash` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `public` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=172 ;

--
-- Daten für Tabelle `document`
--

INSERT INTO `document` (`id`, `name`, `folder`, `type`, `extention`, `hash`, `public`) VALUES
(1, 'Porject Plan UML', 'storage', 'Document', 'pdf', NULL, 1),
(3, 'MY Document Name1', 'project1', 'PDF1', 'txt', '0dedcaaa4e4795ecba97434c9ad5affb', 1),
(4, 'MY Document Name1', 'project1', 'PDF1', 'txt', '076dfa720ba1c4ddb93aa681eb271f22', 1),
(5, 'MY Document Name1', 'project1', 'PDF1', 'txt', 'af6d11657eda7078db847427ec94a39d', 1),
(6, 'MY Document Name1', 'project1', 'PDF1', 'txt', '029cbfc2ea0ab58c70335360d50a89e6', 1),
(7, 'MY Document Name1', 'project1', 'PDF1', 'txt', '60e9dc659771b37fe5049b0f3023ad73', 1),
(8, 'MY Document Name1', 'project1', 'PDF1', 'txt', 'cbb1a8ee6babf38921635d578899611f', 1),
(9, 'MY Document Name1', 'project1', 'PDF1', 'txt', 'e00f227df7c7b997cd614605974cd7a0', 1),
(10, 'MY Document Name1', 'project1', 'PDF1', 'txt', '9753c3109271b6aeb5e04462d02a18fe', 1),
(11, 'MY Document Name1', 'project1', 'PDF1', 'txt', 'cd951e910ae791af29f893d3b3a36f83', 1),
(12, 'MY Document Name1', 'project1', 'PDF1', 'txt', '7525a6eeac87e626f9d6bc8d1df915e8', 1),
(13, 'MY Document Name1', 'project1', 'PDF1', 'txt', '144f9e34c6f4412af4489de2d1d3419f', 1),
(14, 'MY Document Name1', 'project1', 'PDF1', 'txt', 'adeafe80c5a633595e7da23cc7412686', 1),
(15, 'MY Document Name1', 'project1', 'PDF1', 'txt', 'c35f8fc9570b274e7254256c3ce1b774', 1),
(16, 'MY Document Name1', 'project1', 'PDF1', 'txt', 'e50788b1165244b60f54bf0090043f80', 1),
(17, 'MY Document Name1', 'project1', 'PDF1', 'txt', '671c424bf2d604556ccd76c94cf522b9', 1),
(18, 'uml', 'storage', 'Document', 'pdf', NULL, 1),
(19, 'MY Document Name1', 'project1', 'PDF1', 'txt', '11f2a62511c8d2ea6a9cfa982a6609af', 1),
(20, '1asdasdasd', 'storage', 'Document', 'pdf', NULL, 1),
(21, 'MY Document Name1', 'project1', 'PDF1', 'txt', 'a2ad4e880e984e7a4bb4835cd816a0d1', 1),
(22, 'MY Document Name1', 'project1', 'PDF1', 'txt', 'b262b69d0afe08fd696677ff454389fb', 1),
(23, '65656565', 'storage', 'Document', 'pdf', NULL, 1),
(24, 'asdadad', 'storage/ticket', 'Document', 'pdf', NULL, 1),
(25, 'MY Document Name1', 'project1', 'PDF1', 'txt', '3856d1cb44f0699c6cd51c8dd19004f5', 1),
(26, 'MY Document Name1', 'project1', 'PDF1', 'txt', 'fba6bbd50792ec4a1f1bfc450c25d0ec', 1),
(27, 'MY Document Name1', 'project1', 'PDF1', 'txt', 'd059ff9644208710045aae10fac3fbbe', 1),
(28, 'MY Document Name1', 'project1', 'PDF1', 'txt', '5497497a267cbbacc2f916c77aa10215', 1),
(29, 'MY Document Name1', 'project1', 'PDF1', 'txt', '4184ae547e488898321f25ed33e46243', 1),
(30, 'MY Document Name1', 'project1', 'PDF1', 'txt', 'cab4e46d8069a62a3e5412673b78a1a0', 1),
(31, 'MY Document Name1', 'project1', 'PDF1', 'txt', 'b146b57300998cc4788b7e3b2731dd39', 1),
(32, 'MY Document Name1', 'project1', 'PDF1', 'txt', 'bd64ce63c9788e3c0e129e500fef04dd', 1),
(33, 'MY Document Name1', 'project1', 'PDF1', 'txt', '73ffa81ffc0b95d87d730064d1def898', 1),
(34, 'MY Document Name1', 'project1', 'PDF1', 'txt', 'cd4eb79a5c02bf9b7a6394c8cc7dd981', 1),
(35, 'MY Document Name1', 'project1', 'PDF1', 'txt', '0fad611efa2b9f5b27223c90937c7ac1', 1),
(36, 'MY Document Name1', 'project1', 'PDF1', 'txt', 'b82aa2afee0237925f4d5955b475ed7f', 1),
(37, 'MY Document Name1', 'project1', 'PDF1', 'txt', 'a7e450dcdc46c7df68b0b248b88400c7', 1),
(38, 'MY Document Name1', 'project1', 'PDF1', 'txt', '999095acd871f834636eab0924fc6082', 1),
(39, 'MY Document Name1', 'project1', 'PDF1', 'txt', 'a59bcc167eda10ba531afd88f11c753b', 1),
(40, 'MY Document Name1', 'project1', 'PDF1', 'txt', '40d9db3dcf726505dc725ed3443188eb', 1),
(41, 'MY Document Name1', 'project1', 'PDF1', 'txt', '3f5aa161b3f9dcfa96f6fb69887cc707', 1),
(42, 'MY Document Name1', 'project1', 'PDF1', 'txt', '534a560e8d5faea4ef574667c5986c83', 1),
(43, 'MY Document Name1', 'project1', 'PDF1', 'txt', '871f1a309a820d228b15c9eac8bd6215', 1),
(44, 'MY Document Name1', 'project1', 'PDF1', 'txt', 'ce0f3a4c3c1b22e85c66371a71f83444', 1),
(45, 'MY Document Name1', 'project1', 'PDF1', 'txt', '9c31e2e0cd36e89b80550a8f45438dc7', 1),
(46, 'MY Document Name1', 'project1', 'PDF1', 'txt', '53ed72d31c411e106f5ea123eed741e7', 1),
(47, 'MY Document Name1', 'project1', 'PDF1', 'txt', 'ec2a22d2c5092f2889c04edb33349b7c', 1),
(48, 'MY Document Name1', 'project1', 'PDF1', 'txt', '9c08a45b71153dc858f490b973d73c85', 1),
(49, 'MY Document Name1', 'project1', 'PDF1', 'txt', 'e948de3dfeac66393d7c8b65b09ebf4c', 1),
(50, 'MY Document Name1', 'project1', 'PDF1', 'txt', '0668af8b714394ea9cdc723ff4e9951e', 1),
(51, 'MY Document Name1', 'project1', 'PDF1', 'txt', 'c03db5d483a33b0022ec322b7d8b651f', 1),
(52, 'MY Document Name1', 'project1', 'PDF1', 'txt', 'ff977c960e30d059ec4d8951d60ec555', 1),
(53, 'MY Document Name1', 'project1', 'PDF1', 'txt', '2997dc0185e504161b24737f081ab1cb', 1),
(54, 'MY Document Name1', 'project1', 'PDF1', 'txt', '13a4151ae5818d8716af255f2d17a5ff', 1),
(55, 'MY Document Name1', 'project1', 'PDF1', 'txt', '8cf5053d6e669007f3624c96b7019d14', 1),
(56, 'MY Document Name1', 'project1', 'PDF1', 'txt', 'f126d898d4c670b40f3359c0454f7ea7', 1),
(57, 'MY Document Name1', 'project1', 'PDF1', 'txt', 'af7bbe5590ae666a8dea78b41979ac93', 1),
(58, 'MY Document Name1', 'project1', 'PDF1', 'txt', 'd98bdfd3b3d1fcef374febd03c373cc0', 1),
(59, 'MY Document Name1', 'project1', 'PDF1', 'txt', '55a3efd8abbfcc0144fe78d649a81dab', 1),
(60, 'MY Document Name1', 'project1', 'PDF1', 'txt', '2b0d3055fcc720113e7b2dbd81bf64a3', 1),
(61, 'MY Document Name1', 'project1', 'PDF1', 'txt', '176d7b6990ecd205e23e2f6a9bf54f09', 1),
(62, 'MY Document Name1', 'project1', 'PDF1', 'txt', 'a788a17356c13d3b7c536ff0733f0b91', 1),
(63, 'MY Document Name1', 'project1', 'PDF1', 'txt', '78672b19d5ff15e7498a9d24128267d8', 1),
(64, 'MY Document Name1', 'project1', 'PDF1', 'txt', 'bf4c04212ca083c51316ade37b1172ad', 1),
(65, 'MY Document Name1', 'project1', 'PDF1', 'txt', '14f66a76174121fe5271dd39e3774334', 1),
(66, 'MY Document Name1', 'project1', 'PDF1', 'txt', 'b7189847be196db7bbb7d15ef7119a03', 1),
(67, 'MY Document Name1', 'project1', 'PDF1', 'txt', '1a4b11f56d95acced2c57025fbc92423', 1),
(68, 'MY Document Name1', 'project1', 'PDF1', 'txt', '65a4827c3f20041dbb5937278a108f27', 1),
(69, 'MY Document Name1', 'project1', 'PDF1', 'txt', 'b33ca05a6a2b4e97fb9cfc71dcb952e5', 1),
(70, 'MY Document Name1', 'project1', 'PDF1', 'txt', '15d8fe5ec77e7c56da18eae5364af67e', 1),
(71, 'MY Document Name1', 'project1', 'PDF1', 'txt', '878beee577c30278cfc772b7490fd0df', 1),
(72, 'MY Document Name1', 'project1', 'PDF1', 'txt', '57e7cec73977899eeb8f840557e3e88c', 1),
(73, 'MY Document Name1', 'project1', 'PDF1', 'txt', '7335776a55ac85fd5240b50c02afaac0', 1),
(74, 'MY Document Name1', 'project1', 'PDF1', 'txt', 'fc8be3b459900e94e53179c04e0343bc', 1),
(75, 'MY Document Name1', 'project1', 'PDF1', 'txt', 'cd7072fe5ef349c330c8326d974a66fa', 1),
(76, 'MY Document Name1', 'project1', 'PDF1', 'txt', 'f544dce5a39f8f7e5371af8e281d107f', 1),
(77, 'MY Document Name1', 'project1', 'PDF1', 'txt', '220d3710f26da597fee6ba6a544c772e', 1),
(78, 'MY Document Name1', 'project1', 'PDF1', 'txt', 'd1b6d4eea93fc615d390563811c0ddb9', 1),
(79, 'MY Document Name1', 'project1', 'PDF1', 'txt', 'f52b62b7aba4017344108f4f03876235', 1),
(80, 'MY Document Name1', 'project1', 'PDF1', 'txt', 'fbba6944f9abcab0b99f2f38d7285266', 1),
(81, 'MY Document Name1', 'project1', 'PDF1', 'txt', 'c7206f58d1f318566624bffd0941d53c', 1),
(82, 'MY Document Name1', 'project1', 'PDF1', 'txt', '2bf3066fe35d43f14d3e632f49010806', 1),
(83, 'MY Document Name1', 'project1', 'PDF1', 'txt', '9ace514c93ace62ba505288349efda70', 1),
(84, 'MY Document Name1', 'project1', 'PDF1', 'txt', 'e2fbef5c206b0ec06544d37d02180089', 1),
(85, 'MY Document Name1', 'project1', 'PDF1', 'txt', '2614f5bb9cbdbc0a752cfb6aac15ff12', 1),
(86, 'MY Document Name1', 'project1', 'PDF1', 'txt', '8ac02ae56d089b042ad636489b65003e', 1),
(87, 'MY Document Name1', 'project1', 'PDF1', 'txt', '39e5187de2f4695948fdc8610ad023f5', 1),
(88, 'MY Document Name1', 'project1', 'PDF1', 'txt', '7c85ae79af18d3aff54d9e0acbf5c15f', 1),
(89, 'MY Document Name1', 'project1', 'PDF1', 'txt', '4d1461652991dbcdb31cb4888739201f', 1),
(90, 'MY Document Name1', 'project1', 'PDF1', 'txt', '559fe93ac697ffb94f1ed00705f8998d', 1),
(91, 'MY Document Name1', 'project1', 'PDF1', 'txt', '02a6dddcb6fec5ccd6b6a7545a58cfc4', 1),
(92, 'MY Document Name1', 'project1', 'PDF1', 'txt', 'f7cda94454ddf04f606e9500e793aedd', 1),
(93, 'MY Document Name1', 'project1', 'PDF1', 'txt', '064f5a444abaf6ef2a1ca86e34fa46c2', 1),
(94, 'MY Document Name1', 'project1', 'PDF1', 'txt', '034f1d90ddc036780c0b5309e2997b9b', 1),
(95, 'Draft Template', 'storage', 'Image', 'png', NULL, 1),
(96, 'Draft Template', 'storage', 'Image', 'png', NULL, 1),
(97, 'MY Document Name1', 'project1', 'PDF1', 'txt', '3b57763b5a30666e906857adffb37567', 1),
(98, 'MY Document Name1', 'project1', 'PDF1', 'txt', '2087836620c6b809b0b698f01e598ada', 1),
(99, 'MY Document Name1', 'project1', 'PDF1', 'txt', '77696b442e1e327e0fc1c8883399b359', 1),
(100, 'MY Document Name1', 'project1', 'PDF1', 'txt', 'cfa0cb7a6bff946ebabec713e7ac5a79', 1),
(101, 'MY Document Name1', 'project1', 'PDF1', 'txt', 'd2f862b829cbd4964d1df51037247102', 1),
(102, 'MY Document Name1', 'project1', 'PDF1', 'txt', '6deee7876b166fa89ff4609435e8abd4', 1),
(103, 'MY Document Name1', 'project1', 'PDF1', 'txt', 'c8e9e1c321b5ebccbb1647d85401b31f', 1),
(104, 'MY Document Name1', 'project1', 'PDF1', 'txt', '8f642ee04cc4acaf6bc89208ded870e7', 1),
(105, 'MY Document Name1', 'project1', 'PDF1', 'txt', '82a223e34206c00e9fc45b84b5b81f3d', 1),
(106, 'MY Document Name1', 'project1', 'PDF1', 'txt', '469a394e44eb9d661cdbe392214ce684', 1),
(107, 'MY Document Name1', 'project1', 'PDF1', 'txt', 'bdd8673173bed6966195e657a948558f', 1),
(108, 'template design', 'storage', 'Image', 'png', NULL, 1),
(109, 'Planuing', 'storage', 'Document', 'docx', NULL, 1),
(110, 'MY Document Name1', 'project1', 'PDF1', 'txt', '434382cacd50383e65fe24c4ee503928', 1),
(111, 'MY Document Name1', 'project1', 'PDF1', 'txt', '48e9d33743198bd15d02efed415eba7a', 1),
(112, 'MY Document Name1', 'project1', 'PDF1', 'txt', '88599d90ca7954a03f8327bc5b5e022c', 1),
(113, 'MY Document Name1', 'project1', 'PDF1', 'txt', 'dfcf296e51adef7780e482f7f8af149f', 1),
(114, 'MY Document Name1', 'project1', 'PDF1', 'txt', '41e7fd3098f2a5bc31a4c94a70dafe79', 1),
(115, 'asdasd', 'storage/product/docs', 'Document', 'pdf', NULL, 1),
(116, 'doc', 'storage/product/docs', 'Document', 'pdf', NULL, 1),
(117, 'asdasd', 'storage/projects', 'Document', 'sql', NULL, 1),
(118, 'asdasasdas', 'storage/projects/task', 'Document', 'sql', NULL, 1),
(119, 'MY Document Name1', 'project1', 'PDF1', 'txt', 'cd22d12e3fe1635424150debd7c52749', 1),
(120, 'MY Document Name1', 'project1', 'PDF1', 'txt', 'ef16401fdb876452a478539d0e5690a5', 1),
(121, 'MY Document Name1', 'project1', 'PDF1', 'txt', 'b81e366f6df3d6c354d82d13446aff1e', 1),
(122, 'MY Document Name1', 'project1', 'PDF1', 'txt', '90c687b04cfdc56ac44cc8d1d1370400', 1),
(123, 'MY Document Name1', 'project1', 'PDF1', 'txt', '9e0c95258d781768a06b9158247ca400', 1),
(124, 'MY Document Name1', 'project1', 'PDF1', 'txt', '3ee2fec72c53d4fd3426c448950e3188', 1),
(125, 'MY Document Name1', 'project1', 'PDF1', 'txt', 'c5d157f900b2f30720115d2f33ebc5e6', 1),
(126, 'MY Document Name1', 'project1', 'PDF1', 'txt', 'e464656e28e8f0f61db7200741e5e309', 1),
(127, 'MY Document Name1', 'project1', 'PDF1', 'txt', '6ceeb1b716540fa60ccac2f5ac014443', 1),
(128, 'MY Document Name1', 'project1', 'PDF1', 'txt', 'fb19aa468d6e65b57a0aa9e9ad5bdc7e', 1),
(129, 'MY Document Name', 'project', 'PDF', 'pdf', '5bf358c2047d487b3cbaee012092e994', 1),
(130, 'MY Document Name', 'project', 'PDF', 'pdf', '7f1583fb66149e84c3538aa4c7bcdb1d', 1),
(131, 'MY Document Name', 'project', 'PDF', 'pdf', '2d7e5629221400c9caaf86b4f13b5a87', 1),
(132, 'MY Document Name1', 'project1', 'PDF1', 'txt', 'fd87bccc39d6aee8b0efaab039fbeeda', 1),
(133, 'MY Document Name1', 'project1', 'PDF1', 'txt', '97fd516206d6f049d300246800104907', 1),
(134, 'MY Document Name1', 'project1', 'PDF1', 'txt', '4e357ef06ad4c96fbb47d21d4b09c04f', 1),
(135, 'MY Document Name1', 'project1', 'PDF1', 'txt', 'a6bf231f0dd3f1d22dba3655f3ddfcc1', 1),
(136, 'MY Document Name1', 'project1', 'PDF1', 'txt', '48969cde3b3274c56a4c6a136acb845e', 1),
(137, 'MY Document Name1', 'project1', 'PDF1', 'txt', 'f7cc816c4fd314b5a048e14a03befe4d', 1),
(138, 'MY Document Name1', 'project1', 'PDF1', 'txt', 'bbc4868482df4a0054c83908da307d5f', 1),
(139, 'MY Document Name1', 'project1', 'PDF1', 'txt', 'd755e56353f8f7f906ef5517be430a68', 1),
(140, 'MY Document Name1', 'project1', 'PDF1', 'txt', 'b758020ea242d8771810f1ad2da93066', 1),
(141, 'MY Document Name1', 'project1', 'PDF1', 'txt', 'e13678516ca87ac742adebd035c56b65', 1),
(142, 'MY Document Name1', 'project1', 'PDF1', 'txt', 'a0f40052258123622c3d2d5f4cfb7089', 1),
(143, 'MY Document Name1', 'project1', 'PDF1', 'txt', '76ebe799d59d6e6a907bcda4c92819fb', 1),
(144, 'MY Document Name1', 'project1', 'PDF1', 'txt', '75bd8d8292f04b2f9548c81d4f16ca01', 1),
(145, 'MY Document Name1', 'project1', 'PDF1', 'txt', '319147bd46118637cc72769f9d6bbc76', 1),
(146, 'MY Document Name1', 'project1', 'PDF1', 'txt', 'a155afbe8dd3d8ac00ee2868cc63fe73', 1),
(147, 'MY Document Name1', 'project1', 'PDF1', 'txt', '817a7d8a6efa762b9df77d1a2b5e94ac', 1),
(148, 'MY Document Name1', 'project1', 'PDF1', 'txt', '370e20a7abd253d23b0cbf87c9efb3d3', 1),
(149, 'MY Document Name1', 'project1', 'PDF1', 'txt', '7c380fe5d6646a5359788ec3ee0baf88', 1),
(150, 'MY Document Name1', 'project1', 'PDF1', 'txt', 'ba22a72012345f659337562871f63e8e', 1),
(151, 'MY Document Name1', 'project1', 'PDF1', 'txt', '1f4526ae4269bbb839ecee88af58fc40', 1),
(152, 'MY Document Name1', 'project1', 'PDF1', 'txt', '5630da1c45d75b31fde792b11eb17f11', 1),
(153, 'MY Document Name1', 'project1', 'PDF1', 'txt', 'f28d99bb696f2f9e0cf752a8f518c2b1', 1),
(154, 'MY Document Name1', 'project1', 'PDF1', 'txt', '5e25a42a42292ef60bb67ce41a677a71', 1),
(155, 'MY Document Name1', 'project1', 'PDF1', 'txt', '9ac0080fc9f024256987fcb0420f3886', 1),
(156, 'MY Document Name1', 'project1', 'PDF1', 'txt', 'f869368eb628fbfda92d7661c29cda54', 1),
(157, 'MY Document Name1', 'project1', 'PDF1', 'txt', '9671434fd5b8dadebb5feb43d63c6dc8', 1),
(158, 'MY Document Name1', 'project1', 'PDF1', 'txt', 'be4b7a3c3eb3f9dd716441387db71fbb', 1),
(159, 'MY Document Name1', 'project1', 'PDF1', 'txt', '6ed034d654846503ef317e180fdf6547', 1),
(160, 'MY Document Name1', 'project1', 'PDF1', 'txt', 'c6c5c1405a386536cd9ca20da9018075', 1),
(161, 'MY Document Name1', 'project1', 'PDF1', 'txt', '813d5da8888d83f5206d6fc4b524a3d1', 1),
(162, 'MY Document Name1', 'project1', 'PDF1', 'txt', '6967ed0cf1ea1cb86d28db16fb1b87ca', 1),
(163, 'MY Document Name1', 'project1', 'PDF1', 'txt', 'a444aa3fc2ac59a097f14edf9b9d3a48', 1),
(164, 'MY Document Name1', 'project1', 'PDF1', 'txt', 'da8b82fed825c0366583951220d35fa5', 1),
(165, 'MY Document Name1', 'project1', 'PDF1', 'txt', 'dc85c97239b606cc4030e2c78eba776c', 1),
(166, 'MY Document Name1', 'project1', 'PDF1', 'txt', 'edef155a379e28c032f1b490ec21b325', 1),
(167, 'MY Document Name1', 'project1', 'PDF1', 'txt', 'e86f5f6ed0ef0fc3b7cfd952840c099e', 1),
(168, 'MY Document Name1', 'project1', 'PDF1', 'txt', 'c630c6fa19d682558dad5740f1114dbb', 1),
(169, 'MY Document Name1', 'project1', 'PDF1', 'txt', 'e0473f881aaa57b850a17021e619ce7d', 1),
(170, 'MY Document Name1', 'project1', 'PDF1', 'txt', '7c89c2b82ad8ef84ef4d12ec1dc96c48', 1),
(171, 'MY Document Name1', 'project1', 'PDF1', 'txt', 'd12ebb25b8f8cb7b2918b044fef867ee', 1);
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
