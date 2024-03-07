

CREATE TABLE `#__timereport_assignment` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `ordering` int(11) NOT NULL,
  `published` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE `#__timereport_item` (
  `id` int(11) NOT NULL,
  `assignment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time_so` time NOT NULL,
  `time_od` time NOT NULL,
  `hours` time NOT NULL,
  `address` varchar(255) NOT NULL,
  `details` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE `#__timereport_user` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `unitno` varchar(50) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



ALTER TABLE `#__timereport_assignment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `published` (`published`);


ALTER TABLE `#__timereport_item`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `#__timereport_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);


ALTER TABLE `#__timereport_assignment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;


ALTER TABLE `#__timereport_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;


ALTER TABLE `#__timereport_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;
