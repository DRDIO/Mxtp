-- phpMyAdmin SQL Dump
-- version 3.1.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 10, 2009 at 09:24 PM
-- Server version: 5.1.34
-- PHP Version: 5.2.9-2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `mxtp`
--

-- --------------------------------------------------------

--
-- Table structure for table `playlists`
--

CREATE TABLE IF NOT EXISTS `playlists` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `hash` varchar(20) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `user_id` int(10) NOT NULL,
  `view_count` int(11) NOT NULL DEFAULT '0',
  `play_count` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `hash` (`hash`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=57 ;

--
-- Dumping data for table `playlists`
--

INSERT INTO `playlists` (`id`, `title`, `hash`, `user_id`, `view_count`, `play_count`) VALUES
(15, 'The First Playlist', 'L96Si', 6, 0, 0),
(16, 'Untitled', 'G', 7, 0, 0),
(17, 'TestingthelengthofthismofocuzIcanandIknowthisisrediculouslylongforadamnreasonbecauseIliketobreakstuffandummmyeahIamgoodatbreakingstuff', 'PBv', 8, 0, 0),
(18, 'test', 'jIR', 8, 0, 0),
(19, 'donkey', 'CqT', 8, 0, 0),
(20, 'Untitled', 'MT', 8, 0, 0),
(21, 'Untitled', 'b', 10, 0, 0),
(22, 'jen', 'utQPv', 10, 0, 0),
(23, 'killing in the name', '6PoMb', 11, 0, 0),
(24, 'Change my Runnin'' Posse', 'lQV', 11, 0, 0),
(25, 'Cuz Ben is too busy to make his own list', 'K2hmr', 6, 0, 0),
(26, 'Work Playlist 1', 'Zd', 6, 0, 0),
(27, 'Dont think, just dance', 'AAAg', 6, 0, 0),
(28, 'whiny bitch music', 'Asbm', 13, 0, 0),
(29, 'Whiny bitch clips', 'nc', 13, 0, 0),
(30, 'test', 'N', 8, 0, 0),
(31, 'Love Songs', 'ZyX', 7, 0, 0),
(32, 'lol', 'r8v', 8, 0, 0),
(33, 'As The Hamster Wheel Turns: S3', 'wA', 7, 0, 0),
(34, 'As The Hamster Wheel Turns: S3', 'bGMQF', 7, 0, 0),
(35, 'Short Loop Test', 'tUT', 7, 0, 0),
(36, 'First real mix', 'bhCHt', 13, 0, 0),
(37, 'Mix', 'x', 15, 0, 0),
(38, 'first mix', '1ccd', 17, 0, 0),
(39, 'a little hip hop :^)', 'zq3', 16, 0, 0),
(40, 'Old School vs. New School', 'J3Pu', 6, 0, 0),
(41, 'Hip Hop gone folk', 'WEy', 6, 0, 0),
(42, 'Nothing But Remixes', 'Re', 7, 0, 0),
(43, 'Saci is an Ass', 'wI', 18, 0, 0),
(44, 'Kiss me I''m Irish', 'niuD', 6, 0, 0),
(45, 'Just Dance (a lil house)', 'wLH2t', 16, 0, 0),
(46, 'OMG Fun Fun Fun Fest 2009', 'F9', 19, 0, 0),
(47, '<Intentionally Untitled>', '3', 13, 0, 0),
(48, 'MC Chris', 'mKv', 7, 0, 0),
(49, 'shit', 'hCJ', 8, 0, 0),
(50, 'cool stuff', '7B6v', 8, 0, 0),
(51, 'Kittiessss!!!', 'r', 19, 0, 0),
(52, 'Pump', 'Z', 11, 0, 0),
(53, 'Flow', 'b93o', 11, 0, 0),
(54, 'Yee Haw', 'CljEZ', 14, 0, 0),
(55, 'More Haw', 'hVVn', 14, 0, 0),
(56, 'Hard Rock', 'Es', 14, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `songs`
--

CREATE TABLE IF NOT EXISTS `songs` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `playlist_id` int(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `youtube_id` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=276 ;

--
-- Dumping data for table `songs`
--

INSERT INTO `songs` (`id`, `playlist_id`, `title`, `youtube_id`) VALUES
(22, 15, 'Sublime - Caress Me Down', 'fvEj5iZMEpU'),
(23, 15, 'Iron & Wine , Love Vigilantes', 'ugx0zC3Otwk'),
(24, 15, 'Death Cab for Cutie: Grapevine Fires (OFFICIAL)', 'bmpMQA0qfuM'),
(25, 15, 'Journey-Dont Stop Believing (official song) with lyrics', 'N5wVZwdHmRY'),
(26, 16, 'Daft Punk-Human After All(Justice Remix)', '98eZEFWchyQ'),
(27, 16, 'Daft Punk Technologic (Justice Live Remix)', 'YMW0thvESr4'),
(28, 16, 'MSTRKRFT @ Polsslag, Daft Punk - One More Time/ Justice', 'E2F1QCVa_5o'),
(29, 16, 'Klaxons-As Above So Below (JUSTICE remix)', 'mPhIvFQ-MyU'),
(30, 16, 'U2 - Get On Your Boots (Justice Remix)', '16TL1H9EKhA'),
(31, 16, 'Lenny Kravitz - Let Love Rule (Justice Remix)', 'BjORsVAmTwg'),
(32, 18, 'Metallica - Master Of Puppets With lyrics', '_z-hEyVQDRA'),
(33, 18, 'Smashing Pumpkins - Tonight Tonight', 'YEvVIgCm1zg'),
(34, 19, 'Momma Sed', 'dR3ccmWmLhk'),
(35, 19, 'Puscifer - Drunk with Power', 'OSutv_sj92Y'),
(36, 19, 'Puscifer - Drunk with Power', 'OSutv_sj92Y'),
(37, 19, 'Puscifer - Drunk with Power', 'OSutv_sj92Y'),
(38, 19, 'Puscifer - Drunk with Power', 'OSutv_sj92Y'),
(39, 19, 'Cuntry Boner', 'LJvvxEs1_pE'),
(40, 19, 'Underworld ( Puscifer The Undertaker )', 'WM6YevemuaQ'),
(41, 19, 'Underworld ( Puscifer The Undertaker )', 'WM6YevemuaQ'),
(42, 19, 'Underworld ( Puscifer The Undertaker )', 'WM6YevemuaQ'),
(43, 19, 'Underworld ( Puscifer The Undertaker )', 'WM6YevemuaQ'),
(44, 19, 'Underworld ( Puscifer The Undertaker )', 'WM6YevemuaQ'),
(45, 19, 'Underworld ( Puscifer The Undertaker )', 'WM6YevemuaQ'),
(46, 19, 'Underworld ( Puscifer The Undertaker )', 'WM6YevemuaQ'),
(47, 19, 'Underworld ( Puscifer The Undertaker )', 'WM6YevemuaQ'),
(48, 19, 'Underworld ( Puscifer The Undertaker )', 'WM6YevemuaQ'),
(49, 19, 'Underworld ( Puscifer The Undertaker )', 'WM6YevemuaQ'),
(50, 19, 'Underworld ( Puscifer The Undertaker )', 'WM6YevemuaQ'),
(51, 19, 'Underworld ( Puscifer The Undertaker )', 'WM6YevemuaQ'),
(52, 19, 'Underworld ( Puscifer The Undertaker )', 'WM6YevemuaQ'),
(53, 19, 'Underworld ( Puscifer The Undertaker )', 'WM6YevemuaQ'),
(54, 19, 'Underworld ( Puscifer The Undertaker )', 'WM6YevemuaQ'),
(55, 19, 'Underworld ( Puscifer The Undertaker )', 'WM6YevemuaQ'),
(56, 19, 'Underworld ( Puscifer The Undertaker )', 'WM6YevemuaQ'),
(57, 19, 'Underworld ( Puscifer The Undertaker )', 'WM6YevemuaQ'),
(58, 19, 'Underworld ( Puscifer The Undertaker )', 'WM6YevemuaQ'),
(59, 19, 'Underworld ( Puscifer The Undertaker )', 'WM6YevemuaQ'),
(60, 19, 'Underworld ( Puscifer The Undertaker )', 'WM6YevemuaQ'),
(61, 19, 'Underworld ( Puscifer The Undertaker )', 'WM6YevemuaQ'),
(62, 19, 'Underworld ( Puscifer The Undertaker )', 'WM6YevemuaQ'),
(63, 19, 'Underworld ( Puscifer The Undertaker )', 'WM6YevemuaQ'),
(64, 19, 'Underworld ( Puscifer The Undertaker )', 'WM6YevemuaQ'),
(65, 19, 'Underworld ( Puscifer The Undertaker )', 'WM6YevemuaQ'),
(66, 19, 'Underworld ( Puscifer The Undertaker )', 'WM6YevemuaQ'),
(67, 19, 'Underworld ( Puscifer The Undertaker )', 'WM6YevemuaQ'),
(68, 19, 'Underworld ( Puscifer The Undertaker )', 'WM6YevemuaQ'),
(69, 19, 'Puscifer Rev 22:20 Underworld', 'ye0H91hxUMw'),
(70, 19, 'Puscifer Rev 22:20 Underworld', 'ye0H91hxUMw'),
(71, 19, 'Puscifer Rev 22:20 Underworld', 'ye0H91hxUMw'),
(72, 19, 'Puscifer Rev 22:20 Underworld', 'ye0H91hxUMw'),
(73, 21, 'Gwen Stefani - What You Waiting For?', 'uTfbCOPApsQ'),
(74, 21, 'Gwen Stefani: Hollaback girl', 'GjUN09Vq5SI'),
(75, 21, 'Nine Inch Nails - Only', 'xgt_WDjbO0o'),
(76, 21, 'Nine Inch Nails - Closer (Nothing Edit)', 'C4VAv8y2hHM'),
(77, 24, 'Pennywise-Something to Change', 'C96hD_vn5zs'),
(78, 24, 'Sir Mix A Lot - Posse on Broadway (Album Version)', 'uotiPU6-Xew'),
(79, 24, 'Altar Boys - Against the Grain - Kids Are on the Run', '_VnUFFd6FMg'),
(80, 25, 'Placebo - Meds', 'sS63Wnlni3g'),
(81, 25, 'Placebo - Pure Morning', 'JgbkDyuG-MM'),
(82, 25, 'Ben Folds Five- Brick (with lyrics)', '7NJMTmz7pkg'),
(83, 26, 'Sublime - Caress Me Down', 'fvEj5iZMEpU'),
(84, 26, 'SOCIAL DISTORTION - STORY OF MY LIFE (VIDEO)', '4FmW0LPS-M4'),
(85, 26, 'Death Cab for Cutie: Grapevine Fires (OFFICIAL)', 'bmpMQA0qfuM'),
(86, 26, 'Journey-Dont Stop Believing (official song) with lyrics', 'N5wVZwdHmRY'),
(87, 26, 'Heart - Crazy on you', 'QUE5fc7eiWk'),
(88, 27, 'hellogoodbye  - Here In Your Arms', '6-KQ1tp_qOQ'),
(89, 27, 'Darude-Sandstorm', 'erb4n8PW2qw'),
(90, 27, 'Dj Satomi - Castles in the sky', '3hMXtZq3Peo'),
(91, 27, 'Eiffel 65 - Blue (Da Ba Dee)', 'zA52uNzx7Y4'),
(92, 27, 'Alice DeeJay - Better off Alone', 'hvalLXZ8Vuo'),
(93, 27, 'Daft Punk - One More Time (Original) [High Quality]', 'gN2hntZBIUQ'),
(94, 27, 'Fatboy Slim - The Rockafeller Skank', '1WrVi_CLAV0'),
(95, 29, 'Sorry for being a whiny bitch...', 'U-gD3aN9PME'),
(96, 29, 'Organization XIII Themes', 'RtWYIUDf2dU'),
(97, 29, 'Kuhan whiny bitch', 'ZoDZi4N0csI'),
(98, 29, 'whiny bitch', 'AZLTsBpDjrM'),
(99, 29, 'Transformers - Huffer is a whiny bitch', 'WyrjpkAqBN4'),
(100, 31, 'Rilo Kiley - Pictures of success', 'keKdyN16qUs'),
(101, 31, 'Emily Haines & The Soft Skeleton - Our Hell', 'rwMj8pGpIKE'),
(102, 31, 'Emily Haines & The Soft Skeleton - Doctor Blind', 'e8ixpuUpJAk'),
(103, 32, 'Tetris Theme! W00t (on spot arrangement #26)', 'HNwJ2IOVcKk'),
(104, 32, 'OMG!#%!#%!#%!#%!#%', 'FLpHmJjwXRA'),
(105, 32, 'OMG! All Online Data Lost After Internet Crash!!!', 'z4vDClhnJjs'),
(106, 32, 'LIKE OMG!!!! (9.30.09 - Day 153)', 'l0tFOx7hTKM'),
(107, 33, '''', '9yG6SfbyRfw'),
(108, 33, '''', 'VHbPdRtAwgs'),
(109, 33, '''', 'Li2JbyiU2n4'),
(110, 33, '''', 'h2PPMs1u-dE'),
(111, 33, '''', 'soYSa-Z2_JM'),
(112, 33, '''', 'W11MbIt-XKw'),
(113, 33, '''', 'lpDdGuqu-6c'),
(114, 34, 'ATHWT - S3:E1 - You Kids Are Suckers!', '9yG6SfbyRfw'),
(115, 34, 'ATHWT - S3:E2 - Im Not Hideous', 'VHbPdRtAwgs'),
(116, 34, 'ATHWT - S3:E3 - The Rabbit and The Wolf', 'Li2JbyiU2n4'),
(117, 34, 'ATHWT - S3:E4 - The First Meeting', 'h2PPMs1u-dE'),
(118, 34, 'ATHWT - S3:E5 - Lots of Corndogs', 'soYSa-Z2_JM'),
(119, 34, 'ATHWT - S3:E6 - The Crying Game', 'W11MbIt-XKw'),
(120, 34, 'ATHWT - S3:E7 - Cliffhanger Danger!?', 'lpDdGuqu-6c'),
(121, 35, 'Shortest Song Ever - You Suffer By Napalm Death', '1cfkgYneXj8'),
(122, 35, 'Shortest Song Ever - You Suffer By Napalm Death', '1cfkgYneXj8'),
(123, 35, 'Shortest Song Ever - You Suffer By Napalm Death', '1cfkgYneXj8'),
(124, 35, 'Shortest Song Ever - You Suffer By Napalm Death', '1cfkgYneXj8'),
(125, 36, 'Ben Folds - Cologne', 'mkiMdAPmJLU'),
(126, 36, 'Ben Folds - Zak and Sara - Typographical videoclip by c_kick', 'FAVuK5efP4Q'),
(127, 36, 'The Cranberries - Zombie', 'MShJ8h7cEbE'),
(128, 36, 'Birds by The Butthole Surfers', 'IXS0gf8tP58'),
(129, 36, 'The Lord Is A Monkey  Butthole Surfers', 'UFwf7gRiLYM'),
(130, 36, 'The Butthole Surfers - Pepper (Uncensored)', 'dPH-vhpEnaI'),
(131, 36, 'Placebo - Battle For The Sun', 'TZhvHP4JMqs'),
(132, 36, 'The Cranberries - When Youre Gone (Live)', 'AOOVyQP5qCA'),
(133, 36, 'Primus - The Devil went down to Georgia', 'Q9tEdbwXxXw'),
(134, 37, 'POS - Goodbye', 'MUIWzD_VEf4'),
(135, 37, 'J-live & R.a the rugged man - give it up', 'BUnMc6O57v4'),
(136, 37, 'B. Dolan - R.S.V.P.', 'iDyhxLfDbig'),
(137, 37, 'lord have mercy - say what say what', 'IhjcMWHlcN4'),
(138, 37, 'POS - Drumroll', 'vfo-EGDBEAY'),
(139, 37, 'Jedi Mind Tricks- Uncommon Valor (A Vietnam Story)', '7r0KpWMNxnM'),
(140, 37, 'P.O.S. - Half Cocked Concepts', 'pAyDuo3aDPs'),
(141, 37, 'Sage Francis - Escape Artist Video', 'sJ7w-z4BvMo'),
(142, 37, 'P.O.S - Purexed', '1JHbUuWzVNE'),
(143, 37, 'Sage Francis - Sea Lion (Feat Alias, Saul Williams)', 'BffumeEaYOI'),
(144, 37, 'P.O.S. - De la Souls', 'qKUt5g1AiJ8'),
(145, 37, 'Sage Francis - Got Up This Morning', 'hiV2stUu5RE'),
(146, 37, 'P.O.S - Optimist', '3OpHJUJIrpU'),
(147, 37, 'Sage Francis - Rewrite', 'mL-mjuwl93g'),
(148, 37, 'POS - Bleeding Hearts Club', 'XGufRiMnpGI'),
(149, 37, 'Sage Francis- Hell Of a Year', 'ihdsYboSVio'),
(150, 37, 'POS - All Along the Watchtower', 'YQHuEBAr824'),
(151, 37, 'P.O.S - Never Better', 'kPCcf4XNeOg'),
(152, 38, 'Evanescence - Call Me When Youre Sober Official Video', 'cEoP43Pv57k'),
(153, 39, 'Common - I Used To Love H.E.R.', 'Y12YgEIFcAY'),
(154, 39, 'Go (Remix) - Common and Jay-Z', 'Rx4i7hyps7E'),
(155, 39, 'Mos Def - Brown Sugar', 'W-D4KGYt_jM'),
(156, 39, 'Empire State of Mind Jay-Z | Alicia Keys [OFFICIAL VIDEO]', '0UjsXo9l6I8'),
(157, 39, 'Can I Get A...', 'MUN9giYJhew'),
(158, 39, 'Soulja Boy & Lil Wayne - Turn My Swag On Remix', 'iaFa0sYjId8'),
(159, 39, 'LIL WAYNE - FIRE MAN', 'YqbXGcYlmvk'),
(160, 39, 'Lil Wayne - Mo Fire', 'wVM3ilPdcMU'),
(161, 39, 'Lil Wayne - Go DJ', '6F7o8nmfUkA'),
(162, 40, 'Jay Z - 99 Problems [Dirty]', '5W80Ae5hEOA'),
(163, 40, 'California Love by Tupac', 'kq3OfkdPnbQ'),
(164, 40, 'Kanye West - Stronger', 'h_HpqrnuiV0'),
(165, 40, 'Beastie Boys - Sabotage + Lyrics', 'pBjEcAPybsE'),
(166, 40, 'House Of pain - Jump Around Music Video', 'DwQbPgouUYo'),
(167, 40, 'Run DMC - Its Tricky', 'V9sP708voHc'),
(168, 40, 'Cypress Hill - Insane In The Membrane', 'zAlNrtcPCLw'),
(169, 40, 'Mark Morrison Return Of The Mack (original)', 'twgArtVqMlM'),
(170, 40, 'Snoop Dogg - Gin And Juice', 'FTH2fDzyqOM'),
(171, 40, 'Kanye West - Through The Wire - Official [HQ]', 'XPdqWOS4VP0'),
(172, 41, 'The Gourds - Gin & Juice', 'S71Pa9M-SOc'),
(173, 41, 'Baby Got Back - Jonathan Coulton', 'lyJeC99QO8A'),
(174, 41, 'Dynamite hack-Boys n the hood', 'q_UB5QRFW4U'),
(175, 42, 'Kid Cudi - Pursuit Of Happiness (ft. MGMT & Ratatat) - Man on the Moon: The End of Day 2009', 'AXFeEMf_NQY'),
(176, 42, 'Biggie Smalls - Party and Bullshit ( Ratatat Remix )', 'r-gvIeNWAPo'),
(177, 42, 'The Knife - We Share Our Mothers Health (Ratatat Remix)', 'IRZ3SShd1X8'),
(178, 42, 'Grizzly Bear - Knife (Girl Talk Remix)', 'YmD7CvuLxdE'),
(179, 42, 'Daft Punk - Human After All (Sebastian Remix)', 'gnhiAmDBWmw'),
(180, 42, 'Daft Punk - Da Funk (Casino Inc. Remix)', 'aGNOyrldaXA'),
(181, 42, 'Ladytron - Destroy Everything You Touch // Hot Chip Remix', 'X8YxuF3SkdI'),
(182, 43, 'The Gossip - Heavy Cross', 'KLLxdcrk0-s'),
(183, 43, 'Adele - First Love', 'W8hWNyb0bNM'),
(184, 43, 'Michael Jackson-P.Y.T', 'PdV7Kb1RG8Y'),
(185, 43, 'Michael Jackson - Billy Jean', '_fHoDWc22B0'),
(186, 43, 'Queen - Another One Bites The Dust', '9E-WasNzVpI'),
(187, 43, 'The Black Eyed Peas - Missing You + Lyrics', 'QjBZ4bpIejM'),
(188, 43, 'Alicia Keys - As I Am - SuperWoman', '6SLeae3Yoe0'),
(189, 43, 'La Roux - Tigerlily', 'pNNqBJIAZ5s'),
(190, 43, 'Priscilla Ahn - Dream (Official Video)', 'MKfDwChOoHI'),
(191, 43, 'Jamie Lidell - Multiply', 'fkqIsSTWSsc'),
(192, 43, 'Alice Smith-Desert Song', 'cYHFIMxcxrw'),
(193, 43, 'Jackson 5 - I Want You Back', 'WC-rkHXRPX4'),
(194, 44, 'Flogging Molly - Within a Mile of Home', 'xsLV7DEcElQ'),
(195, 44, 'Dropkick Murphys-The Dirty Glass', 'Pcx6W4se4DM'),
(196, 44, 'Flogging Molly - Whats Left of the Flag Side One Dummy', 'Qlym4eLWHFA'),
(197, 44, 'Dropkick Murphys - Fields of Athenry', '10agPj0Vzu4'),
(198, 44, 'Flogging Molly - Rebels of the Sacred Heart', 'Gdlkx_cIqtE'),
(199, 44, 'Dropkick Murphys - Workers Song (with lyrics)', 'aTafZRecy2k'),
(200, 44, 'The Pogues - If I Should Fall From Grace With God [Music Video]', 'Hk1CiwrKgt8'),
(201, 45, 'Black Eyed Peas - Meet Me Halfway', 'aRNQS5UCQQI'),
(202, 45, 'Hellogoodbye Here In Your Arms Lyrics', 'FhPG2YjvFyk'),
(203, 45, 'Bob Sinclar - World Hold On', 'hIExZvqX4j4'),
(204, 45, 'Gusto - Discos Revenge', '-vQbo9XWVH0'),
(205, 45, 'Steve Silk Hurley - Jack Your Body', 'mQcg-dRg5h4'),
(206, 45, 'M.A.R.S. - Pump Up The Volume', 'eGPhUr-T6UM'),
(207, 45, 'Eiffel 65 - Move Your Body', 'tY9Gxpkxj_g'),
(208, 45, 'Mr Fingers - Can You Feel It', 'cNvf0zlwe7k'),
(209, 46, 'Face to Face - Disconnected', '-SjfKXPMHLM'),
(210, 46, '7 Seconds - Young  Till I Die', 'ziSW7ahVpzE'),
(211, 46, 'The Jesus Lizard - Nub', '7wilcAlAal8'),
(212, 46, 'DANZIG-SHE RIDES', 'qC-W0_cv85E'),
(213, 46, 'Coalesce You Cant Kill Us All', 'eiKxKWEVvPo'),
(214, 46, 'Coliseum fall of the pigs', 'G1mgJ5uqML0'),
(215, 46, 'gorilla biscuits - hold your ground', '94fHl7j5H30'),
(216, 46, 'Torche - Grenades', 'E5iXtt_d5nw'),
(217, 46, 'Lucero Nights Like These', 'mIa3QTp34Sw'),
(218, 47, 'The Smashing Pumpkins - Untitled', '-xna5zE7nEk'),
(219, 47, 'the cure - untitled 1998', 'd6h68tBDFkI'),
(220, 47, 'Interpol Untitled', '6LlrkcKaWEI'),
(221, 47, 'Interpol - Untitled Live', 'e3z4mNDQj9E'),
(222, 47, 'untitled/Trapped', 'AvTVyPXDkP0'),
(223, 48, 'Fetts Vette (mc chris Edition)', 'QRhnw1gFuDA'),
(224, 48, 'mc chris - Pizza Butt', 'cCC6834cg7Y'),
(225, 48, 'MC Chris - The Tussin', 'g6-XBTHiBHY'),
(226, 48, 'MC Chris - Nrrrd Grrrl music video', '0nlaJ4zPbSI'),
(227, 48, 'mc chris - Hoodie Ninja', 'MUu9SkBQcXw'),
(228, 48, 'Mc chris - Geek', 'HBqqyIZhVQI'),
(229, 48, 'mc Chris: mc Chris ownz (Mario Remix)', 'dQ5v_pOHtn8'),
(230, 48, 'I Want Candy -ATHF-', 'cohgqx_M454'),
(231, 48, 'Mc Chris - Cookie Breath', '_AAP0S_Mowo'),
(232, 49, 'Limp Bizkit -  Break Stuff Uncensored', 'yt3y7PQeXx8'),
(233, 49, 'busta rhymes break ya neck', 'GrghtXWfVYM'),
(234, 49, 'George Carlin - Religion is bullshit.', 'MeSSwKffj9o'),
(235, 50, 'Dropkick Murphys- The Spicy McHaggis Jig', '_ZN3weW1udE'),
(236, 50, 'Black Sabbath The Mob Rules', '0RgWnxPZpkg'),
(237, 50, 'zz top bad to the bone', 'PDxvb8Lk-NE'),
(238, 50, 'Ted Nugent - Stranglehold', '0c3d7QgZr7g'),
(239, 50, 'Motley Crue - Shout At The Devil 97', 'x3CNZ7iod9s'),
(240, 50, 'The Haunted - All Against All', 'BHVDj-UiAa8'),
(241, 50, 'Red Fang Prehistoric Dog (high quality feature)', 'Y3Vcoq-QRo4'),
(242, 51, 'Cat Plays Piano', 'clfAq1xSevc'),
(243, 51, 'stray cat strut', 'x-JAoFKH3Dw'),
(244, 51, 'Lords of Acid - Show me your pussy Lolcats', 'CFNY0fLwS4o'),
(245, 51, 'The Alley Cats-The Duke of Earl', 'I--sap81a04'),
(246, 51, 'Harry Chapin - Cats in the Cradle', 'zH46SmVv8SU'),
(247, 51, 'ted nugent cat scratch fever', 'nW8S58CYQqs'),
(248, 51, 'THE CAT CAME BACK', 'bETCusT5kNM'),
(249, 51, 'Gucci Mane - Alley Cat - Gucci Mane', 'k0PPDkJjD6I'),
(250, 51, 'Janet Jackson Black Cat (Official)', 'IJFgUbzslNQ'),
(251, 51, 'Ratatat - Wildcat Music Video', 'SBedwedu01k'),
(252, 51, 'The Mean Kitty Song', 'Qit3ALTelOo'),
(253, 52, 'Imogen Heap - Hide and Seek (With Lyrics)', 'Y4OLQB7ON9w'),
(254, 52, 'Clubbed to death Rob Dougan - Kurayamino Mix - The Origin', 'Pt-NvcuDVBc'),
(255, 52, 'Chemical Brothers-Let Forever Be', 'ti4ip8zQyrc'),
(256, 52, 'TRS-80 Dont Mess with Illinois', 'zSA3HYGw3lk'),
(257, 52, 'Steve Aoki- Shake And Pop', '7ScFnlsW5aM'),
(258, 52, 'deadmau5 - We Fail? or WILL FAIL... fu*! it... just FAIL!!', 'WRVYzIP9SNo'),
(259, 52, 'Filter-Cant You Trip Like I Do', '1FV8TVe_JN8'),
(260, 53, '05 - Nas - the lost tapes - No Ideas Original', 'Og0JesZ4iDE'),
(261, 53, 'Eminem - Lose Yourself (8 Mile Soundtrack).avi', 'NeLvuFuSLZg'),
(262, 53, 'Who shot Ya? - Notorious B.I.G', 'Y7yQwQtSN7M'),
(263, 53, 'G-Unit, 50cent & SnooP DoGG-P.I.M.P', '0G4rvnrufHo'),
(264, 53, 'Too $hort - Im a Player', 'z6V9j5qHEqY'),
(265, 54, 'Roger Creager - Im From the Beer Joint (Official Video)', 'GefCpOZQQcc'),
(266, 54, 'Tracy Byrd - Ten Rounds With Jose Cuervo', '_Z16jVKrk2s'),
(267, 54, 'Kevin Fowler - Lord Loves A Drinking Man', 'V4Bvpd3aSZU'),
(268, 54, 'Jason Boland & The Stragglers - Tennessee Whiskey', 'PmhnqQyNBqs'),
(269, 55, 'Alan Jackson - Good Time ( Worlds Longest Line Dance Nashville )', '8lLTzlSIq3E'),
(270, 55, 'Toby Keith I`ll Never Smoke Weed With Willie Again', 'Xm34ZLlIvQg'),
(271, 55, 'My kind of country with lyrics by randy houser', 'F01NTCdargo'),
(272, 56, 'Clutch Electric Worry Music Video', 'Ab6lr2b66Ig'),
(273, 56, 'Ensiferum // Eternal Wait', 'mFsLykv2emA'),
(274, 56, 'In Flames - Moonshield', 'QXAnmQgWdv4'),
(275, 56, 'In Flames - Bullet Ride.', 'RrSkhiKPFyk');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `session` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `session`) VALUES
(6, 'jeremy', 'jeremy@dierobotdie.com', '0a9b2caa521575a4c4004a279137c957', '90jkclapq8b1grn77iog14o8e6'),
(7, 'TXMdotcom', 'kevin@txm.com', 'b1abb28e97b1d0db499282766c945994', 'gsojdg6ehv7tkm7gc8i1cvsd46'),
(8, 'kevinblalock', 'kevin.blalock@gmail.com', 'bc4a8ee92abb113c6efa63387b555437', 'r1mjqkk121n32vfsopdhjc7gh4'),
(9, 'katebuckjr', 'katebuckjr@gmail.com', '8c2f5ebd0d133ba5a9f6f6ff8bd0246e', 'sajk4pamun9f4sttgdb7p45cl6'),
(10, 'JenWojcik', 'Jennifer.Wojcik@YouGuru.net', 'bec44ea91544a3608a6a208793b2c879', 'nf7a9f6s36c4uj9pp245au2ht7'),
(11, 'maczter', 'maczter@gmail.com', '9378280b9d552cce2614007e83df882a', 'f7cjqeg8s262tv0lu5q21duaj6'),
(12, 'fajita', 'ben@technosnobs.com', '4f38cfe4cb5f04e94fc5cdadc65d7576', NULL),
(13, 'ben@jaduka.com', 'ben@jaduka.com', '4f38cfe4cb5f04e94fc5cdadc65d7576', 'qkq1nb5qb2kj8mlg1aspurkhm5'),
(14, 'purdytx', 'purdy@dierobotdie.com', '646ca65fa6da2f58dd4b487f9709a010', 'if8j9t7ok8o3g9rrb122gc9lu1'),
(15, 'seth', 'seth@txm.com', '6e8e60139227f9a4719a44ffac6363d0', '8a71boo056ilao653q2dmbrsm5'),
(16, 'liz', 'egilgan@gmail.com', '6936bea4298a801a624bc652f5e854b8', 'fh2timpfulemu9dsj19lq38uf4'),
(17, 'blivit', 'mikeneum@gmail.com', '618b3456a840b7aa080ffabad4160894', 'qk38kohdobbegun9odpv4p7mk2'),
(18, 'eryn.chandler', 'eryn.chandler@gmail.com', 'd6b2d0104e574c83f7275c7906782ae1', 'aq8lsgv8b93v8hqniapl7nn3i2'),
(19, 'sheila', 'sheilamonsterx@gmail.com', '66ecab49feeff054fa28ff5ab33f43a6', 'm542e3v51rpfd4p9827sm87v34'),
(20, '<3^3', 'spdamani@gmail.com', '58c719b71749f673aa3e72ced020421c', '9gmq130gva1edr0m1kd63pflc3'),
(21, 'DJBinx', 'narntz@gmail.com', '0a9b2caa521575a4c4004a279137c957', 'fjdn1lhph28l0qakhpf30a8n56');

-- --------------------------------------------------------

--
-- Table structure for table `users_favorites`
--

CREATE TABLE IF NOT EXISTS `users_favorites` (
  `user_id` int(11) NOT NULL,
  `playlist_id` int(11) NOT NULL,
  `flag_active` tinyint(1) NOT NULL DEFAULT '1',
  UNIQUE KEY `users_id` (`user_id`,`playlist_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_favorites`
--

INSERT INTO `users_favorites` (`user_id`, `playlist_id`, `flag_active`) VALUES
(7, 56, 1),
(7, 58, 1),
(7, 100, 0);

--
-- Table structure for table `service_twitter`
--

CREATE TABLE IF NOT EXISTS `service_twitter` (
  `user_id` int(11) NOT NULL,
  `oauth_token` varchar(64) NOT NULL,
  `oauth_token_secret` varchar(64) NOT NULL,
  `screen_name` varchar(64) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

