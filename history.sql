CREATE TABLE `users`.`History` ( `userID` INT(255) NOT NULL , `Date` DATETIME NOT NULL , `Action` VARCHAR(100) NOT NULL , INDEX `userid_index` (`userID`)) ENGINE = InnoDB;
ALTER TABLE `history` ADD FOREIGN KEY (`userID`) REFERENCES `users`.`users`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `history` ADD PRIMARY KEY( `userID`, `Date`);