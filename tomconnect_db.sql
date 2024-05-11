-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2024 at 01:20 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tomconnect_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `event_start_date` date NOT NULL,
  `event_end_date` date NOT NULL,
  `event_time` time NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `location` varchar(255) NOT NULL,
  `is_delete` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `organizations`
--

CREATE TABLE `organizations` (
  `org_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `description` text DEFAULT NULL,
  `admin_id` int(11) NOT NULL,
  `website` varchar(255) DEFAULT NULL,
  `logo_url` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `is_registration_open` tinyint(1) NOT NULL DEFAULT 1,
  `registration_url` varchar(255) DEFAULT NULL,
  `cover_img_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `organizations`
--

INSERT INTO `organizations` (`org_id`, `name`, `description`, `admin_id`, `website`, `logo_url`, `location`, `is_active`, `created_at`, `updated_at`, `is_deleted`, `is_registration_open`, `registration_url`, `cover_img_url`) VALUES
(1, 'AIESEC-UST', '', 1, NULL, NULL, NULL, 1, '2024-04-30 04:21:18', '2024-05-02 11:18:34', 0, 1, NULL, './img/sample.jpg'),
(2, 'Fotomasino', '', 2, NULL, NULL, NULL, 1, '2024-04-30 04:24:18', '2024-05-02 11:18:34', 0, 1, NULL, './img/sample.jpg'),
(3, 'TomasinoWeb', '', 3, NULL, './img/sample.jpg', NULL, 1, '2024-04-30 04:25:55', '2024-05-02 11:18:34', 0, 1, NULL, './img/sample.jpg'),
(4, 'UST Mountaineering Club', '', 4, NULL, NULL, NULL, 1, '2024-04-30 04:29:07', '2024-05-02 11:18:34', 0, 1, NULL, './img/sample.jpg'),
(5, 'Becarios De Santo Tomas', '', 5, NULL, NULL, NULL, 1, '2024-04-30 04:30:56', '2024-05-02 11:18:34', 0, 1, NULL, './img/sample.jpg'),
(6, 'UST Debaters Council', '', 6, NULL, NULL, NULL, 1, '2024-04-30 04:32:09', '2024-05-02 11:18:34', 0, 1, NULL, './img/sample.jpg'),
(7, 'UST-ISA', '', 7, NULL, NULL, NULL, 1, '2024-04-30 04:35:28', '2024-05-02 11:18:34', 0, 1, NULL, './img/sample.jpg'),
(8, 'UST Espana United', '', 8, NULL, NULL, NULL, 1, '2024-04-30 04:40:59', '2024-05-02 11:18:34', 0, 1, NULL, './img/sample.jpg'),
(9, 'UST Film Society', '', 9, NULL, NULL, NULL, 1, '2024-04-30 04:42:45', '2024-05-02 11:18:34', 0, 1, NULL, './img/sample.jpg'),
(10, 'UST Filipino Martial Arts', '', 10, NULL, NULL, NULL, 1, '2024-04-30 04:44:22', '2024-05-02 11:18:34', 0, 1, NULL, './img/sample.jpg'),
(11, 'UST Yoga Club', '', 11, NULL, NULL, NULL, 1, '2024-04-30 04:46:50', '2024-05-02 11:18:34', 0, 1, NULL, './img/sample.jpg'),
(12, 'UST Yellow Jackets', '', 12, NULL, NULL, NULL, 1, '2024-04-30 09:04:54', '2024-05-02 11:18:34', 0, 1, NULL, './img/sample.jpg'),
(13, 'Musikang Sikat ng mga Tomasino', '', 13, NULL, NULL, NULL, 1, '2024-04-30 09:06:11', '2024-05-02 11:18:34', 0, 1, NULL, './img/sample.jpg'),
(14, 'Teatro Tomasino - UST', '', 14, NULL, NULL, NULL, 1, '2024-04-30 09:08:20', '2024-05-02 11:18:34', 0, 1, NULL, './img/sample.jpg'),
(15, 'UST Salinggawi Dance Troupe', '', 15, NULL, NULL, NULL, 1, '2024-04-30 09:10:24', '2024-05-02 11:18:34', 0, 1, NULL, './img/sample.jpg'),
(16, 'UST Pax Romana', '', 16, NULL, NULL, NULL, 1, '2024-04-30 09:11:35', '2024-05-02 11:18:34', 0, 1, NULL, './img/sample.jpg'),
(17, 'EARTH-UST', '', 17, NULL, NULL, NULL, 1, '2024-04-30 09:13:24', '2024-05-02 11:18:34', 0, 1, NULL, './img/sample.jpg'),
(18, 'UST - UNESCO', '', 18, NULL, NULL, NULL, 1, '2024-04-30 09:14:44', '2024-05-02 11:18:34', 0, 1, NULL, './img/sample.jpg'),
(19, 'KaBayanihan Youth UST', '', 19, NULL, NULL, NULL, 1, '2024-04-30 09:16:46', '2024-05-02 11:18:34', 0, 1, NULL, './img/sample.jpg'),
(20, 'UST Red Cross Youth Council - Pharmacy Unit', '', 20, NULL, NULL, NULL, 1, '2024-04-30 09:18:46', '2024-05-02 11:18:34', 0, 1, NULL, './img/sample.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `media_url` varchar(255) DEFAULT NULL,
  `media_type` varchar(64) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `post_status` varchar(32) NOT NULL DEFAULT 'published',
  `visibility` varchar(32) NOT NULL DEFAULT 'public',
  `is_archived` tinyint(1) NOT NULL DEFAULT 0,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `author_id`, `content`, `media_url`, `media_type`, `created_at`, `updated_at`, `post_status`, `visibility`, `is_archived`, `is_deleted`) VALUES
(1, 20, '…Are you ready for it, PHArmily?\r\nAfter a year of dedicated service of volunteerism, let us take this opportunity to meet our fellow PHArmily and make new memories! The Red Cross Youth Council - Pharmacy Unit is thrilled to warmly invite you to our most awaited year-end gathering, entitled “ᴇɴᴅ ᴏꜰ ᴀɴ ᴇʀᴀ: ᴛʜᴇ ʀᴄʏᴄ - ᴘʜᴀ ʏᴇᴀʀ-ᴇɴᴅ ᴀꜱꜱᴇᴍʙʟʏ.”\r\nDon’t forget to mark your calendars on May 2, 2024 from 2:00 PM - 6:00 PM at the Central Laboratory Auditorium! Join us in witnessing an insightful discussion led by the well-esteemed speaker, and engage in the activities prepared by our dearest committees. Who knows? You might be the one who’ll win the prize. 👀  So, what are you waiting for? ❤️💜\r\n#USTRCYC2324\r\n#RCYCREDefiningService\r\n#LifelineRCYC2324\r\nCaption By: Nathalei Patungan\r\nPubmat By: Leira Micosa', NULL, NULL, '2024-04-30 09:21:48', '2024-04-30 09:21:48', 'published', 'public', 0, 0),
(2, 20, '🦟 Don\'t let malaria cast its shadow, let\'s unite and fight, make our future glow! 🌟\r\nJoin hands this World Malaria Day, let\'s chase those mosquitoes away! 🚫\r\nIn the battle against this sneaky foe, together we stand, tall we go.🌿 With nets and sprays, we\'ll conquer the night, ensuring everyone\'s future\'s bright.💡Spread the word, spread the ease, let\'s eradicate this disease! 🌎\r\n#USTRCY2324\r\n#RCYREDefiningService\r\n#LifelineRCYC2324\r\nCaption By: Patrick Viñas\r\nPubmat By: Mayrhil Banias', NULL, NULL, '2024-04-30 10:25:33', '2024-04-30 10:25:33', 'published', 'public', 0, 0),
(3, 19, 'Muslims around the world celebrate the end of Ramadan which is known as Eid al-Fitr. It features two to three days of celebrations that include special morning prayers. People greet each other with “Eid Mubarak,” meaning “Blessed Eid” and with formal embraces. In essence, it acknowledges Allah’s revelation of the Quran to the Prophet Muhammad. Primarily, it is also seen as a spiritual celebration of Allah’s provision of strength and endurance.\r\nBoard and Caption by: Jeanne Querol', NULL, NULL, '2024-04-30 10:26:28', '2024-04-30 10:26:28', 'published', 'public', 0, 0),
(4, 19, '\'Ang mga Pilipinong may mataas na pagtindig at buhay na pakikipag-uugnayan sa isa\'t isa para sa bayan ang solusyon sa matagumpay na estado.\'\r\nAng KaBayanihan Youth UST ay malugod kayong iniimbitahan upang makiisa at maging parte sa inihandang Pangkalahatang Pagtitipon na pinamagatang \'UGNAYAN: KaBayanihan Youth-UST General Assembly\' para sa mga kasapi ng organisyon.\r\nIto ay magaganap ngayong ika-10 ng Mayo 2021 (Lunes) at platapormang gagamiting sa pagsasagawa ng webinar na ito ay ang ZOOM Meetings. \r\nUpang sumali, magregister lamang sa link na ito:\r\nhttp://bit.ly/UGNAYANKYUST\r\nBoard by: Janelle Kirsten Chan\r\nCaption by: Ayla Villarca', NULL, NULL, '2024-04-30 10:27:43', '2024-04-30 10:27:43', 'published', 'public', 0, 0),
(5, 18, 'Do you have a passion for service and the drive to push boundaries? Don\'t Miss Out! Applications Close Tomorrow! ⏰\r\nWe\'re searching for talented and motivated advocates to join our Executive Board for Academic Year 2024- 2025. \r\nApplications close tomorrow, so don\'t miss this exciting opportunity to make a real impact.\r\nBelow are the requirements on how to apply. Follow these procedures in applying for the position in Executive Board. 👇🏻\r\nApplication Form: https://tinyurl.com/ewac4vny\r\nEB Primer: https://tinyurl.com/UUCEBDESC\r\nAre you ready to take the next step? Let\'s #BuildPeaceByPiece! 💙\r\nCaption By: Ryza Zagala & Matt Gallardo \r\nBoard By: Aira Canon, Jaed Nadine Soriano, & Maria Elyssa Magsisi', NULL, NULL, '2024-04-30 10:29:25', '2024-04-30 10:29:25', 'published', 'public', 0, 0),
(6, 18, 'Emphasizing the recognition and reward of the creators and inventors for their work, this day is dedicated to 𝐖𝐨𝐫𝐥𝐝 𝐈𝐧𝐭𝐞𝐥𝐥𝐞𝐜𝐭𝐮𝐚𝐥 𝐏𝐫𝐨𝐩𝐞𝐫𝐭𝐲 𝐃𝐚𝐲! 📝🧠\r\nAdvocates, let this day be a reminder that Intellectual Property protects our artistic endeavors and respects them.\r\nAnd in this dynamic landscape, 𝐲𝐨𝐮𝐫 𝐚𝐫𝐭 𝐢𝐬 𝐲𝐨𝐮𝐫 𝐜𝐮𝐫𝐫𝐞𝐧𝐜𝐲 so here’s to you: Let’s continue to build 𝐚 𝐰𝐨𝐫𝐥𝐝 𝐰𝐡𝐞𝐫𝐞 𝐜𝐫𝐞𝐚𝐭𝐢𝐯𝐢𝐭𝐲 𝐤𝐧𝐨𝐰𝐬 𝐧𝐨 𝐥𝐢𝐦𝐢𝐭, and to #BuildPeaceByPiece means fostering a world where ideas are supported, protected, and valued.🕊️💙\r\n#IntellectualPropertyDay2024\r\nCaption by: Elma Lyn Biado\r\nBoard by: Denise Tumagcao', NULL, NULL, '2024-04-30 10:29:47', '2024-04-30 10:29:47', 'published', 'public', 0, 0),
(7, 1, 'On the topic of range... \r\n\r\nDiscover the full range of your capabilities like Dominique Avena by going on an exchange program with AIESEC! \r\n\r\nGenerate your profile tonight at http://aiesec.org and we\'ll reach out to you from there! 😉', NULL, NULL, '2024-04-30 10:32:15', '2024-04-30 10:32:15', 'published', 'public', 0, 0),
(8, 2, 'The UST Junior Tiger Sands drub the UP Junior Fighting Maroons in straight sets last Saturday, April 26, at the SM Sands by the Bay, 21-8, 21-6.\r\nLet’s support the Tiger Sands in their remaining games in the elimination round today! ⛱️\r\n#GoUSTe\r\n#UAAPSeason86\r\n#FuelingTheFuture\r\n#SnapsOfTheFinest\r\nPhotos by: Harmee Jasmine Pambid\r\nCaption by: Dawn Krishane Liam\r\nUST Growling Tigers\r\nUST Golden Spikers - Indoor and Beach Volleyball Team', NULL, NULL, '2024-04-30 10:33:01', '2024-04-30 10:33:01', 'published', 'public', 0, 0),
(9, 3, 'Can’t beat the heat?\r\nCheck out TomWegg’s food and drink recommendations to help you cool off during these hot summer days!\r\nCheck more here: https://www.lamona.lol/\r\n(Artworks by Erimae Lopez and John Paul Dimarucot/TomasinoWeb)', NULL, NULL, '2024-04-30 10:34:44', '2024-04-30 10:34:44', 'published', 'public', 0, 0),
(10, 17, 'Get ready with us in meeting our guest speaker for this year’s Environmental Summit for Youth Action (ESYA) today, April 27, at UST Central Laboratory Auditorium from 1:30 PM to 4 PM. 👕♻️\r\nLearn from Mr. Prince Ventura, a multi-awarded clothing technologist, fashion social technopreneur, consultant, designer, stylist, wardrobe manager, and the country\'s lead champion of circular fashion who is also the founder and CEO of Wear Forward which is the Philippines\' premier clothing as a service fashion tech startup and social enterprise.\r\nParticipants are encouraged to bring pre-loved articles of clothing, which will be donated to partner organizations and businesses for upcycling. \r\nSee you later, Earthlings!\r\nDo not forget to register through this link: https://docs.google.com/.../1FAIpQLSe4oQY0yZpaOm.../viewform \r\n#3ARTH4ALL\r\n#ESYA2024\r\nCaption by Aedan Jefferson Tropa\r\nBoard by Andrea Buen\r\nRSO-B1-23-24-06', NULL, NULL, '2024-04-30 10:35:47', '2024-04-30 10:35:47', 'published', 'public', 0, 0),
(11, 17, 'Planet vs. Plastics\r\nThis year’s #EarthDay highlights the fight to end plastic usage and raise awareness on the health risks of plastic, so that we can prevent Earth from becoming the chairman and lone member of the tortured planets department. 🤍😉🌏\r\nTogether with earthday.org, founders and organizers of the very first Earth Day on April 22, 1970, EARTH-UST echoes their urgent demands to reduce production of all plastics, call for a strong UN Treaty on Plastic Pollution, and put an end to fast fashion. 🙏🏼\r\nHand in hand, we can reestablish an Earth that is healthy and inhabitable for all. ✊🏼🌱\r\n#3ARTH4ALL\r\n#EARTHero\r\nCaption by Aedan Jefferson Tropa\r\nBoard by Liza Vasquez\r\nRSO-B1-23-24-06', NULL, NULL, '2024-04-30 10:36:21', '2024-04-30 10:36:21', 'published', 'public', 0, 0),
(12, 3, '#ICYMI TOMCAT-UST and the UST Central Commission on Elections conduct Proklamasyon 2024, the annual Central and Local Student Council proclamations, on Saturday, April 27, at the Tan Yan Kee Audio Visual Room.\r\nPresidents of local student councils in the University also shared accomplishment reports and insights on their performance during the student council year 2023-2024.\r\n(Photos by Ara Relunio and Walter Erice/TomasinoWeb)', NULL, NULL, '2024-04-30 10:36:59', '2024-04-30 10:36:59', 'published', 'public', 0, 0),
(13, 2, 'SA ESPAÑA ANG TWICE-TO-BEAT! 😭\r\nThe UST Golden Tigresses sweep the defending champions, DLSU Lady Archers, in the eliminations round in four nail-biting sets at the Smart Araneta Coliseum, 22-25, 25-23, 25-16, 25-15.\r\nUp next, semis! 🐯🔜\r\n#GoUSTe\r\n#UAAPSeason86\r\n#FuelingTheFuture\r\n#SnapsOfTheFinest\r\nPhotos by: Julian Ver Labandia and James Michael Magboo\r\nCaption by: Dawn Krishane Liam\r\nUST Growling Tigers\r\nUST Women\'s Volleyball Team (TIGRESSES)', NULL, NULL, '2024-04-30 10:37:33', '2024-04-30 10:37:33', 'published', 'public', 0, 0),
(14, 1, 'With all the papers, plates, and challenges Thomasians have dealt with this hell week, we want to let you know that you\'re almost there! Just a few more days and you can finally enjoy your well-deserved rest. \r\n\r\nRemember, \r\nschool is tough, but so are you ✨\r\n\r\n#AIESECinUST', NULL, NULL, '2024-04-30 10:38:08', '2024-04-30 10:38:08', 'published', 'public', 0, 0),
(15, 4, 'Ngayon na ang araw! 📅 \r\nMaya-mayang 1:00 ng hapon hanggang sa 5:00 ng hapon ay magaganap na ang Buhay ay di lang tao: An Animal Welfare and Compassion Project (Phase 1)! 🧑🏻‍🏫\r\nSamahan niyo kami para sa isang hapon na puno ng pagkakatuto ukol sa iba\'t ibang aspeto ng mga hayop! 🐕‍🦺🐈\r\nMaaari pa kayong mag-register at humabol sa aming Google Forms upang makasali sa aming makabuluhang talakayan ukol sa mga hayop:\r\nhttps://forms.gle/o7Zw8HYmjatU7Tao9\r\nhttps://forms.gle/o7Zw8HYmjatU7Tao9\r\nhttps://forms.gle/o7Zw8HYmjatU7Tao9\r\nManatiling may alam sa aming mga ekspedisyon sa gamit ng pag-follow sa aming mga social media accounts:\r\nFacebook: https://www.facebook.com/ustmc\r\nInstagram: https://instagram.com/ust_mc\r\nTwitter/X: https://x.com/ust_mc\r\nKikitain namin kayo sa mga bundok mga Tigreng mamumundok! 🐯🌄\r\n#USTMC\r\n#USTMCBuhayAyDiLangTao\r\n#USTMountaineeringClub', NULL, NULL, '2024-04-30 10:42:20', '2024-04-30 10:42:20', 'published', 'public', 0, 0),
(16, 16, 'Embark on a soul-stirring journey of renewal with our post-Easter webinar entitled “Faith Renewed: Embracing the Power of Easter\'s Message.” Let\'s delve into the profound significance of this season while rekindling our faith and enfolding its timeless wisdom. \r\nAt this event, discover the beauty of Easter’s message as it resonates within our hearts and minds. Through engaging discussions, uplifting reflections, and heartfelt connections, let\'s revitalize our faith and embark on a path of renewed purpose in life. \r\nJoin us this Sunday (April 21, 2024 - 5:00PM) as we explore the transformative power of hope, growth, and redemption. See you there! \r\nRegister here‼️\r\nhttps://docs.google.com/.../1FAIpQLScQiXnTlrs.../viewform...\r\n#FaithRenewed🌟🙏🏻', NULL, NULL, '2024-04-30 10:43:16', '2024-04-30 10:43:16', 'published', 'public', 0, 0),
(17, 5, '⏳️ Tick-tock, time\'s ticking, Thomasian scholars!\r\nJust 1 day left until Scholars\' Forum 2024: Beyond The Algorithm blasts off! 🌟 Get ready to explore the cutting-edge of technology and its game-changing role in shaping our future! Don\'t miss this chance to dive deep into empowering discussions and discover how AI can pave the way for a brighter, more sustainable tomorrow! See you there!🫶\r\n#ScholarsForum2024\r\n#BeyondTheAlgorithm🤖✨\r\n—--\r\nDesign by: Aaron Derick Alcantara\r\nCaption by: Claire Deduque\r\nRSO-B1-23-24-02\r\nE-Reserve No. 93443🏻', NULL, NULL, '2024-04-30 10:44:03', '2024-04-30 10:44:03', 'published', 'public', 0, 0),
(18, 4, '\'Marami tayong dapat matutunan mula sa mga hayop kaysa sa mga hayop na dapat matuto mula sa atin.\' - Anthony Williams 🦮🐈🧍🏻\r\nSa darating na Linggo, Abril 28, 2024, mula 1:00 ng hapon hanggang sa 5:00 ng hapon sa Google Meet, inihahandong namin ang Buhay ay di lang tao: An Animal Welfare and Compassion Project (Phase 1)! 🧑🏻‍🏫\r\nSamahan niyo kami sa paggawa ng kamalayan tungkol sa kapakanan ng mga hayop at responsableng pag-aalaga ng mga hayop! 🐶😺\r\nMag-register sa aming Google Forms upang makasali sa aming makabuluhang talakayan ukol sa mga hayop:\r\nhttps://forms.gle/o7Zw8HYmjatU7Tao9\r\nhttps://forms.gle/o7Zw8HYmjatU7Tao9\r\nhttps://forms.gle/o7Zw8HYmjatU7Tao9\r\nManatiling may alam sa aming mga ekspedisyon sa gamit ng pag-follow sa aming mga social media accounts:\r\nFacebook: https://www.facebook.com/ustmc\r\nInstagram: https://instagram.com/ust_mc\r\nTwitter/X: https://x.com/ust_mc\r\nKikitain namin kayo sa mga bundok mga Tigreng mamumundok! 🐯🌄\r\n#USTMC\r\n#USTMCBuhayAyDiLangTao\r\n#USTMountaineeringClub', NULL, NULL, '2024-04-30 10:44:54', '2024-04-30 10:44:54', 'published', 'public', 0, 0),
(19, 15, 'Timek ti kabundukan!\r\nThe UST Salinggawi Dance Troupe performs a Cordillera Suite during the International Dance Day Folkdance Gala at the Samsung Performing Arts Theater alongside folk dance companies such as The Bayanihan National Dance Company, Ramon Obusan Folkloric group, PNU Kislap Sining Dance Troupe, & the Kalilayan Folkloric Dance Group. \r\nHappy International Dance Day!!\r\n#PraiseGodForDance #USTSalinggawiDanceTroupe\r\n', NULL, NULL, '2024-04-30 10:45:31', '2024-04-30 10:45:31', 'published', 'public', 0, 0),
(20, 5, 'Scholars\' Forum 2024: Beyond The Algorithm draws near! \r\nGet ready for an enriching experience with our informative sessions. Check out the event guidelines to ensure a smooth participation, and make sure to join the event raffle to win different vouchers and GCash prizes! \r\n#ScholarsForum2024 #BeyondTheAlgorithm \r\n—--\r\nDesign by: Sophia Ariana Evangelista, Lyle Joseph Paraboles\r\nRSO-B1-23-24-02\r\nE-Reserve No. 93443', NULL, NULL, '2024-04-30 10:46:02', '2024-04-30 10:46:02', 'published', 'public', 0, 0),
(21, 16, 'Tomorrow, 11 April 2024,  the UST Pax Romana Central Coordinating Council, in coordination with the UST Office for Student Affairs, UST Central Student Council, and the UST Student Organizations Coordinating Council, will have the PAX COMMUNIS: The Thomasian Peace Ambassadors General Assembly.\r\nThis event will be an opportunity for Thomasians to be peacekeepers, maintaining peace in different levels and spheres, and be exemplars of peace to others while maintaining and spreading “the peace of Christ in the kingdom of Christ”.\r\nSee you tomorrow, Peace Ambassadors!\r\n“Peace cannot be attained on earth without safeguarding the goods of persons, free communication among men, respect for the dignity of persons and peoples, and the assiduous practice of fraternity. Peace is \"the tranquillity of order.\" Peace is the work of justice and the effect of charity.” (Catechism of the Catholic Church 2304)', NULL, NULL, '2024-04-30 10:47:07', '2024-04-30 10:47:07', 'published', 'public', 0, 0),
(22, 6, '📬 Let\'s look at our mail one last time!\r\nTogether, let us remember our fond memories at  Dialectics 2024, last April 19 to 20! \r\nLook as each snap signifies the timeless testament to our camaraderie and our passion for debate and discourse 💛🖤\r\nLet\'s hold unto these treasures forever.\r\nSincerely yours, Thomasian Debaters Council\r\nーーー\r\nCaption by Andre Que\r\nPhotos by Reese Fuerza \r\nPhoto processsed by Reese Fuerza and Lia Snyder\r\nRSO-B1-23-24-14', NULL, NULL, '2024-04-30 10:47:53', '2024-04-30 10:47:53', 'published', 'public', 0, 0),
(23, 7, 'Save the date! 📅\r\nApril 24th marks the first part of ISA Fiesta: The Revival, our Cultural Day. The celebration is a spectacular event where we honor the diverse tapestry of cultures that enrich our lives. 🥳\r\nGet ready for a day brimming with festival-themed excitement, captivating performances, and enriching exchanges. Come together with us to celebrate unity in diversity as we embrace the uniqueness that each culture brings and revel in the richness of our shared heritage.\r\nDon\'t miss this opportunity to connect, learn, and celebrate with us! See you there! 🎊\r\n🎉 Time: 1:00PM-4:00PM\r\n🎉 Date: April 24, 2024\r\n🎉 Venue: 8/F Central Laboratory Auditorium, University of Santo Tomas\r\n🎉 Pre-registration Form: https://forms.gle/RQNUaK4D58nK3YEn6', NULL, NULL, '2024-04-30 10:48:36', '2024-04-30 10:48:36', 'published', 'public', 0, 0),
(24, 8, 'España United’s third league for the school year 2019-2020, League D Way 9 held at the Gatorade-Chelsea Bluepitch, Circuit Makati last February 8 and 9, 2020. \r\nAfter failing to secure a podium finish in their last league, España United proved that they are able to bounce back. \r\nLet us congratulate the UST Team for winning the 1st Runner-Up in this year’s League D Way 9! Not only that, there were certain members of the team that were able to snatch individual awards not only for themselves, but for UST as well.\r\nCongratulations to the following:\r\nMatthew Allen Malicdem - Mythical 7\r\nEmee Sobremonte - Female Tournament MVP \r\nErwin Christian Hermosa - Male Tournament MVP\r\nPhoto credits to: Diego Barrios', NULL, NULL, '2024-04-30 10:50:28', '2024-04-30 10:50:28', 'published', 'public', 0, 0),
(25, 10, 'Join us tomorrow night for FMA Discussion Episode 231 with Guro Adrien Pierre N. Quidlat, M.D.\r\nHe will talk about:\r\nRapido Realismo Kali\r\nEskrima Spar Club\r\nUST Filipino Martial Arts Group\r\nA recent event at work that gave him the opportunity to show his knowledge in FMA and the lessons he learned.\r\n6pm ET 🇺🇸 * 11pm 🇬🇧 * 7am 🇵🇭 Dec 2\r\nhttps://www.facebook.com/photo.php?fbid=10158450848663341&set=np.1638293115860193.549236672&type=3&notif_id=1638293115860193&notif_t=photo_tag&ref=notif', NULL, NULL, '2024-04-30 10:51:25', '2024-04-30 10:51:25', 'published', 'public', 0, 0),
(26, 9, '🕵️🩺👮👩‍💼🔍\r\nJoin the Thomasian Film Society as it unveils 10th-year major production that will test friendships, strategies, and survival. 📽️\r\n05.08.2024\r\nBoard and Caption by Adriene Mikaela Orzal\r\n#TFSMafiaSeries\r\n#TFS10\r\n#TFSEPI10ME\r\n#ThomasianFilmSociety', NULL, NULL, '2024-04-30 10:51:55', '2024-04-30 10:51:55', 'published', 'public', 0, 0),
(27, 13, 'Balang araw..\r\nMakikita natin kung bakit kinailangan lumayo. Para sa pangarap? para sa pagmamahal? para sa sarili, para sayo. \r\nKahit hindi maintindihan. Kahit hirap tanggapin. Paalam, Salamat.. “Patawad, Paalam” by Moria Dela Torre at I Belong to the Zoo. \r\n#TinigNgMUSIKAT \r\n#16alikAngOPMUSIKAT \r\nVocals by: Aimee Balita\r\nEdited by: Paolo Regondola \r\nCaption by: Marla Ober', NULL, NULL, '2024-04-30 10:53:05', '2024-04-30 10:53:05', 'published', 'public', 0, 0),
(28, 12, 'Get ready for the spikes and digs – it\'s game time! 🏐\r\nThe most awaited battle is here as the UST Golden Spikers and Tigresses clash with the DLSU Green and Lady Spikers. 🐯🔥 Showdown\'s live at the Smart Araneta Coliseum!\r\n#GoUSTe\r\n#OneForUST\r\n#UAAPSeason86\r\n#USTYellowJackets', NULL, NULL, '2024-04-30 10:53:48', '2024-04-30 10:53:48', 'published', 'public', 0, 0),
(29, 11, 'Namaste!\r\nUST Yoga Club is currently looking for potential EA officers and Committee members!\r\nTo know more about the available positions, check out this primer below. \r\nIf you\'re interested in joining USTYC, fill up the attached form! \r\nApplication for EA: https://docs.google.com/.../1hzZw6q6DARsbiw7_iiO6K.../edit\r\nApplication for Committee: https://docs.google.com/.../1Bz9rZydw6Pc.../edit\r\nFor Membership application: https://docs.google.com/.../18mUB9CLKB334HDLV.../viewform...', NULL, NULL, '2024-04-30 10:54:37', '2024-04-30 10:54:37', 'published', 'public', 0, 0),
(30, 7, 'UST-ISA extends its heartfelt gratitude to everyone who actively participated and made our first face-to-face General Assembly to transcend communication barriers.\r\nAs we approach the end of the year, let us continuously forge connection with our fellow international students.\r\nDon\'t forget to answer the evaluation form for this event: https://forms.gle/DEinG6qXg3z72DpT9', NULL, NULL, '2024-04-30 10:55:19', '2024-04-30 10:55:19', 'published', 'public', 0, 0),
(31, 12, 'Ignite the Tiger POWER! 🐯💥 \r\nThomasians, your unwavering support fuels our spirit. 🔥\r\nHelp the UST community make some noise for the upcoming volleyball games by donating.\r\nLet\'s cheer louder and prouder together! 📣💛\r\n#GoUSTE\r\n#OneforUST\r\n#USTYellowJackets', NULL, NULL, '2024-04-30 10:56:48', '2024-04-30 10:56:48', 'published', 'public', 0, 0),
(32, 14, 'Malapit nang i-serve ang kape! Ano pang inaantay niyo? \r\nTeatro Tomasino proudly presents Juan Ekis’ “Kapeng Barako Club: Samahan ng mga Bitter” for its 46th season. Drink it while it’s hot!\r\nYou may place your orders here: https://tinyurl.com/KBCTickets\r\nBREWING ON\r\nMay 7, 2024 | 4 PM, 7 PM\r\nMay 8, 2024 | 10 AM, 1 PM, 4 PM, 7 PM\r\nMay 9, 2024 | 10 AM, 1 PM, 4 PM\r\nat the Thomas Aquinas Research Complex (TARC) Auditorium. See you there!\r\nFor more inquiries, contact:\r\nMs. Abegail Morante - 0929 106 6166\r\nMx. Heaven Nicole Vergara - 0998 854 9877\r\n#USTKapengBarakoClub\r\n#KapeTayo\r\n#SiklabAlab\r\n#TeatroTomasino46', NULL, NULL, '2024-04-30 10:57:33', '2024-04-30 10:57:33', 'published', 'public', 0, 0),
(33, 9, '🎬CUT! THAT\'S A WRAP!🎬\r\nThe first-ever Sinalang Film Festival was held at the Brooklyn Warehouse last February 25, which showcased alternative cinema through experimental films and performance arts 🎭\r\nJoin the Thomasian Film Society as we delve deep into conversations with participants and showrunners, uncovering their fascinating insights and unique journeys. Embark on a cinematic adventure unlike any other, and immerse yourself in the extraordinary tales and experiences these visionary creators share by watching the video here👇🏽\r\nVideo and Edited by: Brice Tecson\r\nCaption by: JJ Florendo\r\n#SinalangFilmFestival2024\r\n#TFS10\r\n#TFSEPI10ME\r\n#ThomasianFilmSociety', NULL, NULL, '2024-04-30 10:58:30', '2024-04-30 10:58:30', 'published', 'public', 0, 0),
(34, 18, 'Witnessing the convergence of Filipino and Chinese traditions at The Sinophile ⛩️\r\nUST UNESCO Club hosted the seminar last April 12th, inviting attendees to explore the profound influence of Chinese culture on Filipino traditions. Through talks and discussions, participants unraveled the rich tapestry woven from language and shared history. \r\nWe extend our gratitude to all who joined us in celebrating cultural exchange and building bridges of understanding. Your participation empowers us to continue to #BuildPeaceByPiece, where every piece contributes to a brighter, more culturally aware future. 🌐🕊️\r\n#TheSinophile2024', NULL, NULL, '2024-04-30 10:59:17', '2024-04-30 10:59:17', 'published', 'public', 0, 0),
(35, 13, 'As we reach the end of a school year filled with laughter, sweat, and tears, we hope that this journey implores you to come back here. May you always find yourself looking for Espanya, the place wherein all of our paths crossed.\r\nInspired by the composition of Selena Dela Cruz (sel), this is Para Po! with Peyt Gerone performing Meet Me in Espanya Boulevard. I hope you’re ready to take our hands as we savor this starry sky along the busy street.\r\n#Tin16ngMUSIKAT \r\nPerformed by: Peyt Gerone\r\nLyrics: Selene Dela Cruz\r\nCaption by: Kyla Baranda', NULL, NULL, '2024-04-30 11:00:11', '2024-04-30 11:00:11', 'published', 'public', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tagging`
--

CREATE TABLE `tagging` (
  `tagging_id` int(11) NOT NULL,
  `organization_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `tag_id` int(11) NOT NULL,
  `tag_name` varchar(128) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`tag_id`, `tag_name`, `is_deleted`) VALUES
(1, 'University Wide', 0),
(2, 'Media', 0),
(3, 'News', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(64) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `first_name` varchar(64) NOT NULL,
  `last_name` varchar(64) NOT NULL,
  `profile_picture_url` varchar(255) DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_deleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password_hash`, `first_name`, `last_name`, `profile_picture_url`, `is_admin`, `is_active`, `created_at`, `updated_at`, `is_deleted`) VALUES
(1, 'aiesec', 'aiesec@gmail.com', '$2y$12$he/Xxed8jRDpANzV3SNiVu7E8hjba2jgT7q8uOQwUSeP1p0cRiWsK', '', '', NULL, 0, 1, '2024-04-30 04:21:18', '2024-04-30 04:21:18', 0),
(2, 'fotomasino', 'fotomasino@gmail.com', '$2y$12$oVtOb3l/2tV4Lnu/NuSAuOBrFbIjkDnYeQyynu7dQKegNg0MojsXC', '', '', NULL, 0, 1, '2024-04-30 04:24:18', '2024-04-30 04:24:18', 0),
(3, 'tomasinoweb', 'tomweb@gmai.com', '$2y$12$ZZg3WHBVATyNYo/Gb2khaOFy0QMqEy.gH1mMeN5zIiLNrS5d3i8HO', '', '', NULL, 0, 1, '2024-04-30 04:25:55', '2024-04-30 04:25:55', 0),
(4, 'mountaineeringclub', 'ustmountainclub@gmail.com', '$2y$12$suvuYDmmnbJSGyLWSH8pZOT.mVdQ2.7niusv0Zm1CkSAACxHJaFGm', '', '', NULL, 0, 1, '2024-04-30 04:29:07', '2024-04-30 04:29:07', 0),
(5, 'becariosdesantotomas', 'ustbecarios@gmail.com', '$2y$12$g9e8.Wl4aPG2iogtvWJ0ZuUR5a0D0eSyLjhwNNMpH3zJ.EyrP7UzK', '', '', NULL, 0, 1, '2024-04-30 04:30:56', '2024-04-30 04:30:56', 0),
(6, 'debaterscouncil', 'debaterscouncil@gmail.com', '$2y$12$ykX5OCd30ziGC/3JNoHIZ.uGbTEHRLFLZCzlcWiAd8AnhHfqGqL2e', '', '', NULL, 0, 1, '2024-04-30 04:32:09', '2024-04-30 04:32:09', 0),
(7, 'ust_isa', 'ustisa@gmail.com', '$2y$12$5re2GD84kCbCpDZl7koPFuwUHGvQuBQapk08YmjJi0UME4HVUD3gm', '', '', NULL, 0, 1, '2024-04-30 04:35:28', '2024-04-30 04:35:28', 0),
(8, 'ust_espanaunited', 'espanaunited@gmail.com', '$2y$12$N8P7jnomDmjltftLom70ROIq00w0lZRGPWLEOfP5nHsmpxk1IHf8C', '', '', NULL, 0, 1, '2024-04-30 04:40:59', '2024-04-30 04:40:59', 0),
(9, 'film_society', 'filmsociety@gmail.com', '$2y$12$idjC856Om467mSep6x0eEehJ1tsIv5F0aknfJIlj3hiZT2VpjVVzS', '', '', NULL, 0, 1, '2024-04-30 04:42:45', '2024-04-30 04:42:45', 0),
(10, 'ust_fma', 'ustfma@gmai.com', '$2y$12$CFQ8GG04M1dLVsz29AB7Fe2sKc9HBl6a0ppXKALXDTOmpmAwWgbZG', '', '', NULL, 0, 1, '2024-04-30 04:44:22', '2024-04-30 04:44:22', 0),
(11, 'yoga_club', 'ustyoga@gmail.com', '$2y$12$wThNUF8phdphnv4Tof5zK.kIKa28Ij8.KOa0m9OoRhGvKl7k9oHvi', '', '', NULL, 0, 1, '2024-04-30 04:46:50', '2024-04-30 04:46:50', 0),
(12, 'yellow_jackets', 'yellowjacket@gmail.com', '$2y$12$5mcALVKJx2DlHefNSihWuuctUBYbmPh6HIs5avQ6TYsnfw.egCfJi', '', '', NULL, 0, 1, '2024-04-30 09:04:53', '2024-04-30 09:04:53', 0),
(13, 'musikat', 'musikat@gmail.com', '$2y$12$5VAqU646WVWA2PmWmo4EpObDBrSGdusAj4chjiGuERhKGmutnZGFW', '', '', NULL, 0, 1, '2024-04-30 09:06:11', '2024-04-30 09:06:11', 0),
(14, 'teatro_tomasino', 'teatro@gmail.com', '$2y$12$aAWr9leutcy7fuTcj0TaDev6Th8b0eb6STRC5ja3NBWthx.zoON5m', '', '', NULL, 0, 1, '2024-04-30 09:08:20', '2024-04-30 09:08:20', 0),
(15, 'salinggawi', 'salinggawi@gmail.com', '$2y$12$FplTNL913THuwrucC7eWUO6OnjbEui3jGMyfxmLMqHFgo5b1ye.Fe', '', '', NULL, 0, 1, '2024-04-30 09:10:24', '2024-04-30 09:10:24', 0),
(16, 'pax_romana', 'pasromana@gmail.com', '$2y$12$US1pyNd7hE5g27VEY0EBuuElwxhQyT2hcEiG2LunG2MBjTLmoriRi', '', '', NULL, 0, 1, '2024-04-30 09:11:35', '2024-04-30 09:11:35', 0),
(17, 'earth_ust', 'earthust@gmail.com', '$2y$12$NLAFHTd6yoqzd.EmoC1dpO0y8mXZXfAENluo7hO50rQlreRpCP/la', '', '', NULL, 0, 1, '2024-04-30 09:13:24', '2024-04-30 09:13:24', 0),
(18, 'unesco', 'unesco@gmail.com', '$2y$12$3lGaqed/tWhRo2rUnF3pVeGkDf66iWrKwcxkXSOhpsiGB4k8/M6AS', '', '', NULL, 0, 1, '2024-04-30 09:14:44', '2024-04-30 09:14:44', 0),
(19, 'kabayanihan', 'kabayanihan@gmail.com', '$2y$12$G5OG38vxRM2ARprDSzAFf..wpMJQXGe368eS4z3KKJEeAjz20bQYe', '', '', NULL, 0, 1, '2024-04-30 09:16:46', '2024-04-30 09:16:46', 0),
(20, 'red_cross', 'redcrossust@gmail.com', '$2y$12$5bx7DsBepRqUUFeIFFaEtOni3BKH0egFerqq0FCh28Sfhsq0PsTuy', '', '', NULL, 0, 1, '2024-04-30 09:18:46', '2024-04-30 09:18:46', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `organizations`
--
ALTER TABLE `organizations`
  ADD PRIMARY KEY (`org_id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `author_id` (`author_id`);

--
-- Indexes for table `tagging`
--
ALTER TABLE `tagging`
  ADD PRIMARY KEY (`tagging_id`),
  ADD KEY `organization_id` (`organization_id`),
  ADD KEY `tag_id` (`tag_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`tag_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `organizations`
--
ALTER TABLE `organizations`
  MODIFY `org_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tagging`
--
ALTER TABLE `tagging`
  MODIFY `tagging_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `tag_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`);

--
-- Constraints for table `organizations`
--
ALTER TABLE `organizations`
  ADD CONSTRAINT `organizations_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `organizations` (`org_id`);

--
-- Constraints for table `tagging`
--
ALTER TABLE `tagging`
  ADD CONSTRAINT `tagging_ibfk_1` FOREIGN KEY (`organization_id`) REFERENCES `organizations` (`org_id`),
  ADD CONSTRAINT `tagging_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`tag_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
