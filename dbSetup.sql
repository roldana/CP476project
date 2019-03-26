DROP DATABASE IF EXISTS `CalendarDB`;
CREATE DATABASE IF NOT EXISTS `CalendarDB`;
USE `CalendarDB`;

DROP TABLE IF EXISTS `Users`;
DROP TABLE IF EXISTS `Groups`;
DROP TABLE IF EXISTS `GroupUsers`;

CREATE TABLE `Users` (
  `UserID` INTEGER UNIQUE NOT NULL AUTO_INCREMENT, 
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
    `Lat` FLOAT(12,8) NOT NULL,
    `Lng` FLOAT(12,8) NOT NULL,
    `Status` INT NOT NULL DEFAULT 0,
	PRIMARY KEY (`GroupID`)
) ENGINE=innodb DEFAULT CHARSET=utf8;

CREATE TABLE `GroupUsers` (
	`GroupID` INT NOT NULL,
	`UserID` INT NOT NULL,
	PRIMARY KEY (`GroupID`,`UserID`)
) ENGINE=innodb DEFAULT CHARSET=utf8;

CREATE TABLE `Messages` (
	`MsgID` INT NOT NULL AUTO_INCREMENT,
    `ToID` INT NOT NULL,
	`FromID` INT NOT NULL,
    `MsgDate` INT NOT NULL,
	`Subject` TEXT NOT NULL,
	`MsgBody` TEXT NOT NULL,
	`Status` INT NOT NULL DEFAULT 0,
	PRIMARY KEY( `MsgID` )
) ENGINE=innodb DEFAULT CHARSET=utf8;

CREATE TABLE `ChatIdentifier` (
    `GroupID` INT NOT NULL AUTO_INCREMENT,
	`MsgTotal` INT NOT NULL DEFAULT 0,
    PRIMARY KEY( `GroupID` )
) ENGINE=innodb DEFAULT CHARSET=utf8;

CREATE TABLE `ChatMessages` (
    `GroupID` INT NOT NULL,
    `UserID` INT NOT NULL,
    `MsgDate` INT NOT NULL,
    `Content` TEXT NOT NULL ,
    PRIMARY KEY (`UserID`, `MsgDate`)
) ENGINE=innodb DEFAULT CHARSET=utf8;

CREATE TABLE `Sheets` (
    `GroupID` INT NOT NULL,
    `Cell`  VARCHAR(4) NOT NULL,
    `UserID` INT NOT NULL,
    PRIMARY KEY (`GroupID`, `Cell`, `UserID`)
)  ENGINE=innodb DEFAULT CHARSET=utf8;

ALTER TABLE `Groups` ADD CONSTRAINT `Groups_fk0` FOREIGN KEY (`AdminID`) REFERENCES `Users`(`UserID`);

ALTER TABLE `GroupUsers` ADD CONSTRAINT `GroupUsers_fk0` FOREIGN KEY (`GroupID`) REFERENCES `Groups`(`GroupID`) ON DELETE CASCADE;
ALTER TABLE `GroupUsers` ADD CONSTRAINT `GroupUsers_fk1` FOREIGN KEY (`UserID`) REFERENCES `Users`(`UserID`) ON DELETE CASCADE;

ALTER TABLE `Messages` ADD CONSTRAINT `Messages_fk0` FOREIGN KEY (`FromID`) REFERENCES `Users`(`UserID`);
ALTER TABLE `Messages` ADD CONSTRAINT `Messages_fk1` FOREIGN KEY (`ToID`) REFERENCES `Users`(`UserID`);

ALTER TABLE `ChatIdentifier` ADD CONSTRAINT `ChatIdentifier_fk0` FOREIGN KEY (`GroupID`) REFERENCES `Groups`(`GroupID`) ON DELETE CASCADE;

ALTER TABLE `ChatMessages` ADD CONSTRAINT `ChatMessages_fk0` FOREIGN KEY (`UserID`) REFERENCES `Users`(`UserID`) ON DELETE CASCADE;
ALTER TABLE `ChatMessages` ADD CONSTRAINT `ChatMessages_fk1` FOREIGN KEY (`GroupID`) REFERENCES `Groups`(`GroupID`) ON DELETE CASCADE;

ALTER TABLE `Sheets` ADD CONSTRAINT `Sheets_fk0` FOREIGN KEY (`UserID`) REFERENCES `Users`(`UserID`) ON DELETE CASCADE;
ALTER TABLE `Sheets` ADD CONSTRAINT `Sheets_fk1` FOREIGN KEY (`GroupID`) REFERENCES `Groups`(`GroupID`) ON DELETE CASCADE;

/*LEAVE AT LEAST THE FIRST 'Calendar' USER - USED TO SEND MESSAGES FROM SYSTEM TO USERS*/
INSERT INTO Users (UserID, UserName, Password, Email, Affiliation) VALUES (0, "Calendar", "youwontevergetthishash", "system@system", "system");
/*Password = password*/
INSERT INTO Users (UserID, UserName, Password, Email, Affiliation) VALUES (1, "Lucas", "$2y$10$OXzKqaIHQzfZJAAP126GeuPdr8WEhTaZ/f5MAWN3AA4cxgqtc6Bzu", "boul9440@mylaurier.ca", "WLU");

/*These are test messages to be sent out - testing notification system for ststem messages*/
INSERT INTO Messages (MsgID, ToID, FromID, MsgDate, Subject, MsgBody) VALUES (0, 1, 0, "0", "test subject #1", "Test message body #1. sdfjkhskdjfh sdfhjks dfhjksdf sdfjkhsdf ");
INSERT INTO Messages (MsgID, ToID, FromID, MsgDate, Subject, MsgBody) VALUES (1, 1, 0, "0", "test subject #2", "Test message body #2. sdfjkhskdjfh sdfhjks dfhjksdf sdfjkhsdf ");
INSERT INTO Messages (MsgID, ToID, FromID, MsgDate, Subject, MsgBody) VALUES (2, 1, 0, "0", "test subject #3", "Test message body #3. sdfjkhskdjfh sdfhjks dfhjksdf sdfjkhsdf ");
INSERT INTO Messages (MsgID, ToID, FromID, MsgDate, Subject, MsgBody) VALUES (3, 1, 0, "0", "test subject #4", "Test message body #4. sdfjkhskdjfh sdfhjks dfhjksdf sdfjkhsdf ");
INSERT INTO Messages (MsgID, ToID, FromID, MsgDate, Subject, MsgBody) VALUES (4, 1, 0, "0", "test subject #5", "Test message body #5. sdfjkhskdjfh sdfhjks dfhjksdf sdfjkhsdf ");

INSERT INTO Groups (GroupID, AdminID, GroupName, Description, Password, StartDate, EndDate, Lat, Lng) VALUES (0, 1, "Name Goes Here", "Description Goes Here", "youwontevergetthishash", 0, 604800, 41, -80);
INSERT INTO GroupUsers (GroupID, UserID) VALUES (0, 1);
INSERT INTO ChatIdentifier (GroupID) VALUES (0);
INSERT INTO Sheets (GroupID, Cell, UserID) VALUES (0, "1-1", 1);
INSERT INTO Sheets (GroupID, Cell, UserID) VALUES (0, "0-0", 1);
INSERT INTO Sheets (GroupID, Cell, UserID) VALUES (0, "2-1", 1);
INSERT INTO Sheets (GroupID, Cell, UserID) VALUES (0, "3-1", 1);

