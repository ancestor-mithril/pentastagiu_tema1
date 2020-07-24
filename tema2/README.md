# pentastagiu_tema2
PENTASTAGIU_TEMA_2

* author: Stoica George

* sql create script:
```
CREATE TABLE `books` (
  `id` INT(10) NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(250) NOT NULL ,
  `author_id` INT(10),
  `publisher_id` INT(10),
  `created_at` DATETIME NOT NULL ,
  `updated_at` DATETIME NOT NULL ,
  PRIMARY KEY (`id`)
) 
```
```
CREATE TABLE `authors` (
  `id` INT(10) NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(250) NOT NULL ,
  `created_at` DATETIME NOT NULL ,
  `updated_at` DATETIME NOT NULL ,
  PRIMARY KEY (`id`)
) 
```
```
CREATE TABLE `publishers` (
  `id` INT(10) NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(250) NOT NULL ,
  `created_at` DATETIME NOT NULL ,
  `updated_at` DATETIME NOT NULL ,
  PRIMARY KEY (`id`)
) 
```