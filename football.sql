-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2021 at 02:52 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `football`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `allplayer` ()  SELECT Country,Team_Name,Name from player_profile$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `country_player` (IN `coun_name` VARCHAR(40))  select * from player_profile where country=coun_name$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `fix_player` (IN `name` VARCHAR(40))  select fixtures.Match_ID, fixtures.home,fixtures.away, fixtures.Grp, fixtures.Date, fixtures.Time, fixtures.Goal_T1, fixtures.Goal_T2, fixtures.Stadium from fixtures,player_profile where (fixtures.home=player_profile.Team_Name and player_profile.Name=name) or (fixtures.away=player_profile.Team_Name and player_profile.Name=name)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `league_stand` ()  select * from league_standing order by Points desc limit 20$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `playerdetails` (IN `playername` VARCHAR(40))  SELECT * FROM player_profile,player where player_profile.Name=playername and player.Name=playername$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `playerjersey` (IN `Jer` INT)  SELECT Name,Team_Name FROM player_profile where player_profile.Jersey=Jer$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pro3` ()  begin
	declare na varchar(20);
	declare cb varchar(20);
	declare co varchar(20);
	declare cur1 cursor for select Name from player_profile;
OPEN cur1;
	fetch cur1 into na;
    LOOP_label: LOOP
	select concat('Player :',na);
    END LOOP;
close cur1;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `result` (IN `mid` INT)  select Home, Away, Goal_T1, Goal_T2 from fixtures where Match_ID=mid$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `teamdetails` (IN `teamname` VARCHAR(40))  SELECT Team_Name,title,Stadium,Year_Founded FROM team_info WHERE team_info.Team_Name=teamname$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `top_five_team` ()  select * from team_info order by title desc limit 5$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `top_ten` ()  select * from player order by shooting desc limit 10$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `addinPlayer` (`pl_id` INT, `tm_id` INT, `nm` VARCHAR(40), `phy` INT, `shoot` INT, `pace` INT, `dribble` INT, `pass` INT, `defend` INT) RETURNS VARCHAR(100) CHARSET utf8mb4 begin
    declare msg varchar(100) default 'Check Input ! Insertion denied';
    declare pID int default 1;	-- starting value of customer id
    declare finished int default 0;
    declare cnt int;
    declare c_players cursor for select count(*) from player;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET finished = 1;
	open c_players;
	fetch c_players into cnt;
	if (cnt = 0) then
		insert into player values(pID,tm_id,nm,phy,shoot,pace,dribble,pass,defend);
		set msg = concat('Player is created with Player ID : ',pID);
	else
		insert into player (Player_ID,Team_ID,Name,Physical,Shooting,Pace,Dribbling,passing) values(pl_id,tm_id,nm,phy,shoot,pace,dribble,pass,defend);
		set msg = concat('Player is created with Player ID : ',pl_id);
	end if;
    close c_players;
	return (msg);
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `addinTeam` (`tm_id` INT, `nm` VARCHAR(40), `yfd` INT, `stadium` VARCHAR(40), `title` INT) RETURNS VARCHAR(100) CHARSET utf8mb4 begin
    declare msg varchar(100) default 'Check Input ! Insertion denied';
    declare tID int default 1;	-- starting value of customer id
    declare finished int default 0;
    declare cnt int;
    declare c_team cursor for select count(*) from team_info;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET finished = 1;
	open c_team;
	fetch c_team into cnt;
	if (cnt = 0) then
		insert into team_info values(tID,nm,yfd,stadium,title);
		set msg = concat('Team is created with Team ID : ',tID);
	else
		insert into team_info(Team_ID,Team_Name,Year_founded,Stadium,title) values(tm_id,nm,yfd,stadium,title);
		
	end if;
    close c_team;
	return (msg);
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `addPlayer` (`pl_id` INT, `tm_id` INT, `nm` VARCHAR(40), `pos` VARCHAR(40), `jer` INT, `team_nm` VARCHAR(40), `coun` VARCHAR(40)) RETURNS VARCHAR(100) CHARSET utf8mb4 begin
    declare msg varchar(100) default 'Check Input ! Insertion denied';
    declare pID int default 1;	-- starting value of customer id
    declare finished int default 0;
    declare cnt int;
    declare c_players cursor for select count(*) from player_profile;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET finished = 1;
	open c_players;
	fetch c_players into cnt;
	if (cnt = 0) then
		insert into player_profile values(pID,tm_id,nm,pos,jer,team_nm,coun);
		set msg = concat('Player is created with Player ID : ',pID);
	else
		insert into player_profile(Player_ID,Team_ID,Name,Position,Jersey,Team_Name,Country) values(pl_id,tm_id,nm,pos,jer,team_nm,coun);
		set msg = concat('Player is created with Player ID : ',pl_id);
	end if;
    close c_players;
	return (msg);
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `check_presence` (`pname` INT) RETURNS VARCHAR(100) CHARSET utf8mb4 begin
    DECLARE finished INTEGER DEFAULT 0;
    declare msg varchar(100) default 'Player plays in UCL';
	declare c_players cursor for select * from customers where Name=pname;
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET finished = 1;
	open c_players;
	if (finished = 1) then
		set msg = ('Player does not play in UCL');
	end if;
 	close c_players;
    return (msg);
	end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `fixtures`
--

CREATE TABLE `fixtures` (
  `Home` varchar(40) NOT NULL,
  `Away` varchar(40) NOT NULL,
  `Grp` varchar(20) NOT NULL,
  `Date` date DEFAULT NULL,
  `Time` varchar(40) DEFAULT NULL,
  `Goal_T1` int(11) DEFAULT 0,
  `Goal_T2` int(11) DEFAULT 0,
  `Match_ID` int(11) NOT NULL,
  `Stadium` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fixtures`
--

INSERT INTO `fixtures` (`Home`, `Away`, `Grp`, `Date`, `Time`, `Goal_T1`, `Goal_T2`, `Match_ID`, `Stadium`) VALUES
('FC Barcelona', 'PSG', 'D', '2021-03-25', '1:30', 3, 2, 1, 'Camp Nou'),
('Man City', 'FC Porto', 'C', '2021-03-27', '1:30', 3, 2, 2, 'Etihad Stadium'),
('Man United', 'Lazio', 'B', '2021-03-29', '1:30', 2, 3, 3, 'Old Trafford'),
('Bayern Munich', 'Atletico Madrid', 'A', '2021-03-31', '1:30', 2, 3, 4, 'Allianz Arena'),
('Juventus', 'RB Leizbig', 'D', '2021-04-16', '1:30', 2, 3, 5, 'Allianz Stadium'),
('Dortmund', 'Chelsea', 'C', '2021-04-17', '1:30', 2, 3, 6, 'Signal Iduna Park'),
('Atalanta', 'Real Madrid', 'B', '2021-04-19', '1:30', 0, 0, 7, 'Gewiss Stadium'),
('Sevilla', 'Liverpool', 'A', '2021-04-20', '1:30', 2, 3, 8, 'The Ramón Sánchez Pizjuán'),
('PSG', 'FC Barcelona', 'D', '2021-04-21', '1:30', 0, 0, 9, 'Le Parc des Princes'),
('FC Porto', 'Man City', 'C', '2021-04-23', '1:30', 0, 0, 10, 'Estádio do Dragão'),
('Lazio', 'Man United', 'B', '2021-04-25', '1:30', 0, 0, 11, 'Stadio Olimpico'),
('Atletico Madrid', 'Bayern Munich', 'A', '2021-04-26', '1:30', 0, 0, 12, 'Wanda Metropolitano stadium'),
('RB Leizbig', 'Juventus', 'D', '2021-04-27', '1:30', 0, 0, 13, 'Red Bull Arena'),
('Chelsea', 'Dortmund', 'C', '2021-04-28', '1:30', 0, 0, 14, 'Stamford Bridge'),
('Real Madrid', 'Atalanta', 'B', '2021-04-29', '1:30', 0, 0, 15, 'Santiago Bernabéu Stadium'),
('Liverpool', 'Sevilla', 'A', '2021-04-30', '1:30', 0, 0, 16, 'Anfield');

--
-- Triggers `fixtures`
--
DELIMITER $$
CREATE TRIGGER `fix` BEFORE UPDATE ON `fixtures` FOR EACH ROW begin
	if NEW.Goal_T1>NEW.Goal_T2 then
insert into result ( Match_ID,Winner, Goal_Scored,Goal_Conceded,Loser) values (OLD.Match_ID,OLD.Home,NEW.Goal_T1,NEW.Goal_T2,OLD.Away);
elseif NEW.Goal_T2 > NEW.Goal_T1 then
	insert into result (Match_ID,Winner, Goal_Scored,Goal_Conceded,Loser) values (OLD.Match_ID,OLD.Away,NEW.Goal_T2,NEW.Goal_T1,OLD.Home);	
end if;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `group_a`
--

CREATE TABLE `group_a` (
  `Team_ID` int(11) NOT NULL,
  `Team_Name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `group_a`
--

INSERT INTO `group_a` (`Team_ID`, `Team_Name`) VALUES
(1, 'Bayern Munich'),
(5, 'Atletico Madrid'),
(10, 'Sevilla'),
(14, 'Liverpool');

-- --------------------------------------------------------

--
-- Table structure for table `group_b`
--

CREATE TABLE `group_b` (
  `Team_ID` int(11) NOT NULL,
  `Team_Name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `group_b`
--

INSERT INTO `group_b` (`Team_ID`, `Team_Name`) VALUES
(2, 'Real Madrid'),
(11, 'Man United'),
(9, 'Lazio'),
(6, 'Atalanta');

-- --------------------------------------------------------

--
-- Table structure for table `group_c`
--

CREATE TABLE `group_c` (
  `Team_ID` int(11) NOT NULL,
  `Team_Name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `group_c`
--

INSERT INTO `group_c` (`Team_ID`, `Team_Name`) VALUES
(3, 'Man city'),
(15, 'Fc Porto'),
(16, 'Dortmund'),
(12, 'chelsea');

-- --------------------------------------------------------

--
-- Table structure for table `group_d`
--

CREATE TABLE `group_d` (
  `Team_ID` int(11) NOT NULL,
  `Team_Name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `group_d`
--

INSERT INTO `group_d` (`Team_ID`, `Team_Name`) VALUES
(7, 'Juventus'),
(4, 'FC Barcelona'),
(13, 'RB Leizbig'),
(8, 'PSG');

-- --------------------------------------------------------

--
-- Table structure for table `league_standing`
--

CREATE TABLE `league_standing` (
  `Team_ID` int(11) NOT NULL,
  `Team_Name` varchar(40) NOT NULL,
  `MP` int(11) DEFAULT 0,
  `Win` int(11) DEFAULT 0,
  `Draw` int(11) DEFAULT 0,
  `Lost` int(11) DEFAULT 0,
  `Points` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `league_standing`
--

INSERT INTO `league_standing` (`Team_ID`, `Team_Name`, `MP`, `Win`, `Draw`, `Lost`, `Points`) VALUES
(1, 'Bayern Munich', 2, 0, 0, 2, 0),
(2, 'Real Madrid', 0, 0, 0, 0, 0),
(3, 'Man City', 0, 0, 0, 0, 2),
(4, 'FC Barcelona', 0, 0, 0, 0, 0),
(5, 'Atletico Madrid', 2, 2, 0, 0, 14),
(6, 'Atalanta', 0, 0, 0, 0, 0),
(7, 'Juventus', 1, 0, 0, 1, 0),
(8, 'PSG', 0, 0, 0, 0, 0),
(9, 'Lazio', 1, 1, 0, 0, 17),
(10, 'Sevilla', 4, 0, 0, 4, 0),
(11, 'Man United', 0, 0, 0, 0, 0),
(12, 'Chelsea', 6, 6, 0, 0, 12),
(13, 'RB Leizbig', 1, 1, 0, 0, 2),
(14, 'Liverpool', 4, 4, 0, 0, 8),
(15, 'FC Porto', 0, 0, 0, 0, 0),
(16, 'Dortmund', 6, 0, 0, 6, 0);

-- --------------------------------------------------------

--
-- Table structure for table `player`
--

CREATE TABLE `player` (
  `Player_ID` int(11) NOT NULL,
  `Team_ID` int(11) NOT NULL,
  `Name` varchar(40) NOT NULL,
  `Physical` int(11) DEFAULT NULL,
  `Shooting` int(11) DEFAULT NULL,
  `Pace` int(11) DEFAULT NULL,
  `Dribbling` int(11) DEFAULT NULL,
  `Passing` int(11) DEFAULT NULL,
  `Defending` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `player`
--

INSERT INTO `player` (`Player_ID`, `Team_ID`, `Name`, `Physical`, `Shooting`, `Pace`, `Dribbling`, `Passing`, `Defending`) VALUES
(2, 1, 'Thomus Muller', 71, 82, 68, 78, 82, 56),
(3, 1, 'Manuel Neuer', 86, 87, 87, 89, 91, 56),
(4, 1, 'Joshua Kimmich', 79, 72, 71, 84, 86, 81),
(5, 2, 'Karim Benzima', 76, 85, 74, 87, 81, 40),
(6, 2, 'Sergio Ramos', 85, 70, 71, 74, 76, 88),
(7, 2, 'Marcelo Beira', 76, 73, 79, 88, 80, 76),
(8, 2, 'Luka Modric', 66, 76, 73, 88, 89, 71),
(9, 3, 'Kevin De Bruyne', 78, 86, 76, 88, 93, 64),
(10, 3, 'Sergio Aguero', 73, 90, 78, 88, 77, 33),
(11, 3, 'Rahim Stirling', 67, 81, 93, 90, 79, 45),
(12, 4, 'Lionel Messi', 65, 92, 85, 95, 91, 38),
(13, 4, 'Antonie Greizmann', 72, 85, 79, 88, 84, 57),
(14, 4, 'Frenkie De Jong', 77, 64, 80, 87, 84, 76),
(15, 4, 'Marc André ter Stegen', 88, 85, 88, 90, 88, 43),
(16, 4, 'Gerad Pique', 80, 61, 57, 69, 71, 86),
(17, 5, 'Luis Suarez', 83, 90, 70, 83, 82, 51),
(18, 5, 'Joao Felix', 68, 81, 81, 83, 74, 40),
(19, 5, 'Jan Oblak', 90, 92, 87, 90, 78, 50),
(23, 7, 'Paulo Dybala', 63, 85, 85, 91, 84, 43),
(24, 7, 'Matthijs de Ligt', 84, 59, 72, 69, 66, 85),
(25, 7, 'Alvaro Morata', 77, 80, 80, 81, 71, 31),
(26, 7, 'Gianluigi Buffon', 91, 76, 77, 78, 74, 34),
(27, 8, 'Neymar Jr.', 59, 85, 91, 94, 86, 36),
(28, 8, 'Kylian Mbappe', 76, 86, 96, 91, 78, 39),
(29, 8, 'Angel Di Maria', 68, 81, 83, 87, 85, 48),
(30, 8, 'Keylor Navas', 82, 81, 90, 90, 75, 54),
(31, 9, 'Ciro Immobile', 77, 88, 84, 83, 67, 39),
(32, 9, 'Joaquin Correa', 69, 75, 84, 85, 77, 39),
(33, 10, 'Ivan Rakitic', 69, 79, 61, 78, 85, 75),
(34, 10, 'Papu Gomez', 55, 79, 90, 88, 84, 39),
(35, 11, 'Bruno Fernandes', 75, 83, 77, 85, 88, 68),
(36, 11, 'Marcus Rashford', 78, 3, 91, 85, 78, 45),
(37, 11, 'Edinson Cavani', 87, 91, 88, 85, 78, 58),
(38, 11, 'David De Gea', 82, 81, 88, 89, 78, 57),
(39, 11, 'Paul Pogba', 85, 81, 73, 85, 86, 66),
(40, 12, 'Mason Mount', 61, 76, 74, 80, 79, 48),
(41, 12, 'Timo Werner', 71, 85, 91, 84, 69, 35),
(42, 12, 'Oliver Giroud', 77, 79, 39, 71, 70, 42),
(43, 13, 'Marcel Sabitzer', 78, 83, 80, 80, 80, 65),
(44, 13, 'Alexander Sørloth', 61, 70, 70, 75, 71, 34),
(45, 14, 'Mohammed Salah', 75, 86, 93, 90, 81, 45),
(46, 14, 'Virgil Van Dijk', 86, 60, 76, 72, 71, 91),
(47, 14, 'Sadio Mane', 76, 85, 94, 90, 80, 44),
(48, 14, 'Robert Firmino', 78, 80, 70, 90, 81, 61),
(49, 14, 'Alisson Becker', 91, 88, 86, 89, 85, 52),
(50, 15, 'Pepe de Lima', 85, 50, 66, 61, 60, 82),
(51, 15, 'Agustin Marchesin', 81, 78, 82, 86, 76, 54),
(1, 1, 'Robert Lewandowski', 82, 91, 78, 86, 78, 43),
(52, 16, 'Erling Braut Haaland', 85, 87, 84, 76, 63, 43),
(53, 16, 'Jadon Sancho', 64, 74, 83, 91, 81, 37),
(54, 16, 'Marco Reus', 63, 86, 80, 85, 84, 45),
(22, 7, 'Cristiano Ronaldo', 77, 93, 89, 89, 81, 35),
(20, 6, 'Josip Iličić', 68, 86, 70, 85, 84, 43),
(21, 6, 'Duvan Zapata', 83, 81, 75, 78, 59, 37);

--
-- Triggers `player`
--
DELIMITER $$
CREATE TRIGGER `players` BEFORE INSERT ON `player` FOR EACH ROW if(new.Physical<50) then
        SIGNAL SQLSTATE '45000' 
        SET MESSAGE_TEXT='Players physique should be greater than 50';
ELSEIF (new.Physical>100) then
        SIGNAL SQLSTATE '45000' 
        SET MESSAGE_TEXT='Player physique should be less than 100';
ELSEIF(new.Shooting<50) then
        SIGNAL SQLSTATE '45000' 
        SET MESSAGE_TEXT='Players Shooting should be greater than 50';
ELSEIF (new.Shooting>100) then
        SIGNAL SQLSTATE '45000' 
        SET MESSAGE_TEXT='Player Shooting should be less than 100';
ELSEIF(new.Pace<50) then
        SIGNAL SQLSTATE '45000' 
        SET MESSAGE_TEXT='Players Shooting should be greater than 50';
ELSEIF (new.Pace>100) then
        SIGNAL SQLSTATE '45000' 
        SET MESSAGE_TEXT='Player Shooting should be less than 100';
ELSEIF(new.Dribbling<50) then
        SIGNAL SQLSTATE '45000' 
        SET MESSAGE_TEXT='Players Shooting should be greater than 50';
ELSEIF (new.Dribbling>100) then
        SIGNAL SQLSTATE '45000' 
        SET MESSAGE_TEXT='Player Shooting should be less than 100';
ELSEIF(new.Passing<50) then
        SIGNAL SQLSTATE '45000' 
        SET MESSAGE_TEXT='Players Shooting should be greater than 50';
ELSEIF (new.Passing>100) then
        SIGNAL SQLSTATE '45000' 
        SET MESSAGE_TEXT='Player Shooting should be less than 100';
ELSEIF(new.Defending<50) then
        SIGNAL SQLSTATE '45000' 
        SET MESSAGE_TEXT='Players Shooting should be greater than 50';
ELSEIF (new.Defending>100) then
        SIGNAL SQLSTATE '45000' 
        SET MESSAGE_TEXT='Player Shooting should be less than 100';
END IF
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `player_profile`
--

CREATE TABLE `player_profile` (
  `Player_ID` int(11) NOT NULL,
  `Team_ID` int(11) NOT NULL,
  `Name` varchar(40) NOT NULL,
  `Position` varchar(40) NOT NULL,
  `Jersey` int(11) NOT NULL,
  `Team_Name` varchar(40) NOT NULL,
  `Country` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `player_profile`
--

INSERT INTO `player_profile` (`Player_ID`, `Team_ID`, `Name`, `Position`, `Jersey`, `Team_Name`, `Country`) VALUES
(1, 1, 'Robert Lewandowski', 'Forward', 9, 'Bayern Munich', 'Poland '),
(2, 1, 'Thomus Muller', 'Forward', 25, 'Bayern Munich', 'Germany '),
(3, 1, 'Manuel Neuer', 'Goalkeeper', 1, 'Bayern Munich', 'Germany '),
(4, 1, 'Joshua Kimmich ', 'Mid fielder', 6, 'Bayern Munich', 'Germany '),
(5, 2, 'Karim Benzema', 'Forward', 9, 'Real Madrid', 'France '),
(6, 2, 'Sergio Ramos', 'Defender', 4, 'Real Madrid', 'Spain '),
(7, 2, 'Marcelo Biera', 'Defender', 12, 'Real Madrid', 'Brazil '),
(8, 2, 'Luka Modric ', 'Mid fielder', 10, 'Real Madrid', 'Croatia '),
(9, 3, 'Kevin De Bruyne ', 'Mid fielder', 17, 'Man City', 'Belgium '),
(10, 3, 'Sergio Aguero', 'Forward', 10, 'Man City', 'Argentina '),
(11, 3, 'Rahim Stirling', 'Forward', 7, 'Man City', 'England '),
(12, 4, 'Lionel Messi', 'Forward', 10, 'FC Barcelona', 'Argentina '),
(13, 4, 'Antoine Griezmann', 'Forward', 7, 'FC Barcelona', 'France '),
(14, 4, 'Frenkie De jong ', 'Mid fielder', 21, 'FC Barcelona', 'Netherlands '),
(15, 4, 'Marc André ter Stegen', 'Goalkeeper', 22, 'FC Barcelona', 'Germany '),
(16, 4, 'Gerad Pique', 'Defender', 3, 'FC Barcelona', 'Spain '),
(17, 5, 'Luis Suarez', 'Forward', 9, 'Atletico Madrid', 'Uruguay '),
(18, 5, 'Joao Felix', 'Forward', 7, 'Atletico Madrid', 'Portugal '),
(19, 5, 'Jan Oblak', 'Goalkeeper', 13, 'Atletico Madrid', 'Slovenia '),
(27, 8, 'Neymar Jr.', 'Forward', 10, 'PSG', 'Brazil '),
(28, 8, 'Kylian Mbappe', 'Forward', 7, 'PSG', 'France '),
(29, 8, 'Angel Di Maria ', 'Mid fielder', 11, 'PSG', 'Argentina '),
(30, 8, 'Keylor Navas', 'Goalkeeper', 1, 'PSG', 'Costa Rica '),
(31, 9, 'Ciro Immobile', 'Forward', 17, 'Lazio', 'Italy '),
(32, 9, 'Joaquin Correa ', 'Mid fielder', 11, 'Lazio', 'Argentina '),
(33, 10, 'Ivan Rakitic ', 'Mid fielder', 10, 'Sevilla', 'Croatia '),
(34, 10, 'Papu Gomez ', 'Mid fielder', 24, 'Sevilla', 'Argentina '),
(35, 11, 'Bruno Fernandes ', 'Mid fielder', 18, 'Man United', 'Portugal '),
(36, 11, 'Marcus Rashford', 'Forward', 10, 'Man United', 'England '),
(37, 11, 'Edinson Cavani', 'Forward', 7, 'Man United', 'Uruguay '),
(38, 11, 'David De Gea', 'Goalkeeper', 1, 'Man United', 'Spain '),
(39, 11, 'Paul Pogba ', 'Mid fielder', 6, 'Man United', 'France '),
(40, 12, 'Mason Mount ', 'Mid fielder', 19, 'Chelsea', 'England '),
(41, 12, 'Timo Werner', 'Forward', 11, 'Chelsea', 'Germany '),
(42, 12, 'Oliver Giroud', 'Forward', 18, 'Chelsea', 'France '),
(43, 13, 'Marcel Sabitzer ', 'Mid fielder', 7, 'RB Leizbig', 'Austria '),
(44, 13, 'Alexander Sørloth', 'Forward', 19, 'RB Leizbig', 'Norway '),
(45, 14, 'Mohammed Salah', 'Forward', 11, 'Liverpool', 'Egypt '),
(46, 14, 'Virgil Van Dijk', 'Defender', 4, 'Liverpool', 'Netherlands '),
(47, 14, 'Sadio Mane', 'Forward', 10, 'Liverpool', 'Senegal '),
(48, 14, 'Robert Firmino', 'Forward', 9, 'Liverpool', 'Brazil '),
(49, 14, 'Alisson Becker', 'Goalkeeper', 1, 'Liverpool', 'Brazil '),
(50, 15, 'Pepe de Lima', 'Defender', 3, 'FC Porto', 'Portugal '),
(51, 15, 'Agustin Marchesin', 'Goalkeeper', 1, 'FC Porto', 'Argentina '),
(52, 16, 'Erling Braut Haaland', 'Forward', 9, 'Dortmund', 'Norway '),
(53, 16, 'Jadon Sancho ', 'Mid fielder', 7, 'Dortmund', 'England '),
(54, 16, 'Marco Reus', 'Forward', 11, 'Dortmund', 'Germany '),
(20, 6, 'Josip Iličić ', 'Mid fielder', 72, 'Atlanta', 'Slovenia '),
(21, 6, 'Duvan Zapata', 'Forward', 91, 'Atlanta', 'Columbia '),
(22, 7, 'Cristiano Ronaldo', 'Forward', 7, 'Juventus', 'Portugal '),
(23, 7, 'Paulo Dybala', 'Forward', 10, 'Juventus', 'Argentina '),
(24, 7, 'Matthijs de Ligt', 'Defender', 4, 'Juventus', 'Netherlands '),
(25, 7, 'Alvaro Morata', 'Forward', 9, 'Juventus', 'Spain'),
(26, 7, 'Gianluigi Buffon', 'Goalkeeper', 77, 'Juventus', 'Italy');

--
-- Triggers `player_profile`
--
DELIMITER $$
CREATE TRIGGER `transfer` BEFORE UPDATE ON `player_profile` FOR EACH ROW IF (OLD.Team_Name<>NEW.Team_Name) THEN
INSERT INTO transferlogs(Player_ID, Name, Past_Club, Future_Club)VALUES(OLD.Player_ID, OLD.Name, OLD.Team_Name, NEW.Team_Name);
END IF
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trig5` BEFORE INSERT ON `player_profile` FOR EACH ROW BEGIN 
DECLARE pos_count INT(11);
SET pos_count = (SELECT COUNT(Position) FROM player_profile WHERE Position=NEW.Position and Team_ID=NEW.Team_ID);
IF pos_count > 2 THEN 
	SIGNAL SQLSTATE '45000'
	SET
  		MESSAGE_TEXT = 'Already have players for that position.';
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE `result` (
  `Winner` varchar(40) NOT NULL,
  `Goal_Scored` int(11) DEFAULT 0,
  `Goal_Conceded` int(11) DEFAULT 0,
  `Match_ID` int(11) NOT NULL,
  `Loser` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `result`
--

INSERT INTO `result` (`Winner`, `Goal_Scored`, `Goal_Conceded`, `Match_ID`, `Loser`) VALUES
('Man City', 3, 2, 2, ''),
('Lazio', 3, 2, 3, ''),
('Atletico Madrid', 3, 2, 4, 'Bayern Munich'),
('Atletico Madrid', 3, 2, 4, 'Bayern Munich'),
('RB Leizbig', 3, 2, 5, 'Juventus'),
('Chelsea', 3, 2, 6, 'Dortmund'),
('Chelsea', 3, 2, 6, 'Dortmund'),
('Chelsea', 3, 2, 6, 'Dortmund'),
('Chelsea', 3, 2, 6, 'Dortmund'),
('Chelsea', 3, 2, 6, 'Dortmund'),
('Chelsea', 3, 2, 6, 'Dortmund'),
('Liverpool', 3, 2, 8, 'Sevilla'),
('Liverpool', 3, 2, 8, 'Sevilla'),
('Liverpool', 3, 2, 8, 'Sevilla'),
('Liverpool', 3, 2, 8, 'Sevilla');

--
-- Triggers `result`
--
DELIMITER $$
CREATE TRIGGER `point` BEFORE INSERT ON `result` FOR EACH ROW begin
	update league_standing set points=points+2 where league_standing.Team_Name=new.Winner;
	update league_standing set MP = MP+1 where league_standing.Team_Name=new.Winner;
	update league_standing set MP = MP+1 where league_standing.Team_Name=new.Loser;
	update league_standing set Win = Win+1 where league_standing.Team_Name=new.Winner;
	update league_standing set Lost = Lost+1 where league_standing.Team_Name=new.Loser;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `team_audits`
--

CREATE TABLE `team_audits` (
  `Team_ID` int(11) NOT NULL,
  `created_date` date NOT NULL,
  `created_by` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `team_audits`
--

INSERT INTO `team_audits` (`Team_ID`, `created_date`, `created_by`) VALUES
(22, '2021-04-12', 'root@localhost'),
(25, '2021-04-13', 'root@localhost'),
(25, '2021-04-13', 'root@localhost'),
(27, '2021-04-13', 'root@localhost'),
(27, '2021-04-13', 'root@localhost'),
(17, '2021-04-13', 'root@localhost'),
(18, '2021-04-13', 'root@localhost'),
(19, '2021-04-13', 'root@localhost'),
(20, '2021-04-13', 'root@localhost'),
(21, '2021-04-13', 'root@localhost'),
(22, '2021-04-13', 'root@localhost'),
(17, '2021-04-13', 'root@localhost'),
(25, '2021-04-14', 'root@localhost'),
(25, '2021-04-14', 'root@localhost');

-- --------------------------------------------------------

--
-- Table structure for table `team_info`
--

CREATE TABLE `team_info` (
  `Team_ID` int(11) NOT NULL,
  `Team_Name` varchar(40) NOT NULL,
  `Year_Founded` int(11) NOT NULL,
  `Stadium` varchar(40) NOT NULL,
  `title` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `team_info`
--

INSERT INTO `team_info` (`Team_ID`, `Team_Name`, `Year_Founded`, `Stadium`, `title`) VALUES
(1, 'Bayern Munich', 1990, 'Allianz Arena', 6),
(2, 'Real Madrid', 1902, 'Santiago Bernabéu Stadium', 13),
(3, 'Man City', 1880, 'Etihad Stadium', 0),
(4, 'FC Barcelona', 1899, 'Camp Nou', 5),
(5, 'Atletico Madrid', 1903, 'Wanda Metropolitano stadium', 0),
(6, 'Atalanta', 1907, 'Gewiss Stadium', 0),
(7, 'Juventus', 1897, 'Allianz Stadium', 2),
(8, 'PSG', 1970, 'Le Parc des Princes', 0),
(9, 'Lazio', 1990, 'Stadio Olimpico', 0),
(10, 'Sevilla', 1890, 'The Ramón Sánchez Pizjuán', 0),
(11, 'Man United', 1900, 'Old Trafford', 3),
(12, 'Chelsea', 1905, 'Stamford Bridge', 1),
(13, 'RB Leizbig', 2009, 'Red Bull Arena', 0),
(14, 'Liverpool', 1892, 'Anfield', 6),
(15, 'FC Porto', 1893, 'Estádio do Dragão', 2),
(16, 'Dortmund', 1909, 'Signal Iduna Park', 1),
(25, 'IndiaFC', 2021, 'Gewiss Stadium', 10);

--
-- Triggers `team_info`
--
DELIMITER $$
CREATE TRIGGER `team_player` BEFORE DELETE ON `team_info` FOR EACH ROW delete from player_profile where Team_ID=OLD.Team_ID
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trig6` AFTER INSERT ON `team_info` FOR EACH ROW BEGIN

   DECLARE vUser varchar(50);

  
   SELECT users.username INTO vUser;

   
   INSERT INTO team_audits
   ( Team_ID,
     created_date,
     created_by)
   VALUES
   ( NEW.Team_ID,
     SYSDATE(),
     vUser );

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `transferlogs`
--

CREATE TABLE `transferlogs` (
  `Player_ID` int(11) DEFAULT NULL,
  `Past_Club` varchar(30) DEFAULT NULL,
  `Future_Club` varchar(30) DEFAULT NULL,
  `Name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transferlogs`
--

INSERT INTO `transferlogs` (`Player_ID`, `Past_Club`, `Future_Club`, `Name`) VALUES
(22, 'Juventus', 'Man City', 'Cristiano Ronaldo'),
(22, 'Man City', 'Juventus', 'Cristiano Ronaldo'),
(1, 'Bayern Munich', 'Juventus', 'Robert Lewandowski'),
(1, 'Juventus', 'Bayern Munich', 'Robert Lewandowski'),
(1, 'Bayern Munich', 'Real Madrid', 'Robert Lewandowski'),
(1, 'Real Madrid', 'Bayern Munich', 'Robert Lewandowski'),
(22, 'Juventus', 'Dortmund', 'Cristiano Ronaldo'),
(22, 'Dortmund', 'Juventus', 'Cristiano Ronaldo');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(40) NOT NULL,
  `password` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`) VALUES
('samyak@123.com', '123'),
('dhruvil@123.com', '1234'),
('jash@123.com', '12345');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fixtures`
--
ALTER TABLE `fixtures`
  ADD PRIMARY KEY (`Match_ID`);

--
-- Indexes for table `team_info`
--
ALTER TABLE `team_info`
  ADD PRIMARY KEY (`Team_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
