-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 10-11-2021 a las 00:56:22
-- Versión del servidor: 5.7.31
-- Versión de PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `myjob`
--

--
-- Volcado de datos para la tabla `privileges`
--

INSERT INTO `privileges` (`privilegeId`, `privilegeName`, `privilegeDescription`) VALUES
(1, 'admin', 'Cuenta Administrador global.'),
(2, 'student', 'Cuenta tipo Estudiante.'),
(3, 'empresa', 'Cuenta de Empresa, para cargar Ofertas Laborales propias y revisar postulaciones.');

--
-- Volcado de datos para la tabla `accounts`
--

INSERT INTO `accounts` (`accountId`, `email`, `password`, `privilegeId`) VALUES
(2, 'admin@myjob.com', '1234', 1),
(3, 'aknowlys17@unicef.org', '1234', 2);

--
-- Volcado de datos para la tabla `careers`
--

INSERT INTO `careers` (`careerId`, `description`, `active`) VALUES
(1, 'Naval engineering', '1'),
(2, 'Fishing engineering', ''),
(3, 'University technician in programming', '1'),
(4, 'University technician in computer systems', '1'),
(5, 'University technician in textile production', '1'),
(6, 'University technician in administration', '1'),
(7, 'Bachelor in environmental management', ''),
(8, 'University technician in environmental procedures and technologies', '1');

--
-- Volcado de datos para la tabla `companies`
--

INSERT INTO `companies` (`companyId`, `companyName`, `location`, `description`, `email`, `phoneNumber`, `cuit`) VALUES
(1, 'TEST', 'TEST LOC', 'TEST DESC', 'test@mail.com', '1234', 'cuit'),
(3, 'Test mod', 'Loc mod', 'Desc mod', 'mod@mail.com', '123456', '16890000');

--
-- Volcado de datos para la tabla `joboffers`
--

INSERT INTO `joboffers` (`offerId`, `companyId`, `offerDescription`, `enable`) VALUES
(22, 1, 'Programacion Java', 1);

--
-- Volcado de datos para la tabla `jobposition`
--

INSERT INTO `jobposition` (`jobPositionId`, `careerId`, `description`) VALUES
(1, 1, 'Jr naval engineer'),
(2, 1, 'Ssr naval engineer'),
(3, 1, 'Sr naval engineer'),
(4, 2, 'Jr fisheries engineer'),
(5, 2, 'Ssr fisheries engineer'),
(6, 2, 'Sr fisheries engineer'),
(7, 3, 'Java Jr developer'),
(8, 3, 'PHP Jr developer'),
(9, 3, 'Ssr developer'),
(10, 4, 'Full Stack developer'),
(11, 4, 'Sr developer'),
(12, 4, 'Project manager'),
(13, 4, 'Scrum Master'),
(14, 5, 'Jr textile operator'),
(15, 5, 'Textile production assistant manager'),
(16, 5, 'Textile design assistant'),
(17, 5, 'Textile production supervisor'),
(18, 6, 'Head of administration'),
(19, 6, 'Management analyst'),
(20, 6, 'Administration intern'),
(21, 7, 'Environmental management specialist'),
(22, 7, 'Environmental management coordinator'),
(23, 8, 'Received technician');

--
-- Volcado de datos para la tabla `offersxposition`
--

INSERT INTO `offersxposition` (`offerId`, `jobPositionId`) VALUES
(22, 7);


--
-- Volcado de datos para la tabla `students`
--

INSERT INTO `students` (`studentId`, `careerId`, `firstName`, `lastName`, `dni`, `fileNumber`, `gender`, `birthdate`, `email`, `phoneNumber`, `active`) VALUES
(0, 7, 'Admin', 'Admin', '0', '0', 'N/A', '2021-11-01', 'admin@myjob.com', '0', '1'),
(1, 2, 'Devlen', 'Douthwaite', '15-992-8607', '33-059-4172', 'Genderqueer', '2021-06-28', 'ddouthwaite0@goo.gl', '849-713-4523', ''),
(2, 5, 'Wyatan', 'Lorant', '63-025-8112', '01-777-6891', 'Non-binary', '2021-02-23', 'wlorant1@sbwire.com', '171-448-9062', '1'),
(3, 2, 'Alanson', 'Seemmonds', '06-684-0100', '89-621-0940', 'Agender', '2021-07-03', 'aseemmonds2@upenn.edu', '961-404-8720', '1'),
(4, 5, 'Elvin', 'Diben', '25-552-7065', '72-302-2293', 'Agender', '2020-09-29', 'ediben3@multiply.com', '337-480-1652', '1'),
(5, 2, 'Darsey', 'Hasely', '38-798-8629', '74-942-1063', 'Bigender', '2021-03-14', 'dhasely4@blinklist.com', '936-600-0486', ''),
(6, 4, 'Whitby', 'Alelsandrowicz', '85-506-8427', '33-525-2139', 'Male', '2020-09-25', 'walelsandrowicz5@nasa.gov', '328-137-1386', ''),
(7, 3, 'Kienan', 'Witheford', '03-800-8262', '54-465-2736', 'Bigender', '2021-09-15', 'kwitheford6@salon.com', '525-769-1695', ''),
(8, 5, 'Isidor', 'Aberdalgy', '26-149-2035', '10-592-5767', 'Bigender', '2021-09-06', 'iaberdalgy7@mlb.com', '977-660-8938', '1'),
(9, 5, 'Grier', 'Castle', '53-191-5001', '78-163-9543', 'Polygender', '2021-08-30', 'gcastle8@hexun.com', '904-335-2660', ''),
(10, 4, 'Son', 'Forrington', '62-447-4424', '35-472-8050', 'Male', '2021-03-13', 'sforrington9@webnode.com', '720-205-4748', '1'),
(11, 2, 'Sapphire', 'Jantet', '86-635-3442', '91-868-3364', 'Bigender', '2021-03-14', 'sjanteta@businessinsider.com', '860-103-9915', '1'),
(12, 3, 'Jori', 'Doring', '81-077-9856', '33-975-9864', 'Polygender', '2021-04-12', 'jdoringb@un.org', '414-609-3692', '1'),
(13, 2, 'Jamey', 'Yaxley', '50-772-8315', '24-567-9387', 'Genderqueer', '2021-03-09', 'jyaxleyc@ifeng.com', '595-862-1690', ''),
(14, 2, 'Sasha', 'Laxson', '05-910-7081', '08-912-7616', 'Agender', '2020-10-02', 'slaxsond@squarespace.com', '174-737-9358', '1'),
(15, 5, 'Bartholomew', 'Van Daalen', '25-669-1408', '11-262-4955', 'Genderqueer', '2021-06-24', 'bvandaalene@sphinn.com', '267-278-5971', '1'),
(16, 2, 'Annamaria', 'Crannage', '56-601-9741', '95-936-4021', 'Female', '2021-08-09', 'acrannagef@baidu.com', '126-254-6195', '1'),
(17, 1, 'Frayda', 'Gorvette', '52-405-2882', '53-197-9431', 'Non-binary', '2021-07-05', 'fgorvetteg@list-manage.com', '152-846-1928', '1'),
(18, 2, 'Ondrea', 'Webburn', '92-770-5792', '02-206-7209', 'Non-binary', '2021-08-19', 'owebburnh@google.co.uk', '598-324-4986', '1'),
(19, 2, 'Talia', 'Petersen', '66-290-7595', '84-618-3667', 'Female', '2021-05-11', 'tpeterseni@nydailynews.com', '138-603-2531', '1'),
(20, 5, 'Judie', 'Brunton', '39-063-5733', '12-434-6814', 'Bigender', '2020-09-27', 'jbruntonj@imageshack.us', '241-206-2755', ''),
(21, 4, 'Lara', 'Syne', '58-550-2198', '39-904-8155', 'Agender', '2020-10-19', 'lsynek@msn.com', '812-829-3352', '1'),
(22, 4, 'Theda', 'Thompstone', '19-852-1865', '03-183-4879', 'Female', '2021-02-06', 'tthompstonel@unblog.fr', '581-862-8307', '1'),
(23, 4, 'Marline', 'Vasilischev', '55-935-5268', '79-667-0861', 'Genderfluid', '2021-09-15', 'mvasilischevm@123-reg.co.uk', '758-919-0671', '1'),
(24, 1, 'Kyrstin', 'Heisman', '56-875-3900', '81-773-1201', 'Non-binary', '2021-05-07', 'kheismann@purevolume.com', '687-607-3859', ''),
(25, 1, 'Brande', 'Strivens', '10-415-4568', '03-288-3176', 'Female', '2021-02-17', 'bstrivenso@surveymonkey.com', '411-285-2703', '1'),
(26, 2, 'Rhodia', 'Haller', '54-718-3009', '14-068-8546', 'Bigender', '2021-09-07', 'rhallerp@free.fr', '964-943-9988', ''),
(27, 1, 'Russell', 'Geipel', '18-120-5229', '17-465-9316', 'Agender', '2020-10-27', 'rgeipelq@jugem.jp', '533-522-7527', '1'),
(28, 1, 'Hersch', 'Sellen', '85-567-9313', '37-427-4216', 'Genderqueer', '2021-04-16', 'hsellenr@nba.com', '425-253-5570', '1'),
(29, 4, 'Mace', 'Bromidge', '47-216-4336', '50-791-3614', 'Non-binary', '2021-02-05', 'mbromidges@smugmug.com', '306-431-3867', '1'),
(30, 5, 'Harrison', 'Bettington', '75-405-0292', '88-914-6490', 'Male', '2021-08-07', 'hbettingtont@marketwatch.com', '543-608-6067', '1'),
(31, 3, 'Kasey', 'Littrik', '00-985-8419', '62-630-2141', 'Female', '2021-08-09', 'klittriku@army.mil', '776-195-5544', ''),
(32, 5, 'Irina', 'Simukov', '32-573-1282', '88-687-1314', 'Genderfluid', '2020-10-12', 'isimukovv@bbc.co.uk', '415-385-0195', ''),
(33, 1, 'Cassie', 'Fysh', '35-351-0827', '56-782-5125', 'Male', '2021-06-21', 'cfyshw@mysql.com', '682-889-8851', '1'),
(34, 2, 'Marris', 'Danzelman', '09-071-3281', '12-547-6971', 'Non-binary', '2021-05-22', 'mdanzelmanx@hhs.gov', '847-391-5838', ''),
(35, 1, 'Wakefield', 'Dalla', '73-109-6355', '14-119-6620', 'Male', '2021-03-04', 'wdallay@printfriendly.com', '767-735-0534', ''),
(36, 5, 'Peg', 'Johnes', '66-498-0795', '37-124-3528', 'Agender', '2021-06-03', 'pjohnesz@columbia.edu', '945-808-3754', ''),
(37, 4, 'Kizzee', 'Offiler', '00-350-8372', '65-561-6794', 'Agender', '2020-11-20', 'koffiler10@youku.com', '703-628-6849', ''),
(38, 2, 'Beret', 'Poyner', '50-644-3386', '55-624-8806', 'Bigender', '2021-08-14', 'bpoyner11@php.net', '688-583-4742', '1'),
(39, 4, 'Obadias', 'Louys', '42-393-7383', '06-636-3057', 'Genderfluid', '2021-04-26', 'olouys12@army.mil', '365-275-7347', '1'),
(40, 2, 'Sharia', 'Leary', '64-212-3162', '82-352-5322', 'Female', '2020-11-01', 'sleary13@eventbrite.com', '343-120-7321', ''),
(41, 1, 'Bunny', 'Benham', '27-441-6898', '48-815-4694', 'Polygender', '2020-10-17', 'bbenham14@vimeo.com', '971-848-4265', ''),
(42, 2, 'Gifford', 'McGarel', '24-962-3779', '66-009-1027', 'Female', '2021-03-11', 'gmcgarel15@disqus.com', '371-171-1943', '1'),
(43, 5, 'Katharyn', 'O\'Donoghue', '34-717-4988', '69-347-5652', 'Female', '2020-09-29', 'kodonoghue16@vinaora.com', '675-855-8792', ''),
(44, 1, 'Alexi', 'Knowlys', '95-474-3336', '54-353-9100', 'Female', '2021-03-30', 'aknowlys17@unicef.org', '647-835-8682', ''),
(45, 5, 'Marven', 'Spilsbury', '76-803-4887', '85-269-7940', 'Genderqueer', '2021-01-29', 'mspilsbury18@gravatar.com', '161-726-5357', '1'),
(46, 3, 'Esme', 'Atyeo', '96-988-1544', '38-142-7695', 'Genderqueer', '2021-01-19', 'eatyeo19@nba.com', '604-138-2728', ''),
(47, 2, 'Gunner', 'Hilland', '10-527-6911', '88-082-1221', 'Agender', '2021-04-28', 'ghilland1a@mit.edu', '708-702-4402', ''),
(48, 1, 'Dorie', 'Philot', '65-663-7022', '97-850-8234', 'Polygender', '2021-08-11', 'dphilot1b@kickstarter.com', '168-403-8062', '1'),
(49, 4, 'Yance', 'Raynham', '79-563-1656', '32-436-9734', 'Female', '2020-11-05', 'yraynham1c@studiopress.com', '369-540-5290', '1'),
(50, 2, 'Gerick', 'Hruska', '57-616-0361', '38-515-6811', 'Polygender', '2021-07-31', 'ghruska1d@zimbio.com', '375-200-9564', '1'),
(51, 5, 'Morgen', 'Labroue', '44-168-7059', '73-482-8968', 'Non-binary', '2020-12-05', 'mlabroue1e@webeden.co.uk', '254-542-2439', '1'),
(52, 4, 'Calypso', 'Snelgar', '36-361-0619', '55-775-2711', 'Genderfluid', '2021-05-29', 'csnelgar1f@etsy.com', '511-192-9263', '1'),
(53, 4, 'Zach', 'Jurek', '99-564-0350', '12-139-7717', 'Male', '2021-07-23', 'zjurek1g@indiegogo.com', '772-700-7304', '1'),
(54, 5, 'Darwin', 'Michurin', '53-383-1667', '43-721-4748', 'Genderfluid', '2021-08-25', 'dmichurin1h@msn.com', '571-480-7716', ''),
(55, 1, 'Eba', 'Jeskins', '59-545-5484', '64-591-5018', 'Male', '2021-06-15', 'ejeskins1i@forbes.com', '628-593-0925', ''),
(56, 1, 'Weidar', 'Yaxley', '58-116-6555', '16-838-4289', 'Female', '2021-01-22', 'wyaxley1j@cargocollective.com', '319-587-6296', ''),
(57, 5, 'Thornie', 'Bassam', '62-194-8628', '21-891-4548', 'Polygender', '2021-04-15', 'tbassam1k@rediff.com', '847-461-4910', '1'),
(58, 2, 'Fran', 'Beardsley', '10-540-6091', '41-167-5649', 'Polygender', '2021-07-18', 'fbeardsley1l@berkeley.edu', '128-308-3463', ''),
(59, 2, 'Balduin', 'Sooper', '29-897-9350', '12-921-6540', 'Polygender', '2021-03-31', 'bsooper1m@nba.com', '649-524-7466', ''),
(60, 4, 'Binky', 'Snoden', '78-390-7971', '23-149-3759', 'Male', '2021-09-22', 'bsnoden1n@nydailynews.com', '901-495-3237', '1'),
(61, 5, 'Melody', 'Avrahamy', '60-142-1673', '21-124-2118', 'Bigender', '2021-03-28', 'mavrahamy1o@mapy.cz', '186-463-5122', ''),
(62, 2, 'Maryjane', 'Haestier', '76-067-9131', '35-282-6033', 'Genderfluid', '2020-11-29', 'mhaestier1p@constantcontact.com', '118-132-5905', '1'),
(63, 1, 'Annissa', 'Dobing', '10-164-5517', '22-535-5443', 'Genderqueer', '2020-12-30', 'adobing1q@hostgator.com', '649-157-3136', '1'),
(64, 4, 'Gerry', 'Hullett', '86-004-0723', '43-219-7854', 'Non-binary', '2020-12-16', 'ghullett1r@smugmug.com', '966-302-3954', '1'),
(65, 5, 'Karlis', 'Izkovitz', '67-119-9198', '63-861-4472', 'Genderfluid', '2021-05-11', 'kizkovitz1s@mac.com', '262-601-0659', '1'),
(66, 4, 'Tadeo', 'Shears', '74-609-6611', '41-369-0776', 'Male', '2020-11-12', 'tshears1t@icq.com', '303-218-7999', '1'),
(67, 3, 'Aymer', 'Bruineman', '98-226-6801', '93-817-8854', 'Agender', '2020-12-18', 'abruineman1u@typepad.com', '469-982-7985', '1'),
(68, 4, 'Neel', 'Yven', '55-697-8917', '68-993-1573', 'Agender', '2020-12-04', 'nyven1v@unicef.org', '106-171-8503', ''),
(69, 4, 'Star', 'Annis', '09-226-3608', '89-705-6139', 'Bigender', '2021-04-30', 'sannis1w@cnn.com', '145-198-0335', '1'),
(70, 1, 'Giorgi', 'Brabyn', '34-540-7376', '18-444-2364', 'Bigender', '2021-08-28', 'gbrabyn1x@moonfruit.com', '969-271-8721', '1'),
(71, 1, 'Betsey', 'Glanfield', '88-525-8376', '84-757-3128', 'Bigender', '2021-03-12', 'bglanfield1y@globo.com', '903-991-3132', '1'),
(72, 4, 'Travus', 'Stuehmeier', '35-742-8601', '68-172-2695', 'Polygender', '2021-06-19', 'tstuehmeier1z@privacy.gov.au', '901-727-3778', '1'),
(73, 1, 'Tadio', 'Millmoe', '88-893-2722', '33-618-8629', 'Polygender', '2021-09-16', 'tmillmoe20@blogspot.com', '992-568-7663', ''),
(74, 1, 'Antonie', 'Gannicleff', '27-309-8937', '60-009-1885', 'Agender', '2020-10-03', 'agannicleff21@livejournal.com', '858-907-0753', ''),
(75, 1, 'Gonzalo', 'De Pietri', '68-043-2945', '87-204-8612', 'Non-binary', '2020-10-06', 'gdepietri22@github.io', '607-464-2013', ''),
(76, 5, 'Pammie', 'Friman', '37-754-2476', '67-938-9169', 'Bigender', '2020-11-12', 'pfriman23@columbia.edu', '492-691-2537', '1'),
(77, 2, 'Tracie', 'Vreiberg', '42-052-8183', '29-967-0800', 'Bigender', '2021-07-14', 'tvreiberg24@state.tx.us', '569-585-2167', ''),
(78, 1, 'Trixy', 'Beagles', '25-872-3664', '74-689-8562', 'Agender', '2021-05-31', 'tbeagles25@gov.uk', '994-971-1461', ''),
(79, 4, 'Aidan', 'McGlashan', '18-411-2776', '46-317-0352', 'Agender', '2020-10-11', 'amcglashan26@washingtonpost.com', '488-672-3631', '1'),
(80, 4, 'Rudiger', 'Bainbridge', '62-199-1596', '28-240-8118', 'Bigender', '2021-02-10', 'rbainbridge27@delicious.com', '614-601-7046', '1'),
(81, 5, 'Zaria', 'Shepley', '58-348-3702', '28-462-9986', 'Bigender', '2021-07-22', 'zshepley28@typepad.com', '902-436-1480', '1'),
(82, 1, 'Linnie', 'Jocic', '62-388-7682', '86-862-4199', 'Polygender', '2021-01-15', 'ljocic29@economist.com', '356-793-8759', '1'),
(83, 1, 'Charleen', 'Waylen', '29-994-0636', '45-357-4109', 'Non-binary', '2021-06-22', 'cwaylen2a@princeton.edu', '526-290-6310', '1'),
(84, 3, 'Kelbee', 'de Vaen', '38-139-8480', '18-608-5372', 'Genderfluid', '2021-04-27', 'kdevaen2b@usgs.gov', '640-502-4617', ''),
(85, 4, 'Rafe', 'Reckhouse', '45-903-5831', '56-006-5079', 'Female', '2021-08-07', 'rreckhouse2c@cnn.com', '101-527-3576', '1'),
(86, 5, 'Beverie', 'Gilby', '21-203-5420', '87-120-3569', 'Female', '2021-05-23', 'bgilby2d@usda.gov', '696-388-0069', ''),
(87, 1, 'Calli', 'Sutliff', '81-223-5987', '24-142-8372', 'Agender', '2021-06-22', 'csutliff2e@ihg.com', '925-140-1998', ''),
(88, 2, 'Milissent', 'Devil', '81-313-1293', '32-589-2586', 'Non-binary', '2021-01-17', 'mdevil2f@ox.ac.uk', '248-921-6676', '1'),
(89, 5, 'Ursuline', 'Eighteen', '46-217-6852', '69-005-9170', 'Male', '2021-02-28', 'ueighteen2g@twitpic.com', '820-769-0779', ''),
(90, 5, 'Tildy', 'Turmall', '41-971-2001', '67-921-6899', 'Genderfluid', '2020-09-25', 'tturmall2h@newsvine.com', '488-931-4301', '1'),
(91, 1, 'Bert', 'Blew', '39-342-8776', '95-177-6741', 'Male', '2020-09-26', 'bblew2i@biglobe.ne.jp', '828-834-1196', '1'),
(92, 4, 'Jennilee', 'Sabathe', '18-651-6841', '10-493-7587', 'Agender', '2021-05-22', 'jsabathe2j@studiopress.com', '721-457-9122', ''),
(93, 3, 'Ethelyn', 'Zipsell', '20-882-4129', '55-525-2441', 'Genderfluid', '2020-11-27', 'ezipsell2k@nymag.com', '188-708-3056', '1'),
(94, 5, 'Skyler', 'Whiteside', '59-003-2764', '49-686-3258', 'Genderqueer', '2020-11-27', 'swhiteside2l@pbs.org', '967-927-0327', '1'),
(95, 4, 'Franchot', 'Stave', '62-422-4180', '30-036-6424', 'Male', '2021-03-26', 'fstave2m@ezinearticles.com', '399-493-0794', ''),
(96, 1, 'Bettine', 'Tonner', '20-726-8355', '76-080-0156', 'Non-binary', '2020-12-29', 'btonner2n@diigo.com', '120-371-4961', ''),
(97, 4, 'Antons', 'Colaco', '09-249-2880', '65-819-1309', 'Female', '2021-07-31', 'acolaco2o@shop-pro.jp', '425-810-4447', ''),
(98, 5, 'Esdras', 'Dalgety', '89-007-8770', '66-144-4859', 'Genderqueer', '2021-07-03', 'edalgety2p@cornell.edu', '829-518-6610', '1'),
(99, 4, 'Kathlin', 'Bonnett', '78-552-3269', '96-205-4001', 'Male', '2021-09-16', 'kbonnett2q@tmall.com', '627-902-1623', '1'),
(100, 4, 'Fredia', 'Deave', '11-441-4898', '96-326-1265', 'Genderfluid', '2021-05-28', 'fdeave2r@wix.com', '826-543-3453', ''),
(101, 5, 'Read', 'Crimp', '87-834-8894', '74-901-6933', 'Polygender', '2021-07-20', 'rcrimp2s@posterous.com', '300-596-9167', '1'),
(102, 1, 'Ermin', 'Goves', '42-485-4826', '10-239-4188', 'Polygender', '2021-07-19', 'egoves2t@squarespace.com', '988-703-4660', '1'),
(103, 2, 'Boyd', 'Scemp', '15-881-6261', '29-345-6105', 'Genderfluid', '2021-07-20', 'bscemp2u@tumblr.com', '687-360-6606', ''),
(104, 1, 'Kareem', 'Burn', '28-005-8149', '31-490-5520', 'Male', '2021-09-02', 'kburn2v@arstechnica.com', '530-613-3865', ''),
(105, 5, 'Leo', 'Spight', '17-631-6882', '95-631-7310', 'Male', '2021-08-15', 'lspight2w@examiner.com', '242-192-0925', '1'),
(106, 5, 'Herve', 'Bradder', '18-818-7495', '44-907-1587', 'Non-binary', '2021-03-27', 'hbradder2x@ibm.com', '344-574-1632', ''),
(107, 4, 'Lynea', 'Hunn', '88-822-0968', '85-500-3797', 'Non-binary', '2021-06-07', 'lhunn2y@cbslocal.com', '313-213-0165', ''),
(108, 3, 'Bibbie', 'Hamilton', '84-349-3365', '39-217-2262', 'Female', '2020-11-24', 'bhamilton2z@ezinearticles.com', '550-811-8535', ''),
(109, 1, 'Liana', 'Cockill', '26-554-7121', '37-166-9957', 'Polygender', '2021-08-16', 'lcockill30@time.com', '296-278-1935', '1'),
(110, 4, 'Natty', 'Southwick', '50-122-3261', '34-182-4645', 'Bigender', '2021-07-12', 'nsouthwick31@cargocollective.com', '881-814-3989', '1'),
(111, 3, 'Aluin', 'Petran', '69-860-0534', '65-563-6003', 'Bigender', '2020-11-05', 'apetran32@yahoo.com', '917-438-0078', ''),
(112, 2, 'Dudley', 'Shilburne', '96-041-8460', '05-679-4274', 'Genderfluid', '2021-05-03', 'dshilburne33@zimbio.com', '975-792-2824', '1'),
(113, 2, 'Malvin', 'Delhay', '74-274-5418', '73-428-3528', 'Genderqueer', '2021-01-04', 'mdelhay34@irs.gov', '815-902-4143', ''),
(114, 1, 'Melisent', 'Sket', '10-248-4079', '95-475-2212', 'Non-binary', '2021-06-02', 'msket35@dmoz.org', '131-365-3935', '1'),
(115, 4, 'Mair', 'Kowalski', '65-226-9222', '62-103-3224', 'Bigender', '2021-08-12', 'mkowalski36@hc360.com', '875-401-6852', ''),
(116, 2, 'Claudetta', 'Flewan', '07-965-3438', '03-750-9558', 'Agender', '2021-08-21', 'cflewan37@rediff.com', '116-810-7043', ''),
(117, 1, 'Tirrell', 'Ethelston', '43-174-9121', '72-210-0819', 'Female', '2021-07-20', 'tethelston38@samsung.com', '271-502-2244', '1'),
(118, 5, 'Darby', 'De Simoni', '93-158-6861', '49-338-9453', 'Bigender', '2020-12-06', 'ddesimoni39@surveymonkey.com', '246-502-4545', '1'),
(119, 2, 'Hannis', 'Antic', '73-517-4123', '65-438-1299', 'Female', '2021-06-14', 'hantic3a@fotki.com', '635-152-6564', ''),
(120, 2, 'Tadeo', 'Turbayne', '14-771-9346', '54-464-9719', 'Female', '2021-05-28', 'tturbayne3b@apache.org', '323-395-0040', '1'),
(121, 1, 'Filip', 'Bilam', '18-228-9435', '13-229-2329', 'Agender', '2021-08-20', 'fbilam3c@auda.org.au', '396-536-7478', ''),
(122, 3, 'Betteanne', 'Honnicott', '98-149-3242', '08-935-9559', 'Bigender', '2021-05-10', 'bhonnicott3d@amazon.de', '996-124-9094', ''),
(123, 5, 'Winny', 'Rawne', '11-079-3587', '18-968-5100', 'Bigender', '2021-08-04', 'wrawne3e@phpbb.com', '784-509-5500', '1'),
(124, 5, 'Tomlin', 'Chessum', '34-259-8750', '01-333-9701', 'Male', '2021-09-19', 'tchessum3f@chicagotribune.com', '981-831-1449', ''),
(125, 2, 'Koralle', 'Iddison', '40-064-3739', '24-045-4306', 'Male', '2020-11-12', 'kiddison3g@usnews.com', '418-438-4982', '1'),
(126, 5, 'Cookie', 'Le Grice', '52-779-7702', '27-657-1786', 'Male', '2021-09-07', 'clegrice3h@parallels.com', '642-929-9923', ''),
(127, 4, 'Dorthea', 'Kinkead', '69-441-2879', '22-855-5734', 'Male', '2020-09-29', 'dkinkead3i@tinypic.com', '478-475-7057', ''),
(128, 5, 'Howey', 'Bruckstein', '36-375-1786', '29-625-4160', 'Bigender', '2020-12-30', 'hbruckstein3j@ow.ly', '610-756-6491', ''),
(129, 4, 'Ignace', 'Mansfield', '43-252-7384', '61-347-2997', 'Female', '2021-08-22', 'imansfield3k@amazonaws.com', '485-876-5605', '1'),
(130, 5, 'Nehemiah', 'Metzke', '98-360-6184', '00-662-8748', 'Genderqueer', '2021-06-11', 'nmetzke3l@cargocollective.com', '876-319-3747', ''),
(131, 1, 'Lynea', 'Littlechild', '89-529-1236', '83-753-8548', 'Male', '2021-06-25', 'llittlechild3m@europa.eu', '460-395-6975', '1'),
(132, 3, 'Velma', 'Iacofo', '84-140-0452', '04-568-9958', 'Bigender', '2021-02-17', 'viacofo3n@github.com', '153-170-3448', '1'),
(133, 5, 'Leland', 'Choulerton', '74-357-2371', '27-824-3328', 'Female', '2021-03-07', 'lchoulerton3o@cyberchimps.com', '387-858-5444', '1'),
(134, 5, 'Rodrick', 'D\'Alessio', '27-650-9424', '63-066-5352', 'Male', '2021-04-27', 'rdalessio3p@prnewswire.com', '371-769-6875', '1'),
(135, 1, 'Rosalynd', 'Gouny', '76-645-7890', '65-966-7526', 'Male', '2021-04-01', 'rgouny3q@yellowbook.com', '146-632-7102', '1'),
(136, 3, 'Hermon', 'Crudgington', '02-484-6356', '20-288-6768', 'Male', '2020-11-02', 'hcrudgington3r@aboutads.info', '214-172-6385', '1'),
(137, 5, 'Ranique', 'Bonus', '37-114-5910', '37-079-2819', 'Bigender', '2020-10-03', 'rbonus3s@cnn.com', '530-875-5915', '1'),
(138, 1, 'Genni', 'Fish', '73-715-2378', '37-767-3256', 'Genderqueer', '2021-04-06', 'gfish3t@shutterfly.com', '250-677-4442', ''),
(139, 2, 'Fredericka', 'Goodey', '92-340-3593', '85-154-3741', 'Genderfluid', '2021-01-16', 'fgoodey3u@bandcamp.com', '260-141-9667', ''),
(140, 1, 'Gabey', 'Scoggan', '37-206-0317', '01-266-7037', 'Agender', '2020-11-26', 'gscoggan3v@t.co', '924-769-3310', '1'),
(141, 2, 'Luciana', 'Penburton', '46-638-6239', '31-641-2632', 'Genderqueer', '2021-09-15', 'lpenburton3w@joomla.org', '344-134-4871', '1'),
(142, 4, 'Eugen', 'Dunphy', '65-917-4177', '52-000-5371', 'Polygender', '2021-03-11', 'edunphy3x@census.gov', '165-945-4956', ''),
(143, 3, 'Gertrudis', 'McGillivray', '12-086-3270', '18-324-1690', 'Genderqueer', '2021-06-12', 'gmcgillivray3y@mediafire.com', '833-449-3661', '1'),
(144, 4, 'Yvor', 'Tucknott', '70-198-7705', '19-067-9789', 'Agender', '2021-01-21', 'ytucknott3z@sogou.com', '370-149-7338', ''),
(145, 3, 'Adelle', 'Rilton', '67-791-3398', '00-384-7022', 'Genderqueer', '2021-09-24', 'arilton40@merriam-webster.com', '483-562-7792', ''),
(146, 3, 'Saudra', 'Strongman', '29-136-1427', '38-472-1498', 'Genderqueer', '2020-11-25', 'sstrongman41@skype.com', '961-561-9646', ''),
(147, 1, 'Gracie', 'Webb-Bowen', '83-459-8976', '49-625-9194', 'Agender', '2021-03-14', 'gwebbbowen42@t.co', '836-256-7957', ''),
(148, 3, 'Becki', 'Mullen', '68-837-1664', '78-974-4731', 'Polygender', '2021-01-26', 'bmullen43@last.fm', '641-224-2494', '1'),
(149, 2, 'Swen', 'Thirst', '43-665-3998', '90-311-6551', 'Female', '2020-10-30', 'sthirst44@comsenz.com', '797-402-2816', '1'),
(150, 3, 'Issie', 'Gainforth', '98-422-8559', '33-371-4463', 'Genderfluid', '2021-09-15', 'igainforth45@hubpages.com', '670-349-1455', ''),
(151, 4, 'Kaycee', 'Morfell', '91-629-3136', '19-896-4066', 'Bigender', '2021-08-23', 'kmorfell46@slate.com', '915-593-9589', '1'),
(152, 5, 'Jessie', 'Fakeley', '55-654-9243', '79-554-6935', 'Non-binary', '2021-02-01', 'jfakeley47@ning.com', '807-724-1840', '1'),
(153, 4, 'Dania', 'Lebbon', '09-468-6894', '55-835-4033', 'Genderqueer', '2021-02-23', 'dlebbon48@virginia.edu', '970-161-7429', ''),
(154, 2, 'Robinson', 'Delamere', '97-037-8971', '41-837-7291', 'Agender', '2021-01-08', 'rdelamere49@mtv.com', '459-182-2906', ''),
(155, 2, 'Letta', 'Costall', '80-792-0881', '34-789-5341', 'Female', '2021-05-04', 'lcostall4a@alibaba.com', '107-342-4871', '1'),
(156, 2, 'Billie', 'Cherrett', '92-009-1789', '54-307-6384', 'Bigender', '2021-05-24', 'bcherrett4b@aboutads.info', '663-263-2110', ''),
(157, 5, 'Mannie', 'Stone', '14-352-2736', '39-968-5681', 'Female', '2020-10-13', 'mstone4c@infoseek.co.jp', '821-347-9937', '1'),
(158, 2, 'Yance', 'Henrique', '32-938-0805', '55-146-9643', 'Female', '2021-03-03', 'yhenrique4d@wired.com', '238-174-5782', '1'),
(159, 1, 'Willabella', 'Mc Harg', '40-113-7018', '00-339-2412', 'Genderqueer', '2021-04-18', 'wmcharg4e@reddit.com', '848-998-3882', ''),
(160, 1, 'Stoddard', 'Brittlebank', '94-833-3478', '07-129-5052', 'Polygender', '2021-03-09', 'sbrittlebank4f@cornell.edu', '616-391-9245', ''),
(161, 3, 'Grayce', 'Autin', '60-273-7013', '43-799-0146', 'Polygender', '2021-07-01', 'gautin4g@ucoz.com', '615-247-7087', '1'),
(162, 2, 'Caritta', 'Vaudin', '39-815-8919', '99-549-1853', 'Polygender', '2021-06-25', 'cvaudin4h@businesswire.com', '549-755-1391', '1'),
(163, 3, 'Riki', 'Wasselin', '94-012-0879', '23-600-7156', 'Agender', '2021-04-05', 'rwasselin4i@theguardian.com', '369-853-4412', ''),
(164, 2, 'Betsy', 'Skrzynski', '09-812-0539', '39-523-5583', 'Genderqueer', '2021-07-29', 'bskrzynski4j@feedburner.com', '612-173-5472', '1'),
(165, 5, 'Zachariah', 'Farrans', '51-857-0902', '07-445-2822', 'Polygender', '2020-11-13', 'zfarrans4k@forbes.com', '814-918-8343', ''),
(166, 2, 'Brewster', 'Pouton', '95-706-1796', '43-026-8607', 'Male', '2020-12-09', 'bpouton4l@yellowpages.com', '616-120-6191', ''),
(167, 3, 'Sal', 'Goncaves', '87-220-5041', '16-859-5157', 'Polygender', '2021-08-18', 'sgoncaves4m@symantec.com', '599-511-2518', ''),
(168, 4, 'Kareem', 'McIlmorow', '47-548-5627', '96-294-5274', 'Female', '2021-08-12', 'kmcilmorow4n@yandex.ru', '650-134-2767', '1'),
(169, 3, 'Jenda', 'Carlens', '63-318-6489', '72-850-0514', 'Polygender', '2021-03-23', 'jcarlens4o@google.ca', '146-586-2597', '1'),
(170, 2, 'Ruthy', 'Airdrie', '94-620-4481', '67-279-4974', 'Female', '2020-09-27', 'rairdrie4p@topsy.com', '770-417-6639', '1'),
(171, 4, 'Araldo', 'Nannoni', '05-894-8126', '91-023-4061', 'Genderqueer', '2021-05-02', 'anannoni4q@vimeo.com', '811-955-4367', '1'),
(172, 2, 'Angie', 'Dyas', '71-260-6905', '21-236-1999', 'Male', '2021-04-13', 'adyas4r@earthlink.net', '831-473-4363', '1'),
(173, 5, 'Sheelagh', 'Flindall', '49-368-8757', '18-199-4853', 'Female', '2021-05-20', 'sflindall4s@mediafire.com', '283-860-7535', ''),
(174, 5, 'Jarid', 'Tidridge', '13-917-7108', '08-056-8848', 'Agender', '2021-06-15', 'jtidridge4t@posterous.com', '176-889-1935', ''),
(175, 2, 'Syman', 'Dowglass', '90-232-2089', '70-209-1549', 'Female', '2021-07-30', 'sdowglass4u@foxnews.com', '529-675-9277', '1'),
(176, 2, 'Norine', 'Brimelow', '31-723-5197', '92-015-6747', 'Bigender', '2021-06-10', 'nbrimelow4v@pagesperso-orange.fr', '265-863-6907', ''),
(177, 3, 'Rudolf', 'Szymonwicz', '60-389-1389', '10-694-8782', 'Bigender', '2021-09-03', 'rszymonwicz4w@who.int', '545-893-1140', ''),
(178, 5, 'Ricky', 'Runnacles', '67-524-8267', '57-514-5477', 'Bigender', '2021-09-13', 'rrunnacles4x@tripadvisor.com', '676-627-8556', ''),
(179, 4, 'Kimberly', 'Piris', '74-384-3757', '24-114-0974', 'Bigender', '2021-01-03', 'kpiris4y@chicagotribune.com', '121-697-3551', ''),
(180, 1, 'Harman', 'Eckery', '73-212-2596', '49-545-3644', 'Polygender', '2021-05-25', 'heckery4z@businessweek.com', '731-857-3248', ''),
(181, 1, 'Antoni', 'Braiden', '50-498-1142', '99-011-5885', 'Polygender', '2021-03-10', 'abraiden50@hibu.com', '177-622-7559', '1'),
(182, 4, 'Sebastien', 'Blaisdell', '98-669-8860', '60-439-8182', 'Male', '2020-12-14', 'sblaisdell51@jiathis.com', '536-262-5430', '1'),
(183, 2, 'Aubrey', 'Evanson', '76-629-6090', '61-657-0563', 'Genderqueer', '2021-07-09', 'aevanson52@icq.com', '427-902-6345', ''),
(184, 5, 'Rorke', 'Ramos', '85-144-7566', '55-605-9390', 'Genderqueer', '2021-01-10', 'rramos53@ucla.edu', '178-560-0180', '1'),
(185, 1, 'Belle', 'Antoszczyk', '71-344-9034', '30-454-2909', 'Bigender', '2020-11-19', 'bantoszczyk54@addthis.com', '931-894-0632', ''),
(186, 4, 'Rea', 'Langelaan', '75-497-0280', '13-955-8300', 'Genderfluid', '2020-10-08', 'rlangelaan55@printfriendly.com', '917-763-3318', '1'),
(187, 5, 'Renato', 'Mitie', '42-179-9911', '70-143-8313', 'Bigender', '2021-09-23', 'rmitie56@hugedomains.com', '700-745-1419', '1'),
(188, 3, 'Tod', 'Storry', '45-451-5867', '58-553-3773', 'Bigender', '2021-09-09', 'tstorry57@google.cn', '595-495-7291', '1'),
(189, 1, 'Frederich', 'Adelsberg', '45-650-3730', '15-543-8981', 'Agender', '2021-04-15', 'fadelsberg58@about.com', '793-798-5222', ''),
(190, 3, 'Franciska', 'Degan', '77-753-5103', '91-899-0343', 'Female', '2021-05-04', 'fdegan59@europa.eu', '831-536-2866', '1'),
(191, 5, 'Meridith', 'Langham', '48-779-5094', '93-779-8742', 'Genderqueer', '2021-07-08', 'mlangham5a@moonfruit.com', '654-825-5795', ''),
(192, 1, 'Essa', 'Goldsworthy', '62-206-2472', '23-329-0532', 'Male', '2021-03-25', 'egoldsworthy5b@narod.ru', '518-971-3092', '1'),
(193, 1, 'Paola', 'Maleby', '89-275-9899', '20-215-6613', 'Genderqueer', '2021-04-13', 'pmaleby5c@ucoz.ru', '253-509-2968', ''),
(194, 1, 'Sydelle', 'Avon', '20-444-0920', '14-320-7611', 'Genderfluid', '2021-02-20', 'savon5d@chicagotribune.com', '694-533-7844', ''),
(195, 1, 'Beaufort', 'Shorthill', '18-735-9079', '49-247-5795', 'Genderqueer', '2021-02-07', 'bshorthill5e@blogs.com', '412-472-8296', '1'),
(196, 3, 'Ronnie', 'Gummie', '53-420-6421', '66-178-4550', 'Genderqueer', '2021-03-29', 'rgummie5f@xinhuanet.com', '581-207-7981', ''),
(197, 4, 'Tymon', 'Nazer', '40-384-7934', '48-899-5377', 'Male', '2020-12-11', 'tnazer5g@google.de', '535-177-9395', '1'),
(198, 1, 'Basilio', 'Merle', '85-589-1156', '29-150-3926', 'Male', '2020-09-26', 'bmerle5h@jiathis.com', '101-915-3491', ''),
(199, 2, 'Terra', 'Kitson', '03-745-8474', '38-059-8219', 'Polygender', '2021-06-14', 'tkitson5i@mashable.com', '633-303-0830', ''),
(200, 3, 'Ellary', 'Cordelette', '16-890-1380', '43-341-6084', 'Bigender', '2021-04-08', 'ecordelette5j@umich.edu', '411-950-1338', '1');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
