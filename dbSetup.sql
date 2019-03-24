DROP DATABASE IF EXISTS `CalendarDB`;
CREATE DATABASE IF NOT EXISTS `CalendarDB`;
USE `CalendarDB`;

DROP TABLE IF EXISTS `Users`;
DROP TABLE IF EXISTS `Groups`;
DROP TABLE IF EXISTS `GroupUsers`;

CREATE TABLE `Users` (
  `UserID` INTEGER NOT NULL AUTO_INCREMENT, 
  `UserName` VARCHAR(50) UNIQUE NOT NULL,
  `Email` VARCHAR(100) NOT NULL, 
  `Password` VARCHAR(255) NOT NULL,
  `Affiliation` VARCHAR(100), 
  INDEX (`UserID`), 
  INDEX (`UserName`), 
  PRIMARY KEY (`UserName`)
) ENGINE=innodb DEFAULT CHARSET=utf8;

SET autocommit=1;

CREATE TABLE `Groups` (
	`GroupID` INT NOT NULL AUTO_INCREMENT,
	`AdminID` INT NOT NULL,
    `GroupName` VARCHAR(50) UNIQUE NOT NULL,
    `Description` VARCHAR(250) NOT NULL,
    `Password` VARCHAR(255) NOT NULL,
	`StartDate` DATETIME NOT NULL,
	`EndDate` DATETIME NOT NULL,
	PRIMARY KEY (`GroupID`)
) ENGINE=innodb DEFAULT CHARSET=utf8;

CREATE TABLE `GroupUsers` (
	`GroupID` INT NOT NULL,
	`UserID` INT NOT NULL,
	PRIMARY KEY (`GroupID`,`UserID`)
) ENGINE=innodb DEFAULT CHARSET=utf8;

CREATE TABLE `Messages` (
	`MsgID` INT NOT NULL AUTO_INCREMENT,
	`FromID` INT NOT NULL,
	`Subject` TEXT,
	`MsgBody` TEXT,
	`Status` BIT NOT NULL DEFAULT 0,
	PRIMARY KEY( `MsgID` )
);

ALTER TABLE `Groups` ADD CONSTRAINT `Groups_fk0` FOREIGN KEY (`AdminID`) REFERENCES `Users`(`UserID`);

ALTER TABLE `GroupUsers` ADD CONSTRAINT `GroupUsers_fk0` FOREIGN KEY (`GroupID`) REFERENCES `Groups`(`GroupID`) ON DELETE CASCADE;

ALTER TABLE `GroupUsers` ADD CONSTRAINT `GroupUsers_fk1` FOREIGN KEY (`UserID`) REFERENCES `Users`(`UserID`) ON DELETE CASCADE;

ALTER TABLE `Messages` ADD CONSTRAINT `Messages_fk0` FOREIGN KEY (`FromID`) REFERENCES `Users`(`UserID`);

/*LEAVE AT LEAST THE FIRST 'Calendar' USER - USED TO SEND MESSAGES FROM SYSTEM TO USERS*/
INSERT INTO Users (UserID, UserName, Password, Email, Affiliation) VALUES (DEFAULT, "Calendar", "youwontevergetthishash", "system@system", "system");
INSERT INTO Users (UserID, UserName, Password, Email, Affiliation) VALUES (DEFAULT, "Lucas", "$2y$10$OXzKqaIHQzfZJAAP126GeuPdr8WEhTaZ/f5MAWN3AA4cxgqtc6Bzu", "boul9440@mylaurier.ca", "WLU");



