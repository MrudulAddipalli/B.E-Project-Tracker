CREATE TABLE `access` ( `id` int(11) NOT NULL, `passkey` longtext NOT NULL ) ENGINE = InnoDB DEFAULT CHARSET = latin1;
CREATE TABLE `emailconfig` ( `id` int(11) NOT NULL, `Username` longtext NOT NULL, `Password` longtext NOT NULL, `Host` varchar(20) NOT NULL, `Port` int(11) NOT NULL, `SMTPSecure` varchar(10) NOT NULL, `SetFrom` longtext NOT NULL, `in_use` tinyint(4) DEFAULT 0 ) ENGINE = InnoDB DEFAULT CHARSET = latin1;
CREATE TABLE `migrations` ( `id` int(10) UNSIGNED NOT NULL, `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL, `batch` int(11) NOT NULL ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;
CREATE TABLE `notification` ( `id` int(11) NOT NULL, `message` longtext NOT NULL, `rec` int(11) NOT NULL ) ENGINE = InnoDB DEFAULT CHARSET = latin1;
CREATE TABLE `password_resets` ( `email` longtext COLLATE utf8mb4_unicode_ci NOT NULL, `token` longtext COLLATE utf8mb4_unicode_ci NOT NULL, `created_at` timestamp NULL DEFAULT NULL ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;
CREATE TABLE `rubrics` ( `id` int(11) NOT NULL, `sem7_P1` int(11) DEFAULT NULL, `sem7_P2` int(11) DEFAULT NULL, `sem7_P3` int(11) DEFAULT NULL, `sem7_P4` int(11) DEFAULT NULL, `sem7_P5` int(11) DEFAULT NULL, `sem8_P1` int(11) DEFAULT NULL, `sem8_P2` int(11) DEFAULT NULL, `sem8_P3` int(11) DEFAULT NULL, `sem8_P4` int(11) DEFAULT NULL, `sem8_P5` int(11) DEFAULT NULL, `project_id` int(11) NOT NULL ) ENGINE = InnoDB DEFAULT CHARSET = latin1;
CREATE TABLE `task` ( `id` int(11) NOT NULL, `detail` longtext NOT NULL, `project` int(11) NOT NULL, `status` int(11) NOT NULL, `doa` date DEFAULT NULL, `doc` date NOT NULL, `rating` int(11) NOT NULL, `marks` int(11) NOT NULL DEFAULT 0, `remark` longtext NOT NULL DEFAULT 'Not Remarked' ) ENGINE = InnoDB DEFAULT CHARSET = latin1;
CREATE TABLE `users` ( `id` int(10) UNSIGNED NOT NULL, `name` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL, `email` longtext COLLATE utf8mb4_unicode_ci NOT NULL, `password` longtext COLLATE utf8mb4_unicode_ci NOT NULL, `remember_token` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL, `type` int(11) NOT NULL DEFAULT 0, `ackey` longtext COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0', `act` int(11) NOT NULL DEFAULT 0, `project_title` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL, `project_guide` int(11) DEFAULT NULL, `branch` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL, `nog` int(11) DEFAULT NULL, `name_gm1` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL, `name_gm2` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL, `name_gm3` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL, `name_gm4` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL, `email_gm1` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL, `email_gm2` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL, `email_gm3` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL, `email_gm4` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

INSERT INTO `emailconfig` (`id`, `Username`, `Password`, `Host`, `Port`, `SMTPSecure`, `SetFrom`, `in_use`) VALUES ( 1, 'mrudul.addipalli@gmail.com', 'eyJpdiI6IlZqQVJpaXNmeUFvXC9hdnp3YXIwckNRPT0iLCJ2YWx1ZSI6IjJRK0c5aTJ5VEZlTzI2aTRUSHBqaFE9PSIsIm1hYyI6Ijk5M2NhNThjOTg0NzFmMTBmOTk5ZTkyM2Q2N2I4YjcxYTI0OWE5ODRmYmYzZjM1ZTAxOGYwMjhlOWM3YzI2YzcifQ==', 'smtp.gmail.com', 465, 'ssl', 'BEPT Admin', 1 );
INSERT INTO `access` (`id`, `passkey`) VALUES ( 1, '\"eyJpdiI6IkNlUWhGalRIUzBKYUVNOVVVeExHaFE9PSIsInZhbHVlIjoiWHI4WXBQVVhHRDFLMm9XUzlPalhBdz09IiwibWFjIjoiNTI4ZWE3YTI3YTdkZDAyNzQ3N2QzOGFlMDFlMmEwYTM1NWYwMDk2ZjM3MGVmNjgwNzE1MmU2MDI4YjVmMzkyNCJ9' );
INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `type`, `ackey`, `act`, `project_title`, `project_guide`, `branch`, `nog`, `name_gm1`, `name_gm2`, `name_gm3`, `name_gm4`, `email_gm1`, `email_gm2`, `email_gm3`, `email_gm4`) VALUES (NULL, 'BEPT ADMIN', 'bept.admin@ucoe.com', '$2y$10$WUkhbAwnVPNOBj8cTKgMMOIVY0u.Y6zb3zQHBsFJ3Qb7MaQ0zDAIG', 'XYlZB1QO1lkqqRJ5jKLZxqLSZ6AifwVdRv9JGXb68UMU4NeH8sZiz2wws9ki', '10', '\"eyJpdiI6IkNlUWhGalRIUzBKYUVNOVVVeExHaFE9PSIsInZhbHVlIjoiWHI4WXBQVVhHRDFLMm9XUzlPalhBdz09IiwibWFjIjoiNTI4ZWE3YTI3YTdkZDAyNzQ3N2QzOGFlMDFlMmEwYTM1NWYwMDk2ZjM3MGVmNjgwNzE1MmU2MDI4YjVmMzkyNCJ9', '1', NULL, NULL, NULL , NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

ALTER TABLE `access` ADD PRIMARY KEY (`id`);
ALTER TABLE `emailconfig` ADD PRIMARY KEY (`id`);
ALTER TABLE `migrations` ADD PRIMARY KEY (`id`);
ALTER TABLE `notification` ADD PRIMARY KEY (`id`);
ALTER TABLE `password_resets` ADD KEY `password_resets_email_index` (`email`(768));
ALTER TABLE `rubrics` ADD PRIMARY KEY (`id`);
ALTER TABLE `task` ADD PRIMARY KEY (`id`);
ALTER TABLE `users` ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `users_email_unique` (`email`) USING HASH;
ALTER TABLE `access` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `emailconfig` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `migrations` MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
ALTER TABLE `notification` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `rubrics` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `task` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `users` MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;