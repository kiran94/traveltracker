
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- Trip
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `Trip`;

CREATE TABLE `Trip`
(
    `ID` CHAR(36) NOT NULL,
    `Name` VARCHAR(36) NOT NULL,
    PRIMARY KEY (`ID`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- Location
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `Location`;

CREATE TABLE `Location`
(
    `ID` CHAR(36) NOT NULL,
    `Lat` FLOAT NOT NULL,
    `Long` FLOAT NOT NULL,
    `Name` VARCHAR(255),
    `Date` DATE NOT NULL,
    `TripID` CHAR(36) NOT NULL,
    PRIMARY KEY (`ID`),
    INDEX `Location_fi_557870` (`TripID`),
    CONSTRAINT `Location_fk_557870`
        FOREIGN KEY (`TripID`)
        REFERENCES `Trip` (`ID`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
