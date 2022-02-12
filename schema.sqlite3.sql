CREATE TABLE `post` (
  `id` INT,
  `user_id` INT,
  `title` VARCHAR(255) NOT NULL,
  `body` TEXT NOT NULL
);

CREATE TABLE `comment` (
  `id` INT,
  `post_id` INT,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `body` TEXT NOT NULL,
  FOREIGN KEY (`post_id`) REFERENCES `post`(`id`)
);
