CREATE TABLE users (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    uuid VARCHAR(255),
    name VARCHAR(255),
    image VARCHAR(255),
    email VARCHAR(255),
    phone VARCHAR(255),
    address VARCHAR(255),
    password VARCHAR(250),
    verify INT(11),
    balance VARCHAR(250),
    role INT(11),
    status INT(11),
    date_updated TIMESTAMP,
    date_created TIMESTAMP
);

CREATE TABLE employee (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    uuid VARCHAR(255),
    gender VARCHAR(255),
    company VARCHAR(255),
    task VARCHAR(255),
    city VARCHAR(255),
    evaluation VARCHAR(250),
    Position VARCHAR(250),
    date_updated TIMESTAMP,
    date_created TIMESTAMP
);

CREATE TABLE `order` (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    uuid VARCHAR(255),
    order_uuid VARCHAR(255),
    payment_uuid VARCHAR(255),
    service INT(11)
);

CREATE TABLE payment (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    payment_uuid VARCHAR(250),
    payment_amount VARCHAR(250),
    payment_method VARCHAR(250),
    proof_of_payment VARCHAR(250),
    date_updated TIMESTAMP,
    date_created TIMESTAMP
);

CREATE TABLE order_details (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    order_uuid VARCHAR(250),
    order_name VARCHAR(250),
    order_date DATE,
    start_time TIME,
    end_time TIME,
    status INT(11),
    date_updated TIMESTAMP,
    date_created TIMESTAMP
);

CREATE TABLE spanding (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    spanding_uuid VARCHAR(255),
    uuid_user VARCHAR(255),
    information VARCHAR(255),
    amount VARCHAR(255),
    status INT(11),
    date_created TIMESTAMP,
    date_updated TIMESTAMP
);

INSERT INTO `users` (`id`, `uuid`, `name`, `image`, `email`, `phone`, `address`, `password`, `verify`, `balance`, `role`, `status`, `date_updated`, `date_created`) VALUES (NULL, 'CGx1np78gbucVYd6jDXH', 'Surya', 'avatar1.jpg', 'suryakesuma63@gmail.com', '08975971177', 'Jawa Tengah', '$2y$10$O67bzlAypFRGD.Lx7cJ3V.eOCDtSjrzrl.o3EpobazsIztu4.yWoC', '549543', '0', '1', '1', current_timestamp(), current_timestamp());