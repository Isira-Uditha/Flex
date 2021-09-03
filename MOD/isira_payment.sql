20021/08/25
CREATE TABLE `flexfitness`.`payment` ( `payment_id` INT NOT NULL AUTO_INCREMENT ,  `payment_date` DATE NOT NULL DEFAULT CURRENT_TIMESTAMP ,  `uid` INT NOT NULL ,    PRIMARY KEY  (`payment_id`)) ENGINE = InnoDB;
ALTER TABLE `payment` ADD CONSTRAINT `payment_user_fk1` FOREIGN KEY (`uid`) REFERENCES `user`(`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER TABLE `payment` ADD `package_id` INT NOT NULL AFTER `payment_date`;
ALTER TABLE `payment` ADD CONSTRAINT `payment_package_fk1` FOREIGN KEY (`package_id`) REFERENCES `package`(`package_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER TABLE `payment` ADD `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `uid`;
ALTER TABLE `payment` ADD `updated_at` YEAR NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `created_at`;
