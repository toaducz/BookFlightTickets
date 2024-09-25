SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+07:00";


CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_uname` varchar(20) NOT NULL,
  `admin_email` varchar(50) NOT NULL,
  `admin_pwd` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



INSERT INTO `admin` (`admin_id`, `admin_uname`, `admin_email`, `admin_pwd`) VALUES
(1, 'admin', 'admin@mail.com', '$2y$10$lTpyu.d48lwTXXa7r6BwBOh9Ij.tcHrr017cWYvsuPYMsnybHlLNS');

-- --------------------------------------------------------



CREATE TABLE `airline` (
  `airline_id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `seats` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



INSERT INTO `airline` (`airline_id`, `name`, `seats`) VALUES
(1, 'A01', 165),
(2, 'A02', 220),
(3, 'A03', 125),
(4, 'A04', 210),
(5, 'A05', 185),
(9, 'A06', 200),
(10, 'A07', 205),
(11, 'A08', 158),
(12, 'A09', 210),
(13, 'A010', 215),
(14, 'A011', 135);

-- --------------------------------------------------------



CREATE TABLE `cities` (
  `city` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



INSERT INTO `cities` (`city`) VALUES
('Hà Nội'),
('Hồ Chí Minh'),
('Tokyo'),
('Hải Phòng'),
('Cần Thơ'),
('Buôn Ma Thuộc'),
('Đà Lạt'),
('Tiền Giang'),
('An Giang'),
('Gia Lai'),
('Phú Quốc'),
('Bình Dương'),
('Tây Ninh'),
('Huế'),
('Phố cổ Hội An'),
('Thành phố Mỹ Tho'),
('Hà Tỉnh'),
('Thành phố Vinh');

-- --------------------------------------------------------



CREATE TABLE `flight` (
  `flight_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `arrivale` datetime NOT NULL,
  `departure` datetime NOT NULL,
  `Destination` varchar(20) NOT NULL,
  `source` varchar(20) NOT NULL,
  `airline` varchar(20) NOT NULL,
  `Seats` varchar(110) NOT NULL,
  `duration` varchar(20) NOT NULL,
  `Price` int(11) NOT NULL,
  `status` varchar(6) DEFAULT NULL,
  `issue` varchar(50) DEFAULT NULL,
  `last_seat` varchar(5) DEFAULT '',
  `bus_seats` int(11) DEFAULT 20,
  `last_bus_seat` varchar(5) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



INSERT INTO `flight` (`flight_id`, `admin_id`, `arrivale`, `departure`, `Destination`, `source`, `airline`, `Seats`, `duration`, `Price`, `status`, `issue`, `last_seat`, `bus_seats`, `last_bus_seat`) VALUES
(1, 1, '2022-12-20 10:03:00', '2022-12-20  09:01:00', "Hồ Chí Minh", 'Hà Nội', 'A01', '63', '1', 175, '', '', '21B', 20, ''),
(2, 1, '2022-12-20 12:03:00', '2022-12-20  11:01:00', "Hồ Chí Minh", 'Hà Nội', 'A02', '63', '1', 175, '', '', '21B', 20, ''),
(3, 1, '2022-12-20 10:30:00', '2022-12-20  09:30:00', "Hồ Chí Minh", 'Hà Nội', 'A03', '63', '1', 175, '', '', '21B', 20, ''),
(4, 1, '2022-12-20 14:03:00', '2022-12-20  13:01:00', "Hồ Chí Minh", 'Hà Nội', 'A04', '63', '1', 175, '', '', '21B', 20, ''),
(5, 1, '2022-12-20 16:03:00', '2022-12-20  15:01:00', "Hồ Chí Minh", 'Hà Nội', 'A05', '63', '1', 175, '', '', '21B', 20, ''),
(6, 1, '2022-12-20 10:03:00', '2022-12-20  09:01:00', "Hồ Chí Minh", 'Hà Nội', 'A06', '63', '1', 175, '', '', '21B', 20, ''),


(7, 1, '2022-12-18 20:50:00', '2022-12-18 18:50:00', 'Đà Lạt', 'Gia Lai', 'A02', '125', '2', 265, '', '', '', 20, ''),
(8, 1, '2022-12-18 00:55:00', '2022-12-18 17:00:00', 'Huế', 'Đà Lạt', 'A05', '183', '7', 615, 'arr', '', '21B', 20, ''),
(9, 1, '2022-12-18 17:09:00', '2022-12-18 16:05:00', 'Gia Lai', 'Phú Quốc', 'A04', '210', '1', 155, '', '', '', 20, ''),
(10, 1, '2022-12-18 13:10:00', '2022-12-18 11:05:00', 'An Giang', 'Buôn Ma Thuộc', 'A01', '165', '2', 200, '', '', '', 20, ''),
(11, 1, '2022-12-18 19:10:00', '2022-12-18 18:05:00', 'Oriaridge', 'Tokyo', 'A02', '220', '1', 165, '', '', '', 20, ''),
(12, 1, '2022-12-18 21:10:00', '2022-12-18 19:05:00', 'Hà Tỉnh', 'Phố cổ Hội An', 'A04', '210', '2', 320, '', '', '', 20, ''),
(13, 1, '2022-12-18 13:50:00', '2022-12-18 12:56:00', 'Phú Quốc', 'Hà Tỉnh', 'A01', '165', '1', 110, 'issue', '110', '', 20, ''),
(14, 1, '2022-12-18 11:08:00', '2022-12-18 09:07:00', 'Huế', 'Bình Dương', 'A03', '125', '2', 195, 'issue', '120', '', 20, ''),
(15, 1, '2022-12-18 10:10:00', '2022-12-18 08:10:00', 'Cần Thơ', 'Hà Tỉnh', 'A04', '210', '2', 125, 'issue', '120', '', 20, ''),
(16, 1, '2022-12-18 18:10:00', '2022-12-18 16:09:00', 'Tokyo', 'Bình Dương', 'A05', '185', '2', 220, 'dep', '', '', 20, ''),
(17, 1, '2022-12-18 17:10:00', '2022-12-18 16:10:00', 'Bình Dương', 'Gia Lai', 'A02', '220', '1', 125, 'arr', '', '', 20, ''),
(18, 1, '2022-12-18 19:15:00', '2022-12-18 16:12:00', 'Bình Dương', 'Tokyo', 'A01', '165', '3', 275, 'dep', '', '', 20, ''),
(19, 1, '2022-12-18 23:40:00', '2022-12-18 20:31:00', 'Buôn Ma Thuộc', 'Huế', 'A012', '210', '3', 295, '', '', '', 20, ''),
(20, 1, '2022-12-18 23:58:00', '2022-12-18 22:14:00', 'Thành phố Mỹ Tho', 'An Giang', 'A012', '208', '1', 185, 'dep', '', '21B', 20, ''),
(23, 1, '2022-12-21 19:00:00', '2022-12-21 18:00:00', 'Hà Nội', 'Hồ Chí Minh', 'A02', '220', '3', 175, '', '', '', 20, ''),
(24, 1, '2022-12-21 20:30:00', '2022-12-21 19:00:00', 'Hà Nội', 'Hồ Chí Minh', 'A03', '220', '3', 175, '', '', '', 20, ''),
(25, 1, '2022-12-21 22:00:00', '2022-12-21 21:00:00', 'Hà Nội', 'Hồ Chí Minh', 'A04', '220', '3', 175, '', '', '', 20, ''),
(22, 1, '2022-12-18 21:00:00', '2022-12-18 17:30:00', 'Hà Tỉnh', 'Bình Dương', 'A01', '165', '3 hours', 1500, '', '', '', 20, '');





CREATE TABLE `passenger_profile` (
  `passenger_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `flight_id` int(11) NOT NULL,
  `mobile` varchar(110) NOT NULL,
  `dob` datetime NOT NULL,
  `f_name` varchar(20) DEFAULT NULL,
  `m_name` varchar(20) DEFAULT NULL,
  `l_name` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



INSERT INTO `passenger_profile` (`passenger_id`, `user_id`, `flight_id`, `mobile`, `dob`, `f_name`, `m_name`, `l_name`) VALUES
(1, 1, 1, '2147483647', '1995-01-01 00:00:00', 'My', 'Thị Hà', 'Lê'),
(2, 2, 3, '0953884223', '1995-02-13 00:00:00', 'Toàn', 'Văn', 'Nguyễn'),
(3, 3, 2, '0842237374', '1994-06-21 00:00:00', 'Hạnh', 'Thị Ngọc', 'Nguyễn'),
(4, 4, 2, '0908645464', '1995-05-16 00:00:00', 'Dũng', 'Văn', 'Trần'),
(5, 2, 8, '0953884223', '1995-02-13 00:00:00', 'Toàn', 'Văn', 'Nguyễn'),
(6, 5, 20, '0908737466', '1995-02-13 00:00:00', 'Đức', 'Văn', 'Nguyễn');

-- --------------------------------------------------------



CREATE TABLE `payment` (
  `card_no` varchar(16) NOT NULL,
  `user_id` int(11) NOT NULL,
  `flight_id` int(11) NOT NULL,
  `expire_date` varchar(5) DEFAULT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



INSERT INTO `payment` (`card_no`, `user_id`, `flight_id`, `expire_date`, `amount`) VALUES
('1010555677851111', 4, 2, '10/26', 370),
('1020445869651011', 2, 20, '12/25', 370),
('1111888889897778', 2, 3, '12/25', 205),
('1400565800004478', 2, 8, '12/25', 1230),
('1458799990001450', 3, 2, '12/25', 185),
('4204558500014587', 1, 1, '02/25', 350);

-- --------------------------------------------------------



-- --------------------------------------------------------



CREATE TABLE `ticket` (
  `ticket_id` int(11) NOT NULL,
  `passenger_id` int(11) NOT NULL,
  `flight_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `seat_no` varchar(10) NOT NULL,
  `cost` int(11) NOT NULL,
  `class` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



INSERT INTO `ticket` (`ticket_id`, `passenger_id`, `flight_id`, `user_id`, `seat_no`, `cost`, `class`) VALUES
(1, 1, 1, 1, '21A', 350, 'E'),
(2, 2, 3, 2, '21A', 205, 'E'),
(4, 3, 2, 3, '21A', 185, 'E'),
(6, 4, 2, 4, '21C', 370, 'E'),
(8, 5, 8, 2, '21A', 1230, 'E'),
(10, 6, 20, 2, '21A', 370, 'E');

-- --------------------------------------------------------



CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `firstname` varchar(100),
  `midname` varchar(100),
  `lastname`varchar(100),
  `phone` varchar(100),
  `date` datetime
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `users` (`user_id`, `username`, `email`, `password`,`firstname`,`midname`,`lastname`,`phone`,`date`) VALUES
(1, 'hamy2603', 'lethihamy@gmail.com', '$2y$10$zr.UlaKFEhBdcirNaa03ceV8Y31Jiw5KSFboVYasgZBwxoddtVWwO',"Lê","THị","Hà My","0123456789","1995-01-01"),
(2, 'vantoan123', 'vantoan123@gmail.com', '$2y$10$zr.UlaKFEhBdcirNaa03ceV8Y31Jiw5KSFboVYasgZBwxoddtVWwO','Nguyễn', 'Văn', 'Toàn',"0123456789","1995-01-01"),
(3, 'ngochanh94', 'ngochanh94@gmail.com', '$2y$10$zr.UlaKFEhBdcirNaa03ceV8Y31Jiw5KSFboVYasgZBwxoddtVWwO','Nguyễn', 'Thị Ngọc', 'Hạnh',"0123456789","1995-01-01"),
(4, 'vandung1', 'vandung1@gmail.com', '$2y$10$zr.UlaKFEhBdcirNaa03ceV8Y31Jiw5KSFboVYasgZBwxoddtVWwO','Trần', 'Văn', 'Dũng',"0123456789","1995-01-01"),
(5, 'vanduc20', 'vanduc20@gmail.com', '$2y$10$9rscJPJNoJUIasBidOTSueToKDvfxL8Jcrrx..PdUACRWWQ9ILYim','Nguyễn', 'Văn', 'Đức',"0123456789","1995-01-01"),
(7, 'admin', 'admin@mail.com', '$2y$10$lTpyu.d48lwTXXa7r6BwBOh9Ij.tcHrr017cWYvsuPYMsnybHlLNS',"Quản trị","A","TEst","0123456789","1995-01-01"),
(8, 'trantri123', 'trantri0253@gmail.com', '$2y$10$gnpW75Ope8ZdZo/7QqazgOd9kAsKTGofDKGMk53POhzONaM9zgI7m',"Trần","Văn","Trí","0123456789","1995-01-01");


ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);


ALTER TABLE `airline`
  ADD PRIMARY KEY (`airline_id`);


ALTER TABLE `flight`
  ADD PRIMARY KEY (`flight_id`),
  ADD KEY `admin_id` (`admin_id`);


ALTER TABLE `passenger_profile`
  ADD PRIMARY KEY (`passenger_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `flight_id` (`flight_id`);


ALTER TABLE `payment`
  ADD PRIMARY KEY (`card_no`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `flight_id` (`flight_id`);




ALTER TABLE `ticket`
  ADD PRIMARY KEY (`ticket_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `flight_id` (`flight_id`),
  ADD KEY `passenger_id` (`passenger_id`);


ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);




ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;


ALTER TABLE `airline`
  MODIFY `airline_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;


ALTER TABLE `flight`
  MODIFY `flight_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;


ALTER TABLE `passenger_profile`
  MODIFY `passenger_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;


ALTER TABLE `ticket`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;


ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;


ALTER TABLE `flight`
  ADD CONSTRAINT `flight_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`);


ALTER TABLE `passenger_profile`
  ADD CONSTRAINT `passenger_profile_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `passenger_profile_ibfk_2` FOREIGN KEY (`flight_id`) REFERENCES `flight` (`flight_id`);


ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`flight_id`) REFERENCES `flight` (`flight_id`);


ALTER TABLE `ticket`
  ADD CONSTRAINT `ticket_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `ticket_ibfk_2` FOREIGN KEY (`flight_id`) REFERENCES `flight` (`flight_id`),
  ADD CONSTRAINT `ticket_ibfk_3` FOREIGN KEY (`passenger_id`) REFERENCES `passenger_profile` (`passenger_id`);
COMMIT;

