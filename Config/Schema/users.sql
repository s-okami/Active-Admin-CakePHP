--
-- Login authentication.  When you want to more, visit at
--
-- http://book.cakephp.org/2.0/ja/tutorials-and-examples/blog-auth-example/auth.html
--
CREATE TABLE `users` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(50),
    `password` VARCHAR(50),
    `role` VARCHAR(20),
    `created` DATETIME DEFAULT NULL,
    `modified` DATETIME DEFAULT NULL
);